<?php
App::uses('Municipal', 'Model');

/**
 * Municipal Test Case
 *
 */
class MunicipalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.municipal'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Municipal = ClassRegistry::init('Municipal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Municipal);

		parent::tearDown();
	}

}
