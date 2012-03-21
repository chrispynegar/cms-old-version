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
$title = 'Manage Articles';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-article.php" class="toolbar-button" title="Create New Article"><img src="images/icons/add.png" />Add</a>
    <a href="#" name="settings_window" class="activate-modal toolbar-button" title="Modify Page Settings"><img src="images/icons/process.png" />Settings</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Hits</th>
		<th>Category</th>
		<th>Author</th>
		<th></th>
		<th></th>
	</tr>
	<?php
		$articles = Article::find_all();
		foreach($articles as $article):
		$category = Category::find_by_id($article->category);
		$author = User::find_by_id($article->author);
	?>
	<tr>
		<td><?php echo $article->id; ?></td>
		<td><?php echo $article->name; ?></td>
		<td><?php echo $article->hits; ?></td>
		<td><?php echo $category->name; ?></td>
		<td><?php echo $author->username; ?></td>
		<td><a href="./edit-article.php?id=<?php echo $article->id; ?>" title="Edit <?php echo $article->name; ?>">Edit</a></td>
		<td><a href="./delete-article.php?id=<?php echo $article->id; ?>" title="Delete <?php echo $article->name; ?>" onclick="return confirm('Are you sure you want to delete this article?');">Delete</a></td>
	</tr>
	<?php endforeach; ?>
</table>

<div id="modal-mask" class="close-modal"></div>
<div id="settings_window" class="modal-window">
	<h3>Article Settings</h3>
</div>
<div id="help_window" class="modal-window">
	<h3>Managing Articles Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>