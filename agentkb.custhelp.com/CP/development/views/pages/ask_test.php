<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>

<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
</div>
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="rn_QuestionSubmit" method="post" action="/ci/ajaxRequest/sendForm">
            <div id="rn_ErrorLocation"></div>
            <br><br><label><FONT size=4 color="black">
				<span style="VISIBILITY:hidden;display:none">
                  <!--  <rn:widget path="custom/input/samanth/TextInput" name="Contact.Emails.PRIMARY.Address" default_value="generic_agent@yahoo.com"/> may 15-->
					 <rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" default_value="generic_agent@yahoo.com"/>
					
				</span>


                
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
                <rn:widget path="input/FormInput" name="Incident.Threads" required="false" label_input="#rn:msg:QUESTION_LBL#"/>
           
                
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Agent ID" initial_focus ="true" />
			
			
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.role" required="true" label_input="Role"/>
			
			
			<rn:widget path="input/TextInput" name="Contact.CustomFields.c.email_address" required="true"  hide_hint="true"   label_input="Email Address"/>
			
			
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.location" required="true" label_input="Location"/>
			 

				<div class="inner_container_agent_2"><label><FONT size=4 color="black">
			<b>Details<b>
			</font></label>
			<p class="italic">Please answer all of the following questions to ensure your request is completed</p><br>
			
	       <!--	<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.faq_kb_number" required="true" label_input="FAQ/KB#"/> may 15-->
		   
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.faq_kb_number" required="true" label_input="KB#"/>
			
			
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.category" required="true" label_input="Category"/>
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.type" required="true" label_input="Type"/>
			
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.associated_articles" label_input="Associated Articles"/>
			
			<!--<rn:widget path="input/TextInput" name="Incident.CustomFields.c.associated_articles" label_input="Associated Articles"/>-->
                
            </div>
            <rn:widget path="input/FormInput" name="Incident.Threads" label_input="Please provide any additional information to help us understand your feedback"/>
               <!-- <rn:widget path="input/FileAttachmentUpload"/>
                <rn:widget path="input/ProductCategoryInput"/>
                <rn:widget path="input/ProductCategoryInput" data_type="Category"/>
                <rn:widget path="input/CustomAllInput" table="Incident"/>
                <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>
                <rn:condition answers_viewed="2" searches_done="1">
                <rn:condition_else/>
                    <rn:widget path="input/SmartAssistantDialog"/>
                </rn:condition>
        -->
        <label><FONT size=4 color="black">
			<b class="referane_main">Reference Information<b>
			</font></label>
			<p class="italic">The info provided in this section is for reference ONLY to help us replicate any issues or instances where process doesn't match the system.The publishing team will not perform any follow-up.Any pending issues or requests for call-backs should be escalated to Corporate Escalations for tracking.</p>
            <div class="inner_container_agent_3">
			<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.member_type_new" hide_on_load="true" label_input="Consumer Type"/>
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.coachidno" label_input="Coach ID/Customer Number"/> 
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.orderno" label_input="Order Number"/>
        
        	<p class="italic">Please provide any screenshots if available</p>
        	             <rn:condition answers_viewed="2" searches_done="1">
             <rn:condition_else/>
            <!-- <rn:widget path="input/SmartAssistantDialog" label_cancel_button="#rn:msg:EDIT_QUESTION_CMD#" label_solved_button="#rn:msg:MY_QUESTION_IS_ANSWERED_MSG#" display_answers_inline="true" label_accesskey="<span class='rn_ScreenReaderOnly'>#rn:msg:PREFER_KEYBOARD_PCT_S_PLUS_1_PCT_D_LBL#</span>" label_prompt="#rn:msg:FLLOWING_ANS_HELP_IMMEDIATELY_MSG#" display_button_as_link="label_cancel_button" dialog_width="800px"/>-->
			<rn:widget path="input/SmartAssistantDialog" />
              </rn:condition>
        	
        <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>
			
		</form>
		
</div>
</div>