<?php

/*
   +----------------------------------------------------------------------+
   | PhpAlmanac                                                           |
   | Copyright (C) 2005 by James Logsdon                                  |
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

class DBConnect {

    private $mysqli;

    public function __construct($database, $username='', $password='', $server='localhost') {

        $this->mysqli = new mysqli($server, $username, $password, $database);

        if (mysqli_connect_errno() !== 0) {
            throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
        }

        mysqli_report(MYSQLI_REPORT_ERROR);

    }

    public function query($sql) {

        $result = $this->mysqli->query($sql);

        if (FALSE === $result) {

            throw new Exception($this->mysqli->error, $this->mysqli->errno);

        } else {

            return new DBResult($result, $sql);

        }

    }

    public function prepare($sql) {

        if (FALSE === $stmt = $this->mysqli->prepare($sql)) {

            throw new Exception($this->mysqli->error, $this->mysqli->errno);

        } else {

            return new DBStmt($stmt, $sql);

        }

    }

    public function escape_string($str) {

        return $this->mysqli->real_escape_string($str);
    }

    public function last_insert_id() {

        return $this->mysqli->insert_id;
    }

    public function affected_rows() {

        return $this->mysqli->affected_rows;
    }

    public function array_query($sql, $fetch_type=MYSQLI_ASSOC) {

        return $this->query($sql)->get_col_array();
    }

    public function fetch_query($sql, $fetch_type=MYSQLI_ASSOC) {

        return $this->query($sql)->fetch($fetch_type);
    }

    public function result_query($sql) {

        return $this->query($sql)->get_result();
    }

    public function close() {

        return $this->mysqli->close();
    }

    public function __destruct() {

        return $this->close();
    }

}


class DBResult {

    protected $result;
    protected $sql;

    public function __construct($result, $sql) {

        $this->result = $result;
        $this->sql    = $sql;

    }

    public function fetch($fetch_type=MYSQLI_ASSOC) {

        return $this->result->fetch_array($fetch_type);
    }

    public function rewind() {

        return $this->seek(0);
    }

    public function num_rows() {

        return $this->result->num_rows;
    }

    public function num_fields() {

        return $this->result->field_count;
    }

    public function get_col_array($col=0) {

        $results = array();
        $this->rewind();

        while ($row = $this->fetch()) {
            $results[] = $row[$col];
        }

        $this->rewind();
        return $results;

    }

    public function seek($offset) {

        return $this->result->data_seek($offset);
    }

    public function get_issued_sql() {

        return $this->sql;
    }

    public function get_result($row=0, $column=0) {
        
        $this->seek($row);
        $row = $this->fetch();
        $this->rewind();
        return $row[$column];

    }

    public function field_len($offset=0) {

        return $this->result->lengths[$offset];
    }

    public function free() {

        $this->result->free();
    }

    public function __destruct() {

        /* $this->free(); */
    }

}


class DBStmt extends DBResult {

    public function __construct($result, $sql) {

        parent::__construct($result, $sql);
    }

    public function bind_param() {

        $args = func_get_args(); // security hole
        $eval = '$this->result->bind_param("' . array_shift($args) . '", ###);';
        $inc  = '';

        for ($x=0; $x < sizeof($args); $x++) {
            $inc .= ', $args[' . $x . ']';
        }

        eval(str_replace('###', substr($inc, 2), $eval));

    }
    
    public function execute() {

        if (FALSE === $this->result->execute()) {

            throw new Exception($this->mysqli->error, $this->mysqli->errno);
        }

    }

    public function store_result() {

        $this->result->store_result();
    }

    public function close() {

        $this->result->close();
    }

}

?>