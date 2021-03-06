/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	config.language = 'pt-br';

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';


	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// config.filebrowserBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=files';
	// config.filebrowserImageBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=images';
	// config.filebrowserFlashBrowseUrl = '../kcfinder/browse.php?opener=ckeditor&type=flash';
	// config.filebrowserUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=files';
	// config.filebrowserImageUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=images';
	// config.filebrowserFlashUploadUrl = '../kcfinder/upload.php?opener=ckeditor&type=flash';

	config.filebrowserBrowseUrl = 'assets/plugins/kcfinder/browse.php?type=files&lang=pt-br';
	config.filebrowserImageBrowseUrl = 'assets/plugins/kcfinder/browse.php?type=images&lang=pt-br';
	config.filebrowserFlashBrowseUrl = 'assets/plugins/kcfinder/browse.php?type=flash&lang=pt-br';
	config.filebrowserUploadUrl = 'assets/plugins/kcfinder/upload.php?type=files&lang=pt-br';
	config.filebrowserImageUploadUrl = 'assets/plugins/kcfinder/upload.php?type=images&lang=pt-br';
	config.filebrowserFlashUploadUrl = 'assets/plugins/kcfinder/upload.php?type=flash&lang=pt-br';
};
