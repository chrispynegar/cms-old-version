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
 
class Form {

	// --------------------------------------------------------------------------------
	
	/**
	  * form validation functions
	 */
	
	// --------------------------------------------------------------------------------
	
	// validate a username
	
	function validate_username($username) {
		return preg_match('/^[A-Z0-9]{3,20}$/i', $username);
	}
	
	// --------------------------------------------------------------------------------
	
	// validates an email address
	
	function validate_email($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	// --------------------------------------------------------------------------------
	
	// validates a url
	
	function validate_url($url) {
		return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED);
	}
	
	// --------------------------------------------------------------------------------
	
	// validates a required value
	
	function required($value, $name) {
		// if the required field is empty throw a message like
		// Username (The name specified) is required
		// use the session class
		global $session;
		// the first two parameters MUST be specified
		// the value of $value may be empty anyway so just check that the $name is not empty
		if($name == NULL) {
			die('Form helper function error: you must give two parameters');
		} else {
			if($value == NULL) {
				$session->message($name.' is required.');
				return false;
			} else {
				// comment out next message for debuging
				//$session->message($name.' is set.');
				return true;
			}
		}
	}
	
	// --------------------------------------------------------------------------------
	
	// validates the length of a value
	
	function length($value, $name, $min_length, $max_length) {
		global $session;
		if(strlen($value) >= $min_length || strlen($value <= $max_length)) {
			return true;
		} else {
			$session->message($name.' must be between '.$min_length.' and '.$max_length.' characters long.');
			return false;
		}
	}
	
}

// create a new instance of the form class
$form = new Form();
 
?>