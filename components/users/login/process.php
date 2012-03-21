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

require_once('../../../library/load.php');

if(isset($_POST['login_submit'])) {
	$username = trim($_POST['login_username']);
	$password = trim($_POST['login_password']);
	if(isset($_POST['currenturl'])) {
		$lasturl = trim($_POST['currenturl']);
	}
	$found_user = User::authenticate($username, $password);
	if($found_user) {
		$session->login($found_user);
		$session->message('You are now logged in.');
		if(isset($lasturl)) {
			redirect($lasturl);
		} else {
			redirect(SITE_URL);
		}
	} else {
		$session->message('Login credentials were incorrect.');
	}
}

if(isset($_GET['logout'])) {
	$session->logout();
	$session->message('You are now logged out.');
	redirect(SITE_URL);
}

if(!$_GET) {
	redirect(SITE_URL);
}

?>