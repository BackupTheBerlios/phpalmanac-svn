<?php

/**
* 
* Uses the tidy library to tidy HTML output.
* 
* $Id:$
* 
* @author Rajesh Kumar <rks@meetrajesh.com>
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

class Savant3_Filter_tidy extends Savant3_Filter {

    /**
    * 
    * Uses the tidy library to tidy HTML output.
    * 
    * @access public
    * 
    * @param string $buffer The source text to be filtered.
    *
    */
    
    public function filter($buffer) {

        $tidy = new tidy;
        $config = array('indent' => true, 'output-xhtml' => true, 'wrap' => 200);
        $tidy->parseString($buffer, $config);
        $tidy->cleanRepair();

        return $tidy->get_output();

    }

}

?>