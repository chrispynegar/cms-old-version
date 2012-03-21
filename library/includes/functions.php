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
 
// quickly redirect
function redirect($location = NULL) {
	if($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

// check that user is logged in
function logged_in() {
	global $session;
	if(!$session->is_logged_in()) {
		$session->message('You must be logged in to view this page.');
		redirect('login.php');
	}
}

// output system message
function system_message($class = 'message') {
	global $session;
	if(isset($_SESSION['message'])) {
		return '<p class="'.$class.'">'.$_SESSION['message'].'</p>';
		unset($_SESSION['message']);
	}
}

// load selected helper classes, each helper must be seperated by a '|'
function loadhelpers($helpers) {
	// explode string of helpers into an array
	$helperarray = explode('|', $helpers);
	// loop through array items
	foreach($helperarray as $key => $value) {
		//echo $key . ' ' . $value . '<br />';
		//echo $value . '.php';
		ob_start();
		require(LIBRARY_PATH.'helpers'.DS.''.$value.'.php');
		$helper = ob_get_clean();
		//echo LIBRARY_PATH.'helpers'.DS.''.$value.'.php<br /><br />';
	}
}

// create a new line (used for code source and text files)
function newline() {
	echo "\n";
}

// get gender
function gender($gender) {
	if($gender == 'p') {
		return 'Prefer not to say';
	} elseif($gender == 'm') {
		return 'Male';
	} elseif($gender == 'f') {
		return 'Female';
	} else {
		return 'Unknown';
	}
}

// format a string for url
function urlformat($string) {
	// test for removing single word
	//$string = str_replace(" a ", "-", $string);
	$string = str_replace(" ", "-", $string);
	$string = strtolower($string);
	return $string;
}

function datetime_to_text($datetime="") {
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M:%p", $unixdatetime);
}

function currenturl() {
	$url = 'http';
	if(isset($_SERVER['HTTPS']) == 'on') {
		$url .= 's';
	}
	$url .= '://';
	if($_SERVER['SERVER_PORT'] != '80') {
		$url .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URL'];
	} else {
		$url .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
	return $url;
}

?>