<?php
/*
getImage.php
Copyright (C) 2004-2006 Peter Frueh (http://www.ajaxprogrammer.com/)

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
	This program is modified and customized to work withosDate 2.1.0 onwards
	Vijay Nair
*/

if ( !defined( 'SMARTY_DIR' ) ) {
	include_once( '../minimum_init.php' );
}

$imageName = USER_IMAGE_EDITS_DIR.$_SESSION['picedit']['userid'].'/'.$_GET["imageName"];

if(empty($imageName) || !file_exists($imageName)) { exit; }

$output = imagecreatefromjpeg($imageName);
imagejpeg($output, "", 100);
imagedestroy($output);

?>