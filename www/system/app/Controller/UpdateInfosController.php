<?php
App::uses('AppController', 'Controller');
/**
 * UpdateInfos Controller
 *
 * @property UpdateInfo $UpdateInfo
 * @property PaginatorComponent $Paginator
 */
class UpdateInfosController extends AppController {

/**
 *  Layout
 *
 * @var string
 */
	
public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
/**
 * Helpers
 *
 * @var array
 */
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if(!empty($this->request->params['admin'])){
			$this->set('title_for_layout', '更新情報管理');
			$this->set('prefectures', $this->UpdateInfo->Prefecture->find('list'));
		}
	}
	
	public function index(){
		$conditions = array('UpdateInfo.status'=>'1');
			if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'UpdateInfo.publicity_range'=>1,//同地域限定
								'UpdateInfo.area_id'=>$this->currentAreaId
							),
							array(
								'UpdateInfo.publicity_range'=>2,//同市区町村限定
								'UpdateInfo.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'UpdateInfo.publicity_range'=>3,//同都道府県限定
								'UpdateInfo.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'UpdateInfo.publicity_range'=>4,//全国
							)
					));
			}
			$this->paginate = array(
				'conditions'=> $conditions,
				'order' => 'update_date desc',
				'limit' => 10,
				'contaion'=>array(),
				
			);
			$this->set('update_infos', $this->paginate());
			
			$this->set('title_for_layout', '更新情報一覧');
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		$search_key = 'admin_update_info_search_key';
		
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}
		
		$conditions = array();
		if(!empty($this->request->data['UpdateInfo'])){
			$data = $this->request->data['UpdateInfo'];
			
			if(!empty($data['title'])){
				$conditions[] = array('UpdateInfo.title like'=>"%".$data['title'] . "%");
			}
			if(!empty($data['prefecture_id'])){
				$conditions[] = array('UpdateInfo.prefecture_id'=>$data['prefecture_id']);
			}
			if(!empty($data['municipal_id'])){
				$conditions[] = array('UpdateInfo.municipal_id'=>$data['municipal_id']);
			}
			if(!empty($data['area_id'])){
				$conditions[] = array('UpdateInfo.area_id'=>$data['area_id']);
			}
			
	
			$ret = $this->check_date($data['update_date_start']);
			if($ret){
				$date = $this->createDateSql($data['update_date_start']);
				$conditions[] = array('UpdateInfo.update_date >='=>$date);
			}
			
			$ret = $this->check_date($data['update_date_end']);
			if($ret){
				$date = $this->createDateSql($data['update_date_end'], true);
				$conditions[] = array('UpdateInfo.update_date <'=>$date);
			};
		
		}
		$params = array('conditions'=>$conditions, 'order'=>'update_date desc');
		$this->Paginator->settings = $params;
		
		$this->set('updateInfos', $this->Paginator->paginate());
		
			if(!empty($this->request->data['UpdateInfo']['prefecture_id']))
			$this->set('municipals', $this->UpdateInfo->Municipal->getListByPref($this->request->data['UpdateInfo']['prefecture_id']));
			if(!empty($this->request->data['UpdateInfo']['municipal_id']))
			$this->set('areas', $this->UpdateInfo->Area->find('list'));
	}

	public function check_date($dates){
		if(empty($dates)) return false;
		$dates = Set::filter($dates);
		return !empty($dates);
	}

	public function createDateSql($dates, $isEnd=false){
		$year = empty($dates['year']) ? date('Y') : $dates['year'];
		$month = empty($dates['month']) ? date('m') : $dates['month'];
		$day = empty($dates['day']) ? date('d') : $dates['day'];
		$day = $isEnd ? $day+1 : $day;
		return date('Y-m-d H:i:s', mktime(0,0,0,$month, $day, $year));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->UpdateInfo->id = $id;
		if (!$this->UpdateInfo->exists()) {
			throw new NotFoundException(__('Invalid %s', __('update info')));
		}
		$this->set('updateInfo', $this->UpdateInfo->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UpdateInfo->create();
			if ($this->UpdateInfo->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('update info')
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('update info')
					)
				);
			}
		}else{
			$this->request->data['UpdateInfo']['prefecture_id'] = 13;
			$this->request->data['UpdateInfo']['municipal_id'] = 630;
			//$this->request->data['UpdateInfo']['area_id'] = 1;
			$this->request->data['UpdateInfo']['update_date'] = date('Y-m-d H:i:s');
		}
		if(!empty($this->request->data['UpdateInfo']['prefecture_id']))
		$this->set('municipals', $this->UpdateInfo->Municipal->getListByPref($this->request->data['UpdateInfo']['prefecture_id']));
		if(!empty($this->request->data['UpdateInfo']['municipal_id']))
		$this->set('areas', $this->UpdateInfo->Area->find('list', array('conditions'=>array('municipal_id'=>$this->request->data['UpdateInfo']['municipal_id']))));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->UpdateInfo->id = $id;
		if (!$this->UpdateInfo->exists()) {
			throw new NotFoundException(__('Invalid %s', __('update info')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			if ($this->UpdateInfo->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('update info'))
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('update info')));
			}
		} else {
			$this->request->data = $this->UpdateInfo->read(null, $id);
			
		}
		if(!empty($this->request->data['UpdateInfo']['prefecture_id']))
		$this->set('municipals', $this->UpdateInfo->Municipal->getListByPref($this->request->data['UpdateInfo']['prefecture_id']));
		if(!empty($this->request->data['UpdateInfo']['municipal_id']))
		$this->set('areas', $this->UpdateInfo->Area->find('list', array('conditions'=>array('municipal_id'=>$this->request->data['UpdateInfo']['municipal_id']))));
		
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
		$this->UpdateInfo->id = $id;
		if (!$this->UpdateInfo->exists()) {
			throw new NotFoundException(__('Invalid %s', __('update info')));
		}
		if ($this->UpdateInfo->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('update info'))
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('update info'))
		);
		$this->redirect(array('action' => 'index'));
	}

}
