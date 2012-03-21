<?php

/**
 * Develop21
 *
 * @package User Profile - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

if(isset($item->parameters)) {
	$params = $item->parameters;
	$param = explode(',', $params);
	$category = $param[0];
	$title_linkable = $param[1];
	$display_author = $param[2];
	$author_linkable = $param[3];
	$display_date = $param[4];
	// title linkable
	if($title_linkable == 1) {
		$title_linkable1 = NULL;
		$title_linkable2 = ' checked';
	} else {
		$title_linkable1 = ' checked';
		$title_linkable2 = NULL;
	}
	// display author
	if($display_author == 1) {
		$display_author1 = NULL;
		$display_author2 = ' checked';
	} else {
		$display_author1 = ' checked';
		$display_author2 = NULL;
	}
	// author linkable
	if($author_linkable == 1) {
		$author_linkable1 = NULL;
		$author_linkable2 = ' checked';
	} else {
		$author_linkable1 = ' checked';
		$author_linkable2 = NULL;
	}
	// display date
	if($display_date == 1) {
		$display_date1 = NULL;
		$display_date2 = ' checked';
	} else {
		$display_date1 = ' checked';
		$display_date2 = NULL;
	}
} else {
	$title_linkable1 = NULL;
	$title_linkable2 = ' checked';
	$display_author1 = NULL;
	$display_author2 = ' checked';
	$author_linkable1 = NULL;
	$author_linkable2 = ' checked';
	$display_date1 = NULL;
	$display_date2 = ' checked';
}

?>

<label for="category" class="label">Category</label>
<select name="category" class="select input">
	<?php
		$categories = Category::find_all();
		foreach($categories as $category):
		if(isset($item->parameters)) {
			if($param[0] == $category->id) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		} else {
			$selected = NULL;
		}
	?>
	<option value="<?php echo $category->id; ?>"<?php echo $selected; ?>><?php echo $category->name; ?></option>
	<?php endforeach; ?>
</select>

<label for="title_linkable" class="label">Title Linkable</label>
<input type="radio" name="title_linkable" id="title_linkable1" class="radio input" value="0"<?php echo $title_linkable1; ?> />
<label for="title_linkable1" class="radiolabel">No</label>
<input type="radio" name="title_linkable" id="title_linkable2" class="radio input" value="1"<?php echo $title_linkable2; ?> />
<label for="title_linkable2" class="radiolabel">Yes</label>

<label for="display_author" class="label">Display Author</label>
<input type="radio" name="display_author" id="display_author1" class="radio input" value="0"<?php echo $display_author1; ?> />
<label for="display_author1" class="radiolabel">No</label>
<input type="radio" name="display_author" id="display_author2" class="radio input" value="1"<?php echo $display_author2; ?> />
<label for="display_author2" class="radiolabel">Yes</label>

<label for="author_linkable" class="label">Author Linkable</label>
<input type="radio" name="author_linkable" id="author_linkable1" class="radio input" value="0"<?php echo $author_linkable1; ?> />
<label for="author_linkable1" class="radiolabel">No</label>
<input type="radio" name="author_linkable" id="author_linkable2" class="radio input" value="1"<?php echo $author_linkable2; ?> />
<label for="author_linkable2" class="radiolabel">Yes</label>

<label for="display_date" class="label">Display Date</label>
<input type="radio" name="display_date" id="display_date1" class="radio input" value="0"<?php echo $display_date1; ?> />
<label for="display_date1" class="radiolabel">No</label>
<input type="radio" name="display_date" id="display_date2" class="radio input" value="1"<?php echo $display_date2; ?> />
<label for="display_date2" class="radiolabel">Yes</label>