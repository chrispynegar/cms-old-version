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

// set page title
$title = 'My Messages';

// load template header
require(ADMIN_TEMPLATE.'header.php');

// get users inbox
$inbox_messages = Message::find_by_recipient($session->user_id);

?>

<table class="table">
	<tr>
		<th>ID</th>
		<th>From</th>
		<th>Subject</th>
		<th></th>
	</tr>
	<?php foreach($inbox_messages as $message): ?>
	<tr>
		<td><?php echo $message->id; ?></td>
		<?php
			$sender = User::find_by_id($message->sender);
		?>
		<td><?php echo $sender->fullname(); ?></td>
		<td><?php echo $message->subject; ?></td>
		<td><a href="message.php?id=<?php echo $message->id; ?>" title="Read Message">Read Message</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>