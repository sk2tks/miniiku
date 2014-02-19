<?php
App::uses('AppModel', 'Model');
/**
 * Municipal Model
 *
 */


class Municipal extends AppModel {


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	/*
	public $hasMany = array(
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'municipal_id',
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
		);
	*/

	public function getListByPref($pref_id){
		return $this->find('list', array('conditions'=>array('municipal_code like'=>sprintf("%02d",$pref_id).'%')));
	}

}
