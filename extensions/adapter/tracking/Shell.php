<?php

/**
 * Shell Tracking class
 * ----------------------------------------------------------
 * Used for those trackers that have split contents
 * Builds out the secondary trackers and their placeholders.
 */

namespace li3_analytics\extensions\adapter\tracking;

class Shell extends \li3_analytics\extensions\adapter\Tracker {

	/**
	 * Type of tracking element
	 * `block`, `inline`
	 * @var string
	 */
	protected $_type = "block";

	/**
	 * URI to script
	 * @var string
	 */
	protected $_uri = null;

	/**
	 * Name of javascript file
	 * @var string
	 */
	protected $_script = null;

	/**
	 * Tracker Locations
	 * Array means there are child tracker elements
	 * Primary location should be the first.
	 * @var array
	 */
	protected $_views = array();

	/**
	 * Configuration options for tracker
	 * @var array
	 */
	protected $_config = array();

	protected $_autoConfig = array('element', 'uri', 'script', 'views', 'config');

	public function __construct($config){

		// Backwards compatibility
		if(isset($config['section'])) {
			$this->_views = array(
				$config['section'] => $config['element']
			);
		}

		if(isset($config['uri']) AND isset($config['script'])) $this->_type = 'inline';
		parent::__construct($config);
	}

	public function key(){

		return $this->_script;

	}

	public function config($config = null){
		if($config !== null) $this->_config = $config;
		return $this->_config;
	}

}