<?php
class RssFetchShell extends AppShell
{
	public $uses = array('Topic' , 'Source');

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


	public function startup() {
		parent::startup();
		$this->sources_all = $this -> Source -> find('all');
	}

	public function get_rss($site_array = null) {
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

	public function main() {
		$this->get_rss($this->sources_all);
	}
}
?>
