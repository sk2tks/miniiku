<?php
App::uses('AppController', 'Controller');
/**
 * Children Controller
 *
 * @property Child $Child
 * @property PaginatorComponent $Paginator
 */
class ChildrenController extends AppController {

/**
 *  Layout
 *
 * @var string
 */
	public $layout = 'bootstrap';

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
	                'max_width' => 176,
	                'max_height' => 132
	                )
			)
	));
	public $uses = array('Child', 'Client');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if(isset($this->params['admin'])){
			$this->set('title_for_layout', '子供管理');
		}
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$search_key = 'admin_child_search_key';
		
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		if(!empty($this->request->data['Child']))
		$data = $this->request->data['Child'];
		
		$conditions = array();
		if(!empty($data['name'])){
			$conditions[] = array('Child.name like'=>"%".$data['name'] . "%");
		}
		if(!empty($data['nickname'])){
			$conditions[] = array('Child.nickname like'=>"%".$data['nickname'] . "%");
		}
		if(!empty($data['family_id'])){
			$conditions[] = array('Child.family_id'=>$data['family_id']);
		};
		if(!empty($data['client_id'])){
			$conditions[] = array('Child.client_id'=>$data['client_id']);
		};
		
		$params = array('conditions'=>$conditions);
		$this->Paginator->settings = $params;
		
		$this->set('children', $this->Paginator->paginate());
		
		$this->set('clients', $this->Child->Client->find('list'));
		$this->set('families', $this->Child->Family->find('list', array('fields'=>array('id', 'nickname'))));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Child->id = $id;
		if (!$this->Child->exists()) {
			throw new NotFoundException(__('Invalid %s', __('child')));
		}
		$this->set('child', $this->Child->read(null, $id));
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
			$this->Child->id = $id;
			if (!$this->Child->exists()) {
				throw new NotFoundException(__('Invalid %s', __('child')));
			}
			$this->request->data = $this->Child->read(null, $id);
		}
		$this->admin_entry();
		
	}

	public function admin_entry() {
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->Child->create();
			if ($this->Child->save($this->request->data)) {
				$child_id = !empty($this->request->data['Child']['id']) ? $this->request->data['Child']['id'] : $this->Child->getLastInsertID();
				$this->Child->id = $child_id;
				if(!empty($this->request->data['deleted'])){
					if(!empty($this->request->data['Child']['file_name'])){
						$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Child']['file_name'] );	
						$this->Child->saveField('file_name', '');
					}
				}else{
					if(!empty($this->request->data['Child']['uploaded'])){
						if(!empty($this->request->data['Child']['file_name'])){
							$this->UploadHandler->delete_file_recursive( CUSTOMER_UPLOAD_DIR, $this->request->data['Child']['file_name'] );	
						}
	
						$newname = 'ch_'.$child_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( CUSTOMER_UPLOAD_DIR, $this->request->data['Child']['uploaded'], $newname );
						
						$this->Child->saveField('file_name', $newname);
					}
				}
				$this->Session->setFlash(__('The %s has been saved', __('child')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('child')));
			}
		}
		$families = $this->Child->Family->find('list', array('fields'=>array('id', 'nickname')));
		$clients = $this->Client->find('list', array('id', 'name'));
		$this->set(compact('families','clients'));
		
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
		$this->Child->id = $id;
		if (!$this->Child->exists()) {
			throw new NotFoundException(__('Invalid %s', __('child')));
		}
		if ($this->Child->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('child'))
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('child'))
		);
		$this->redirect(array('action' => 'index'));
	}

}
