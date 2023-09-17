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
class AtomBuilderObjectList extends AtomBuilderBase implements IteratorAggregate {

	protected $size = 20;
	protected $offset = 0;
	public $objects;
	protected $factory;

	function __construct($offset = 0, $size = 20) {
		parent::__construct();
		$this->setSize($size);
		$this->setOffset($offset);
	} // end constructor

	public function setSize($size = 20) {
		$this->size = (int) $size;
	} // end function

	public function setOffset($offset = 0) {
		$this->offset = (int) $offset;
	} // end function

	public function addObject($object) {
		if (is_object($object)) {
			$this->objects[] = $object;
			return (boolean) TRUE;
		} // end if
		return (boolean) FALSE;
	} // end function

	public function getSize() {
		return $this->size;
	} // end function

	public function getListSize() {
		return count($this->getList());
	} // end function

	public function getOffset() {
		return $this->offset;
	} // end function

	public function getList() {
		return $this->objects;
	} // end function

	public function setFactory($class_name = FALSE) {
		if (!isset($class_name) || $class_name === FALSE) {
			return (boolean) FALSE;
		} // end if

		$this->factory =& parent::getObjectFactory($class_name);
		return (boolean) TRUE;
	} // end function

	public function getIterator() {
		return new AtomBuilderObjectIterator($this);
	} // end function
} // end class
?>