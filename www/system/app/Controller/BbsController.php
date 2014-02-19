<?php
config('common');
//App::uses('Sanitize', 'Utility');
//App::uses('CakeEmail', 'Network/Email');
/**
 * Bbs Controller
 *
 * @property Topic $Topic
 * @property PaginatorComponent $Paginator
 */
class BbsController extends AppController {


	public $uses = array('Topic' , 'Category' , 'User', 'Customer', 'Tag', 'Comment', 'CommentVote');

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
	public $components = array(
		'Paginator',
		'UploadHandler'=>array(
			'upload_dir' => TEMP_UPLOAD_DIR,
			'upload_url' => TEMP_DIR,
			'image_versions' => array(
				'' => array(
                    'max_width' => 800,
                    'max_height' => 800,
                    'jpeg_quality' => 95
                ),
	            'thumb' => array(
	                'max_width' => 70,
	                'max_height' => 70,
	                'jpeg_quality' => 95
	                ),
	            'list' => array(
					'max_width' => 200,
					'max_height' => 200,
					'jpeg_quality' => 98
				)

			)
		)
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->deny('add');
		$this->Auth->deny('view');
		$this->Auth->loginAction = '/users/popup_login';
	}

	public function isAuthorized( $user ) {
		parent::isAuthorized( $user );
		return ( $user['user_type'] == USER_TYPE_CUSTOMER || $user['user_type'] == USER_TYPE_SYSTEM_ADMIN);
	}

///////////////////////////////////////////////////////////////////////////
	// /admin/bbs/index で検索用タグリストを取得するためのajaxメソッド
	public function admin_get_tags($category_id){
		$results = $this->Tag->find('list', array(
			'conditions'=>array('category_id'=>$category_id)
		));

		$this->set(compact('results'));
		$this->viewClass = 'Json';
		$this->set('_serialize', 'results');
	}

///////////////////////////////////////////////////////////////////////////

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		//セッション
		$search_key = 'admin_bbs_search_key';
		if(!empty($this->request->data)){
			$this->Session->write($search_key, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			$this->request->data = $this->Session->read($search_key);
		}else{
			$this->Session->delete($search_key);
		}

		//検索用セレクトoptions
		$categories = $this -> Category -> find('list' , array(
			'fields' => array('Category.category_name'),
			'conditions' => array('Category.contents_type_id' => '7')
		));
		$tags = array();

		//topics
		$fields = array(
			'Topic.id', 'Category.category_name', 'Tag.word', 'Topic.title',
			'User.id', 'User.name', 'Topic.num_comments', 'Topic.modified', 'Topic.created'
		);
		$cond = array('Topic.contents_type_id'=>7);
		if($this->request->isPost()){
			$cat = $this->request->data['Topic']['category_id'];
			if(!empty($cat)){
				$cond['Topic.category_id'] = $cat;
			}
		}
		$order = 'created DESC';
		$limit = 20;

		$d =& $this->request->data['Topic'];
		if(!empty($d)){
			if(!empty($d['id'])) $cond['Topic.id'] = $d['id'];
			if(!empty($d['category_id'])){
				$cond['Topic.category_id'] = $d['category_id'];
				$tags = $this->Tag->find('list', array(
					'conditions'=>array('Tag.category_id'=>$d['category_id'])
				));
				if(!empty($d['tag_id'])) $cond['Topic.tag_id'] = $d['tag_id'];
			}
			if(!empty($d['keyword'])){
				$cond['or'] = array(
					'Topic.title LIKE'=>'%'.$d['keyword'].'%',
					'Topic.body LIKE'=>'%'.$d['keyword'].'%'
				);
			}
		}

		$this->Topic->recursive = 1;
		// $this->User->bindModel(array(
			// 'hasOne'=>array(
				// 'Customer'=>array(
					// 'className'=>'Customer',
					// 'fields'=>array('id', 'file_name'),
				// )
			// )
		// ));
		$this -> paginate = array(
			'fields'=>$fields,
			'conditions'=> $cond,
			'order' => $order,
			'limit' => $limit,
		);
		$topics = $this->Paginator->paginate();
		//pr('topics:');pr($topics);
		$this->set(compact('categories', 'tags', 'topics'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}
		$this->set('topic', $this->Topic->read(null, $id));
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
			$this->Topic->id = $id;
			if (!$this->Topic->exists()) {
				throw new NotFoundException(__('Invalid %s', __('topic')));
			}
			$this->request->data = $this->Topic->read(null, $id);
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
			$this->Topic->create();
			$this->Topic->setBbsTopicValidate();
			$ret = $this->Topic->saveAll($this->request->data, array('validate'=>'only'));
			$this->request->data['Topic']['contents_type_id'] = 7;
			if ( $ret && $this->Topic->saveAll($this->request->data , array('validate'=>false))) {
				$topic_id = !empty($this->request->data['Topic']['id'])
										? $this->request->data['Topic']['id']
										: $this->Topic->getLastInsertID();
				$this->Topic->id = $topic_id;

				if(!empty($this->request->data['deleted1'])){
					if(!empty($this->request->data['Topic']['file_name1'])){
						$this->UploadHandler->delete_file_recursive(
							TOPIC_UPLOAD_DIR,
							$this->request->data['Topic']['file_name1']
						);
						$this->Topic->saveField('file_name1', '');
					}

				}else{
					if(!empty($this->request->data['Topic']['uploaded1'])){
						if(!empty($this->request->data['Topic']['file_name1'])){
							$this->UploadHandler->delete_file_recursive(
								TOPIC_UPLOAD_DIR,
								$this->request->data['Topic']['file_name1']
							);
						}

						$newname = $topic_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['uploaded1'], $newname );
						$this->Topic->saveField('file_name1', $newname);
					}
				}

				if(!empty($this->request->data['deleted2'])){
					if(!empty($this->request->data['Topic']['file_name2'])){
						$this->UploadHandler->delete_file_recursive(
							TOPIC_UPLOAD_DIR,
							$this->request->data['Topic']['file_name2']
						);
						$this->Topic->saveField('file_name2', '');
					}

				}else{
					if(!empty($this->request->data['Topic']['uploaded2'])){
						if(!empty($this->request->data['Topic']['file_name2'])){
							$this->UploadHandler->delete_file_recursive(
								TOPIC_UPLOAD_DIR,
								$this->request->data['Topic']['file_name2']
							);
						}

						$newname = $topic_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['uploaded2'], $newname );
						$this->Topic->saveField('file_name2', $newname);
					}
				}

				$this->Session->setFlash(__('The %s has been saved', __('topic')));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('topic')));
			}
		}

		$categories = $this->Topic->Category->find('list', array(
			'conditions'=>array('contents_type_id'=>7)
		));
		//$users = $this->Topic->User->find('list');
		$prefectures = $this->Topic->Prefecture->find('list');
		$publicity_ranges = array(1=>'地域', 2=>'自治体', 3=>'都道府県', 4=>'全国');

		if($this->isEdit){
			$tags = $this->Tag->find('list', array(
				'conditions'=>array('category_id'=>$this->request->data['Topic']['category_id'])
			));
			$municipals = $this->Topic->Municipal->find('list', array(
				'conditions'=>array('municipal_code like'=>sprintf("%02d", $this->request->data['Topic']['prefecture_id']).'%')
			));
			$areas = $this->Topic->Area->find('list', array(
				'conditions'=>array('prefecture_id'=>$this->request->data['Topic']['prefecture_id']),
				'conditions'=>array('municipal_id'=>$this->request->data['Topic']['municipal_id'])
			));
		}

		$this->set(compact('categories', 'tags', /*'users', */'prefectures', 'municipals', 'areas', 'publicity_ranges'));

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
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}
		if ($this->Topic->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('topic')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('topic')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

///////////////////////////////////////////////////////////////////////////

	/**
	 * index method
	 *
	 * トピック一覧
	 * @return void
	 */
	public function index($catSlug = '', $tag_id = null) {
		$this->layout = 'default';

		if(!empty($this->request->data['search']['cat_slug'])) {
			$catSlug = $this->request->data['search']['cat_slug'];
		}

		//pr('query:');pr($this->request->query);	//formがgetの場合
		//pr('data:');pr($this->request->data);	//formがpostの場合

		$sessionName = 'bbs_index';

		if(!empty($this->request->data)){
			//postされた場合、入力内容をセッションに保存
			$this->Session->write($sessionName, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			//ページ送りした場合、保存されたセッションを、UI部品に反映させるため、$this->request->dataへ代入
			$this->request->data = $this->Session->read($sessionName);
		}else{
			$this->Session->delete($sessionName);
		}

		$this->set('category_list', $this->Category->find('list', array(
			'fields'=>array('slug', 'category_name'),
			'conditions'=>array('contents_type_id'=>'7')
		)));

		$cond = array();

		if(!empty($this->request->data['search']['category_id'])){
			$cond[] = array('Category.slug' => $this->request->data['search']['category_id']);
		}

		//$title_for_layout（例：妊娠・出産一覧）生成
		if(!empty($catSlug)){
			$category = $this->Category->find('first' , array('conditions' =>array('Category.slug'=>$catSlug)));
			$catName = $category['Category']['category_name'];
			$catIcon = $category['Category']['icon_l_url'];
			$title_for_layout = '交流広場 - ' . $catName . '一覧';
			$tags = $this->Tag->find('list', array(
				'conditions'=>array('category_id'=>$category['Category']['id']),
				'order'=>'Tag.word'
			));
		}else{
			$catName = "トピック一覧";
			$catIcon = "/img/market/img11.jpg";
			$title_for_layout = "交流広場 - トピック一覧";
			$tags = $this->Tag->find('list', array(
				'conditions'=>array('category_id'=> array(4,5,6,7,8,9,10)),
				'order'=>'Tag.word'
			));
			$cond[] = array('Topic.contents_type_id'=>'7');
			$this->set('categories', $this->Category->find('all', array(
				'fields'=>array('Category.category_name', 'Category.slug'),
				'conditions'=>array('contents_type_id'=>'7')
			)));
		}

		//pr('tags:');pr($tags);

		//第二引数 $tag_id が渡された場合
		if(!empty($tag_id)){
			$this->request->data['search'] = array('tag_id'=>$tag_id);
		}

		//paginateの要素の初期値
		$fields = array('Topic.created', 'Tag.word', 'Topic.title', 'Topic.num_comments', 'Category.category_name','Category.id');


		$order = array('Topic.created' => 'DESC');
		$limit = 20;

		if(!empty($this->request->data['search'])){
			$d = $this->request->data['search'];
			if(!empty($d['tag_id'])){
				$cond[] = array('Topic.tag_id'=>$d['tag_id']);
			}
			if(!empty($d['keyword'])){
				$cond[] = array('or'=>array(
					'Topic.title LIKE'=>'%'.$d['keyword'].'%',
					'Topic.body LIKE'=>'%'.$d['keyword'].'%',
					'Topic.related_topic LIKE'=>'%'.$d['keyword'].'%',
				));
			}
		}

		//AppController.phpとcommon.phpで設定される地域ID
		//pr('this->currentAreaId:' . $this->currentAreaId);
		if(!empty($this->currentAreaId)){
			$currentAreaId = $this->currentAreaId;
			$this->Area->id = $currentAreaId;

			$currentMunicipalId = $this->Area->field('municipal_id');
			$currentPrefectureId = $this->Area->field('prefecture_id');

			$cond[] = array(
				'or'=>array(
					array(
						'Topic.publicity_range'=>1,//同地域限定
						'Topic.area_id'=>$currentAreaId
					),
					array(
						'Topic.publicity_range'=>2,//同市区町村限定
						'Topic.municipal_id'=>$currentMunicipalId
					),
					array(
						'Topic.publicity_range'=>3,//同都道府県限定
						'Topic.prefecture_id'=>$currentPrefectureId
					),
					array(
						'Topic.publicity_range'=>4,//全国
					),
				)
			);
		}

		$this -> paginate = array(
			'fields'=>$fields,
			'conditions'=> $cond,
			'order' => $order,
			'limit' => $limit,

		);

		$this->setUpTopicBinding();

		$topics = $this->Paginator->paginate();
		//pr('topics:');pr($topics);

		$loggedIn = $this->Auth->loggedIn();
		$is_index = empty($catSlug);
		$this->set(compact('loggedIn', 'catSlug', 'catIcon', 'catName', 'title_for_layout', 'tags', 'topics', 'is_index','category_list'));

		//debug($cond);

	}

	private function setUpTopicBinding(){
		$this->Topic->recursive = 1;

		if(!$this->Auth->loggedIn()) return;

		$user_info = $this->Session->read('user_info');
		//pr('user_info:');pr($user_info);
		if(empty($user_info['Customer']['user_id']) || empty($user_info['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
		$family_id = $user_info['Customer']['family_id'];

		$this->Topic->bindModel(array(
			'hasMany'=>array(
				'FamilyLike'=>array(
					'className' => 'FamilyLike',
					'foreignKey' => 'contents_target_id',
					'dependent' => false,
					'conditions' => array(
						'contents_type_id'=>7,
						'family_id'=>$family_id
					),
					'fields' => 'id',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
				)
			)
		));
	}

	/**
	 * view method
	 *
	 * トピック閲覧、追記、コメント閲覧、削除、返信、投票
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}


		$this->layout = 'default';
		$this->setUpTopicBinding();
		$i = $this->Topic->read(null, $id);

		$customer = $this->Customer->find('first', array(
			'fields'=>array('file_name', 'private_flag'),
			'conditions'=>array('user_id'=>$i['User']['id'])
		));

		//pr('private_flag:');pr($customer['Customer']['private_flag']);
		$photoIcon = DEFAULT_IMG_CUSTOMER_S;//ユーザデフォルト画像
		$private_flag = unserialize($customer['Customer']['private_flag']);//写真を公開しているかどうか
		//pr($private_flag);
		$photoOpen = ($private_flag['pv_file'] == 1);
		if($photoOpen){
			$file_name = $customer['Customer']['file_name'];
			if(!empty($file_name)){
				$photoIcon = '/uploads/customer/thumb/' . $file_name;
			}
		}

		$catName = $i['Category']['category_name'];
		$title_for_layout = '交流広場-' . $catName;
		$catSlug = $i['Category']['slug'];
		$catIcon = $i['Category']['icon_l_url'];
		$loginUserId = $this->Auth->user('id');
		//$postedByLoginUser = ($loginUserId == $i['Topic']['user_id']);

		$d =& $this->request->data;
		if(!empty($d['Topic']['tsuiki'])){
			//追記がポストされたとき
			$i['Topic']['related_topic'] = $i['Topic']['related_topic'] . "\n" . $d['Topic']['tsuiki'];
			$this->Topic->saveField('related_topic', $i['Topic']['related_topic']);
		}else if(!empty($d['Topic']['closed'])){
			//「トピック締切り」ボタン押下時
			$i['Topic']['closed'] = 1;
			$this->Topic->saveField('closed', 1);
		}

		///////////コメント関連処理/////////////////////////////////////////////////
		//CommentComponentをロード
		$cc = $this->Components->load('Comment');
		//コメント関連処理をCommentComponentに委譲
		$cc->manageComment($this, $d, 7, $id, $i, $loginUserId);
		///////////////////////////////////////////////////////////////////////

		$this->set(compact('i', 'photoIcon', 'catName', 'title_for_layout', 'catSlug', 'catIcon'));
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

	/**
	 * add method
	 *
	 * 新規トピック投稿
	 * @return void
	 */
	public function add($catSlug = 'pregnancy') {

		if ($this->request->is('post')) {
			//pr('data:');pr($this->request->data);

			$d = $this->request->data;
			//$d = Sanitize::clean($d);

			$d['Topic']['contents_type_id'] = 7;
			$d['Topic']['user_id'] = $this->Auth->user('id');

			$category = $this->Category->find('first', array(
				'fields'=>'id',
				'conditions'=>array('Category.slug'=>$d['category'])
			));
			$d['Topic']['category_id'] = $category['Category']['id'];

			$customer = $this->Customer->find('first', array(
				'fields'=>array('area_id', 'municipal_id', 'prefecture_id'),
				'conditions'=>array('user_id'=>$d['Topic']['user_id'])
			));
			$d['Topic']['area_id'] = $customer['Customer']['area_id'];
			$d['Topic']['municipal_id'] = $customer['Customer']['municipal_id'];
			$d['Topic']['prefecture_id'] = $customer['Customer']['prefecture_id'];

			if (!empty($d['Topic']['tag_id'])){
				if(strpos($d['Topic']['tag_id'], '__add__') === 0){
					//tag_idが「__add__絵本」といった形なら新規に足されたタグなので、tagsテーブルに登録する。
					$word = substr($d['Topic']['tag_id'], 7);
					$newTag = array(
						'category_id'=>$d['Topic']['category_id'],
						'word'=>$word
					);
					$this->Tag->create();
					if($this->Tag->save($newTag)){
						$d['Topic']['tag_id'] = $this->Tag->id;//saveしたレコードのidはこのように取得できる。
					}
				}
			}

			//pr('d:');pr($d);

			$this->Topic->create();
			if ($this->Topic->save($d)) {

				//画像登録
				$topic_id = $this->Topic->id;
				//画像1
				if(!empty($this->request->data['deleted1'])){
					if(!empty($this->request->data['Topic']['file_name1'])){
						$this->UploadHandler->delete_file_recursive( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['file_name1'] );
						$this->Topic->saveField('file_name1', '');
						unset($this->request->data['Topic']['uploaded1']);
						unset($this->request->data['Topic']['file_name1']);
					}

				}else{
					if(!empty($this->request->data['Topic']['uploaded1'])){
						if(!empty($this->request->data['Topic']['file_name1'])){
							$this->UploadHandler->delete_file_recursive( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['file_name1'] );
						}

						$newname = $topic_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['uploaded1'], $newname );
						$this->Topic->saveField('file_name1', $newname);
						unset($this->request->data['Topic']['uploaded1']);
						$this->request->data['Topic']['file_name1'] = $newname;
					}
				}
				//画像2
				if(!empty($this->request->data['deleted2'])){
					if(!empty($this->request->data['Topic']['file_name2'])){
						$this->UploadHandler->delete_file_recursive( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['file_name2'] );
						$this->Topic->saveField('file_name2', '');
						unset($this->request->data['Topic']['uploaded2']);
						unset($this->request->data['Topic']['file_name2']);
					}

				}else{
					if(!empty($this->request->data['Topic']['uploaded2'])){
						if(!empty($this->request->data['Topic']['file_name2'])){
							$this->UploadHandler->delete_file_recursive( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['file_name2'] );
						}

						$newname = $topic_id . '_' . String::uuid();
						$newname = $this->UploadHandler->move_upload_files( TOPIC_UPLOAD_DIR, $this->request->data['Topic']['uploaded2'], $newname );
						$this->Topic->saveField('file_name2', $newname);
						unset($this->request->data['Topic']['uploaded2']);
						$this->request->data['Topic']['file_name2'] = $newname;
					}
				}
				$this->cleanup_tmp();

				// $this->Session->setFlash(
					// __('The %s has been saved', __('topic')),
					// 'alert',
					// array(
						// 'plugin' => 'TwitterBootstrap',
						// 'class' => 'alert-success'
					// )
				// );
				$this->redirect('/bbs/index/'.$catSlug);
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('topic')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}

		$this->layout = 'default';

		$sessionName = 'bbs_add';

		if(!empty($this->request->data)){
			//postされた場合、入力内容をセッションに保存
			$this->Session->write($sessionName, $this->request->data);
		}else if(!empty($this->request->params['named'])){
			//ページ送りした場合、保存されたセッションを、UI部品に反映させるため、$this->request->dataへ代入
			$this->request->data = $this->Session->read($sessionName);
		}else{
			$this->Session->delete($sessionName);
		}

		$category = $this->Topic->Category->find('first', array('conditions' =>array('Category.slug'=>$catSlug)));
		$catName = $category['Category']['category_name'];
		$catIcon = $category['Category']['icon_l_url'];
		$title_for_layout = '交流広場-' . $catName;

		$categories = $this->Category->find('all', array(
			'fields'=>array('Category.category_name', 'Category.slug'),
			'conditions'=>array('contents_type_id'=>'7')
		));
		// //キーをslug、値をcategory_nameとする連想配列に変換。
		// $categories = Set::combine($categories, '{n}.Category.slug', '{n}.Category.category_name');
		//pr('categories:');pr($categories);

		//「タグ」セレクトの選択肢
		$tags = $this->Tag->find('list', array(
			'conditions'=>array('category_id'=>$category['Category']['id']),
			'order'=>'Tag.word'
		));
		//pr('tags:');pr($tags);

		$this->set(compact('catSlug', 'catName', 'catIcon', 'title_for_layout', 'categories', 'tags'));
	}
}
