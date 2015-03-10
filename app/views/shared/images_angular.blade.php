<div>
    <div ng-controller="UploadImagesController">
        <ul ng-if="images.length > 0" class="edit_images sortable">
            <li ng-repeat="image in images | orderBy:'order'">
                <img class ="img-thumbnail" src="/assets/img/{{$model}}/[[image.file_name]]">&nbsp;[[image.file_name]]&nbsp;<i class="glyphicon glyphicon-trash" ng-click="deleteImage(image.id)">&nbsp;</i>
                <br>
                @if($model != 'pages')
                <label>Edit image caption (<a href="http://www.restorationtrades.com/help.html#edit_project_image">Help</a>):</label> <input class="caption_update" name="image_caption_update[ [[image.id]] ][]" type="text" placeholder="[[image.image_caption]]" >
                <div class="spacer">
                    <label>Image Position (<a href="http://www.restorationtrades.com/help.html#edit_project_image">Help</a>):</label> <input class="order_update" name="image_order_update[ [[image.id]] ][]" type="text" placeholder="[[image.order]]" >
                </div>
                @endif
            </li>
        </ul>
        <div class="form-group">
            <div flow-init="{target: '/images/upload/{{$model}}', singleFile: false, testChunks:false}"
                 flow-files-submitted="$flow.upload()"
                 flow-file-success="$file.msg = $message">
                <div ng-repeat="file in $flow.files"
                     ng-init="listing.image = file.name"
                     class="alert alert-info">
                    New Image Uploaded [[file.name]]
                    <input type="hidden" name="images['[[$index]]'][file]" value="[[file.name]]">
                    <br>
                    <label>Add image caption (<a href="http://www.restorationtrades.com/help.html#edit_project_image">Help</a>):</label>  <input class="caption" name="images['[[$index]]'][image_caption]" type="text" placeholder="Image Caption" >
                    <div class="spacer">
                        <label>Image Position (<a href="http://www.restorationtrades.com/help.html#edit_project_image">Help</a>):</label> <input class="order_update" name="images['[[$index]]'][order]" type="text" placeholder="" >
                    </div>
                </div>

                <input type="file" flow-btn/>

            </div>
        </div>
    </div>
</div>

