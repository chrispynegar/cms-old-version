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

if((int)isset($_GET['id'])) {
	$user_id = $_GET['id'];
	$user = User::find_by_id($user_id);
} else {
	$session->message('No user was selected.');
	redirect('manage-users.php');
}

// set page title
$title = 'Profile: '.$user->fullname().' ('.$user->username.')';

// load template header
require(ADMIN_TEMPLATE.'header.php');

if($profile_picture = Photo::profile_picture($user_id)) {
	$pp = TRUE;
	$album = Album::find_by_id($profile_picture->album);
} else {
	$pp = FALSE;
}

?>

<div class="toolbar">
    <a href="./albums.php?id=<?php echo $user->id; ?>" class="toolbar-button" title="My Albums"><img src="images/icons/folder.png" />Albums</a>
    <a href="./edit-user.php?id=<?php echo $user->id; ?>" class="toolbar-button" title="My Albums"><img src="images/icons/user.png" />Edit</a>
    <a href="#" name="settings_window" class="activate-modal toolbar-button" title="Modify Page Settings"><img src="images/icons/process.png" />Settings</a>
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<div class="profile">
	<div class="profile-left">
    	<div class="profile-image">
            <?php if($pp == TRUE): ?>
				<a href="#" target="_blank" class="lightbox"><img src="../users/<?php echo $user->username.'/'.$album->directory.'/'.$profile_picture->photo; ?>" alt="<?php echo $user->fullname(); ?>'s Profile Picture" class="image" width="150" /></a>
			<?php endif; ?>
			<?php if($pp == FALSE): ?>
				<img src="../users/default_pp.jpg" width="150" alt="<?php echo $user->fullname(); ?>'s Profile Picture" />
			<?php endif; ?>
        </div>
        <dl class="profile-data">
        	<dt>Access</dt>
            <?php $permission = Permission::find_by_id($user->permission); ?>
            <dd><?php echo $permission->name; ?></dd>
            <dt>Status</dt>
            <?php
				if($user->enabled == 1) {
					$enabled = '<span class="yes">Enabled</span>';
				} else {
					$enabled = '<span class="no">Disabled</span>';
				}
			?>
            <dd><?php echo $enabled; ?></dd>
            <dt>Email Notifications</dt>
            <?php
				if($user->email_notifications == 1) {
					$notifications = '<span class="yes">Enabled</span>';
				} else {
					$notifications = '<span class="no">Disabled</span>';
				}
			?>
            <dd><?php echo $notifications; ?></dd>
            <dt>Date Modified</dt>
            <dd><?php echo datetime_to_text($user->date_modified); ?></dd>
            <dt>Date Created</dt>
            <dd><?php echo datetime_to_text($user->date_created); ?></dd>
        </dl>
	</div>
    <div class="profile-right">
    	<h3>User Information</h3>
        <dl class="profile-info">
        	<dt>Email Address</dt>
            <dd><a href="mailto:<?php echo $user->email; ?>" title="Email <?php echo $user->fullname(); ?>"><?php echo $user->email; ?></a></dd>
            <?php if($user->url != NULL): ?>
            <dt>URL</dt>
            <dd><a href="<?php echo $user->url; ?>" title="Visit <?php echo $user->url; ?>" target="_blank"><?php echo $user->url; ?></a></dd>
            <?php endif; ?>
            <?php if($user->bio != NULL): ?>
            <dt>Bio</dt>
            <dd><?php echo $user->bio; ?></dd>
            <?php endif; ?>
            <dt>Friends</dt>
            <dd>TBC</dd>
            <dt>Sent Messages</dt>
            <dd>TBC</dd>
            <dt>Inbox</dt>
            <dd>TBC</dd>
            <dt>Albums</dt>
            <dd>TBC</dd>
            <dt>Photos</dt>
            <dd>TBC</dd>
		</dl>
	</div>
</div>

<div id="modal-mask" class="close-modal"></div>
<div id="settings_window" class="modal-window">
	<h3>Profile Settings</h3>
</div>
<div id="help_window" class="modal-window">
	<h3>User Profile Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>