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

$setting = Setting::find_by_id(1);

if(isset($_POST['submit'])) {
	$setting = new Setting();
	$setting->id = 1;
	$setting->website_name = trim($_POST['website_name']);
	$setting->tagline = trim($_POST['tagline']);
	$setting->keywords = trim($_POST['keywords']);
	$setting->description = trim($_POST['description']);
	$setting->offline = trim($_POST['offline']);
	$setting->offline_message = trim($_POST['offline_message']);
	$setting->use_htaccess = trim($_POST['use_htaccess']);
	$setting->editor = trim($_POST['editor']);
	$setting->debug_mode = trim($_POST['debug_mode']);
	$setting->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
	if($form->required($setting->website_name, 'Website name')) {
		if($setting->save()) {
			$session->message('Your settings has been updated.');
		} else {
			$session->message('Your settings could not be updated.');
		}
	}
}

// set page title
$title = 'Settings';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<?php //  ?>
<form action="settings.php" method="post">
	<?php //  ?>
	<label for="website_name" class="label">Website Name</label>
	<input type="text" name="website_name" id="website_name" class="textbox input" value="<?php echo $setting->website_name; ?>" />
	<?php //  ?>
	<label for="tagline" class="label">Tagline</label>
	<input type="text" name="tagline" id="tagline" class="textbox input" value="<?php echo $setting->tagline; ?>" />
	<?php //  ?>
	<label for="keywords" class="label">Meta Keywords</label>
	<input type="text" name="keywords" id="keywords" class="textbox input" value="<?php echo $setting->keywords; ?>" />
	<?php //  ?>
	<label for="description" class="label">Description</label>
	<input type="text" name="description" id="description" class="textbox input" value="<?php echo $setting->description; ?>" />
	<?php //  ?>
	<label for="offline" class="label">Offline</label>
	<?php
		if($setting->offline == 0) {
			$offline1 = ' checked';
			$offline2 = NULL;
		} else {
			$offline1 = NULL;
			$offline2 = ' checked';
		}
	?>
	<input type="radio" name="offline" id="offline1" class="radio input" value="0"<?php echo $offline1; ?> />
	<label for="offline1" class="radiolabel">No</label>
	<input type="radio" name="offline" id="offline2" class="radio input" value="1"<?php echo $offline2; ?> />
	<label for="offline2" class="radiolabel">Yes</label>
	<?php //  ?>
	<label for="offline_message" class="label">Offline Message</label>
	<input type="text" name="offline_message" id="offline_message" class="textbox input" value="<?php echo $setting->offline_message; ?>" />
	<?php //  ?>
	<label for="use_htaccess" class="label">Use .htaccess</label>
	<?php
		if($setting->use_htaccess == 0) {
			$use_htaccess1 = ' checked';
			$use_htaccess2 = NULL;
		} else {
			$use_htaccess1 = NULL;
			$use_htaccess2 = ' checked';
		}
	?>
	<input type="radio" name="use_htaccess" id="use_htaccess1" class="radio input" value="0"<?php echo $use_htaccess1; ?> />
	<label for="use_htaccess1" class="radiolabel">No</label>
	<input type="radio" name="use_htaccess" id="use_htaccess2" class="radio input" value="1"<?php echo $use_htaccess2; ?> />
	<label for="use_htaccess2" class="radiolabel">Yes</label>
	<?php // editor ?>
	<label for="editor" class="label">Editor</label>
	<select name="editor" id="editor">
		<?php
			if($setting->editor == 0) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="0"<?php echo $selected; ?>>None</option>
		<?php
			$editors = Editor::find_all(); 
			foreach($editors as $editor):
			if($setting->editor == $editor->id) {
				$selected = ' selected';
			} else {
				$selected = NULL;
			}
		?>
		<option value="<?php echo $editor->id; ?>"<?php echo $selected; ?>><?php echo $editor->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php //  ?>
	<label for="debug_mode" class="label">Debug Mode</label>
	<?php
		if($setting->debug_mode == 0) {
			$debug_mode1 = ' checked';
			$debug_mode2 = NULL;
		} else {
			$debug_mode1 = NULL;
			$debug_mode2 = ' checked';
		}
	?>
	<input type="radio" name="debug_mode" id="debug_mode1" class="radio input" value="0"<?php echo $debug_mode1; ?> />
	<label for="debug_mode1" class="radiolabel">No</label>
	<input type="radio" name="debug_mode" id="debug_mode2" class="radio input" value="1"<?php echo $debug_mode2; ?> />
	<label for="debug_mode2" class="radiolabel">Yes</label>
	<?php //  ?>
	<input type="submit" name="submit" class="button input" value="Save" />
<?php //  ?>
</form>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>