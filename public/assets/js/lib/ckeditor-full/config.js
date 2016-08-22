/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.skin = 'moono';
    config.extraPlugins = "imagebrowser,mediaembed,sourcedialog";
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
    config.toolbarGroups = [];
    config.toolbar = [
        { name: 'basicstyles',
            items: [ 'Bold', 'Italic', 'Strike', 'Underline' ] },
        { name: 'paragraph', items: [ 'BulletedList', 'NumberedList', 'Blockquote' ] },
        { name: 'editing', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'tools', items: [ 'SpellChecker', 'Sourcedialog'] },
        { name: 'clipboard', items: [ 'Undo', 'Redo'] },
        { name: 'styles', items: [ 'Format', 'FontSize', 'TextColor', 'PasteFromWord', 'RemoveFormat' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'SpecialChar', 'MediaEmbed', 'SourceDialog'] },'/',
    ];
	
    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
    //config.removeButtons = 'Image';
    config.removeButtons = 'Flash,Iframe,Smiley';

    // Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;h5;pre';

    //for paypal buttons - made classes allowed in admin editor
    config.extraAllowedContent = 'form(*){*}[*]; input(*){*}[*]; *(*)';


    // Make dialogs simpler.
    config.removeDialogTabs = 'image:advanced;link:advanced';
    
    // Allow Script tags and classes.
	config.allowedContent = {
        script: true,
        $1: {
            // This will set the default set of elements
            elements: CKEDITOR.dtd,
            attributes: true,
            styles: true,
            classes: true
        }
    };
};
