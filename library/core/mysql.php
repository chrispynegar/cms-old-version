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

class MySQL {
	
	private $connection;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	public $last_query;
	
	function __construct() {
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
	}
	
	public function open_connection() {
		$this->connection = mysql_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD);
		if(!$this->connection) {
			die("MySQL connection failed: " . mysql_error());
		} else {
			$db_select = mysql_select_db(DATABASE_NAME, $this->connection);
			if(!$db_select) {
				die("Database connection failed: " . mysql_error());
			}
		}
	}
	
	public function close_connection() {
		if(isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function escape_value($value) {
		if($this->real_escape_string_exists) {
			if($this->magic_quotes_active) {
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		} else {
			if(!$this->magic_quotes_active) {
				$value = addslashes($value);
			}
		}
		return $value;
	}
	
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}
	
	private function confirm_query($result) {
		if(!$result) {
			$output = "Database query failed: " . mysql_error() . "<br /><br />";
			$output .= "Last SQL query: " . $this->last_query;
			die($output);
		}
	}
	
	public function fetch_array($result) {
		return mysql_fetch_array($result);
	}
	
	public function free_result($result) {
		return mysql_free_result();
	}
	
	public function num_rows($result) {
		return mysql_num_rows($result);
	}
	
	public function affected_rows() {
		return mysql_affected_rows($this->connection);
	}
	
	public function insert_id() {
		return mysql_insert_id($this->connection);
	}
	
}

$database = new MySQL();

?>