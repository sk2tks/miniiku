<?php
App::uses('AppModel', 'Model');
/**
 * CommentAlert Model
 *
 * @property ContentsType $ContentsType
 * @property ContentsTarget $ContentsTarget
 * @property Comment $Comment
 * @property User $User
 */
class CommentAlert extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'comment_id';


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
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'contents_target_id',
			'conditions' => array('CommentAlert.contents_type_id'=>7),
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'contents_target_id',
			'conditions' => array('CommentAlert.contents_type_id'=>array(1,2,3,4,5)),
			'fields' => '',
			'order' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'comment_id',
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
		)
	);
}
