<?php

/**
 * Develop21
 *
 * @package User Register - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

require('../../../library/load.php');

if(isset($_POST['register_submit'])) {
	$username = trim($_POST['register_username']);
	$email = trim($_POST['register_email']);
	$first_name = trim($_POST['register_first_name']);
	$last_name = trim($_POST['register_last_name']);
	$password1 = trim($_POST['register_password1']);
	$password2 = trim($_POST['register_password2']);
	$user = new User();
	$user->register_user($username, $email, $first_name, $last_name, $password1, $password2);
	redirect(SITE_URL.'index.php?system=register&username='.$username.'&email='.$email.'&first_name='.$first_name.'&last_name='.$last_name);
}

?>