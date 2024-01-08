<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_request"/>

<div id="rn_PageTitle" class="rn_LiveHelp">
    <h1>#rn:msg:LIVE_HELP_HDG#</h1>
	<div class="rn_mastheadintro">Request a real-time chat with one of our agents. Fill in the fields on this page and click Submit. The next available agent will be with you as soon as possible. Note the hours agents are available.</div>
<!--Modified to show  Description 05-19-2014-->
</div>

<div id="rn_PageContent" class="rn_Live">
    <div class="rn_Padding" >
        <rn:condition chat_available="true">
        <div id="rn_ChatLaunchFormDiv" class="rn_ChatForm">
            <span class="rn_ChatLaunchFormHeader">#rn:msg:CHAT_MEMBER_OUR_SUPPORT_TEAM_LBL#</span>
            <form id="rn_ChatLaunchForm" method="post" action="/app/chat/chat_landing">
                <div id="rn_ErrorLocation"></div>
                <!--<rn:widget path="input/FormInput" name="Incident.Subject" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>--> <!--Modified to hide subject 05-19-2014-->
                <rn:condition config_check="COMMON:intl_nameorder == 1">
                    <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
                    <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
                <rn:condition_else/>
                    <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
                    <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
                </rn:condition>
                <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
                <!-- optional fields -->
                <rn:widget path="input/CustomAllInput" table="Incident" chat_visible_only="true" always_show_mask="false" />
                <br />
				 <!--Modified to show Message 05-19-2014-->
				<P style="width:573px;">You will be assisted by the next available agent. Please know that to securely verify your identity, the agent will ask for the last four digits of your social security number (or Federal Tax ID "EIN" for Coaches with entities, or Social Insurance Number "SIN" for Canadian Coaches.) Your full social security number is held securely at Beachbody and the agent only has visibility of the last four digits to verify your identity and to protect your account from unauthorized access.
</P>
                <rn:widget path="chat/ChatLaunchButton" 
                    error_location="rn_ErrorLocation" 
                    add_params_to_url="q_id,pac,request_source,p,c,survey_send_id,survey_send_delay,survey_comp_id,survey_term_id,chat_data,survey_term_auth,survey_comp_auth,survey_send_auth,i_id"/>
                <br /><br />
            </form>
       </div>
       </rn:condition>
       <rn:widget path="chat/ChatStatus"/>
       <rn:widget path="chat/ChatHours"/>
    </div>
</div>


