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
<link href="/euf/assets/themes/standard/gogo.css" type="text/css" /> 
</head>


<body class="yui-skin-sam yui3-skin-sam">
<div id="rn_Container" class="rn_Gogo_Container rn_Gogo_Container-loginU">

 <div class="login-container">
  <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
  <div id="rn_Header" role="banner" class="rn_Gogo_Header">
    <noscript>
    <h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
    </noscript>
    <div class="header_logo">			
				                
			<a href="/app/answers/list#rn:session#" class="all-page-logo"><img src="/euf/assets/themes/standardagent/images/american_airways_logo.png" alt="Gogo Logo"/></a>
			<?php $c_id = $this->session->getProfile()->c_id->value;
	   $c1 = RightNow\Connect\v1_2\Contact::fetch($c_id);
	   $count=(count($c1->ServiceSettings->SLAInstances));
	   $sla=$c1->ServiceSettings->SLAInstances[$count-1]->NameOfSLA->LookupName;
	 if($sla!=="AMCC"){?>
            <a href="https://gogoair.sharepoint.com/sites/excaretrain/SitePages/Home.aspx" target="_blank" class="all-page-logo"><img src="/euf/assets/themes/standardagent/images/gogo_sharepoint.png" alt="Gogo SharePoint"/></a>
			<?php }
			else
			{ ?>
			<a href="https://custhelp.gogoinflight.com/app/answers/list_amcc" target="_blank" class="nose">Nose/Tail look up,Click here</a>
			<?php } ?>
       <!-- login -->
       
       <div id="rn_LoginStatus">
            <rn:condition logged_in="true">
                 #rn:msg:WELCOME_BACK_LBL#
                <strong>
                    <rn:field name="Contact.LookupName"/><rn:condition language_in="ja-JP">#rn:msg:NAME_SUFFIX_LBL#</rn:condition>
                </strong>
                <div>
                    <rn:field name="Contact.Organization.LookupName"/>
                </div>
                <rn:widget path="login/LogoutLink" redirect_url="/app/utils/login_form"/>
            <rn:condition_else />
                <rn:condition config_check="PTA_ENABLED == true">
                    <a href="/app/utils/login_form#rn:session#" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="javascript:void(0);">#rn:msg:SIGN_UP_LBL#</a>
                <rn:condition_else>
                </rn:condition>
            </rn:condition>
        </div>
				
				 
        
       
      </div>
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
      <div id="gogo_credit" style="margin-top:3px;">&copy;<?php echo date("Y") ?> Gogo LLC. All trademarks are the property of their respective owners.</br>
      </div>
      </p>
     
    </div>
  </div>
</div>
</body>
</html>
