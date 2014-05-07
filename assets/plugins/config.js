/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.extraPlugins = 'autosave';
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbar =
[
	{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	'/',
	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About','codesnippet' ] }
];
	config.autosave_NotOlderThen = 1440;
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	

	// Set the most common block elements.
	config.format_tags = 'div;h1;h2;h3;pre';
	// // Simplify the dialog windows.a
	//& -> &amp;, < -> &lt; and > -> &gt
	config.extraAllowedContent = 'code';
	config.enterMode = CKEDITOR.ENTER_DIV; 
	config.extraPlugins = 'diaglogui';
	config.extraPlugins = 'lineutils';
	config.extraPlugins = 'codesnippet';
	config.codeSnippet_theme = 'school_book';
};
 