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

if($session->is_logged_in()) {
	Permission::access(4);
}

if(isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$found_user = User::authenticate($username, $password);
	if($found_user) {
		//Permission::access(4);
		$session->login($found_user);
		$session->message('Your now logged in.');
		redirect('index.php');
	} else {
		$session->message('Login credentials were incorrect.');
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Admin Log In</title>
	<link rel="stylesheet" href="../library/stylesheets/reset.css" />
	<link rel="stylesheet" media="screen" href="../templates/admin/default/css/login.css" />
</head>
<body>

	<form action="login.php" method="post" class="form">
		<fieldset class="fieldset">
			<legend class="legend">Admin Log In</legend>
			<?php if(isset($_SESSION['message'])) {
				echo '<p class="message">'.$_SESSION['message'].'</p>';
				unset($_SESSION['message']);
			} ?>
			<label for="username" class="label">Username</label>
			<input type="text" name="username" id="username" class="textbox input" value="" />
			<label for="password" class="label">Password</label>
			<input type="password" name="password" id="password" class="textbox input" value="" />
			<input type="submit" name="submit" class="button input" value="Log In" />
		</fieldset>
	</form>

</body>
</html>