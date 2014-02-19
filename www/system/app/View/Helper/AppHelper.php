<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

//カテゴリマークとカテゴリ名を出力
public function pr_cat($id , $name = null){
	$html = '<span class="span0'.$id.'">'.$name.'</span>';
	return $html;
}

//DATETIMEを出力
public function pr_datetime($datetime , $format = null){
	if(!$format)$format = "Y.m.d H:i";
	echo date($format ,strtotime($datetime)); 
}

//郵便番号を整形
public function pr_zip($zip){
	$zip = preg_replace("/^(\d{3})(\d{4})$/", "$1-$2", $zip);
	return $zip;
}

//metaデータ配列より指定の項目を得る
public function get_meta_value($key , $data){
	foreach ($data as $item){
		if($key == $item['item'])return $item['value']; 
	}
	return false;
}

}
