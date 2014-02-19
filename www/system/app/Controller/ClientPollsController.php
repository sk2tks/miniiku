<?php
App::uses('AppController', 'Controller');
/**
 * ClientPolls Controller
 *
 * @property ClientPoll $ClientPoll
 * @property PaginatorComponent $Paginator
 */
class ClientPollsController extends AppController {

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
		$this->ClientPoll->recursive = 0;
		$this->set('clientPolls', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ClientPoll->id = $id;
		if (!$this->ClientPoll->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client poll')));
		}
		$this->set('clientPoll', $this->ClientPoll->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientPoll->create();
			if ($this->ClientPoll->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('client poll')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('client poll')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$clients = $this->ClientPoll->Client->find('list');
		$this->set(compact('clients'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ClientPoll->id = $id;
		if (!$this->ClientPoll->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client poll')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ClientPoll->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('client poll')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('client poll')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->ClientPoll->read(null, $id);
		}
		$clients = $this->ClientPoll->Client->find('list');
		$this->set(compact('clients'));
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
		$this->ClientPoll->id = $id;
		if (!$this->ClientPoll->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client poll')));
		}
		if ($this->ClientPoll->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('client poll')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('client poll')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
