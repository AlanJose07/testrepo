<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
 
<?php
//$curr_url = $_SERVER['REQUEST_URI'];
//$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));

$curr_url_can = $_SERVER['REQUEST_URI'];

$curr_url = $_SERVER['REQUEST_URI'];
$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));

$canonical_url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 

?>



<script src="//static.atgsvcs.com/js/atgsvcs.js"></script>
<script type='text/javascript'>
ATGSvcs.setEEID("200106307004");
(function() {     
var l = 'faq.beachbody.ca',d=document,ss='script',s=d.getElementsByTagName(ss)[0];
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



<link rel='canonical' href='<?php echo $canonical_url; ?>'/>

<link rel="alternate" href="https://faq.beachbody.com<?php echo $curr_url_can;?>" hreflang ="en-us" />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php echo $curr_url_can;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php echo $curr_url_can;?>"  hreflang ="en-ca" />

<!--
<link rel="alternate" href="https://faq.beachbody.com<?php //echo $curr_url;?>" hreflang ="en-us" />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php //echo $curr_url;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php //echo $curr_url;?>"  hreflang ="en-ca" />

-->

<meta property="og:site_name" content="Beachbody"/>
<meta property="og:image" content="https://faq.beachbody.ca/euf/assets/images/fb_logo.png"/>
<meta property="og:image:width" content="210"/>
<meta property="og:image:height" content="210"/>
<meta name="google-site-verification" content="iaHtz-dH6N7n-Hq7MRuGkUIrCdwUy7n8rMnQ6mqJN4g" />
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">--><!--commenting  this line because, using an old version and not to uncomment without updating to a new version -->
<!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>  -->
<script src="/euf/assets/js/date_picker.js"></script>
<script src="/euf/assets/js/date_picker_jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/euf/assets/css/dd.css">
<!--<script src="/euf/assets/js/jquery-1.7.min.js" type="text/javascript"></script>-->
<script src="/euf/assets/js/jquery.dd.min.js" type="text/javascript"></script>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/site.css" />
<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/custom.css" />
<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/order_status.css" />
<link type="text/css" rel="stylesheet" href="/rnt/rnw/yui_3.8/widget-stack/assets/skins/sam/widget-stack.css" />
<link type="text/css" rel="stylesheet" href="/rnt/rnw/yui_3.8/widget-modality/assets/skins/sam/widget-modality.css" />
<link type="text/css" rel="stylesheet" href="/rnt/rnw/yui_3.8/overlay/assets/overlay-core.css" />
<link type="text/css" rel="stylesheet" href="/rnt/rnw/yui_3.8/panel/assets/skins/sam/panel.css" />
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:head_content/>
<rn:widget path="custom/input/SetLobValues"/>
<rn:widget path="utils/CobrowsePremium" /><!-- cobrowse premium widget[by jithin] -->
<?php

$CI = get_instance();

$tabval = $CI->session->getSessionData('tabParam');	




switch ($tabval) {
	case "beach":
        $newval="469";//"Beachbody";
        break;
    case "team":
        $newval="425";//"Teambeachbody";
        break;
    case "coach":
		$newval="426";//"Coach Online Office";
        break;
    case "shake":
        $newval="427";//"Shakeology";
        break;
	case "beachbodylive":
        $newval="428";//"certification";
        break;
}
	
?>

<rn:widget path="custom/input/UserActivityTrackingWidget"/>
<link rel="icon" href="images/favicon.png" type="image/png"/>
</head>
<style>
    .top_iconwrapper .rn_Module.customize_shakology, .top_iconwrapper .third, .top_iconwrapper .rn_Module {
    width: 9.8% !important;
}
    .rn_Module.customize_shakology strong, .modify_activit .rn_Module strong, .return_order strong, .coach_change strong, .gneaology_change strong, .order_status strong, .update_account_info strong {
    font-size: 12px !important;
}
    
    .top_iconwrapper{
    float: left;
  /* width: 100%;*/
    width: 100%!important;
}
    
    </style>
<body class="yui-skin-sam yui3-skin-sam">
<rn:widget path="custom/chat/ProactiveChatCustom" initiate_by_event="true" min_agents_avail="0" chat_login_page="/app/chat/chat_landing/proactive/yes"/>
<!--Setting the user session to custom session temp_session.Initially, temp_session will be null.If user session not equals to temp session, we will set the counter because, once a template is loaded, it should continue for the rest of the session.If the customer redirects from country dropdown, the design in the previous country should persist.For that, a parameter temp(counter value in the previous country) is added in the country links.If temp has some value, we will set its value as the counter value here.Code starts here-->
<?

$curr_session = $this->session->getSessionData('sessionID');	
$temp_session =  $this->session->getSessionData('temp_session');	

	
if($curr_session != $temp_session )
{

$this->session->setSessionData(array('temp_session' => $curr_session));
$counter = rand(1,100);
$temp_id = getUrlParm(temp);
if($temp_id!="")
{
$this->session->setSessionData(array('temp_counter' => $temp_id));
}
else
{
$this->session->setSessionData(array('temp_counter' => $counter));
}

?>
<rn:widget path="custom/input/TemplateTracking"/>
<?

}
 
$temp_counter =  $this->session->getSessionData('temp_counter');
?>
<div id="counter" style="display:none"><? echo $temp_counter;?></div>
<?
$old_temp =  $this->session->getSessionData('old_template_ratio');

?>
<div id="rn_Container" class="main_wrapper">
  <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
  <div id="rn_Header" role="banner" class="header">
    <div class="cmp_logo"><img src="https://www.beachbody.com/images/beachbody/en_us/global/bbv6/beachbody_logo.png"></div>
    <rn:widget path="custom/input/SelectCountry"/>
    <form name="formTemplate" id="formTemplate" action="" >
      <input 
	  type="hidden" id="hdnParam" name="hdnParam" runat="server" value="<?php echo $urlparam;?>"/>
      <div  class="main_nav">
        <ul>
          <li id="beach" <?php echo ($tabval=='beach') ? "class='rn_SelectedLink'" : '';?>><a id="sk" href="/app/home/lob/beach">Beachbody</a></li>
          <li id="shake" <?php echo ($tabval=='shake') ? "class='rn_SelectedLink'" : '';?>><a id="sk" href="/app/home/lob/shake">Shakeology</a></li>
          <li id="team" <?php echo ($tabval=='team') ? "class='rn_SelectedLink'" : '';?>><a id="te" href="/app/home/lob/team">Team Beachbody</a></li>
          <li id="beachbodylive" <?php echo ($tabval=='beachbodylive') ? "class='rn_SelectedLink'" : '';?>><a id="cert" href="/app/home/lob/beachbodylive">Beachbody LIVE!</a></li>
          <li id="coach" <?php echo ($tabval=='coach') ? "class='rn_SelectedLink'" : '';?>><a id="co" href="/app/home/lob/coach">Coach FAQ</a></li>
        </ul>
      </div>
    </form>
  </div>
  <div id="rn_Navigation" class="contents_wrap">
    <rn:condition hide_on_pages="utils/help_search">
      <div id="rn_NavigationBar" role="navigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/home/lob/#rn:php:$tabval#" pages="home,answers/list"/>
          </li>
          <?
		  $chat_template_session =  $this->session->getSessionData('chat_template_session');
		  if($chat_template_session!="")
		  {	
		  
		  //if($tabval!='beachbodylive')    
		  //{
		  ?>
          <li>
          
	          <!--commeneted by sriram-->
	           <!--<rn:widget path="navigation/NavigationTab" label_tab="Live Chat" link="/app/chat/chat_launch/lob/#rn:php:$tabval#" pages="chat/chat_launch" external="true" />-->
	          <!--commeneted by sriram-->	
          </li>
          <?php
		 // }
		  ?>
          <li>
          	<!--commeneted by sriram-->
            <!--<rn:widget path="navigation/NavigationTab" label_tab="Email" link="/app/ask/lob/#rn:php:$tabval#" pages="ask, ask_confirm" external="true" />-->
            <!--commeneted by sriram-->
          </li>
          <?
		
		  } 
		  else
		  {
		  ?>
          <rn:condition hide_on_pages="home,answers/list">
            <?php
		 // if($tabval!='beachbodylive')    
		 // {
		  ?>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="Live Chat" link="/app/chat/chat_launch/lob/#rn:php:$tabval#" pages="chat/chat_launch" external="true" />
            </li>
            <?php
		 // }
		  ?>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="Email" link="/app/ask/lob/#rn:php:$tabval#" pages="ask, ask_confirm" external="true" />
            </li>
          </rn:condition>
          <?
		   }
		   ?>
        </ul>
      </div>
    </rn:condition>
  </div>
  <div id="rn_Body" class="normalbody">
    <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
      <div id="rn_SideBar" role="navigation" class="fullWidth-container NoOverflow">
        <div class="rn_Padding">
          <rn:condition url_parameter_check="lob == 'team'">
            <rn:widget path="custom/CustomAnouncementText/CustomAnouncementText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message="#rn:msg:CUSTOM_MSG_TEAM_ANMNT#" />
          </rn:condition>
          <rn:condition url_parameter_check="lob == 'coach'">
            <rn:widget path="custom/CustomAnouncementText/CustomAnouncementText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message="#rn:msg:CUSTOM_MSG_COACH_ANMNT#" />
          </rn:condition>
          <rn:condition url_parameter_check="lob == 'shake'">
            <rn:widget path="custom/CustomAnouncementText/CustomAnouncementText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message="#rn:msg:CUSTOM_MSG_SHAKE_ANMNT#" />
          </rn:condition>
          <rn:condition url_parameter_check="lob == 'beachbodylive'">
            <rn:widget path="custom/CustomAnouncementText/CustomAnouncementText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message="#rn:msg:CUSTOM_MSG_CERTI_ANMNT#" />
          </rn:condition>
          <rn:condition url_parameter_check="lob == 'beach'">
            <rn:widget path="custom/CustomAnouncementText/CustomAnouncementText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message="#rn:msg:CUSTOM_MSG_BEACH_ANMNT#" />
          </rn:condition>
        
		  <h2 class="h-cl">Use Our Fast Self Service Tools Below</h2>
		<?
			$temp_counter =  $this->session->getSessionData('temp_counter');
$old_temp =  $this->session->getSessionData('old_template_ratio');	
			if($temp_counter <= $old_temp)//if((($tabval=='coach')||($tabval=='team')) && ($temp_counter <= $old_temp))
			{
			?>
			<div class="CustCoachMessage ">
			
			 <div class="left-container-block four-box-cndtn">
             
              
             <div class="top_iconwrapper">
            <div class="rn_Module customize_shakology" role="search">
              <rn:widget path="custom/CustomAnouncementText/ShkAnnouncementText" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>
            </div>
			<!-- new BOD tile-->
			<div class="rn_Module update_account_info manage_bod" role="search">
              <rn:widget path="custom/CustomAnouncementText/ManageBOD" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Manage BOD Membership" label_message="Manage BOD Membership"/>
            </div>
			<!-- new BOD tile-->
            <div class="third modify_activit" role="search">
            <rn:widget path="custom/CustomAnouncementText/VitaminFormText" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message= "#rn:msg:CUSTOM_MSG_VITAMIN_FORM#" />
</div>
     
	 
		<div class="rn_Module order_status" role="search">

		<rn:widget path="custom/CustomAnouncementText/OrderStatusLookup" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Customer Coach Change" label_message="Need to check the status of your order?"/>
		</div>
		
 <div class="rn_Module return_order" role="search">
              <rn:widget path="custom/CustomAnouncementText/ReturnRequest" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>
            </div>
              
			

			<!-- new tile UPDATE ACCOUNT INFO-->
			<div class="rn_Module update_account_info" role="search">
              <rn:widget path="custom/CustomAnouncementText/UpdateAccountInfo" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Update Account Info" label_message="Update Account Info"/>
            </div>
			<!-- new tile UPDATE ACCOUNT INFO-->
			
			<div class="rn_Module order_status update_credit_card" role="search">

				<rn:widget path="custom/CustomAnouncementText/creditcarddetails" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Credit Card Update" label_message=""/>
			</div>
            <div class="rn_Module coach_change" role="search">
              <rn:widget path="custom/CustomAnouncementText/CustomerCoachChangeForm" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Customer Coach Change" label_message="  Need to change your Coach? "/>
            </div>
             <div class="rn_Module gneaology_change" role="search">
              <rn:widget path="custom/CustomAnouncementText/Genealogy" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>
            </div>
              	
			 
			
		
	 </div>

			</div>
			  
		
		  </div>
          
           <?
		if($temp_counter <= $old_temp)
		{
		?>
          <rn:condition show_on_pages="home,answers/list">
            <div id="rn_SearchControls">
              <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
              <form onSubmit="return false;">
                <div class="rn_SearchInput">
				 <rn:widget path="custom/search/KeywordTextPlaceHolder" label_text="Can’t find what you need?" place_holder="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus=false/>
                </div>
                <rn:widget path="custom/search/CustomSearchButton" report_page_url="/app/answers/list/lob/#rn:php:$tabval#"/>
              </form>
            </div>
          </rn:condition>
          <?
		  }
		?>
		 		
		  <?php
		  }
		  
		  ?>
		  
        </div>
      </div>
      <rn:page_content/>
    </div>
  </div>
  <div id="rn_Footer" role="contentinfo">
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

      TLSWarningYUI.one("body *").insertBefore(warningNode);
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
