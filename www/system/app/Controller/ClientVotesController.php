<?php
App::uses('AppController', 'Controller');
/**
 * ClientVotes Controller
 *
 * @property ClientVote $ClientVote
 * @property PaginatorComponent $Paginator
 */
class ClientVotesController extends AppController {

	public $uses = array('ClientVote' , 'ClientPoll');

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
	public function admin_index() {
		$this->ClientVote->recursive = 0;
		$this->set('clientVotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ClientVote->id = $id;
		if (!$this->ClientVote->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client vote')));
		}
		$this->set('clientVote', $this->ClientVote->read(null, $id));
	}

function get_average_vote($id){
	$client = $this->ClientVote->Client->findById($id);
	if($client['Client']['contents_type_id']!=1)return false;

	$arg = array(
		'fields' => array(
			//'ClientVote.client_id',
			'AVG(ClientVote.n1)',
			'AVG(ClientVote.n2)',
			'AVG(ClientVote.n3)',
			'AVG(ClientVote.n4)',
			'AVG(ClientVote.n5)'
			),
		'group' => 'ClientVote.client_id',
		'conditions' => array(
			'ClientVote.client_id' => $id
		));


	$res = $this -> ClientVote -> find('all' , $arg);

	$res = array_values($res[0][0]);

	return $res;

}

function get_sum_vote($id){
		$client = $this->ClientVote->Client->findById($id);
	if($client['Client']['contents_type_id']==1)return false;

	$arg = array(
		'fields' => array(
			//'ClientVote.client_id',
			'SUM(ClientVote.n1)',
			'SUM(ClientVote.n2)',
			'SUM(ClientVote.n3)',
			),
		'group' => 'ClientVote.client_id',
		'conditions' => array(
			'ClientVote.client_id' => $id
		));

	$res = $this -> ClientVote -> find('all' , $arg);

	$res = array_values($res[0][0]);

	return $res;
}


//ユーザーがすでに投票していたらtrueを返す
function has_voted($cid , $uid){

}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ClientVote->create();
			if ($this->ClientVote->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('client vote')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);



if(isset($this->request->data['ClientVote']['client_id']) && ($this->request->data['ClientVote']['client_id'] != '')){
			$cid = $this->request->data['ClientVote']['client_id'];
			$client = $this->ClientVote->Client->findById($cid);
			$ctypeid = $client['Client']['contents_type_id'];
		}else{
			$this->Session->setFlash('no client_id');
			return;
		}

//contents_Type_id = 1 の場合、平均値を出してpollsに保存
				if(isset($this->request->data['ClientVote']['client_id'])&&($ctypeid == 1)){
						
						$res = $this->ClientPoll->find('first' , array('fields'=>array('ClientPoll.id'),'conditions' => array('ClientPoll.client_id' => $cid)));
						$cp_id = $res['ClientPoll']['id'];

						$avg = $this->get_average_vote($cid);
						
						$data = array();
						
						//$data['ClientPoll']['id'] = $cp_id;
						$data['ClientPoll']['n1'] = $avg[0];
						$data['ClientPoll']['n2'] = $avg[1];
						$data['ClientPoll']['n3'] = $avg[2];
						$data['ClientPoll']['n4'] = $avg[3];
						$data['ClientPoll']['n5'] = $avg[4];


						$this->ClientPoll->id = $cp_id;

						//同じユーザーがすでに投票していたらブロック
						//if($this->has_voted($cid , $uid))return false;

						$this->ClientPoll->save($data);

				}else{
//それ以外の場合累計値を出してpollsに保存
						$res = $this->ClientPoll->find('first' , array('fields'=>array('ClientPoll.id'),'conditions' => array('ClientPoll.client_id' => $cid)));
						$cp_id = $res['ClientPoll']['id'];

						$sum = $this->get_sum_vote($cid);
						
						$data = array();
						
						//$data['ClientPoll']['id'] = $cp_id;
						$data['ClientPoll']['n1'] = $sum[0];
						$data['ClientPoll']['n2'] = $sum[1];
						$data['ClientPoll']['n3'] = $sum[2];

						$this->ClientPoll->id = $cp_id;

						//同じユーザーがすでに投票していたらブロック
						//if($this->has_voted($cid , $uid))return false;

						$this->ClientPoll->save($data);

				}

				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('client vote')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$clients = $this->ClientVote->Client->find('list');
		$users = $this->ClientVote->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->ClientVote->id = $id;
		if (!$this->ClientVote->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client vote')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ClientVote->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('client vote')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('client vote')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->ClientVote->read(null, $id);
		}
		$clients = $this->ClientVote->Client->find('list');
		$users = $this->ClientVote->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ClientVote->id = $id;
		if (!$this->ClientVote->exists()) {
			throw new NotFoundException(__('Invalid %s', __('client vote')));
		}
		if ($this->ClientVote->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('client vote')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('client vote')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

}
