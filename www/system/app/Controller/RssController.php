<?php
App::uses('AppController', 'Controller');
/**
 * Rss Controller
 *
 * @property Child $Child
 * @property PaginatorComponent $Paginator
 */
class RssController extends AppController {

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
		$this->Child->recursive = 0;
		$this->set('children', $this->Paginator->paginate());
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
		if ($this->request->is('post')) {
			$this->Child->create();
			if ($this->Child->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('child')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('child')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$families = $this->Child->Family->find('list', array('fields'=>array('id', 'nickname')));
		$clients = $this->Client->find('list', array('id', 'name'));
		$this->set(compact('families','clients'));
		
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
		$this->Child->id = $id;
		if (!$this->Child->exists()) {
			throw new NotFoundException(__('Invalid %s', __('child')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Child->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('child'))
					
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('child'))
					
					
				);
			}
		} else {
			$this->request->data = $this->Child->read(null, $id);
		}
		$families = $this->Child->Family->find('list', array('fields'=>array('id', 'nickname')));
		$clients = $this->Child->Client->find('list');
		$this->set(compact('families', 'clients'));

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
		$this->Child->id = $id;
		if (!$this->Child->exists()) {
			throw new NotFoundException(__('Invalid %s', __('child')));
		}
		if ($this->Child->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('child')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('child')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
