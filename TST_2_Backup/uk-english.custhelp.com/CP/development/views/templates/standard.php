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
<meta property="og:site_name" content="Beachbody"/>
<meta property="og:image" content="https://faq.beachbody.co.uk/euf/assets/images/fb_logo.png"/>
<meta property="og:image:width" content="210"/>
<meta property="og:image:height" content="210"/>
<meta name="google-site-verification" content="rYxEZc3JVX-hhSmZYWZkIQ2mYChW6p6VL3aJwrzWf-0" />
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>

<?php
//       $curr_url     = $_SERVER['REQUEST_URI'];
//$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));

$curr_url_can = $_SERVER['REQUEST_URI'];

$curr_url = $_SERVER['REQUEST_URI'];
$curr_url = substr($curr_url, 0, strpos($curr_url, "/lob"));

$canonical_url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

?> 
<link rel='canonical' href='<?php echo $canonical_url; ?>'/>

<link rel="alternate" href="https://faq.beachbody.com<?php echo $curr_url_can;?>" hreflang ="en-us" />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php echo $curr_url_can;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php echo $curr_url_can;?>"  hreflang ="en-ca" />

<!--
<link rel="alternate" href="https://faq.beachbody.com<?php //echo $curr_url;?>" hreflang ="en-us"  />
<link rel="alternate" href="https://faq.beachbody.co.uk<?php //echo $curr_url;?>" hreflang ="en-gb" />
<link rel="alternate" href="https://faq.beachbody.ca<?php //echo $curr_url;?>"  hreflang ="en-ca" />
-->



<link rel="stylesheet" type="text/css" href="/euf/assets/css/dd.css">
<script src="/euf/assets/js/jquery-1.7.min.js" type="text/javascript"></script>
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
<rn:widget path="utils/CobrowsePremium" />  


<?php


//Execute the code if line of business is not exists.

$CI = get_instance();

//Set the backgriund color of selected tab, the tab value  is fetch from session.

$tabval = $CI->session->getSessionData('tabParam');	


		
/*if($tabval=='shake' || $tabval=='team' || $tabval=='coach'  )//Redirect to default lob if the previous lob is not present here
{
if(getUrlParm(temp))//if redirected to uk from any country dropdown(from US or canada), we need to maintain the previous design
{
$temp_id = getUrlParm(temp);
header ('Location:/app/home/lob/beach/temp/'.$temp_id ,true,301);
}
else
{
header ('Location:/app/home/lob/beach',true,301);
}
}*/






switch ($tabval) {
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
	case "beach":
        $newval="469";//"beachbody";
        break;
}
	
