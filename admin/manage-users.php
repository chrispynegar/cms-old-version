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
$title = 'Manage Users';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-user.php" class="toolbar-button" title="Create New User"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Access</th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$users = User::find_all();
		foreach($users as $user):
		$permission = Permission::find_by_id($user->permission);
	?>
	<tr>
		<td><?php echo $user->id; ?></td>
		<td><a href="./profile.php?id=<?php echo $user->id; ?>" title="View <?php echo $user->username; ?>"><?php echo $user->username; ?></a></td>
		<td><?php echo $permission->name; ?></td>
		<td><a href="./edit-user.php?id=<?php echo $user->id; ?>" title="Edit <?php echo $user->username; ?>">Edit</a></td>
		<td><a href="./delete-user.php?id=<?php echo $user->id; ?>" title="Delete <?php echo $user->username; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<div id="modal-mask" class="close-modal"></div>
<div id="help_window" class="modal-window">
	<h3>Managing Users Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>