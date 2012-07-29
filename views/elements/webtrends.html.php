<!-- START OF SmartSource Data Collector TAG v10.2.29 -->
<!-- Copyright (c) 2012 Webtrends Inc.  All rights reserved. -->
<script>
window.webtrendsAsyncInit=function(){
    var dcs=new Webtrends.dcs().init({
        dcsid:"<?php echo $tracking->key(); ?>",
        domain:"statse.webtrendslive.com",
        timezone:-5,
        i18n:true,
        offsite:true,
        download:true,
        downloadtypes:"xls,doc,pdf,txt,csv,zip,docx,xlsx,rar,gzip",
        anchor:true,
        javascript: true,
        onsitedoms:"vitals.com",
        fpcdom:".{2},vitals.com",
        });
        dcs.DCSext.version = 'hb';
        dcs.track();
};
(function(){
    var s=document.createElement("script"); s.async=true; s.src="<?php echo $tracking->script() ?>";
    var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
}());
</script>
<noscript><img alt="dcsimg" id="dcsimg" width="1" height="1" src="<?php echo $tracking->uri(); ?><?php echo $tracking->key(); ?>/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=<?php echo $tracking->version(); ?>&amp;dcssip=www.{2},vitals.com&amp;DCSext.version=hb"/></noscript>
<!-- END OF SmartSource Data Collector TAG v10.2.29 -->