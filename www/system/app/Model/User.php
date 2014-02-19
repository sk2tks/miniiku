<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Client $Client
 * @property Customer $Customer
 * @property UserIp $UserIp
 */
class User extends AppModel {
	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'ユーザー名を入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'そのユーザー名は既に登録されています',
				'last' => true,
				//'on' => 'create'
			),
			
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'メールアドレスを入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'メールアドレスを正しく入力してください'
			),
			'isUnique'=>array(
				'rule' => array('isUnique'),
				'message' => 'そのメールアドレスはすでに使われています',
				//'on' => 'create'
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
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'パスワードは半角英数で入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'new_password' => array(
			
			'compare' => array(
				'rule' => array('compare_password'),
				'message' => array('パスワードとパスワード（再）が異なります')
			)
		)
	);

	public function compare_password($args){		
		return $this->data[$this->alias]['new_password'] == $this->data[$this->alias]['new_password2'];
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
	
	public $hasAndBelongsToMany = array(
		'Client' => array(
			'className' => 'Client',
			'joinTable' => 'client_user'
		)
	);
}
