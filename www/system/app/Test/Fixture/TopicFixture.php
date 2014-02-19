<?php
/**
 * TopicFixture
 *
 */
class TopicFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'contents_type_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2, 'comment' => '5:育児情報 6:交流広場'),
		'category_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'area_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'municipal_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'prefecture_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'publicity_range' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1, 'comment' => '1:行政区 2:市区町村 3:都道府県 4:全国'),
		'body' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'source' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'source_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'related_topic' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modfied' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'contents_type_id' => 1,
			'category_id' => 1,
			'user_id' => 1,
			'area_id' => 1,
			'municipal_id' => 1,
			'prefecture_id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'publicity_range' => 1,
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'file_name' => 'Lorem ipsum dolor sit amet',
			'source' => 'Lorem ipsum dolor sit amet',
			'source_url' => 'Lorem ipsum dolor sit amet',
			'related_topic' => 'Lorem ipsum dolor sit amet',
			'modfied' => '2013-11-05 20:09:38',
			'created' => '2013-11-05 20:09:38'
		),
	);

}
