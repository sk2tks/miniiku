<?php
App::uses('AppController', 'Controller');
/**
 * Families Controller
 *
 * @property Family $Family
 * @property PaginatorComponent $Paginator
 */
class FamiliesController extends AppController {



/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator',
		'UploadHandler'=>array(
			'upload_dir' => TEMP_UPLOAD_DIR,
			'upload_url' => TEMP_DIR,
			'image_versions' => array(
				'' => array(
                    'max_width' => 800,
                    'max_height' => 800,
                    'jpeg_quality' => 95
                ),
	            'thumb' => array(
	                'max_width' => 70,
	                'max_height' => 70,
	                'jpeg_quality' => 95
	                ),
	            'list' => array(
					'max_width' => 200,
					'max_height' => 200,
					'jpeg_quality' => 98
				)

			)
	));

	public $uses = array('Family', 'ClientType', 'FamilyClip', 'Child', 'Category','FamilyLike', 'Topic', 'Comment', 'Client','ClientVote');
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$search_key = 'admin_family_search_key';

		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}

		if(!empty($this->request->data['Family']))
		$data = $this->request->data['Family'];
		$conditions = array();
		if(!empty($data['name'])){
			$conditions[] = array('or'=>array(
				array('MasterCustomer.last_name like'=>"%". $data['name'] . "%"),
				array('MasterCustomer.first_name like'=>"%". $data['name'] . "%"),
			));
		}
		if(!empty($data['nickname'])){
			$conditions[] = array('Family.nickname like'=>"%".$data['nickname'] . "%");
		}


		$params = array('conditions'=>$conditions);
		$this->Paginator->settings = $params;
		$this->Family->recursive = 0;
		$this->set('families', $this->Paginator->paginate());

	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Family->id = $id;
		if (!$this->Family->exists()) {
			throw new NotFoundException(__('Invalid %s', __('family')));
		}
		$this->set('family', $this->Family->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->isEdit = false;
		$this->admin_entry();
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->request->is('post') && !$this->request->is('put')) {
			$this->Family->id = $id;
			if (!$this->Family->exists()) {
				throw new NotFoundException(__('Invalid %s', __('family')));
			}

			$this->request->data = $this->Family->read(null, $id);
		}
		$this->isEdit = true;
		$this->admin_entry();


	}

	public function admin_entry() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Family->create();
			if ($this->Family->save($this->request->data)) {
				$family_id = !empty($this->request->data['Family']['id']) ? $this->request->data['Family']['id'] : $this->Family->getLastInsertID();
				$this->Family->id = $family_id;
				if(!empty($this->request->data['deleted'])){
					if(!empty($this->request->data['Family']['file_name'])){
						$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Family']['file_name'] );
						$this->Family->saveField('file_name', '');
					}
				}else{
					if(!empty($this->request->data['Family']['uploaded'])){
						if(!empty($this->request->data['Family']['file_name'])){
							$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Family']['file_name'] );
						}

						$newname = 'fam_' .$family_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( CUSTOMER_UPLOAD_DIR, $this->request->data['Family']['uploaded'], $newname );
						$this->Family->saveField('file_name', $newname);
					}
				}
				$this->Session->setFlash(__('The %s has been saved', __('family')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('family'))
				);
			}
		}
		$customers = $this->Family->Customer->find('list', array('fields'=>array('id','customer_name')));
		$this->set(compact('customers'));

		$this->set('isEdit', $this->isEdit);
		$this->render('admin_entry');
	}
