# Analytic Plugin for [Lithium PHP](http://lithify.me)

A plugin to assist with the assignment of Analytical services, AB tests and click tracking.

> Currently supports [Google Analytics](http://www.google.com/analytics/), [Optimizely](http://www.optimizely.com), [Webtrends Analytics 9 & 10](http://webtrends.com/products/analytics), [Chartbeat](http://chartbeat.com), and [comScore Direct](http://direct.comscore.com)

[![Build Status](https://secure.travis-ci.org/mdx-dev/li3_analytics.png?branch=master)](http://travis-ci.org/mdx-dev/li3_analytics)

## Installation

__Composer__ (best option)

Modify your projects `composer.json` file

~~~ json
{
    "require": {
    	...
        "mdx-dev/li3_analytics": "master"
        ...
    }
}
~~~

Run `php composer.phar install` (or `php composer.phar update`) and, aside from adding it to your Libraries, you should be good to go.

***

__Submodule__ (If you feel like it)

From the root of your app run `git submodule add git://github.com/mdx-dev/li3_analytics.git libraries/li3_analytics`

***

__Clone Directly__ (meh)

From your apps `libraries` directory run `git clone git://github.com/mdx-dev/li3_analytics.git`

## Usage

### Load the plugin

Add the plugin to be loaded with Lithium's autoload magic

In `app/config/bootstrap/libraries.php` add:

~~~ php
<?php
	Libraries::add('li3_analytics');
?>
~~~

### Add your Trackers

> There is a tracker template file in `li3_analytics/config/trackers.php.template`

Like `connections` you'll need to add the trackers into the bootstrap process, the easiest way to do this is to copy `trackers.php.template` to your apps `config/bootstrap` directory as, say, `config/bootstrap/trackers.php`.

Add this file into your `config/boostrap.php` file

~~~ php
<?php
	...
	require __DIR__ . '/bootstrap/trackers.php';
	...
?>
~~~

Modify the trackers to meet your needs:

__Here's an example for each tracker__

~~~ php
	<?php

		use li3_analytics\extensions\Trackers;

		Trackers::add('Google', array( // name it what you'd like
			'adapter' => 'GoogleAnalytics', 	// The Adapter
			'account' => 'UA-999999-1', 		// your GA account
			// 'section' => 'append_head', 		// What helper section to load tracking in your template `append_head | prepend_head`
			// 'domain' => 'dev.com', 			// set if you are using with multiple sub domains, ignore otherwise
			// 'manyTopLevel' => true, 			// set if you are using GA with multiple top level domains
		));
				
		Trackers::add('Optimizely', array(
			'adapter' => 'Optimizely', 			// The Adapter
			'project' => 'xxx123' 				// the optimizely project id
			// 'section' => 'prepend_head', 	// What helper section to load tracking in your template `append_head | prepend_head`
		));

		Trackers::add('Webtrends', array(
			'adapter'	=> 'Webtrends', 			// The Adapter
			'DCSID' 	=> 'dcsXXXXXXXXXXXX_XXXX',	// Webtrends ID
			'domain' 	=> $_SERVER['SERVER_NAME'],	// Domain 
			// 'version'	=> '9.4.0', 			// Analytics 9 by default
			// 'script'		=> '/js/webtrends.js', 	// location of webtrends script (relative to webroot)
			// 'section' 	=> 'append_body' 		// Section to build script block into
		));

		Trackers::add('Chartbeat', array(
			'adapter'	=> 'Chartbeat', 			// The Adapter
			'uid'		=> 3479, 					// Your account user ID
			'domain'	=> $_SERVER['SERVER_NAME'], // website domain

			/**
			 * Chartbeat Configuration Variables
			 * Links to info provided 
			 */ 
				
			// 'config' 	=> array(
			// 	'path' => '/some/path', 		// @link: http://chartbeat.com/docs/configuration_variables#path
			// 	'title' => 'Krusty is back', 	// @link: http://chartbeat.com/docs/configuration_variables#title
			// 	'useCanonical' => true, 		// @link: http://chartbeat.com/docs/configuration_variables#useCanonical
			// 	'sections' => "US Politics", 	// @link: http://chartbeat.com/docs/configuration_variables#groups
			// 	'authors' => "Bob Johnson", 	// @link: http://chartbeat.com/docs/configuration_variables#groups
			// 	'noCookies' => true 			// @link: http://chartbeat.com/docs/configuration_variables#nocookies
			// )
		));
		Trackers::add('comScore', array(
			'adapter'	=> 'ComScore', 			// The Adapter
			'account' 	=> '123456789'	// comScore Account ID
		));

	?>
~~~

> __Webtrends__ - You will still need to build your `webtrends.js` file from webtrends.com, this plugin just places the scripts with this configuration.
> __Note__ - I am working on a way to include automated click tracking with webtrends.

### Set in your template

The plugin comes with a helper (go figure!) that should be used to load your trackers

> Currently both the supported trackers are to be loaded in the head of your template, `Optimizely` should be loaded at the beginning of the `<head/>` block, `Google Analytics` at the end.

~~~ php
<head>
	<?php echo $this->analytics->head('prepend'); ?>
	<title>Magic Tracking #ftw</title>
	<?php echo $this->analytics->head('append'); ?>
</head>
<body>
	<?php echo $this->analytics->body('prepend'); ?>
	...
	<?php echo $this->analytics->body('append'); ?>
</body>
~~~

The trackers will automatically be loaded into the proper sections, however you can override the trackers sections by changing the `section` key in the `Trackers::add()` adapter.

#### Load a single tracker

Remember that name you gave your tracker in `Trackers::add()`, well you can manually call that tracker and put it whereever you'd like! __You're welcome!__

Here's how:

~~~ php
<?php echo $this->analytics->google('position'); ?>
~~~

Replace 'position' with any of the four view types listed below or none for the first view.

* append_body
* prepend_body
* append_head
* prepend_head

Wait, what? That's it?! 

Yes.

> While you can name the tracker whatever you'd like you should be aware that the name is slugified and converted to lowercase before it actually gets added.
> This means that if you name a tracker "__Google Analytics Mang__" it will be converted to `google-analytics-mang`; this is the name you'd need to call with the helper.

#### Body helpers

> A helper for `$this->analytics->body('prepend')` and `$this->analytics->body('append')` will be added as tracker adapters that need that support are included.

## Enjoy

That's it! the proper code for your tracker should now be rendered into your template, no more hassle.

## Upcoming

### Future Trackers
Here is a list of trackers I would like to add support for.

- [Clicky](http://getclicky.com/)

## Contribute
Have an idea for a tracker? Wanna take point on one of the trackers listed above? __Please do!__

Fork and submit a pull request, lets make this awesome.

## Credits

Original plugin written by [Yoan Blanc](https://github.com/greut) - He laid the foundation, give him props.

Vitals.com - (my employer) - Thanks for supporting the OSS community and allowing your engineers to give back to the projects we depend on.