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

if($_GET['id']) {
	$user_id = $_GET['id'];
} else {
	$session->message('No use was selected.');
	redirect('manage-users.php');
}

if(isset($_POST['submit'])) {
	$album = new Album();
	$album->author = $user_id;
	$album->name = trim($_POST['name']);
	$album->directory = urlformat(trim($_POST['name']));
	$album->about = trim($_POST['about']);
	$album->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$album->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($album->name, 'Album name')) {
		if(Album::find_by_name($album->name)) {
			$session->message('This album name already exists, please choose another.');
		} else {
			if($album->save()) {
				$user = User::find_by_id($album->author);
				if(mkdir('../users/'.$user->username.'/'.$album->directory, 0777)) {
					$session->message('This album was successfully created.');
				} else {
					$session->message('The album was saved but was unable to create a folder.');
				}
			} else {
				$session->message('This album could not be created.');
			}
		}
	}
}

// set page title
$title = 'Create Album';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./create-album.php?id=<?php echo $user_id; ?>" class="toolbar-button" title="Create New Album"><img src="images/icons/add.png" />Add</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
	<a href="./albums.php?id=<?php echo $user_id; ?>" class="toolbar-button" title="Back to Manage Albums"><img src="images/icons/back.png" />Back</a>
</div>

<form action="create-album.php" method="post">
	<label for="name" class="label">Name</label>
	<?php
		if(isset($album->name)) {
			$name = $album->name;
		} else {
			$name = NULL;
		}
	?>
	<input type="text" name="name" id="name" class="textbox input" value="<?php echo $name; ?>" />
	<label for="about" class="label">About</label>
	<?php
		if(isset($album->about)) {
			$about = $album->about;
		} else {
			$about = NULL;
		}
	?>
	<textarea name="about" id="about" class="textarea input" value="<?php echo $about; ?>"></textarea>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
</form>

<div id="modal-mask" class="close-modal"></div>
<div id="help_window" class="modal-window">
	<h3>Create Album Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>