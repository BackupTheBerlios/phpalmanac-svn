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

class ViewEvent extends GenClass {

    private $id;

    public function Render() {

        $this->id = isset($_GET['id']) ? int_val($_GET['id']) : 0;
        $this->tpl->assign('title_string', date('l F j, Y', $this->ts)); // to be used between the <title></title> tags

        $result = $this->DB->query('SELECT title, time_start, time_end, descrip FROM ' . T_MAIN . ' WHERE ID = ' . $this->id);
        
        if ($result->num_rows() != 1) {
            return FALSE;
        }

        $this->tpl->assign('data', $result->fetch());
        $this->tpl->display('viewevent.tpl.php');

    }

}

?>