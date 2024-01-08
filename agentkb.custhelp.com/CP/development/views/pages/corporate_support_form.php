<rn:meta title="Corporate Support Form" template="standardhome.php" clickstream="incident_create"/> 

<h2><div id="rn_PageTitle" class="rn_LiveHelp">Corporate Support Form<br/>
  <br/>
</div>
</h2>
<div id="rn_PageContent" class="rn_Live">
  <div class="rn_Padding" >
    <form id="rn_QuestionSubmit" method="post" action="">
      <div id="rn_ErrorLocation"></div>
	  <h2>Requestor's Information</h2>
	  
	   <rn:widget path="input/FormInput" name="Incident.c$agent_teamleader_name" label_input="Agent/Team Leader Name"  initial_focus="true" required="true" />
	   
      <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" label_input="#rn:msg:EMAIL_ADDR_LBL#"  required="false"/> 
	  
		<rn:widget path="input/FormInput" name="Incident.c$agent_teamleader_id" label_input="Agent/Team Leader ID"  initial_focus="true" required="true" />
		
		<rn:widget path="input/FormInput" name="Incident.c$teamleader_supervisor_name" label_input="Team Leader/Supervisor Name"  initial_focus="true" required="true" />
				
		<rn:widget path="input/FormInput" name="Incident.c$location" label_input="Site"  initial_focus="true" required="true" />	
							
		<rn:widget path="input/FormInput" name="Incident.c$agent_team" label_input="Team"  initial_focus="true" required="false" />	
			
		<rn:widget path="input/FormInput" name="Incident.c$high_priority" label_input="High Priority"  initial_focus="true" required="false" />		
 			
		<rn:widget path="input/FormInput" name="Incident.c$multiple_contacts" label_input="2nd or More Contact on Same Issue?"  initial_focus="true" required="false" />	
 			
		<rn:widget path="input/FormInput" name="Incident.c$original_call_driver" label_input="Original Call Driver"  initial_focus="true" required="false" />			
 		  <h2>Customer Information</h2>	
		<rn:widget path="input/FormInput" name="Incident.c$customer_name" label_input="Customer Name"  initial_focus="true" required="false" />
					
 		<rn:widget path="custom/input/CustomSelectionRadio" name="Incident.c$pc_coach" label_input="Coach"  initial_focus="true" required="false" />
		
		<div id = "coach_id" style="display:none">				
 		<rn:widget path="custom/input/TextInputSubscribe" name="Incident.c$coachcustomernumber" label_input="Coach ID or Customer #"  initial_focus="true" required="false" />			
		</div>
		
 		<rn:widget path="input/FormInput" name="Incident.c$orderno" label_input="Order #" initial_focus="true" required="true" />			
		
 		<rn:widget path="input/FormInput" name="Incident.c$best_contact_time" label_input="Best Time to Contact" initial_focus="true" required="false" />			
		
        <div class="rn_Grid">
        <table> 
		
		<rn:widget path="custom/input/SelectRequestType" name="Incident.c$request_type_corp_support" label_input="Request Type"  initial_focus="true" required="true" />	
		
		<div id="escalate" style="display:none">							
		<rn:widget path="custom/input/RequestTypeSubscribe" name="Incident.c$corporate_escalation_reason" label_input="Corporate Escalation Reason"  initial_focus="true" required="false" />	
		</div>				
		
		<div id="office" style="display:none">			
		<rn:widget path="custom/input/RequestTypeSubscribe" name="Incident.c$financial_back_office_reason" label_input="Financial Back Office Reason"  initial_focus="true" required="false"  />
		</div>
			 <rn:widget path="input/FormInput" name="Incident.Threads" label_input="Details of Request (Please be specific)"/>
				
		</table>
		</div>
		  <div id="routing" style="display:none">
            <rn:widget path="input/FormInput" name="Incident.CustomFields.c.form_routing" default_value = "608"/>
			 <rn:widget path="input/TextInputSubscribe" name="Incident.Subject" label_input="#rn:msg:SUBJECT_LBL#"/>	
            </div>		
	  <div id="submit">
      <rn:widget path="input/FormSubmit" lab3l_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/corporate_support_confirm" error_location="rn_ErrorLocation"/></div>
      <!--<rn:widget path="input/SmartAssistantDialog"/>
      <rn:widget path="custom/input/custom_SmartAssistantdialogsp" solved_url="/app/home/lob/#rn:php:$tabval#"/>-->
	  					
	</form>
  </div>

