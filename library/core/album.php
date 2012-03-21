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
 
class Album extends Core {

	public static $table_name = 'albums';
	public static $table_fields = array('id', 'author', 'name', 'directory', 'about', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $name;
	public $directory;
	public $about;
	public $date_modified;
	public $date_created;
	
	public function create_default($id) {
		global $database;
		global $user;
		$user = User::find_by_id($id);
		if(mkdir(SITE_ROOT.'users/'.$user->username.'/my-photos', 0777)) {
			$this->author = $id;
			$this->name = 'My Photos';
			$this->directory = 'my-photos';
			$this->about = 'The default my photos album';
			$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
			$this->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
			if($this->save()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_user_albums($author) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE author='{$author}'");
	}

}

?>