
<head>
<style>
.CustCoachMessage{ 
    display: none;    
}
div#title_support {
    position: absolute;
    margin-top: -164px !important;
    color: #fff;
}
.email_coach .rn_Label {
    margin-top: 15px !important;
}
</style>
<rn:meta title="Customer Coach Change" template="standard_responsive_bb.php" clickstream="incident_create" login_required="true"/>
<!-- login_required="true" -->
	</head>
<?php

$contact = get_instance()->model('Contact')->get()->result;
$contact_type = $contact->ContactType->ID;
?>

<? if($contact_type != 1): // Customer ?>

<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
		<div id="rn_content" class="rn_questionform">
            <div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">
                
            </div>

            <div class="container">
			<div class="rn_wrap rn_padding wrappad">
				<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;" >
				
					<div style="padding-left: 5px;">
					</div>
					<div id="rn_ErrorLocation_ccc"></div>
					<div class="form_section ccc_begin">
					
					 <h2 class="ccc_title"> Customer Coach Change Request Form</h2>
					
					<div id="Language_Header_English" style="display:block;">
					<p><strong>
						  Use this form to change your Team Beachbody Coach.<br /><br />
	
						</strong></p>
						</div>
						<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
						
      
						<div id=div_country> <rn:widget path="custom/ccc_form/SelectionInputCountry" name="Contact.Address.Country" label_input="Country" required="true" allow_external_login_updates="true"/></div>
							<!---------------------	 Language Dropdown-------------->
							<div style="display:none">
		                   
							
							<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language" label_input="Language/Idioma/Langue" default_value="751"/>
							</div>
							<div id="email_redesign" class="cr_details">
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" required="false" allow_external_login_updates="true" required="true"/>
							</div>
							
							<!-----------------Coach or Customer Dropdown-------------->
							
							<div id="coach_or_customer_english_redesign" style="display:block">
							<rn:widget path="custom/ccc_form/SelectionInputLanguage" name="Incident.CustomFields.c.member_type_eng" required="true" label_input="Do you have a Coach referral?"/>
							</div>
							<div id = "yes_no_main_div" style = "display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Enter the Coach information of whom you would like to be transferred to: </h2>
							<p>
						<strong style="color:red;">
						Note: 
						</strong>
						The Coach entered below will receive credit for orders placed within 14 days of this request. No additional action is required.
						</p>
							
							 <rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_email" label_input ="Coach Email Address" required="false" />
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Coach Name" required="false" /> 
							
							<div style="padding:0px 0px 10px 0px;" id="permissions">						
<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b style="color:#FF0000"> *</b> By checking the box, you are verifying that the Coach information you provided in this form is complete and accurate. Your request may be delayed if incorrect information is received.

</div>

</div>
		
							
							<div id="eng_last_head" style="display:none"><h4>The request will be processed within 2 business days of submission.</h4></div>
						
					   <div style="display:none">
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value="772"/>
					   <rn:widget path="custom/ccc_form/customer_coach_checkbox"  name="Incident.Subject" required="false" default_value="Your Beachbody Customer Coach Change Request"/>
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng" required="false" default_value="754"/>
					   </div>
					   
				<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm"/>
				
				</div>
			</form>
		  </div>
                </div>
		</div>
	</div>
	
<? else: ?>
<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
    <div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
	<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
	This form can only be submitted by a Customer. <br/><br/> Please reference FAQ 2336: Change my Coach for additional details.<br/><br/>If you are a Coach attempting to change your Sponsor, please reference
FAQ 2337: Genealogy - Sponsor Change & Placement Change.

</div></div>


<? endif; ?> 
	
