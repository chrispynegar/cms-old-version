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
	$user_id = $_GET['id'];
	if($user = User::find_by_id($_GET['id'])) {
		// user found
		$username = $user->username;
		$email = $user->email;
		$password = $user->password;
		$date_created = $user->date_created;
	} else {
		// invalid id no user found
		$session->message('No user was selected.');
		redirect('manage-users.php');
	}
} else {
	$session->message('You must select a user to edit.');
	redirect('manage-users.php');
}

// if the form is submitted
if(isset($_POST['submit'])) {
	// create a new instance of the user class
	$user = new User();
	$user->id = $_GET['id'];
	$user->permission = trim($_POST['permission']);
	$user->username = $username;
	$user->email = trim($_POST['email']);
	$user->first_name = trim($_POST['first_name']);
	$user->last_name = trim($_POST['last_name']);
	$user->enabled = trim($_POST['enabled']);
	$user->email_notifications = trim($_POST['email_notifications']);
	$user->gender = trim($_POST['gender']);
	$user->status = trim($_POST['status']);
	$user->bio = trim($_POST['bio']);
	$user->url = trim($_POST['url']);
	$user->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	$user->date_created = $date_created;
	// updating email
	if($user->email != $email) {
		if(User::find_by_email($user->email)) {
			$valid_email = FALSE;
		} else {
			$valid_email = TRUE;
		}
	} else {
		$valid_email = TRUE;
	}
	// updating password
	if($_POST['password1'] = NULL || $_POST['password2'] == NULL) {
		$valid_password = TRUE;
		$user->password = $password;
	} else {
		$password1 = trim($_POST['password1']);
		$password2 = trim($_POST['password2']);
		if($password1 != $password2) {
			$valid_password = FALSE;
		} else {
			$valid_password = TRUE;
			$user->password = sha1($password1);
		}
	}
	// check required fields and validate form
	if($form->required($user->email, 'Email address') && $form->required($user->first_name, 'first Name') && $form->required($user->last_name, 'Last name')) {
		// validate email
		if(!$form->validate_email($user->email)) {
			$session->message('You must enter a valid email address.');
		// check email
		} elseif($valid_email = FALSE) {
			$session->message('Another user has this email address, please specify another.');
		// check password
		} elseif($valid_password = FALSE) {
			$session->message('Your passwords do not match.');
		// attempt save
		} else {
			if($user->save()) {
				$session->message('This user was successfully saved.');
			} else {
				$session->message('This user could not be saved.');
			}
		}
	}
}

// set page title
$title = 'Edit User: '.$user->username;

// load template header
require(ADMIN_TEMPLATE.'header.php');

// build page content

?>

<div class="toolbar">
    <a href="./manage-users.php" class="toolbar-button" title="Back to Manage Users" onclick="return confirm('Any unsaved changes will be lost. Continue?');"><img src="images/icons/back.png" />Back</a>
</div>

