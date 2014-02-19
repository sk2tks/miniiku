<?php
App::uses('Category', 'Model');

/**
 * Category Test Case
 *
 */
class CategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category',
		'app.contents_type',
		'app.tag',
		'app.topic',
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
		$this->Category = ClassRegistry::init('Category');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Category);

		parent::tearDown();
	}

}
