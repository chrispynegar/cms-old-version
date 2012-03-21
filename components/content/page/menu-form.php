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

<label for="page" class="label">Page</label>
<select name="page" id="page" class="select input">
	<?php $pages = Page::find_all(); ?>
	<?php foreach($pages as $page): ?>
	<option value="<?php echo $page->id; ?>"><?php echo $page->name; ?></option>
	<?php endforeach; ?>
</select>