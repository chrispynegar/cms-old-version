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

if(isset($_GET['id'])) {
	$category_id = $_GET['id'];
	$category = Category::find_by_id($category_id);
	$category_name = $category->name;
	$date_created = $category->date_created;
} else {
	$session->message('No category was selected.');
	redirect('manage-categories.php');
}

if(isset($_POST['submit'])) {
	$category = new Category();
	$category->id = $category_id;
	$category->name = trim($_POST['name']);
	$category->parent_category = trim($_POST['parent_category']);
	$category->notes = trim($_POST['notes']);
	$category->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$category->date_created = $date_created;
	if($form->required($category->name, 'Category name')) {
		if($category->name != $category_name) {
			if(Category::find_by_name($category->name)) {
				$valid_name = FALSE;
			} else {
				$valid_name = TRUE;
			}
		} else {
			$valid_name = TRUE;
		}
		if($valid_name == FALSE) {
			$session->message('This category name already exists, please choose another.');
		} else {
			if($category->save()) {
				$session->message('This category was successfully saved.');
			} else {
				$session->message('This category could not be saved');
			}
		}
	}
}

// set page title
$title = 'Edit Category: '.$category->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<?php // open form ?>
<form action="edit-category.php?id=<?php echo $category_id; ?>" method="post">
	<?php // category name ?>
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $category->name; ?>" />
	<?php // category parent ?>
	<label for="parent_category" class="label">Parent Category</label>
	<select name="parent_category" class="select input">
		<?php
			$categories = Category::find_all();
			foreach($categories as $cat):
			if($cat->id == $category->parent_category) {
				$selected = ' selected';
			} elseif($cat->id == $category->id) {
				$selected = ' disabled';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $cat->id; ?>"<?php echo $selected; ?>><?php echo $cat->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // notes ?>
	<label for="notes" class="label">Notes</label>
	<textarea name="notes" id="notes" class="textarea input"><?php echo $category->notes; ?></textarea>
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