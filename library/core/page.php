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
 
class Page extends Core {

	public static $table_name = 'pages';
	public static $table_fields = array('id', 'author', 'name', 'content', 'keywords', 'description', 'published', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $name;
	public $content;
	public $keywords;
	public $description;
	public $published;
	public $date_modified;
	public $date_created;
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

}

?>