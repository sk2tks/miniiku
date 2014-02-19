<?php
/**
 * ClientPollFixture
 *
 */
class ClientPollFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'poll_n1' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => '0-5'),
		'poll_n2' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => '0-5'),
		'poll_n3' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => '0-5'),
		'poll_n4' => array('type' => 'integer', 'null' => true, 'default' => null),
		'poll_n5' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'client_id' => 1,
			'poll_n1' => 1,
			'poll_n2' => 1,
			'poll_n3' => 1,
			'poll_n4' => 1,
			'poll_n5' => 1,
			'modified' => '2013-11-20 17:46:38',
			'created' => '2013-11-20 17:46:38'
		),
	);

}
