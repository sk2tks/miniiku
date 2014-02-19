<?php
	class MasterOption {
		public static $gender = array(
			'1' => '男性',
			'2' => '女性'
		);
		public static $userType = array(
			'1' => '一般ユーザー',
			'2' => '施設管理者'
		);
		public static $userStatus = array(
			'1' => '稼働',
			'0' => '停止'
		);
		public static $customerTypes = array(
			'1' => 'パパ（プレパパ）',
			'2' => 'ママ（プレママ）',
			'3' => '祖父',
			'4' => '祖母',
			'5' => '叔父',
			'6' => '叔母',
			'7' => '伯父',
			'8' => '伯母',
			//'9' => 'その他',
			//'0' => '未設定'
		);
		
		public static $publicity_ranges = array(
			'1' => '行政区' ,
			'2' => '市区町村', 
			'3' => '都道府県', 
			'4' => '全国'
		);
	}
?>