<?php
App::uses('AppModel', 'Model');
/**
 * Child Model
 *
 * @property Family $Family
 */
class Contact extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $useTable = false;


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '氏名を入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
			
		),
		'email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'メールアドレスを入力してください',
				'last' => true
				
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'メールアドレスを正しく入力してください',
				'last' => true
				
			)
			
		),
		'message' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '内容を入力してください',
				'last' => true
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
			
		)
	);

}
