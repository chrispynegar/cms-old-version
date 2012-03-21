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

class Session {
	
	private $logged_in = false;
	public $message;
	public $user_id;
	public $user_username;
	
	public function __construct() {
		session_start();
		$this->check_login();
		if($this->logged_in) {
			// actions to take if user is not logged in
		} else {
			// action to take if user is not logged in
		}
	}
	
	public function is_logged_in() {
		return $this->logged_in;
	}
	
	public function login($user) {
		if($user) {
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->user_username = $_SESSION['user_username'] = $user->username;
			$this->logged_in = true;
		}
	}
	
	public function logout() {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_username']);
		unset($this->user_id);
		unset($this->user_username);
		$this->logged_in = false;
	}
	
	public function message($msg = '') {
		if(!empty($msg)) {
			$_SESSION['message'] = $msg;
		} else {
			return $this->message;
		}
	}
	
	private function check_login() {
		if(isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->logged_in = true;
		} else {
			unset($this->user_id);
			$this->logged_in = false;
		}
	}
	
}

$session = new Session();

?>