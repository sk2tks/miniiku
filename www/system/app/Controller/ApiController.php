<?php
	App::uses('AppController', 'Controller');

	class ApiController extends AppController {

		/**
		 * Components
		 *
		 * @var array
		 */
		public $components = array('Paginator');
		public $uses = array('Zip', 'Prefecture', 'Municipal','ClientType', 'Area');
		
		
		public function get_zip_info($zip){
			
			$result = $this->Zip->find('first', array('conditions'=>array('zip'=>$zip)));
			
			if(!empty($result)){
				$result = $result['Zip'];
				$municipal_code = $result['municipal_code'];
				$municipal_id = $this->Municipal->field('id', array('municipal_code'=>$municipal_code));
				if(empty($municipal_id)){
					$municipal_id = $this->Municipal->field('id', array('municipal_code like'=>substr($municipal_code,0,3) .'00%'));
				}
				$result['municipal_id'] = $municipal_id;
				$result['municipals'] = $this->Municipal->getListByPref($result['prefecture_id']);
				$result['areas'] = $this->Area->find('list', array('conditions'=>array('municipal_id'=>$municipal_id)));

			}else{
				$result = array();
			}
			$this->set(compact('result'));
			$this->viewClass = 'Json';
			$this->set('_serialize', 'result');
		}
		
		public function get_client_type($type_id){
			
			$results = $this->ClientType->find('list', array('conditions'=>array('contents_type_id'=>$type_id)));
			
			$this->set(compact('results'));
			$this->viewClass = 'Json';
			$this->set('_serialize', 'results');
		}
		
		public function get_municipal($pref_id){
			$results = $this->Municipal->find('list', 
				array('conditions'=>array('municipal_code like'=>sprintf("%02d",$pref_id).'%')));
		
			$this->set(compact('results'));
			$this->viewClass = 'Json';
			$this->set('_serialize', 'results');
		}
		
		public function get_area($municipal_id){
			$areas = $this->Area->find('list',
				array('conditions'=>array('municipal_id'=>$municipal_id)));
			$this->set(compact('areas'));
			$this->viewClass = 'Json';
			$this->set('_serialize', 'areas');
		}
//----------------------------------------------------------------------------------
// For Admin
//--------------------------------------------------------------------------------- 		
		public function admin_get_client_type($type_id){
			$this->autoRender = false;
			$this->get_client_type($type_id);
			$this->render('get_client_type');
		}
		
		public function admin_get_zip_info($zip){
			$this->autoRender = false;
			$this->get_zip_info($zip);
			$this->render('get_zip_info');
		}
		
		public function admin_get_municipal($pref_id){
			$this->autoRender = false;
			$this->get_municipal($pref_id);
			$this->render('get_municipal');
		}
		
		public function admin_get_area($municipal_id){
			$this->autoRender  =false;
			$this->get_area($municipal_id);
			$this->render('get_area');
		}
		
//----------------------------------------------------------------------------------		
		public function add_like($contents_type_id=null, $contents_target_id=null){
			
			$this->autoRender = false;
			try{
				if(empty($contents_type_id) || empty($contents_target_id)) throw new Exception("入力データが正しくありません");
				if(!$this->Auth->loggedIn()) throw new Exception("ログインしてください");
				
				$user_info = $this->Session->read('user_info');
				if(empty($user_info['Customer']['user_id']) || empty($user_info['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
				$family_id = $user_info['Customer']['family_id'];
				$user_id = $user_info['Customer']['user_id'];
				
				$data = array(
					'family_id' => $family_id,					
					'contents_type_id' => $contents_type_id,
					'contents_target_id' => $contents_target_id
				);
				
				$this->loadModel("FamilyLike");
				
				$cnt = $this->FamilyLike->find('first', array('conditions'=>$data));
				if(!empty($cnt)) throw new Exception('すでに登録済みです');
				$data['user_id'] =  $user_id;
				if($this->FamilyLike->save($data)){
					echo json_encode(array("status"=>'1'));
				}else{
					echo json_encode(array('status'=>'0', 'error'=>'登録できませんでした'));
				}				
				
			}catch(Exception $e){
				echo json_encode(array('status'=>'0', 'error'=>$e->getMessage()));
			}
		}

//----------------------------------------------------------------------------------	
		public function add_clip($contents_type_id=null, $contents_target_id=null){
			
			$this->autoRender = false;
			try{
				if(empty($contents_type_id) || empty($contents_target_id) || empty($this->request->data['source'])) throw new Exception("入力データが正しくありません");
				if(!$this->Auth->loggedIn()) throw new Exception("ログインしてください");
				
				$user_info = $this->Session->read('user_info');
				if(empty($user_info['Customer']['user_id']) || empty($user_info['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
				$family_id = $user_info['Customer']['family_id'];
				$user_id = $user_info['Customer']['user_id'];
				
				$data = array(
					'family_id' => $family_id,					
					'contents_type_id' => $contents_type_id,
					'contents_target_id' => $contents_target_id,
					//'url' => rawurldecode($source)
				);

				$data['url'] = rawurldecode($this->request->data['source']);
				$data['pub_date'] = $this->request->data['pub_date'];
				$data['title'] = $this->request->data['title'];
				
				$this->loadModel("FamilyClip");
				
				$cnt = $this->FamilyClip->find('first', array('conditions'=>$data));
				if(!empty($cnt)) throw new Exception('すでに登録済みです');
				$data['user_id'] =  $user_id;
				if($this->FamilyClip->save($data)){
					echo json_encode(array("status"=>'1'));
				}else{
					echo json_encode(array('status'=>'0', 'error'=>'登録できませんでした'));
				}				
				
			}catch(Exception $e){
				echo json_encode(array('status'=>'0', 'error'=>$e->getMessage()));
			}
		}
		
		public function mypage_check_client_vote($client_id = null){
			$this->autoRender = false;
			try{
				$this->loadModel('ClientVote');
				$user_id = $this->Auth->user('id');
				$cnt = $this->ClientVote->find('count', array(
						'conditions'=>array(
							'user_id' => $user_id,
							'client_id' => $client_id
						)
				));
				echo $cnt>0 ? "1" : "0";
			}catch(Exception $e){
				echo "0";
			}
		}
		
		public function clip_topic($id){
			
			try{
				if(empty($id)) throw new Exception("入力データが正しくありません");
				if(!$this->Auth->loggedIn()) throw new Exception("ログインしてください");
				
				$user_info = $this->Session->read('user_info');
				if(empty($user_info['Customer']['user_id']) || empty($user_info['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
				$family_id = $user_info['Customer']['family_id'];
				$user_id = $user_info['Customer']['user_id'];
				
				
				$this->loadModel('Topic');
				$this->loadModel('FamilyClip');
				$topic = $this->Topic->find('first', array('conditions'=>array('Topic.id'=>$id)));
				if(empty($topic)) throw new Exception("入力データが正しくありません");
				
				$contents_type_id = $topic['Topic']['contents_type_id'];
				$data = array('title'=>$topic['Topic']['title'], 'family_id'=>$family_id);
				if($contents_type_id == '6'){
					if(!empty($topic['Topic']['source_url'])){
						$data['url'] = $topic['Topic']['source_url'];
						if($this->FamilyClip->save($data, false)){
							echo json_encode(array("status"=>'1'));
						}else{
							echo json_encode(array('status'=>'0', 'error'=>'登録できませんでした'));
						}				
						
					}else{
						throw new Exception("入力データが正しくありません");
					}
				}else{
					throw new Exception("入力データが正しくありません");
				}
			}catch(Exception $e){
				echo json_encode(array('status'=>'0', 'error'=>$e->getMessage()));
			}
			
		}
		

	}
