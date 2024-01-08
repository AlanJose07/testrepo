<head>
<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>
<style>

/*vv 25-4-17*/
    
/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,900&subset=cyrillic,cyrillic-ext');*/
    
@import url('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700&subset=cyrillic,cyrillic-ext');
    
*, p{
    /*font-family: 'Roboto', sans-serif !important;*/
    font-family: 'Open Sans Condensed', sans-serif;
}
    
.inner_container_agent_1, .inner_container_agent_2, .inner_container_agent_3 {
    float: left;
    width: 100%;    
    margin-bottom: 20px;
}
    
    .inner_container_agent_1 label, .inner_container_agent_2 label, #rn_CustomTextInput_12 label, .inner_container_agent_3 label{
        border:0px !important;
    }

.inner_container_agent_1 > div, .inner_container_agent_2 > b > b > div{
    float: left;
    width: 25%;
    display: inline-block;
    clear: none;
    padding-right: 10px;
    box-sizing: border-box;
}

.inner_container_agent_1 > div label, .inner_container_agent_1 > div input, .inner_container_agent_1 > div select,
.inner_container_agent_2 > b > b > div label, .inner_container_agent_2 > b > b > div input, .inner_container_agent_2 > b > b > div select, .inner_container_agent_3 div input, .inner_container_agent_3 select{
    width:100% !important;
    float:left;
    box-sizing: border-box;
    font-size: 12px;
}
    
.inner_container_agent_1 > div input, .inner_container_agent_1 > div select, .inner_container_agent_2 > b > b > div input, .inner_container_agent_2 > b > b > div select, .inner_container_agent_3 input, inner_container_agent_3 slect{
    height: 29px !important;
    border: 1px solid #d1d1d1;
    outline: none !important;
    
}
    
.inner_container_agent_1 .rn_CustomTextInput.rn_TextInput:first-child {
    width: 18%;
}
.inner_container_agent_1 div:nth-child(2) {
    width: 32% !important;
}

#rn_CustomTextInput_12{
    width:100%;
    float:left;
}

#rn_CustomTextInput_12 label, #rn_CustomTextInput_12 textarea{
    width:100%;
    float:left;
    border: 1px solid #d1d1d1;
    outline: none !important;
}

.inner_container_agent_1 div:last-child, .inner_container_agent_2 > b > b div:last-child{
    margin-right:0;
}

label.heading{
    width:100%;
    float:left;
}

    
    .main_heading{
        font-size: 26px;
        font-family: 'Open Sans Condensed', sans-serif;
    }
    .sub_heading, p{
        font-size: 16px;
        font-weight: 400;
    }
    .italic{
        font-style: italic;
    }
    label {
        font-size: 13px !important;
        font-weight: 600 !important;
        margin-bottom: 4px !important;
    }
    .referane_main{
        margin: 12px 0;
        float: left;
        width: 100%;
    }
    
    input[type=submit], button {
        background: #d85427;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 0px;
        padding: 7px 21px;
        text-shadow: none;
    } 
    
    option {
        font-size: 14px;
    }
    #rn_Footer{
        box-shadow: none !important;
    }
    .inner_container_agent_3 div{
        float: left;
    display: inline-block;
    clear: none;
    padding-right: 10px;
    box-sizing: border-box;
    }
    
    .inner_container_agent_3 div:nth-child(1){
        width:20%;
    }
    .inner_container_agent_3 div:nth-child(2){
        width: 40%;
    }
    .inner_container_agent_3 div:nth-child(3){
        width:40%;
    }
    
    @media screen and (max-width:720px) and (min-width:230px){
        .inner_container_agent_1 > div, .inner_container_agent_2 > b > b > div, .inner_container_agent_3 div{
            width:100%;
        }
        
        .inner_container_agent_1 .rn_CustomTextInput.rn_TextInput:first-child, .inner_container_agent_1 div:nth-child(2){
            width:50% !important;
        }
        #rn_MainColumn, #rn_Footer, #rn_Body, #rn_Container{
            width:100%;
        }
    }
    
/*vv 25-4-17 end*/
 
.inner_container_agent_1 div:nth-child(2) {
    width: 25% !important;
}

    
</style>
<!--Nithin- Comment out message -->
<!--<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
</div>-->
<!--Nithin- Comment out message ends here -->
</head>

