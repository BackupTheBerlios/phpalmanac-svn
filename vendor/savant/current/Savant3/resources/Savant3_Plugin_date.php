<?php

/**
* 
* Outputs a formatted date using strftime() conventions.
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

class Savant3_Plugin_date extends Savant3_Plugin {
	
	/**
	* 
	* The strftime() format strings to use for dates.
	* 
	* You can preset the format strings via Savant::setDefaults().
	* 
	* $conf = array(
	*     'format' => array(
	*         'default' => '%c',
	*         'mydate' => '%Y-%m-%d',
	*         'mytime' => '%R'
	*     )
	* );
	* 
	* $Savant->setDefaults('date', $conf);
	* 
	* ... and in your template, to use a preset custom string by name:
	* 
	*     echo $this->date($value, 'mydate');
	* 
	* @access public
	* 
	* @var array
	* 
	*/
	
	public $default = '%c';
	
	public $custom = array(
		'date'    => '%Y-%m-%d',
		'time'    => '%H:%M:%S'
	);
	
	
	/**
	* 
	* Outputs a formatted date using strftime() conventions.
	* 
	* @access public
	* 
	* @param string $datestring Any date-time string suitable for
	* strtotime().
	* 
	* @param string $format The strftime() formatting string, or a named
	* custom string key from $this->custom.
	* 
	* @return string
	* 
	*/
	
	function date($datestring, $format = null)
	{
		settype($format, 'string');
		
		if (is_null($format)) {
			$format = $this->default;
		}
		
		// does the format string have a % sign in it?
		if (strpos($format, '%') === false) {
			// no, look for a custom format string
			if (! empty($this->custom[$format])) {
				// found a custom format string
				$format = $this->custom[$format];
			} else {
				// did not find the custom format, revert to default
				$format = $this->default;
			}
		}
		
		// convert the date string to the specified format
		if (trim($datestring != '')) {
			return strftime($format, strtotime($datestring));
		} else {
			// no datestring, return VOID
			return;
		}
	}

}
?>