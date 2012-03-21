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

// page is submitted
if(isset($_POST['submit'])) {
	// create a new instance of the article class
	$article = new Article();
	$article->author = trim($_POST['author']);
	$article->category = trim($_POST['category']);
	$article->name = trim($_POST['name']);
	$article->content = trim($_POST['content']);
	$article->keywords = trim($_POST['keywords']);
	$article->description = trim($_POST['description']);
	$article->published = trim($_POST['published']);
	$article->comments = trim($_POST['comments']);
	$article->hits = 0;
	$article->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$article->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($article->name, 'Article name') && $form->required($article->content, 'Article content')) {
		if(Article::find_by_name($article->name)) {
			$session->message('Another article with this name already exists, please choose another.');
		} else {
			if($article->save()) {
				$session->message('This article was successfully saved.');
			} else {
				$session->message('This article could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create Article';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./manage-articles.php" class="toolbar-button" title="Back to Manage Articles" onclick="return confirm('Any unsaved changes will be lost. Continue?');"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="create-article.php" method="post">
	<?php // name ?>
	<label for="name" class="label">Name</label>
	<?php
		if(isset($article->name)) {
			$name = $article->name;
		} else {
			$name = NULL;
		}
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<?php // published ?>
	<label for="published" class="label">Published</label>
	<?php
		if(isset($article->published)) {
			if($article->published == 0) {
				$published1 = ' checked';
				$published2 = NULL;
			} else {
				$published1 = NULL;
				$published2 = ' checked';
			}
		} else {
			$published1 = NULL;
			$published2 = ' checked';
		}
	?>
	<input type="radio" name="published" id="published1" class="radio input" value="0"<?php echo $published1; ?> />
	<label for="published1" class="radiolabel">No</label>
	<input type="radio" name="published" id="published2" class="radio input" value="1"<?php echo $published2; ?> />
	<label for="published2" class="radiolabel">Yes</label>
	<?php // category ?>
	<label for="category" class="label">Category</label>
	<select name="category" id="category" class="select input">
		<?php
			$categories = Category::find_all();
			foreach($categories as $category):
		?>
		<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // content ?>
	<label for="content" class="label">Content</label>
	<?php
		if(isset($article->content)) {
			$content = $article->content;
		} else {
			$content = NULL;
		}
	?>
	<textarea name="content" id="content" class="textarea input editor"><?php echo $content; ?></textarea>
	<?php // comments ?>
	<label for="comments" class="label">Comments</label>
	<?php
		if(isset($article->comments)) {
			if($article->comments == 0) {
				$comments1 = ' checked';
				$comments2 = NULL;
			} else {
				$comments1 = NULL;
				$comments2 = ' checked';
			}
		} else {
			$comments1 = NULL;
			$comments2 = ' checked';
		}
	?>
	<input type="radio" name="comments" id="comments1" class="radio input" value="0"<?php echo $comments1; ?> />
	<label for="comments1" class="radiolabel">No</label>
	<input type="radio" name="comments" id="comments2" class="radio input" value="1"<?php echo $comments2; ?> />
	<label for="comments2" class="radiolabel">Yes</label>
	<?php // author ?>
	<label for="author" class="label">Author</label>
	<select name="author" id="author" class="select input">
		<?php
			$users = User::find_all();
			foreach($users as $user):
			if($session->user_id == $user->id) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $user->id; ?>" <?php echo $selected; ?>><?php echo $user->username; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // keywords ?>
	<label for="keywords" class="label">Meta Keywords</label>
	<?php
		if(isset($article->keywords)) {
			$keywords = $article->keywords;
		} else {
			$keywords = NULL;
		}
	?>
	<input type="text" name="keywords" id="keywords" class="textbox input" value="<?php echo $keywords; ?>" />
	<?php // description ?>
	<label for="description" class="label">Meta Description</label>
	<?php
		if(isset($article->description)) {
			$description = $article->description;
		} else {
			$description = NULL;
		}
	?>
	<input type="text" name="description" id="description" class="textbox input" value="<?php echo $description; ?>" />
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