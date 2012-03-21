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

// check that the menu has been retrieved
if($_GET['menu']) {
	$menu_id = $_GET['menu'];
} else {
	$session->message('No menu selected.');
	redirect('manage-menus.php');
}

// set page title
$title = 'Select Menu Type';

// load template header
require(ADMIN_TEMPLATE.'header.php');

$menu_types = MenuType::find_all_by_name();

?>

<div class="toolbar">
	<a href="./manage-menu-items.php?menu=<?php echo $menu_id; ?>" class="button input">Manage Menu Items</a>
</div>

<ul class="selectlist">
	<?php foreach($menu_types as $type): ?>
	<li><a href="./create-menu-item.php?menu=<?php echo $menu_id; ?>&amp;type=<?php echo $type->id; ?>" title="<?php echo $type->brief; ?>"><?php echo $type->name; ?></a></li>
	<?php endforeach; ?>
</ul>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>