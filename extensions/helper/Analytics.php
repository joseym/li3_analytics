<?php

namespace li3_analytics\extensions\helper;

use li3_analytics\extensions\Trackers;
use lithium\template\View;
use lithium\g11n\Message;
use lithium\core\Environment;
use lithium\core\ConfigException;

class Analytics extends \lithium\template\Helper {

	protected $_locations = array();
	protected $_view;
	protected $_sections;
	protected $_trackers = array();

	public function _init(){
		$this->_sections = Trackers::get();
		parent::_init();
	}

	/**
	 * Build out tracking scripts for head, body or specific trackers
	 * @return string
	 */
	public function __call($method, $options){

		// Build block sections
		if($method === 'head' OR $method === 'body'){

			$position = ($options[0] == 'prepend' OR $options[0] == 'append') ? $options[0] : false;

			if($position){

				if(!empty($this->_sections["{$position}_{$method}"]) && $section = $this->_sections["{$position}_{$method}"]){

					foreach($section as $tracker){
						echo "\n{$this->_track($tracker['tracker'], $tracker['view'])}\n";
						$this->_trackers[$tracker['tracker']->name()][] = "{$position}_{$method}";
					}

				}

			}
			
			return;

		}

		// Build specific tracker
		$tracker = Trackers::get($method);
		$views = $tracker->views();

		// Get view
		if(isset($options[0])) {
			$view = $views[$options[0]];
		} else {
			// Use first view
			$keys = array_keys($views);
			$view = $views[$keys[0]];
		}

		if(!empty($tracker)){

			return $this->_track($tracker, $view);

		}

	}

	/**
	 * Render the tracker info from the oject configuration
	 * @param  object $tracker Tracker adapter
	 * @return [type]          [description]
	 */
	protected function _track($tracking, $template){

		// Tracking object
		$class = get_class($tracking);
		// Adapter Name
		$adapter = mb_substr($class, mb_strrpos($class, '\\')+1);

		$library = 'li3_analytics';

		if($tracking->type() == 'inline'){

			return $this->_context->html->script("{$tracking->uri()}{$tracking->key()}") . "\n\t";

		}

		if($tracking->type() == 'block'){
			
			// initialize the template object
			$view = $this->renderView();

			return $view->render('element',
				compact('tracking'),
				compact('template', 'library')
			);

		}


	}

	/**
	 * Renders view element
	 * @return object
	 */
	protected function renderView() {

		if (!isset($this->_view)) {
			$this->_view = new View(array(
				'paths' => array(
					'element' => '{:library}/views/elements/{:template}.{:type}.php',
				),
				'outputFilters' => Message::aliases(),
			));
		}

		return $this->_view;

	}

}