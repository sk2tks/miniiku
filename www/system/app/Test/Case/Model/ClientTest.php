<?php
App::uses('Client', 'Model');

/**
 * Client Test Case
 *
 */
class ClientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client',
		'app.contents_type',
		'app.user',
		'app.customer',
		'app.area',
		'app.prefecture',
		'app.family',
		'app.child',
		'app.family_clip',
		'app.family_like',
		'app.user_ip',
		'app.municipal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Client = ClassRegistry::init('Client');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Client);

		parent::tearDown();
	}

}
