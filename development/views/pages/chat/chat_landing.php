<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_landing" javascript_module="standard" include_chat="true"/>
<rn:widget path="custom/input/GetContact"/>

<?php
$ref=@$_SERVER[HTTP_REFERER];
if(strpos($ref,"/app/chat/chat_launch")== FALSE)
	{
		header("Location:https:/app/chat/chat_launch");
	}
?>
<!--<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta clickstream="chat_landing" javascript_module="standard" include_chat="true"/>
<head>
<meta charset="utf-8"/>
<title>#rn:msg:LIVE_ASSISTANCE_LBL#</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script type="text/javascript" src="/euf/core/static/html5.js"></script><![endif]-->
<!--<rn:theme path="/euf/assets/themes/standard" css="site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
<rn:head_content/>
<link rel="icon" href="images/favicon.png" type="image/png"/>
</head>-->

<!--Qualtrics intercept here-->


<script src="/euf/assets/js/jquery.min.js" type="text/javascript"></script>
<div class="chat_land" style="margin: 15px 0 0 -15px; overflow:hidden;">
<body class="yui-skin-sam yui3-skin-sam">
<div class="top_section">
  <div class="lists">
    <ul>
      <li>
        <!--Live help chat session -->
        <rn:widget path="chat/ChatEngagementStatus" label_status_prefix="" label_detail_searching="Searching For An Available Agent"/>
      </li>
    </ul>
  </div>
 <div class="end_session End_New">
<!--      
<rn:widget path="custom/chat/ChatDisconnectButtonCustom" disconnect_icon_path="images/btn_endssn.png" close_icon_path ="images/chat_close.png" label_disconnect=" " label_close="Close"/>-->
<div class="right">
<rn:widget path="custom/chat/CustomChatDisconnectButton"  disconnect_icon_path="images/btn_endssn.png" close_icon_path ="images/chat_close.png" open_in_window="parent_window" label_disconnect=" " label_close="Close"/>
</div>
  </div>
</div>
<div class="rn_gogo_chatland">
  <div id="waitingmessage" class="waitingmessage"></div>
  <div id="rn_ChatDialogContainer" class="chat_dialog">
    <rn:widget path="chat/ChatOffTheRecordDialog"/>
    <div id="rn_ChatDialogHeaderContainer">
      <div id="gogo_chatlogo">
        <rn:widget path="custom/chat/CustomChatQueueWaitTime" type="estimated"/>
        <div id="rn_ChatDialogTitle" class="rn_FloatLeft"></div>
        <div id="rn_ChatDialogHeaderButtonContainer">
          <rn:widget path="chat/ChatCoBrowseButton"/>
        </div>
        <div id="chatid">
       
        </div>
      </div>
      <rn:widget path="chat/ChatServerConnect"/>
      <?php 
			 /* For ChatTranscript widget customization*/
			  ?>
              <div style="display:none" id="rn_session">
              <?php
              $curr_session = $this->session->getSessionData('sessionID');
			  echo $curr_session;
			  ?>
              </div>
              
              <div style="display:none" id="rn_email">
              <?php
              $email=$_REQUEST['Contact_Emails_PRIMARY_Address'];
			  echo $email;
			  ?>
              </div>
              <br>
              <!--To check the network connectivity issue-->
			
      <rn:widget path="custom/chat/ChatTranscriptCustom" agent_message_icon_path="" />
       <input type="hidden" value= "<?php echo $curr_session ?>" id="hiddensid" name="hiddensid"/>
      <!--<div id="rn_PreChatButtonContainer">
        <rn:widget path="chat/ChatRequestEmailResponseButton"/>
      </div> -->
      <rn:widget path="standard/chat/ChatPostMessage" label_send_instructions=""/>
      <div align="right" class="button_main_container">
	  <?php 
	  if($flgtNo=="CPA"){?>
       <rn:widget path="custom/chat/ChatAgentStatusCustom" agent_icon_path=""/>
	   <? } ?>
      
      </div>
	   <?php if($flgtNo!="CPA"){?>
      <div>
	  
        <rn:widget path="custom/chat/ChatAgentStatusCustom" agent_icon_path="" />
		
      </div>
	   <? } ?>
	     <rn:widget path="chat/ChatSendButton" label_send="Send"/>
    </div>
  </div>
</div>
<!--
<br>
<br>
<?php
if($flgtNo=="CPA" && $clang="de_DE" && getUrlParm('ge')==1)  {  
	   ?>
<h2 style="color:#ccc; margin-left:20px;">Ähnliche FAQs</h2>
<?php }
else if($flgtNo=="CPA" && $clang="ko_KR" && getUrlParm('ko')==1)  {  
	   ?>
<h2 style="color:#ccc; margin-left:20px;">관련된 자주 묻는 질문</h2>
<?php }
else{
?>
<h2 style="font-size:20px; margin-left:20px;">Related FAQ's</h2>
<?php }?>
<div id="wrap" class="rn_gogo_chatrelated">
  <div id="hide_show">
    <?php
 /*Multiline widget customization*/
 	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];
	//mkt remove
	//$flgtNo = "AAL";
	if($clang=="ko_KR" && $flgtNo=="DAL")
		$flight = 102787;
	elseif($clang=="ko_KR" && $flgtNo=="CPA" && (getUrlParm('ko')==1))
		$flight = 105638;
	elseif($clang=="de_DE" && $flgtNo=="CPA" && (getUrlParm('ge')==1))
		$flight = 105637;
	elseif($clang=="en_US" && $flgtNo=="CPA")
		$flight = 105643;
    elseif($flgtNo=="ACA")
		$flight = 100760;
	elseif($flgtNo=="ASA")
		$flight = 100761;
	elseif($flgtNo=="AAL")
		//$flight = 100762;
		$flight = 107700;
	elseif($flgtNo=="AMX")
		$flight = 101147;	
	elseif($flgtNo=="AWE")
		$flight = 100763;
	elseif($flgtNo=="BAW")
		$flight = 102580;
	elseif($flgtNo=="DAL")
		$flight = 100764;
	elseif($flgtNo=="ROU")
		$flight = 102539;	
	elseif($flgtNo=="JAL")
		$flight = 100765;
	elseif($flgtNo=="JTA")
		$flight = 102630;
	elseif($flgtNo=="RXA")
		$flight = 107850;
	elseif($flgtNo=="TRS")
		$flight = 100766;
	elseif($flgtNo=="UAL")
		$flight = 100767;
	elseif($flgtNo=="VRD")
		$flight = 100768;
	elseif($flgtNo=="VOZ")
		$flight = 102629;
	elseif($flgtNo=="VIR")
		$flight = 101228;
	elseif($flgtNo=="GLO")
		$flight = 102422;
	elseif($flgtNo=="TAM")
		$flight = 103028;		
	elseif (strpos($flgtNo,'G3') !== false)
		$flight = 102523;
	elseif($flgtNo=="null")
		$flight = 100769;							
	else
		$flight = 100003;
?>
    <rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="#rn:php:$flight#" per_page="10"/>
  </div>
</div>-->
</div> 
