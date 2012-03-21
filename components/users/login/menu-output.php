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

<?php if($session->is_logged_in()): ?>

<p>You are already logged in, <a href="components/users/login/process.php?a=<?php echo $_GET['a']; ?>&amp;logout=true" title="Log Out">Click here to log out</a>.</p>
	
<?php endif; ?>

<?php if(!$session->is_logged_in()): ?>
	
<form action="components/<?php echo $menutype->directory; ?>/process.php?a=<?php echo $_GET['a']; ?>" method="post">
	<label for="login_username" class="label">Username</label>
	<input type="text" name="login_username" id="login_username" class="textbox input" value="" />
	<label for="login_password" class="label">Password</label>
	<input type="password" name="login_password" id="login_password" class="textbox input" value="" />
	<p>Not got an account? <a href="<?php echo SITE_URL; ?>index.php?system=register">Register here</a>.</p>
	<input type="submit" name="login_submit" class="button input" value="Log In" />
</form>	
	
<?php endif; ?>