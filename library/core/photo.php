<?php

/**
 * Develop21
 *
 * @package Develop21 CMS
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */
 
class Photo extends Core {

	public static $table_name = 'photos';
	public static $table_fields = array('id', 'author', 'album', 'name', 'photo', 'type', 'size', 'profile_picture', 'date_uploaded');
	public $id;
	public $author;
	public $album;
	public $name;
	public $photo;
	public $type;
	public $size;
	public $profile_picture;
	public $date_uploaded;
	
	public $upload_errors = array(
		UPLOAD_ERR_OK	=> 'No errors',
		UPLOAD_ERR_INI_SIZE	=> 'Larger than upload_max_filesize',
		UPLOAD_ERR_FORM_SIZE	=> 'Larger than max_file_size',
		UPLOAD_ERR_PARTIAL	=> 'Partial upload',
		UPLOAD_ERR_NO_FILE	=> 'No file',
		UPLOAD_ERR_NO_TMP_DIR	=> 'No temporary directory',
		UPLOAD_ERR_CANT_WRITE	=> 'Can\'t write to disk',
		UPLOAD_ERR_EXTENSION	=> 'File upload stopped by an extension'
	);
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_album($album) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE album='{$album}'");
	}
	
	/*public static function profile_picture($user) {
		return static::find_by_sql("SELECT photo FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE author='{$user}' AND profile_picture=1 LIMIT 1");
	}*/
	
	public static function profile_picture($user) {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE author='{$user}' AND profile_picture=1 LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>