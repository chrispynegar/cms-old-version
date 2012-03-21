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
}

// set page title
$title = 'Viewing album: '.$album->name;

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
	<a href="./upload-photo.php?id=<?php echo $album_id; ?>" class="toolbar-button"><img src="images/icons/add.png" title="Upload a New Photo" />Add</a>
	<a href="#" class="toolbar-button"><img src="images/icons/help.png" title="Help" />Help</a>
	<a href="./albums.php?id=<?php echo $user->id; ?>" class="toolbar-button"><img src="images/icons/back.png" title="Back To Album" />back</a>
</div>

<?php if(Photo::count_specific('album', $album_id) == 0): ?>
<p>No photos in album.</p>
<?php endif; ?>

<?php if(Photo::count_specific('album', $album_id) != 0): ?>

<div class="gallery">
	<?php
		$photos = Photo::find_by_album($album_id);
		foreach($photos as $photo):
	?>
	<div class="gallery-item">
		<div class="gallery-photo">
			<a href="../users/<?php echo $user->username.'/'.$album->directory.'/'.$photo->photo; ?>" class="lightbox" target="_blank"><img src="../users/<?php echo $user->username.'/'.$album->directory.'/'.$photo->photo; ?>" width="140" height="140" /></a>
		</div>
		<div class="gallery-caption">
			<?php echo $photo->name; ?>
		</div>
		<div class="gallery-actions">
			<a href="#">Edit</a> | <a href="#">Delete</a>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<?php endif; ?>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>