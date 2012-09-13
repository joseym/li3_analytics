<?php

namespace li3_analytics\tests\cases\extensions\adapter\tracking;

use li3_analytics\extensions\adapter\tracking\GoogleAnalytics;

class GoogleAnalyticsTest extends \lithium\test\Unit
{

	function test_get_account()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123'
		));
		$this->assertEqual('abc123', $ga->account());
	}

	function test_get_commands()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123'
		));
		$expected = array(
			array('_setAccount', 'abc123'),
			array('_trackPageview'),
		);
		$this->assertEqual($expected, $ga->commands());
	}

	function test_commands()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123',
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));

		$expected = array(
			array('_setAccount', 'abc123'),
			array('_trackPageview'),
			array('_hello'),
			array('a', 'b', 'c', 'd'),
		);

		$this->assertEqual($expected, $ga->commands());
	}
}