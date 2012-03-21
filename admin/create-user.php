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

// if form is submitted
if(isset($_POST['submit'])) {
	// create a new instance of the user class
	$user = new User();
	$user->permission = trim($_POST['permission']);
	$user->username = trim($_POST['username']);
	$user->email = trim($_POST['email']);
	$user->first_name = trim($_POST['first_name']);
	$user->last_name = trim($_POST['last_name']);
	$user->enabled = trim($_POST['enabled']);
	$user->gender = 'p';
	$user->statuc = NULL;
	$user->bio = NULL;
	$user->email_notifications = 1;
	$user->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$user->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
	$password1 = trim($_POST['password1']);
	$password2 = trim($_POST['password2']);
	if($form->required($user->username, 'Username') && $form->required($user->email, 'Email address') && $form->required($user->first_name, 'First name') && $form->required($user->last_name, 'Last name') && $form->required($password1, 'Your password') && $form->required($password2, 'Your Password')) {
		// validate username
		if(!$form->validate_username($user->username)) {
			$session->message('Please enter a valid username between 3 and 20 characters long.');
		// check username
		} elseif(User::find_by_username($user->username)) {
			$session->message('This username already exists, please choose another.');
		// validate email
		} elseif(!$form->validate_email($user->email)) {
			$session->message('You must enter a valid email address.');
		// check email
		} elseif(User::find_by_email($user->email)) {
			$session->message('This email address already exists, please choose another.');
		// passwords match
		} elseif($password1 !== $password2) {
			$session->message('Your passwords do not match.');
		// attempt save
		} else {
			$user->password = sha1($password1);
			if($user->save()) {
				if(mkdir('../users/'.$user->username, 0777)) {
					$created_user = User::find_by_username($user->username);
					$album = new Album();
					$album->author = $created_user->id;
					$album->name = 'My Photos';
					$album->directory = 'my-photos';
					$album->about = 'The default my photos album';
					$album->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
					$album->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
					if($album->save()) {
						$session->message('User successfully created');
						redirect('./edit-user.php?id='.$created_user->id);
					} else {
						$session->message('User was created but we could not create an album, <a href="./create-album.php">create album now</a>.');
					}
					// successful
					$session->message('User was successfully saved.');
				} else {
					$session->message('User saved but could not write new folder for user.');
				}
			} else {
				$session->message('This user could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Create User';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
    <a href="./manage-users.php" class="toolbar-button" title="Back to Manage Users" onclick="return confirm('Any unsaved changes will be lost. Continue?');"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="create-user.php" method="post">
	<?php // username ?>
	<label for="username" class="label">Username</label>
	<?php
		if(isset($user->username)) {
			$username = $user->username;
		} else {
			$username = NULL;
		}
	?>
	<input type="text" name="username" id="username" class="textbox input" value="<?php echo $username; ?>" />
	<?php // password ?>
	<label for="password1" class="label">Password</label>
	<input type="password" name="password1" id="password1" class="textbox input" value="" />
	<?php // re enter password ?>
	<label for="password2" class="label">Re-Enter Password</label>
	<input type="password" name="password2" id="password2" class="textbox input" value="" />
	<?php // permission ?>
	<label for="permission" class="label">Permission</label>
	<select name="permission" name="permission" class="select input">
		<?php $permissions = Permission::find_all(); ?>
		<?php foreach($permissions as $permission): ?>
		<option value="<?php echo $permission->id; ?>"><?php echo $permission->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // email address ?>
	<label for="email" class="label">Email</label>
	<?php
		if(isset($user->email)) {
			$email = $user->email;
		} else {
			$email = NULL;
		}
	?>
	<input type="text" name="email" id="email" class="textbox input" value="<?php echo $email; ?>" />
	<?php // first name ?>
	<label for="first_name" class="label">First Name</label>
	<?php
		if(isset($user->first_name)) {
			$first_name = $user->first_name;
		} else {
			$first_name = NULL;
		}
	?>
	<input type="text" name="first_name" id="first_name" class="textbox input" value="<?php echo $first_name; ?>" />
	<?php // last name ?>
	<label for="last_name" class="label">Last Name</label>
	<?php
		if(isset($user->last_name)) {
			$last_name = $user->last_name;
		} else {
			$last_name = NULL;
		}
	?>
	<input type="text" name="last_name" id="last_name" class="textbox input" value="<?php echo $last_name; ?>" />
	<?php // submission button ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>