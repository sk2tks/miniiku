<?php
App::uses('AppController', 'Controller');
/**
 * Sources Controller
 *
 * @property Source $Source
 * @property PaginatorComponent $Paginator
 */
class SourcesController extends AppController {

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
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Source->recursive = 0;
		$this->set('sources', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		$this->set('source', $this->Source->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Source->create();
			if ($this->Source->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$municipals = $this->Source->Municipal->find('list');
		$this->set(compact('municipals'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Source->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->Source->read(null, $id);
		}
		$municipals = $this->Source->Municipal->find('list');
		$this->set(compact('municipals'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		if ($this->Source->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('source')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('source')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Source->recursive = 0;
		$this->set('sources', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		$this->set('source', $this->Source->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Source->create();
			if ($this->Source->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$municipals = $this->Source->Municipal->find('list');
		$this->set(compact('municipals'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Source->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('source')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->Source->read(null, $id);
		}
		$municipals = $this->Source->Municipal->find('list');
		$this->set(compact('municipals'));
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
		$this->Source->id = $id;
		if (!$this->Source->exists()) {
			throw new NotFoundException(__('Invalid %s', __('source')));
		}
		if ($this->Source->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('source')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('source')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
