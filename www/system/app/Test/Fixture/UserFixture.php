<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'last_login' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_type' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'comment' => '1:クライアント 2:カスタマー 3:サイト管理者 4:システム管理者 0:サイトオーナー'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'comment' => '1:利用中 2:停止中 3:退会'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'last_login' => '2013-10-17 21:57:51',
			'password' => 'Lorem ipsum dolor sit amet',
			'user_type' => 1,
			'email' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'modified' => '2013-10-17 21:57:51',
			'created' => '2013-10-17 21:57:51'
		),
	);

}
