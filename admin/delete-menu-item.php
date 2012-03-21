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
	$item = MenuItem::find_by_id($_GET['id']);
	if($_GET['id'] == 1) {
		$session->message('You cannot delete the default menu item.');
	} elseif($item->delete()) {
		$session->message('This item was successfully deleted.');
	} else {
		$session->message('This item could not be deleted.');
	}
	redirect('manage-menu-items.php?menu='.$_GET['menu']);
} else {
	$session->message('No item was selected.');
	if(!$_GET['menu']) {
		redirect('manage-menus.php');
	} else {
		redirect('manage-menu-items.php?menu='.$_GET['menu']);
	}
}

?>