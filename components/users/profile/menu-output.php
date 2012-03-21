<?php

/**
 * Develop21
 *
 * @package User Profile - Develop21 CMS
 * @version 1.0
 * @since Develop21 CMS version 1.0
 * @author Chris Pynegar - Develop21
 * @copyright © 2012
 * @license http://develop21.com/cms/license.txt
 *
 */

// this displays the logged in users profile

// how can this component be improved?
// ability to set the output format such as HTML using <div> etc, HTML5 <article> etc

global $session;

if($session->is_logged_in()):

$user_profile = User::find_by_id($session->user_id);

$params = $menuitem->parameters;

$param = explode(',', $params);

$display_name = $param[0];
$display_email = $param[1];
$display_bio = $param[2];

if($profile_picture = Photo::profile_picture($user_profile->id)) {
	$pp = TRUE;
	$album = Album::find_by_id($profile_picture->album);
} else {
	$pp = FALSE;
}

?>

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
			<li><a href="<?php echo SITE_URL; ?>index.php?system=albums&amp;id=<?php echo $user_profile->id; ?>">My Albums</a></li>
		</ul>
	</div>
	<div class="profile-right">
		<div class="profile-info">
			<?php if($display_name == 1): ?>
			<div class="profile-name-label profile-label">Name</div>
			<div class="profile-name profile-text"><?php echo $user_profile->fullname(); ?></div>
			<?php endif; ?>
			<?php if($display_email == 1): ?>
			<div class="profile-email-label profile-label">Email</div>
			<div class="profile-email profile-text"><?php echo $user_profile->email; ?></div>
			<?php endif; ?>
			<?php if($display_bio == 1): ?>
			<?php if($user_profile->bio != NULL): ?>
			<div class="profile-bio-label profile-label">Bio</div>
			<div class="profile-bio profile-text"><?php echo $user_profile->bio; ?></div>
			<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php else: ?>

<p>You must <a href="<?php echo SITE_URL; ?>index.php?system=login">log in</a> to view your profile.</p>

<?php endif; ?>