/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Family->id = $id;
		if (!$this->Family->exists()) {
			throw new NotFoundException(__('Invalid %s', __('family')));
		}
		if ($this->Family->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('family'))
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('family'))
		);
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * mypage_profile method
	 *
	 * @param string $id
	 * @return void
	 */

	public function mypage_profile(){
		$this->layout = null;
		//パートナー情報の取得
		$user_info = $this->Session->read('user_info');
		$self_customer_id = $user_info['Customer']['id'];
		$self_family_id = $user_info['Customer']['family_id'];
		$partners = $this->Customer->find('all', array(
				'conditions'=>array('Customer.status'=>'1',  'Customer.id <>'=>$self_customer_id, 'family_id'=>$self_family_id),
				'contain' => array('User')
			));
		$this->set('partners', $partners);
		$this->set('client_types', $this->ClientType->find('list', array('conditions'=>array('contents_type_id'=>'1'))));


		if($this->request->is('post') || $this->request->is('put')){
			//pr($this->request->data['Child']);
			if(!empty($this->request->data['Child'])){
				$this->Child->set($this->request->data['Child']);
				if($this->Child->saveAll($this->request->data['Child'], array('validate'=>'only'))){
					foreach($this->request->data['Child'] as $n=>$child){
						$this->Child->create();
						$this->Child->save($child);
						$child_id = !empty($child['id']) ? $child['id'] : $this->Child->getLastInsertId();
						$this->Child->id = $child_id;
						if(!empty($child['deleted'])){
							if(!empty($child['file_name'])){
								$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $child['file_name'] );
							//	$this->Customer->id = $customer_id;
								$this->Child->saveField('file_name', '');

							}
							unset($this->request->data['Child'][$n]['uploaded']);
							unset($this->request->data['Child'][$n]['file_name']);
						}else{
							if(!empty($child['uploaded'])){
								if(!empty($child['file_name'])){
									$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $child['file_name'] );
								}

								$newname = 'ch_'.$child_id . '_' . String::uuid();
								$newname = $this->UploadHandler->move_upload_files( CUSTOMER_UPLOAD_DIR, $child['uploaded'], $newname );
								$data['file_name'] = $newname;
								$data['pv_file'] = 1;
								$data['id'] = $child_id;
								$this->Child->save( $data );
								unset($this->request->data['Child'][$n]['uploaded']);
								$this->request->data['Child'][$n]['file_name'] = $newname;
							}
						}
					}
					$this->setChildData($self_family_id);
					$this->set('saved', true);
				}else{
					$this->set('error', true);
				}
			}
		}else{
			$this->setChildData($self_family_id);
		}

		$this->set('is_main_customer', $this->request->data['Family']['customer_id'] == $self_customer_id ? true : false);
		$child_client_areas = $this->Area->find('list');

		$child_client_areas = $child_client_areas + array('その他'=>'その他');
		$this->set('child_client_areas', $child_client_areas);
		$this->set('child_client_types', $this->ClientType->find('list', array('conditions'=>array('contents_type_id'=>1))));
	}

	public  function setChildData($family_id){
		$user_info = $this->Session->read('user_info');
		//パートナー、子供はバラバラに取得した方が吉、登録実装時に変更
		$this->request->data = $this->Family->find('first', array(
								'conditions'=>array('id'=>$family_id),
								'contain'=>array(
									'Child'=>array('conditions'=>array('status'=>'1'), 'Client')
								)

					));
		if(!empty($this->request->data['Child'])){
			$user_id = $this->Auth->user('id');

			foreach($this->request->data['Child'] as $n=>$child){
				if(!empty($child['client_id'])){
					if(!$this->ClientVote->voted($child['client_id'], $user_id)){
						$this->request->data['Child'][$n]['use_client_vote'] = 1;

					}
					$this->request->data['Child'][$n]['client_name'] = $child['Client']['name'];
				}

			}

		}
	}
	public function mypage_child_unit($num){
		$this->layout = null;
		$this->set('n', $num);
		$this->set('client_types', $this->ClientType->find('list', array('conditions'=>array('contents_type_id'=>'1'))));
		$user_info = $this->Session->read('user_info');
		$self_customer_id = $user_info['Customer']['id'];

		$this->set('family_id', $user_info['Customer']['family_id']);
		$this->set('is_main_customer', $user_info['Family']['customer_id'] == $self_customer_id ? true : false);
		$child_client_areas = $this->Area->find('list');

		$child_client_areas = $child_client_areas + array('その他'=>'その他');
		$this->set('child_client_areas', $child_client_areas);
		$this->set('child_client_types', $this->ClientType->find('list', array('conditions'=>array('contents_type_id'=>1))));
	}

	public function mypage_clip(){
		$this->layout = null;
		$user_info = $this->Session->read('user_info');
		$self_customer_id = $user_info['Customer']['id'];
		$self_family_id = $user_info['Customer']['family_id'];
		$conditions = array('family_id'=>$self_family_id);
		if($this->request->query('kw')){
			$conditions[] = array(
				'title like' => '%' . $this->request->query('kw') . '%'
			);
		};
		$this->Paginator->settings = array('conditions'=>$conditions,'limit'=>10,'paramType' => 'querystring', 'order'=>'created desc');

		$this->set('family_clips', $this->Paginator->paginate('FamilyClip'));
	}

	public function mypage_like(){
		$this->layout = null;
		$user_info = $this->Session->read('user_info');
		$self_customer_id = $user_info['Customer']['id'];
		$self_family_id = $user_info['Customer']['family_id'];
		$conditions = array('family_id'=>$self_family_id);

		if($this->request->query('kw') != ''){
			$kw = $this->request->query('kw');

			$conditions[] = array( 'or'=>array(
					'Topic.title like' => '%' . $kw . '%',
					'Client.name like' => '%' . $kw . '%',
					'Family.nickname like' => '%' . $kw . '%',
					'Comment.body like' => '%' . $kw . '%',
				)
			);
		};
		if($this->request->query('c') != ''){
			if(preg_match('/^(.*)_(.*)$/', $this->request->query('c'), $match)){
				$type = $match[1];
				$value = $match[2];
				switch($type){
					case "ca":
						$conditions[] = array('Topic.category_id'=>$value);
						break;
					case "co":
						$conditions[] = array('Client.contents_type_id' => $value);
						break;
				}
			}

		}

		$settings = array('conditions'=>$conditions,'limit'=>10,'paramType' => 'querystring', 'order'=>'FamilyLike.modified desc');
		$settings['joins'] = array(
			array(
				'type' => 'LEFT',
				'table'=>'clients',
				'alias' => 'Client',
				'conditions' => 'Client.id=FamilyLike.contents_target_id AND FamilyLike.contents_type_id in (1,2,3,4,5)'
			),

			array(
				'type' => 'LEFT',
				'table'=>'areas',
				'alias' => 'Area',
				'conditions' => 'Client.area_id=Area.id'
			),
			array(
				'type' => 'LEFT',
				'table'=>'contents_types',
				'alias' => 'ContentType',
				'conditions' => 'ContentType.id=FamilyLike.contents_type_id'
			),

			array(
				'type' => 'LEFT',
				'table'=>'topics',
				'alias' => 'Topic',
				'conditions' => 'Topic.id=FamilyLike.contents_target_id AND FamilyLike.contents_type_id in (6,7)'
			),
			array(
				'type' => 'LEFT',
				'table'=>'areas',
				'alias' => 'TopicArea',
				'conditions' => 'Topic.area_id=TopicArea.id'
			),
			array(
				'type' => 'LEFT',
				'table'=>'categories',
				'alias' => 'Category',
				'conditions' => 'Topic.category_id=Category.id'
			),
			array(
				'type' => 'LEFT',
				'table'=>'comments',
				'alias' => 'Comment',
				'conditions' => 'Comment.id=FamilyLike.contents_target_id AND FamilyLike.contents_type_id in (8)'
			),
			array(
				'type' => 'LEFT',
				'table'=>'families',
				'alias' => 'Family',
				'conditions' => 'Family.id=FamilyLike.contents_target_id AND FamilyLike.contents_type_id in (9)'
			),
		);

		$settings['fields'] = array(
					'FamilyLike.*',
					'Client.id','Client.name','Client.area_id',
					'Topic.source_url','Topic.id','Topic.title','Topic.category_id',
					'TopicArea.slug',
					'Family.id','Family.nickname',
					'Comment.id', 'Comment.body','Comment.parent_comment_id',
					'Category.id', 'Category.category_name',
					'ContentType.name','Area.slug'
				);
		$this->Paginator->settings = $settings;
		$this->FamilyLike->virtualFields['comment_count'] = "SELECT count(*) FROM comments
			WHERE comments.contents_type_id=FamilyLike.contents_type_id AND comments.contents_target_id=FamilyLike.contents_target_id
			AND comments.modified > '" . $this->Session->read('previous_login') . "'";

		$family_likes = $this->Paginator->paginate('FamilyLike');

		foreach($family_likes as $n=>$like){
			$contents_type_id = $like['FamilyLike']['contents_type_id'];
			$contents_target_id = $like['FamilyLike']['contents_target_id'];
			switch($contents_type_id){
				//施設
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
					$content = $like['Client'];
					if(!empty($like['Area']['slug'])){
						$host = $like['Area']['slug'] . '.' . Configure::read('domain') ;
					}else{
						$host = Configure::read('domain');
					}
					$url = 'http://' .$host .'/clients/view/' . $content['id'];

					$family_likes[$n]['Content'] = array(
						'title' => $content['name'],
						'id' => $content['id'],
						'url' => $url,
						//'url' => '/clients/view/' . $content['id'],
						'categoryName' => $like['ContentType']['name'],
						'categoryIcon' => 100 + $contents_type_id

					);
					break;
				//育児ニュース、交流広場
				case 6:
				case 7:
					$content = $like['Topic'];
					if($contents_type_id == '7'){
						if(empty($like['TopicArea'])){
							$url = 'http://' .Configure::read('domain') .'/bbs/view/' . $content['id'] ;
						}else{
							$url = 'http://' .$like['TopicArea']['slug'] . '.' .Configure::read('domain') .'/bbs/view/' . $content['id'];

						}
					}else{
						$url = $content['source_url'];
					}
					$family_likes[$n]['Content'] = array(
						'title' => $content['title'],
						'id' => $content['id'],
						'url' => $url,
						'categoryName' => $like['Category']['category_name'],
						'categoryIcon' => $like['Topic']['category_id']
					);
					break;
				//コメント
				case 8:
					$content = $like['Comment'];
					$family_likes[$n]['Content'] = array(
						'title' => $content['title'],
						'id' => $content['id'],
						'url' => '',
						'categoryName' => $like['Category']['category_name'],
						'categoryIcon' => $like['Topic']['category_id']
					);
					break;
				//ファミリー
				case 9:
					$content = $like['Family'];
					$family_likes[$n]['Content'] = array(
						'title' => $content['nickname'],
						'id' => $content['id'],
						'url' => ''
					);
					break;
				default:
					break;
			}

		}

		$this->set('family_likes', $family_likes);
	}

	public function mypage_comment(){
		$this->layout = null;
		$user_info = $this->Session->read('user_info');
		$self_customer_id = $user_info['Customer']['id'];
		$self_family_id = $user_info['Customer']['family_id'];

		$conditions = array('Customer.family_id'=>$self_family_id, 'delete_flag'=>0, Comment::TARGET_IS_EXISTS_CONDITION );

		if($this->request->query('kw') != ''){
			$kw = $this->request->query('kw');
			$conditions[] = array(
				'or'=>array(
					'Topic.title like' => '%' . $kw . '%',
					'Client.name like' =>'%' . $kw . '%',
					'Comment.body like' =>'%' . $kw . '%',

				)
			);
		};
		if($this->request->query('c') != ''){
			if(preg_match('/^(.*)_(.*)$/', $this->request->query('c'), $match)){
				$type = $match[1];
				$value = $match[2];
				switch($type){
					case "ca":
						$conditions[] = array('Topic.category_id'=>$value);
						break;
					case "co":
						$conditions[] = array('Client.contents_type_id' => $value);
						break;
				}
			}

		}

		$settings = array('contain'=>array(), 'conditions'=>$conditions,'limit'=>10,'paramType' => 'querystring', 'order'=>'Comment.modified desc');
		$settings['joins'] = array(
			array(
				'table'=>'users',
				'conditions'=>'User.id=Comment.user_id',
				'alias' => 'User'
			),
			array(
				'table'=>'customers',
				'conditions'=>'User.id=Customer.user_id',
				'alias'=>'Customer'
			),
			/*array(
				'table'=>'families',
				'conditions'=>'Family.id=Customer.family_id',
				'alias'=>'Family'
			),*/
			array(
				'type' => 'LEFT',
				'table'=>'clients',
				'alias' => 'Client',
				'conditions' => 'Client.id=Comment.contents_target_id AND Client.status=1 AND ' . Comment::CLIENT_TYPE_CONDITION
			),

			array(
				'type' => 'LEFT',
				'table'=>'areas',
				'alias' => 'Area',
				'conditions' => 'Client.area_id=Area.id'
			),

			array(
				'type' => 'LEFT',
				'table'=>'topics',
				'alias' => 'Topic',
				'conditions' => 'Topic.id=Comment.contents_target_id AND Comment.contents_type_id = Topic.contents_type_id AND Topic.closed=0 AND ' . Comment::TOPIC_TYPE_CONDITION
			),
			array(
				'type' => 'LEFT',
				'table'=>'areas',
				'alias' => 'TopicArea',
				'conditions' => 'Topic.area_id=TopicArea.id'
			),
			array(
				'type' => 'LEFT',
				'table'=>'categories',
				'alias' => 'Category',
				'conditions' => 'Topic.category_id=Category.id AND '. Comment::TOPIC_TYPE_CONDITION
			),
			array(
				'type' => 'LEFT',
				'table'=>'contents_types',
				'alias' => 'ClientContentsType',
				'conditions' => 'ClientContentsType.id=Client.contents_type_id'
			),


		);
		$settings['fields'] = array(
			'Client.id','Client.name','Client.area_id',
			'Topic.source_url','Topic.id','Topic.title','Topic.category_id','Topic.area_id',
			'TopicArea.slug',
			//'Family.id','Family.nickname',
			'Comment.*',
			'Customer.id',
			'Category.id','Category.category_name',/*'ClientType.*',*/
			'ClientContentsType.name','Area.slug');
		$this->Paginator->settings = $settings;
		$this->Comment->virtualFields['comment_count'] = "SELECT count(*) FROM comments
			WHERE comments.parent_comment_id=Comment.id AND  comments.modified > '" . $this->Session->read('previous_login') . "'";

		$family_comments = $this->Paginator->paginate('Comment');

		foreach($family_comments as $n=>$comment){
			$contents_type_id = $comment['Comment']['contents_type_id'];
			$contents_target_id = $comment['Comment']['contents_target_id'];
			switch($contents_type_id){
				//施設
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
					$content = $comment['Client'];
					if(!empty($comment['Area']['slug'])){
						$host = $comment['Area']['slug'] . '.' . Configure::read('domain') ;
					}else{
						$host = Configure::read('domain');
					}
					$url = 'http://' . $host . '/clients/view/' . $content['id'] . '/comment:' . $comment['Comment']['id'] . '?tab=7';


					$family_comments[$n]['Content'] = array(
						'title' => $content['name'],
						'categoryName' => $comment['ClientContentsType']['name'],
						'categoryIcon' => 100 + $comment['Comment']['contents_type_id'],
						'id' => $content['id'],
						'url' => $url
					);
					break;
				//育児ニュース、交流広場
				case 6:
				case 7:
					$content = $comment['Topic'];
					if($contents_type_id == '7'){
						if(empty($comment['TopicArea']['slug'])){
							$url = 'http://' .Configure::read('domain') .'/bbs/view/' . $content['id'] . '/comment:' . $comment['Comment']['id'];
						}else{
							$url = 'http://' .$comment['TopicArea']['slug'] . '.' .Configure::read('domain') .'/bbs/view/' . $content['id'] . '/comment:' . $comment['Comment']['id'];

						}
					}else{
						$url = $content['source_url'];
					}
					$family_comments[$n]['Content'] = array(
						'title' => $content['title'],
						'categoryName' => $comment['Category']['category_name'],
						'categoryIcon' => $comment['Category']['id'],
						'id' => $content['id'],
						'url' => $url
					);
					break;
				//コメント
				case 8:
					$content = $comment['Comment'];
					$family_comments[$n]['Content'] = array(
						'title' => $content['title'],
						'categoryName' => $comment['Category']['category_name'],
						'categoryIcon' => $comment['Category']['id'],
						'id' => $content['id'],
						'url' => 'http://' .Configure::read('domain') .'/bbs/view/'.$comment['Topic']['id']
					);
					break;
				//ファミリー
				case 9:
					$content = $comment['Family'];
					$family_comments[$n]['Content'] = array(
						'title' => $content['nickname'],
						'categoryName' => 'ファミリー',
						'categoryIcon' => '',
						'id' => $content['id'],
						'url' => ''
					);
					break;
				default:
					break;
			}

		}


		$this->set('family_comments', $family_comments);
		//pr($family_comments);
		$this->set('categories', $this->Category->find('list'));
	}

	public function mypage_new_clip(){
		$this->layout = null;

		if($this->request->is('post')){
			if($this->FamilyClip->save($this->request->data))
			$this->render('mypage_new_clip_complete');
			return;
		}else{
			$user_info = $this->Session->read('user_info');
			$this->request->data['FamilyClip']['family_id'] = $user_info['Family']['id'];
			$this->request->data['FamilyClip']['query'] = http_build_query($this->request->query);
		}

	}
	public function mypage_edit_clip($id){
		$this->layout = null;
		if($this->request->is('post')){
			if($this->FamilyClip->save($this->request->data))
			$this->render('mypage_new_clip_complete');
			return;
		}else{
			$this->request->data = $this->FamilyClip->read(null, $id);
			$this->request->data['FamilyClip']['query'] = http_build_query($this->request->query);
		}

		$this->render('mypage_new_clip');
	}

	public function mypage_delete_likes(){
		$this->autoRender = false;
		if(!empty($this->request->data['ids'])){
			$ids = split(",", $this->request->data['ids']);
			if(!empty($ids)){
				$ret = $this->FamilyLike->deleteAll(array('FamilyLike.id'=>$ids), false, true);
				if($ret){
					echo json_encode(array('status'=>'1'));
					return;
				}
			}
		}
		echo json_encode(array('status'=>'0', 'error'=>'削除できませんでした'));
	}

	public function mypage_delete_clips(){
		$this->autoRender = false;
		if(!empty($this->request->data['ids'])){
			$ids = split(",", $this->request->data['ids']);
			if(!empty($ids)){
				$ret = $this->FamilyClip->deleteAll(array('FamilyClip.id'=>$ids));
				if($ret){
					echo json_encode(array('status'=>'1'));
					return;
				}
			}
		}
		echo json_encode(array('status'=>'0', 'error'=>'削除できませんでした'));
	}

	public function mypage_list_client($area_id, $client_type_id){
	//	$area_id = $client_type_id = 1;
		$this->autoRender = false;
		$client_list =   $this->Client->find('list', array('conditions'=>array('area_id'=>$area_id, 'client_type_id'=>$client_type_id, 'contents_type_id'=>'1')));
		$client_list = $client_list + array('その他'=>'その他');
		echo json_encode($client_list);
	}

	public function mypage_unregist_customer($customer_id){
		$this->autoRender = false;
		$this->Customer->id = $customer_id;
		$customer = $this->Customer->read(null, $customer_id);
		$userName = $customer['User']['name'];
		$nickname = sprintf("%s 新規ファミリー", $userName);
		$this->Family->save(array('customer_id'=>$customer_id, 'nickname'=>$nickname));
		$family_id = $this->Family->getLastInsertId();
		$this->Customer->saveField('family_id', $family_id);
		echo "1";
	}

	public function mypage_unregist_child($child_id){
		$this->autoRender = false;
		if($this->Child->exists($child_id)){
			$this->Child->delete($child_id);
		}
		echo "1";
	}
}
