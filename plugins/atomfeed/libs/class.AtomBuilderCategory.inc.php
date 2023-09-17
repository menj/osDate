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
class AtomBuilderCategory extends AtomBuilderBase {
	protected $term;
	protected $scheme;
	protected $label;

	function __construct($term = 'default') {
		parent::__construct();
		$this->setTerm($term);
	} // end constructor

	public function setTerm($string = '') {
		return parent::setVar($string, 'term', 'string');
	} // end function

	public function setScheme($string = '') {
		return parent::setVar($string, 'scheme', 'string');
	} // end function

	public function setLabel($string = '') {
		return parent::setVar($string, 'label', 'string');
	} // end function


	public function getTerm() {
		return parent::getVar('term');
	} // end function

	public function getScheme() {
		return parent::getVar('scheme');
	} // end function

	public function getLabel() {
		return parent::getVar('label');
	} // end function
} // end class
?>