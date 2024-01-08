<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>



<div id="rn_PageTitle" class="rn_AskQuestion">
  
	<h2>#rn:msg:SUBMIT_YOUR_QUESTION_CMD#</h2>

</div>
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="rn_QuestionSubmit" method="post" action="/ci/ajaxRequest/sendForm">
            <div id="rn_ErrorLocation"></div>
         <!--   <rn:condition logged_in="false"> -->
				<!-- Anuj Feb 17, 2014 -- CP3 Migration -- Email search customization -->
                <rn:widget path="input/ContactEmailCheck1" name="Contact.Emails.PRIMARY.Address" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#" existing_contact_check_ajax="/ci/ajax/widget" event_trigger="onkeypress" required="true"/>
				
			<!-- Removed for Version upgrade	<rn:widget path="input/TextIO" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" hidden="true" editable="false" required="true"/>
				<rn:widget path="input/TextIO" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" hidden="true" editable="false" required="true"/> -->
				<!-- Anuj -- end -->
                <rn:widget path="input/SelectionInputAAQ" name="Incident.CustomFields.c.member_type" required="true"/>
				<div id="shoehide" style="display:none">
                <rn:widget path="custom/input/customFormInput" name="Incident.CustomFields.c.coachcustomernumber" required="false"/> 
                 <rn:widget path="input/SelectionInputAAQ" name="Incident.CustomFields.c.coach_request_type" required="true"/></div>
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
				<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
                <rn:widget path="input/FileAttachmentUpload"/>      
                <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>
                <rn:widget path="input/SmartAssistantDialog"/>
<!--            </rn:condition>
            <rn:condition logged_in="true">
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
            </rn:condition>
                <rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
                <rn:widget path="input/FileAttachmentUpload"/>
                <rn:widget path="input/ProductCategoryInput"/>
                <rn:widget path="input/ProductCategoryInput" data_type="Category"/>
                <rn:widget path="input/CustomAllInput" table="Incident"/>
                <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>
                <rn:condition answers_viewed="2" searches_done="1">
                <rn:condition_else/>
                    <rn:widget path="input/SmartAssistantDialog"/>
                </rn:condition>  -->
        </form>
    </div>
</div>
