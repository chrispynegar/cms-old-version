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

class Core {
	
	protected static $table_name;
	
	public static function instantiate($record) {
		$class_name = get_called_class();
		$object = new $class_name;
		foreach($record as $attribute => $value) {
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	public static function find_all() {
		return static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " ORDER BY id ASC");
	}
	
	public static function find_by_id($id=0) {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_default() {
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE id=1 LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_sql($sql="") {
		global $database;
		$result = $database->query($sql);
		$object_array = array();
		while($row = $database->fetch_array($result)) {
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
	}
	
	public function count_all() {
		global $database;
		$sql = "SELECT COUNT(*) FROM " . DATABASE_TBL_PREFIX . static::$table_name;
		$result = $database->query($sql);
		$row = $database->fetch_array($result);
		return array_shift($row);
	}
	
	public static function count_specific($field, $value) {
		global $database;
		$sql = "SELECT COUNT(*) FROM " . DATABASE_TBL_PREFIX . static::$table_name . " WHERE {$field}={$value}";
		$result = $database->query($sql);
		$row = $database->fetch_array($result);
		return array_shift($row);
	}
	
	private function has_attribute($attribute) {
		$object_vars = get_object_vars($this);
		return array_key_exists($attribute, $object_vars);
	}
	
	protected function attributes() {
		$attributes = array();
		foreach(static::$table_fields as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes() {
		global $database;
		$clean_attributes = array();
		foreach($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	public static function get_table_name() {
		return static::$table_name;
	}
	
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO " . DATABASE_TBL_PREFIX . static::$table_name . " (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		if($database->query($sql)) {
			$this->id - $database->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	public function update() {
		global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key} = '{$value}'";
		}
		$sql = "UPDATE " . DATABASE_TBL_PREFIX . static::$table_name . " SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE id=" . $database->escape_value($this->id);
		$database->query($sql);
		return ($database->affected_rows() == 1) ? true : false;
	}
	
	public function delete() {
		global $database;
	  $sql = "DELETE FROM " . DATABASE_TBL_PREFIX . static::$table_name;
	  $sql .= " WHERE id=". $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}
	
	public function save() {
		return isset($this->id) ? $this->update() : $this->create();
	}
	
}

?>