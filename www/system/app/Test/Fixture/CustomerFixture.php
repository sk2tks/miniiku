<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'customer';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name_kana' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name_kana' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nickname' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gender' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'customer_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'area_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'municipal_code' => array('type' => 'integer', 'null' => true, 'default' => null),
		'prefecture_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'family_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'zip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'prefecture' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sub_prefecture' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'birth_year' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'birth_month' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'borth_day' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'info' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'private_flag' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FB_token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FB_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'FB_data' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'last_name' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name_kana' => 'Lorem ipsum dolor sit amet',
			'first_name_kana' => 'Lorem ipsum dolor sit amet',
			'nickname' => 'Lorem ipsum dolor sit amet',
			'gender' => 'Lorem ip',
			'customer_type' => 'Lorem ip',
			'user_id' => 1,
			'area_id' => 1,
			'municipal_code' => 1,
			'prefecture_id' => 1,
			'family_id' => 1,
			'zip' => 'Lorem ip',
			'prefecture' => 'Lorem ipsum dolor sit amet',
			'sub_prefecture' => 'Lorem ipsum dolor sit amet',
			'file_name' => 'Lorem ipsum dolor sit amet',
			'birth_year' => 1,
			'birth_month' => 1,
			'borth_day' => 1,
			'occupation' => 'Lorem ipsum dolor sit amet',
			'info' => 'Lorem ipsum dolor sit amet',
			'private_flag' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'FB_token' => 'Lorem ipsum dolor sit amet',
			'FB_id' => 'Lorem ipsum dolor sit amet',
			'FB_data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
