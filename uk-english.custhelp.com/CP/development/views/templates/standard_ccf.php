<!DOCTYPE html>
                          
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
<script src="//static.atgsvcs.com/js/atgsvcs.js"></script>
<script type='text/javascript'>
ATGSvcs.setEEID("200106307004");
(function() {     
var l = 'faq.beachbody.co.uk',d=document,ss='script',s=d.getElementsByTagName(ss)[0];
function r(u) {
var rn=d.createElement(ss);
rn.type='text/javascript';
rn.defer=rn.async=!0;
rn.src = "//" + l + u;
s.parentNode.insertBefore(rn,s);
}
r('/rnt/rnw/javascript/vs/1/vsapi.js');
r('/vs/1/vsopts.js');
})();
</script>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php

$CI = get_instance();
$tabval = $CI->session->getSessionData('tabParam');	


?>
     
<?php
$curr_url = $_SERVER['REQUEST_URI'];
$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));
?>
<rn:widget path="utils/CobrowsePremium" /> 
<link rel="alternate" href="https://faq.beachbody.com<?php echo $curr_url;?>" hreflang ="en-us" />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php echo $curr_url;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php echo $curr_url;?>"  hreflang ="en-ca" />
 

    <meta charset="utf-8"/>
    <title><rn:page_title/></title>
	
	
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	
	<meta http-equiv="X-UA-Compatible" content="IE=5,8,9,10,11" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]  -->
    <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
    <rn:theme path="/euf/assets/themes/standard" css="ccf_site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
    <rn:head_content/>
    <link rel="icon" href="images/favicon.png" type="image/png"/>
	
</head>
<body class="yui-skin-sam yui3-skin-sam rn_OrderSubmitBody">
<!--<rn:widget path="custom/chat/ProactiveChatCustom" initiate_by_event="true" min_agents_avail="0" chat_login_page="/app/chat/chat_landing/proactive/yes"/>-->
<div id="rn_Container" >
   
    <div id="rn_Body">
        <div id="rn_MainColumn" role="main">
            <a id="rn_MainContent"></a>
            <rn:page_content/>
        </div>
      
    </div>
  
</div>
</body>
<script>
  var TLSWarningYUI,
  displayWarning = function(data) {
  if( data && data.tls_version.split(' ')[1] < 1.1 ){
    var devHeaderPanel = TLSWarningYUI.one("#rn_DevelopmentHeader");
    if(devHeaderPanel)
      devHeaderPanel.setStyle("top", "25px");
      var warningNode = TLSWarningYUI.Node.create(
        '<div id="oldtlswarning" style="background:rgba(0, 0, 0, 0) none repeat scroll 0 0;color:red;text-align:center;top:0">'
        + 'Your browser lacks certain basic security requirements, You should upgrade your browser to the latest version.'
        + '</div>');

      //TLSWarningYUI.one("body *").insertBefore(warningNode);
    }
  };
YUI().use('node-base', 'node-core', 'node-style', 'panel','event-base', function(Y){
        TLSWarningYUI = Y;
});

function ssltester(){
 var e = document.createElement("script");
 e.src = "//www.howsmyssl.com/a/check?callback=displayWarning";
 document.body.appendChild(e);
}

try {document.addEventListener("DOMContentLoaded", ssltester,false)}
catch(e){window.attachEvent("onload", ssltester)}
</script>
</html>
