<?php
App::uses('AppModel', 'Model');
/**
 * Source Model
 *
 * @property Municipal $Municipal
 */
class Top extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'name';
	public $useTable = false;


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

public function paginate($conditions, $fields, $order, $limit, $page = 1,
    $recursive = null, $extra = array()) {

if($limit){
	$extra .= " LIMIT ".$limit." OFFSET ".(($page-1)*$limit);
}

	return $this->query($extra);
}

public function paginateCount($conditions = null, $recursive = 0,
                                $extra = array()) {
$this->recursive = $recursive;
	return count($this->query($extra));
}

}
