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

// make sure that the menu and menu type ids are passed
if($_GET['menu']) {
	$menu_id = $_GET['menu'];
	$menu = Menu::find_by_id($menu_id);
	if($_GET['type']) {
		$type_id = $_GET['type'];
		$type = MenuType::find_by_id($type_id);
	} else {
		$session->message('You must select a menu type.');
		redirect('menu-types.php?menu='.$menu_id);
	}
} else {
	$session->message('No menu was selected');
	redirect('manage-menus.php');
}

if(isset($_POST['submit'])) {
	// create a new instance of the menu item
	$item = new MenuItem();
	// menu
	$item->menu = $menu_id;
	// type
	$item->type = $type_id;
	// item name
	$item->name = trim($_POST['name']);
	// item alias
	if($_POST['alias'] == NULL) {
		$item->alias = urlformat($item->name);
	} else {
		$item->alias = urlformat(trim($_POST['alias']));
	}
	// access
	$item->access = trim($_POST['access']);
	// website title
	if($_POST['website_title'] == NULL) {
		$item->website_title = $item->name;
	} else {
		$item->website_title = trim($_POST['website_title']);
	}
	// item position
	//$item->position = MenuItem::count_specific('menu', $menu_id) + 1;
	// get highest position
	$highest_position = MenuItem::get_highest_position($menu_id);
	// add 1 to highest position
	$next_position = $highest_position->position + 1;
	// define new value
	$item->position = $next_position;
	// item parameters
	require('../components/'.$type->directory.'/menu-save.php');
	$item->parameters = $item_params;
	// item dates
	$item->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$item->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($item->name, 'Name')) {
		if(MenuItem::find_by_name($item->name, $menu_id)) {
			$session->message('A menu item with this name already exists in this menu.');
		} elseif(MenuItem::find_by_alias($item->alias)) {
			$session->message('A menu item with this alias already exists in the system.');
		} else {
			if($item->save()) {
				$session->message('This menu item was successfully saved.');
			} else {
				$session->message('This menu item could not be saved.');
			}
		}
	}
}

// set page title
$title = $menu->name.' - Create Menu Item: '.$type->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="#" name="" class="toolbar-button" title="Modify Page Settings"><img src="images/icons/process.png" />Settings</a>
    <a href="./manage-menu-items.php?menu=<?php echo $menu_id; ?>" class="toolbar-button" title="Back to Manage Menu Items"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="./create-menu-item.php?menu=<?php echo $menu_id; ?>&amp;type=<?php echo $type_id; ?>" method="post">
	<?php // item name ?>
	<label for="name" class="label">Name</label>
	<?php
		if(isset($item->name)) {
			$name = $item->name;
		} else {
			$name = NULL;
		}
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<?php // item alias ?>
	<label for="alias" class="label">Alias</label>
	<?php
		if(isset($item->alias)) {
			$alias = $item->alias;
		} else {
			$alias = NULL;
		}
	?>
	<input type="text" name="alias" id="alias" class="textbox input" value="<?php echo $alias; ?>" />
	<?php // item access ?>
	<label for="access" class="label">Access</label>
	<select name="access" id="access" class="select input">
		<?php
			if(isset($item->access)) {
				if($item->access == 'all') {
					$selected1 = ' selected';
					$selected2 = NULL;
					$selected3 = NULL;
					$selected4 = NULL;
				} elseif($item->access == 'public') {
					$selected1 = NULL;
					$selected2 = ' selected';
					$selected3 = NULL;
					$selected4 = NULL;
				} elseif($item->access == 'loggedin') {
					$selected1 = NULL;
					$selected2 = NULL;
					$selected3 = ' selected';
					$selected4 = NULL;
				} elseif($item->access == 'special') {
					$selected1 = NULL;
					$selected2 = NULL;
					$selected3 = NULL;
					$selected4 = ' selected';
				}
			} else {
				$selected1 = ' selected';
				$selected2 = NULL;
				$selected3 = NULL;
				$selected4 = NULL;
			}
		?>
		<option value="all"<?php echo $selected1; ?>>All</option>
		<option value="public"<?php echo $selected2; ?>>Public only</option>
		<option value="loggedin"<?php echo $selected3; ?>>Logged in only</option>
		<option value="special"<?php echo $selected4; ?>>Special only</option>
	</select>
	<?php // website title ?>
	<label for="website_title" class="label">Website Title</label>
	<?php
		if(isset($item->website_title)) {
			$website_title = $item->website_title;
		} else {
			$website_title = NULL;
		}
	?>
	<input type="text" name="website_title" id="website_title" class="textbox input" value="<?php echo $website_title; ?>" />
	<?php // item specific options ?>
	<?php require('../components/'.$type->directory.'/menu-form.php'); ?>
	<?php // item submission button ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>