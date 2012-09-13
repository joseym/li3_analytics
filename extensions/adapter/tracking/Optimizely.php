<?php

namespace li3_analytics\extensions\adapter\tracking;

class Optimizely extends \li3_analytics\extensions\adapter\Tracker {

	/**
	 * Optimizely Project code
	 *
	 * @var string
	 */
	protected $_project;

	/**
	 * What section of the page should the script be loaded?
	 * @var array
	 */
	protected $_views = array(
		'prepend_head' => 'optimizely'
	);


	protected $_autoConfig = array('project', 'section');

	protected $_uri = "//cdn.optimizely.com/js/";

	/**
	 * Way to load tracker
	 * `block`, `inline`
	 * `block` loads a javascript block
	 * `inline` loads a javascript link.
	 * @var string
	 */
	protected $_type = "inline";

	/**
	 * Optimizely project code
	 *
	 * @return string
	 */
	public function project() {
		return $this->_project;
	}

	/**
	 * Unified method to get account details
	 * @return string
	 */
	public function key(){
		return $this->project();
	}

}