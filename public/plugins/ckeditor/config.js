/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#CCEAEE';
        config.extraPlugins = 'codesnippet';
        config.mathJaxLib = 'https://cdn.mathjax.org/mathjax/2.6-latest/MathJax.js?config=TeX-AMS_HTML';
        removePlugins:'resize,autosave,print,preview,find,about,maximize,ShowBlocks,Forms'
        config.removeButtons = 'Flash,Iframe,About,MediaEmbed,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Scayt,Smiley,oembed,FontSize,Font';      
};
