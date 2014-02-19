<?php
App::uses('AppModel', 'Model');
/**
 * Child Model
 *
 * @property Family $Family
 */
class Reminder extends AppModel {

/**
 * Display field
 *
 * @var string
 */



	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	public $validate = array(
		
		'email' => array(
			
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'メールアドレスを入力してください',
				'last' => true
				
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'メールアドレスを正しく入力してください',
				'last' => true
				
			),
			'check_exists'=>array(
				'rule' => array('check_exists'),
				'message' => '入力されたメールアドレスのユーザーは存在しません',
				'last' => true
			),
			
		),
		
	);
	
	public function check_exists($args){
		$email = array_shift($args);
		$this->User = ClassRegistry::init('User');
		$cnt = $this->User->find('count', array('conditions'=>array('email'=>$email, 'status'=>'1')));
		
		return $cnt > 0;
	}

}
