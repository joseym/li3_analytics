<?php

namespace li3_analytics\extensions\adapter\tracking;

use \li3_analytics\extensions\Trackers;


class Chartbeat extends \li3_analytics\extensions\adapter\Tracker {

	protected $_type = "block";

	protected $_config = array();

	protected $_views = array(
		'append_body' => 'chartbeat',
		'prepend_head' => 'chartbeat-init'
	);

	protected $_uid;

	protected $_domain;

	protected $_autoConfig = array('type', 'uid', 'domain', 'config' => 'merge', 'section');

	public function key(){
		return $this->_uid;
	}

	public function config(){
		if(!isset($this->_config['config'])) $this->_config['config'] = array();
		return $this->_config['config'] + array('uid' => $this->key(), 'domain' => $this->_domain);
	}

}