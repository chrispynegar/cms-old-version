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
$title = 'Manage Pages';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-page.php" class="toolbar-button" title="Create New Page"><img src="images/icons/add.png" />Add</a>
    <a href="#" name="settings_window" class="activate-modal toolbar-button" title="Modify Page Settings"><img src="images/icons/process.png" />Settings</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<?php if(Page::count_all() != 0): ?>
<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Author</th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$pages = Page::find_all();
		foreach($pages as $page):
		$author = User::find_by_id($page->author);
	?>
	<tr>
		<td><?php echo $page->id; ?></td>
		<td><?php echo $page->name; ?></td>
		<td><?php echo $author->username; ?></td>
		<td><a href="./edit-page.php?id=<?php echo $page->id; ?>" title="Edit <?php echo $page->name; ?>">Edit</a></td>
		<td><a href="./delete-page.php?id=<?php echo $page->id; ?>" title="Delete <?php echo $page->name; ?>" onclick="return confirm('Are you sure you want to delete this page?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>

<?php if(Page::count_all() == 0): ?>
	<p>No pages have been created yet.</p>
<?php endif; ?>

<div id="modal-mask" class="close-modal"></div>
<div id="settings_window" class="modal-window">
	<h3>Page Settings</h3>
</div>
<div id="help_window" class="modal-window">
	<h3>Managing Pages Help</h3>
</div>



<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>