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

require_once 'class.AtomBuilderBase.inc.php';

/**
* Class for creating an Atom-Feed
* @author Michael Wimmer <flaimo@gmx.net>
* @category FLP
* @copyright Copyright © 2002-2006, Michael Wimmer
* @license Free for non-commercial use
* @link http://flp.sf.net/
* @package Atom
* @version 1.00RC2
*/
class AtomBuilderContent extends AtomBuilderText {

	protected $link;

	function __construct($data = '', $type = 'text', $link = '') {
		parent::__construct($data, $type);
		if (parent::isFilledString($link)) {
			$this->setLink($link);
		} // end if
	} // end constructor

	public function setLink($string = '') {
		return parent::setVar($string, 'link', 'string');
	} // end function

	public function setContentType($string = '') {
		if (in_array($string, $this->allowed_types) == TRUE || preg_match('(^[a-zA-Z0-9]+/[a-zA-Z0-9]+$)', $string) > 0) {
			return parent::setVar($string, 'type', 'string');
		} // end if
		return FALSE;
	} // end function

/*
	public function setMode($string = 'escaped') {
		if (array_key_exists($string, $this->allowed_modes) == TRUE) {
			if (!isset($this->type)) {
				return parent::setVar($string, 'mode', 'string');
			} // end if

			foreach ($this->allowed_modes as $mode => $types) {
				if (in_array($this->type, $types) == TRUE) {
					return parent::setVar($mode, 'mode', 'string');
				} // end if
			} // end foreach

			return parent::setVar($string, 'mode', 'string');
		} // end if
	} // end function
*/
	public function getLink() {
		return parent::getVar('link');
	} // end function
} // end class
?>