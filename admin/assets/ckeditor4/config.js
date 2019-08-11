/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.height = 430;
	config.extraPlugins = 'wordcount,notification';
	config.wordcount = {

		// Whether or not you want to show the Paragraphs Count
		showParagraphs: true,

		// Whether or not you want to show the Word Count
		showWordCount: true,

		// Whether or not you want to show the Char Count
		showCharCount: false,

		// Whether or not you want to count Spaces as Chars
		countSpacesAsChars: false,

		// Whether or not to include Html chars in the Char Count
		countHTML: false,

		// Maximum allowed Word Count, -1 is default for unlimited
		maxWordCount: -1,

		// Maximum allowed Char Count, -1 is default for unlimited
		maxCharCount: -1,

		// Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
		filter: new CKEDITOR.htmlParser.filter({
		    elements: {
		        div: function( element ) {
		            if(element.attributes.class == 'mediaembed') {
		                return false;
		            }
		        }
		    }
		})
	};
};
