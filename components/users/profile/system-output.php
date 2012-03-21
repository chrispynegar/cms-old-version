<?php

/**
 * Develop21
 *
 * @package Category View - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

global $session;

if((int)$_GET['id']):

$user_profile = User::find_by_id($_GET['id']);

$current_url = currenturl();

if($profile_picture = Photo::profile_picture($_GET['id'])) {
	$pp = TRUE;
	$album = Album::find_by_id($profile_picture->album);
} else {
	$pp = FALSE;
}

if(isset($_GET['request']) == TRUE) {
	// send friend request
	$friend = new Friend();
	$friend->send_request($session->user_id, $user_profile->id);
}

?>

<h2><?php echo 'Profile: '.$user_profile->fullname().' ('.$user_profile->username.')'; ?></h2>

<div class="profile">
	<div class="profile-left">
		<div class="profile-image">
			<?php if($pp == TRUE): ?>
				<img src="users/<?php echo $user_profile->username.'/'.$album->directory.'/'.$profile_picture->photo; ?>" width="200" class="profile-picture" />
			<?php endif; ?>
			<?php if($pp == FALSE): ?>
				<img src="users/default_pp.jpg" />
			<?php endif; ?>
		</div>
		<ul class="profile-links">
        	<?php if($user_profile->id != $session->user_id): ?>
        	<?php if(Friend::request_sent($session->user_id, $user_profile->id) == true): ?>
            <li><a href="#">Request Sent</a></li>
            <?php else: ?>
            <li><a href="<?php echo $current_url; ?>&amp;request=true">Add as a Friend</a></li>
            <?php endif; ?>
            <?php endif; ?>
			<li><a href="<?php echo SITE_URL; ?>index.php?system=albums&amp;id=<?php echo $user_profile->id; ?>">My Albums</a></li>
		</ul>
	</div>
	<div class="profile-right">
		<div class="profile-info">
			<div class="profile-name-label profile-label">Name</div>
			<div class="profile-name profile-text"><?php echo $user_profile->fullname(); ?></div>
			<div class="profile-email-label profile-label">Email</div>
			<div class="profile-email profile-text"><?php echo $user_profile->email; ?></div>
			<?php if($user_profile->bio != NULL): ?>
			<div class="profile-bio-label profile-label">Bio</div>
			<div class="profile-bio profile-text"><?php echo $user_profile->bio; ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php endif; ?>

<?php if(!$_GET['id']): ?>

<p>User not found.</p>

<?php endif; ?>