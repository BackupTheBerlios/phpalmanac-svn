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

    public static function Render($phpa) {

        require_once 'Calendar/Month/Weekdays.php';
        require_once 'Calendar/Day.php';
        require_once 'Calendar/Util/Textual.php';

        $main = new self($phpa);

        $cur_d = isset($_GET['d']) ? intval($_GET['d']) : date('d');
        $cur_m = isset($_GET['m']) ? intval($_GET['m']) : date('m');
        $cur_y = isset($_GET['y']) ? intval($_GET['y']) : date('Y');

        if (FALSE === checkdate($cur_m, $cur_d, $cur_y)) {

            $cur_d = date('d');
            $cur_m = date('m');
            $cur_y = date('Y');

        }

        $cur_ts = mktime(0,0,0, $cur_m, $cur_d, $cur_y);

        $main->tpl->assign('cur_ts', $cur_ts); // unix timestamp
        $main->tpl->assign('title_string', date('F Y', $cur_ts)); // to be used between the <title></title> tags

        $main->tpl->assignRef('cur_d', $cur_d);
        $main->tpl->assignRef('cur_m', $cur_m);
        $main->tpl->assignRef('cur_y', $cur_y);

        // dropdown boxes data
        // crange() is just like range() except works with strings. see libs/functions.lib.php

        $main->tpl->assign('month_select', array_combine(crange('01', '12'), Calendar_Util_Textual::monthNames('short')));
        $main->tpl->assign('year_select', range($cur_y - 1, $cur_y + 5));

        $cur_month = new Calendar_Month_Weekdays($cur_y, $cur_m, $phpa->config['week_start']);

        $main->tpl->assign('cur_month', $cur_month); // asigns a Calendar_Month_Weekday object *as reference*

        $main->tpl->assign('prev_month', $cur_month->prevMonth(TRUE)); // assigns a timestamp
        $main->tpl->assign('next_month', $cur_month->nextMonth(TRUE)); // assigns a timestamp

        // get list of weekdays like sun...sat. Weekday starts as per $phpa->config['week_start']
        $main->tpl->assign('weekdays', Calendar_Util_Textual::weekdayNames('short', $phpa->config['week_start']));

        // ...

        $hash = new MonthHasher($phpa->DB, $cur_y, $cur_m);
        $selection = array();

        while ($row = $hash->fetch()) {
            $selection[] = new Calendar_Day($cur_y, $cur_m, $row['d']);
        }

        $cur_month->build($selection);
        $main->tpl->assign('hash', $hash);

        $main->tpl->display('month_view.tpl.php');

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