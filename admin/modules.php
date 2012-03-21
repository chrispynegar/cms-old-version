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
$title = 'Select Modules';

// load template header
require(ADMIN_TEMPLATE.'header.php');

$modules = Module::find_all_by_name();

?>

<ul class="selectlist">
	<?php foreach($modules as $module): ?>
	<li><a href="create-module.php?module=<?php echo $module->id; ?>" title="<?php echo $module->brief; ?>"><?php echo $module->name; ?></a></li>
	<?php endforeach; ?>
</ul>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>