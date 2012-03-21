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

// check that there is an ID value to be retrieved
if($_GET['id']) {
	// there is value
	$page_id = $_GET['id'];
	if($page = Page::find_by_id($_GET['id'])) {
		// page found
		$page_name = $page->name;
		$date_created = $page->date_created;
	} else {
		// invalid id no page found
		$session->message('No page was selected.');
		redirect('manage-pages.php');
	}
} else {
	$session->message('You must select a page to edit.');
	redirect('manage-pages.php');
}

// the form is submitted
if(isset($_POST['submit'])) {
	// create a new instance of the page class
	$page = new Page();
	$page->id = $_GET['id'];
	$page->author = trim($_POST['author']);
	$page->name = trim($_POST['name']);
	$page->content = trim($_POST['content']);
	$page->published = trim($_POST['published']);
	$page->keywords = trim($_POST['keywords']);
	$page->description = trim($_POST['description']);
	$page->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$page->date_created = $date_created;
	// check that 
	// check the required fields
	if($form->required($page->name, 'Page name') && $form->required($page->content, 'Page content')) {
		if($page->name != $page_name) {
			if(Page::find_by_name($page->name)) {
				$valid_name = FALSE;
			} else {
				$valid_name = TRUE;
			}
		} else {
			$valid_name = TRUE;
		}
		if($valid_name == FALSE) {
			$session->message('This page name already exists, please choose another.');
		} else {
			// attempt to save the page
			if($page->save()) {
				// page successfully saved
				$session->message('This page was successfully saved.');
			} else {
				// page was not successfully saved
				$session->message('This page could not be saved');
			}
		}
	}
}

// set page title
$title = 'Edit Page: '.$page->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

// start outputting page content

?>

<div class="toolbar">
    <a href="./manage-pages.php" class="toolbar-button" title="Back to Manage Pages" onclick="return confirm('Any unsaved changes will be lost. Continue?');"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="edit-page.php?id=<?php echo $page_id; ?>" method="post">
	<?php // page name ?>
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $page->name; ?>" />
	<?php // page published ?>
	<label for="published" class="label">Published</label>
	<?php
		if($page->published == 0) {
			$published1 = ' checked';
			$published2 = NULL;
		} else {
			$published1 = NULL;
			$published2 = ' checked';
		}
	?>
	<input type="radio" name="published" id="published1" class="radio input" value="0"<?php echo $published1; ?> />
	<label for="published1" class="radiolabel">No</label>
	<input type="radio" name="published" id="published2" class="radio input" value="1"<?php echo $published2; ?> />
	<label for="published2" class="radiolabel">Yes</label>
	<?php // page author ?>
	<label for="author" class="label">Author</label>
	<select name="author" class="select input">
		<?php
			$users = User::find_all();
			foreach($users as $user):
			if($user->id == $page->author) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $user->id; ?>"<?php echo $selected; ?>><?php echo $user->username; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // page content ?>
	<label for="content" class="label">Content</label>
	<textarea name="content" name="content" class="textarea input editor"><?php echo $page->content; ?></textarea>
	<?php // meta keywords ?>
	<label for="keywords" class="label">Meta Keywords</label>
	<input type="text" name="keywords" id="keywords" class="textbox input" value="<?php echo $page->keywords; ?>" />
	<?php // meta description ?>
	<label for="description" class="label">Meta Description</label>
	<input type="text" name="description" id="description" class="textbox input" value="<?php echo $page->description; ?>" />
	<?php // form submission ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>