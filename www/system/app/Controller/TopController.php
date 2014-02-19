<?php
	App::uses('AppController', 'Controller');
	App::import('Utility', 'Sanitize');

	class TopController extends AppController {

		/**
		 * Components
		 *
		 * @var array
		 */
		public $uses = array(
			'Top',
			'Topic',
			'User',
			'Client',
			'Prefecture',
			'Category',
			'Comment',
			'ContentsType',
			'UpdateInfo'
		);
		//	public $components = array('Paginator');

    public $components = array('Paginator');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'modifiked' => 'desc'
        )
    );

		/**
		 * index method
		 *
		 * @return void
		 */
		public function index( ) {
			// $sub_domain = str_replace('.miniku.example.com', '', env('SERVER_NAME'));
			// pr($sub_domain);



			/**  上段　最近のイベント **/
			$conditions = array('Topic.category_id' => 3, 'Topic.closed'=>0);

			if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'Topic.publicity_range'=>1,//同地域限定
								'Topic.area_id'=>$this->currentAreaId
							),
							array(
								'Topic.publicity_range'=>2,//同市区町村限定
								'Topic.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Topic.publicity_range'=>3,//同都道府県限定
								'Topic.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'Topic.publicity_range'=>4,//全国
							)
					));
			}else{
				$conditions[] = array(
					'or'=>array(
							array(
								'Topic.publicity_range'=>1,//同地域限定
								//'Topic.area_id'=>$this->currentAreaId
							),
							array(
								'Topic.publicity_range'=>2,//同市区町村限定
								//'Topic.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Topic.publicity_range'=>3,//同都道府県限定
								//'Topic.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								//'Topic.publicity_range'=>4,//全国
							)
					));
			}
			$this->set('recent_events', $this->Topic->find('all',array(
				'fields' => array('Topic.*'),
				'conditions' => $conditions,
				'limit' => TOP_RECENT_LIST_COUNT,
				'order' => 'Topic.modified desc',
				'contain' => array()
			)));


			/** 上段　最近の投稿（交流広場） **/
			$conditions = array('Comment.contents_type_id' => 7, 'delete_flag'=>0, 'Topic.closed'=>0);
			if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'Topic.publicity_range'=>1,//同地域限定
								'Topic.area_id'=>$this->currentAreaId
							),
							array(
								'Topic.publicity_range'=>2,//同市区町村限定
								'Topic.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Topic.publicity_range'=>3,//同都道府県限定
								'Topic.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'Topic.publicity_range'=>4,//全国
							)
					));
			}
			$this->set('recent_bbs_comments', $this->Comment->find('all',array(
				'fields' => array('Comment.*','Topic.title'),
				'conditions' => $conditions,
				'joins'=>array(
					array(
						'table'=>'topics',
						'alias' => 'Topic',
						'conditions'=>'Topic.id=Comment.contents_target_id',
						'fields' => 'Topic.title'
					)
				),
				'contain'=>array(),
				'limit' => TOP_RECENT_LIST_COUNT,
				'order' => 'Comment.modified desc'
			)));


			/**  上段　最近のコメント（施設情報） **/
			$clientsConditions = 'Client.id = Comment.contents_target_id';
			$conditions = array('Comment.contents_type_id >=' => 1,'Comment.contents_type_id <='=> 5 , 'delete_flag'=>0, 'Client.status'=>1);
			if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'Client.publicity_range'=>1,//同地域限定
								'Client.area_id'=>$this->currentAreaId
							),
							array(
								'Client.publicity_range'=>2,//同市区町村限定
								'Client.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Client.publicity_range'=>3,//同都道府県限定
								'Client.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'Client.publicity_range'=>4,//全国
							)
					));
			}
			$this->set('recent_client_comments', $this->Comment->find('all',array(
				'fields' => array('Comment.*'),
				'conditions' => $conditions,
				'joins'=>array(
					array(
						'table'=>'clients',
						'alias' => 'Client',
						'conditions'=>$clientsConditions,
						'fields' => 'Client.name'
					),
					// array(
						// 'table' => 'areas',
						// 'alias' => 'Area',
						// 'conditions' => 'Area.id = Client.area_id',
						// 'fields' => 'Area.slug'
					// )
				),
				'contain' => array(),
				'limit' => TOP_RECENT_LIST_COUNT,
				'order' => 'Comment.modified desc'
			)));

			/** 中段　育児情報 **/
			$conditions = array(
				'conditions' => array(
					'or' => array(
							array(
								'Topic.contents_type_id' => 6,
								'Topic.category_id' => 1,//育児情報
							),
							array(
								'Topic.contents_type_id' => 6,
								'Topic.category_id' => 2,//告知
								'Topic.municipal_id' => $this->currentMunicipalId
							),
							array(
								'Topic.contents_type_id' => 6,
								'Topic.category_id' => 3,//地域イベント
								'Topic.municipal_id' => $this->currentMunicipalId
							)
						)
					),
				'limit' => TOP_COLUM_LIST_COUNT,
				'order' => array('Topic.pub_date' => 'DESC'),
				'contain'=>array('Category'=>array('category_name','id'),'Source'=>array('name', 'url'))
			);

