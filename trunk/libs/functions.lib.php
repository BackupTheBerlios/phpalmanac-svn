<?php

/*
   +----------------------------------------------------------------------+
   | PhpAlmanac 1.0.0                                                     |
   +----------------------------------------------------------------------+
   | Copyright (C) 2005 by Rajesh Kumar                                   |
   +----------------------------------------------------------------------+
   | This program is free software; you can redistribute it and/or modify |
   | it under the terms of the GNU General Public License as published by |
   | the Free Software Foundation; either version 2 of the License, or    |
   | (at your option) any later version.                                  |
   |                                                                      |
   | This program is distributed in the hope that it will be useful,      |
   | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
   | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
   | GNU General Public License for more details.                         |
   |                                                                      |
   | You should have received a copy of the GNU General Public License    |
   | along with this program; if not, write to the                        |
   | Free Software Foundation, Inc.,                                      |
   | 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.            |
   +----------------------------------------------------------------------+
   | Author: Rajesh Kumar <rks@meetrajesh.com>                            |
   +----------------------------------------------------------------------+
  
   $Id$

*/

function phpa_add_slashes(&$input) {

    $input = addslashes($input);
}

function gdir($dir) {

    return chop($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}

function error($msg) {

    global $phpa;

    $phpa->tpl->assignRef('error_msg', $msg);
    $phpa->tpl->display('error.tpl.php');
    exit;

}

/* same as range(), but with string keys like '01', '02', etc. */
function crange($start, $end, $step=1) {

    $pad_len = strlen(min($start, $end));
    return mypad(range($start, $end, $start), $pad_len);

}

/* pad LEFT with zeroes until length=$pad_length */
function mypad($input, $pad_length=2) {

    if (is_array($input)) {

        $func = __FUNCTION__;

        foreach ($input as $key => $val) {
            $input[$key] = $func($val, $pad_length);
        }

        return $input;

    } else {

        return str_pad($input, $pad_length, '0', STR_PAD_LEFT);

    }

}

/* date/time functions */

function format_time($time) {

    // takes input in the form hh:mm:ss and returns as h[12]:mm am/pm

    if ($time == '00:00:00') {
        return '';
    }

    $tmp = explode(':', $time);
    $tmp = mktime($tmp[0], $tmp[1], $tmp[2]);
    return date('g:i A', $tmp);

}

/* string functions */

/* integer functions */

function int_val($int) {

    if (is_array($int)) {
        return array_map(__FUNCTION__, $int);
    }
        
    preg_match('([0-9]+)', $int, $board);
    return isset($board[0]) ? (int) $board[0] : 0;
        
}

/* miscellaneous functions */

?>