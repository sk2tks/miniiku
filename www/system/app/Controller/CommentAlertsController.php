<?php
App::uses('AppController', 'Controller');
/**
 * CommentAlerts Controller
 *
 * @property CommentAlert $CommentAlert
 * @property PaginatorComponent $Paginator
 */
class CommentAlertsController extends AppController {

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
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		//セッション
		$search_key = 'admin_comment_alerts_search_key';
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		//検索用セレクトoptions
		$contentsTypes = $this->CommentAlert->ContentsType->find('list', array(
			'conditions'=>array('id'=>array(1,2,3,4,5,7))
		));
		$alertFlags = array(1=>1, 2=>2, 3=>3);
		$alertChecks = array(0=>0, 1=>1);
		
		//commentAlerts
		$this->CommentAlert->recursive = 1;
		$cond = array();
		$d =& $this->request->data['CommentAlert'];
		if(!empty($d) || $d['alert_check'] === '0'){
			if(!empty($d['id'])) $cond['CommentAlert.id'] = $d['id'];
			if(!empty($d['contents_type_id'])){
				$cond['CommentAlert.contents_type_id'] = $d['contents_type_id'];
				if(!empty($d['contents_target_id'])){
					$m = ($d['contents_type_id'] == 7) ? 'Topic' : 'Client';
					$cond[$m . '.' . 'id'] = $d['contents_target_id'];
				}
			}
			if(!empty($d['alert_flag'])) $cond['alert_flag'] = $d['alert_flag'];
			if(!empty($d['alert_check']) || $d['alert_check'] === '0'){
				$cond['alert_check'] = $d['alert_check'];
			}
		}
		
		$this->paginate = array(
			'conditions'=>$cond
		);
		$commentAlerts = $this->Paginator->paginate();
		$this->set(compact('commentAlerts', 'contentsTypes', 'alertFlags', 'alertChecks'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->CommentAlert->id = $id;
		if (!$this->CommentAlert->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment alert')));
		}
		$this->set('commentAlert', $this->CommentAlert->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CommentAlert->create();
			if ($this->CommentAlert->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('comment alert')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('comment alert')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$contentsTypes = $this->CommentAlert->ContentsType->find('list');
		$comments = $this->CommentAlert->Comment->find('list');
		$users = $this->CommentAlert->User->find('list');
		$this->set(compact('contentsTypes', 'comments', 'users'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->CommentAlert->id = $id;
		if (!$this->CommentAlert->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment alert')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CommentAlert->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('comment alert')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('comment alert')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->CommentAlert->read(null, $id);
		}
		$contentsTypes = $this->CommentAlert->ContentsType->find('list', array(
			'conditions'=>array('id'=>array(1,2,3,4,5,7))
		));
		$alertFlags = array(1=>1, 2=>2, 3=>3);
		$this->set(compact('contentsTypes', 'alertFlags'));
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
		$this->CommentAlert->id = $id;
		if (!$this->CommentAlert->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment alert')));
		}
		if ($this->CommentAlert->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('comment alert')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('comment alert')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
