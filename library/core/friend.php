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
 
class Friend extends Core {

	public static $table_name = 'friends';
	public static $table_fields = array('id', 'user1', 'user2', 'confirmed', 'date_created');
	public $id;
	public $user1;
	public $user2;
	public $confirmed;
	public $date_created;
	
	public function send_request($user1, $user2) {
		global $database;
		global $message;
		global $session;
		$this->user1 = $user1;
		$this->user2 = $user2;
		$this->confirmed = 0;
		$this->date_created = strftime("%Y-%m-%d %H:%M:%S", time());
		if($this->save()) {
			$message = new Message();
			$message_body = "You have a new friend request.\n\nTo view this request go to <a href=\"#\">Request link here</a>";
			$message->send_message($user1, $user2, 'New friend request', $message_body, true);
			$session->message('Your request has been sent.');
		} else {
			$session->message('Could not send request.');
		}
	}
	
	public static function request_sent($user1, $user2) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE user1 = {$user1} AND user2 = {$user2} LIMIT 1");
		return !empty($result_array) ? true : false;
	}
	
	public function is_friend($user1, $user2) {
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . self::$table_name . " WHERE user1 = {$user1} OR {$user2} AND user2 = {$user2} OR {$user1} AND confirmed = 1 LIMIT 1");
		return !empty($result_array) ? true : false;
	}

}

?>