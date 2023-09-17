<?php
/*
	Class to process e-gold payments
	Vijay Nair
*/

  class egold {
    var $code, $title;
	var $osDB;
// class constructor
    function egold() {

      $this->code = 'egold';
      $this->title = 'e-Gold';

	  $this->osDB =& $GLOBALS['osDB'];

      $this->form_action_url = 'https://www.e-gold.com/sci_asp/payments.asp';
    }

    function process_button() {
			global $t, $currency;
			$curr = $currency;

			if ($curr == 'UKP') $curr = 'GBP';
			if ($curr == 'CD') $curr = 'CAD';

			$currencies = array('USD' => 1, 'CAD' =>  2,
			 	'GBP' => 44, 'AUD' => 61, 'JPY' => 81,
			 	'EUR' => 85
					);

			$t->assign('currencycode',$currencies[$curr]);

			$confdata = $this->osDB->getAll( 'SELECT configuration_key, configuration_value from ! where module_key = ?', array( TABLE_CONFIGURATION, 'egold' ) );

			foreach( $confdata as $confitem ) {

				$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

			}

			unset($confdata);

			$t->assign( 'egold_account', $paymod_data['MODULE_PAYMENT_EGOLD_ID'] );

			$t->assign('egold_name', $paymod_data['MODULE_PAYMENT_EGOLD_NAME']) ;

			$t->assign('egold_metalid', $paymod_data['MODULE_PAYMENT_EGOLD_METALID']) ;

			$t->assign('rendered_page', $t->fetch('egold_checkout.tpl') );

    }

    function check() {
		if (!isset($this->_check)) {
			$this->_check =$this->osDB->getOne("select count(configuration_value) from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_EGOLD_STATUS'");
		}
		return $this->_check;
    }

    function install() {
		$is_there = $this->osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_EGOLD_STATUS') );

		if (!$is_there) {

		$this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Enable E-Gold Module', 'MODULE_PAYMENT_EGOLD_STATUS', 'True', 'Do you want to accept payments through E-Gold?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now(), 'egold')");
		$this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('E-Gold Account Number', 'MODULE_PAYMENT_EGOLD_ID', '123231231', 'Your E-Gold account number', '6', '4', now(), 'egold')" );
		$this->osDB->query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, module_key) values ('Account Name ', 'MODULE_PAYMENT_EGOLD_NAME','mydate.com' , 'Name to be shown to the customer in E-Gold payment screen', '6', '6', ' ', now(), 'egold')");
		$this->osDB->query( "insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, module_key) values ('Metal Id', 'MODULE_PAYMENT_EGOLD_METALID', '0', 'Receive paymetn in this metal id', '6', '0', now(), 'egold')" );
		}
    }

	function update( $configuration ) {
		while (list ($key, $val) = each ($configuration)) {
			$this->osDB->query("update ! set configuration_value = ? where configuration_key = ? ", array( TABLE_CONFIGURATION, $val, $key ) );
		}
	}

    function remove() {
		$this->osDB->query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')" );
    }

    function keys() {
      return array('MODULE_PAYMENT_EGOLD_STATUS', 'MODULE_PAYMENT_EGOLD_ID', 'MODULE_PAYMENT_EGOLD_CURRENCY', 'MODULE_PAYMENT_EGOLD_NAME', 'MODULE_PAYMENT_EGOLD_METALID');
    }
  }
?>
