<?php
/**
* 
* Provides a simple error class for Savant.
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

class Savant3_Error {
	
	
	/**
	* 
	* The error code, typically a SAVANT_ERROR_* constant.
	* 
	* @access public
	*
	* @var int
	*
	*/
	
	public $code = null;
	
	
	/**
	* 
	* An array of error-specific information.
	* 
	* @access public
	*
	* @var array
	*
	*/
	
	public $info = array();
	
	
	/**
	* 
	* The error message text.
	*
	* @access public
	*
	* @var string
	*
	*/
	
	public $text = null;
	
	
	/**
	* 
	* A debug backtrace for the error, if any.
	*
	* @access public
	*
	* @var array
	*
	*/
	
	public $trace = null;
	
	
	/**
	* 
	* Constructor.
	*
	* @access public
	*
	* @param array $conf An associative array where the key is a
	* Savant3_Error property and the value is the value for that
	* property.
	*
	*/
	
	public function __construct($conf = array())
	{
		// set public properties
		foreach ($conf as $key => $val) {
			$this->$key = $val;
		}
		
		// add a backtrace
		if ($conf['trace'] === true) {
			$this->trace = debug_backtrace();
		}
		
		// perform extended behaviors
		$this->error();
	}
	
	public function __toString()
	{
		ob_start();
		echo get_class($this) . ': ';
		print_r(get_object_vars($this));
		return ob_get_clean();
	}
	
	/**
	* 
	* Stub method for extended behaviors.
	*
	* @access public
	* 
	* @return void
	*
	*/
	
	function error()
	{
	}
}
?>