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

if(isset($_GET['id'])) {
	$item_id = $_GET['id'];
	$item = MenuItem::find_by_id($item_id);
	$menu_id = $item->menu;
	$type_id = $item->type;
	$item_name = $item->name;
	$item_alias = $item->alias;
	$position = $item->position;
	$date_created = $item->date_created;
	$type = MenuType::find_by_id($type_id);
} else {
	$session->message('No menu item selected.');
	redirect('manage-menus.php');
}

if(isset($_POST['submit'])) {
	$item = new MenuItem();
	$item->id = $item_id;
	$item->menu = $menu_id;
	$item->type = $type_id;
	$item->name = trim($_POST['name']);
	if($_POST['alias'] == NULL) {
		$item->alias = urlformat($item->name);
	} else {
		$item->alias = urlformat(trim($_POST['alias']));
	}
	$item->access = trim($_POST['access']);
	if($_POST['website_title'] == NULL) {
		$item->website_title = $item->name;
	} else {
		$item->website_title = trim($_POST['website_title']);
	}
	$item->position = $position;
	require('../components/'.$type->directory.'/menu-save.php');
	$item->parameters = $item_params;
	$item->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$item->date_created = $date_created;
	if($form->required($item->name, 'Name') && $form->required($item->alias, 'Alias')) {
		if($item->name != $item_name) {
			if(MenuItem::find_by_name($item->name)) {
				$valid_name = FALSE;
			} else {
				$valid_name = TRUE;
			}
		} else {
			$valid_name = TRUE;
		}
		if($item->alias != $item_alias) {
			if(MenuItem::find_by_alias($item->alias)) {
				$valid_alias = FALSE;
			} else {
				$valid_alias = TRUE;
			}
		} else {
			$valid_alias = TRUE;
		}
		if($valid_name == FALSE) {
			$session->message('This name already exists please choose another.');
		} elseif($valid_alias == FALSE) {
			$session->message('This alias already exists please choose another.');
		} else {
			if($item->save()) {
				$session->message('Menu item successfully saved.');
			} else {
				$session->message('This menu item could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Edit Item: '.$item->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="./edit-menu-item.php?id=<?php echo $item_id; ?>" method="post">
	<?php // name ?>
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $item->name; ?>" />
	<?php // alias ?>
	<label for="alias" class="label">Alias</label>
	<input type="text" name="alias" id="alias" class="textbox input" value="<?php echo $item->alias; ?>" />
	<?php // access ?>
	<label for="access" class="label">Access</label>
	<?php
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
	?>
	<select name="access" id="access" class="select input">
		<option value="all"<?php echo $selected1; ?>>All</option>
		<option value="public"<?php echo $selected2; ?>>Public only</option>
		<option value="loggedin"<?php echo $selected3; ?>>Logged in only</option>
		<option value="special"<?php echo $selected4; ?>>Special only</option>
	</select>
	<?php // website title ?>
	<label for="website_title" class="label">Website Title</label>
	<input type="text" name="website_title" id="website_title" class="textbox input" value="<?php echo $item->website_title; ?>" />
	<?php // item specific options ?>
	<?php require('../components/'.$type->directory.'/menu-form.php'); ?>
	<?php // item submission button ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>