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
 
class Editor extends Core {

	public static $table_name = 'editors';
	public static $table_fields = array('id', 'name', 'directory', 'source', 'script', 'date_installed');
	public $id;
	public $name;
	public $directory;
	public $source;
	public $script;
	public $date_installed;
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>