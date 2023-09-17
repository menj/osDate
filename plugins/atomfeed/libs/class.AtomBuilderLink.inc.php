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
* @version 1.00
*/
class AtomBuilderLink extends AtomBuilderBase {
	protected $relation;
	protected $type;
	protected $url;
	protected $title;
	protected $url_lang;
	protected $length;
	protected $allowed_rel_types = array('alternate', 'enclosure', 'related', 'self', 'via', 'icon', 'logo');

	function __construct($url = '') {
		parent::__construct();
		$this->setURL($url);
		$this->setRelation('alternate');
	} // end constructor


	public function setRelation($string = '') {
		if (strlen(trim($string)) > 0 && in_array($string, $this->allowed_rel_types) == TRUE) {
			return parent::setVar($string, 'relation', 'string');
		} // end if
		return FALSE;
	} // end function

	public function setLinkType($string = '') {
		return parent::setVar($string, 'type', 'string');
	} // end function

	public function setURL($string = '') {
		return parent::setVar($string, 'url', 'string');
	} // end function

	public function setTitle($string = '') {
		return parent::setVar($string, 'title', 'string');
	} // end function

	public function setLength($string = '') {
		return parent::setVar($string, 'length', 'string');
	} // end function

	public function setURLlang($string = '') {
		if (parent::isLanguage($string) == FALSE) {
			return FALSE;
		} // END IF
		return parent::setVar($string, 'url_lang', 'string');
	} // end function

	public function getRelation() {
		return parent::getVar('relation');
	} // end function

	public function getLinkType() {
		return parent::getVar('type');
	} // end function

	public function getURL() {
		return parent::getVar('url');
	} // end function

	public function getTitle() {
		return parent::getVar('title');
	} // end function

	public function getURLlang() {
		return parent::getVar('url_lang');
	} // end function

	public function getLength() {
		return parent::getVar('length');
	} // end function
} // end class
?>