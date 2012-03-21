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

class Privacy extends Core {
	
	protected static $table_name = 'privacy';
	protected static $table_fields = array('id', 'user', 'profile', 'albums', 'email', 'date_modified');
	public $id;
	public $user;
	public $profile;
	public $albums;
	public $email;
	public $date_modified;
	
	public static function find_by_user($user) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE user='{$user}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
}

?>