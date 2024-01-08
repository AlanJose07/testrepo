<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>

<!--Nithin- Comment out message -->
<!--<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
</div>-->
<!--Nithin- Comment out message ends here -->
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="rn_QuestionSubmit" method="post" action="/ci/ajaxRequest/sendForm">
            <div id="rn_ErrorLocation"></div>
			<br><br><label><FONT size=4 color="black">
			<!--<b>Contact Information<b>-->
			<h4>#rn:msg:ASK_QUESTION_HDG#<h4>
			<p>This form is to be used by Escalation Agents or TLs only</p>
			</font></label><br>			
			<span style="VISIBILITY:hidden;display:none">
                    <rn:widget path="custom/input/samanth/TextInput" name="Contact.Emails.PRIMARY.Address" default_value="generic_agent@yahoo.com"/>
			</span>
				 
			<!--<rn:widget path="input/FormInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Your Full Name" initial_focus="true"/>
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.location"   />-->
			<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Agent ID" initial_focus ="true" />
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.role" required="true" label_input="Role"/>
			<rn:widget path="custom/input/samanth/CustomTextInput" name="Contact.CustomFields.c.email_address" required="true" label_input="Email Address"/>
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.location" required="true" label_input="Location"/>
			
				
	 	    <br><br><label><FONT size=4 color="black">
			<b>Details<b>
			</font></label>
			<p>Please answer all of the following questions to ensure your request is completed</p><br>
	       	<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.faq_kb_number" required="true" label_input="FAQ/KB#"/>
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.category" required="true" label_input="Category"/>
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.type" required="true" label_input="Type"/>
			<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.associated_articles" label_input="Associated Articles"/>
			<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.Threads" label_input="Please provide any additional information to help us understand your feedback"/>
			
			<br><br><label><FONT size=4 color="black">
			<b>Reference Information<b>
			</font></label>
			<p>The info provided in this section is for reference ONLY to help us replicate any issues or instances where process doesn't match the system.The publishing team will not perform any follow-up.Any pending issues or requests for call-backs should be escalated to Corporate Escalations for tracking.</p>
			<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.member_type_new" hide_on_load="true" label_input="Consumer Type"/>

			<!-- Nithin- Comment out the login condition -->	 	  
            <!--<rn:condition logged_in="false">
                <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
            </rn:condition>
            <rn:condition logged_in="true">
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
            </rn:condition> -->
			<!-- Nithin- Comment out the login condition ends here -->
			
            <!--<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
		    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.search_words_used"  /> -->
			<!--<br><br><label><FONT size=4 color="black">
		    <b>Coach/Customer Follow-Up (if required)<b>
		    </font></label><br><br>-->
		    
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.coachidno" label_input="Coach ID/Customer Number"/> 
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.orderno" label_input="Order Number"/>
			
    		<!--<rn:widget path="input/FormInput" name="Incident.CustomFields.c.cvtemailaddress" label_input="Email Address"/>-->
            <rn:widget path="custom/input/CustomFileAttachmentUpload"/>
            <p>Please provide any screenshots if available</p>
			<!--Nithin - Comment out widgets -->
                <!--<rn:widget path="input/ProductCategoryInput"/>
                <rn:widget path="input/ProductCategoryInput" data_type="Category"/>
                <rn:widget path="input/CustomAllInput" table="Incident"/>-->
			<!--Nithin - Comment out widgets ends here -->
             <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>
             <rn:condition answers_viewed="2" searches_done="1">
             <rn:condition_else/>
            <!-- <rn:widget path="input/SmartAssistantDialog" label_cancel_button="#rn:msg:EDIT_QUESTION_CMD#" label_solved_button="#rn:msg:MY_QUESTION_IS_ANSWERED_MSG#" display_answers_inline="true" label_accesskey="<span class='rn_ScreenReaderOnly'>#rn:msg:PREFER_KEYBOARD_PCT_S_PLUS_1_PCT_D_LBL#</span>" label_prompt="#rn:msg:FLLOWING_ANS_HELP_IMMEDIATELY_MSG#" display_button_as_link="label_cancel_button" dialog_width="800px"/>-->
			<rn:widget path="input/SmartAssistantDialog" />
              </rn:condition>
        </form>
    </div>
</div>
