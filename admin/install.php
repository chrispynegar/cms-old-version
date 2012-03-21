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

// set page title
$title = 'Install Extension';

// load template header
require(ADMIN_TEMPLATE.'header.php');

?>

<div class="toolbar">
	<a href="#" name="help_window" class="activate-modal toolbar-button" title="Help"><img src="images/icons/help.png" />Help</a>
</div>

<form action="./install.php" method="post">
	<label for="file" class="label">File</label>
	<input type="file" name="file" id="file" class="file input" value="" />
	<div class="buttonset">
    	<input type="submit" name="submit" class="button input" value="Install" />
    </div>
</form>

<div id="modal-mask" class="close-modal"></div>
<div id="help_window" class="modal-window">
	<h3>Installing Extensions Help</h3>
</div>

<?php

// load template footer
require(ADMIN_TEMPLATE.'footer.php');

?>