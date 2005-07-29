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

error_reporting(E_ALL | E_STRICT);

define('PA_ROOT', dirname(__FILE__) . '/');
define('PEAR_PATH', PA_ROOT . 'libs/PEAR/');

set_include_path(PA_ROOT . ':'  . PEAR_PATH);

ini_set('register_globals', 0);
ini_set('allow_call_time_pass_reference', 0);
ini_set('docref_root', null);
ini_set('docref_ext', null);
ini_set('html_errors', 1);
ini_set('track_errors', 0);
ini_set('display_errors', 1);
set_magic_quotes_runtime(0);

require 'config.php';
require 'libs/gen_class.php';
require 'libs/functions.lib.php';
require 'libs/mysql.lib.php';
require 'libs/Savant3.php';

// defining table names

define('T_MAIN',    $db_prefix . 'main');
define('T_ICONS', $db_prefix . 'icons');

$phpa = new StdClass;

$phpa->tpl = new Savant3;
$phpa->tpl->addPath('template', 'templates/');
$phpa->tpl->loadPlugin('qbuild');

if ( !class_exists ( 'mysqli', false ) )
{
	error ( 'You must have MySQLi installed! Please contact your host or recompile php5 with MySQLi!' );
}
try {
    $phpa->DB = new DBConnect($db_name, $db_username, $db_password, $db_host);
} catch (Exception $e) {
    error('Database connection failed. MySQL said: ' . $e->getMessage());
}

$phpa->config['week_start'] = $week_start;

// unsetting config variable to avoid tampering
unset($db_type, $db_host, $db_name, $db_username, $db_password, $db_prefix, $week_start);

// in case .htaccess directive is not respected
if (get_magic_quotes_gpc() !== 1) {

    array_walk_recursive($_GET,     'phpa_add_slashes');
    array_walk_recursive($_POST,    'phpa_add_slashes');
    array_walk_recursive($_COOKIE,  'phpa_add_slashes');
    array_walk_recursive($_REQUEST, 'phpa_add_slashes');

}

?>