<div class="form-group">
    <label>Tags (<a href="http://www.restorationtrades.com/help.html#tags" target="_blank">Help</a>)</label>
    <div ng-controller = "tagsCtrl">
        [[ currentTags | json ]]
        <tags-input ng-model="currentTags">
            <!--        <auto-complete source="getAllTags($query)"></auto-complete>-->
        </tags-input>
        <div ng-repeat="tags in currentTags">
            <input type="hidden" name="tags['[[$index]]'][tag]" value="[[tag.name]]">
        </div>
    </div>
</div>
