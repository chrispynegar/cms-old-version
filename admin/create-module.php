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

if(isset($_GET['module'])) {
	$module_id = $_GET['module'];
	$module = Module::find_by_id($module_id);
} else {
	$session->message('No module selected.');
	redirect('manage-modules.php');
}

if(isset($_POST['submit'])) {
	$item = new ModuleItem();
	$item->name = trim($_POST['name']);
	$item->position = 1;
	require('../components/'.$module->directory.'/module-save.php');
	$item->parameters = $item_params;
	$item->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$item->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($item->name, 'Name')) {
		if(ModuleItem::find_by_name($item->name)) {
			$session->message('A module with this name already exists, please choose another.');
		} else {
			if($item->save()) {
				$session->message('This module was successfully saved.');
			} else {
				$session->message('This module could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create Module - '.$module->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="create-module.php?module=<?php echo $module_id; ?>" method="post">
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="" />
	<?php // item specific options ?>
	<?php require('../components/'.$module->directory.'/module-form.php'); ?>
	<?php // new module submission form ?>
	<input type="submit" name="submit" class="button input" value="Save" />
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>