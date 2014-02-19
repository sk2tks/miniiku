<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class AboutController extends AppController {

	//public $components = array('Security' => array('validatePost' => false));
	public $uses = array('Contact');
	public $helpers = array('Formhidden');
	public function index(){
		
	}
	
	public function company(){
		
	}
	
	public function rules(){
		
	}
	
	public function contact(){
		//$this->Security->blackHoleCallback = 'blackhole';
		
		if($this->request->is('post')){
			if(!$this->checkToken()) $this->redirect('/about/contact');
			$this->Contact->set($this->request->data);
			if($this->Contact->validates()){
				$mode = $this->request->data['mode'];
				if($mode == 'conf'){
					$this->request->data['mode'] = 'comp';
					$this->render('contact_conf');
					return;
				}else if($mode == 'comp'){
					$data =  $this->request->data['Contact'];
					if($this->Auth->loggedIn()){
						$user_info = $this->Session->read('user_info');
						$data['user_name'] = $this->Auth->user('name');
						$data['client_name'] = sprintf("%s %s", $user_info['Customer']['last_name'], $user_info['Customer']['first_name']);
					}
					$mail = new CakeEmail( );
					$mail->config('contactMain');
					$mail->from($data['email']);
					$mail->viewVars($data);
					$sent = $mail->send();
					$this->render('contact_comp');
					$this->deleteToken();
					return;
					//メール送信
				}
				
			}
		}
		
	}
	
	public function blackhole($type){
		$this->redirect('/about/contact');
	}
}
