<?php
/**
 * ClientVoteFixture
 *
 */
class ClientVoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'n1' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2),
		'n2' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2),
		'n3' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2),
		'n4' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2),
		'n5' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2),
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
			'user_id' => 1,
			'n1' => 1,
			'n2' => 1,
			'n3' => 1,
			'n4' => 1,
			'n5' => 1,
			'modified' => '2013-11-28 13:10:11',
			'created' => '2013-11-28 13:10:11'
		),
	);

}
