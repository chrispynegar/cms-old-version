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

class Permission extends Core {
	
	protected static $table_name = 'permissions';
	protected static $table_fields = array('id', 'name', 'access', 'date_modified', 'date_installed');
	public $id;
	public $name;
	public $access;
	public $date_modified;
	public $date_installed;
	
	public static function access($access) {
		global $session;
		$user = User::find_by_id($session->user_id);
		$permission = Permission::find_by_id($user->permission);
		if($permission->access < $access) {
			die('You do not have permission to access this area.');
		}
	}
	
	public static function get_access_level() {
		global $session;
		$user = User::find_by_id($session->user_id);
		$permission = Permission::find_by_id($user->permission);
		return $permission->access;
	}
	
}

?>