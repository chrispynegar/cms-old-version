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

<form action="components/users/login/process.php" method="post">
	<label for="mod_login_username" class="mod-label">Username</label>
	<input type="text" name="login_username" id="mod_login_username" class="mod-textbox mod-input" value="" />
	<label for="mod_login_password" class="mod-label">Password</label>
	<input type="password" name="login_password" id="mod_login_password" class="mod-textbox mod-input" value="" />
	<input type="hidden" name="currenturl" value="<?php echo currenturl(); ?>" />
	<p>Not got an account? <a href="<?php echo SITE_URL; ?>index.php?system=register">Register here</a>.</p>
	<input type="submit" name="login_submit" class="mod-button mod-input" value="Log In" />
</form>

<?php endif; ?>

<?php if($session->is_logged_in()): ?>

<p>You are already logged in, <a href="components/users/login/process.php?a=<?php echo $_GET['a']; ?>&amp;logout=true" title="Log out">log out</a>.</p>

<?php endif; ?>