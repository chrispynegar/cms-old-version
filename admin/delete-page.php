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

// check that the user is logged in
logged_in();

// check that the user access to this
Permission::access(4);

if(isset($_GET['id'])) {
	$page = Page::find_by_id($_GET['id']);
	if($page->delete()) {
		$session->message('This page was successfully deleted.');
		redirect('manage-pages.php');
	} else {
		$session->message('This page could not be deleted.');
		redirect('manage-pages.php');
	}
} else {
	$session->message('No page was selected.');
	redirect('manage-pages.php');
}

?>