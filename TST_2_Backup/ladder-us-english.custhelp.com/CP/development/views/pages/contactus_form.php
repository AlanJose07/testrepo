<head>

<rn:meta title="Contact Us" template="standard_responsive_bb.php" clickstream="openfit_request"/>
<!-- login_required="true" -->
<style>
	 .rn_TextInput .rn_TextArea{
	 	width: 100% !important;
	 	    border-radius: 5px;
    border: 1px solid #8c8989;
	 }
	 .form_section input{
	 	width: 100% !important;
	 	    border-radius: 5px;
    border: 1px solid #8c8989;
	 }
		#file-upload input[type="file"] {
    border: 1px solid #8c8989 !important;
	}
	#file-upload label {
    margin-left: 0px !important;
	color: #333 !important;
	}
	 @media screen and (max-width: 768px){
#file-upload input {
	left: 0px !important;
    width: 100%;
}
}
h2.ccc_title {
    font-size: 32px !important;
    color: #333 !important;
}
</style>
	</head>


<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
		<div id="rn_content" class="rn_questionform">
            <div id="title_support" class="main_inner_top_heading">
                
            </div>

            <div class="container">
			<div class="row" style="display: flex;">
				<div class="col-md-6 col-lg-5 col-xs-12 col-sm-12">
					<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;" >
				
					<div style="padding-left: 5px;">
					</div>
					<div id="rn_ErrorLocation_ccc"></div>
					<div class="form_section ccc_begin">
					
					 <h2 class="ccc_title"> Contact Us</h2>
					<br/>
					
						<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
						
       <!-- class="cr_details" -->
							<div id="email_redesign">
							<rn:widget path="custom/ResponsiveDesign/TextInputContactUs" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" allow_external_login_updates="true" required="true"/>
							
							</div>
							<div id="email">
							
							<div id="first_name">
							<rn:widget path="custom/ResponsiveDesign/TextInputContactUs" name="Contact.Name.First" label_input="First Name" allow_external_login_updates="true" required="true"/>
							</div>
							
							<div id="last_name">
							<rn:widget path="custom/ResponsiveDesign/TextInputContactUs" name="Contact.Name.Last" label_input="Last Name" allow_external_login_updates="true" required="true"/>
							</div>
							</div>
							
							<div id="zipcode">
		<rn:widget path="input/TextInput" name="Incident.c$billing_zip_postal_code" label_input="Billing Zip Code" required="true"/>
		</div>
		
		<div id="description" style="display:block">
		<rn:widget path="input/TextInput" name="Incident.Threads"  label_input="Description" required="true"/> 
		</div>
							
		<div id="file-upload">
		<rn:widget path="input/FileAttachmentUpload"/>
		</div>				
					
		
							
							
						
		<div style="display:none">
		<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value=""/>
		<rn:widget path="input/TextInput"  name="Incident.Subject" required="false" default_value="Your MYXfitness Support Request"/>
		</div>
		
		<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/contactus_form_confirm"/>
		
		</div>
	</form>
				</div>
  </div>
</div>
</div>
</div>
		

	
