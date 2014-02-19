<?php
config('common');
App::uses('AppController', 'Controller', 'TmpUser');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {


/**
 * Helpers
 *
 * @var array
 */
	//public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
	public $helpers = array('Facebook.Facebook'); 
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
	                'jpeg_quality' => 98
	                ),
	            'list' => array(
					'max_width' => 110,
					'max_height' => 110,
					'jpeg_quality' => 98
				)
				
			)
	));
	
	public $uses = array('Customer', 'Prefecture');
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$search_key = 'admin_customer_search_key';
		
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		if(!empty($this->request->data['Customer']))
		$data = $this->request->data['Customer'];
		$conditions = array();
		if(!empty($data['id'])){
			$conditions[] = array('Customer.id'=>$data['id']);
		}
		if(!empty($data['user_name'])){
			$conditions[] = array('User.name like'=>"%".$data['user_name'] . "%");
		}
		if(!empty($data['prefecture_id'])){
			$conditions[] = array('Customer.prefecture_id'=>$data['prefecture_id']);
		};
		if(!empty($data['family_id'])){
			$conditions[] = array('Customer.family_id'=>$data['family_id']);
		};
		
		$params = array('conditions'=>$conditions);
		$this->Paginator->settings = $params;

		$this->set('customers', $this->Paginator->paginate());
		$this->set('prefectures', $this->Customer->Prefecture->find('list'));
		$this->set('municipals', $this->Customer->Municipal->find('list'));
		$this->set('families', $this->Customer->Family->find('list', array('fields'=>array('id', 'nickname'))));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid %s', __('customer')));
		}
		$this->set('customer', $this->Customer->read(null, $id));
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
		$this->isEdit = true;
		if (!$this->request->is('post') && !$this->request->is('put')) {
			$this->Customer->id = $id;
			if (!$this->Customer->exists()) {
				throw new NotFoundException(__('Invalid %s', __('customer')));
			}
			$this->request->data = $this->Customer->read(null, $id);
		}
		$this->admin_entry();
		
	}

	public function admin_entry($id = null) {

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Customer->create();
			$this->request->data['User']['status'] = $this->request->data['Customer']['status'];
			if(!empty($this->request->data['User']['new_password'])){
				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['new_password']);	
			}
			$ret = $this->Customer->saveAll($this->request->data, array('validate'=>'only'));
			if ( $ret && $this->Customer->saveAll($this->request->data , array('validate'=>false))) {
				$customer_id = !empty($this->request->data['Customer']['id']) ? $this->request->data['Customer']['id'] : $this->Customer->getLastInsertID();
				$this->Customer->id = $customer_id;
				if(!empty($this->request->data['Customer']['new_family']) && 
					$this->request->data['Customer']['new_family'] == '2'){
					$this->Customer->Family->save(array(
						'customer_id' => $customer_id,
						'nickname' => $this->request->data['Customer']['family_nickname'],
						'status' => 1
					));
					$family_id = $this->Customer->Family->getLastInsertID();
					//$this->Customer->id = $customer_id;
					$this->Customer->saveField('family_id', $family_id);
				}
				
				if(!empty($this->request->data['deleted'])){
					if(!empty($this->request->data['Customer']['file_name'])){
						$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['file_name'] );	
					//	$this->Customer->id = $customer_id;
						$this->Customer->saveField('file_name', '');
					}
					
				}else{
					if(!empty($this->request->data['Customer']['uploaded'])){
						if(!empty($this->request->data['Customer']['file_name'])){
							$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['file_name'] );	
						}
		
						$newname = $customer_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['uploaded'], $newname );
					//	$this->Customer->id = $customer_id;
						$this->Customer->saveField('file_name', $newname);
					}
				}
				
				$this->Session->setFlash(__('The %s has been saved', __('customer')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('customer')));
			}
		} 
		
		
		$prefectures = $this->Customer->Prefecture->find('list');
		$municipals = array();
		if(!empty($this->request->data['Customer']['prefecture_id'])){
			$municipals = $this->Customer->Municipal->getListByPref($this->request->data['Customer']['prefecture_id']);
		}
		$areas = array();
		if(!empty($this->request->data['Customer']['municipal_id'])){
			$areas = $this->Customer->Area->find('list', array('conditions'=>array('municipal_id'=>$this->request->data['Customer']['municipal_id'])));
		}
		$families = $this->Customer->Family->find('list', array('fields'=>array('id', 'nickname')));
		$this->set(compact('areas', 'prefectures', 'families','municipals'));
		
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
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid %s', __('customer')));
		}
		if ($this->Customer->delete($id, true)) {
			$this->Session->setFlash(
				__('The %s deleted', __('customer'))
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('customer'))
		);
		$this->redirect(array('action' => 'index'));
	}

	public function mypage_profile(){
		$this->layout = 'ajax';
		$this->set('prefectures', $this->Customer->Prefecture->find('list'));
		
		if($this->request->is('post')|| $this->request->is('put')){
			$this->request->data['Customer']['zip'] = $this->request->data['Customer']['zip1'] . $this->request->data['Customer']['zip2'];
			
			$this->Customer->validate = $this->Customer->validate_front;
			//$this->Customer->set($this->request->data);
			//$ret = $this->Customer->validates();
			$ret = $this->Customer->saveAll($this->request->data, array('validate'=>'only'));
			if(!$ret) return;
			
			if(!empty($this->request->data['User']['new_password'])) {
				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['new_password']);
				$this->log($this->request->data);
			}
			
			if ($ret = $this->Customer->saveAll($this->request->data , array('validate'=>false))) {
				
				$customer_id = $this->request->data['Customer']['id'];
				//$this->log($this->request->data);
				if(!empty($this->request->data['deleted'])){
					if(!empty($this->request->data['Customer']['file_name'])){
						$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['file_name'] );	
					//	$this->Customer->id = $customer_id;
						$this->Customer->saveField('file_name', '');
						
					}
					unset($this->request->data['Customer']['uploaded']);
					unset($this->request->data['Customer']['file_name']);
				}else{ 
					if(!empty($this->request->data['Customer']['uploaded'])){ 
						if(!empty($this->request->data['Customer']['file_name'])){
							$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['file_name'] );	
						}
		
						$newname = $customer_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( CUSTOMER_UPLOAD_DIR, $this->request->data['Customer']['uploaded'], $newname );
						$this->Customer->id = $customer_id;
						$data = array('id'=>$customer_id, 'file_name'=>$newname, 'pv_file'=>'1');
						$this->Customer->save($data);
						unset($this->request->data['Customer']['uploaded']);
						$this->request->data['Customer']['file_name'] = $newname;
						$this->request->data['Customer']['pv_file'] = 1;
					}
				}
				$this->cleanup_tmp();
				$this->set('saved', 1);
				
			}
			
			
		}else{
			$user_id = $this->Auth->user('id');
			if(empty($user_id)) throw new NotFoundException();
			
			$this->request->data = $this->Customer->find('first', array('conditions'=>array('user_id'=>$user_id)));
			$zip = $this->request->data['Customer']['zip'];
			if(!empty($zip)){
				$this->request->data['Customer']['zip1'] = substr($zip, 0,3);
				$this->request->data['Customer']['zip2'] = substr($zip, 3,4 );
			}
			
		}
		
		
	}

	public function mypage_update_sidebar(){
		$this->layout = null;
		$user = $this->Auth->user(); 
		
		if(!empty($user) ){
			if($user['user_type'] == USER_TYPE_CUSTOMER){
				$this->setUserInfo($user);
				
			}else if($user['user_type'] == USER_TYPE_CLIENT){
				//
			}
		}
	}
	
	public function mypage_upload(){
		$this->upload();
	}

	public function view($id=null){
		$this->set('title_for_layout', 'ユーザー情報');
		$customer = $this->Customer->find('first', array('conditions'=>array('Customer.id'=>$id)));
		if(empty($customer)) throw new NotFoundException("ユーザーが見つかりません");
		$zip = $customer['Customer']['zip'];
		if(!empty($zip)){
			$customer['Customer']['zip1'] = substr($zip, 0,3);
			$customer['Customer']['zip2'] = substr($zip, 3,4 );
		}
		$this->set('customer', $customer);
		
		$self_customer_id = $customer['Customer']['id'];
		$self_family_id = $customer['Customer']['family_id'];
		$partners = $this->Customer->find('all', array(
				'conditions'=>array('Customer.status'=>'1',  'Customer.id <>'=>$self_customer_id, 'family_id'=>$self_family_id),
				'contain' => array('User')
			));
		$this->set('partners', $partners);
		
		
		$this->loadModel('Child');
		$children = $this->Child->find('all', array(
								'conditions'=>array('family_id'=>$self_family_id, 'Child.status'=>'1'),
								'contain'=>array('Client')						
			));
		$this->set('children', $children);
		
	}
	
}
