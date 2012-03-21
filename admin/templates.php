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
$title = 'Manage Templates';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Type</th>
		<th>Active</th>
		<th></th>
	</tr>
	<?php $templates = Template::find_all(); ?>
	<?php foreach($templates as $template): ?>
	<tr>
		<td><?php echo $template->id; ?></td>
		<td><?php echo $template->name; ?></td>
		<td><?php echo $template->type; ?></td>
		<?php
			if($template->active == 1) {
				$active = 'Yes';
			} else {
				$active = 'No';
			}
		?>
		<td><?php echo $active; ?></td>
		<td><a href="#" title="Set Template as Active">Set Active</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>