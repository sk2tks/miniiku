<?php
App::uses('AppController', 'Controller');
/**
 * ClientTypes Controller
 *
 * @property ClientType $ClientType
 * @property PaginatorComponent $Paginator
 */
class ClientTypesController extends AppController {

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
	public $components = array('Paginator');
	
	public function setAdminTitle(){
		$this->set('title_for_layout', '施設タイプ管理');	
	}
	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$search_key = 'admin_client_type_search_key';
		
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		if(!empty($this->request->data['ClientType'])) $data = $this->request->data['ClientType'];
		
		$conditions = array();
		if(!empty($data['name'])){
			$conditions[] = array('ClientType.name like'=>"%".$data['name'] . "%");
		}
		if(!empty($data['contents_type_id'])){
			$conditions[] = array('ClientType.contents_type_id'=>$data['contents_type_id']);
		};
	
		
		$params = array('conditions'=>$conditions);
		$this->Paginator->settings = $params;
		
		$this->set('clientTypes', $this->Paginator->paginate());
		$this->set('contents_types', $this->ClientType->ContentsType->find('list'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ClientType->id = $id;
		if (!$this->ClientType->exists()) {
			throw new NotFoundException(__('Invalid %s', __('施設タイプ')));
		}
		$this->set('clientType', $this->ClientType->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ClientType->create();
			if ($this->ClientType->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('施設タイプ'))
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('施設タイプ'))
				);
			}
		}
		$this->set('contentsTypes', $this->ClientType->ContentsType->find('list'));
		$this->set('isEdit', false);
		$this->render('admin_entry');
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->ClientType->id = $id;
		if (!$this->ClientType->exists()) {
			throw new NotFoundException(__('Invalid %s', __('施設タイプ')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ClientType->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('施設タイプ'))
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('施設タイプ'))
				);
			}
		} else {
			$this->request->data = $this->ClientType->read(null, $id);
		}
		$this->set('contentsTypes', $this->ClientType->ContentsType->find('list'));
		$this->set('isEdit', true);
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
		$this->ClientType->id = $id;
		if (!$this->ClientType->exists()) {
			throw new NotFoundException(__('Invalid %s', __('施設タイプ')));
		}
		if ($this->ClientType->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('施設タイプ'))
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('施設タイプ'))
		);
		$this->redirect(array('action' => 'index'));
	}

}
