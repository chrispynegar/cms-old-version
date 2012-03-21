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
 
class Message extends Core {

	public static $table_name = 'messages';
	public static $table_fields = array('id', 'sender', 'recipient', 'subject', 'message', 'recieved', 'date_sent');
	public $id;
	public $sender;
	public $recipient;
	public $subject;
	public $message;
	public $recieved;
	public $date_sent;
	
	public function send_message($sender, $recipient, $subject, $message, $automated = false, $email = false) {
		global $database;
		global $form;
		global $session;
		$this->sender = $sender;
		$this->recipient = $recipient;
		$this->subject = $subject;
		$this->message = $message;
		$this->recieved = 0;
		$this->date_sent = strftime("%Y-%m-%d %H:%M:%S", time());
		if($form->required($this->sender, 'Sender') && $form->required($this->recipient, 'Recipient') && $form->required($this->subject, 'Subject') && $form->required($this->message, 'Message')) {
			if($this->save()) {
				if($automated = false) {
					$session->message('Your message has been sent.');
				} elseif($automated = true) {
					// message sent
				}
			} else {
				if($automated = false) {
					$session->message('Your message could not be sent.');
				} elseif($automated = true) {
					$session->message('System message could not be sent');
				}
			}
		}
	}
	
	public static function find_by_recipient($recipient) {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE recipient='{$recipient}' ORDER BY date_sent ASC");
	}
	
	public static function unread_messages($user) {
		global $database;
		$sql = "SELECT COUNT(*) FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE recieved=0 AND recipient='{$user}'";
		$result = $database->query($sql);
		$row = $database->fetch_array($result);
		return array_shift($row);
	}

}

?>