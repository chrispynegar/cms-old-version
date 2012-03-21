<?php

/**
 * Develop21
 *
 * @package Albums - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

// must get two paramters from the url
// the user id

// privacy settings on the user id must be checked before anything is outputted

global $database;
global $session;

if(isset($_GET['id'])) {
	$user_id = $_GET['id'];
	$user = User::find_by_id($user_id);
	// get privacy settings
	$privacy = Privacy::find_by_user($user_id);
} else {
	$session->message('No user found.');
}

if($session->is_logged_in()) {
	// user is logged in
	if($privacy->albums == 'none') {
		$view_album == FALSE;
	} elseif($privacy->albums = 'friends') {
		if(Friend::is_friend($session->user_id, $user_id)) {
			$view_album = TRUE;
		} else {
			$view_album = FALSE;
		}
	} elseif($privacy->albums = 'everyone') {
		$view_album == TRUE;
	}
} else {
	// user in not logged in
	if($privacy->albums == 'none') {
		$view_album == FALSE;
	} elseif($privacy->albums = 'friends') {
		$view_album == FALSE;
	} elseif($privacy->albums = 'everyone') {
		$view_album == TRUE;
	}
}

?>

<?php if($view_album == TRUE): ?>

<div id="albums">
	<?php $albums = Album::find_user_albums($user_id); ?>
	<?php foreach($albums as $album): ?>
	<div class="album">
		<div class="name"><a href="#" title="View <?php echo $album->name; ?>"><?php echo $album->name; ?></a></div>
	</div>
	<?php endforeach; ?>
</div>

<?php elseif($view_album = FALSE): ?>

<p>You do not have permission to view this album.</p>

<?php endif; ?>