<?php 
try{
	throw new Exception("The field is undefined.sorry"); 
}
catch(Exception $err){
	 
	//echo $err->getMessage();
	$message=$err->getMessage()."\n";
	error_log($message,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_log_'.date('d-m-Y-H-i-s').'_log.txt');
}
?>



<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="rn_QuestionSubmit" method="post" action="">
            <div id="rn_ErrorLocation"></div>
			<br><br><label><FONT size=4 color="black">
			<!--<b>Contact Information<b>-->
			<h4 class="main_heading">#rn:msg:ASK_QUESTION_HDG#<h4>
			<p class="sub_heading">This form is to be used by Escalation Agents or TLs only</p>
			</font></label>		
			<span style="VISIBILITY:hidden;display:none">
                  <!--  <rn:widget path="custom/input/samanth/TextInput" name="Contact.Emails.PRIMARY.Address" default_value="generic_agent@yahoo.com"/> may 15
					 <rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" default_value="generic_agent@yahoo.com"/>-->
					
			</span>
				 
			<!--<rn:widget path="input/FormInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Your Full Name" initial_focus="true"/>
			<rn:widget path="input/FormInput" name="Incident.CustomFields.c.location"   />-->
            <div class="inner_container_agent_1">
			
			<!--<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Agent ID" initial_focus ="true" /> may15 -->
			
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.submitter" required="true" label_input="Agent ID" initial_focus ="true" />
			
			
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.role" required="true" label_input="Role"/>
			
			<!--sriram-->
			<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" required="true"  hide_hint="true"   label_input="Email Address"/>
			<!--sriram -->
			<!--added by sriram-->
			<!--<rn:widget path="input/TextInput" name="Incident.CustomFields.c.answer_feedback_email_address" required="true"  hide_hint="true"   label_input="Email Address"/>-->
			<!--added by sriram-->
			
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.location" required="true" label_input="Location"/>
			 
			
			<!--<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.Subject"  hide_hint="true"   label_input="subject"/>	-->
	 	    	<div style="display: none">
	 	    	<rn:widget path="input/TextInput" name="Incident.Subject"  hide_hint="true"   label_input="subject"/>
	 	    	</div>
	 	    </div>
            <div class="inner_container_agent_2"><label><FONT size=4 color="black">
			<b>Details<b>
			</font></label>
			<p class="italic">Please answer all of the following questions to ensure your request is completed</p><br>
			
	       <!--	<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.faq_kb_number" required="true" label_input="FAQ/KB#"/> may 15-->
		   
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.faq_kb_number" required="true" label_input="KB#"/>
			
			
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.category" required="true" label_input="Category"/>
			<rn:widget path="custom/input/samanth/CustomSelectionInput" name="Incident.CustomFields.c.type" required="true" label_input="Type"/>
			
			<!--<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.CustomFields.c.associated_articles" label_input="Associated Articles"/>-->
			<div id="articles" style="display:none">
			<rn:widget path="input/TextInput" name="Incident.CustomFields.c.associated_articles" label_input="Associated Articles"/>
               </div> 
                </div>
			<!--<rn:widget path="custom/input/samanth/CustomTextInput" name="Incident.Threads" label_input="Please provide any additional information to help us understand your feedback"/>-->
			
			<rn:widget path="input/TextInput" name="Incident.Threads" label_input="Please provide any additional information to help us understand your feedback"/> 
			
			
			
			<label><FONT size=4 color="black">
			<b class="referane_main">Reference Information<b>
			</font></label>
			<p class="italic">The info provided in this section is for reference ONLY to help us replicate any issues or instances where process doesn't match the system.The publishing team will not perform any follow-up.Any pending issues or requests for call-backs should be escalated to Corporate Escalations for tracking.</p>
            <div class="inner_container_agent_3">
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
			
            </div>
    		<!--<rn:widget path="input/FormInput" name="Incident.CustomFields.c.cvtemailaddress" label_input="Email Address"/>-->
            <rn:widget path="custom/input/CustomFileAttachmentUpload"/>
            <p class="italic">Please provide any screenshots if available</p>
			<!--Nithin - Comment out widgets -->
                <!--<rn:widget path="input/ProductCategoryInput"/>
                <rn:widget path="input/ProductCategoryInput" data_type="Category"/>
                <rn:widget path="input/CustomAllInput" table="Incident"/>-->
			<!--Nithin - Comment out widgets ends here -->
             
             
              <!--<rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>-->
              <rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>

             <!-- <rn:condition answers_viewed="2" searches_done="1">
             <rn:condition_else/>
            			<rn:widget path="input/SmartAssistantDialog" />
              </rn:condition>-->
        </form>
		<script>
			document.getElementsByName("Incident.CustomFields.c.faq_kb_number")[0].addEventListener("blur", BlurFunction, true);
			function BlurFunction() {
				var x = document.getElementsByName("Incident.CustomFields.c.faq_kb_number")[0].value;
				document.getElementsByName("Incident.Subject")[0].value = "Feedback: "+x;	
			}
			document.getElementsById								
		</script>
    </div>
</div>
