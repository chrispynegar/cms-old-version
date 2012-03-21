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
 
?>

<label for="login_intro_text" class="label">Login Intro Text</label>
<?php
	if(isset($login_intro_text)) {
		$login_intro_text = $login_intro_text;
	} else {
		$login_intro_text = NULL;
	}
?>
<input type="text" name="login_intro_text" id="login_intro_text" class="textbox input" value="<?php echo $login_intro_text; ?>" />