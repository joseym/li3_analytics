<noscript>
<?php
	$version = explode(".", $tracking->version());
	if($version[0] == 9) {
		/**
		 * Webtrends Version 9.x.x configuration goes in here!
		 */
?>
	<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;DCS.dcscfg=1&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=<?php echo $tracking->domain(); ?>"/></div>
<?php
	} elseif($version[0] == 10) {
		/**
		 * Webtrends Version 10.x.x configuration goes in here!
		 */
?>
	<img alt="dcsimg" id="dcsimg" width="1" height="1" src="//<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=<?php echo $tracking->domain() ?>&amp;DCSext.version=hb"/>
<?php
	}
?>
</noscript>