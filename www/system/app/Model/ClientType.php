<?php
App::uses('AppModel', 'Model');
/**
 * ClientType Model
 *
 */
class ClientType extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $belongsTo = array(
		'ContentsType' => array(
			'className' => 'ContentsType',
			'foreignKey' => 'contents_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
