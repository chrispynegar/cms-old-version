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

<p>You are already registered with us.</p>

<?php elseif(isset($_GET['register']) == TRUE): ?>
	
<p>Thank you, you are now a registered user with <?php echo $website->name; ?>, we have sent you a confirmation email.</p>

<?php else: ?>

<h2>Register</h2>

<form action="<?php echo SITE_URL; ?>components/users/register/process.php" method="post">
	<label for="register_username" class="label">Username</label>
	<?php
		if(isset($_GET['username'])) {
			$register_username = $_GET['username'];
		} else {
			$register_username = NULL;
		}
	?>
	<input type="text" name="register_username" id="register_username" class="textbox input" value="<?php echo $register_username; ?>" />
	<label for="register_email" class="label">Email Address</label>
	<?php
		if(isset($_GET['email'])) {
			$register_email = $_GET['email'];
		} else {
			$register_email = NULL;
		}
	?>
	<input type="text" name="register_email" id="register_email" class="textbox input" value="<?php echo $register_email; ?>" />
	<label for="register_first_name" class="label">First Name</label>
	<?php
		if(isset($_GET['first_name'])) {
			$register_first_name = $_GET['first_name'];
		} else {
			$register_first_name = NULL;
		}
	?>
	<input type="text" name="register_first_name" id="register_first_name" class="textbox input" value="<?php echo $register_first_name; ?>" />
	<label for="register_last_name" class="label">Last Name</label>
	<?php
		if(isset($_GET['last_name'])) {
			$register_last_name = $_GET['last_name'];
		} else {
			$register_last_name = NULL;
		}
	?>
	<input type="text" name="register_last_name" id="register_last_name" class="textbox input" value="<?php echo $register_last_name; ?>" />
	<label for="register_password1" class="label">Password</label>
	<input type="password" name="register_password1" id="register_password1" class="textbox input" value="" />
	<label for="register_password2" class="label">Re-Enter Password</label>
	<input type="password" name="register_password2" id="register_password2" class="textbox input" value="" />
	<input type="hidden" name="currenturl" value="<?php echo currenturl(); ?>" />
	<input type="submit" name="register_submit" class="button input" value="Register" />
</form>

<?php endif; ?>