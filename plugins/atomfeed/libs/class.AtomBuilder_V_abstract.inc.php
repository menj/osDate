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

require_once 'interface.AtomBuilder.inc.php';
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
abstract class AtomBuilder_V_abstract extends AtomBuilderBase implements AtomBuilderInterface {

	protected $atomdata;
	protected $xml;
	protected $filename;

	function __construct(AtomBuilder &$atomdata) {
		parent::__construct();
		$this->atomdata =& $atomdata;
	} // end constructor

	protected function getAtomData() {
		return $this->atomdata;
	} // end function

	protected function generateXML() {
		$this->xml = new DomDocument('1.0', $this->atomdata->getEncoding());
		$this->xml->appendChild($this->xml->createComment('Atom generated by Flaimo.com AtomBuilder [' .  date('Y-m-d H:i:s')  .']'));
	} // end function

	public function outputAtom($output = TRUE) {
		if (!isset($this->xml)) {
			$this->generateXML();
		} // end if
		echo $this->xml->saveXML();
	} // end function

	public function saveAtom($path = '') {
		if (!isset($this->xml)) {
			$this->generateXML();
		} // end if
		$this->xml->save($path . $this->atomdata->getFilename());
		return (string) $path . $this->atomdata->getFilename();
	} // end function

	public function getAtomOutput() {
		if (!isset($this->xml)) {
			$this->generateXML();
		} // end if
		return $this->xml->saveXML();
	} // function
} // end class
?>