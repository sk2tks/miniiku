<?php
/**
 * ChildFixture
 *
 */
class ChildFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'gender' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'comment' => '1:男 2:女 0:未設定'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'kana' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nickname' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birth' => array('type' => 'date', 'null' => true, 'default' => null),
		'family_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'info' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'client_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'private_flag' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => '0:表示 1:解除'),
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
			'gender' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'kana' => 'Lorem ipsum dolor sit amet',
			'nickname' => 'Lorem ipsum dolor sit amet',
			'birth' => '2013-11-02',
			'family_id' => 1,
			'file_name' => 'Lorem ipsum dolor sit amet',
			'info' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'client_id' => 1,
			'private_flag' => 'Lorem ipsum dolor sit amet',
			'status' => 1,
			'modified' => '2013-11-02 20:01:36',
			'created' => '2013-11-02 20:01:36'
		),
	);

}
