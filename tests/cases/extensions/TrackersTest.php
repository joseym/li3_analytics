<?php

namespace li3_analytics\tests\cases\extensions;

use li3_analytics\extensions\Trackers;
use lithium\storage\Session;

class TrackersTest extends \lithium\test\Unit {

	function teardown() {
		Trackers::reset();
	}

	function test_setGoogleAnalytics() {
		$config = array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test'
		);

		$expected = array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test',
			'name' => 'test',
		);

		$this->assertEqual($expected, Trackers::add('test', $config));
	}

	function test_getGoogleAnalytics() {

		Trackers::add('test', array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'test'
		));

		$expected = array(
			array('_setAccount', 'test'),
			array('_trackPageview')
		);

		$tracking = Trackers::get('test');

		$this->assertEqual('test', $tracking->account());
		$this->assertEqual($expected, $tracking->commands());

	}

	function test_getFromSession() {

		Session::write(
			Trackers::$name,
			array(
				array('_trackPageview'),
				array('_setDomainName', 'example.org')
			),
			array('name' => 'default')
		);

		Trackers::add('test', array(
			'account' => 'test',
			'adapter' => 'GoogleAnalytics',
			'commands' => array(
				array('_setDomainName', 'example.org'),
			)
		));

		$expected = array(
			array('_setAccount', 'test'),
			array('_trackPageview'),
			array('_setDomainName', 'example.org')
		);

		$tracking = Trackers::get('test');

		$this->assertEqual($expected, $tracking->commands());

	}
}