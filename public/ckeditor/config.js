/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */


CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.extraPlugins = 'clipboard';
	
	config.filebrowserBrowseUrl = "/elfinder/ckeditor";
	config.filebrowserUploadUrl = document.querySelector('.ckeditor').getAttribute('data-upload-url') + '/?_token=' + document.querySelector('.ckeditor').getAttribute('data-csrf-token');
	config.filebrowserBrowseMethod = "form";

	config.removePlugins = 'iframe';
	config.extraPlugins = 'youtube';

};

console.log(document.querySelector('.ckeditor').getAttribute('data-upload-url'));
console.log(document.querySelector('.ckeditor').getAttribute('data-csrf-token'));

