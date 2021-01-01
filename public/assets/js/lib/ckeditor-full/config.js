/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	config.skin = 'moono';
    config.extraPlugins = 'imagebrowser,mediaembed,codemirror,tabletools,tabletoolstoolbar,stylescombo,slideshow,colordialog,font,justify,dialogadvtab,panelbutton,floatpanel,bootstrapGrid';
    config.imageBrowser_listUrl = '/api/v1/ckeditor/gallery';
    config.filebrowserBrowseUrl = '/api/v1/ckeditor/files';
    config.filebrowserImageUploadUrl = '/api/v1/ckeditor/images';
    config.filebrowserUploadUrl = '/api/v1/ckeditor/files';
    config.toolbarLocation = 'top';
    config.language = 'en';
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	
	//bootstrap grid 
	//config.extraPlugins = 'panelbutton,floatpanel,bootstrapGrid';
	config.contentsCss = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
	config.mj_variables_bootstrap_css_path = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
	config.allowedContent = true;
	config.bootstrapGrid_container_large_desktop = 1170;
	config.bootstrapGrid_container_desktop = 970;
	config.bootstrapGrid_container_tablet = 750;
	config.bootstrapGrid_grid_columns = 12;

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		//{ name: 'insert', 	   groups: [ 'image', 'specialchar', 'mediaembed', 'sourcedialog' ] },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' },
		{ name: 'insert', groups: [ 'BootstrapGrid', 'BootstrapGridAdd', 'BootstrapGridDelete', 'BootstrapGridSettings', 'Source' ] },
		{ name: 'tables', groups: [ 'table','tablerow','tablecolumn', 'tablecell','tablecellmergesplit' ] }
	];
	/*config.toolbar = [
		{ name: 'insert', items: [ 'BootstrapGrid', 'BootstrapGridAdd', 'BootstrapGridDelete', 'BootstrapGridSettings', 'Source' ] }
	];*/
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Font,About';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;h5;pre';

	// Simplify the dialog windows.
	//config.removeDialogTabs = 'image:advanced;link:advanced';
	
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
    
	// Changes the class to "captionedImage".
	config.image2_captionedClass = 'captioned-image';	
	
    // Add image classes for Enhanced Image plugin
    config.image2_alignClasses = [ 'image-left', 'image-center', 'image-right' ];
    
    // Use the classes 'AlignLeft', 'AlignCenter', 'AlignRight', 'AlignJustify'
	config.justifyClasses = [ 'align-left', 'align-center', 'align-right', 'align-justify' ];
	
    //for paypal buttons - made classes allowed in admin editor
    config.extraAllowedContent = 'form(*){*}[*]; input(*){*}[*]; *(*)';
};
