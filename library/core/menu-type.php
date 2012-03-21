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
 
class MenuType extends Core {

	public static $table_name = 'menu_types';
	public static $table_fields = array('id', 'name', 'directory', 'alias', 'brief', 'date_modified', 'date_created');
	public $id;
	public $name;
	public $directory;
	public $alias;
	public $brief;
	public $date_modified;
	public $date_created;
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_alias($alias) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE alias='{$alias}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_all_by_name() {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " ORDER BY name ASC");
	}

}

?>