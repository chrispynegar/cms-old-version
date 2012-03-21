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
	$album_id = $_GET['id'];
	$album = Album::find_by_id($album_id);
	$user = User::find_by_id($album->author);
} else {
	$session->message('No user selected.');
	redirect('manage-users.php');
}

if(isset($_POST['submit'])) {
	$photo = new Photo();
	$photo->author = $album->author;
	$photo->album = $album_id;
	$photo->name = trim($_POST['name']);
	$photo->profile_picture = 0;
	$photo->date_uploaded = strftime("%Y-%m-%d %H:%M:%S", time());
	// upload
	$tmp_file = $_FILES['photo']['tmp_name'];
	$target_file = urlformat($_FILES['photo']['name']);
	$upload_dir = '../users/'.$user->username.'/'.$album->directory;
	$file_type = $_FILES['photo']['type'];
	$file_size = $_FILES['photo']['size'];
	if($form->required($photo->name, 'Name') && $form->required($_FILES['photo'], 'Photo')) {
		if($file_type = 'image/jpeg' || $file_type = 'image/pjpeg' || $file_type = 'image/png' || $file_type = 'image/gif') {
			if(file_exists($upload_dir.'/'.$target_file)) {
				$session->message('A photo with that name already exists please choose another.');
			} else {
				if(move_uploaded_file($tmp_file, $upload_dir.'/'.$target_file)) {
					$photo->photo = $target_file;
					$photo->type = $file_type;
					$photo->size = $file_size;
					if($photo->save()) {
						$session->message('Photo was successfully saved.');
					} else {
						$session->message('Photo was uploaded but could not be saved into the database.');
					}
				} else {
					$session->message($upload_errors[$error]);
				}
			}
		} else {
			$session->message('You can upload images only in the following formats: JPG, PNG and GIF.');
		}
	}
	
}

// set page title
$title = 'Upload Photo to \''.$album->name.'\'';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<form action="upload-photo.php?id=<?php echo $album_id; ?>" method="post" enctype="multipart/form-data">
	<label for="name" class="label">Name</label>
	<input type="text" name="name" id="name" class="textbox input" value="" />
	<label for="photo" class="label">Photo</label>
	<input type="file" name="photo" id="photo" class="file input" value="" />
	<input type="hidden" name="max_file_size" value="1048576" />
	<input type="submit" name="submit" class="button input" value="Save" />
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>