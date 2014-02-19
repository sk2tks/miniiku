<?php
App::uses('AppHelper', 'View/Helper');

class FunctionsHelper extends AppHelper {

    public $helpers = array('Html');
	
	/**
	 * 
	 */
	public function customerIcon($customer = null, $size='l' ){
		$open_flag = false;
		if(isset($customer['pv_file'])){
			$open_flag = $customer['pv_file'] == '1';
		}else{
			if(!empty($customer['private_flag'])){
				$privates  = unserialize($customer['private_flag']);
				$open_flag = !empty($privates['pv_file']);
			}
		}
		if($open_flag && !empty($customer['file_name'])){
			return CUSTOMER_DIR . 'thumb/' + $customer['file_name'];
		}
		
		return DEFAULT_IMG_CUSTOMER_S;
	}
	
}
