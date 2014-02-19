<?php
App::uses('ClientVote', 'Model');

/**
 * ClientVote Test Case
 *
 */
class ClientVoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_vote',
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
		'app.client_poll',
		'app.client_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientVote = ClassRegistry::init('ClientVote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientVote);

		parent::tearDown();
	}

}
