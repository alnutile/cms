<div class="form-group">
    <label>Tags (<a href="http://http://www.restorationtrades.com/help/admin_projects_dark.html" target="_blank">Help</a>)</label>
    <div ng-controller = "tagsCtrl">
        <tags-input ng-model="currentTags"
                    on-tag-added="addTag($tag)"
                    on-tag-removed="removeTag($tag)"
                    replace-spaces-with-dashes="false">
                    <auto-complete source="getAllTags($query)"></auto-complete>
        </tags-input>
    </div>
</div>
