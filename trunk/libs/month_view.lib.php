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

class MonthView extends GenClass {

    public function Render() {

        require_once 'Calendar/Day.php';
        require_once 'Calendar/Month/Weekdays.php';

        $this->month = new Calendar_Month_Weekdays($this->y, $this->m, $this->phpa->config['week_start']);

        $this->tpl->assign('title_string', date('F Y', $this->ts)); // to be used between the <title></title> tags
        $this->tpl->assign('cur_month', $this->month); // asigns a Calendar_Month_Weekday object *as reference*
        $this->tpl->assign('prev_month', $this->month->prevMonth(TRUE)); // assigns a timestamp
        $this->tpl->assign('next_month', $this->month->nextMonth(TRUE)); // assigns a timestamp

        // get list of weekdays like sun...sat. Weekday starts as per $phpa->config['week_start']
        $this->tpl->assign('weekdays', Calendar_Util_Textual::weekdayNames('short', $this->phpa->config['week_start']));

        // ...

        $hash = new MonthHasher($this->phpa->DB, $this->y, $this->m);
        $selection = array();

        while ($row = $hash->fetch()) {
            $selection[] = new Calendar_Day($this->y, $this->m, $row['d']);
        }

        $this->month->build($selection);
        $this->tpl->assign('hash', $hash);

        $this->tpl->display('month_view.tpl.php');

    }

}

class MonthHasher {

    private $DB;
    private $y;
    private $m;

    private $result;
    private $hash;

    public function __construct($DB, $year, $month) {

        $this->DB = $DB;
        $this->y  = $year;
        $this->m  = $month;

        $this->build_hash();

    }

    private function build_hash() {

        $sql = '

        SELECT ID, IID, DAYOFMONTH(due_date) AS d, title FROM ' . T_MAIN . ' 
        WHERE YEAR(due_date) = ' . $this->y . '
        AND MONTH(due_date)  = ' . $this->m;

        $this->result = $this->DB->query($sql);
        $x = 0;

        while ($row = $this->result->fetch()) {

            $this->hash[$row['d']][$x]['id'] = $row['ID'];
            $this->hash[$row['d']][$x]['iid'] = $row['IID'];
            $this->hash[$row['d']][$x]['title'] = $row['title'];

            $x++;

        }

        $this->result->rewind();

    }

    public function fetch() {

        return $this->result->fetch();
    }

    public function get_events($date) {

        return $this->hash[$date];
    }

}

?>