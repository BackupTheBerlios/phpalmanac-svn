<?php
/**
* 
* Abstract Savant3_Plugin class.
* 
* You have to extend this class for it to be useful; e.g., "class
* Savant2_Plugin_example extends Savant2_Plugin".
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

abstract class Savant3_Plugin {
	
	/**
	* 
	* Reference to the calling Savant object.
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
}
?>