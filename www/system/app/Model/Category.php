<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property ContentsType $ContentsType
 * @property Tag $Tag
 * @property Topic $Topic
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_name';


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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	// public $hasMany = array(
		// 'Tag' => array(
			// 'className' => 'Tag',
			// 'foreignKey' => 'category_id',
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
		// 'Topic' => array(
			// 'className' => 'Topic',
			// 'foreignKey' => 'category_id',
			// 'dependent' => false,
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => '',
			// 'limit' => '',
			// 'offset' => '',
			// 'exclusive' => '',
			// 'finderQuery' => '',
			// 'counterQuery' => ''
		// )
	// );

}
