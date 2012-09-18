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

	function test_view_position()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123',
			'section' => 'prepend_head',
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));
		$views = $ga->views();
		$keys = array_keys($views);
		$this->assertEqual('prepend_head', $keys[0]);
	}

	function test_view_element()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123',
			'element' => 'google_2',
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));
		$views = $ga->views();
		$this->assertEqual('google_2', array_pop($views));
	}

	function test_view_position_element()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123',
			'section' => 'append_head',
			'element' => 'google_2',
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));
		$views = $ga->views();
		$this->assertIdentical(1, count($views)); // Length
		$this->assertEqual(array('append_head'=>'google_2'), $views); // key/value
	}

	function test_view_multi_views()
	{
		$ga = new GoogleAnalytics(array(
			'adapter' => 'GoogleAnalytics',
			'account' => 'abc123',
			'views' => array(
				'prepend_head' => 'google_2',
				'prepend_body' => 'google_3'
			),
			'commands' => array(
				array('_hello'),
				array('a', 'b', 'c', 'd'),
			)
		));
		$views = $ga->views();
		$this->assertEqual(array(
			'prepend_head' => 'google_2',
			'prepend_body' => 'google_3'
		), $views); // key/value
	}
}