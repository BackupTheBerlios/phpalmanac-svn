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

abstract class GenClass {

    protected $phpa;
    protected $DB;
    protected $tpl;

    protected $y, $m, $d;
    protected $ts;

    public function __construct($phpa) {

        require_once 'Calendar/Util/Textual.php';

        $this->phpa = $phpa;
        $this->DB   = $phpa->DB;
        $this->tpl  = $phpa->tpl;

        $this->d = isset($_GET['d']) ? intval($_GET['d']) : date('d');
        $this->m = isset($_GET['m']) ? intval($_GET['m']) : date('m');
        $this->y = isset($_GET['y']) ? intval($_GET['y']) : date('Y');

        if (FALSE === checkdate($this->m, $this->d, $this->y)) {

            $this->d = date('d');
            $this->m = date('m');
            $this->y = date('Y');

        }

        $this->ts = mktime(0,0,0, $this->m, $this->d, $this->y);

        $this->tpl->assign('ts', $this->ts); // unix timestamp

        $this->tpl->assignRef('d', $this->d);
        $this->tpl->assignRef('m', $this->m);
        $this->tpl->assignRef('y', $this->y);

        // dropdown boxes data
        // crange() is just like range() except works with strings. see libs/functions.lib.php

        $this->tpl->assign('month_select', array_combine(crange('01', '12'), Calendar_Util_Textual::monthNames('short')));
        $this->tpl->assign('year_select', range($this->y - 1, $this->y + 5));

    }

    abstract public function Render();

}

?>