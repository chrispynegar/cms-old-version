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

class User extends Core {
	
	protected static $table_name = 'users';
	protected static $table_fields = array('id', 'permission', 'username', 'password', 'email', 'first_name', 'last_name', 'bio', 'url', 'gender', 'status', 'email_notifications' ,'enabled', 'date_modified', 'date_created');
	public $id;
	public $permission;
	public $username;
	public $password;
	public $email;
	public $first_name;
	public $last_name;
	public $bio;
	public $url;
	public $gender;
	public $status;
	public $email_notifications;
	public $enabled;
	public $date_modified;
	public $date_created;
	
	public function fullname() {
		if(isset($this->first_name) && isset($this->last_name)) {
			return $this->first_name.' '.$this->last_name;
		} else {
			return NULL;
		}
	}
	
	public function register_user($username = '', $email = '', $first_name = '', $last_name = '', $password1 = '', $password2 = '', $permission = 1) {
		global $database;
		global $form;
		global $session;
		$this->permission = 1;
		$this->username = trim($username);
		$this->email = trim($email);
		$this->first_name = trim($first_name);
		$this->last_name = trim($last_name);
		$this->bio = '';
		$this->url = '';
		$this->gender = '';
		$this->status = '';
		$this->email_notifications = 1;
		$this->enabled = 1;
		$this->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
		$this->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
		if($form->required($this->username, 'Username') && $form->required($this->email, 'Email') && $form->required($this->first_name, 'First name') && $form->required($this->last_name, 'Last name') && $form->required($password1, 'Password') && $form->required($password2, 'Your re-entered password')) {
			if(!$form->validate_username($this->username)) {
				$session->message('Please enter a valid username');
				return false;
			} elseif(User::find_by_username($this->email)) {
				$session->message('This username is taken, please choose another.');
				return false;
			} elseif(!$form->validate_email($this->email)) {
				$session->message('Please enter a valid email address');
				return false;
			} elseif(User::find_by_email($this->email)) {
				$session->message('This email address already exists in our database, please specify another.');
				return false;
			} elseif($password1 !== $password2) {
				$session->message('Your passwords do not match.');
				return false;
			} else {
				$this->password = sha1($password1);
				if($this->save()) {
					if(mkdir(SITE_ROOT.'users/'.$this->username, 0777)) {
						$created_user = self::find_by_username($this->username);
						$privacy = new Privacy();
						$privacy->user = $created_user->id;
						$privacy->profile = 'friends';
						$privacy->albums = 'friends';
						$privacy->email = 'friends';
						$privacy->date_modified = strftime("%Y-%m-%d %H:%M:%S", time());
						$album = new Album();
						if($album->create_default($created_user->id)) {
							$session->message('Your were successfully registered.');
							return true;
						} else {
							$session->message('Could not create user album.');
							return false;
						}
					} else {
						$session->message('Could not create user directory');
						return false;
					}
				} else {
					$session->message('We could not register you.');
				}
			}
		} else {
			return false;
		}
	}
	
	public static function authenticate($username='', $password='') {
		global $database;
		$username = $database->escape_value($username);
		$password = $database->escape_value($password);
		$hashed_password = sha1($password);
		$sql = "SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name;
		$sql .= " WHERE username = '{$username}' ";
		$sql .= "AND password = '{$hashed_password}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_username($username) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE username='{$username}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_email($email) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE email='{$email}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_all_enabled() {
		return self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE enabled=1 ORDER BY id ASC");
	}
	
}

?>