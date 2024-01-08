<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
The below code is important. In order to set the selected category in the chat workspace explicitly assigning the selected category id which is posted from the contact us support page hidden form submit. This selected id is assigned to the Incident_Category, which will set the category field in chat workspace as the selected category...
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?


$CI = &get_instance();

if(!isset($_POST['selected_category']))
{
if($CI->session->getSessionData('blank'))
{ 

$json = json_decode(urldecode($CI->session->getSessionData('blank')), true);

//print_r($json);
 for($i=0; $i<count($json);$i++)
 {
 	$_POST[str_replace(".","_",$json[$i]["name"])] = $json[$i]["value"];
 }
   
	$CI->session->setSessionData(array('blank' => ''));
}

}

else
{ 
	$CI->session->setSessionData(array('blank' => ''));
}

if($CI->session->getSessionData('reload') <> 'false'){
	header("Location: /app/home");
}
$CI->session->setSessionData(array('reload' => 'true'));
$_POST["Incident_Category"] = $_POST["selected_category"];
$_POST["Incident_Product"] = $_POST["uad_mapping_product"];

if(empty($_POST["Incident_Category"]))
 header("Location: /app/home");    
?>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
The code explained above. 
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php   
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$exploded_url = explode("/",$url);
$proactive = 0;
$proactive = array_search("proactive",$exploded_url);

$from_proactive = (string)$exploded_url[$proactive+1];

