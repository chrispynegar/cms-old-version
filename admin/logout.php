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

// if the configuration file doesn't exist, run the installer
if(!file_exists('../config.php')) {
	header('Location: ../install/index.php');
	exit();
}

// require the loader
require_once('../library/load.php');

// check that the user isn't already logged out
if(!$session->is_logged_in()) {
	$session->message('You are already logged out');
	redirect('login.php');
}

// log out user
$session->logout();
$session->message('You are now logged out.');
redirect('login.php');

?>