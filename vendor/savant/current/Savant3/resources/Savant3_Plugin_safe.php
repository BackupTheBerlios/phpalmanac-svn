<?php

/**
* 
* Modifies a value with a series of callbacks.
* 
* $Id$
* 
* @author Paul M. Jones <pmjones@ciaweb.net>
* 
* @package Savant3
* 
* @license http://www.gnu.org/copyleft/lesser.html LGPL
* 
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU Lesser General Public License as
* published by the Free Software Foundation; either version 2.1 of the
* License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
* 
*/

class Savant3_Plugin_safe extends Savant3_Plugin {
	
	/**
	* 
	* The default callbacks to apply when making output safe.
	* 
	*/
	
	public $callbacks = array('htmlspecialchars');
	
	
	/**
	* 
	* Modifies a value with a series of callbacks to make it safe for output.
	* 
	* echo $this->safe($value, 'stripslashes strtolower htmlentities');
	* 
	* @access public
	* 
	* @param string $value The value to be modified.
	* 
	* @param string|array $callbacks An array of parameters for
	* call_user_func().
	* 
	* @return mixed
	* 
	*/
	
	function safe($value, $callbacks = null)
	{
		if (is_null($callbacks)) {
			$callbacks = $this->callbacks;
		}
		
		// is there a space-delimited callback list?
		// if so, treat as a series of functions.
		if (is_string($callbacks)) {
			// yes.  split into an array of the
			// functions to be called.
			$callbacks = explode(' ', $callbacks);
		}
		
		
		// loop through the callback list and
		// apply to the output in sequence.
		foreach ($callbacks as $func) {
			if (trim($func) != '') {
				$value = call_user_func($func, $value);
			}
		}
		
		return $value;
	}

}
?>