/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'pt-br';
	config.fillEmptyBlocks = false;
	config.basicEntities = false;
	config.autoParagraph = false;
	// config.uiColor = '#AADC6E';
	config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	{ name: 'forms', groups: [ 'forms' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	'/',
	{ name: 'links', groups: [ 'links' ] },
	{ name: 'insert', groups: [ 'insert', 'Image', 'Youtube' ] },
	{ name: 'styles', groups: [ 'styles' ] },
	{ name: 'colors', groups: [ 'colors' ] },
	{ name: 'tools', groups: [ 'tools' ] },
	{ name: 'others', groups: [ 'others' ] },
	{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Print,NewPage,Save,Preview,Templates,Find,Replace,SelectAll,TextField,Radio,Checkbox,Form,Select,Textarea,Button,ImageButton,HiddenField,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Iframe,PageBreak,Maximize,ShowBlocks,About';
    config.extraPlugins = 'youtube';

    config.filebrowserBrowseUrl = 'assets/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = 'assets/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = 'assets/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = 'assets/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = 'assets/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = 'assets/kcfinder/upload.php?opener=ckeditor&type=flash';
};

CKEDITOR.on( 'instanceCreated', function( event ) {
	editor.on( 'configLoaded', function() {
		editor.config.basicEntities = false;
		editor.config.entities_greek = false;
		editor.config.entities_latin = false;
		editor.config.entities_additional = '';

	});
});
