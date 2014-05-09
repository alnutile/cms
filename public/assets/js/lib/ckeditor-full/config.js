/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
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
    config.toolbarGroups = [];
    config.toolbar = [
        { name: 'basicstyles',
            items: [ 'Bold', 'Italic', 'Strike', 'Underline' ] },
        { name: 'paragraph', items: [ 'BulletedList', 'NumberedList', 'Blockquote' ] },
        { name: 'editing', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'tools', items: [ 'SpellChecker'] },
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'styles', items: [ 'Format', 'FontSize', 'TextColor', 'PasteFromWord', 'RemoveFormat' ] },
        { name: 'insert', items: [ 'Image', 'Table', 'SpecialChar', 'MediaEmbed' ] },'/',
    ];

    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.
    //config.removeButtons = 'Image';
    config.removeButtons = 'Flash,Iframe,Smiley';

    // Se the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Make dialogs simpler.
    config.removeDialogTabs = 'image:advanced;link:advanced';
};
