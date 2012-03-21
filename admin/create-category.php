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

// if the form is submitted
if(isset($_POST['submit'])) {
	// create a new instance of the category class
	$category = new Category();
	$category->parent_category = trim($_POST['parent_category']);
	$category->name = trim($_POST['name']);
	$category->notes = trim($_POST['notes']);
	$category->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$category->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($category->name, 'Name')) {
		if(Category::find_by_name($category->name)) {
			$session->message('A category with this name already exists, please choose another.');
		} else {
			if($category->save()) {
				$session->message('New category successfully saved.');
			} else {
				$session->message('This category could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create Category';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="create-category.php" method="post">
	<label for="name" class="label">Name</label>
	<?php
		if(isset($category->name)) {
			$name = $category->name;
		} else {
			$name = NULL;
		}
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<label for="parent_category" class="label">Parent Category</label>
	<select name="parent_category" id="parent_category" class="select input">
		<?php
			if(isset($category->parent_category)) {
				if($category->parent_category == 0) {
					$selected = ' selected';
				} else {
					$selected = NULL;
				}
			} else {
				$selected = NULL;
			}
		?>
		<option value="0"<?php echo $selected; ?>>None</option>
		<?php
			$categories = Category::find_all();
			foreach($categories as $cat):
			if(isset($category->parent_category)) {
				if($category->parent_category == $cat->id) {
					$selected = ' selected';
				} else {
					$selected = NULL;
				}
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $cat->id; ?>"<?php echo $selected; ?>><?php echo $cat->name; ?></option>
		<?php endforeach; ?>
	</select>
	<label for="notes" class="label">Notes</label>
	<?php
		if(isset($category->notes)) {
			$notes = $category->notes;
		} else {
			$notes = NULL;
		}
	?>
	<textarea name="notes" id="notes" class="textarea input"><?php echo $notes; ?></textarea>
	<input type="submit" name="submit" class="button input" value="Save" />
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>