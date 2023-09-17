<?php
/*
  $Id: nochex.php,v 1.1.1.1 2006/06/07 19:48:24 cvs Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class nochex {
    var $code, $title;
	var $osDB;
// class constructor
    function nochex() {

      $this->code = 'nochex';

      $this->title = 'NOCHEX';
	  $this->osDB =& $GLOBALS['osDB'];

      $this->form_action_url = 'https://www.nochex.com/nochex.dll/checkout';
    }

// class methods

    function javascript_validation() {
      return false;
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
			global $t;

			$confdata = $this->osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, 'nochex' ) );

			foreach( $confdata as $confitem ) {

				$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

			}

			unset($confdata);

			$t->assign( 'email', $paymod_data['MODULE_PAYMENT_NOCHEX_ID'] );

			$t->assign( 'test_mode', $paymod_data['MODULE_PAYMENT_NOCHEX_TESTMODE'] );

			$t->assign('rendered_page', $t->fetch('nochex_checkout.tpl') );

    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $this->_check= $this->osDB->getOne("select count(configuration_value) from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_NOCHEX_STATUS'");
      }
      return $this->_check;
    }

    function install() {
		$is_there = $this->osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_NOCHEX_STATUS') );

		if (!$is_there) {

      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Enable NOCHEX Module', 'MODULE_PAYMENT_NOCHEX_STATUS', 'True', 'Do you want to accept NOCHEX payments?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'nochex')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('E-mail Address', 'MODULE_PAYMENT_NOCHEX_ID', 'test1@nochex.com', 'E-mail address of nochex account', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'nochex')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Mode', 'MODULE_PAYMENT_NOCHEX_TESTMODE', 'test', 'Transaction mode used for processing orders (test/live)', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now(), 'nochex')" );
		}
    }

		function update( $configuration ) {
			while (list ($key, $val) = each ($configuration)) {
				$this->osDB->query( "update ! set configuration_value = ? where configuration_key = ? ", array( TABLE_CONFIGURATION, $val, $key ) );
			}
		}

    function remove() {
      $this->osDB->query( "delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')" );
    }

    function keys() {
      return array('MODULE_PAYMENT_NOCHEX_STATUS', 'MODULE_PAYMENT_NOCHEX_ID', 'MODULE_PAYMENT_NOCHEX_TESTMODE');
    }
  }
?>
