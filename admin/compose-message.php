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

// form is submitted
if(isset($_POST['submit'])) {
	$message = new Message();
	$message->sender = $session->user_id;
	$message->recipient = trim($_POST['recipient']);
	$message->subject = trim($_POST['subject']);
	$message->message = trim($_POST['message']);
	$message->recieved = 0;
	$message->date_sent = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($message->message, 'Message body')) {
		if($message->subject == NULL) {
			$message->subject = 'No subject';
		}
		if($message->save()) {
			$session->message('You message was sent');
		} else {
			$session->message('Your message could not be sent.');
		}
	}
}

// set page title
$title = 'Compose Message';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="compose-message.php" method="post">
	<label for="recipient" class="label">Recipient</label>
	<select name="recipient" id="recipient" class="select input">
		<?php
			$users = User::find_all();
			foreach($users as $user):
			if($user->id == $session->user_id) {
				$disabled = ' disabled';
			} else {
				$disabled = NULL;
			}
		?>
		<option value="<?php echo $user->id; ?>"<?php echo $disabled; ?>><?php echo $user->fullname(); ?></option>
		<?php endforeach; ?>
	</select>
	<label for="subject" class="label">Subject</label>
	<input type="text" name="subject" id="subject" class="textbox input" value="" />
	<label for="message" class="label">Message</label>
	<textarea name="message" id="message" class="textarea input"></textarea>
	<input type="submit" name="submit" class="button input" value="Send" />
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>