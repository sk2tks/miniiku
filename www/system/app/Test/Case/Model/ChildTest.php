<?php
App::uses('Child', 'Model');

/**
 * Child Test Case
 *
 */
class ChildTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.child',
		'app.family',
		'app.customer',
		'app.user',
		'app.client',
		'app.contents_type',
		'app.area',
		'app.municipal',
		'app.prefecture',
		'app.user_ip',
		'app.family_clip',
		'app.family_like'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Child = ClassRegistry::init('Child');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Child);

		parent::tearDown();
	}

}
