<?php
App::uses('AppModel', 'Model');
/**
 * Source Model
 *
 * @property Municipal $Municipal
 */
class Source extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasMany = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $belongsTo = array(
		'Municipal' => array(
			'className' => 'Municipal',
			'foreignKey' => 'municipal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
		);


}
