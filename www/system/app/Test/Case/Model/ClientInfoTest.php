<?php
App::uses('ClientInfo', 'Model');

/**
 * ClientInfo Test Case
 *
 */
class ClientInfoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_info',
		'app.client',
		'app.contents_type',
		'app.client_type',
		'app.area',
		'app.municipal',
		'app.source',
		'app.topic',
		'app.category',
		'app.user',
		'app.user_ip',
		'app.client_user',
		'app.prefecture',
		'app.comment_alert',
		'app.topic_vote',
		'app.client_poll',
		'app.client_vote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientInfo = ClassRegistry::init('ClientInfo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientInfo);

		parent::tearDown();
	}

}
