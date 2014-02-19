<?php

class EmailConfig {

	//会員登録
	public $userRegist = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
		'from' => array('miniku@communitylinks.co.jp' => 'みんなの育児'),
		'subject' => '【みんなの育児】会員登録仮受付',
		'template' => 'users/regist',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);
	
	//親族登録
	public $userInvite = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
		'from' => array('miniku@communitylinks.co.jp' => 'みんなの育児'),
		'subject' => '【みんなの育児】会員へのご招待',
		'template' => 'users/invite',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);
	
	//パスワード再発行
	public $userPassword = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
		'from' => array('miniku@communitylinks.co.jp' => 'みんなの育児'),
		'subject' => '【みんなの育児】パスワード再発行',
		'template' => 'users/password',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);
	
	//「交流広場」「街の施設」コメント通報
	public $bbsCommentAlert = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
		'to' => 'support@communitylinks.co.jp',
		//'to' => 'tukisama@ae.wakwak.com',
		'subject' => '【みんなの育児】通報連絡',
		'template' => 'bbs/comment_alert',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);
	
	//ご要望お問い合わせ
	public $contactMain = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
	
		'to' => 'support@communitylinks.co.jp',
		'subject' => '【みんなの育児】ユーザーからのお問合せ',
		'template' => 'contact/main',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);

	//施設お問い合わせ
	public $contactClient = array(
		//'transport' => 'Debug',
		'transport' => 'Mail',
		'to' => 'support@communitylinks.co.jp',
		//'to' => 'ykstudio626@gmail.com',
		'subject' => '【みんなの育児】ユーザーからのお問合せ',
		'template' => 'contact/main',
		'charset' => 'iso-2022-jp',
		'headerCharset' => 'iso-2022-jp',
	);
	
	
}
