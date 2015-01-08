<div class="form-group">
    <label>Tags (<a href="http://www.restorationtrades.com/help.html#tags" target="_blank">Help</a>)</label>
    <div ng-controller = "tagsCtrl">
        <tags-input ng-model="currentTags" on-tag-added="addTag($tag)" on-tag-removed="removeTag($tag)">
                    <auto-complete source="getAllTags($query)"></auto-complete>
        </tags-input>
    </div>
</div>
