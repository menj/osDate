<?php


  class ccbill {
    var $code, $title;

// class constructor
    function ccbill() {

      $this->code = 'ccbill';
      $this->title = 'CCBill';

      $this->form_action_url = 'https://bill.ccbill.com/jpost/signup.cgi';
    }

// class methods
    function javascript_validation() {
      return false;
    }

    function process_button() {


		global $osDB, $t, $amount,$row;

		$sqlconf = 'SELECT configuration_key, configuration_value from ! where module_key = ?';

		$confdata = $osDB->getAll( $sqlconf, array( TABLE_CONFIGURATION, 'ccbill' ) );

		foreach( $confdata as $confitem ) {

			$paymod_data[ $confitem['configuration_key'] ] = $confitem['configuration_value'];

		}

		  $t_e_m_p = unserialize($paymod_data['MODULE_PAYMENT_CCBILL_SUBSCRIPTION_TYPES']);


      $t->assign('accNum', $paymod_data['MODULE_PAYMENT_CCBILL_CLIENT_ACCOUNT_NUMBER'] );

			$t->assign('subaccNum', $paymod_data['MODULE_PAYMENT_CCBILL_CLIENT_SUB_NUMBER'] );

			$t->assign('formName' , $paymod_data['MODULE_PAYMENT_CCBILL_FORM_NAME'] );

			$t->assign('allowedTypes' , $t_e_m_p[$row['roleid']]  );

			$t->assign('subType' , $t_e_m_p[$row['roleid']] );

			$t->assign('rendered_page', $t->fetch('ccbill_checkout.tpl') );

    }



    function after_process() {
      return false;
    }



    function check() {
      if (!isset($this->_check)) {
        $check_query = $osDB->query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CCBILL_STATUS'");
        $this->_check = $check_query->numRows();
      }
      return $this->_check;
    }

    function install() {
			global $osDB;
		$is_there = $osDB->getOne('select configuration_value from ! where configuration_key = ?', array(TABLE_CONFIGURATION, 'MODULE_PAYMENT_CCBILL_STATUS') );

		if (!$is_there) {

      $sqlupd = "insert into " . TABLE_CONFIGURATION . " values ".
			          " ('','Enable CCBill Payment Module', 'MODULE_PAYMENT_CCBILL_STATUS', 'True' , 'Do you want to accept CCBill Payments' , 6 , 0 ,'' , NOW(),'' ,'' , 'ccbill'  ) ";
			$osDB->query( $sqlupd );


			$sqlupd = "insert into " . TABLE_CONFIGURATION . " values ".
			          " ('','CCBill Client Account Number', 'MODULE_PAYMENT_CCBILL_CLIENT_ACCOUNT_NUMBER','' , 'Your CCBill Client Account Number' , 6 , 0 ,'' , NOW(),'' ,'' , 'ccbill'  ) ";
			$osDB->query( $sqlupd );

      $sqlupd = "insert into " . TABLE_CONFIGURATION . " values ".
			          " ('','CCBill Client Sub Account Number', 'MODULE_PAYMENT_CCBILL_CLIENT_SUB_NUMBER', '' , 'Your CCBill Sub Account Number (from CCBill WebAdmin)' , 6 , 0 ,'' , NOW(), '', '', 'ccbill'  ) ";
			$osDB->query( $sqlupd );


      $sqlupd = "insert into " . TABLE_CONFIGURATION . " values ".
			          " ('','CCBill Form Name', 'MODULE_PAYMENT_CCBILL_FORM_NAME', '' , 'CCBill Form to use (from CCBill WebAdmin)' , 6 , 0 ,'' , NOW(),'' ,'' , 'ccbill'  ) ";
			$osDB->query( $sqlupd );



	    $sqlupd = "insert into " . TABLE_CONFIGURATION . " values ".
			          " ('','Subscription Types', 'MODULE_PAYMENT_CCBILL_SUBSCRIPTION_TYPES', '' , 'Subscriptions Types' , 6 , 0 ,'' , NOW(),'' ,'' , 'ccbill'  ) ";
			$osDB->query( $sqlupd );




		}
    }

		function update( $configuration ) {
			global $osDB;
			while (list ($key, $val) = each ($configuration)) {

			  if(is_array($val)){
				 $val = serialize($val);
				}

					 	$sqlupd = "update ! set configuration_value = ? where configuration_key = ? ";

				  	$osDB->query( $sqlupd, array( TABLE_CONFIGURATION, $val, $key ) );



			}
		}

    function remove() {
			global $osDB;
      $sqlupd = "delete from " . TABLE_CONFIGURATION . " where module_key = 'ccbill'  ";
			$osDB->query( $sqlupd );
    }


  }
?>
