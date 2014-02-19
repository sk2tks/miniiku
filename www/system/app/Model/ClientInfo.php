<?php
App::uses('AppModel', 'Model');
/**
 * ClientInfo Model
 *
 * @property Client $Client
 */
class ClientInfo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'item';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
