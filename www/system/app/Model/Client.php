<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 * @property ContentsType $ContentsType
 * @property User $User
 * @property Area $Area
 * @property Municipal $Municipal
 * @property Prefecture $Prefecture
 */
class Client extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '名前を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'kana' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '名前（かな）を入力してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'contents_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'コンテンツタイプを選択してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'client_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '施設タイプを選択してください',
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
		/*
		'area_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'municipal_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		), */
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ContentsType' => array(
			'className' => 'ContentsType',
			'foreignKey' => 'contents_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClientType' => array(
			'className' => 'ClientType',
			'foreignKey' => 'client_type_id',
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
		)
	);
	
	public $hasOne = array('ClientPoll'

		);

	public $hasMany = array('ClientVote' => array(
            'className'     => 'ClientVote',
            'foreignKey'    => 'client_id',
            'dependent' => true,
        ),
						'ClientInfo' => array(
            'className'     => 'ClientInfo',
            'foreignKey'    => 'client_id',
            'dependent' => true,
        )
		);

	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'client_user'
		)
	);
	

	public function beforeSave($options = array()) {
		if(!empty($this->data['Client']['display_tabs'])){
			$this->data['Client']['display_tabs'] = implode(',', $this->data['Client']['display_tabs']);
		}
	}

	public function afterFind($results, $primary = false) {
		if($primary){
	    foreach ($results as $key => $val) {
	        if (isset($val['Client']['display_tabs'])) {
	            $results[$key]['Client']['display_tabs'] = explode(',' , $val['Client']['display_tabs']);
	        }
	    }
  	}
    return $results;
}

	public function afterDelete(){
		for($i=1; $i<=8; $i++){
			$file_name = 'file_name'.$i;
			if(!empty($this->data[$this->alias][$file_name])){
				delete_file_recursive( CLIENT_UPLOAD_DIR, $this->data[$this->alias][$file_name]);
			}
		}
		return true;
	}
}
