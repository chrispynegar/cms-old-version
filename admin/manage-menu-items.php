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

// check that the menu id was passed
if((int)$_GET['menu']) {
	$menu_id = $_GET['menu'];
	$menu = Menu::find_by_id($menu_id);
} else {
	$session->message['No menu was selected'];
	redirect('manage-menus.php');
}

// set page title
$title = 'Manage Items: '.$menu->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<?php // menu-types.php?menu=<?php echo $menu_id; ?>

<div class="toolbar">
    <a href="#" name="select_menu_item" class="activate-modal toolbar-button" title="Create Add Menu Item"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Position</th>
		<th>Access</th>
		<th></th>
		<th></th>
	</tr>
	<?php $items = MenuItem::find_menu_items($menu_id); ?>
	<?php foreach($items as $item): ?>
	<?php
		if($item->access == 'all') {
			$access = 'All';
		} elseif($item->access == 'public') {
			$access = 'Public';
		} elseif($item->access == 'loggedin') {
			$access = 'Logged In';
		} elseif($item->access == 'special') {
			$access = 'Special';
		}
	?>
	<tr>
		<td><?php echo $item->id; ?></td>
		<td><?php echo $item->name; ?></td>
		<td><?php echo $item->position; ?></td>
		<td><?php echo $access; ?></td>
		<td><a href="./edit-menu-item.php?id=<?php echo $item->id; ?>" class="anchor">Edit</a></td>
		<td><a href="./delete-menu-item.php?menu=<?php echo $menu_id; ?>&amp;id=<?php echo $item->id; ?>" onclick="return confirm('Are you sure you want to delete this menu item?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<div id="modal-mask" class="close-modal"></div>

<div id="select_menu_item" class="modal-window">
	<h2>Select Menu Type</h2>
	<?php $menu_types = MenuType::find_all_by_name(); ?>
	<ul class="selectlist">
		<?php foreach($menu_types as $type): ?>
		<li><a href="./create-menu-item.php?menu=<?php echo $menu_id; ?>&amp;type=<?php echo $type->id; ?>" title="<?php echo $type->brief; ?>"><?php echo $type->name; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>