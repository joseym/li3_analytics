<?php

namespace li3_analytics\extensions\adapter\tracking;

use \li3_analytics\extensions\Trackers;


class ComScore extends \li3_analytics\extensions\adapter\Tracker {

	/**
		 * comScore account
		 *
		 * @var string
		 */
		protected $_account;

		/**
		 * What section of the page should the script be loaded?
		 * @var array
		 */
		protected $_views = array(
			'append_head' => 'comScore'
		);

		/**
		 * Way to load tracker
		 * `block`, `inline`
		 * `block` loads a javascript block
		 * `inline` loads a javascript link.
		 * @var string
		 */
		protected $_type = "block";
		
		/**
	    * Include the noscript section -- defaults to true
	    * @var bool
	    */
	    protected $_noscript = true;


		protected $_autoConfig = array('account', 'views', 'noscript');

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
		
		/**
		 * Include the noscript section
		 */
		public function noscript(){
		    return $this->_noscript;
	    }
	}