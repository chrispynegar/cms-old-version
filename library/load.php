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

// define directory seperator '/'
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// find correct path to retrieve configuration file
if(file_exists('config.php')) {
	require_once('config.php');
} elseif(file_exists('..'.DS.'config.php')) {
	require_once('..'.DS.'config.php');
} elseif(file_exists('..'.DS.'..'.DS.'config.php')) {
	require_once('..'.DS.'..'.DS.'config.php');
} elseif(file_exists('..'.DS.'..'.DS.'..'.DS.'config.php')) {
	require_once('..'.DS.'..'.DS.'..'.DS.'config.php');
}

// define constants from configuration settings
defined('DATABASE_TYPE') ? null : define('DATABASE_TYPE', $config['database_type']);
defined('DATABASE_SERVER') ? null : define('DATABASE_SERVER', $config['database_server']);
defined('DATABASE_USERNAME') ? null : define('DATABASE_USERNAME', $config['database_username']);
defined('DATABASE_PASSWORD') ? null : define('DATABASE_PASSWORD', $config['database_password']);
defined('DATABASE_NAME') ? null : define('DATABASE_NAME', $config['database_name']);
defined('DATABASE_TBL_PREFIX') ? null : define('DATABASE_TBL_PREFIX', $config['database_tbl_prefix']);
defined('SITE_ROOT') ? null : define('SITE_ROOT', $config['site_root']);
defined('SITE_URL') ? null : define('SITE_URL', $config['site_url']);
defined('LIBRARY_PATH') ? null : define('LIBRARY_PATH', SITE_ROOT.'library'.DS);

// load included files
require_once(LIBRARY_PATH.DS.'includes'.DS.'functions.php');

// load selected database
if(DATABASE_TYPE == 'MySQL') {
	require_once(LIBRARY_PATH.'core'.DS.'mysql.php');
} elseif(DATABASE_TYPE == 'MySQLi') {
	require_once(LIBRARY_PATH.'core'.DS.'mysqli.php');
}

// load system core objects
require_once(LIBRARY_PATH.DS.'core'.DS.'session.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'core.php');

// load system settings
require_once(LIBRARY_PATH.DS.'core'.DS.'setting.php');

// load main core objects
require_once(LIBRARY_PATH.DS.'core'.DS.'album.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'article.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'category.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'comment.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'editor.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'friend.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'menu.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'menu-item.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'menu-type.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'message.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'module.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'module-item.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'page.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'permission.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'photo.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'privacy.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'status.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'template.php');
require_once(LIBRARY_PATH.DS.'core'.DS.'user.php');

// load helper classes
//require_once(LIBRARY_PATH.DS.'helpers'.DS.'email.php');
require_once(LIBRARY_PATH.DS.'helpers'.DS.'form.php');
//require_once(LIBRARY_PATH.DS.'helpers'.DS.'html.php');
//require_once(LIBRARY_PATH.DS.'helpers'.DS.'javascript.php');
//srequire_once(LIBRARY_PATH.DS.'helpers'.DS.'pagination.php');


?>