?>
<rn:widget path="custom/input/UserActivityTrackingWidget"/>
<link rel="icon" href="images/favicon.png" type="image/png"/>
</head>
<style>
/*.manage_bod{
    position: relative;
}
.manage_bod:after {
    position: absolute;
    right: 0;
    left: auto;
    top: 0;
    background: red;
    content: "";
    width: 50px;
    bottom: 0;
    border-bottom-left-radius: 6px;
    color: #fff;
    content: "New";
    font-weight: bold;
    height: 17px;
}*/
</style>
<body class="yui-skin-sam yui3-skin-sam">
<rn:widget path="custom/chat/ProactiveChatCustom" initiate_by_event="true" min_agents_avail="0" chat_login_page="/app/chat/chat_landing/proactive/yes"/>
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
<div id="rn_Container" class="main_wrapper">
  <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
  <div id="rn_Header" role="banner" class="header">
    <div class="cmp_logo"><img src="https://www.beachbody.com/images/beachbody/en_us/global/bbv6/beachbody_logo.png"></div>
    <rn:widget path="custom/input/SelectCountry"/>
    <form name="formTemplate" id="formTemplate" action="" >
      <input type="hidden" id="hdnParam" name="hdnParam" runat="server" value="<?php echo $urlparam;?>"/>
      <div  class="main_nav">
        <ul>
          <li id="beach" <?php echo ($tabval=='beach') ? "class='rn_SelectedLink'" : ''; ?>><a id="be" href="/app/home/lob/beach">Beachbody</a></li>
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
            <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/home/lob/#rn:php:$tabval#" pages="home,answers/list "/>
          </li>
          <?
		  $chat_template_session =  $this->session->getSessionData('chat_template_session');
		  if($chat_template_session!="")
		  {	
		  
		 		 
		  ?>
        <!--  <li>
            <rn:widget path="navigation/NavigationTab" label_tab="Live Chat" link="/app/chat/chat_launch/lob/#rn:php:$tabval#" pages="chat/chat_launch" external="true" />
          </li>
                
			<li>
			<rn:widget path="navigation/NavigationTab" label_tab="Email" link="/app/ask/lob/#rn:php:$tabval#" pages="ask, ask_confirm" external="true" />
			</li>-->
		  
          <?
		  }
		  else
		  {
		  ?>
          <rn:condition hide_on_pages="home,answers/list">
                   <!--     <li>
              <rn:widget path="navigation/NavigationTab" label_tab="Live Chat" link="/app/chat/chat_launch/lob/#rn:php:$tabval#" pages="chat/chat_launch" external="true" />
            </li>
                       <li>
              <rn:widget path="navigation/NavigationTab" label_tab="Email" link="/app/ask/lob/#rn:php:$tabval#" pages="ask, ask_confirm" external="true" />
            </li>-->
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
      <div id="rn_SideBar" class="fullWidth-container" role="navigation" >
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
          
          <rn:condition show_on_pages="home,answers/list">
		  
		  <h2 class="h-cl">Use Our Fast Self Service Tools Below</h2>
		        
            <?	
			$temp_counter =  $this->session->getSessionData('temp_counter');	
			$old_temp =  $this->session->getSessionData('old_template_ratio');	
			?>
			
          </rn:condition>
		  <?
		  if($temp_counter <= $old_temp)//if((($tabval=='coach')||($tabval=='team')) && ($temp_counter <= $old_temp))
			{
			?>
		  <div class="left-container-block four-box-cndtn">
             
              
             <div class="top_iconwrapper">
		  
		   <div class="rn_Module customize_shakology">
            <rn:widget path="custom/CustomAnouncementText/ShkAnnouncementText" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>    
          </div>
		  
		  <div class="rn_Module update_account_info manage_bod" role="search">
            <rn:widget path="custom/CustomAnouncementText/ManageBOD_new" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Manage BOD Membership" label_message="Manage BOD Membership"/>
          </div>
		  
         <!-- <div class="third modify_activit" role="search">
            <rn:widget path="custom/CustomAnouncementText/VitaminFormText_new" label_heading=" " file_path="/euf/assets/announcements/announcementtest.html" label_message= "#rn:msg:CUSTOM_MSG_VITAMIN_FORM#" />
          </div>-->
		  
		  <div class="rn_Module return_order" role="search">
            <rn:widget path="custom/CustomAnouncementText/ReturnRequest" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>
          </div>
		  
		  <div class="rn_Module update_account_info" role="search">
             <rn:widget path="custom/CustomAnouncementText/UpdateAccountInfo" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Update Account Info" label_message="Update Account Info"/>
          </div>
		  
		  <div class="rn_Module coach_change" role="search">
             <rn:widget path="custom/CustomAnouncementText/CustomerCoachChangeForm" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Customer Coach Change" label_message="  Need to change your Coach? "/>
          </div>
		  
		  <div class="rn_Module gneaology_change" role="search">
              <rn:widget path="custom/CustomAnouncementText/Genealogy" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Shakeology Modification Form" label_message="#rn:msg:CUSTOM_MSG_SHK_FORM#"/>
          </div>
		  
		  <div class="rn_Module order_status" role="search">
             <rn:widget path="custom/CustomAnouncementText/OrderStatusLookup" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Customer Coach Change" label_message="Need to check the status of your order?"/>
          </div>
		  
		  <div class="rn_Module order_status update_credit_card" role="search">
            <rn:widget path="custom/CustomAnouncementText/creditcarddetails" file_path="/euf/assets/announcements/announcementtest.html" label_heading="Credit Card Update" label_message=""/>
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
