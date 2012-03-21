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

// get the menu
if(isset($_GET['id'])) {
	$menu_id = $_GET['id'];
	if($menu = Menu::find_by_id($menu_id)) {
		// menu found
		$menu_name = $menu->name;
		$date_created = $menu->date_created;
	} else {
		$session->message('No menu with this ID was found.');
		redirect('manage-menus.php');
	}
} else {
	$session->message('No menu was selected.');
	redirect('manage-menus.php');
}

// if the form has been submitted
if(isset($_POST['submit'])) {
	// creat a new instance of the menu class
	$menu = new Menu();
	$menu->id = $menu_id;
	$menu->name = trim($_POST['name']);
	$menu->notes = trim($_POST['notes']);
	$menu->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$menu->date_created = $date_created;
	if($form->required($menu->name, 'Menu name')) {
		if($menu->name != $menu_name) {
			if(Menu::find_by_name($menu->name)) {
				$valid_name = FALSE;
			} else {
				$valid_name = TRUE;
			}
		} else {
			$valid_name = TRUE;
		}
		if($valid_name == FALSE) {
			$session->message('This menu name already exists, please choose another.');
		} else {
			// attempt to save the page
			if($menu->save()) {
				// page successfully saved
				$session->message('This menu was successfully saved.');
			} else {
				// page was not successfully saved
				$session->message('This menu could not be saved');
			}
		}
	}
}

// set page title
$title = 'Edit Menu: '.$menu->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

// build page content

?>

<?php // open form ?>
<form action="edit-menu.php?id=<?php echo $menu_id; ?>" method="post">
	<?php // name ?>
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $menu->name; ?>" />
	<?php // notes ?>
	<label for="notes" class="label">Notes</label>
	<textarea name="notes" id="notes" class="textarea input"><?php echo $menu->notes; ?></textarea>
	<?php // submission ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>