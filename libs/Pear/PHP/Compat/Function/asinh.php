<?php
// $Id: asinh.php,v 1.2 2007/04/17 10:09:56 arpad Exp $

/**
 * Replace asinh()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @license     LGPL - http://www.gnu.org/licenses/lgpl.html
 * @copyright   2004-2007 Aidan Lister <aidan@php.net>, Arpad Ray <arpad@php.net>
 * @link        http://php.net/function.asinh
 * @author      Arpad Ray <arpad@php.net>
 * @version     $Revision: 1.2 $
 * @since       PHP 5
 * @require     PHP 3.0.0
 */
function php_compat_asinh($n)
{
    return ln($n + sqrt(1 + pow($n, 2)));
}

if (!function_exists('asinh')) {
    function asinh($n)
    {
	return php_compat_asinh($n);
    }
}
