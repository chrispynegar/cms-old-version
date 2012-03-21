<?php

/**
 * Develop21
 *
 * @package User Login - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

global $session;

?>

<?php if(!$session->is_logged_in()): ?>

<h2>Log In</h2>

<form action="<?php echo SITE_URL; ?>components/users/login/process.php" method="post">
	<label for="login_username" class="label">Username</label>
	<input type="text" name="login_username" id="login_username" class="textbox input" value="" />
	<label for="login_password" class="label">Password</label>
	<input type="password" name="login_password" id="login_password" class="textbox input" value="" />
	<input type="hidden" name="currenturl" value="<?php echo currenturl(); ?>" />
	<p>Not got an account? <a href="<?php echo SITE_URL; ?>index.php?system=register">Register here</a>.</p>
	<input type="submit" name="login_submit" class="button input" value="Log In" />
</form>

<?php endif; ?>

<?php if($session->is_logged_in()): ?>

<p>You are already logged in, <a href="<?php echo SITE_URL; ?>components/users/login/process.php?logout=true" title="Log out">log out</a>.</p>

<?php endif; ?>