<?php
App::uses('AppModel', 'Model');
/**
 * Family Model
 *
 * @property Customer $Customer
 * @property Child $Child
 * @property Customer $Customer
 * @property FamilyClip $FamilyClip
 * @property FamilyLike $FamilyLike
 */
class Family extends AppModel {


	public $actsAs = array('Containable');

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MasterCustomer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
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
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'family_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Child.id asc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'family_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'FamilyClip' => array(
			'className' => 'FamilyClip',
			'foreignKey' => 'family_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'FamilyLike' => array(
			'className' => 'FamilyLike',
			'foreignKey' => 'family_id',
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
	
	public function afterDelete(){
		if(!empty($this->data[$this->alias]['file_name'])){
			delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->data[$this->alias]['file_name']);
		}
		return true;
	}

}
