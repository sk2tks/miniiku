<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 */
class ClientsController extends AppController {

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

	            't' => array(
	                'max_width' => 81,
	                'max_height' => 61
	            ),
	            's' => array(
	                'max_width' => 148,
	                'max_height' => 111
	            ),
	            'm' => array(
	                'max_width' => 338,
	                'max_height' => 254
	            ),
	            'l' => array(
	                'max_width' => 800,
	                'max_height' => 600
	            ),
			)
	));

	public $uses = array('Client' , 'ClientInfo', 'ClientVote','ClientPoll','User', 'Customer', 'Comment', 'CommentVote' , 'Contact');

	public $helpers = array('Formhidden' , 'TwitterBootstrap.BootstrapForm');

	public $basic_info_default = array(//「基本情報」タブ内の項目のデフォルトのうち、ClientInfoに保存するもの
		//保育施設
		'1' => array(
			'最寄り駅','営業時間','定休日','サービス','受入年齢'
			),
		//スポット
		'2' => array(
			'最寄り駅','営業時間','定休日','料金','駐車場'
			),
		//習い事
		'3' => array(
			'最寄り駅','営業時間','定休日','駐車場'
			),
		//コミュニティ
		'4' => array(
			'最寄り駅'
			),
		//医療施設
		'5' => array(
			'最寄り駅','営業時間','定休日','駐車場'
			),
		);

	public $tabs = array(
		'1' => '基本情報',
		'2' => '施設紹介・スポット紹介・教室紹介・団体紹介',
		// '3' => 'スポット紹介',
		// '4' => '教室紹介',
		// '5' => '団体紹介',
		'6' => '定員情報',
		'7' => '評価コメント',
		'8' => '職員募集・クーポン・お問い合わせ',
		// '9' => 'クーポン',
		// '10' => 'お問い合わせ'
	);

	public $recruit_default = array(
			array('item' => '仕事内容'),
			array('item' => '勤務時間'),
			array('item' => '応募資格'),
			array('item' => '採用担当者より'),
			array('item' => '給与'),
			array('item' => '待遇'),
		);

	public $capacity_default =array(
			array('0歳'),
			array('1歳'),
			array('2歳'),
			array('3~5歳')
		);

	public $coupon_default =array(
			array('item' => '期間1'),
			array('item' => '期間2'),
			array('item' => '特典1')
		);

	public function beforeFilter(){
		parent::beforeFilter();
		if(isset($this->params['admin'])){
			$this->set('title_for_layout', '施設管理');
		}
		if(!in_array($this->Auth->user('user_type') , array(2,3,4))){
			$this->Auth->deny('edit');
		}
		$this->Auth->loginAction = '/users/popup_login';


		//$this->set('contents_types', $this->Client->ContentsType->find('list'));

		//$this->Auth->loginAction = '/users/popup_login';
	}

	//カスタマー（=一般ユーザー）又は施設オーナーのみ投稿可
	//public function isAuthorized( $user ) {
	//	return ($user['user_type'] == '1') || ($user['user_type'] == '2');
	//}

	public function isAuthorized( $user ) {
		parent::isAuthorized( $user );
		return ( $user['user_type'] == USER_TYPE_CUSTOMER || $user['user_type'] == USER_TYPE_SYSTEM_ADMIN);
	}



