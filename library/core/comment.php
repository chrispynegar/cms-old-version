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
 
class Comment extends Core {

	public static $table_name = 'comments';
	public static $table_fields = array('id', 'article', 'author', 'name', 'email', 'url', 'comment', 'date_created');
	public $id;
	public $article;
	public $author;
	public $name;
	public $email;
	public $url;
	public $comment;
	public $date_created;
	
	public static function article_comments($article) {
		global $database;
		return static::find_by_sql("SELECT * FROM ".DATABASE_TBL_PREFIX."comments WHERE article='{$article}' ORDER BY date_created DESC");
	}
	
	

}

?>