<?php
App::uses('ClientInfosController', 'Controller');

/**
 * ClientInfosController Test Case
 *
 */
class ClientInfosControllerTest extends ControllerTestCase {

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

}
