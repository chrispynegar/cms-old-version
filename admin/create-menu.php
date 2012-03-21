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

// if the form has been submitted
if(isset($_POST['submit'])) {
	// creat a new instance of the menu class
	$menu = new Menu();
	$menu->name = trim($_POST['name']);
	$menu->notes = trim($_POST['notes']);
	$menu->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$menu->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($menu->name, 'Menu name')) {
		if(Menu::find_by_name($menu->name)) {
			$session->message('A menu with this name already exists.');
		} else {
			if($menu->save()) {
				$session->message('This menu has been successfully saved.');
			} else {
				$session->message('This menu could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create Menu';

// load template header
require(ADMIN_TEMPLATE.'header.php');

// build page content

?>

<?php // open form ?>
<form action="create-menu.php" method="post">
	<?php // menu name ?>
	<label for="name" class="label">Name</label>
	<?php 
		if(isset($menu->name)) {
			$name = $menu->name;
		} else {
			$name = NULL;
		} 
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<?php // menu notes ?>
	<label for="notes" class="label">Notes</label>
	<?php
		if(isset($menu->notes)) {
			$notes = $menu->notes;
		} else {
			$notes = NULL;
		}
	?>
	<textarea name="notes" id="notes" class="textarea input"><?php echo $notes; ?></textarea>
	<?php // submission button ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>