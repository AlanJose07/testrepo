<head>

<rn:meta title="GDPR FORM" template="standard_responsive_bb.php" clickstream="incident_create"/>
<style>
select
{
	width: 24.5%;
}
#rn_QuestionSubmit_GDPR
{
	width: 100%;
}
/*.rn_Email {
    height: 28px;
}*/
#terms_conditions
{
	margin-right: 10px;
	margin-top: 15px;
	//margin-bottom: 15px;
}
#terms_link
{
	text-decoration:underline;
	font-weight:bold;
}
.rn_TextInput .rn_Text, .rn_TextInput .rn_Email, .rn_TextInput .rn_Url, .rn_TextInput .rn_TextArea {
    width: 24%;
}
#recaptcha_area{
margin: auto;
}
.rn_CheckBoxGDPR{
margin-right: 83px;
}
.ask-page #rn_QuestionSubmit_GDPR {
    width: 520px;
    margin: 0 auto;
}
.rn_SelectionInput legend, .rn_SelectionInput label, .ask-page #rn_QuestionSubmit_GDPR  .rn_TextInput .rn_Label{
	text-align:left;
}
.ask-page #rn_QuestionSubmit_GDPR select{	
	width:100% !important;
}
.rn_TextInput .rn_Text, .rn_TextInput .rn_Email, .rn_TextInput .rn_Url, .rn_TextInput .rn_TextArea {
    width: 100%;
	box-sizing:border-box;
}
.rn_LiveHelp #title_support {
    font-size: 18px !important; 
    font-weight: normal;
    margin: 0;
    padding: 24px 0 10px 3px;
}
#submit #gdpr_title {
    text-align: left;
    margin-bottom: 5px;
}
.rn_CheckBoxGDPR {
    margin-right: 0;
    text-align: left;
}
.rn_SubmitGDPR.rn_FormSubmit {
    text-align: left;
    margin-top: 11px;
}
a
{
	text-decoration:underline;
	color:#0079C1;
}

/*label[id^="rn_TextGDPR_"][id$="_Label"]{
	display:none;
}*/
.rn_MessageBox {
    background-color: #FFFFE0;
    border: 1px solid #808080;
    color: #990000;
    margin: 10px 0;
    padding: 6px;
}
input[type=submit], button {
  /*background: #0E53A7 url(images/buttonGradientCombo.png) 0px 0px repeat-x;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    border: 1px solid #304764;
    color: #FFF;
    cursor: pointer;
    font: bold 12px Helvetica,Arial,sans-serif;
    line-height: normal;
    margin-right: 6px;
    padding: 6px 8px;
    text-decoration: none;
    text-shadow: 2px 2px 2px rgba(0,0,0,0.25);*/
    background-color: #0D47A1 !important;
    color: #fff !important;
    padding: 4px 17px !important;
    font-size: 14pt !important;
    transition: 0.25s;
    border-radius: 4px;
 }

   
#rn_ErrorLocation_gdpr a
{
	color: red;	
}

select {
    //width: 365px;
    height: 32px;
    padding-left: 7px;
}

</style>

</head>
<!--<header>
<img src="https://www.beachbody.com/images/beachbody/en_us/global/bbv6/beachbody_logo.png" height="50px" width="225px"/>
</header>-->

<div id="rn_PageTitle" class="rn_LiveHelp">
	<div id="title_support" style="display:block; text-align:center;margin-top: 0px;">
		<h2>Data Subject Rights Request Form</h2>
		
	</div>
	<!--<div id="gdpr_instructions">
		Use this form to make specific data account requests. Please fill out all required information accurately. Your request may be declined if incorrect information is received. For answers to frequently asked questions, please visit </span><a href='https://faq.beachbody.com/app/answers/detail/a_id/4644' target='__blank'>FAQ 3436</a>.
	</div>-->
	<!--<div id="call_support">
		Answers to frequently asked questions regarding these requests can be found in <a href="/app/answers/detail/a_id/9909/~/beachbody-support-contact-information/lob/<? echo $tabval; ?>"></a>.
	</div>-->
	<br/>
