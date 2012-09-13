<?php 
	$version = explode(".", $tracking->version());
	/**
	 * Webtrends Version 9.x.x configuration goes in here!
	 */
	if($version[0] == 9){ ?>

<!-- Version: Webtrends 9.4.0 -->
<script src="<?php echo $tracking->script(); ?>" type="text/javascript"></script>

<script type="text/javascript">
	//<![CDATA[
	var _tag=new WebTrends();
	//]]>
</script>

<script type="text/javascript">
	//<![CDATA[
	_tag.dcsCustom=function(){
	// Add custom parameters here.
	//_tag.DCSext.param_name=param_value;
	}
	_tag.dcsCollect();
	//]]>
</script>
<?php if ($tracking->noscript()) { ?>
<noscript>
	<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;DCS.dcscfg=1&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=<?php echo $tracking->domain(); ?>"/></div>
</noscript>
<?php } ?>
<!-- END OF SmartSource Data Collector TAG -->

<?php } 
	/**
	 * Webtrends Version 10.x.x configuration goes in here!
	 */
	elseif($version[0] == 10){ ?>

<!-- START OF SmartSource Data Collector TAG v10.2.29 -->
<!-- Copyright (c) 2012 Webtrends Inc.  All rights reserved. -->
<script>
window.webtrendsAsyncInit=function(){
	var dcs=new Webtrends.dcs().init({
		dcsid:"<?php echo $tracking->key(); ?>",
		domain:"<?php echo $tracking->uri(); ?>",
		<?php
		if($tracking->configuration()){
			// loop thru extra configuration
			foreach($tracking->configuration() as $key => $value) {
				echo "{$key}: ";
				echo (gettype($value) == "string") ? "\"{$value}\"" : (gettype($value) == "boolean" ? ($value === true ? 'true' : 'fase') : $value);
				echo ",\r\t\t";
			}
		}
		echo "});\n";
		// Loop thru custom variables
		if($tracking->custom()){
			foreach($tracking->custom() as $key => $value) {
				echo "\t\tdcs.DCSext.{$key} = ";
				echo (gettype($value) == "string") ? "\"{$value}\"" : (gettype($value) == "boolean" ? ($value === true ? 'true' : 'fase') : $value);
				echo ";\r";
			}
		}
		?>
		dcs.track();
};
(function(){
	var s=document.createElement("script"); s.async=true; s.src="<?php echo $tracking->script() ?>";
	var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
}());
</script>
<?php if ($tracking->noscript()) { ?>
<noscript><img alt="dcsimg" id="dcsimg" width="1" height="1" src="//<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=<?php echo $tracking->domain() ?>&amp;DCSext.version=hb"/></noscript>
<?php } ?>
<!-- END OF SmartSource Data Collector TAG v10.2.29 -->

<?php } ?>

