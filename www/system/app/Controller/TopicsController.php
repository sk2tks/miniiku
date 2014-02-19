<?php
App::uses('AppController', 'Controller');
/**
 * Topics Controller
 *
 * @property Topic $Topic
 * @property PaginatorComponent $Paginator
 */
class TopicsController extends AppController {


public $uses = array('Topic' , 'Source' , 'Category' , 'FamilyClip');
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

	public $sources = '';
	public $cats = '';

public function beforeFilter() {
    parent::beforeFilter();

    $this->Category->bindModel(array(
    'hasMany' => array('Topic'),
		));

    $this->cats = $this -> Category -> find('list' , array('fields' => array('Category.category_name'),'conditions' => array('Category.contents_type_id' => '6')));
    $this -> set ('categories' , $this->cats);

    $this->sources = $this -> Source -> find('list' , array('fields' => array('Source.name', 'Source.url')));
    $this -> set ('sources' , $this->sources);

    $this->sources_all = $this -> Source -> find('all');
    $this -> set ('sources_all' , $this->sources_all);

    $this->categories = $this -> Category -> find('list' , array('fields' => array('Category.slug')));
    $this -> set ('categories' , $this->categories);

  }


/**
 * index method
 *
 * @return void
 */
	public function index($type=null) {
			$categoryName = $this->Topic->Category->find('all' , array('conditions' =>array('Category.slug'=>$type)));

			$this->layout = 'default';

		//地域別のソースだけを送る
		if(($type == 'local_news') || ($type == 'event')){
			if($this->currentMunicipalId){//地域版の場合、該当のmunicipalのみ
	    	$this->sources = $this -> Source -> find('list' , array('fields' => array('Source.name', 'Source.url') , 'conditions' => array('Source.municipal_id' => $this->currentMunicipalId)));
	    	}else{//全国版の時は全部
	    		$this->sources = $this -> Source -> find('list' , array('fields' => array('Source.name', 'Source.url')));
	    	}
	    	$this -> set ('sources' , $this->sources);
	  	}else{//全国的なソースを送る
	     	$this->sources = $this -> Source -> find('list' , array('fields' => array('Source.name', 'Source.url') , 'conditions' => array('Source.municipal_id' => 0)));
	    	$this -> set ('sources' , $this->sources);
	  	}
		$this->title_for_layout = '育児情報一覧';
		if(!empty($categoryName)){
			$this -> title_for_layout = $categoryName[0]['Category']['category_name'].'一覧';
		}


		$limit = 20;

		$cond = array('OR' => array(
				'Topic.contents_type_id' => 1,
				'Topic.contents_type_id' => 2,
				'Topic.contents_type_id' => 3
			)
		);

		$this -> request->data['search'] = $this -> request -> query;

		if(!empty($type)){
			//type
			$cond[] = array(
				'Category.slug' => $type
				);
			//地域絞り込み
			if($this->currentMunicipalId){
				if(($type == 'local_news')||($type == 'event')){
							$cond[] = array(
								'Topic.municipal_id' => $this->currentMunicipalId
							);
				}
			}

		}else{//typeなし
			$cond[] = array(
				'or' => array(
					//育児
						array(
							'Topic.category_id' => 1
							),
					//告知
						array(
							'Topic.category_id' => 2,
							'Topic.municipal_id' => $this->currentMunicipalId
							),
					//イベント
						array(
							'Topic.category_id' => 3,
							'Topic.municipal_id' => $this->currentMunicipalId
							)
					)
				);

		}


		if(isset($this -> request -> query['keyword']) && ($this -> request -> query['keyword'] != '')){
			//キーワードがある場合
			$keyword = $this -> request -> query['keyword'];
			$cond[] = array('Topic.title LIKE' => '%%'.$keyword.'%%');
			$this -> request->data['search']['source_id'] = '';
		}else{
				//キーワードが無い場合
			if(isset($this -> request -> query['source_id']) && ($this -> request -> query['source_id'] != '')){
				$source_id = $this -> request -> query['source_id'];
				$cond[] = array('Topic.source_id' => $source_id);
		}

		}

		$this -> paginate = array(
			'limit' => 			$limit,
			'order' => array('Topic.pub_date' => 'DESC'),
			'conditions'=>	$cond
			);

		$this->setUpTopicBinding();

		$contentsTypes = $this->Topic->ContentsType->find('list');
		$this->Topic->recursive = 1;
		$this->set('title_for_layout', $this -> title_for_layout);
		$this->set('contentsTypes', $contentsTypes);
		$this->set('topics', $this->Paginator->paginate());
		$this->set('type', $type);
	}


