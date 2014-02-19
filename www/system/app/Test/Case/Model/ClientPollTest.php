<?php
App::uses('ClientPoll', 'Model');

/**
 * ClientPoll Test Case
 *
 */
class ClientPollTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_poll',
		'app.client',
		'app.contents_type',
		'app.client_type',
		'app.area',
		'app.municipal',
		'app.source',
		'app.topic',
		'app.category',
		'app.tag',
		'app.user',
		'app.user_ip',
		'app.prefecture',
		'app.comment_alert',
		'app.comment',
		'app.family_like',
		'app.topic_vote',
		'app.client_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientPoll = ClassRegistry::init('ClientPoll');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientPoll);

		parent::tearDown();
	}

}
