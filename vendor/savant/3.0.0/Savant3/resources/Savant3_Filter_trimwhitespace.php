<?php

/**
* 
* Remove extra white space within the text.
* 
* $Id$
* 
* @author Monte Ohrt <monte@ispi.net>
* 
* @author Contributions from Lars Noschinski <lars@usenet.noschinski.de>
* 
* @author Converted to a Savant3 filter by Paul M. Jones
* <pmjones@ciaweb.net>
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

class Savant3_Filter_trimwhitespace extends Savant3_Filter {

	/**
	* 
	* Removes extra white space within the text.
	* 
	* Trim leading white space and blank lines from template source after it
	* gets interpreted, cleaning up code and saving bandwidth. Does not
	* affect <pre>, <script>, or <textarea> blocks.
	* 
	* @access public
	* 
	* @param string $buffer The source text to be filtered.
	*
	*/
	
	public function filter($buffer)
	{
		// Pull out the script blocks
		preg_match_all("!<script[^>]+>.*?</script>!is", $buffer, $match);
		$_script_blocks = $match[0];
		$buffer = preg_replace(
			"!<script[^>]+>.*?</script>!is",
			'@@@SAVANT:TRIM:SCRIPT@@@',
			$buffer
		);
	
		// Pull out the pre blocks
		preg_match_all("!<pre[^>]*>.*?</pre>!is", $buffer, $match);
		$_pre_blocks = $match[0];
		$buffer = preg_replace(
			"!<pre[^>]*>.*?</pre>!is",
			'@@@SAVANT:TRIM:PRE@@@',
			$buffer
		);
	
		// Pull out the textarea blocks
		preg_match_all("!<textarea[^>]+>.*?</textarea>!is", $buffer, $match);
		$_textarea_blocks = $match[0];
		$buffer = preg_replace(
			"!<textarea[^>]+>.*?</textarea>!is",
			'@@@SAVANT:TRIM:TEXTAREA@@@',
			$buffer
		);
	
		// remove all leading spaces, tabs and carriage returns NOT
		// preceeded by a php close tag.
		$buffer = trim(preg_replace('/((?<!\?>)\n)[\s]+/m', '\1', $buffer));
	
		// replace script blocks
		Savant3_Filter_trimwhitespace::_replace(
			"@@@SAVANT:TRIM:SCRIPT@@@",
			$_script_blocks,
			$buffer
		);
	
		// replace pre blocks
		Savant3_Filter_trimwhitespace::_replace(
			"@@@SAVANT:TRIM:PRE@@@",
			$_pre_blocks,
			$buffer
		);
	
		// replace textarea blocks
		Savant3_Filter_trimwhitespace::_replace(
			"@@@SAVANT:TRIM:TEXTAREA@@@",
			$_textarea_blocks,
			$buffer
		);
	
		return $buffer;
	}

	protected function _replace($search_str, $replace, &$subject)
	{
		$_len = strlen($search_str);
		$_pos = 0;
		for ($_i=0, $_count=count($replace); $_i<$_count; $_i++) {
			if (($_pos=strpos($subject, $search_str, $_pos))!==false) {
				$subject = substr_replace($subject, $replace[$_i], $_pos, $_len);
			} else {
				break;
			}
		}
	}

}
?>