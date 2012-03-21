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
	
	// create a new instance of the page class
	$page = new Page();
	
	/**
	  * create variables of submitted form data
	 */
	
	// page title
	$page->name = trim($_POST['name']);
	// page published
	$page->published = trim($_POST['published']);
	// page author
	$page->author = trim($_POST['author']);
	// page content
	$page->content = trim($_POST['content']);
	// page meta keywords
	$page->keywords = trim($_POST['keywords']);
	// page meta keywords
	$page->description = trim($_POST['description']);
	
	/**
	  * create variables from non-form data
	 */
	
	// page date modified (in this case it will be the same as the creation date)
	$page->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	// page date created
	$page->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	
	/**
	  * form validation and data entry
	  *
	 */
	 
	// check that required fields are not empty
	if($form->required($page->name, 'Page name') && $form->required($page->content, 'Page content')) {
		// the required fields have been entered, continue page save procedure
		// check that the page name doesn't already exist
		// this is not a form validation check it must be done through the page class to check the database
		if(Page::find_by_name($page->name)) {
			$session->message('This name title already exists, please choose another.');
		} else {
			// attempt to save the page to the database
			if($page->save()) {
				// save successful
				$session->message('This page was successfully saved.');
				$created_page = Page::find_by_name($page->name);
				redirect('edit-page.php?id='.$created_page->id);
				// go to manage pages
				//redirect('manage-pages.php');
			} else {
				// save was not successful
				$session->message('This page could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create Page';

// load template header
require(ADMIN_TEMPLATE.'header.php');

// start outputing page content

// build create page form

?>

<div class="toolbar">
    <a href="./manage-pages.php" class="toolbar-button" title="Back to Manage Pages" onclick="return confirm('Any unsaved changes will be lost. Continue?');"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="create-page.php" method="post">
	<?php // page name ?>
	<label for="name" class="label">Name</label>
	<?php
		if(isset($page->name)) {
			$name = $page->name;
		} else {
			$name = NULL;
		}
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<?php // page publication ?>
	<label for="published" class="label">Published</label>
	<?php
		if(isset($page->published)) {
			if($page->published == 0) {
				$published1 = TRUE;
				$publushed2 = FALSE;
			} else {
				$published1 = FALSE;
				$published2 = TRUE;
			}
		} else {
			$published1 = FALSE;
			$published2 = TRUE;
		}
	?>
	<?php // page is not published ?>
	<div class="buttonset">
		<input type="radio" name="published" id="published1" class="radio input" value="0"<?php if($published1 == TRUE) { echo ' checked'; } ?> />
		<label for="published1" class="radiolabel">No</label>
		<?php // page is published ?>
		<input type="radio" name="published" id="published2" class="radio input" value="1"<?php if($published2 == TRUE) { echo ' checked'; } ?> />
		<label for="published2" class="radiolabel">Yes</label>
	</div>
	<?php // page author ?>
	<label for="author" class="label">Author</label>
	<?php
		// find all users in database
		$users = User::find_all();
	?>
	<?php // open user dropdown menu ?>
	<select name="author" id="author" class="select input">
		<?php // loop through users creating a dropdown option for each one ?>
		<?php foreach($users as $user): ?>
			<option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
		<?php endforeach; ?>
	<?php // close user dropdown menu ?>
	</select>
	<?php // page content ?>
	<label for="content" class="label">Content</label>
	<?php
		if(isset($page->content)) {
			$content = $page->content;
		} else {
			$content = NULL;
		}
	?>
	<textarea name="content" id="content" class="textarea input editor"><?php echo $content; ?></textarea>
	<?php // page meta keywords ?>
	<label for="keywords" class="label">Meta Keywords</label>
	<?php
		if(isset($page->keywords)) {
			$keywords = $page->keywords;
		} else {
			$keywords = NULL;
		}
	?>
	<input type="text" name="keywords" id="keywords" class="textbox input" value="<?php echo $keywords; ?>" />
	<?php // page meta description ?>
	<label for="description" class="label">Meta Description</label>
	<?php
		if(isset($page->description)) {
			$description = $page->description;
		} else {
			$description = NULL;
		}
	?>
	<input type="text" name="description" id="description" class="textbox input" value="<?php echo $description; ?>" />
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