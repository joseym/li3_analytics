<?php

namespace li3_analytics\extensions\adapter;

abstract class Tracker extends \lithium\core\Object {
	
	protected $_name;

	protected $_views = array();

	abstract protected function key();

	public function __construct($config){

		parent::__construct($config);

		$this->name($config['adapter']);

	}

	public function _init(){
		parent::_init();
	}

	/**
	 * Return the tracker views
	 * @return array
	 */
	public function views() {
		return $this->_views;
	}

	/**
	 * returns type var, set by config.
	 * @return string
	 */
	public function type($type = null){;
		if($type !== null) $this->_type = $type;
		return $this->_type;
	}

	public function uri($uri = null){
		
		if($uri !== null) $this->_uri = $uri;
		return $this->_uri;

	}

	public function name($name = null){
		
		if($name !== null) $this->_name = $name;
		return $this->_name;

	}

}

?>