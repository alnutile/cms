/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.skin = 'moono';
    config.extraPlugins = "imagebrowser,mediaembed";
    config.imageBrowser_listUrl = '/api/v1/ckeditor/gallery';
    config.filebrowserBrowseUrl = '/api/v1/ckeditor/files';
    config.filebrowserImageUploadUrl = '/api/v1/ckeditor/images';
    config.filebrowserUploadUrl = '/api/v1/ckeditor/files';
    config.toolbarLocation = 'bottom';

	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
    config.toolbar = 'full';
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
        { name: 'basicstyles',
            groups: [ 'Bold', 'Italic', 'Strike', 'Underline' ] },
        { name: 'paragraph', groups: [ 'BulletedList', 'NumberedList', 'Blockquote' ] },
        { name: 'editing', groups: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
        { name: 'links', groups: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'tools', groups: [ 'SpellChecker', 'Maximize' ] },
        { name: 'clipboard', groups: [ 'Undo', 'Redo' ] },
        { name: 'styles', groups: [ 'Format', 'FontSize', 'TextColor', 'PasteText', 'PasteFromWord', 'RemoveFormat' ] },
        { name: 'insert', groups: [ 'Image', 'Table', 'MediaEmbed', 'SpecialChar' ] },
        
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Flash';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
