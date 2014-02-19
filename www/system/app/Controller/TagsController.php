<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 * @property PaginatorComponent $Paginator
 */
class TagsController extends AppController {

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
		$search_key = 'admin_tags_search_key';
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		//検索用セレクトoptions
		$categories = $this -> Tag->Category -> find('list' , array(
			'fields' => array('Category.category_name'),
			'conditions' => array('Category.contents_type_id' => '7')
		));
		
		$cond = array();
		
		$d =& $this->request->data['Tag'];
		if(!empty($d)){
			if(!empty($d['id'])) $cond['Tag.id'] = $d['id'];
			if(!empty($d['category_id'])){
				$cond['Tag.category_id'] = $d['category_id'];
			}
			if(!empty($d['keyword'])){
				$cond['or'] = array(
					'Tag.word LIKE'=>'%'.$d['keyword'].'%',
				);
			}
		}
		
		$this->Tag->recursive = 0;
		$this->paginate = array('conditions'=>$cond);
		$tags = $this->Paginator->paginate();
		$this->set(compact('tags', 'categories'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid %s', __('tag')));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('tag')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('tag')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$categories = $this->Tag->Category->find('list', array(
			'conditions'=>array('contents_type_id'=>7)
		));
		$this->set(compact('categories'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid %s', __('tag')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('tag')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('tag')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->Tag->read(null, $id);
		}
		$categories = $this->Tag->Category->find('list', array(
			'conditions'=>array('contents_type_id'=>7)
		));
		$this->set(compact('categories'));
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
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
			throw new NotFoundException(__('Invalid %s', __('tag')));
		}
		if ($this->Tag->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('tag')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('tag')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
