<?php

/**
* A simple Savant3_Exception class.
*/
class Savant3_Exception extends Exception { };


/**
* 
* Throws PHP5 exceptions for Savant.
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

class Savant3_Error_exception extends Savant3_Error {
	
	
	/**
	* 
	* Throws a Savant3_Exception in PHP5.
	* 
	* @return void
	* 
	*/
	
	public function error()
	{
		throw new Savant3_Exception($this->text, $this->code);
	}
}
?>