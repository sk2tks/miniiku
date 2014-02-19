<?php
App::uses('AppModel', 'Model');

class FamilyLike extends AppModel {

	public function afterDelete(){		
		$this->updateLike(false);				
	}
	
	public function afterSave($created){
		if($created){
			$this->updateLike(true);	
		}
	}
	
	public function updateLike($add = true){
		$like = $this->data[$this->alias];
		$contents_type_id = $like['contents_type_id'];
		$contents_target_id = $like['contents_target_id'];
		if(empty($contents_type_id) || empty($contents_target_id)) return;
		
		if(is_client_type($contents_type_id)){
			$model = ClassRegistry::init('Client');
			$table_name  = 'clients';
		}else if(is_topic_type($contents_type_id)){
			// $model = ClassRegistry::init('Topic');
			// $table_name  = 'topics';
			return;
		}else{
			return;
		}		
		if($add){
			$model->query(sprintf("UPDATE %s SET num_likes=num_likes+1 WHERE id=%s", $table_name, $contents_target_id));
		}else{
			$model->query(sprintf("UPDATE %s SET num_likes=num_likes-1 WHERE id=%s", $table_name, $contents_target_id));
		}
	}
}