	private function setUpTopicBinding(){
		//$this->Topic->recursive = 1;

		if(!$this->Auth->loggedIn()) return;

		$user_info = $this->Session->read('user_info');
		//pr('user_info:');pr($user_info);
		if(empty($user_info['Customer']['user_id']) || empty($user_info['Customer']['family_id'])) throw new Exception("ログイン情報が正しくありません");
		$family_id = $user_info['Customer']['family_id'];

		$this->Topic->bindModel(array(
			'hasMany'=>array(
				'FamilyClip'=>array(
					'className' => 'FamilyClip',
					'foreignKey' => 'contents_target_id',
					'dependent' => false,
					'conditions' => array(
						'contents_type_id'=>6,
						'family_id'=>$family_id
					),
					'fields' => '',
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
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Topic->create();
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('topic')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
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
		$contentsTypes = $this->Topic->ContentsType->find('list');
		//$categories = $this->Topic->Category->find('list');
		$users = $this->Topic->User->find('list');
		$areas = $this->Topic->Area->find('list');
		$municipals = $this->Topic->Municipal->find('list');
		$prefectures = $this->Topic->Prefecture->find('list');
		$this->set(compact('contentsTypes','users', 'areas', 'municipals', 'prefectures'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('topic')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
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
		} else {
			$this->request->data = $this->Topic->read(null, $id);
		}
		$contentsTypes = $this->Topic->ContentsType->find('list');
		$categories = $this->Topic->Category->find('list');
		$users = $this->Topic->User->find('list');
		$areas = $this->Topic->Area->find('list');
		$municipals = $this->Topic->Municipal->find('list');
		$prefectures = $this->Topic->Prefecture->find('list');
		$this->set(compact('contentsTypes', 'users', 'areas', 'municipals', 'prefectures'));
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
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
//$type_id = $this -> request ->params['named']['typeId'];
		if($this->request->isPost()){
			$cat = $this->request->data['Topic']['category_id'];
			if($cat)$this -> paginate = array('conditions'=>array('Topic.category_id' => $cat));
		}

		$this->Topic->recursive = 0;
		$contentsTypes = $this->Topic->ContentsType->find('list');
		$this->set('contentsTypes', $contentsTypes);
		$this->set('topics', $this->Paginator->paginate());
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

/*
記事の重複チェク
*/
public function topic_exist($title){
	$res = $this->Topic->find('list' , array('conditions' => array('Topic.title' => $title)));
	if(count($res)>0){
		return true;
	}else{
		return false;
	}
}

public function admin_test(){
	 require_once 'magpierss/rss_fetch.inc';
 $url = 'http://mamapicks.jp/index.rdf';
 $rss = fetch_rss($url);
 $title = $rss->channel['title'];
 $title = mb_convert_encoding($title, "UTF-8", "auto");
 echo "<h2>$title</h2>\n";
 echo "<ul>\n";
  	debug($rss);
 foreach ($rss->items as $item ) {

 $title = $item['title'];
 $title = mb_convert_encoding($title, "UTF-8", "auto");
 $url   = $item['link'];
 echo "<li><a href=\"$url\">$title</a></li>\n";
 }
 echo "</ul>\n";
}

public function getPage($url, $timeout=25, $header=null){
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt ($curl, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
	curl_setopt ($curl, CURLOPT_HEADER, (int)$header);
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
	$html = curl_exec ($curl);
	curl_close ($curl);
	return $html;
}

/*

*/
public function get_rss($site_array = null){
			// $file = file_get_contents('http://mamapicks.jp/index.rdf');
			// $type = 'rdf';
	 require_once 'magpierss/rss_fetch.inc';
//$rss = fetch_rss('http://mamapicks.jp/index.rdf');//magpie用
//debug($rss);
$mes = "";
foreach ($site_array as $site) {
//HTTPコンテキストオプションを設定
			// $context = stream_context_create();
			// stream_context_set_option($context, 'http', 'ignore_errors', true);
			//$file = file_get_contents($site['Source']['rss_url']);
			$rss_url = trim($site['Source']['rss_url']);

			 if($site['Source']['type'] == 'rdf'){
			 $rss = fetch_rss($rss_url);//magpie用
			}else{
				$file = $this->getPage($site['Source']['rss_url']);
			}
			$type = $site['Source']['type'];

echo 'processing-'.$site['Source']['rss_url'].'::'.$site['Source']['type'].'<br>';

					if($file){
						switch ($type) {
							case 'rss':

											$xml = simplexml_load_string($file);
										if($xml){
											//debug($xml);
												@$feed_title = $site['Source']['rss_name'];
												@$feed_link = $site['Source']['rss_url'];
												@$m_id = $site ['Source']['municipal_id'];
												$sid = $site['Source']['id'];

												//@$feed_description = (array)($xml -> channel -> description);
												$item_count = count($xml -> channel -> item);
												$data = array();

												for($i = 0 ; $i<$item_count ; $i++){

													$item = get_object_vars($xml -> channel -> item[$i]);
													$data[$i]['Topic']['title'] = $item['title'];
													$data[$i]['Topic']['source_id'] = $sid;
													$data[$i]['Topic']['source_url'] = $item['link'];
													$data[$i]['Topic']['pub_date'] = date("Y-m-d H:i:s", strtotime($item['pubDate']));
													$data[$i]['Topic']['municipal_id'] = $m_id;//冗長だが他の種類のTopicsと合わせるため
													$data[$i]['Topic']['contents_type_id'] = '6';//冗長だかカテゴリ無しの事も考慮
													if($m_id){//municipal_idが有る場合は公開範囲は市区町村
														$data[$i]['Topic']['publicity_range'] = '2';
														$data[$i]['Topic']['category_id'] = 2;
														}else{
															$data[$i]['Topic']['publicity_range'] = '4';
															$data[$i]['Topic']['category_id'] = 1;
													}

													//重複チェック後DBに保存
													if(!$this->topic_exist($item['title'])){
														$this->Topic->create();
														$this->Topic->save($data[$i]);
													}
												}


										}else{
											$mes = 'no xml';
										}

								break;

							case 'rdf':

										// 	$xml = simplexml_load_string($file);
										// if($xml){
										// 	$channel = (array)($xml -> channel);
										// 		@$feed_title = $site['Source']['rss_name'];
										// 		@$feed_link = $site['Source']['rss_url'];
										// 		@$m_id = $site ['Source']['municipal_id'];
										// 		@$cate = $site['Source']['category_id'];
										// 		$sid = $site['Source']['id'];
										// 		//@$feed_description = $channel['description'];
										// 		//$items = (array)$xml -> channel->items;
										// 		$items = (array)($xml);
										// 	debug($items);
										// 		$item_count = count((array)$items['item']);
										// 		$data = array();
										// 										//var_dump( get_object_vars($xml -> channel -> item[1]));
										// 		for($i = 0 ; $i<$item_count ; $i++){
										// 			$item = (array)$items['item'][$i];

										// 			$data[$i]['Topic']['title'] = $item['title'];
										// 			$data[$i]['Topic']['source_url'] = $item['link'];
										// 			$data[$i]['Topic']['source_id'] = $sid;
										// 			$data[$i]['Topic']['category_id'] = 1;
										// 			$data[$i]['Topic']['pub_date'] = strtotime($item['pubDate']);
										// 			$data[$i]['Topic']['municipal_id'] = $m_id;//冗長だが他の種類のTopicsと合わせるため
										// 			$data[$i]['Topic']['contents_type_id'] = '6';
										// 			if($m_id){//municipal_idが有る場合は公開範囲は市区町村
										// 				$data[$i]['Topic']['publicity_range'] = '2';
										// 				}else{
										// 					$data[$i]['Topic']['publicity_range'] = '4';
										// 			}

										//$xml = simplexml_load_string($file);

										if($rss){


											//$channel = (array)($xml -> channel);
												@$feed_title = $site['Source']['rss_name'];
												@$feed_link = $site['Source']['rss_url'];
												@$m_id = $site ['Source']['municipal_id'];
												@$cate = $site['Source']['category_id'];
												$sid = $site['Source']['id'];
												//@$feed_description = $channel['description'];
												//$items = (array)$xml -> channel->items;
												$items = $rss -> items;

												$item_count = count($rss -> items);
												$data = array();
																				//var_dump( get_object_vars($xml -> channel -> item[1]));
												foreach($items as $item){

													$data[$i]['Topic']['title'] = $item['title'];
													$data[$i]['Topic']['source_url'] = $item['link'];
													$data[$i]['Topic']['source_id'] = $sid;
													$data[$i]['Topic']['pub_date'] = date("Y-m-d H:i:s", strtotime($item['dc']['date']));
													$data[$i]['Topic']['municipal_id'] = $m_id;//冗長だが他の種類のTopicsと合わせるため
													$data[$i]['Topic']['contents_type_id'] = '6';
													if($m_id){//municipal_idが有る場合は公開範囲は市区町村
														$data[$i]['Topic']['publicity_range'] = '2';
														$data[$i]['Topic']['category_id'] = 2;
														}else{
															$data[$i]['Topic']['publicity_range'] = '4';
															$data[$i]['Topic']['category_id'] = 1;
													}

													//重複チェック後DBに保存
													if(!$this->topic_exist($item['title'])){
														$this->Topic->create();
														$this->Topic->save($data[$i]);
													}
												}


										}else{
											$mes = 'no xml';
										}

								break;

								case 'atom':

										$xml = simplexml_load_string($file);
										//debug($xml);
										if($xml){
											$channel = (array)($xml -> channel);
												@$feed_title = $site['Source']['rss_name'];
												@$feed_link = $site['Source']['rss_url'];
												@$m_id = $site ['Source']['municipal_id'];

												$sid = $site['Source']['id'];
												//@$feed_description = $channel['description'];


												$data = array();
												$i = 0;
										while (isset($xml->entry[$i])) {
											//debug($xml->entry[$i]);
											//var_dump((string)$xml->entry[$i]->link->attributes()->href);
													$item = (array)$xml->entry[$i];
													$data[$i]['Topic']['title'] = $item['title'];
													$data[$i]['Topic']['source_url'] = (string)$xml->entry[$i]->link->attributes()->href;
													$data[$i]['Topic']['source_id'] = $sid;
													$data[$i]['Topic']['pub_date'] = date("Y-m-d H:i:s", strtotime((string)$xml->entry[$i]->published));
													$data[$i]['Topic']['municipal_id'] = $m_id;//冗長だが他の種類のTopicsと合わせるため
													$data[$i]['Topic']['contents_type_id'] = '6';
													if($m_id){//municipal_idが有る場合は公開範囲は市区町村
														$data[$i]['Topic']['publicity_range'] = '2';
														$data[$i]['Topic']['category_id'] = 2;
														}else{
															$data[$i]['Topic']['publicity_range'] = '4';
															$data[$i]['Topic']['category_id'] = 1;
													}

													//重複チェック後DBに保存
													if(!$this->topic_exist($item['title'])){
														$this->Topic->create();
														$this->Topic->save($data[$i]);
													}


													$i++;
												}





										}else{
											$mes = 'no xml';
										}

								break;

							default:

								break;
						}

					}else{
						$mes = 'no file';
					}
					//if($mes)$this->Session->setFlash($mes);

				}//end foreach

				return $mes;
}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_fetch($mode = null) {

			if(isset($mode) && ($mode == 'kick')){//フェッチ処理(手動)

					$this->get_rss($this->sources_all);

			}else if(isset($mode) && ($mode == 'kick_auto')){//フェッチ処理(自動)
					$this->auto_layout = false;
					$this->auto_render = false;
					$this->get_rss($this->sources_all);

			}



	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Topic->create();
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('topic')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
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
		$contentsTypes = $this->Topic->ContentsType->find('list');
		$categories = $this->Topic->Category->find('list');
		$users = $this->Topic->User->find('list');
		$areas = $this->Topic->Area->find('list');
		$municipals = $this->Topic->Municipal->find('list');
		$prefectures = $this->Topic->Prefecture->find('list');
		$this->set(compact('contentsTypes', 'categories', 'users', 'areas', 'municipals', 'prefectures'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid %s', __('topic')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('topic')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
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
		} else {
			$this->request->data = $this->Topic->read(null, $id);
		}
		$contentsTypes = $this->Topic->ContentsType->find('list');
		$categories = $this->Topic->Category->find('list');
		$users = $this->Topic->User->find('list');
		$areas = $this->Topic->Area->find('list');
		$municipals = $this->Topic->Municipal->find('list');
		$prefectures = $this->Topic->Prefecture->find('list');
		$sources = $this->Topic->Source->find('list');
		$this->set(compact('contentsTypes', 'categories', 'users', 'areas', 'municipals', 'prefectures', 'sources'));
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

	public function fetch($mode = null){

		$this->autoRender = false;
		$this->layout = null;
		$err = $this->get_rss($this->sources_all);
	}

}
