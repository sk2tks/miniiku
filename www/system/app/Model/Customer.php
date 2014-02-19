<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 * @property User $User
 * @property Area $Area
 * @property Prefecture $Prefecture
 * @property Family $Family
 */
class Customer extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'customers';
	public $actsAs = array('Containable');
	public $virtualFields = array('customer_name'=>'CONCAT(last_name, first_name)');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(

		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '姓を入力してください',
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '名を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_kana' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '姓（かな）を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_kana' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '名（かな）を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nickname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '性別を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '続柄を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'family_id' => array(
			'notempty' => array(
				'rule' => array('notFamilyEmpty'),
				'message' => 'ファミリーを選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prefecture_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '都道府県を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '住所を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '郵便番号を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prefecture' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birth' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '誕生日を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	public $validate_front = array(
		'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '性別を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'customer_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '続柄を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birth' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '誕生日を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'prefecture_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '都道府県を選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '住所を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sub_address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '住所（番地以下）を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '郵便番号を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public function notFamilyEmpty($args){
		if(!empty($this->data[$this->alias]['new_family']) && $this->data[$this->alias]['new_family'] == 2) return true;
		return !empty($this->data[$this->alias]['family_id']);
	}
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Municipal' => array(
			'className' => 'Municipal',
			'foreignKey' => 'municipal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'prefecture_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Family' => array(
			'className' => 'Family',
			'foreignKey' => 'family_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function afterDelete(){
		if(!empty($this->data[$this->alias]['file_name'])){
			delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->data[$this->alias]['file_name']);
		}
		if(!empty($this->data[$this->alias]['user_id'])){
			$this->User->delete($this->data[$this->alias]['user_id']);
		}
		return true;
	}

	public function afterFind($results = array(), $primary = false){
		foreach ($results as $key => $val) {

	        if (isset($val[$this->alias]) && !empty($val[$this->alias]['private_flag'])) {
	           $private_flags = unserialize($val[$this->alias]['private_flag']);
				foreach(self::$privates as $field=>$val){

					$results[$key][$this->alias][$field] = isset($private_flags[$field]) ? $private_flags[$field] : $val;
				}
	        }

	    }
    	return $results;
	}

	public function beforeSave($options = array()){
		$private_flags = self::$privates;
		foreach($private_flags as $key=>$value){
			if(isset($this->data[$this->alias][$key])){
				$private_flags[$key] = $this->data[$this->alias][$key];
			}
		}
		$this->data[$this->alias]['private_flag'] = serialize($private_flags);
		return true;
	}

	public static $privates = array(
			'pv_name' 			=> 0,
			'pv_file' 			=> 1,
			'pv_gender' 		=> 1,
			'pv_birthday' 		=> 0,
			'pv_address' 		=> 1,
			'pv_url' 			=> 1
	);
}
