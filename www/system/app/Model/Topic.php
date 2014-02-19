<?php
App::uses('AppModel', 'Model');
/**
 * Topic Model
 *
 * @property ContentsType $ContentsType
 * @property Category $Category
 * @property User $User
 * @property Area $Area
 * @property Municipal $Municipal
 * @property Prefecture $Prefecture
 * @property CommentAlert $CommentAlert
 * @property Comment $Comment
 * @property FamilyLike $FamilyLike
 * @property TopicVote $TopicVote
 */
class Topic extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();
	public function setBbsTopicValidate(){
		$this->validate = array(
			'category_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'カテゴリを選択してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'prefecture' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => '都道府県を選択してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'municipal' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => '自治体を選択してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'area' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => '地域を選択してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'publicity_range' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => '公開範囲を入力してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'title' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'タイトルを入力してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
			'body' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => '本文を入力してください',
					//'last' => true
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		);
	}
	
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		// 'CommentAlert' => array(
			// 'className' => 'CommentAlert',
			// 'foreignKey' => 'topic_id',
			// 'dependent' => false,
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => '',
			// 'limit' => '',
			// 'offset' => '',
			// 'exclusive' => '',
			// 'finderQuery' => '',
			// 'counterQuery' => ''
		// ),
		// 'Comment' => array(
			// 'className' => 'Comment',
			// 'foreignKey' => 'contents_target_id',
			// 'dependent' => false,
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => '',
			// 'limit' => '',
			// 'offset' => '',
			// 'exclusive' => '',
			// 'finderQuery' => '',
			// 'counterQuery' => ''
		// ),
		// 'FamilyLike' => array(
		// 	'className' => 'FamilyLike',
		// 	'foreignKey' => 'topic_id',
		// 	'dependent' => false,
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => '',
		// 	'limit' => '',
		// 	'offset' => '',
		// 	'exclusive' => '',
		// 	'finderQuery' => '',
		// 	'counterQuery' => ''
		// ),
		'TopicVote' => array(
			'className' => 'TopicVote',
			'foreignKey' => 'topic_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
