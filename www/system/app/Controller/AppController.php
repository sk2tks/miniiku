<?php
	/**
	 * Application level Controller
	 *
	 * This file is application-wide controller file. You can put all
	 * application-wide controller-related methods here.
	 *
	 * PHP 5
	 *
	 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
	 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
	 *
	 * Licensed under The MIT License
	 * For full copyright and license information, please see the LICENSE.txt
	 * Redistributions of files must retain the above copyright notice.
	 *
	 * @copyright     Copyright (c) Cake Software Foundation, Inc.
	 * (http://cakefoundation.org)
	 * @link          http://cakephp.org CakePHP(tm) Project
	 * @package       app.Controller
	 * @since         CakePHP(tm) v 0.2.9
	 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
	 */
	App::uses('Controller', 'Controller');
	config('MasterOption');
	config('common');
	/**
	 * Application Controller
	 *
	 * Add your application-wide methods in the class below, your controllers
	 * will inherit them.
	 *
	 * @package		app.Controller
	 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
	 */
	class AppController extends Controller {
		public $components = array(
			'Paginator',
			'Session',
			'Auth' => array(
				'loginError' => "ログインに失敗しました。",
				'authError' => 'ログインをして下さい',
				'authorize' => array('Controller'),
				'authenticate' => array('Form' => array('fields' => array('username' => 'email'), 'scope'=>array('User.status'=>'1')))
			),
			'Facebook.Connect' => array('model' => 'User'),
			'AutoLogin'
		);
		public $uses = array('Area','Comment','Customer','User','AutoLogin');
		public $currentAreaId = null;
		
		
		public function beforeFilter( ) {
			
			
			if ( !empty($this->request->params['admin']) ) {
				$this->helpers['Html'] = array('className' => 'TwitterBootstrap.BootstrapHtml');
				$this->helpers['Form'] = array('className' => 'TwitterBootstrap.BootstrapForm');
				$this->helpers['Paginator'] = array('className' => 'TwitterBootstrap.BootstrapPaginator');
				$this->layout = 'bootstrap';
				$this->setAdminTitle();
				$this->Auth->loginAction = '/admin/users/login';
				$this->Auth->loginRedirect = '/admin/';
				$this->Auth->deny();
			} else {
				
				$this->setArea();
				$this->setUserInfo($this->Auth->user());
				if ( $this->is_smartphone() ) {
					$this->theme = 'SmartPhone';
				}
				
				if ( !empty($this->request->params['mypage']) ) {
					if(!empty($this->mydomain) && ($this->currentAreaSlug != $this->mydomain) ){
						$this->redirect('http://' . $this->mydomain . '.' . Configure::read('domain')  . $_SERVER['REQUEST_URI']);
					}
					$this->Auth->authenticate['Form']['contain'] = array('Customer');
					$this->Auth->loginAction = '/users/popup_login';
					$this->Auth->loginRedirect = '/mypage/top/';
					$this->Auth->deny();
					$is_mypage = true;
					
				} else if ( !empty($this->request->params['owner']) ) {
					$this->Auth->authenticate['Form']['contain'] = array('Client');
					$this->Auth->loginAction = '/users/popup_login';
					$this->Auth->loginRedirect = '/owner/';

					$this->Auth->deny();
					//$this->Auth->allow();
				} else {
					$this->Auth->allow();
				}

				
				
			}
			
			
			
			
		}

		public function beforeRender(){
			parent::beforeRender();
			if ( !empty($this->request->params['admin']) ) {
			}else{
				$this->setUserInfo($this->Auth->user());
				$this->setToken();
			}
			
		}

		public function setAdminTitle( ) {
			$this->set('title_for_layout', __($this->name) . '管理');
		}

		public function checkToken( ) {
			return isset($this->request->data['token']) && $this->request->data['token'] == $this->Session->read('token');
		}

		public function setToken( ) {
			if ( !$this->Session->read('token') ) {
				$uid = sha1(uniqid(rand(), true));
				$this->Session->write('token', $uid);
			}
		}

		public function deleteToken( ) {
			$this->Session->delete('token');
		}

		public function cleanup_tmp( $dir = TEMP_UPLOAD_DIR ) {
			if ( !file_exists($dir) ) {
				return;
			}
			$dhandle = opendir($dir);
			$rm_time = time() - 60 * 60 * 24 * 1;
			if ( $dhandle ) {
				while( false !== ($fname = readdir($dhandle)) ) {
					$path = "{$dir}/{$fname}";
					if ( is_dir($path) ) {
						if ( ($fname != '.') && ($fname != '..') ) {
							$this->cleanup_tmp($path);
						}
					} else {

						if ( is_file($path) && filemtime($path) < $rm_time ) {
							unlink($path);
						}
					}
				}
				closedir($dhandle);
			}

		}

		public function isAuthorized( $user ) {

			if ( !empty($this->request->params['mypage'] )) {
				if($user['user_type'] == USER_TYPE_CUSTOMER ) return true;
				$this->redirect('/');
			} else if ( !empty($this->request->params['owner']) ) {
				if( $user['user_type'] == USER_TYPE_CLIENT ) return true;
				$this->redirect('/');
			} else if ( !empty($this->request->params['admin'] )) {
				 if($user['user_type'] == USER_TYPE_ADMIN || $user['user_type'] == USER_TYPE_SYSTEM_ADMIN) return true;
				$this->redirect('/');
			}

			return false;
		}

		public function is_smartphone( ) {
			$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
			return (strpos($user_agent, 'Android') !== false || strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'iPod') !== false);
		}

		public function upload( ) {
			//Configure::write('debug', 0);
			$this->autoRender = false;
			$ret = $this->UploadHandler->post();
		}
		
		public function setArea(){
			$this->currentAreaSlug 		= 
			$this->currentAreaName		= 
			$this->currentAreaId 		= 
			$this->currentMunicipalId 	=
			$this->currentPrefectureId 	= null;
			
			$areaSlug = get_current_area();
			
			
			if(!empty($areaSlug)){
				$currentArea = $this->Area->find('first', array('conditions'=>array('slug'=>$areaSlug)));

				if(!empty($currentArea['Area']['id'])){
					$this->currentAreaId = $currentArea['Area']['id'];
					$this->currentAreaName = $currentArea['Area']['name']; //AreaName
					$this->currentMunicipalId = $currentArea['Area']['municipal_id'];
					$this->currentPrefectureId = $currentArea['Area']['prefecture_id'];
					$this->currentAreaSlug = $areaSlug; //Slug
				}
				
			}
			$this->set('current_area_slug', $this->currentAreaSlug);
			$this->set('current_area_name', $this->currentAreaName);
			$this->set('current_area_id', $this->currentAreaId);	
			Configure::write('current_area_id', $this->currentAreaId);
			
			//header 地域選択セレクト			
			$this->set('areas', $this->Area->find('list', array('fields'=>array('slug', 'name'))));
			

		}
		
		public function setUserInfo($user){
			if($this->request->requested) return;

			if(empty($user)){
				$this->set('user_type','');
				$this->set('loggedIn', false);
				return;
			}
			$this->set('loggedIn', true);
			if($user['user_type'] == USER_TYPE_CUSTOMER){
				$cnt = $this->Comment->getRecentReplyCount($user['id'], $this->Session->read('previous_login'));
				$this->Customer->virtualFields['point'] = 'SELECT (GREATEST(0, (SUM(plus) - SUM(minus))))  FROM comments WHERE comments.user_id = Customer.user_id';
				$user_info = $this->Customer->find('first', array('conditions'=>array('user_id'=>$user['id']),
					'contain'=>array(
						'Family'=>array('id','file_name', 'nickname','customer_id'),
						'User'=>array('id','user_type','status','name','last_login','email'),
						'Area'=>array('slug')
						)
				));
			
				$this->mydomain = $user_info['Area']['slug'];
				$user_info['Customer']['recentReplay'] = $cnt;
				$this->Session->write('user_info', $user_info);
				$this->set('user_info', $user_info);
				$this->set('user_type', USER_TYPE_CUSTOMER);
			}else if($user['user_type'] == USER_TYPE_CLIENT){
				$this->set('user_type', USER_TYPE_CLIENT);
			}
		}

	}
