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

class Status extends Core {
	
	protected static $table_name = 'statuses';
	protected static $table_fields = array('id', 'name', 'date_modified', 'date_installed');
	public $id;
	public $name;
	public $date_modified;
	public $date_installed;
	
}

?>