<rn:meta javascript_module="mobile" title="#rn:msg:LIVE_CHAT_LBL#" template="mobile.php" clickstream="chat_landing" include_chat="true"/>

<!--BEGIN QUALTRICS SITE INTERCEPT-->
<script type='text/javascript'>
(function(){var g=function(e,h,f,g){
this.get=function(a){for(var a=a+"=",c=document.cookie.split(";"),b=0,e=c.length;b<e;b++){for(var d=c[b];" "==d.charAt(0);)d=d.substring(1,d.length);if(0==d.indexOf(a))return d.substring(a.length,d.length)}return null};
this.set=function(a,c){var b="",b=new Date;b.setTime(b.getTime()+6048E5);b="; expires="+b.toGMTString();document.cookie=a+"="+c+b+"; path=/; "};
this.check=function(){var a=this.get(f);if(a)a=a.split(":");else if(100!=e)"v"==h&&(e=Math.random()>=e/100?0:100),a=[h,e,0],this.set(f,a.join(":"));else return!0;var c=a[1];if(100==c)return!0;switch(a[0]){case "v":return!1;case "r":return c=a[2]%Math.floor(100/c),a[2]++,this.set(f,a.join(":")),!c}return!0};
this.go=function(){if(this.check()){var a=document.createElement("script");a.type="text/javascript";a.src=g+ "&t=" + (new Date()).getTime();document.body&&document.body.appendChild(a)}};
this.start=function(){var a=this;window.addEventListener?window.addEventListener("load",function(){a.go()},!1):window.attachEvent&&window.attachEvent("onload",function(){a.go()})}};
try{(new g(100,"r","QSI_S_SI_3vzO7NBJ5pNfH93","//zn02tnlhs4ure0pjl-gogo.siteintercept.qualtrics.com/WRSiteInterceptEngine/?Q_SIID=SI_3vzO7NBJ5pNfH93&Q_LOC="+encodeURIComponent(window.location.href))).start()}catch(i){}})();
</script><div id='SI_3vzO7NBJ5pNfH93'><!--DO NOT REMOVE-CONTENTS PLACED HERE--></div>
<!--END SITE INTERCEPT-->

<!DOCTYPE html>
<html lang="#rn:language_code#">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; minimum-scale=1.0; maximum-scale=1.0; user-scalable=no;"/>
<meta charset="utf-8"/>
<title>#rn:msg:LIVE_ASSISTANCE_LBL#</title>
<rn:theme path="/euf/assets/themes/mobile" css="site.css"/>
<rn:head_content/>
<link rel="icon" href="images/favicon.png" type="image/png">
</head>
<body>
<noscript>
<h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
</noscript>
<div class="rn_MobileLand">
  <div class="rn_FloatLeft rn_FloatLeftAdjust">
    <ul>
      <li>
        <rn:widget path="chat/ChatEngagementStatus" label_status_prefix=""/>
      </li>
    </ul>
  </div>
  <div class="rn_FloatRight rn_FloatRightAdjust">
    <rn:widget path="chat/ChatDisconnectButton"
                        close_icon_path=""
                        disconnect_icon_path=""
                        mobile_mode="true" label_disconnect="End Session"/>
  </div>
  <div class="rn_FloatRight rn_Search">
    <rn:widget path="chat/ChatCancelButton"/>
  </div>
</div>
<div id="rn_ChatContainer" role="main">
  <div id="rn_PageContent" class="rn_Live">
    <div id="rn_ChatDialogContainer">
      <rn:widget path="chat/ChatServerConnect"/>
      <!-- <rn:widget path="chat/ChatEngagementStatus"/>-->
      <rn:widget path="chat/ChatQueueWaitTime"/>
      <rn:widget path="custom/chat/ChatAgentStatusCustom"/>
      <rn:widget path="custom/chat/ChatTranscriptCustom" mobile_mode="false"/>
      <div id="rn_PreChatButtonContainer">
        <rn:widget path="chat/ChatRequestEmailResponseButton"/>
      </div>
      <rn:widget path="chat/ChatPostMessage" label_send_instructions="#rn:msg:TYPE_YOUR_MESSAGE_AND_SEND_LBL#" mobile_mode="true"/>
      <div id="rn_InChatButtonContainer">
        <rn:widget path="chat/ChatSendButton" label_send="Submit"/>
      </div>
    </div>
  </div>
</div>
