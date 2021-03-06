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
if(!file_exists('config.php')) {
	header('Location: ./install/index.php');
	exit();
}

// require the loader
require_once('library/load.php');

// require the website object
require(SITE_ROOT.'library/core/website.php');

// get active template
require(PUBLIC_TEMPLATE.'index.php');

?>