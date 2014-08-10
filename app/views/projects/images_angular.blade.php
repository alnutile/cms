<div ng-app="app">
    <div ng-controller="ProjectImagesController">
        [[ test ]]
        <ul ng-if="images.length > 0">
            <li>Yup here</li>
            <li ng-repeat="image in images">
                [[image.file_name]] @ [[image.id]]  <i class="glyphicon glyphicon-trash" ng-click="deleteImage(image.id)">&nbsp;
                </i>
            </li>
        </ul>
        <div class="form-group">
            <div flow-init="{target: '/images/projects', singleFile: false}"
                 flow-files-submitted="$flow.upload()"
                 flow-file-success="$file.msg = $message">
                <div ng-repeat="file in $flow.files"
                     ng-init="listing.image = file.name"
                     class="alert alert-info">
                    New Image Uploaded [[file.name]]
                    <input type="hidden" name="images[]" value="[[file.name]]">
                </div>

                <input type="file" flow-btn/>
            </div>
        </div>
    </div>
</div>