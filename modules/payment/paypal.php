<?php
/*
  $Id: paypal.php,v 1.1.1.1 2006/06/07 19:48:19 cvs Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class paypal {
    var $code, $title;
	var $osDB;
// class constructor
    function paypal() {

      $this->code = 'paypal';
      $this->title = 'PayPal';
	  $this->osDB =& $GLOBALS['osDB'];

      $this->form_action_url = 'https://secure.paypal.com/cgi-bin/webscr';
    }

// class methods
    function javascript_validation() {
      return false;
    }

    function process_button() {
			global $t;

			$confdata = $this->osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, 'paypal' ) );

			foreach( $confdata as $confitem ) {

				$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

			}
			unset($confdata);
			$t->assign( 'email', $paymod_data['MODULE_PAYMENT_PAYPAL_ID'] );

			$t->assign('test_mode', $paymod_data['MODULE_PAYMENT_PAYPAL_TESTMODE']) ;

			$t->assign('rendered_page', $t->fetch('paypal_checkout.tpl') );

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
        $this->_check =  $this->osDB->getOne("select count(configuration_value) from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_STATUS'");
      }
      return $this->_check;
    }

    function install() {
		$is_there = $this->osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_PAYPAL_STATUS') );

		if (!$is_there) {

      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Enable PayPal Module', 'MODULE_PAYMENT_PAYPAL_STATUS', 'True', 'Do you want to accept PayPal payments?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'paypal')" );
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('E-Mail Address', 'MODULE_PAYMENT_PAYPAL_ID', 'yourname@yourdomain.com', 'The e-mail address to use for the PayPal service', '6', '4', now(), 'paypal')");
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Mode', 'MODULE_PAYMENT_PAYPAL_TESTMODE', 'test', 'The transaction is in test mode or not', '6', '6', 'tep_cfg_select_option(array(\'Selected Currency\',\'Only USD\',\'Only CAD\',\'Only EUR\',\'Only GBP\',\'Only JPY\'), ', now(), 'paypal')" );
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Currency', 'MODULE_PAYMENT_PAYPAL_CURRENCY', 'Selected Currency', 'The currency to use for credit card transactions', '6', '6', 'tep_cfg_select_option(array(\'Selected Currency\',\'Only USD\',\'Only CAD\',\'Only EUR\',\'Only GBP\',\'Only JPY\'), ', now(), 'paypal')");
      $this->osDB->query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now(), 'paypal')");
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added, module_key) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now(), 'paypal')" );
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added, module_key) values ('Set Order Status', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now(), 'paypal')");
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
      return array('MODULE_PAYMENT_PAYPAL_STATUS', 'MODULE_PAYMENT_PAYPAL_ID', 'MODULE_PAYMENT_PAYPAL_CURRENCY', 'MODULE_PAYMENT_PAYPAL_ZONE', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_TESTMODE');
    }
  }
?>
