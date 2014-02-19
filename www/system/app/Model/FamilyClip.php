<?php
App::uses('AppModel', 'Model');
/**
 * FamilyClip Model
 *
 */
class FamilyClip extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'URLを記入してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'url' => array(
				'rule' => array('url'),
				'message' => '正しいURLを記入してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'タイトルを記入してください',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	public function afterDelete(){		
		$this->updateClip(false);				
	}
	
	public function afterSave($created){
		if($created){
			$this->updateClip(true);	
		}
	}

	public function updateClip($add = true){
		$clip = $this->data[$this->alias];
		$contents_type_id = $clip['contents_type_id'];
		$contents_target_id = $clip['contents_target_id'];
		if(empty($contents_type_id) || empty($contents_target_id)) return;
		
		//if(is_client_type($contents_type_id)){
			$model = ClassRegistry::init('Topic');
			$table_name  = 'topics';
		//}else if(is_topic_type($contents_type_id)){
			// $model = ClassRegistry::init('Topic');
			// $table_name  = 'topics';
			//return;
		//}else{
			//return;
		//}		
		if($add){
			$model->query(sprintf("UPDATE %s SET num_clips=num_clips+1 WHERE id=%s", $table_name, $contents_target_id));
		}else{
			$model->query(sprintf("UPDATE %s SET num_clips=num_clips-1 WHERE id=%s", $table_name, $contents_target_id));
		}
	}
}
