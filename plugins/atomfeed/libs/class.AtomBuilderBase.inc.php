<?php
/***********************************************
osDate Open-Source Dating and Matchmaking Script

(c) 2009 TUFaT.com

osDate was created by Darren Gates and Vijay Nair,
and can be downloaded freely from www.TUFaT.com.
It is distributed under the LGPL license.

osDate is free for commercial and non-commercial 
uses. You may modify, re-sell, and re-distribute
osDate. Links back to TUFaT.com are appreciated.

This program is distributed in the hope that it
will be useful, but without any warranty, and 
without even the implied warranty of merchantability
or fitness for a particular purpose. While strong 
efforts have been taken to ensure the reliability,
security, and stability of osDate, all software 
carries risk. Your use of osDate means that you 
understand and accept the risks of using osDate.

For osDate documentation, change log, community
forum, latest updates, and project details,
please go to www.TUFaT.com  The osDate project is
supported through the sale of skins and add-ons,
which are entirely optional but help with the
development and design effort.
***********************************************/

function __autoload($class = ''){
	require_once('class.' . $class . '.inc.php');
} // end function

/**
* Class for creating an Atom-Feed
* @author Michael Wimmer <flaimo@gmx.net>
* @category FLP
* @copyright Copyright © 2002-2006, Michael Wimmer
* @license Free for non-commercial use
* @link http://flp.sf.net/
* @package Atom
* @version 1.00
*/
abstract class AtomBuilderBase {
	protected $allowed_datatypes = array('string', 'int', 'boolean',
								   'object', 'float', 'array');

	function __construct() {
	} // end constructor

	protected function setVar($data = FALSE, $var_name = '', $type = 'string') {
		if (!in_array($type, $this->allowed_datatypes) ||
			$type != 'boolean' && ($data === FALSE ||
			$this->isFilledString($var_name) === FALSE)) {
			return (boolean) FALSE;
		} // end if

		switch ($type) {
			case 'string':
				if ($this->isFilledString($data) === TRUE) {
					$this->$var_name = (string) trim($data);
					return (boolean) TRUE;
				} // end if
			case 'int':
				if (is_numeric($data)) {
					$this->$var_name = (int) $data;
					return (boolean) TRUE;
				} // end if
			case 'boolean':
				if (is_bool($data)) {
					$this->$var_name = (boolean) $data;
					return (boolean) TRUE;
				}  // end if
			case 'object':
				if (is_object($data)) {
					$this->$var_name =& $data;
					return (boolean) TRUE;
				} // end if
			case 'array':
				if (is_array($data)) {
					$this->$var_name = (array) $data;
					return (boolean) TRUE;
				} // end if
		} // end switch
		return (boolean) FALSE;
	} // end function

	protected function getVar($var_name = 'dummy') {
		return (isset($this->$var_name)) ? $this->$var_name: FALSE;
	} // end function

	public static function isFilledString($string = '', $min_length = 0) {
		if ($min_length == 0) {
			return !ctype_space($string);
		} // end if

		return (boolean) (strlen(trim($string)) > $min_length) ? TRUE : FALSE;
	} // end function

	public static function isvalidDate($string = '') {
		return (boolean) ((preg_match('(^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}(\.[0-9]+){0,1}(Z|([\+\-]\d{2}:\d{2}){0,1})$)', $string) > 0) ? TRUE : FALSE);
	} // end function

	public static function isLanguage($iso_string = '') {
		return (preg_match('(^[a-zA-Z]{2}$)', $iso_string) > 0) ? TRUE : FALSE;
	} // end function
} // end class
?>