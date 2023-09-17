<?php
/*
  $Id: pm2checkout.php,v 1.1.1.1 2006/06/07 19:48:19 cvs Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class pm2checkout {
    var $code, $title;
	var $osDB;
// class constructor
    function pm2checkout() {

      $this->code = 'pm2checkout';
      $this->title = '2CheckOut.com';
	  $this->osDB =& $GLOBALS['osDB'];
      $this->form_action_url = 'https://www.2checkout.com/cgi-bin/Abuyers/purchase.2c';
    }

    function process_button() {

			global  $t;

			$confdata = $this->osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, 'pm2checkout' ) );

			foreach( $confdata as $confitem ) {

				$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

			}
			unset($confdata);
			$t->assign( 'loginid', $paymod_data['MODULE_PAYMENT_2CHECKOUT_LOGIN'] );

			$t->assign( 'payment_mode', $paymod_data['MODULE_PAYMENT_2CHECKOUT_TESTMODE']);

			$t->assign('rendered_page', $t->fetch('pm2checkout_checkout.tpl') );

    }

    function before_process() {
    }

    function after_process() {
    }

    function get_error() {
    }

    function check() {
      if (!isset($this->_check)) {
        $this->_check = $this->osDB->getOne("select count(configuration_value) from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_2CHECKOUT_STATUS'");
      }
      return $this->_check;
    }

    function install() {
		$is_there = $this->osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_2CHECKOUT_STATUS') );

		if (!$is_there) {


      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Enable 2CheckOut Module', 'MODULE_PAYMENT_2CHECKOUT_STATUS', 'True', 'Do you want to accept 2CheckOut payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'pm2checkout')" );
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Login/Store Number', 'MODULE_PAYMENT_2CHECKOUT_LOGIN', '18157', 'Login/Store Number used for the 2CheckOut service', '6', '0', now(), 'pm2checkout')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Mode', 'MODULE_PAYMENT_2CHECKOUT_TESTMODE', 'Test', 'Transaction mode used for the 2Checkout service', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now(), 'pm2checkout')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Merchant Notifications', 'MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT', 'True', 'Should 2CheckOut e-mail a receipt to the store owner?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'pm2checkout')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Sort order of display.', 'MODULE_PAYMENT_2CHECKOUT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now(), 'pm2checkout')" );
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added, module_key) values ('Payment Zone', 'MODULE_PAYMENT_2CHECKOUT_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now(), 'pm2checkout')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added, module_key) values ('Set Order Status', 'MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now(), 'pm2checkout')");
		}
    }

    function remove() {
      $this->osDB->query(  "delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')" );
    }

	function update( $configuration ) {
		while (list ($key, $val) = each ($configuration)) {
			$this->osDB->query(  "update ! set configuration_value = ? where configuration_key = ? ", array( TABLE_CONFIGURATION, $val, $key ) );
		}
	}

    function keys() {
      return array('MODULE_PAYMENT_2CHECKOUT_STATUS', 'MODULE_PAYMENT_2CHECKOUT_LOGIN', 'MODULE_PAYMENT_2CHECKOUT_TESTMODE', 'MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT', 'MODULE_PAYMENT_2CHECKOUT_ZONE', 'MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID', 'MODULE_PAYMENT_2CHECKOUT_SORT_ORDER');
    }
  }
?>
