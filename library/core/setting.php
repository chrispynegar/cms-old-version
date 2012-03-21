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
 
class Setting extends Core {

	public static $table_name = 'settings';
	public static $table_fields = array('id', 'website_name', 'tagline', 'keywords', 'description', 'offline', 'offline_message', 'editor', 'use_htaccess', 'debug_mode', 'date_modified', 'date_created');
	public $id;
	public $website_name;
	public $tagline;
	public $keywords;
	public $description;
	public $offline;
	public $offline_message;
	public $editor;
	public $use_htaccess;
	public $debug_mode;
	public $date_modified;
	
	public static function debug_mode() {
		global $database;
		if($setting = Setting::find_by_id(1)) {
			if($setting->debug_mode == 1) {
				ini_set('display_errors', true);
			} else {
				ini_set('display_errors', false);
			}
		} else {
			die('Could not retrieve settings.');
		}
	}

}

Setting::debug_mode();

?>