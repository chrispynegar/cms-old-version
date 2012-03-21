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

if($_GET['id']) {
	$user_id = $_GET['id'];
} else {
	$session->message('No user was selected.');
	redirect('manage-users.php');
}

// set page title
$title = 'My Albums';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-album.php?id=<?php echo $user_id; ?>" class="toolbar-button" title="Create New Album"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<?php if(Album::count_specific('author', $user_id) == 0): ?>
<p>No photos in album.</p>
<?php endif; ?>

<?php if(Album::count_specific('author', $user_id) != 0): ?>
<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$albums = Album::find_user_albums($user_id);
		foreach($albums as $album):
	?>
	<tr>
		<td><?php echo $album->id; ?></td>
		<td><a href="./view-album.php?id=<?php echo $album->id; ?>" title="View <?php echo $album->name; ?>"><?php echo $album->name; ?></a></td>
		<td><a href="./edit-album.php?id=<?php echo $album->id; ?>" title="Edit <?php echo $album->name; ?>">Edit</a></td>
		<td><a href="./delete-album.php?id=<?php echo $album->id; ?>" title="Delete <?php echo $album->name; ?>" onclick="return confirm('Are you sure you want to delete this album?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>

<div id="modal-mask" class="close-modal"></div>
<div id="help_window" class="modal-window">
	<h3>Managing Albums Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>