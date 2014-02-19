<?php
	App::uses('AppController', 'Controller');
	App::uses('CakeEmail', 'Network/Email');

	/**
	 * Users Controller
	 *
	 * @property User $User
	 * @property PaginatorComponent $Paginator
	 */
	class UsersController extends AppController {

		public $uses = array(
			'User',
			'TempUser',
			'Customer',
			'Family',
			'Client',
			'UserIp'
		);
		/**
		 * Components
		 *
		 * @var array
		 */
	//	public $components = array('Pear.Pear');
		public $helpers = array('Facebook.Facebook');


		public function setAdminTitle( ) {
			$this->set('title_for_layout', '施設管理者管理');
		}

		/**
		 * admin_index method
		 *
		 * @return void
		 */
		public function admin_index( ) {
			$search_key = 'admin_user_search_key';

			if(!empty($this->request->data)){
				$this->Session->write($search_key, $this->request->data);
			}else if(!empty($this->request->params['named'])){
				$this->request->data = $this->Session->read($search_key);
			}else{
				$this->Session->delete($search_key);
			}

			if(!empty($this->request->data['User'])) $data = $this->request->data['User'];

			$conditions = array('user_type'=>USER_TYPE_CLIENT);
			if(!empty($data['name'])){
				$conditions[] = array('User.name like'=>"%".$data['name'] . "%");
			}
			if(!empty($data['email'])){
				$conditions[] = array('User.email like'=>"%".$data['email'] . "%");
			}



			$params = array('conditions'=>$conditions);
			$this->Paginator->settings = $params;

			$this->paginate = array('conditions' => $conditions);
			$this->set('users', $this->Paginator->paginate());
		}

		/**
		 * 管理画面ログイン
		 */
		public function admin_login( ) {
			$this->layout = null;
			if($this->Auth->login()){
				$this->redirect($this->Auth->redirect());
			}
		}

		public function admin_logout(){
			$this->Auth->logout();
			$this->redirect("/admin/users/login");

		}
		/**
		 * admin_view method
		 *
		 * @param string $id
		 * @return void
		 */
		public function admin_view( $id = null ) {
			$this->User->id = $id;
			if ( !$this->User->exists() ) {
				throw new NotFoundException( __('Invalid %s', __('user')) );
			}
			$this->set('user', $this->User->read(null, $id));
		}

		/**
		 * admin_add method
		 *
		 * @return void
		 */
		public function admin_add( ) {
			if ( $this->request->is('post') ) {
				$this->User->create();
				if ( !empty($this->request->data['User']['password']) ) {
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
				}
				if ( $this->User->save($this->request->data) ) {
					$this->Session->setFlash(__('The %s has been saved', __('施設管理者')));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('施設管理者')));
				}
			}
			$this->set('isEdit', false);
			$this->render('admin_entry');
		}

		/**
		 * admin_edit method
		 *
		 * @param string $id
		 * @return void
		 */
		public function admin_edit( $id = null ) {
			$this->User->id = $id;
			if ( !$this->User->exists() ) {
				throw new NotFoundException( __('Invalid %s', __('user')) );
			}
			if ( $this->request->is('post') || $this->request->is('put') ) {
				if ( !empty($this->request->data['User']['new_password']) ) {
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['new_password']);
					$this->request->data['User']['new_password2'] = $this->request->data['User']['new_password'];
				}
				if ( $this->User->save($this->request->data) ) {
					$this->Session->setFlash(__('The %s has been saved', __('施設管理者')));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The %s could not be saved. Please, try again.', __('施設管理者')));
				}
			} else {
				$this->request->data = $this->User->read(null, $id);
			}

			$this->set('isEdit', true);
			$this->render('admin_entry');
		}

		/**
		 * 【管理画面】施設管理者一覧
		 */
		public function admin_client_user_list( ) {
			$this->layout = null;

			$this->User->recursive = 0;
			$this->paginate = array('conditions' => array(
					'user_type' => USER_TYPE_CLIENT,
					'status' => 1
				));
			$this->set('users', $this->Paginator->paginate());

		}

		/**
		 * admin_delete method
		 *
		 * @param string $id
		 * @return void
		 */
		public function admin_delete( $id = null ) {
			if ( !$this->request->is('post') ) {
				throw new MethodNotAllowedException( );
			}
			$this->User->id = $id;
			if ( !$this->User->exists() ) {
				throw new NotFoundException( __('Invalid %s', __('user')) );
			}
			if ( $this->User->delete() ) {
				$this->Session->setFlash(__('The %s deleted', __('user')));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The %s was not deleted', __('user')));
			$this->redirect(array('action' => 'index'));
		}

		/**
		 * Popupログイン
		 */
		public function login( ) {
			$this->layout = null;
			if(!empty($this->request->query['r'])) $this->Session->write('login_redirect', $this->request->query['r']);
			$this->_login();
		}

		public function _login(){

			if ( $this->request->is('post') || $this->request->is('put') ) {

				if ( $this->Auth->login() ) {
					$user_type = $this->Auth->user('user_type');
					$this->set('user_type', $user_type);
					$user_id = $this->Auth->user('id');
					$this->User->id = $user_id;
					//マイページ未読コメント用
					$this->Session->write('previous_login', $this->Auth->user('last_login'));
					$this->User->saveField('last_login', date('Y-m-d H:i:s'));
					if(!empty($this->request->data['User']['auto_login'])){
						$this->AutoLogin->set_auto_login();
					}
					switch($user_type) {
						case USER_TYPE_CLIENT :
							$user_info = $this->User->find('first', array('conditions'=>array('User.id'=>$user_id)));

							break;
						case USER_TYPE_CUSTOMER :
							$user_info = $this->Customer->find('first', array('conditions' => array('user_id' => $user_id)));
							break;
						default :
							$user_info = array();
							break;
					}

					$this->Session->write('user_info', $user_info);
					if($user_type == USER_TYPE_CLIENT){
						$this->set('login_redirect', '/owner/');
					}else if($user_type == USER_TYPE_ADMIN || $user_type==USER_TYPE_SYSTEM_ADMIN){
						$this->set('login_redirect', '/admin/');
					}else{
						$login_redirect = $this->Session->read('login_redirect');
						if(empty($login_redirect) || preg_match("/(login|regist)/", $login_redirect)) $login_redirect = '/mypage/';
						$this->set('login_redirect', $login_redirect);
					}
					$this->Session->delete('login_redirect');
					$this->render('login_complete');
					$ip = $this->request->clientIp();
					$this->UserIp->save(array('ip'=>$ip, 'user_id'=>$user_id));

					return;
				}else{
					$this->Auth->flash("ログインできませんでした");
				}
			}
		}



		public function logout(){
			$this->Auth->logout();
			$this->AutoLogin->delete_auto_login();
			$this->redirect('/');
			$this->Session->delete('user_info');
		}


		/**
		 * 会員登録（招待者登録も含む）
		 */
		public function regist($token = null) {
			$this->layout = null;

			if ( $this->request->is('post') || $this->request->is('put')) {
				$this->TempUser->set($this->request->data);
				if ( $this->TempUser->validates() ) {
					$this->request->data['TempUser']['user_type'] = USER_TYPE_CUSTOMER;
					$this->request->data['TempUser']['password'] = $this->Auth->password($this->request->data['TempUser']['password']);
					$this->request->data['TempUser']['password2'] = $this->Auth->password($this->request->data['TempUser']['password2']);

					$token = $this->request->data['TempUser']['token'] = String::uuid();

					$this->TempUser->save($this->request->data);
					$modified = $this->TempUser->field('modified');


					if(!empty($this->request->data['TempUser']['FB_id'])){
						$this->set('fb_regist_url', '/users/regist_token/'. $token);
						$this->render('fb_regist_complete');
						return;
					}

					$this->render('regist_comp');
					//send mail

					$data = $this->request->data['TempUser'];
					$data['modified'] = $modified;
					$data['regist_url'] = Router::url('/users/regist_token/' . $data['token'], true);
					$mail = new CakeEmail( );
					$mail->config('userRegist');

					$mail->to($data['email']);
					$mail->viewVars($data);
					$sent = $mail->send();
					return;
				}
			}else {
				//招待された場合
				if(!empty($token)){
					$tmpUser = $this->TempUser->find('first', array('conditions'=>array('token'=>$token, 'delete_flg'=>0, 'TempUser.created > ( NOW( ) - INTERVAL 1 DAY )')));
					if(empty($tmpUser)) throw new NotFoundException();
					$this->request->data = $tmpUser;
				}

				$fb_regist = $this->Session->read('fb_regist');
				if(!$fb_regist) return;
				$fbuser = $this->Connect->user();

				if(!empty($fbuser)){
					$fb_id = $fbuser['id'];
					$fbCustomerExist = $this->Customer->find('count', array('conditions'=>array('FB_id'=>$fb_id)));

					if($fbCustomerExist) return;
					$this->request->data['TempUser']['name'] = $fbuser['name'];
					$this->request->data['TempUser']['email'] = $fbuser['email'];
					$this->request->data['TempUser']['FB_id'] = $fbuser['id'];
					$this->Session->delete('fb_regist');
				}
			}

		}

		/**
		 * 親族を招待
		 */
		public function mypage_invite( ) {
			$this->layout = null;

			if ( $this->request->is('post') || $this->request->is('put') ) {
				$this->request->data['TempUser']['user_type'] = USER_TYPE_CUSTOMER;
				$user_info = $this->Session->read('user_info');
				$this->request->data['TempUser']['family_id'] = $user_info['Customer']['family_id'];
				$this->request->data['TempUser']['token'] = String::uuid();
				/*
				$this->Pear->import('Text/Password');
				$TextPassword = new Text_Password();
				$password = $TextPassword->create();
				$this->request->data['TempUser']['password'] = $password;
				*/

				if ( $this->TempUser->save($this->request->data) ) {
					$data = $this->request->data['TempUser'];
					$data['regist_url'] = Router::url('/users/regist_invite/' . $data['token'], true);
					$data['from_user_name'] = $user_info['User']['name'];
					$data['from_user_email'] = $user_info['User']['email'];
					$mail = new CakeEmail( );
					$mail->config('userInvite');

					$mail->to($data['email']);
					$mail->viewVars($data);
					$sent = $mail->send();
					$this->render('mypage_invite_complete');
					return;
				}

			}
		}

		public function regist_invite($token = null){
			if(empty($token)) throw new NotFoundException();
			$data = $this->TempUser->find('first', array('conditions'=>array('token'=>$token, 'delete_flg'=>0,  'TempUser.created > ( NOW( ) - INTERVAL 1 DAY )')));
			if(empty($data)) throw new NotFoundException();

			$referer = $this->referer();
			$referer = !empty($referer) ? $referer : "/";
			$this->set('referer', $referer);
			$this->set('token', $token);

		}

		/**
		 * 仮会員->本会員登録
		 */
		public function regist_token( $token = null ) {
			if ( empty($token) )
				throw new NotFoundException( );
			$tempUser = $this->TempUser->find('first', array('conditions' => array(
					'token' => $token,
					'delete_flg' => 0,
					'TempUser.created > ( NOW( ) - INTERVAL 1 DAY )'
				)));

			if ( empty($tempUser) )
				throw new NotFoundException( );

			$mailUser = $this->User->find('first', array('conditions' => array(
					'email' => $tempUser['email']
				)));

			if ( !empty($mailUser) ) {
				throw new Exception('既に同じメールアドレスのユーザーが存在します');
						}

			try {
				//新規User登録
				$tempUser = $tempUser['TempUser'];
				$user = array();
				$user['name'] = $tempUser['name'];
				$user['email'] = $tempUser['email'];
				$user['password'] = $tempUser['password'];
				$user['user_type'] = $tempUser['user_type'];
				$user['status'] = 1;

				$ret = $this->User->save(array('User' => $user), false);
				if ( !$ret )
					throw new Exception( 'User作成エラー' );

				$user_id = $this->User->getLastInsertId();


				$customerData = array(
					'user_id' => $user_id,
					'FB_id' => $tempUser['FB_id'],
					'status' => 1
				);
				//FBユーザーのデータを追加
				$fbuser = $this->Connect->user();
				if(!empty($fbuser) && $fbuser['id'] == $tempUser['FB_id']){
					$customerData['gender'] = empty($fbuser['gender']) ? '0' : ($fbuser['gender'] == 'male') ? '1' : '2';
					$customerData['first_name'] = $fbuser['first_name'];
					$customerData['last_name'] = $fbuser['last_name'];
				}

				$ret = $this->Customer->save(array('Customer' => $customerData), false);
				if ( !$ret )
					throw new Exception( 'Customer作成エラー' );
				$customer_id = $this->Customer->getLastInsertId();

				if(empty($tempUser['family_id'])){
					//招待されていない場合、新規ファミリーを作る
					$ret = $this->Family->save(array('Family' => array(
							'customer_id' => $customer_id,
							'nickname' => $user['name'] . ' ファミリー'
						)));
					if ( !$ret )
						throw new Exception( 'Family作成エラー' );
					$family_id = $this->Family->getLastInsertId();

				}else{
					$family_id = $tempUser['family_id'];
				}
				$this->Customer->id = $customer_id;
				$this->Customer->saveField('family_id', $family_id);
				$this->TempUser->id = $tempUser['id'];
				$this->TempUser->saveField('delete_flg', '1');

				//ログインさせる
				$user = $this->User->read(null, $user_id);
				$this->Auth->login($user['User']);

				$this->User->id = $user_id;
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));
				//mypage/indexに飛ばす
				$this->redirect('/mypage/#profileEdit');
			} catch(Exception $e) {
				$this->log($e->getMessage());

			}


		}


		public function mypage_login( ) {
			if(!empty($this->request->data)){
				$user_info = $this->Session->read('user_info');
				$this->request->data['TempUser']['customer_id'] = $user_info['Customer']['id'];
			}
			$referer = $this->referer();
			if(empty($referer) || preg_match('/(login|regist)/', $referer)) $referer = '/';
			$this->set('referer', $referer);
		}

		public function popup_login(){

			$referer = $this->referer();
			$redirect = $this->Auth->redirect();
			if(empty($referer) || preg_match('/(login|regist)/', $referer)) $referer = '/';
		//	if(empty($redirect) || preg_match('/(login|regist)/', $redirect)) $redirect = '/';
			$this->set('referer', $referer);
			$this->Session->write('login_redirect', $redirect);
		}

		public function owner_login(){
			$referer = $this->referer();
			if(empty($referer) || preg_match('/(login|regist)/', $referer)) $referer = '/';
			$this->set('referer', $referer);
		//	$this->_login();
		}

		/**
		 * FacebookからのコールバックURL
		 */
		public function fb_login(){
			$fbuser = $this->Connect->user();
			$this->log($fbuser);

			if(!empty($fbuser)){
				$user = $this->Customer->find('first', array( 'conditions'=>array('FB_id'=>$fbuser['id'], 'User.status'=>'1')));
				$this->log($user);

				//すでにFaceBookと連携済みのCustomerがある場合
				if(!empty($user['Customer']['FB_id'])){
					$this->Auth->login($user['User']);
					$login_redirect = $this->Session->read('login_redirect');
					if(empty($login_redirect) || preg_match("/login/", $login_redirect)) $login_redirect = '/mypage/';
					$this->redirect($login_redirect);
					return;
				}
				$this->Session->write('fb_regist', 1);
			}

			//Facebookと連携ボタンをクリック時（すでにFB_idが登録済みのCustomerはいない場合）
			if($this->Auth->loggedIn()){
				$customer = $this->Customer->find('first', array('contain'=>array('User'), 'contain'=>array(),'conditions'=>array('user_id'=>$this->Auth->user('id'))));

				if(!empty($customer['Customer']['id'])){
					$customer = $customer['Customer'];
					$customer['FB_id'] = $fbuser['id'];
					if(empty($customer['first_name'])) $customer['first_name'] = $fbuser['first_name'];
					if(empty($customer['last_name'])) $customer['last_name'] = $fbuser['last_name'];
					if(empty($customer['gender'])) $customer['gender'] = $fbuser['gender'] == 'male' ? "1" : "2";

					$this->Customer->save($customer, false);
					$this->flash('Facebookと連携しました','/mypage', 1, 'flash');
					return;
				}
			}


			$referer = $this->referer();
			if(empty($referer) || preg_match('/(login|regist)/', $referer)) $referer = '/';

			$this->set('referer', $referer);

		}



		/**
		 * パスワードを忘れた方へ
		 */
		public function reminder(){
			$this->layout = null;


			if($this->request->is('post')){
				$this->loadModel('Reminder');
				$this->Reminder->set($this->request->data);
				if($this->Reminder->validates()){
					$user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->request->data['Reminder']['email'])));
					$token = String::uuid();
					$email = $this->request->data['Reminder']['email'];
					$data = array(
						'token' => $token,
						'user_id' => $user['User']['id'],
						'email' => $email,
						'user_name' => $user['User']['name']
					);
					if($this->Reminder->save($data)){
						$mail = new CakeEmail( );
						$mail->config('userPassword');

						$mail->to($email);
						$mail->viewVars($data);
						$sent = $mail->send();
						$this->render('mypage_invite_complete');

						return;
					}else{
						$this->Session->setFlash("パスワードの再発行リクエストを受け付けられませんでした");
						return;
					}
				}
			}
		}

		public function reset_password($token=null){
			if($this->Auth->loggedIn()) $this->redirect('/mypage/');

			$this->loadModel('Reminder');
			if($this->request->is('post')){
				$this->User->validate['new_password']['notempty']= array(
					'rule' => array('notempty'),
					'message' => 'パスワードを入力してください',
					'last' => true
				);
				$this->User->set($this->request->data);

				if($this->User->validates()){
					$this->User->id = $this->request->data['User']['id'];
					$this->User->saveField('password', $this->Auth->password($this->request->data['User']['new_password']));

					$this->Reminder->delete($this->request->data['Reminder']['id']);
					$user = $this->User->find('first', array('conditions'=>array('User.id'=>$this->request->data['User']['id']), 'contain'=>array()));
					$this->Auth->login($user['User']);
					$this->redirect('/mypage');
				}

			}else{

				$reminder = $this->Reminder->find('first', array('conditions'=>array('token'=>$token)));
				if(empty($reminder)) throw new NotFoundException('パスワードを再設定するユーザーが存在しません');

				if(time() > strtotime($reminder['Reminder']['created']) + 60*60) throw new NotFoundException('パスワードを再設定するユーザーが存在しません');
				$user_id = $reminder['Reminder']['user_id'];

				$user = $this->User->find('first', array('contain'=>array(),'conditions'=>array('User.id'=>$user_id)));


				if(!empty($user)){
					$this->request->data['User']['id'] = $user['User']['id'];
					$this->request->data['Reminder']['id'] = $reminder['Reminder']['id'];
				}else{
					throw new NotFoundException('パスワードを再設定するユーザーが存在しません');
				}
			}

		}

		public function view($uid=null){
			$customer = $this->Customer->find('first', array('contain'=>array(), 'conditions'=>array('user_id'=>$uid)));
			if(!empty($customer)){
				$customer_id = $customer['Customer']['id'];
				$this->redirect("/customers/view/".$customer_id);
			}else{
				throw new NotFoundException("ユーザーが見つかりません");
			}
		}

		private function loginRedirect($url){
			if(preg_match("/login/", $url)){
				$url = "/";
			}
			$this->redirect($url);
		}

	}
