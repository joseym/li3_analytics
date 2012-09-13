<!-- Start Quantcast -->
<script type="text/javascript">
  var _qevents = _qevents || [];

  (function() {
   var elem = document.createElement('script');

   elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
   elem.async = true;
   elem.type = "text/javascript";
   var scpt = document.getElementsByTagName('script')[0];
   scpt.parentNode.insertBefore(elem, scpt);
  })();

  _qevents.push( { qacct:"<?php echo $tracking->key(); ?>"} ); 
</script>
<?php if($tracking->noscript()){ ?>
	<noscript>
		<div style="display: none;"><img src="//pixel.quantserve.com/pixel/<?php echo $tracking->key(); ?>.gif" height="1" width="1" alt="Quantcast"/></div>
	</noscript>
<?php } ?>
<!-- End Quantcast -->