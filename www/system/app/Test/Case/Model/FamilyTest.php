<?php
App::uses('Family', 'Model');

/**
 * Family Test Case
 *
 */
class FamilyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.family',
		'app.customer',
		'app.user',
		'app.client',
		'app.user_ip',
		'app.area',
		'app.prefecture',
		'app.child',
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
		$this->Family = ClassRegistry::init('Family');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Family);

		parent::tearDown();
	}

}