if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'Topic.publicity_range'=>1,//同地域限定
								'Topic.area_id'=>$this->currentAreaId
							),
							array(
								'Topic.publicity_range'=>2,//同市区町村限定
								'Topic.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Topic.publicity_range'=>3,//同都道府県限定
								'Topic.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'Topic.publicity_range'=>4,//全国
							)
					));
			}


			$this->set('topics', $this->Topic->find('all', $conditions));

			/** 中段　交流広場 **/
			$conditions = array('Topic.contents_type_id' =>7/*, 'Topic.closed'=>0*/);
			if(!empty($this->currentAreaId)) {
				$conditions[] = array(
					'or'=>array(
							array(
								'Topic.publicity_range'=>1,//同地域限定
								'Topic.area_id'=>$this->currentAreaId
							),
							array(
								'Topic.publicity_range'=>2,//同市区町村限定
								'Topic.municipal_id'=>$this->currentMunicipalId
							),
							array(
								'Topic.publicity_range'=>3,//同都道府県限定
								'Topic.prefecture_id'=>$this->currentPrefectureId
							),
							array(
								'Topic.publicity_range'=>4,//全国
							)
					));
			}

			$this->set('recent_bbs', $this->Topic->find('all', array(
				'conditions' => $conditions,
				'contain' => array('Category'=>array('category_name')),
				'limit' => TOP_COLUM_LIST_COUNT,
				'order' => 'Topic.created desc'

			)));
			/** 下段　更新情報 **/

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
			$this->set('update_infos', $this->UpdateInfo->find('all',array(
				'conditions'=> $conditions,
				'order' => 'update_date desc',
				'limit' => 5,
				'contaion'=>array(),
				'fields'=>'update_date,title,url'
			)));

			$this->set('title_for_layout', 'トップページ');
		}

		public function admin_index( ) {

		}

		public function mypage_index( ) {
			$user_id = $this->Auth->user('id');
			$customer = $this->Customer->find('first', array('conditions'=>array('user_id'=>$user_id)));
			if(!empty($customer['Customer']['zip'])){
				$customer['Customer']['zip1'] = substr($customer['Customer']['zip'], 0,3);
				$customer['Customer']['zip2'] = substr($customer['Customer']['zip'], 3,4 );
			}
			$this->set('customer', $customer);

			$categories = $this->Category->find('list', array('fields'=>array('id', 'category_name'),
				'conditions'=>array('id >='=> 4, 'id <='=>10)));
			$tmp = array();
			foreach($categories as $key=>$val){
				$tmp['ca_'.$key] = $val;
			}
			$contents_types = $this->ContentsType->find('list', array('fields'=>array('id', 'name'),
				'conditions'=>array('id >='=> 1, 'id <='=>5))
			);
			foreach($contents_types as $key=>$val){
				$tmp['co_'. $key] = $val;
			}

			$this->set('categories', $tmp);

			$this->set('title_for_layout', sprintf("%sさんのマイページ", $this->Auth->user('name')));

			$self_customer_id = $customer['Customer']['id'];
			$self_family_id = $customer['Customer']['family_id'];
			$partners = $this->Customer->find('all', array(
					'conditions'=>array('Customer.status'=>'1',  'Customer.id <>'=>$self_customer_id, 'family_id'=>$self_family_id),
					'contain' => array('User')
			));
			$this->set('partners', $partners);

			$this->loadModel('Child');
			$children = $this->Child->find('all', array(
					'conditions'=>array('family_id'=>$self_family_id, 'Child.status'=>'1'),
					'contain'=>array('Client')
			));
			$this->set('children', $children);

		}

		public function owner_index(){

			$this->User->contain(array('Client'=>array('ClientType', 'Prefecture')));
			$data = $this->User->read(null, $this->Auth->user('id'));
			if($this->request->is('post') || $this->request->is('post')){
				$this->User->set($this->request->data);
				if($this->User->validates()){
					if(!empty($this->request->data['User']['new_password'])){
						$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['new_password']);
					}
					$this->User->save($this->request->data, false);
					$this->set('saved', 1);
					unset($this->request->data['User']['new_password']);
					unset($this->request->data['User']['new_password2']);
					$this->Session->write('user_info', $this->User->read(null, $this->Auth->user('id')));
				}

			}

			$this->request->data = array_merge($data, $this->request->data);


		}

		public function search(){

			$limit = 10;
			$count = 0;

			$page = (isset($this->request->params['named']['page']))?$this->request->params['named']['page']:1;

			$this->request->data = $this->request->query;
			$this->request->query = Sanitize::clean($this->request->query, array('encode' => false));
			$keyword = (isset($this->request->data['keyword']))?$this->request->data['keyword']:'';
			$keyword2 = (isset($this->request->data['keyword2']))?$this->request->data['keyword2']:'';
			if($keyword){
				$sql1 = "
(
SELECT  `contents_type_id` ,  `id` ,  `modified` ,  `name` ,  `address` ,  `zip` ,  `tel` ,  `url`
FROM  `clients`
WHERE  `name` LIKE  '%%$keyword%%'
OR  `address` LIKE  '%%$keyword%%'
)
UNION (

SELECT  `contents_type_id` ,  `id` ,  `pub_date` ,  `title` ,  `body` ,  `title` ,  `title` ,  `source_url`
FROM  `topics`
WHERE  `contents_type_id` =  '6'
AND  `title` LIKE  '%%$keyword%%'
OR  `body` LIKE  '%%$keyword%%'
)
UNION (

SELECT  `contents_type_id` ,  `id` ,  `modified` ,  `title` ,  `body` ,  `title` ,  `title` ,  `source_url`
FROM  `topics`
WHERE  `contents_type_id` =  '7'
AND  `title` LIKE  '%%$keyword%%'
OR  `body` LIKE  '%%$keyword%%'
)
ORDER BY  `modified` DESC

					";

					if($keyword2){//絞り込み

						$sql1 = "
(
SELECT  `contents_type_id` ,  `id` ,  `modified` ,  `name` ,  `address` ,  `zip` ,  `tel` ,  `url`
FROM  `clients`
WHERE
 (`name` LIKE  '%%$keyword%%'
OR  `address` LIKE  '%%$keyword%%') AND
(`name` LIKE  '%%$keyword2%%'
OR  `address` LIKE  '%%$keyword2%%')
)
UNION (

SELECT  `contents_type_id` ,  `id` ,  `pub_date` ,  `title` ,  `body` ,  `title` ,  `title` ,  `source_url`
FROM  `topics`
WHERE
 `contents_type_id` =  '6'
AND
(`title` LIKE  '%%$keyword%%'
OR  `body` LIKE  '%%$keyword%%') AND
(`title` LIKE  '%%$keyword2%%'
OR  `body` LIKE  '%%$keyword2%%')

)
UNION (

SELECT  `contents_type_id` ,  `id` ,  `modified` ,  `title` ,  `body` ,  `title` ,  `title` ,  `source_url`
FROM  `topics`
WHERE  `contents_type_id` =  '7'
AND
(`title` LIKE  '%%$keyword%%'
OR  `body` LIKE  '%%$keyword%%'
) AND
(`title` LIKE  '%%$keyword2%%'
OR  `body` LIKE  '%%$keyword2%%'
)
)
ORDER BY  `modified` DESC

					";

					}


					$this->paginate = $sql1;

					$res1 = $this->Top->paginate(null ,null ,null ,$limit , $page,null,$sql1);

					$count = $this->Top->paginateCount(null , null ,$sql1);

					$this->set('count' , $count);

				$results = $res1;

			if(count($results)>0){
				$this->set('results' , $results);
			}

			}

			$this->set('count' , $count);
			$this->set('limit' , $limit);
			$this->set('keyword' , $keyword);
			$this->set('keyword2' , $keyword2);
			$this->render('search');
		}

	}