?>
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<script>
/*$( document ).ready(function() {
var target = document.querySelector('title');//getElementsByTagName('title')[0];
console.log("target is");
console.log(typeof(target));
// create an observer instance
var observer = new MutationObserver(function(mutations) {
    // We need only first event and only new value of the title
	console.log("-----------------------------------------------------");
    console.log(mutations[0].target.nodeValue);
});

// configuration of the observer:
var config = { subtree: true, characterData: true };

// pass in the target node, as well as the observer options
observer.observe(target, config);

});*/
</script>
<script>
/*var proactive = "<?php /*echo $from_proactive*/ ?>";
proactive = String(proactive);
if(proactive != "yes")
{	*/
	
try{
	if(parent.window.opener != null && !parent.window.opener.closed)
	{
	  //parent.window.opener.location = 'https://faq.beachbody.ca/app/home'; //test1 ();
	  parent.window.opener.location.replace("/app/home");
	}

}catch(e){ alert(e.description);}  
	/*window.onunload = refreshParent;
	function refreshParent() {
	//alert("check this out");
	//console.log(window.opener.location);
	window.opener.location = 'https://faq.beachbody.com/app/home';
	//window.opener.location.reload();
	
	}*/
/*}*/
</script>

<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta clickstream="chat_landing" javascript_module="standard" include_chat="true" noindex="true"/>
<head>
    <meta charset="utf-8"/>
    <title>#rn:msg:LIVE_ASSISTANCE_LBL#</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--[if lt IE 9]><script type="text/javascript" src="/euf/core/static/html5.js"></script><![endif]-->
    <rn:theme path="/euf/assets/themes/standard" css="site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
	<link href="/euf/assets/themes/responsive/css/chat_landing.css" rel="stylesheet">
    <rn:head_content/>
    <rn:widget path="utils/ClickjackPrevention"/>
    <rn:widget path="utils/AdvancedSecurityHeaders"/>
    <link rel="icon" href="/euf/assets/images/favicon.png" type="image/png"/>
    <link rel="canonical" href="<?= \RightNow\Utils\Url::getShortEufAppUrl('sameAsCurrentPage', 'chat/chat_landing') ?>"/>
	
</head>
<body class="yui-skin-sam yui3-skin-sam">
    <h1 class="rn_ScreenReaderOnly">#rn:msg:LIVE_ASSISTANCE_LBL#</h1>
    <rn:widget path="utils/CapabilityDetector"/>
    <!--<rn:widget path="chat/ChatVideoChat" />-->
    <div id="rn_ChatContainer">
        <div id="rn_PageContent" class="rn_Live">
            <div class="rn_Padding">
			<!--<rn:widget path="custom/ResponsiveDesign/FocusChatOnResponse" />-->
                <rn:widget path="chat/ChatOffTheRecordDialog"/>
                    <div id="rn_ChatDialogContainer">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitleLogo" class="rn_FloatLeft"><img src="/euf/assets/themes/responsive/images/logo.png"></div>
                        <div id="rn_ChatDialogHeaderButtonContainer">
                            <rn:widget path="chat/ChatSoundButton"/>
                            <!--<rn:widget path="chat/ChatPrintButton"/>-->
                            
                            <rn:widget path="chat/ChatDisconnectButton" label_close="" close_icon_path="/euf/assets/themes/responsive/images/chat_close.png" disconnect_icon_path=""/>
                        </div>
                    </div>
					<rn:widget path="utils/CobrowsePremium" />
					<rn:widget path="chat/ChatCobrowsePremium" />
					<div id="rn_ChatDialogTitle" class="rn_FloatLeft">Merci d'avoir contacté Beachbody Chat<!--#rn:msg:CHAT_LBL#--></div>
                    <rn:widget path="chat/ChatServerConnect" email_required="true"  label_prevent_anonymous_chat="Email Address is required"/>
                    <rn:widget path="chat/ChatEngagementStatus"/>
                    <rn:widget path="custom/ResponsiveDesign/OverridedChatQueueWaitTime"/>
                    <div id="rn_VirtualAssistantContainer">
                        <rn:widget path="chat/VirtualAssistantAvatar"/>
                        <rn:widget path="chat/VirtualAssistantBanner"/>
                    </div>
                    <rn:widget path="chat/ChatAgentStatus"/>
                    <div id="rn_TranscriptContainer">
                        <div id="rn_ChatTranscript">
                            <rn:widget path="custom/ResponsiveDesign/Transcript" label_enduser_name_default_prefix="" agent_message_icon_path="" enduser_message_icon_path=""/>
							 <!--<rn:widget path="chat/ChatTranscript"/>-->
                        </div>
                        <!--<div id="rn_ChatQueueSearchContainer">
                            <rn:widget path="chat/ChatQueueSearch" popup_window="true" /> 
                        </div>-->
					<input type="hidden" id="interval_id" value="0"/>
                    </div>
                    <div id="rn_PreChatButtonContainer">
                        <rn:widget path="chat/ChatCancelButton"/>
                        <!--<rn:widget path="chat/ChatRequestEmailResponseButton"/>-->
                    </div>
					<!--<rn:widget path="chat/ChatPostMessage" initial_focus="true" label_send_instructions="Type your message here..." focus_on_incoming_messages="true"/>-->
                    <rn:widget path="custom/ResponsiveDesign/ChatPostMessageFocus" initial_focus="false" label_send_instructions="Type your message here..." focus_on_incoming_messages="true"/>
                    <div id="rn_InChatButtonContainer">
					<div class="print_button">
					<!--<rn:widget path="chat/ChatPrintButton" label_print="Print this chat" print_icon_path="/euf/assets/themes/responsive/images/print_chat_transcript.PNG"/>-->
					</div>
					<ul class="list_main">
						<li class="list_sub">
                        <rn:widget path="chat/ChatSendButton"/>
						</li>
						<li class="list_sub">
                        <rn:widget path="chat/ChatAttachFileButton"/>
						</li>
						<li class="list_sub">
						<!--<rn:widget path="chat/ChatOffTheRecordButton" off_the_record_icon_path="/euf/assets/themes/responsive/images/off_the_record.PNG"/>-->
						</li>
					</ul>
                    </div>
                    <!--<rn:widget path="chat/VirtualAssistantSimilarMatches"/>
                    <rn:widget path="chat/VirtualAssistantFeedback"/>-->
                </div>
            </div>
        </div>
        <div id="rn_ChatFooter">
            <div class="rn_FloatRight">
                <!--<rn:widget path="utils/OracleLogo"/>-->
            </div>
        </div>
    </div>
</body>
</html>
