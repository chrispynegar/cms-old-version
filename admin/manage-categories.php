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
$title = 'Manage Categories';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-category.php" class="toolbar-button" title="Create New Category"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="" class="toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Parent</th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$categories = Category::find_all();
		foreach($categories as $category):
	?>
	<tr>
		<td><?php echo $category->id; ?></td>
		<td><?php echo $category->name; ?></td>
		<?php
			if($category->parent_category == 0) {
				$parent = 'None';
			} else {
				$find_parent = Category::find_by_id($category->parent_category);
				$parent = $find_parent->name;
			}
		?>
		<td><?php echo $parent; ?></td>
		<td><a href="./edit-category.php?id=<?php echo $category->id; ?>" title="Edit <?php echo $category->name; ?>">Edit</a></td>
		<td><a href="./delete-category.php?id=<?php echo $category->id; ?>" title="Delete <?php echo $category->name; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>