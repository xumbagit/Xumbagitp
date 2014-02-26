/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
   config.filebrowserBrowseUrl = '../admin/libs/ckeditor/plugins/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = '../admin/libs/ckeditor/plugins/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = '../admin/libs/ckeditor/plugins/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = '../admin/libs/ckeditor/plugins/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = '../admin/libs/ckeditor/plugins/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = '../admin/libs/ckeditor/plugins/kcfinder/upload.php?type=flash';
};
