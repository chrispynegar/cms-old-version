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

class Template extends Core {
	
	protected static $table_name = 'templates';
	protected static $table_fields = array('id', 'name', 'type', 'directory', 'active', 'date_modified', 'date_installed');
	public $id;
	public $name;
	public $type;
	public $directory;
	public $active;
	public $date_modified;
	public $date_installed;
	
	public static function admin_active() {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE type='admin' AND active=1 LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function public_active() {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE type='public' AND active=1 LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
}

$template = Template::admin_active();
defined('ADMIN_TEMPLATE') ? null : define('ADMIN_TEMPLATE', SITE_ROOT.'templates'.DS.'admin'.DS.$template->directory.DS);

$template = Template::public_active();
defined('PUBLIC_TEMPLATE') ? null : define('PUBLIC_TEMPLATE', SITE_ROOT.'templates'.DS.'public'.DS.$template->directory.DS);

?>