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

if(isset($item->parameters)) {
	$params = $item->parameters;
	$param = explode(',', $params);
	$display_name = $param[0];
	$display_email = $param[1];
	$display_bio = $param[2];
	// display name
	if($display_name == 1) {
		$display_name1 = NULL;
		$display_name2 = ' checked';
	} else {
		$display_name1 = ' checked';
		$display_name2 = NULL;
	}
	// display email
	if($display_email == 1) {
		$display_email1 = NULL;
		$display_email2 = ' checked';
	} else {
		$display_email1 = ' checked';
		$display_email2 = NULL;
	}
	// display bio
	if($display_bio == 1) {
		$display_bio1 = NULL;
		$display_bio2 = ' checked';
	} else {
		$display_bio1 = ' checked';
		$display_bio2 = NULL;
	}
} else {
	$display_name1 = NULL;
	$display_name2 = ' checked';
	$display_email1 = NULL;
	$display_email2 = ' checked';
	$display_bio1 = NULL;
	$display_bio2 = ' checked';
}

 
?>

<label for="display_name" class="label">Display Name</label>

<input type="radio" name="display_name" id="display_name1" class="radio input" value="0"<?php echo $display_name1; ?> />
<label for="display_name1" class="radiolabel">No</label>
<input type="radio" name="display_name" id="display_name2" class="radio input" value="1"<?php echo $display_name2; ?> />
<label for="display_name2" class="radiolabel">Yes</label>

<label for="display_email" class="label">Display Email Address</label>

<input type="radio" name="display_email" id="display_email1" class="radio input" value="0"<?php echo $display_email1; ?> />
<label for="display_email1" class="radiolabel">No</label>
<input type="radio" name="display_email" id="display_email2" class="radio input" value="1"<?php echo $display_email2; ?> />
<label for="display_email2" class="radiolabel">Yes</label>

<label for="display_bio" class="label">Display Bio</label>

<input type="radio" name="display_bio" id="display_bio1" class="radio input" value="0"<?php echo $display_bio1; ?> />
<label for="display_bio1" class="radiolabel">No</label>
<input type="radio" name="display_bio" id="display_bio2" class="radio input" value="1"<?php echo $display_bio2; ?> />
<label for="display_bio2" class="radiolabel">Yes</label>



