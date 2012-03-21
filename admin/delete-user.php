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
	$user = User::find_by_id($_GET['id']);
	if($user->delete()) {
		if(file_exists('../users/'.$user->username)) {
			if(rmdir('../users/'.$user->username)) {
				$session->message('This user was successfully deleted.');
				redirect('manage-users.php');
			} else {
				$session->message('This user was deleted but could not delete users directory.');
				redirect('manage-users.php');
			}
		} else {
			$session->message('This user was deleted but could not detect users directory to delete.');
			redirect('manage-users.php');
		}
	} else {
		$session->message('This user could not be deleted.');
		redirect('manage-users.php');
	}
} else {
	$session->message('No user was selected.');
	redirect('manage-users.php');
}

?>