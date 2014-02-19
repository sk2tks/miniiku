<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 */
class CommentsController extends AppController {

public $uses = array('Comment' , 'ContentsType' , 'Category');

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
		$search_key = 'admin_comment_search_key';
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		//検索用セレクトoptions
		$contentsTypes = $this->ContentsType->find('list', array(
			'conditions'=>array('id'=>array(1,2,3,4,5,7))
		));
		
		//comments
		$fields = array(
			'Comment.id', 'Comment.contents_type_id', 'ContentsType.name', 'Comment.contents_target_id',
			'Comment.parent_comment_id', 'User.id', 'User.name', 'Comment.body', 'Comment.delete_flag',
			'Comment.plus', 'Comment.minus', 'Comment.modified', 'Comment.created'
		);
		$cond = array();
		$order = 'created DESC';
		$limit = 20;
		
		$d =& $this->request->data['Comment'];
		if(!empty($d)){
			if(!empty($d['id'])) $cond['Comment.id'] = $d['id'];
			if(!empty($d['contents_type_id'])){
				$cond['Comment.contents_type_id'] = $d['contents_type_id'];
				if(!empty($d['contents_target_id'])){
					$cond['contents_target_id'] = $d['contents_target_id'];
				}
			}
			if(!empty($d['keyword'])){
				$cond['Comment.body LIKE'] = '%'.$d['keyword'].'%';
			}
		}
		
		$this->Comment->recursive = 1;
		$this->paginate = array(
			'fields'=>$fields,
			'conditions'=>$cond,
			'order' => $order,
			'limit' => $limit,
		);
		$comments = $this->Paginator->paginate();
		
		$this->set(compact('contentsTypes', 'comments'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment')));
		}
		$this->set('comment', $this->Comment->read(null, $id));
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
			$this->Comment->id = $id;
			if (!$this->Comment->exists()) {
				throw new NotFoundException(__('Invalid %s', __('comment')));
			}
			$this->request->data = $this->Comment->read(null, $id);
		}
		$this->admin_entry();
	}
	
/**
 * admin_entry method
 *
 * @param int $id
 * @return void
 */
	public function admin_entry($id = null) {

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Comment->create();
			
			$ret = $this->Comment->saveAll($this->request->data, array('validate'=>'only'));
			if ( $ret && $this->Comment->saveAll($this->request->data , array('validate'=>false))) {
				$comment_id = !empty($this->request->data['Comment']['id']) 
										? $this->request->data['Comment']['id']
										: $this->Comment->getLastInsertID();
				$this->Comment->id = $comment_id;
				
				$contentsTypeId = $this->request->data['Comment']['contents_type_id'];
				$t = ($contentsTypeId == 7) ? 'topics' : 'clients';
				$this->loadModel('Topic');
				
				//削除フラグが1なら本コメントを親とするコメントも削除フラグを1にする。⇒そうしないよう仕様変更
				// if($this->request->data['Comment']['delete_flag'] == 1){
					// $sql = "UPDATE {$t} SET delete_flag=1 WHERE parent_comment_id={$comment_id}";
					// $c->Topic->query($sql);
				// }
				
				//対象コンテンツのnum_commentsを再設定
				$contentsTargetId = $this->request->data['Comment']['contents_target_id'];
				$cnt = $this->Comment->find('count', array(
					'conditions'=>array(
						'contents_type_id'=>$contentsTypeId,
						'contents_target_id'=>$contentsTargetId,
						'delete_flag'=>0
					)
				));
				$sql = "UPDATE {$t} SET num_comments={$cnt} WHERE id={$contentsTargetId}";
				$this->Topic->query($sql);
				
				$this->Session->setFlash(__('The %s has been saved', __('comment')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('comment')));
			}
		}
		
		$contentsTypes = $this->ContentsType->find('list', array(
			'conditions'=>array('id'=>array(1,2,3,4,5,7))
		));
		//$users = $this->Comment->User->find('list');
		
		$this->set(compact('contentsTypes'/*, 'users'*/));
		
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
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid %s', __('comment')));
		}
		if ($this->Comment->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('comment')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('comment')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
