<?php

namespace li3_analytics\tests\cases\extensions\helper;

use lithium\net\http\Router;
use lithium\action\Request;
use lithium\action\Response;
use lithium\tests\mocks\template\helper\MockHtmlRenderer;
use li3_analytics\extensions\helper\Analytics;
use li3_analytics\extensions\Trackers;

class AnalyticsTest extends \lithium\test\Unit
{
	/**
	 * Test object instance
	 *
	 * @var object
	 */
	public $analytics;

	protected $_routes = array();
	
	function setup() {
		// Route
		$this->_routes = Router::get();
		Router::reset();
		Router::connect('/{:controller}/{:action}/{:id}.{:type}');
		Router::connect('/{:controller}/{:action}.{:type}');

		// Info
		$this->account = sprintf('UA-%05d-X',rand(1,99999));

		// Tracking
		Trackers::add('test', array(
			'account' => $this->account,
			'adapter' => 'GoogleAnalytics',
		));

		// Context
		$this->context = new MockHtmlRenderer(array(
			'request' => new Request(array(
				'base' => '', 'env' => array('HTTP_HOST' => 'foo.local')
			)),
			'response' => new Response()
		));

		// Analytics
		$this->analytics = new Analytics(array('context' => &$this->context));
	}

	function teardown() {
		Router::reset();

		foreach ($this->_routes as $route) {
			Router::connect($route);
		}
		unset($this->analytics);
	}

	function test_script() {
		$result = $this->analytics->test();
		$this->assertTags($result, array(
			'script' => array(
				'type' => 'text/javascript'
			),
			'regex:/.*async.*google-analytics.com\/ga.js[^<]+/',
			'/script'
		));
	}

	function test_script_position() {
		$result = $this->analytics->test('append_head');
		$this->assertTags($result, array(
			'script' => array(
				'type' => 'text/javascript'
			),
			'regex:/.*async.*google-analytics.com\/ga.js[^<]+/',
			'/script'
		));
	}

	function test_account() {
		$result = $this->analytics->test();
		$this->assertTags($result, array(
			'script' => array(
				'type' => 'text/javascript'
			),
			'regex:/.*_setAccount.*'.$this->account.'[^<]*/',
			'/script'
		));
	}
}