<?php
/**
 * ClientFixture
 *
 */
class ClientFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'contents_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => '1:保育施設 2:娯楽施設 3:学習施設 4:サークル'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'area_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'municipal_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'prefecture_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'publicity_range' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'comment' => '1:行政区 2:市区町村 3:都道府県 4:全国'),
		'info' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'character' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '施設の特色', 'charset' => 'utf8'),
		'zip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'prefecture' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sub_prefecture' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gmap_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name4' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name5' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name6' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name7' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name8' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'client_name' => 'Lorem ipsum dolor sit amet',
			'contents_type_id' => 1,
			'user_id' => 1,
			'area_id' => 1,
			'municipal_id' => 1,
			'prefecture_id' => 1,
			'publicity_range' => 1,
			'info' => 'Lorem ipsum dolor sit amet',
			'character' => 'Lorem ipsum dolor sit amet',
			'zip' => 'Lorem ip',
			'prefecture' => 'Lorem ipsum dolor sit amet',
			'sub_prefecture' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'gmap_code' => 'Lorem ipsum dolor sit amet',
			'file_name1' => 'Lorem ipsum dolor sit amet',
			'file_name2' => 'Lorem ipsum dolor sit amet',
			'file_name3' => 'Lorem ipsum dolor sit amet',
			'file_name4' => 'Lorem ipsum dolor sit amet',
			'file_name5' => 'Lorem ipsum dolor sit amet',
			'file_name6' => 'Lorem ipsum dolor sit amet',
			'file_name7' => 'Lorem ipsum dolor sit amet',
			'file_name8' => 'Lorem ipsum dolor sit amet',
			'modified' => '2013-10-17 22:50:18',
			'created' => '2013-10-17 22:50:18'
		),
	);

}
