<?php

/**
* 
* Abstract Savant3_Filter class.
* 
* You have to extend this class for it to be useful; e.g., "class
* Savant3_Filter_example extends Savant3_Filter".
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

abstract class Savant3_Filter {
	
	
	/**
	* 
	* Optional reference to the calling Savant object.
	* 
	* @var object
	* 
	*/
	
	protected $Savant = null;
	
	
	/**
	* 
	* Constructor.
	* 
	* @access public
	* 
	*/
	
	public function __construct($conf = null, $Savant = null)
	{
		settype($conf, 'array');
		foreach ($conf as $key => $val) {
			$this->$key = $val;
		}
		$this->Savant = $Savant;
	}
	
	
	/**
	* 
	* Stub method for extended behaviors.
	*
	* @access public
	* 
	* @param string $buffer The text buffer to filter.
	*
	* @return void
	*
	*/
	
	public function filter($text)
	{
		return $text;
	}
}
?>