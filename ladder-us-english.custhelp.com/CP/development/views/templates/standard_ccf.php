<!DOCTYPE html>

<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
<script src="//static.atgsvcs.com/js/atgsvcs.js"></script>
<script type='text/javascript'>
ATGSvcs.setEEID("200106307004");
(function() {     
var l = 'faq.beachbody.com',d=document,ss='script',s=d.getElementsByTagName(ss)[0];
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

<!--<rn:widget path="custom/chat/ProactiveChatCustom" initiate_by_event="true" min_agents_avail="0" chat_login_page="/app/chat/chat_landing/proactive/yes"/>-->
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php

$CI = get_instance();
$tabval = $CI->session->getSessionData('tabParam');	


?>

<?php
$curr_url = $_SERVER['REQUEST_URI'];
$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));
?>
<link rel="alternate" href="https://faq.beachbody.com<?php echo $curr_url;?>" hreflang ="en-us" />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php echo $curr_url;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php echo $curr_url;?>"  hreflang ="en-ca" />
 

    <meta charset="utf-8"/>
    <title><rn:page_title/></title>
	
	
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	
	<meta http-equiv="X-UA-Compatible" content="IE=5,8,9,10,11" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
    <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
    <rn:theme path="/euf/assets/themes/standard" css="ccf_site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
    <rn:head_content/>
    <link rel="icon" href="images/favicon.png" type="image/png"/>
	<rn:widget path="utils/CobrowsePremium" /><!-- cobrowse premium widget[by jithin] -->
</head>
<body class="yui-skin-sam yui3-skin-sam rn_OrderSubmitBody">
<div id="rn_Container" >
    <!--<div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div> -->
   <!-- <div id="rn_Header" role="banner">
        <rn:widget path="utils/CapabilityDetector"/>
        <div id="rn_Logo"><a href="/app/#rn:config:CP_HOME_URL##rn:session#"><span class="rn_LogoTitle">#rn:msg:SUPPORT_CENTER_LBL#</span></a></div>
        <div id="rn_LoginStatus">
            <rn:condition logged_in="true">
                 #rn:msg:WELCOME_BACK_LBL#
                <strong>
                    <rn:field name="Contact.LookupName"/><rn:condition language_in="ja-JP">#rn:msg:NAME_SUFFIX_LBL#</rn:condition>
                </strong>
                <div>
                    <rn:field name="Contact.Organization.LookupName"/>
                </div>
                <rn:widget path="login/LogoutLink"/>
            <rn:condition_else />
                <rn:condition config_check="PTA_ENABLED == true">
                    <a href="javascript:void(0);" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="javascript:void(0);">#rn:msg:SIGN_UP_LBL#</a>
                <rn:condition_else />
                    <a href="javascript:void(0);" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="/app/utils/create_account#rn:session#">#rn:msg:SIGN_UP_LBL#</a>
                    <rn:condition hide_on_pages="utils/create_account, utils/login_form, utils/account_assistance">
                        <rn:widget path="login/LoginDialog" trigger_element="rn_LoginLink"/>
                    </rn:condition>
                    <rn:condition show_on_pages="utils/create_account, utils/login_form, utils/account_assistance">
                        <rn:widget path="login/LoginDialog" trigger_element="rn_LoginLink" redirect_url="/app/account/overview"/>
                    </rn:condition>
                </rn:condition>
            </rn:condition>
        </div>
    </div> -->
   <!-- <div id="rn_Navigation">
    <rn:condition hide_on_pages="utils/help_search">
        <div id="rn_NavigationBar" role="navigation">
            <ul>
                <li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/#rn:config:CP_HOME_URL#" pages="home, "/></li>
                <li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ANSWERS_HDG#" link="/app/answers/list" pages="answers/list, answers/detail, answers/intent"/></li>
                <rn:condition config_check="COMMUNITY_ENABLED == true">
                    <li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:COMMUNITY_LBL#" link="#rn:config:COMMUNITY_HOME_URL:RNW##rn:community_token:?#" external="true"/></li>
                </rn:condition>
                <li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/ask" pages="ask, ask_confirm"/></li>
                <li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:YOUR_ACCOUNT_LBL#" link="/app/account/overview" pages="utils/account_assistance, account/overview, account/profile, account/notif, account/change_password, account/questions/list, account/questions/detail, account/notif/list, utils/login_form, utils/create_account, utils/submit/password_changed, utils/submit/profile_updated"
                subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > /app/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > /app/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > /app/account/profile, #rn:msg:NOTIFICATIONS_LBL# > /app/account/notif/list"/></li>
            </ul>
        </div>
    </rn:condition>
    </div> -->
    <div id="rn_Body">
        <div id="rn_MainColumn" role="main">
            <a id="rn_MainContent"></a>
            <rn:page_content/>
        </div>
      <!--  <div id="rn_SideBar" role="navigation">
            <div class="rn_Padding">
                <rn:condition hide_on_pages="answers/list, home, account/questions/list">
                <div class="rn_Module" role="search">
                    <h2>#rn:msg:FIND_ANS_HDG#</h2>
                    <rn:widget path="search/SimpleSearch"/>
                </div>
                </rn:condition>
                <div class="rn_Module">
                    <h2>#rn:msg:CONTACT_US_LBL#</h2>
                    <div class="rn_HelpResources">
                        <div class="rn_Questions">
                            <a href="/app/ask#rn:session#">#rn:msg:ASK_QUESTION_LBL#</a>
                            <span>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</span>
                        </div>
                    <rn:condition config_check="COMMUNITY_ENABLED == true">
                        <div class="rn_Community">
                            <a href="javascript:void(0);">#rn:msg:ASK_THE_COMMUNITY_LBL#</a>
                            <span>#rn:msg:SUBMIT_QUESTION_OUR_COMMUNITY_CMD#</span>
                        </div>
                    </rn:condition>
                    <rn:condition config_check="MOD_CHAT_ENABLED == true">
                        <rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1"/>
                    </rn:condition>
                        <div class="rn_Contact">
                            <a href="javascript:void(0);">#rn:msg:CONTACT_US_LBL#</a>
                            <span>#rn:msg:CANT_YOURE_LOOKING_SITE_CALL_MSG#</span>
                        </div>
                    <rn:condition config_check="CP_CONTACT_LOGIN_REQUIRED == false" logged_in="true">
                        <div class="rn_Feedback">
                            <rn:widget path="feedback/SiteFeedback" />
                            <span>#rn:msg:SITE_USEFUL_MSG#</span>
                        </div>
                    </rn:condition>
                    </div>
                </div>
            </div>
        </div> --> <!-- commenting sideBar -->
    </div>
  <!-- <div id="rn_Footer" role="contentinfo">
        <div id="rn_RightNowCredit">
            <rn:condition hide_on_pages="utils/guided_assistant">
            <div class="rn_FloatLeft">
                <rn:widget path="utils/PageSetSelector"/>
            </div>
            </rn:condition>
            <div class="rn_FloatRight">
                <rn:widget path="utils/RightNowLogo"/>
            </div>
        </div>
    </div> -->
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

     // TLSWarningYUI.one("body *").insertBefore(warningNode);
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
