<?php
App::uses('Topic', 'Model');

/**
 * Topic Test Case
 *
 */
class TopicTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.topic',
		'app.contents_type',
		'app.category',
		'app.user',
		'app.user_ip',
		'app.area',
		'app.municipal',
		'app.prefecture',
		'app.comment_alert',
		'app.comment',
		'app.family_like',
		'app.topic_vote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Topic = ClassRegistry::init('Topic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Topic);

		parent::tearDown();
	}

}
