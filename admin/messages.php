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

if(isset($_POST['submit'])) {
	echo 'submitted';
}

// set page title
$title = 'My Messages';

// load template header
require(ADMIN_TEMPLATE.'header.php');

// get users inbox
$inbox_messages = Message::find_by_recipient($session->user_id);

?>

<div class="toolbar">
	<a href="#" name="new_message_window" class="activate-modal toolbar-button" title="New Message"><img src="images/icons/new_page.png" />New</a>
	<a href="#" name="settings_window" class="activate-modal toolbar-button" title="Modify Message Settings"><img src="images/icons/process.png" />Settings</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>From</th>
		<th>Subject</th>
        <th>Read</th>
		<th></th>
	</tr>
	<?php foreach($inbox_messages as $message): ?>
    <?php
		if($message->recieved == 0) {
			$is_read = 'No';
		} else {
			$is_read = 'Yes';
		}
		$user = User::find_by_id($message->sender);
		if($user == NULL) {
			$sender = 'User no longer exists';
		} else {
			$sender = $user->fullname();
		}
	?>
	<tr>
		<td><?php echo $message->id; ?></td>
		<td><?php echo $sender; ?></td>
		<td><?php echo $message->subject; ?></td>
        <td><?php echo $is_read; ?></td>
		<td><a href="message.php?id=<?php echo $message->id; ?>" title="Read Message">Read Message</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<div id="modal-mask" class="close-modal"></div>
<div id="new_message_window" class="modal-window">
	<h3>Write New Message</h3>
    <form action="./messages.php" method="post">
    	<label for="label" class="label">Subject</label>
        <input type="text" name="subject" id="subject" class="textbox input" value="" />
        <label for="message" class="label">Message</label>
        <textarea name="message" id="message" class="textarea input"></textarea>
        <div class="buttonset">
        	<input type="submit" name="submit" class="button input" value="Send" />
        </div>
    </form>
</div>
<div id="settings_window" class="modal-window">
	<h3>Message Settings</h3>
</div>
<div id="help_window" class="modal-window">
	<h3>Messages Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>