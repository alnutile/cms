<div class = "{{$model}}_slideshow slideshow">
    <div ng-controller="UploadImagesController">
        <flex-slider slide="image in images track by $index">
            <li>
                <img ng-src="/assets/img/{{$model}}/[[image.file_name]]">
            </li>
        </flex-slider>
    </div>
</div>

