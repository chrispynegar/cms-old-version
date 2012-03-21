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
 
class MenuItem extends Core {

	public static $table_name = 'menu_items';
	public static $table_fields = array('id', 'menu', 'type', 'name', 'alias', 'access', 'website_title', 'position', 'parameters', 'date_modified', 'date_created');
	public $id;
	public $menu;
	public $type;
	public $name;
	public $alias;
	public $access;
	public $website_title;
	public $position;
	public $parameters;
	public $date_modified;
	public $date_created;
	
	public static function find_by_name($name, $menu) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' AND menu='{$menu}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_alias($alias) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE alias='{$alias}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_permitted_items($menu) {
		global $database;
		global $session;
		if(!$session->is_logged_in()) {
			return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE menu='{$menu}' AND access='public' OR access='all' ORDER BY position ASC");
		} elseif($session->is_logged_in()) {
			if(Permission::get_access_level() <= 2) {
				return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE menu='{$menu}' AND access='special' OR access='loggedin' OR access='all' ORDER BY position ASC");
			} else {
				return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE menu='{$menu}' AND access='loggedin' OR access='all' ORDER BY position ASC");
			}
		}
	}
	
	public static function find_menu_items($menu) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE menu='{$menu}' ORDER BY position ASC");
	}
	
	public static function get_highest_position($menu) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE menu='{$menu}' ORDER BY position DESC LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>