/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$search_key = 'admin_client_search_key';

		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}

		if(!empty($this->request->data['Client'])) $data = $this->request->data['Client'];

		$conditions = array();
		if(!empty($data['name'])){
			$conditions[] = array('Client.name like'=>"%".$data['name'] . "%");
		}
		if(!empty($data['contents_type_id'])){
			$conditions[] = array('Client.contents_type_id'=>$data['contents_type_id']);
		};
		if(!empty($data['prefecture_id'])){
			$conditions[] = array('Client.prefecture_id'=>$data['prefecture_id']);
		};

		$params = array('conditions'=>$conditions);
		$this->Paginator->settings = $params;

		$this->set('clients', $this->Paginator->paginate());
		$this->set('contents_types', $this->Client->ContentsType->find('list'));
		$this->set('prefectures', $this->Client->Prefecture->find('list'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($ctype) {
		$this->isEdit = false;
			//基本情報のデフォルトを送る準備
			$basic_info = array();
				$i = 0;
				foreach($this->basic_info_default[$ctype] as $k){
					$basic_info[] = array('item'=>$k, 'value' => '');
					$i++;
				}
			//仕事情報のデフォルトを送る準備
			$recruit_info = $this->recruit_default;

			//定員情報のデフォルトを送る準備
			$capacity_info =  $this->capacity_default;

			//クーポン情報のデフォルトを送る準備
			$coupon_info = $this->coupon_default;

			//デフォルトを送る
				$this->set('basic_info' , $basic_info);
				$this->set('recruit_info' , $recruit_info);
				$this->set('capacity_info' , $capacity_info);
				$this->set('coupon_info' , $coupon_info);

		$this->admin_entry(null , $ctype);

	}
/*
ClientInfoデータをフォーム用に整形
*/
	public function setup_cinfo_data($data){
		$_data = array();
		foreach ($data as $key => $value) {
			$_data[] = $value['ClientInfo'];
		}
		return $_data;
	}

/*
定員情報データをフォーム用に整形
*/
	public function setup_capacity_data($data){
		$_data = array();
		foreach ($data as $value) {
			$_data[] = unserialize($value['ClientInfo']['value']);
		}
		return $_data;
	}

/*
クーポン情報データをフォーム用に整形
'期間1'と'期間2'を必ず1番目と2番目に整形
*/
	public function setup_coupon_data($data){
		$_data = array();
		$_data[0] = array('item' => '期間1');
		$_data[1] = array('item' => '期間2');
		foreach ($data as $key => $value) {
			if($value['ClientInfo']['item']=='期間1')
			{
				$_data[0] = $value['ClientInfo'];
			}
			if($value['ClientInfo']['item']=='期間2')
			{
				$_data[1] = $value['ClientInfo'];
			}
		}
		foreach ($data as $key => $value) {
			if(($value['ClientInfo']['item']!='期間1')&&($value['ClientInfo']['item']!='期間2')){
			$_data[] = $value['ClientInfo'];
			}else{continue;}
		}
		return $_data;
	}

/*
施設オーナーかどうか判定
*/
public function is_owner($client_id , $owner_id){
	$res = $this->Client->find('first' , array('conditions' => array('Client.id' => $client_id)));
	if($res){
		$us = $res['User'];
		$ua = array();
		foreach ((array)$us as $item) {
			$ua[] = $item['id'];
		}
		if(in_array($owner_id, $ua)){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}

}



/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$uid = $this->Auth->user('id');
		$utype = $this->Auth->user('user_type');

		if (!$this->request->is('post') && !$this->request->is('put')) {//編集フォーム
			if (!$this->Client->exists($id)) {
				throw new NotFoundException(__('Invalid client'));
			}

	 		//オーナー所有施設でなければブロック
			if(($this->is_owner($id , $uid)) || ($utype == 4)){
					$this->admin_edit($id , 'owner');
			}else{
					$this->set('error' , 'not_owner');
					$this->render('entry');
			}

		}else{//保存のみ
			$this->isEdit = true;
			$this->admin_entry($id , null ,'owner');

		}

	}



/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @param $mode = 'owner' , null
 * @return void
 */
	public function admin_edit($id = null , $mode = null) {
		if (!$this->request->is('post') && !$this->request->is('put')) {//編集フォーム表示
			if (!$this->Client->exists($id)) {
				throw new NotFoundException(__('Invalid client'));
			}

// 1:基本情報 2:施設紹介 スポット紹介 教室紹介 団体紹介 3:定員情報 7:x 8:職員募集 9:クーポン 10:x
//Client情報読み込み
			$this->request->data = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));

		}
		$this->isEdit = true;
		//debug($this->request->data);
//メタ情報読み込み
		$this->Client->ClientInfo->recursive = -1;
		$facility_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '1' , 'ClientInfo.client_id' => $id)));
		$basic_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '2' , 'ClientInfo.client_id' => $id)));
		$capacity_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '6' , 'ClientInfo.client_id' => $id)));
		$recruit_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '8'  , 'ClientInfo.client_id' => $id)));
		$coupon_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '8'  , 'ClientInfo.client_id' => $id)));