<?php // open form ?>
<form action="edit-user.php?id=<?php echo $user_id; ?>" method="post">
	<?php // username ?>
	<label for="username" class="label">Username</label>
	<input type="text" name="username" id="username" class="half-textbox input" value="<?php echo $user->username; ?>" disabled />
	<label for="username" class="noticelabel">You cannot change your username</label>
	<?php // email ?>
	<label for="email" class="label">Email</label>
	<input type="text" name="email" id="email" class="textbox input" value="<?php echo $user->email; ?>" />
	<?php // first name ?>
	<label for="first_name" class="label">First Name</label>
	<input type="text" name="first_name" id="first_name" class="textbox input" value="<?php echo $user->first_name; ?>" />
	<?php // last name ?>
	<label for="last_name" class="label">Last Name</label>
	<input type="text" name="last_name" id="last_name" class="textbox input" value="<?php echo $user->last_name; ?>" />
	<?php // enabled ?>
	<label for="enabled" class="label">Enabled</label>
	<?php
		if($user->enabled == FALSE) {
			$enabled1 = ' checked';
		} else {
			$enabled1 = FALSE;
		}
	?>
	<div class="buttonset">
		<input type="radio" name="enabled" id="enabled1" class="radio input" value="0"<?php echo $enabled1; ?> />
		<label for="enabled1" class="radiolabel">No</label>
		<?php
			if($user->enabled == TRUE) {
				$enabled2 = ' checked';
			} else {
				$enabled2 = FALSE;
			}
		?>
		<input type="radio" name="enabled" id="enabled2" class="radio input" value="1"<?php echo $enabled2; ?> />
		<label for="enabled2" class="radiolabel">Yes</label>
	</div>
	<?php // email notifications ?>
	<label for="email_notifications" class="label">Email Notifications</label>
	<?php
		if($user->email_notifications == FALSE) {
			$em1 = ' checked';
		} else {
			$em1 = FALSE;
		}
	?>
	<div class="buttonset">
		<input type="radio" name="email_notifications" id="em1" class="radio input" value="0"<?php echo $em1; ?> />
		<label for="em1" class="radiolabel">No</label>
		<?php
			if($user->email_notifications == TRUE) {
				$em2 = ' checked';
			} else {
				$em2 = FALSE;
			}
		?>
		<input type="radio" name="email_notifications" id="em2" class="radio input" value="1"<?php echo $em2; ?> />
		<label for="em2" class="radiolabel">Yes</label>
	</div>
	<?php // permissions ?>
	<label for="permission" class="label">Permission</label>
	<select name="permission" id="permission" class="select input">
		<?php $permissions = Permission::find_all(); ?>
		<?php
			foreach($permissions as $permission):
			if($user->permission == $permission->id) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $permission->id; ?>"<?php echo $selected; ?>><?php echo $permission->name ?></option>
		<?php endforeach; ?>
	</select>
	<h3 class="heading3">About</h3>
	<?php // gender ?>
	<label for="gender" class="label">Gender</label>
	<div class="buttonset">
		<?php
			if($user->gender == 'm') {
				$gender1 = ' checked';
			} else {
				$gender1 = NULL;
			}
		?>
		<input type="radio" name="gender" id="gender1" class="radio input" value="m"<?php echo $gender1; ?> />
		<label for="gender1" class="radiolabel">Male</label>
		<?php
			if($user->gender == 'f') {
				$gender2 = ' checked';
			} else {
				$gender2 = NULL;
			}
		?>
		<input type="radio" name="gender" id="gender2" class="radio input" value="f"<?php echo $gender2; ?> />
		<label for="gender2" class="radiolabel">Female</label>
		<?php
			if($user->gender == 'p') {
				$gender3 = ' checked';
			} else {
				$gender3 = NULL;
			}
		?>
		<input type="radio" name="gender" id="gender3" class="radio input" value="p"<?php echo $gender3; ?> />
		<label for="gender3" class="radiolabel">Prefer not to say</label>
	</div>
	<?php // status ?>
	<label for="status" class="label">Status</label>
	<select name="status" id="status" class="select input">
		<?php
			$statuses = Status::find_all();
			foreach($statuses as $status):
			if($user->status == $status->name) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $status->name; ?>"<?php echo $selected; ?>><?php echo $status->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php // bio ?>
	<label for="bio" class="label">Bio</label>
	<textarea name="bio" id="bio" class="textarea input"><?php echo $user->bio; ?></textarea>
	<?php // url ?>
	<label for="url" class="label">URL</label>
	<input type="text" name="url" id="url" class="textbox input" value="<?php echo $user->url; ?>" />
	<?php // new password ?>
	<h3 class="heading3">New Password (leave blank if not changing)</h3>
	<label for="password1" class="label">New Password</label>
	<input type="password" name="password1" id="password1" class="textbox input" value="" />
	<label for="password2" class="label">Re-Enter Password</label>
	<input type="password" name="password2" id="password2" class="textbox input" value="" />
	<?php // form submission button ?>
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Save" />
    </div>
<?php // close form ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>