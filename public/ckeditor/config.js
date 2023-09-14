/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */


CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.extraPlugins = 'clipboard';

	config.height = 400;
	
	// config.filebrowserBrowseUrl = "/elfinder/ckeditor";
	config.filebrowserUploadUrl = document.querySelector('#editor').getAttribute('data-upload-url') + '/?_token=' + document.querySelector('#editor').getAttribute('data-csrf-token');
	config.filebrowserBrowseMethod = "form";
	config.removeDialogTabs = 'image:advanced';
	config.extraPlugins = 'youtube,filetools,codesnippet,image2';

};