//フォーム流し込み用データに変換(何もない時はデフォルトを送る)
			$facility_info 			= $this->setup_cinfo_data($facility_info);
			$basic_info 				= $this->setup_cinfo_data($basic_info);
			if($capacity_info){
				$capacity_info 	= $this->setup_capacity_data($capacity_info);
			}else{
				$capacity_info = $this->capacity_default;
			}
			if($recruit_info	){
				$recruit_info	= $this->setup_cinfo_data($recruit_info);
			}else{
				$recruit_info = $this->recruit_default;
			}
			if($coupon_info){
				$coupon_info	= $this->setup_coupon_data($coupon_info);
			}else {
				$coupon_info = $this->coupon_default;
			}
		$this->set('facility_info' , $facility_info);
		$this->set('basic_info' , $basic_info);
		$this->set('capacity_info' , $capacity_info);
		$this->set('recruit_info' , $recruit_info);
		$this->set('coupon_info' , $coupon_info);
//フォーム表示
		if($mode == 'owner'){
			$this->admin_entry($id , $this->request->data['Client']['contents_type_id'] , 'owner');
		}else{
			$this->admin_entry($id , $this->request->data['Client']['contents_type_id']);
		}
	}




/*
入力フォーム表示・保存
mode = admin || user
*/

	public function admin_entry($id = null , $ctype = null ,$mode = null) {

//保存------------------------------------------------------------------
		if ($this->request->is('post') || $this->request->is('put')) {

	//施設情報をDB保存用にセットアップ
			$facility_info = array();

			if(!empty($this->request->data['FacilityInfo'])){
			$facility_data = $this->request->data['FacilityInfo'];
					//あらかじめ関連するメタをクリア
					if($this->isEdit){
						$this->ClientInfo->deleteAll(array('client_id' => $id , 'tab' => '1'));
					}
			}else{
				$facility_data = array();
			}
	//基本情報をDB保存用にセットアップ
			if(!empty($this->request->data['BasicInfo'])){
					//あらかじめ関連するメタをクリア
					if($this->isEdit){
						$this->ClientInfo->deleteAll(array('client_id' => $id , 'tab' => '2'));
					}
			$binfo_data = $this->request->data['BasicInfo'];
			}else{
				$binfo_data = array();
			}
	//定員情報をDB保存用にセットアップ
			if(!empty($this->request->data['Capacity'])){
						//あらかじめ関連するメタをクリア
					if($this->isEdit){
						$this->ClientInfo->deleteAll(array('client_id' => $id , 'tab' => '6'));
					}
				$capacity_data = $this->request->data['Capacity'];
				$capacity = array();
				$i = 0;
				foreach ($capacity_data as $key => $arr) {
					$capacity[] = array('item'=>'capacity-'.$i, 'value' => serialize($arr) , 'tab' => '6');
					$i++;
				}
				}else{
					$capacity = array();
					$capacity_data = array();
				}
	//職員募集をDB保存用にセットアップ
			if(!empty($this->request->data['RecruitInfo'])){
			//あらかじめ関連するメタをクリア
					if($this->isEdit){
						$this->ClientInfo->deleteAll(array('client_id' => $id , 'tab' => '8'));
					}
			$recruit_data = $this->request->data['RecruitInfo'];
			}else{
				$recruit_data = array();
			}

	//クーポン募集をDB保存用にセットアップ
			if(!empty($this->request->data['CouponInfo'])){
			//あらかじめ関連するメタをクリア
					if($this->isEdit){
						$this->ClientInfo->deleteAll(array('client_id' => $id , 'tab' => '8'));
					}
			$coupon_data = $this->request->data['CouponInfo'];
			}else{
				$coupon_data = array();
			}

	//ClientInfoに統合
	$this->request->data['ClientInfo'] = array_merge((array)$facility_data , (array)$binfo_data , (array)$capacity , (array)$recruit_data , (array)$coupon_data);



			if ($this->Client->saveAll($this->request->data)) {
				$client_id = !empty($this->request->data['Client']['id']) ? $this->request->data['Client']['id'] : $this->Client->getLastInsertID();

				//$this->ClientInfo->saveAll($this->request->data['ClientInfo']);
				$save_images = array();
				for($i=1; $i<=8; $i++){
					$uploaded = 'uploaded'.$i;
					$file_name = 'file_name'.$i;
					$deleted = 'deleted'.$i;
					if(!empty($this->request->data[$deleted])){
						if(!empty($this->request->data['Client'][$file_name])){
							$this->UploadHandler->delete_file_recursive( CLIENT_UPLOAD_DIR, $this->request->data['Client'][$file_name] );
							$save_images[$file_name] = '';
						}
					}else{
							if(!empty($this->request->data['Client'][$uploaded])){
								if(!empty($this->request->data['Client'][$file_name])){
									$this->UploadHandler->delete_file_recursive( CLIENT_UPLOAD_DIR, $this->request->data['Client'][$file_name] );
								}

								$newname = $client_id . '_' . String::uuid();
								$newname = $this->UploadHandler->move_upload_files( CLIENT_UPLOAD_DIR, $this->request->data['Client'][$uploaded], $newname );
								//$delete_file = TEMP_UPLOAD_DIR.'s/'.$this->request->data['Client'][$uploaded];
	//unset($delete_file);
								$save_images[$file_name] = $newname;
							}
					}

				}
				if(!empty($save_images)){
					$save_images['id'] = $client_id;
					$this->Client->save($save_images);
				}
				//$this->Session->setFlash(__('施設を登録しました'));
				if($mode != 'owner'){
					$this->Session->setFlash(__('施設を登録しました'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('施設を更新しました'));
					$form_tab = (isset($this->request->data['Client']['form_tab']))?$this->request->data['Client']['form_tab']:'';
					return $this->redirect('/clients/edit/'.$id.'?tab='.$form_tab);
				}
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'));
			}
		}

//新規および編集------------------------------------------------------------------
		if(!$this->isEdit){//新規の場合
			// //基本情報のデフォルトを送る準備
			// $basic_info = array();
			// 	$i = 0;
			// 	foreach($this->basic_info_default[$ctype] as $k){
			// 		$basic_info[] = array('item'=>$k, 'value' => '');
			// 		$i++;
			// 	}
			// //仕事情報のデフォルトを送る準備
			// $recruit_info = $this->recruit_default;

			// //定員情報のデフォルトを送る準備
			// $capacity_info =  $this->capacity_default;

			// //デフォルトを送る
			// 	$this->set('basic_info' , $basic_info);
			// 	$this->set('recruit_info' , $recruit_info);
			// 	$this->set('capacity_info' , $capacity_info);
		}

		$contentsTypes = $this->Client->ContentsType->find('list');
		$prefectures = $this->Client->Prefecture->find('list');
		$municipals = array();
		if(!empty($this->request->data['Client']['prefecture_id'])){
			$municipals = $this->Client->Municipal->getListByPref($this->request->data['Client']['prefecture_id']);
		}
		$areas = array();
		if(!empty($this->request->data['Client']['municipal_id'])){
			$areas = $this->Client->Area->find('list', array('conditions'=>array('municipal_id'=>$this->request->data['Client']['municipal_id'])));
		}

		if(!empty($this->request->data['Client']['client_type_id'])){
			$client_type_id = $this->request->data['Client']['client_type_id'];
			$clientTypes = $this->Client->ClientType->find('list', array('conditions'=>array('contents_type_id'=>$this->request->data['Client']['contents_type_id'])));
		}else{
			$clientTypes = $this->Client->ClientType->find('list', array('conditions'=>array('contents_type_id'=>$ctype)));
		}

		$this->set(compact('clientTypes','contentsTypes', 'users', 'areas', 'municipals', 'prefectures','ctype'));
		$this->set('isEdit', $this->isEdit);
		$this->set('basic_info_default' , $this->basic_info_default);
		$this->set('recruit_default' , $this->recruit_default);
		$this->set('capacity_default' , $this->capacity_default);
		$this->set('ctype' , $ctype);
		$this->set('tabs' , $this->tabs);
		if($mode == 'owner'){
// debug($this->layout);
// 			$this->layout = 'default';
// 			$this->render('owner_entry');
			$this->ownerForm($id);
		}else{
			$this->render('admin_entry');
		}


	}

public function ownerForm($id){
			$this->render('entry');
}


/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Client->delete($id, true)) {
			$this->Session->setFlash(__('The client has been deleted.'));
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		$uid = $this->Auth->user('id');

		$this->Client->recursive = 1;
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$client = $this->Client->find('first', $options);
		$this->set('client', $client);
		$cv = $this->ClientVote->find('first',array('conditions'=>array('ClientVote.client_id'=>$id , 'ClientVote.user_id'=>$uid)));
		if($cv)$this->request->data['ClientVote'] = $cv['ClientVote'];

		$this->Client->ClientInfo->recursive = -1;
		$facility_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '1' , 'ClientInfo.client_id' => $id)));
		$basic_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '2' , 'ClientInfo.client_id' => $id)));
		$capacity_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '3' , 'ClientInfo.client_id' => $id)));
		$recruit_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '8'  , 'ClientInfo.client_id' => $id)));
		$coupon_info = $this->Client->ClientInfo->find('all' , array('conditions' => array('ClientInfo.tab' => '9'  , 'ClientInfo.client_id' => $id)));
	//フォーム流し込み用データに変換
		$facility_info 			= $this->setup_cinfo_data($facility_info);
		$basic_info 				= $this->setup_cinfo_data($basic_info);
		$capacity_info 			= $this->setup_capacity_data($capacity_info);
		$recruit_info				= $this->setup_cinfo_data($recruit_info);
		$coupon_info	= $this->setup_coupon_data($coupon_info);

		$this->set('facility_info' , $facility_info);
		$this->set('basic_info' , $basic_info);
		$this->set('capacity_info' , $capacity_info);
		$this->set('recruit_info' , $recruit_info);
		$this->set('coupon_info' , $coupon_info);

		$recruit_default_arr = array();

		foreach ($this->recruit_default as $item) {
			$recruit_default_arr[] = $item['item'];
		}

		$ctype = $client['Client']['contents_type_id'];

		$basic_info_default_arr = $this->basic_info_default[$ctype];

		$this->set('basic_info_default_arr' , $basic_info_default_arr);
		$this->set('recruit_default_arr' , $recruit_default_arr);

		/////////コメント関連処理////////////////////////////////////////////
		$d = $this->request->data;
		$i = $client;
		$loginUserId = $this->Auth->user('id');
		//CommentComponentをロード
		$cc = $this->Components->load('Comment');
		//コメント関連処理をCommentComponentに委譲
		$cc->manageComment($this, $d, $ctype, $id, $i, $loginUserId);
		////////////////////////////////////////////////////////////////

		$this->render('info');
	}

	/**
	 * comment_alert method
	 *
	 * 通報ボタン押下でajaxで呼ばれ、管理者へのメール送信とcomment_alertsテーブルへ登録を行い、結果をjsonとしてechoする。
	 * @param int commentId
	 * @return void
	 */
	public function comment_alert($commentId = null){
		$this->autoRender = false;
		//$this->layout = 'ajax';
		//pr('commentId:' . $commentId);

		//CommentComponentをロード
		$cc = $this->Components->load('Comment');
		//comment_alertをCommentComponentに委譲
		$cc->comment_alert($this, $commentId);
	}

