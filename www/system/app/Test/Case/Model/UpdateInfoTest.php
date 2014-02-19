<?php
App::uses('UpdateInfo', 'Model');

/**
 * UpdateInfo Test Case
 *
 */
class UpdateInfoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.update_info'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UpdateInfo = ClassRegistry::init('UpdateInfo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UpdateInfo);

		parent::tearDown();
	}

}
