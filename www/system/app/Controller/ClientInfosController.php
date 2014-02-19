<?php
App::uses('AppController', 'Controller');
/**
 * ClientInfos Controller
 *
 * @property ClientInfo $ClientInfo
 * @property PaginatorComponent $Paginator
 */
class ClientInfosController extends AppController {

/**
 *  Layout
 *
 * @var string
 */
	public $layout = 'bootstrap';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

}
