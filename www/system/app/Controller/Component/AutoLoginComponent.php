<?php

	App::uses('Component', 'Controller');

	class AutoLoginComponent extends Component {

		public $components = array(
			'Auth',
			'Cookie',
			'Session'
		);
		const COOKIE_EXPIRE_DAY = 30;
		public $AutoLogin = null;
		public $User = null;

		public function initialize( Controller $controller ) {
			
			$this->AutoLogin = ClassRegistry::init('AutoLogin');
			$this->init($controller);
		}

		public function set_auto_login( ) {
			$auto_login_key = sha1(uniqid() . mt_rand(1, 999999999));
			$user_id = $this->Auth->user('id');
			if(!empty($user_id)){
				$expire = time() + 3600 * 24 * self::COOKIE_EXPIRE_DAY;
				$data = array(
					'user_id' => $user_id,
					'key' => $auto_login_key,
					'expire' => date('Y-m-d H:i:s', $expire)
				);
				$this->AutoLogin->save($data);
				$domain = Configure::read('domain');
				$this->Cookie->domain = ".${domain}";
				$this->Cookie->write('auto_login', $auto_login_key, false, self::COOKIE_EXPIRE_DAY . ' days');
			}

		}

		public function delete_auto_login( ) {
			$login_key = $this->Cookie->read('auto_login');
			if ( !empty($login_key) ) {
				$this->AutoLogin->deleteAll(array('key' => $login_key));
				$this->Cookie->delete('auto_login');
			}
		}

		public function init( Controller $controller ) {

			if ( !$this->Auth->loggedIn() ) {
				$login_key = $this->Cookie->read('auto_login');

				if ( !empty($login_key) ) {
					$auto_login = $this->AutoLogin->find('first', 
						array('conditions' => array('key' => $login_key)));
					
					if ( !empty($auto_login['AutoLogin']['user_id']) ) {
						$this->User = ClassRegistry::init('User');
						$user = $this->User->read(null, $auto_login['AutoLogin']['user_id']);
						
						if ( !empty($user['User']) ) {
							$this->Auth->login($user['User']);
							$this->Session->write('previous_login', $user['User']['last_login']);
							$this->User->saveField('last_login', date('Y-m-d H:i:s'));
							$this->delete_auto_login();
							$this->set_auto_login();
						}
					}
				}
			}

		}

	}
