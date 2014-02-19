<?php
App::uses('AppModel', 'Model');
/**
 * Child Model
 *
 * @property Family $Family
 */
class Child extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed


	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '名前を入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		/*
			'kana' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'ふりがなを入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)

		),
		'nickname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'ニックネームを入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)

		),
		'call_name' => array(
			'callNameNotEmpty' => array(
				'rule' => array('callNameNotEmpty'),
				'message' => '名前は必須です',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)

		)
	 	*/
	);

	public function callNameNotEmpty($args){

		return ( 	!empty($this->data[$this->alias]['name']) ||
					!empty($this->data[$this->alias]['kana']) ||
					!empty($this->data[$this->alias]['nickname'])
				);
	}
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Family' => array(
			'className' => 'Family',
			'foreignKey' => 'family_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function afterDelete(){
		if(!empty($this->data[$this->alias]['file_name'])){
			delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->data[$this->alias]['file_name']);
		}
		return true;
	}


	public function afterFind($results = array(), $primary = false){
		foreach ($results as $key => $val) {
	        if (!empty($val[$this->alias]['private_flag'])) {
	           $private_flags = unserialize($val[$this->alias]['private_flag']);
				foreach(self::$privates as $field=>$val){
					$results[$key][$this->alias][$field] = isset($private_flags[$field]) ? $private_flags[$field] : $val;
				}
	        }

	    }
    	return $results;
	}

	public function beforeSave($options = null){
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
			'pv_name' 			=> 1,
			'pv_kana' 			=> 1,
			'pv_nickname' 		=> 0,
			'pv_file' 			=> 1,
			'pv_gender' 		=> 1,
			'pv_birthday' 		=> 0,
			'pv_client' 		=> 0
	);
}