</div>
<div id="rn_PageContent" class="rn_Live ask-page">
	<div class="rn_Padding" >
		<form id="rn_QuestionSubmit_GDPR" method="post" action="/ci/ajaxCustom/sendFormGDPR">	
			<p style="text-align: justify;">Please use this form to submit requests regarding the data Beachbody has collected and maintains on your account (data subject rights). Please fill out all required information accurately as we will use it to validate your identity. Your request may be delayed or declined if we receive incorrect information.<br/><br/>Answers to frequently asked questions regarding data subject rights may be found in </span><a href='/app/answers/detail/a_id/3436' target='__blank'>FAQ 3436</a>.</p>
			
			<p style="color:red"><b>*Required field</b></p>
			<div id="rn_ErrorLocation_gdpr"></div>
			
			<rn:widget path="custom/input/SelectGDPR" name="Contact.Address.Country" required="true" label_input=" Select Country of Residence"  initial_focus="true" allow_external_login_updates="true"/>
			
			<div id="CountryFields" style="display:none">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$member_type_new" required="true" label_input="Select Member Type"  initial_focus="false" />
				
				<div id="right_type_data" style="display:none;">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_right_type" label_input="Select the Data Subject Right You Wish to Exercise" required="true"/>
				</div>
				<div id="my_object_data" style="display:none; margin-left: 20px;">
					<!--<rn:widget path="custom/input/SelectGDPR" name="Incident.c$object_my_data" required="false" label_input="Select Object Data"  initial_focus="false" />-->
					<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_object_data" required="false" label_input="What would you like to opt out of:"  initial_focus="false" />
				</div>
				<div id="update_object_data" style="display:none">
					<div id="desc_uk" style="display:none;text-align:justify"><span><b>Describe in detail what data you would like to correct in the box below (e.g., updating your address or phone number).<br/></b></span><br/><span style='color:red'><b>DO NOT include any sensitive information (i.e. credit card number, social security or insurance number, bank account number, etc.).</b></span><span><b> To update your payment card information, please go to <a style="text-decoration-line: underline !important;" target='__blank' href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> and click on "Update Credit Card". To update your social security number, social insurance number, tax identification number or bank account information, please read </span><a style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644' target='__blank'>FAQ 4644</a>.</b></div>
					
						<div id="desc" style="display:none;text-align:justify"><span><b>Describe in detail what data you would like to correct in the box below (e.g., updating your address or phone number).<br/></b></span><br/><span style='color:red'><b>DO NOT use this form to request deletion of your data as this is not currently supported for US and Canadian customers. Your request will be denied.<br/></b></span><br/><span style='color:red'><b>DO NOT include any sensitive information (i.e. credit card number, social security or insurance number, bank account number, etc.).</b></span><span><b> To update your payment card information, please go to <a style="text-decoration-line: underline !important;" target='__blank' href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> and click on "Update Credit Card". To update your social security number, social insurance number, tax identification number or bank account information, please read </span><a style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644' target='__blank'>FAQ 4644</a>.</b></div>
					
					<div id="desc1" style="display:none; text-align: left;"><span style="color: red"><b>Please provide a description of what you would like to object to or restrict:</b></span></div>

					<!--<div id="caution">Do not include any sensitive information in the box below (i.e. Credit Card #, SSN, bank account #, birthday). To update those, please contact Beachbody Support at Customer Line: 1-800-470-7870 or Coach Line: 1-800-240-0913 and mention GDPR so that we can get you to the right support team.</div>-->
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input="" required="false" /> 
				</div>
				

				<!--<div id="other_object_data" style="display:none">
					<div id="desc"><span style="color: red"><b>Please provide a description of what you would like to stop or opt out of.</b></span></div>
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input="description of what you would like to stop or opt out of." required="false" /> 
				</div>-->
				
				<div id="delete_object_data" style="display:none">
						<div id="desc" style="text-align: left; text-align:justify">
							<span style="color: red; text-align:left"><b>To exercise the right to deletion, you must first cancel your Team Beachbody Coach account as required by Beachbody’s standard business practices. Please see <a target='__blank' href='/app/answers/detail/a_id/9659'>FAQ 9659</a> for more information on how to cancel your Coach account.<br/><br/>Once your Coach account is successfully cancelled, you may request deletion of your information as follows:</b></span>
													
							<div style="color: red;margin-left: 24px">
								<p><b>
									1) Return to this webpage: <a href="https://faq.beachbody.com/app/gdpr_form">https://faq.beachbody.com/app/gdpr_form</a>.<br/>
									2) Select “Customer” in the Member Type field.<br/>
									3) Fill out all the fields, choose “Right of Deletion” and submit your request.
								</p></b>
								
							</div>
						
						</div>

				</div>

				<div id="totalFields" style="display:none">
					<br/>
					<div id="complete_info" style="text-align:left; font-size:15px;"><b>Please complete the fields below with the same information you provided to Beachbody when creating your account. We will use this to properly validate your request:</b></div>
					<br/>
					<div id="contact_object_data" style="">
					<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true" allow_external_login_updates="true"/>
					<rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true" allow_external_login_updates="true"/>
					</div>
					<!--<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="false" label_input="#rn:msg:EMAIL_ADDR_LBL#" label_validation="Confirm Email Address" require_validation="true"/>-->
					<div id="coach_fields" style="display:none">
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$coachcustomernumber" label_input="Coach ID" required="false" />
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$last_four_ssn" initial_focus="false" label_input="Last four digits of credit card used to pay your business service fee" required="false" always_show_mask="false" />
					</div>
					
					<div id="phone_fields">
					<rn:widget path="input/TextInput" name="Contact.Phones.MOBILE.Number" label_input="Phone Number" required="true" allow_external_login_updates="true"/>
					</div>
					<div id="customer_fields" style="display:none">
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$billing_zip_postal_code" label_input="Billing Postal / Zip Code" required="false">
					</div>
					<div id="email_fields">
					<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="false" label_input="#rn:msg:EMAIL_ADDR_LBL#" allow_external_login_updates="true"/>
					</div>
					<div style="display:none">
					<rn:widget path="custom/input/TextGDPR" name="Incident.Threads" initial_focus="false" label_input="Question" required="false" /> 
					</div>
					<div style="display:none">
						<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="1503" required="false"/> <!--change to 1503 when moved to prod-->
						<rn:widget path="input/TextInput" name="Incident.Subject" label_input="Subject" default_value="Data Subject Request Form Submittal" required="false" />
					</div>
					
					<div id="disclaimer_box" style="display:none">
						<rn:widget path="custom/input/checkboxDisclaimer" />
					</div>
					<div id="submit">
						<!--<div id="gdpr_title"><b>I am not a ROBOT</b></div>-->
						<div id ="gdpr_captcha" style="margin-top:12px;"></div>					
						<rn:widget path="custom/input/CheckBoxGDPR" />
						<rn:widget path="custom/input/SubmitGDPR" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/gdpr_confirm/" error_location="rn_ErrorLocation_gdpr" challenge_required="true" challenge_location="gdpr_captcha"/>
						<div id="t_and_c1" style="margin-top:10px;">Beachbody Terms and Conditions: <a href="https://www.teambeachbody.com/shop/us/terms-of-use?locale=en_US">US(EN)</a> | <a href="https://www.teambeachbody.com/shop/us/terms-of-use?locale=es_US">US(ES)</a> | <a href="https://www.teambeachbody.com/shop/gb/terms-of-use?locale=en_GB">UK</a> | <a href="https://www.teambeachbody.com/shop/ca/terms-of-use?locale=en_CA">CAN(EN)</a> | <a href=" https://www.teambeachbody.com/shop/ca/terms-of-use?locale=fr_CA">CAN(FR)</a></div>					
						<div id="privacy_policy1">Beachbody Privacy Policy: <a href="https://www.teambeachbody.com/shop/us/privacy?locale=en_US">US(EN)</a> | <a href="https://www.teambeachbody.com/shop/us/privacy?locale=es_US">US(ES)</a> | <a href="https://www.teambeachbody.com/shop/gb/privacy?locale=en_GB">UK</a> | <a href="https://www.teambeachbody.com/shop/ca/privacy?locale=en_CA">CAN(EN)</a> | <a href="https://www.teambeachbody.com/shop/ca/privacy?locale=fr_CA">CAN(FR)</a></div>

					</div>
					
					<!--<div id="submit">										
						<div  class="g-recaptcha" data-sitekey="6LeDG0gUAAAAABJd_uMgBi5xkgTc7Z1g-DD7deUi"></div>
						<rn:widget path="custom/input/CheckBoxGDPR" />
						<rn:widget path="custom/input/SubmitGDPR" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/gdpr_confirm" error_location="rn_ErrorLocation_gdpr"/>
					</div>-->
					

				</div>
				
			</div>
			
		</form>
	</div>
</div>