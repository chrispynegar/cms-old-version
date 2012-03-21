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
 
class Article extends Core {

	public static $table_name = 'articles';
	public static $table_fields = array('id', 'author', 'category', 'name', 'content', 'keywords', 'description', 'hits', 'published', 'comments', 'date_modified', 'date_created');
	public $id;
	public $author;
	public $category;
	public $name;
	public $content;
	public $keywords;
	public $description;
	public $hits;
	public $published;
	public $comments;
	public $date_modified;
	public $date_created;
	
	public function add_hit($article, $hits) {
		global $database;
		$sql = "UPDATE " . DATABASE_TBL_PREFIX . self::$table_name . " SET hits={$hits} WHERE id={$article} LIMIT 1";
		$database->query($sql);
	}
	
	public static function find_by_name($name) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE name='{$name}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_category($category) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE category='{$category}' ORDER BY id DESC");
	}
	
	public static function most_popular($number = 3) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " ORDER BY hits DESC LIMIT {$number}");
	}

}

?>