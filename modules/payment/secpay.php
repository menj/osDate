<?php
/*
  $Id: secpay.php,v 1.1.1.1 2006/06/07 19:48:26 cvs Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class secpay {
    var $code, $title;
	var $osDB;
// class constructor
    function secpay() {

      $this->code = 'secpay';
      $this->title = 'SECPay';
	  $this->osDB =& $GLOBALS['osDB'];

      $this->form_action_url = 'https://www.secpay.com/java-bin/ValCard';
    }

// class methods
    function javascript_validation() {
      return false;
    }

    function process_button() {


		global $t, $amount;

		$confdata = $this->osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, 'secpay' ) );

		foreach( $confdata as $confitem ) {

			$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

		}
		unset($confdata);

      switch ($paymod_data['MODULE_PAYMENT_SECPAY_TEST_STATUS']) {
        case 'Always Fail':
          $test_status = 'false';
          break;
        case 'Production':
          $test_status = 'live';
          break;
        case 'Always Successful':
        default:
          $test_status = 'true';
          break;
      }

    $md5hash = md5($paymod_data['MODULE_PAYMENT_SECPAY_MERCHANT_ID'].$_SESSION['invoice_no'].$amount.$paymod_data['MODULE_PAYMENT_SECPAY_REMOTE_PASSWORD']);

	$t->assign('md5hash', $md5hash);

	$t->assign('test_status',$test_status);

	$t->assign('currency', $paymod_data['MODULE_PAYMENT_SECPAY_CURRENCY']);

	$t->assign( 'merchant', $paymod_data['MODULE_PAYMENT_SECPAY_MERCHANT_ID'] );

//			$t->assign( 'options', 'test_status=' . $test_status . ',dups=false,cb_post=true,cb_flds=' );

			$t->assign('rendered_page', $t->fetch('secpay_checkout.tpl') );

    }

    function before_process() {
      global $HTTP_POST_VARS;

      if ($HTTP_POST_VARS['valid'] == 'true') {
        if ($remote_host = getenv('REMOTE_HOST')) {
          if ($remote_host != 'secpay.com') {
            $remote_host = gethostbyaddr($remote_host);
          }
          if ($remote_host != 'secpay.com') {
            tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, tep_session_name() . '=' . $HTTP_POST_VARS[tep_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
          }
        } else {
          tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, tep_session_name() . '=' . $HTTP_POST_VARS[tep_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
        }
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      if (isset($HTTP_GET_VARS['message']) && (strlen($HTTP_GET_VARS['message']) > 0)) {
        $error = stripslashes(urldecode($HTTP_GET_VARS['message']));
      } else {
        $error = MODULE_PAYMENT_SECPAY_TEXT_ERROR_MESSAGE;
      }

      return array('title' => MODULE_PAYMENT_SECPAY_TEXT_ERROR,
                   'error' => $error);
    }

    function check() {
      if (!isset($this->_check)) {
        $this->_check = $this->osDB->getOne("select count(configuration_value) from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_SECPAY_STATUS'");
      }
      return $this->_check;
    }

    function install() {
		$is_there = $this->osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_SECPAY_STATUS') );

		if (!$is_there) {

      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Enable SECpay Module', 'MODULE_PAYMENT_SECPAY_STATUS', 'True', 'Do you want to accept SECPay payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'secpay')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Merchant ID', 'MODULE_PAYMENT_SECPAY_MERCHANT_ID', 'secpay', 'Merchant ID to use for the SECPay service', '6', '2', now(), 'secpay')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Currency', 'MODULE_PAYMENT_SECPAY_CURRENCY', 'USD', 'The currency to use for credit card transactions', '6', '3', 'tep_cfg_select_option(array(\'Any Currency\', \'Default Currency\'), ', now(), 'secpay')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Transaction Mode', 'MODULE_PAYMENT_SECPAY_TEST_STATUS', 'Always Successful', 'Transaction mode to use for the SECPay service', '6', '4', 'tep_cfg_select_option(array(\'Always Successful\', \'Always Fail\', \'Production\'), ', now(), 'secpay')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Sort order of display.', 'MODULE_PAYMENT_SECPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now(), 'secpay')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added, module_key) values ('Payment Zone', 'MODULE_PAYMENT_SECPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now(), 'secpay')" );
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added, module_key) values ('Set Order Status', 'MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now(), 'secpay')");
      $this->osDB->query(  "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added, module_key) values ('Set Remote Password', 'MODULE_PAYMENT_SECPAY_REMOTE_PASSWORD', 'secpay', 'Set the remote password generated for your Merchant Account', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now(), 'secpay')");
      $this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added, module_key) values ('Set Digest Key', 'MODULE_PAYMENT_SECPAY_DIGESTKEY', 'secpay', 'Set the Digest Key generated for your Merchant Account', '6', '0', '', '', now(), 'secpay')" );
		}
    }

		function update( $configuration ) {
			while (list ($key, $val) = each ($configuration)) {
				$this->osDB->query( "update ! set configuration_value = ? where configuration_key = ? ", array( TABLE_CONFIGURATION, $val, $key ) );
			}
		}

    function remove() {
      $this->osDB->query(  "delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')" );
    }

    function keys() {
      return array('MODULE_PAYMENT_SECPAY_STATUS', 'MODULE_PAYMENT_SECPAY_MERCHANT_ID', 'MODULE_PAYMENT_SECPAY_CURRENCY', 'MODULE_PAYMENT_SECPAY_TEST_STATUS', 'MODULE_PAYMENT_SECPAY_ZONE', 'MODULE_PAYMENT_SECPAY_ORDER_STATUS_ID', 'MODULE_PAYMENT_SECPAY_SORT_ORDER','MODULE_PAYMENT_SECPAY_DIGESTKEY', 'MODULE_PAYMENT_SECPAY_REMOTE_PASSWORD' );
    }
  }
?>
