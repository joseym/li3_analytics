<?php

namespace li3_analytics\extensions\adapter\tracking;

/**
 * http://code.google.com/intl/en/apis/analytics/docs/tracking/asyncTracking.html
 * http://code.google.com/intl/en/apis/analytics/docs/gaJS/gaJSApi.html
 */
class GoogleAnalytics extends \li3_analytics\extensions\adapter\Tracker {
	
	/**
	 * Google Analytics account
	 *
	 * @var string
	 */
	protected $_account;

	/**
	 * Domain to be used
	 * One domain with multiple subdomains
	 * @var string
	 */
	protected $_domain = null;

	/**
	 * What section of the page should the script be loaded?
	 * @var array
	 */
	protected $_views = array(
		'append_head' => 'googleanalytics'
	);

	/**
	 * Way to load tracker
	 * `block`, `inline`
	 * `block` loads a javascript block
	 * `inline` loads a javascript link.
	 * @var string
	 */
	protected $_type = "block";

	protected $_manyTopLevel = false;

	/**
	 * The commands to be called
	 *
	 * @var array
	 */
	protected $_commands = array();

	protected $_autoConfig = array('account', 'commands', 'domain', 'manyTopLevel', 'views');

	/**
	 * Tracking account used
	 *
	 * @return string tracking account
	 */
	public function account() {
		return trim($this->_account);
	}

	/**
	 * Unified method to get account details
	 * @return string
	 */
	public function key(){
		return $this->account();
	}

	public function domain(){
		return $this->_domain;
	}

	/**
	 * Builds the commands that have to be run on the tracker
	 *
	 * @return array list of commands to run on the tracker
	 */
	public function commands() {
		
		$commands = array(
			array('_setAccount', $this->_account),
			array('_trackPageview')
		);

		if($this->_domain !== null) $commands[] = array('_setDomainName', $this->_domain);
		if($this->_manyTopLevel !== false && is_bool($this->_manyTopLevel)) $commands[] = array('_setAllowLinker', $this->_manyTopLevel);

		$commands = array_merge($commands, $this->_commands);

		return array_map("unserialize", array_unique(array_map("serialize", $commands)));

	}
}