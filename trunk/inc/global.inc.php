<?php

/***************************************************************************
 *   PhpAlmanac                                                            *
 *   Copyright (C) 2005 by James Logsdon                                   *
 *   necrotic<at>girsbrain<dot>com                                         *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/

error_reporting ( 'E_ALL & E_STRICT' );

if ( !defined ( 'PA_ROOT' ) )
    define ( 'PA_ROOT', dirname ( realpath ( "index.php" ) ) . '/' );

if ( !is_file ( PA_ROOT . 'index.php' ) )
{
    die ( 'The required variable <tt>PA_ROOT</tt> could not be set by PhpAlmanac!' );
}

if ( is_file ( PA_ROOT . 'inc/config.inc.php' ) )
{
    require_once ( PA_ROOT . 'inc/config.inc.php' );
}
else
{
    die ( 'The required configuration file could not be found!' );
}

?>