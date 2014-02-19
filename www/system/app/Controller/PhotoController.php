<?php


class PhotoController extends AppController {

	public function mypage_list(){
		$this->layout = null;
		pr($this->request->is('request'));
		echo date('Y-m-d H:i:s');
	}
	
	public function mypage_upload(){
		$this->layout = 'ajax';
		$this->autoRender = false;
		
	}
}
