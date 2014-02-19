<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Client $Client
 * @property Customer $Customer
 * @property UserIp $UserIp
 */
class TempUser extends AppModel {
	
	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'agree'=>array(
			'notempty' => array(
				'rule' => array('equalto',"1"),
				'message' => '利用規約に同意してください',
			)
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'ユーザー名を入力してください',
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => 'userIsUnique',
				'message' => 'そのユーザー名は既に登録されています',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Emailを入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => '正しいEmailアドレスを入力してください'
			),
			'isUnique'=>array(
				'rule' => array('eamilIsUnique'),
				'message' => 'そのメールアドレスはすでに使われています',
				'on' => 'create'
			)
			
		),
		'password' => array(
				'minlength' => array(
				'rule' => array('minLength', '6'),
				'message' => '最低6文字入力して下さい'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'パスワードを入力してください',
				'last' => true
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('custom', '/^\w+$/'),
				'message' => 'パスワードは半角英数で入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'password2'=>array(
			'comparePassword' => array(
				'rule' => array('comparePassword'),
				'message' => 'パスワードとパスワード（再入力）が異なります',
				'last' => true
			)
		),
		
	);

	public function comparePassword($arg){
		return !empty($this->data[$this->alias]['password']) && $this->data[$this->alias]['password'] == $this->data[$this->alias]['password2'];
	}
	
	public function userIsUnique($arg){
		App::uses('User', 'Model');
		$user = new User();
		$isExist = $user->find('count', array('conditions'=>array('User.name'=>$this->data[$this->alias]['name'])));
		return empty($isExist);
	}
	
	public function eamilIsUnique($arg){
		App::uses('User', 'Mode');
		$user = new User();
		$isExist = $user->find('count', array('conditions'=>array('User.email'=>$this->data[$this->alias]['email'])));
		return empty($isExist);
	}

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		
		'UserIp' => array(
			'className' => 'UserIp',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
