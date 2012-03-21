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
 
class Html {

	/**
	  * html builder functions
	 */
	
	// --------------------------------------------------------------------------------
	
	// opens a new div 
	
	function open_div($id = NULL, $class = NULL, $other = NULL, $value = NULL, $autoclose = FALSE) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		if($value != NULL) {
			$value = $value;
		}
		if($autoclose == TRUE) {
			$autoclose = '</div>';
		}
		echo '<div'.$id.$class.$other.'>'.$value.$autoclose;
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// closes a div
	
	function close_div() {
		echo '</div>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// creates a new heading
	
	function heading($value = NULL, $level = 1, $id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<h'.$level.$id.$class.$other.'>'.$value.'</h'.$level.'>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// creates a new anchor link
	
	function link($value = NULL, $href = NULL, $title = NULL, $id = NULL, $class = NULL, $other = NULL) {
		if($value != NULL) {
			$value = $value;
		}
		if($href != NULL) {
			$href = ' href="'.$href.'"';
		}
		if($title != NULL) {
			$title = ' title="'.$title.'"';
		}
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<a'.$href.$title.$id.$class.$other.'>'.$value.'</a>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// open anchor link
	
	function open_link($href = NULL, $id = NULL, $class = NULL, $other = NULL) {
		if($href != NULL) {
			$href = ' href="'.$href.'"';
		}
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<a'.$href.$id.$class.$other.'>';
	}
	
	// --------------------------------------------------------------------------------
	
	// close anchor link
	
	function close_link() {
		echo '</a>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// opens a new table
	
	function open_table($id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<table'.$id.$class.$other.'>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// closes a table
	
	function close_table() {
		echo '</table>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// opens a table row
	
	function open_table_row($id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<tr'.$id.$class.$other.'>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// closes a table row
	
	function close_table_row() {
		echo '</tr>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// creates a table header cell
	
	function table_heading($value = NULL, $id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<th'.$id.$class.$other.'>'.$value.'</th>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// opens a table header cell
	
	function open_table_heading($id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<th'.$id.$class.$other.'>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// closes a table header cell
	
	function close_table_header() {
		echo '</th>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// creates a table header cell
	
	function table_data($value = NULL, $id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<td'.$id.$class.$other.'>'.$value.'</td>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// opens a table data cell
	
	function open_table_data($id = NULL, $class = NULL, $other = NULL) {
		if($id != NULL) {
			$id = ' id="'.$id.'"';
		}
		if($class != NULL) {
			$class = ' class="'.$class.'"';
		}
		if($other != NULL) {
			$other = ' '.$other;
		}
		echo '<td'.$id.$class.$other.'>';
		newline();
	}
	
	// --------------------------------------------------------------------------------
	
	// closes a table data cell
	
	function close_table_data() {
		echo '</td>';
		newline();
	}

}

// create a new instance of the html class
$html = new Html();
 
?>