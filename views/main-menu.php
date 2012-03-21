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
<ul class="<?php echo $menuclass; ?>">
	<?php foreach($items as $item): ?>
	<?php
		if(isset($_GET['a'])) {
			if($_GET['a'] == $item->alias) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		} elseif(!isset($_GET['a']) && $item->id == 1) { 
			$selected = ' selected';
		} else {
			$selected = NULL;
		}
	?>
	<li><a href="index.php?a=<?php echo $item->alias; ?>" class="<?php echo $itemclass.$selected; ?>"><?php echo $item->name; ?></a></li>
	<?php endforeach; ?>
</ul>