<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 */
class Comment extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $actsAs = array('Containable');
	
	 const CLIENT_TYPE_CONDITION = 'Comment.contents_type_id >= 1 AND Comment.contents_type_id <= 5';
	 const TOPIC_TYPE_CONDITION  = 'Comment.contents_type_id >= 6 AND Comment.contents_type_id <= 7';
	 const TARGET_IS_EXISTS_CONDITION = '(Client.id is NOT NULL OR Topic.id is NOT NULL)';
	 
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contents_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '対象コンテンツタイプを選択してください',
			),
		),
		'contents_target_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '対象コンテンツIDを入力してください',
			),
		),
		'body' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '本文を入力してください',
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '投稿者ユーザーIDを入力してください',
			),
		),
	);
	
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
			'fields' => array('id', 'name'),
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => array('id', 'name', 'user_type'),
			'order' => ''
		),
	);
	
/**
 * hasOne associations
 *
 * @var array
 */
	// public $hasMany = array(
		// 'CommentVote' => array(
			// 'className' => 'CommentVote',
			// 'foreignKey' => 'comment_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => '',
			// 'limit'         => '1',
            // 'dependent'     => true
		// )
	// );
	
	public function getRecentReplyCount($user_id=null, $date=null){
		$params = array(
				'joins'=>array(
					array(
						'table' => 'comments',
						'alias' => 'MyComment',
						'conditions' => array('MyComment.user_id' => $user_id, 'MyComment.id=Comment.parent_comment_id', 'MyComment.delete_flag'=>0)
					),
					array(
						'type' => 'LEFT',
						'table'=>'topics',
						'alias' => 'Topic',
						'conditions' => 'Topic.id=Comment.contents_target_id AND Comment.contents_type_id = Topic.contents_type_id AND Topic.closed=0 AND '.self::TOPIC_TYPE_CONDITION
					),
					array(
						'type' => 'LEFT',
						'table'=>'clients',
						'alias' => 'Client',
						'conditions' => 'Client.id=Comment.contents_target_id AND Client.status=1 AND ' . self::CLIENT_TYPE_CONDITION 
					),
				),
				'conditions'=>array('Comment.modified >=' => $date, 'Comment.delete_flag'=>0, self::TARGET_IS_EXISTS_CONDITION ),
				'recursive'=>-1
			);
		
		
		$cnt = $this->find('count', $params);
		return $cnt;
		
	}
	
	
	public function getPoint($user_id){
		$this->recursive = -1;
		$ret = $this->find('first', array(
			'fields'=>'(SUM(plus) - SUM(minus)) as point',
			'conditions'=>array('user_id'=>$user_id)
			
		));
		return !empty($ret[0]['point']) ? $ret[0]['point'] : 0;
	}
}
