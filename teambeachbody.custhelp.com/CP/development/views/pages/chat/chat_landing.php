<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta clickstream="chat_landing" javascript_module="standard" include_chat="true"/>
<head>
    <meta charset="utf-8"/>
    <title>#rn:msg:LIVE_ASSISTANCE_LBL#</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--[if lt IE 9]><script type="text/javascript" src="/euf/core/static/html5.js"></script><![endif]-->
    <rn:theme path="/euf/assets/themes/standard" css="site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
    <rn:head_content/>
    <link rel="icon" href="images/favicon.png" type="image/png"/>
</head>
<body class="yui-skin-sam yui3-skin-sam">
    <rn:widget path="utils/CapabilityDetector"/>
    <div id="rn_ChatContainer">
        <div id="rn_PageContent" class="rn_Live">
            <div class="rn_Padding" >
                <rn:widget path="chat/ChatOffTheRecordDialog"/>
                <div id="rn_ChatDialogContainer">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitle" class="rn_FloatLeft">#rn:msg:CHAT_LBL#</div>
                        <div id="rn_ChatDialogHeaderButtonContainer">
                            <rn:widget path="chat/ChatSoundButton"/>
                            <rn:widget path="chat/ChatPrintButton"/>
                            <rn:widget path="chat/ChatOffTheRecordButton"/>
                            <rn:widget path="chat/ChatDisconnectButton"/>
                        </div>
                    </div>
                    <rn:widget path="chat/ChatServerConnect"/>
                    <rn:widget path="chat/ChatEngagementStatus"/>
                    <rn:widget path="chat/ChatQueueWaitTime"/>
                    <rn:widget path="chat/ChatAgentStatus"/>
                    <rn:widget path="chat/ChatTranscript"/>
                    <div id="rn_PreChatButtonContainer">
                        <rn:widget path="chat/ChatCancelButton"/>
                        <rn:widget path="chat/ChatRequestEmailResponseButton"/>
                    </div>
                    <rn:widget path="chat/ChatPostMessage" initial_focus="true"/>
                    <div id="rn_InChatButtonContainer">
                        <rn:widget path="chat/ChatCoBrowseButton"/>
                        <rn:widget path="chat/ChatAttachFileButton"/>
                        <rn:widget path="chat/ChatSendButton"/>
                    </div>
                    <div id="rn_ChatQueueSearchContainer">
                        <rn:widget path="chat/ChatQueueSearch" popup_window="true"/>
                    </div>
                </div>
            </div>
        </div>
        <div id="rn_ChatFooter">
            <div class="rn_FloatRight">
            <!-- Removed for Version upgrade    <rn:widget path="utils/RightNowLogo"/> -->
            </div>
        </div>
    </div>
</body>
</html>
