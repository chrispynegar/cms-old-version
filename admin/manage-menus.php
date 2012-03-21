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
$title = 'Manage Menus';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-menu.php" class="toolbar-button" title="Create New Menu"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="" class="toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Menu Name</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$menus = Menu::find_all();
		foreach($menus as $menu):
	?>
	<tr>
		<td><?php echo $menu->id; ?></td>
		<td><?php echo $menu->name; ?></td>
		<td><a href="./manage-menu-items.php?menu=<?php echo $menu->id; ?>" title="Manage Items in <?php echo $menu->name; ?>">Manage Items</a></td>
		<td><a href="./edit-menu.php?id=<?php echo $menu->id; ?>" title="Edit <?php echo $menu->name; ?>">Edit</a></td>
		<td><a href="./delete-menu.php?id=<?php echo $menu->id; ?>" title="Delete <?php echo $menu->name; ?>" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>