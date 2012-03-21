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
 
class ModuleItem extends Core {

	public static $table_name = 'module_items';
	public static $table_fields = array('id', 'type', 'name', 'position', 'parameters', 'date_modified', 'date_created');
	public $id;
	public $type;
	public $name;
	public $position;
	public $parameters;
	public $date_modified;
	public $date_created;
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_permitted_items() {
		global $database;
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " ORDER BY position ASC");
	}

}

?>