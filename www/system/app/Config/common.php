<?php

//デフォルトアイコン画像
	define('DEFAULT_IMG_CUSTOMER_L', '/img/common/img/default_img_customer_l.jpg');
	define('DEFAULT_IMG_CUSTOMER_S', '/img/common/img/default_img_customer_s.jpg');
	define('DEFAULT_IMG_CHILD', '/img/common/img/default_img_child.jpg');
	define('DEFAULT_IMG_OWNER_L', '/img/common/img/default_img_owner_l.jpg');
	define('DEFAULT_IMG_OWNER_S', '/img/common/img/default_img_owner_s.jpg');
	
//省略されたコメントbodyの文字数
	define('COMMENT_ABBREV_BODY_LENGTH', 32);

//Top最近の〜リスト数
	define("TOP_RECENT_LIST_COUNT", 3);

//Top中段の育児情報、交流広場のリスト数
	define("TOP_COLUM_LIST_COUNT", 5);


//UPLOAD関連
	define('UPLOAD_DIR', WWW_ROOT.'uploads'.DS);
	define('TEMP_UPLOAD_DIR', UPLOAD_DIR . 'tmp' . DS);
	define('TEMP_DIR', '/uploads/tmp/');
	
	define("CUSTOMER_UPLOAD_DIR", UPLOAD_DIR . 'customer' . DS);
	define("CUSTOMER_DIR", "/uploads/customer/");
	
	define("CLIENT_UPLOAD_DIR", UPLOAD_DIR . 'client' . DS);
	define("CLIENT_DIR", "/uploads/client/");
	
	define("TOPIC_UPLOAD_DIR", UPLOAD_DIR . 'topic' . DS);
	define("TOPIC_DIR", "/uploads/topic/");
	
//ログイン関連
	define('USER_TYPE_CLIENT', 2);
	define('USER_TYPE_CUSTOMER', 1);	
	define('USER_TYPE_ADMIN', 3);	
	define('USER_TYPE_SYSTEM_ADMIN', 4);
	

	function get_current_area(){
		$host = env('SERVER_NAME');
		$domain = Configure::read('domain');
		if(preg_match("/^([^\.]+)\.${domain}/", $host, $match)){
			return $match[1];
		}
		return '';
	}
	function delete_file_recursive($dir, $target){
		if ( !file_exists($dir) ) {
			return;
		}
		$dhandle = opendir($dir);

		if ( $dhandle ) {
			while( false !== ($fname = readdir($dhandle)) ) { 
				if ( is_dir($dir . DS .$fname) ) {
					if ( ($fname != '.') && ($fname != '..') ) {
						delete_file_recursive($dir . DS .$fname, $target);
					}
				} else {
					$file = $dir . DS .$fname;
					if ( is_file($file) && basename($file) == $target ) {
						$ret = unlink($file);		
					}
				}
			}
			closedir($dhandle);
		}
	}
	
	function is_client_type($type_id){
		return $type_id >=1 && $type_id<=5;
	}
	
	function is_topic_type($type_id){
		return $type_id >=6 && $type_id<=7;
	}
	