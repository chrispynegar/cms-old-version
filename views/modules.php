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

?>

<ul class="modules">

<?php
	foreach($modules as $module):
	$type = Module::find_by_id($module->type);
?>

	<li class="module">
		<h3><?php echo $module->name; ?></h3>
		<?php require('components/'.$type->directory.'/module-output.php'); ?>
	</div>

<?php endforeach; ?>

</ul>