//評価の平均を得る
	public function get_average_vote($id){


			$arg = array(
				'fields' => array(
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

//評価の平均を保存
	public function save_evaluate_average($id){
			$avg = $this->get_average_vote($id);

			$this->ClientPoll->updateAll(
			    array(
			    	'ClientPoll.n1' => $avg[0],
			    	'ClientPoll.n2' => $avg[1],
			    	'ClientPoll.n3' => $avg[2],
			    	'ClientPoll.n4' => $avg[3],
			    	'ClientPoll.n5' => $avg[4],
			    	'ClientPoll.modified' => "'" . date('Y-m-d H:i:s') . "'"
			    	),
			    array('ClientPoll.client_id' => $id)
			);
	}

//mode = full
	public function get_sum_vote($id , $mode=null){


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
	if($mode == 'full'){
		return $res;
	}else{
		$res = array_values($res[0][0]);
		return $res;
	}
}

//評価（5軸、3択）

	public function evaluate($id = null) {
		$this->layout = null;
		$uid = $this->Auth->user('id');
		$this->set('cid' , $id);
		$this->set('uid' , $uid);
		$client = $this->Client->find('first' , array('conditions'=>array('Client.id'=>$id)));
		$this->set('client' , $client);
		$cid = $client['Client']['contents_type_id'];

		if ($this->request->is('post') || $this->request->is('put')) {
			if($cid == 1){//保育施設
						if($this->ClientVote->save($this->request->data)){
							//平均値をClientPollに書き込み
							$this->save_evaluate_average($id);
							$this->Session->setFlash('保存されました');
							$this->set('result' , 'saved');
						}else{
							$this->Session->setFlash('保存できません');
							$this->set('result' , 'error');
						}
							$this->render('eva_nursery');
			}else{//保育以外

				if(!empty($this->request->data['ClientVote']['n'])){
					$nv = $this->request->data['ClientVote']['n'];
					$this->request->data['ClientVote']['n1'] = '0';
					$this->request->data['ClientVote']['n2'] = '0';
					$this->request->data['ClientVote']['n3'] = '0';
					$this->request->data['ClientVote']['n'.$nv] = '1';
				}

				$cv_id = $this->ClientVote->find('first' , array('conditions'=>array(
					'ClientVote.client_id' => $id,
					'ClientVote.user_id' => $uid
					)));

				if($cv_id)$this->request->data['ClientVote']['id'] = $cv_id['ClientVote']['id'];

				if($this->ClientVote->save($this->request->data)){
					//合計を求めてsave
					$res = $this->get_sum_vote($id);
					$this->request->data['ClientPoll']['client_id'] = $id;
					$this->request->data['ClientPoll']['n1'] = $res[0];
					$this->request->data['ClientPoll']['n2'] = $res[1];
					$this->request->data['ClientPoll']['n3'] = $res[2];



					$client_poll = $this->ClientPoll->find('first',array('conditions'=>array('ClientPoll.client_id'=>$id)));
					if($client_poll){

							$this->ClientPoll->updateAll(
							    array(
							    	'ClientPoll.n1' => $this->request->data['ClientPoll']['n1'],
							    	'ClientPoll.n2' => $this->request->data['ClientPoll']['n2'],
							    	'ClientPoll.n3' => $this->request->data['ClientPoll']['n3'],
							    	'ClientPoll.modified' => "'" . date('Y-m-d H:i:s') . "'"
							    	),
							    array('ClientPoll.client_id' => $id)
							);

						}else{
							$this->ClientPoll->save($this->request->data);
						}

				}

				$this->redirect('/clients/view/'.$id.'/?tab='.'4');
			}

		}else{

				$eva_default = array('ClientVote'=>array(
					'n1' => 3,
					'n2' => 3,
					'n3' => 3,
					'n4' => 3,
					'n5' => 3
					));
				$this->request->data = $eva_default;
			//debug($eva_data);
				$this->set('user' , $this->Auth->user());
				$this->set('result' , '');
				$this->render('eva_nursery');
			}
	}

	//地域の絞り込みは必要ない？
	public function mypage_popup_list($target_num, $client_type=null, $client_id=null){
		$this->layout = null;
		$this->set('clients', $this->Client->find('list', array('conditions'=>
						array('contents_type_id'=>1, 'client_type_id'=>$client_type, 'status'=>'1'))));
		$this->set('target_child_num', $target_num);
		$this->request->data['client_id'] = $client_id;

	}

	public function owner_popup_list(){

	}
	/**
 * index method
 *
 * @return void
 */
	public function search($type = null) {

// $test = $this ->Client ->ClientVote ->find('all');
// debug($test);

		$types = array(
			'nursery' => 1,
			'spot' => 2,
			'culture' => 3,
			'community' => 4,
			'medical' => 5
			);

		if($type){
			$contents_type_id = $types[$type];
		}else{
			$contents_type_id = 1;
		}

$cond = array();

$cond[] = array('Client.status' => '1');

$cond[] = array(
        	'ContentsType.id' => $contents_type_id
        	);

switch ($contents_type_id) {
	case '1'://保育
		if($this->currentAreaId){
			$cond[] = array(
				'Client.area_id' => $this->currentAreaId
			);
		}
		break;
	case '2'://スポット
		if($this->currentMunicipalId){
			$cond[] = array(
			'Client.municipal_id' => $this->currentMunicipalId
			);
		}
		break;
	case '3'://習い事
		if($this->currentPrefectureId){
			$cond[] = array(
			'Client.prefecture_id' => $this->currentPrefectureId
			);
		}
		break;
	case '4'://コミュニティ
		if($this->currentMunicipalId){
			$cond[] = array(
			'Client.municipal_id' => $this->currentMunicipalId
			);
		}
		break;
	case '5'://医療
		if($this->currentMunicipalId){
			$cond[] = array(
			'Client.municipal_id' => $this->currentMunicipalId
			);
		}
		break;

	default:

		break;
}

/* get search query */
//debug($this->request);
$this -> request->data['search'] = $this -> request -> query;

if(isset($this -> request -> query['client_type_id']) && ($this -> request -> query['client_type_id'] != '')){
	$client_type_id = $this -> request -> query['client_type_id'];
	$cond[] = array('Client.client_type_id' => $client_type_id);
}

if(isset($this -> request -> query['keyword']) && ($this -> request -> query['keyword'] != '')){
	//キーワードがある場合
	$keyword = $this -> request -> query['keyword'];
	$cond[] = array('Client.name LIKE' => '%%'.$keyword.'%%');
}
/* ---------------- */


		// $this->Paginator->settings = array(
  //       'limit' => 20,
  //       'conditions' => array(
  //       	'ContentsType.id' => $type_id
  //       	)
		// );

//$Ct = $this->Client->ContentsType->find('list');

$Ct = array(
			'1' => '育児施設',
			'2' => '子連れスポット',
			'3' => '近所の習い事',
			'4' => '地域コミュニティ',
			'5' => '街の医療機関'
	);

$this->set('title_for_layout' , $Ct[$contents_type_id]);

$this -> paginate =  array(
        //'limit' => 20,
        'conditions' => $cond
        );

$exist_client_types = $this->Client->find('all' ,
			array('conditions' => array(
				'Client.contents_type_id' => $contents_type_id
				),
			'group' => 'Client.client_type_id'
			));

$clientTypes = array();
foreach ($exist_client_types as $item) {
	$clientTypes[$item['ClientType']['id']] =  $item['ClientType']['name'];
}

		$this->Client->recursive = 1;
		$clients = $this->Paginator->paginate();
		$this->set('clients', $clients);
		$this->set('clientTypes' , $clientTypes);
		$this->set('type' , $type);
		$this->render('index');
	}



	public function contact($cid){
		//$this->Security->blackHoleCallback = 'blackhole';

		if($this->request->is('post')){
			//if(!$this->checkToken()) $this->redirect('/about/contact');
			$this->Contact->set($this->request->data);
			if($this->Contact->validates()){
				//$mode = $this->request->data['mode'];
				// if($mode == 'conf'){
				// 	$this->request->data['mode'] = 'comp';
				// 	$this->render('contact_conf');
				// 	return;
				//}else if($mode == 'comp'){
					$data =  $this->request->data['Contact'];
					if($this->Auth->loggedIn()){
						$user_info = $this->Session->read('user_info');
						$data['user_name'] = $this->Auth->user('name');
						$data['client_name'] = sprintf("%s %s", $user_info['Customer']['last_name'], $user_info['Customer']['first_name']);
					}
					$mail = new CakeEmail( );
					$mail->config('contactClient');
					$mail->from($data['email']);
					$mail->viewVars($data);
					$sent = $mail->send();
					$this->redirect('/clients/view/'.$cid.'?tab=5&send=ok');
					//$this->deleteToken();
					return;
					//メール送信
				//}

			}
		}

	}



}



