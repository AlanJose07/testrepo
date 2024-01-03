<!DOCTYPE html>
<html lang="#rn:language_code#" >
<rn:meta javascript_module="standard"/>
<head>
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:theme path="/euf/assets/themes/standardagent" css="site.css,
		{YUI}/widget-stack/assets/skins/sam/widget-stack.css,
		{YUI}/widget-modality/assets/skins/sam/widget-modality.css,
		{YUI}/overlay/assets/overlay-core.css,
		{YUI}/panel/assets/skins/sam/panel.css" />
<rn:head_content/>
<link rel="icon" href="images/favicon.png" type="image/png"/>
<style>
.header_logo {
    background: #000!important
}
</style>
</head>


<body class="yui-skin-sam yui3-skin-sam">
<div id="rn_Container" class="rn_Gogo_Container rn_Gogo_Container-loginU rn-Gogo-login">
	
		
			<div class="flight-image">
				<img src="/euf/assets/themes/standardagent/images/flight.png" alt="Intelsat Logo"/>
			</div>
			<div class="welcome-text">
			<h2> Welcome to Intelsat Knowledgebase</h2>
		</div>
	
	
	
 <div class="login-container">
  <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
  <div id="rn_Header" role="banner" class="rn_Gogo_Header">
    <noscript>
    <h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
    </noscript>
    
  </div>
  
  <div id="rn_Body" style="margin-top:-4px;">
    <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
      <rn:page_content/>
    </div>
  </div>  
</div>
<div id="rn_Footer" role="contentinfo">
    <div id="rn_RightNowCredit">
      <p>
      <div id="gogo_credit" style="margin-top:3px;">&copy;&nbsp;<?php echo date("Y") ?> Intelsat LLC. All trademarks are the property of their respective owners.</br>
        
      </div>
      </p>
      
    </div>
  </div>
</div>
</body>
</html>
