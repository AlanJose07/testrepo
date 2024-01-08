<head>
	<script src="https://cmp.osano.com/AzZcuESCJWcN06dnY/70dd4b56-824e-462b-bc1e-ba2dccca4e3d/osano.js"></script>
	<rn:meta title="GDPR FORM" template="standard_responsive_bb.php" clickstream="incident_create" />
	<style>
		/* OSANO Starts*/

		.osano-cm-description:first-child {
			display: none;
		}

		.osano-cm-list:first-of-type .osano-cm-list__list-item:first-of-type {
			display: none !important;
		}

		.osano-cm-list__list-item:nth-child(2) {
			display: none !important;
		}

		.osano-cm-list__list-item:nth-child(3) {
			display: none !important;
		}

		.osano-cm-list__list-item:nth-child(4) {
			display: none !important;
		}

		.osano-cm-info-dialog-header {
			display: none !important;
		}

		.osano-cm-button {
			background-color: #ffffff !important;
			color: #1378db !important;
		}

		.osano-cm-window {
			font-family: inherit !important;
		}

		.osano-cm-storage-policy {
			text-decoration: underline !important;
			font-weight: normal !important;
		}

		.osano-cm-powered-by__link {
			font-weight: normal !important;
		}

		/* OSANO Ends*/
		.modal {
			display: none;
			/* Hidden by default */
			position: fixed;
			/* Stay in place */
			z-index: 1;
			/* Sit on top */
			padding-top: 100px;
			/* Location of the box */
			left: 0;
			top: 0;
			width: 100%;
			/* Full width */
			height: 100%;
			/* Full height */
			overflow: auto;
			/* Enable scroll if needed */
			background-color: rgb(0, 0, 0);
			/* Fallback color */
			background-color: rgba(0, 0, 0, 0.4);
			/* Black w/ opacity */
		}

		/* Modal Content */
		.modal-content {
			background-color: #fefefe;
			margin: 10%;
			padding: 20px !important;
			text-align: justify;
			border: 1px solid #888;
			width: 80%;
		}

		.gdpr_modal .modal-content {
			max-width: 300px;
			margin: 0;
			left: 0;
			border-radius: 0;
			height: 100vh;
		}

		/* The Close Button */
		.close {
			color: #aaaaaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
			top: 10px !important;
		}

		.close:hover,
		.close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}

		select {
			width: 24.5%;
		}

		#rn_QuestionSubmit_GDPR {
			width: 100%;
		}

		/*.rn_Email {
	height: 28px;
}*/
		#terms_conditions {
			margin-right: 10px;
			margin-top: 15px;
			//margin-bottom: 15px;
		}

		#terms_conditions_auth {
			margin-right: 10px;
			margin-top: 15px;
			//margin-bottom: 15px;
		}

		#terms_link {
			text-decoration: underline;
			font-weight: bold;
		}

		.rn_TextInput .rn_Text,
		.rn_TextInput .rn_Email,
		.rn_TextInput .rn_Url,
		.rn_TextInput .rn_TextArea {
			width: 24%;
		}

		#recaptcha_area {
			margin: auto;
		}

		.rn_CheckBoxGDPR {
			margin-right: 83px;
		}

		.ask-page #rn_QuestionSubmit_GDPR {
			width: 600px;
			margin: 0 auto;
		}

		.rn_SelectionInput legend,
		.rn_SelectionInput label,
		.ask-page #rn_QuestionSubmit_GDPR .rn_TextInput .rn_Label {
			text-align: left;
		}

		.ask-page #rn_QuestionSubmit_GDPR select {
			width: 100% !important;
		}

		.rn_TextInput .rn_Text,
		.rn_TextInput .rn_Email,
		.rn_TextInput .rn_Url,
		.rn_TextInput .rn_TextArea {
			width: 100%;
			box-sizing: border-box;
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

		a {
			text-decoration: underline;
			color: #0079C1;
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

		.submit_gdpr input[type=submit],
		button {
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


		#rn_ErrorLocation_gdpr a {
			color: red;
		}

		select {
			//width: 365px;
			height: 32px;
			padding-left: 7px;
		}

		.sample-switch {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: 1rem;
		}

		.swtich-holder {
			display: flex;
		}

		.sample-switch input[type=checkbox] {
			height: 0;
			width: 0;
			visibility: hidden;
		}

		.sample-switch h5 {
			margin: 0;
			font-weight: 600;
		}

		.sample-switch label {
			cursor: pointer;
			text-indent: -9999px;
			width: 50px;
			height: 25px;
			background: grey;
			display: block;
			border-radius: 100px;
			position: relative;
			margin-bottom: 0;
		}

		.sample-switch label:after {
			content: "";
			position: absolute;
			top: 3px;
			left: 3px;
			width: 20px;
			height: 20px;
			background: #fff;
			border-radius: 90px;
			transition: 0.3s;
		}

		.sample-switch input:checked+label:after {
			left: calc(100% - 3px);
			transform: translateX(-100%);
		}

		.sample-switch input:checked+label {
			background: #5081ff;
		}

		.gdpr-wrapper {
			padding-left: 1rem;
			padding-right: 1rem;
		}
	</style>

</head>
<!--<header>
<img src="https://www.beachbody.com/images/beachbody/en_us/global/bbv6/beachbody_logo.png" height="50px" width="225px"/>
</header>-->

<div id="rn_PageTitle" class="rn_LiveHelp gdpr-wrapper">
	<div id="title_support" style="display:block; text-align:center;margin-top: 0px;">
		<h2>Consumer Privacy Rights Request Form</h2>

	</div>
	<!--<div id="gdpr_instructions">
		Use this form to make specific data account requests. Please fill out all required information accurately. Your request may be declined if incorrect information is received. For answers to frequently asked questions, please visit </span><a href='https://faq.beachbody.com/app/answers/detail/a_id/4644' target='__blank'>FAQ 3436</a>.
	</div>-->
	<!--<div id="call_support">
		Answers to frequently asked questions regarding these requests can be found in <a href="/app/answers/detail/a_id/9909/~/beachbody-support-contact-information/lob/<? echo $tabval; ?>"></a>.
	</div>-->
	<br />
</div>
<div id="rn_PageContent" class="rn_Live ask-page gdpr-wrapper">
	<div class="rn_Padding">
		<form id="rn_QuestionSubmit_GDPR" method="post" action="/ci/ajaxCustom/sendFormGDPR">
			<p style="text-align: justify;">Please complete this form to initiate your request regarding the data BODi
				has collected and maintains on your account. A BODi representative may contact you to validate this
				information or to ask for additional details necessary to handle your request.<br /><br />Please fill
				out all required information accurately as we will use it to validate your identity. Your request may be
				delayed or declined if we receive incorrect information. <br /><br />Answers to frequently asked
				questions regarding data subject rights may be found in </span><a href='/app/answers/detail/a_id/3436'
					target='__blank'>FAQ 3436</a>.<br /></p>

			<p style="text-align: justify;">You will receive an email from BODi after the form is submitted. The email
				will request that you click a link to verify your identity and protect you against fraud. Your request
				will be processed once you click the link.<br /></p>

			<p style="color:red"><b>*Required field</b></p>
			<div id="rn_ErrorLocation_gdpr"></div>

			<rn:widget path="custom/input/SelectGDPR" name="Contact.Address.Country" required="true"
				label_input=" Select Country of Residence" initial_focus="true" allow_external_login_updates="true" />

			<div id="StateFields" style="display:none">

				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$gdpr_us_states" required="false"
					label_input=" Select State of Residence" initial_focus="true" allow_external_login_updates="true" />
			</div>

			<div id="CountryFields" style="display:none">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$member_type_new" required="true"
					label_input="Select Member Type" initial_focus="false" />
			</div>

			<div id="disclaimer_checkbox" style="display:none">
				<rn:widget path="custom/input/CheckBoxAuthAgentGDPR" />
			</div>


			<div data-di-mask id="authFields" style="display:none">


				<div id="auth_contact_object_data" style="">
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$search_first_name"
						label_input="Authorized Agent First Name" allow_external_login_updates="true" required="false"
						data-di-mask />
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$search_last_name"
						label_input="Authorized Agent Last Name" allow_external_login_updates="true" required="false"
						data-di-mask />
				</div>
				<div id="auth_email_fields">
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$search_email" initial_focus="false"
						label_input="Authorized Agent Email Address" allow_external_login_updates="true"
						required="false" data-di-mask />
				</div><br />
			</div>


			<div id="right_type_data" style="display:none;">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_right_type"
					label_input="Select the Data Subject Right You Wish to Exercise" required="true" />
			</div>
			<div id="my_object_data" style="display:none; margin-left: 20px;">
				<!--<rn:widget path="custom/input/SelectGDPR" name="Incident.c$object_my_data" required="false" label_input="Select Object Data"  initial_focus="false" />-->
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_object_data" required="false"
					label_input="What would you like to opt out of:" initial_focus="false" />
			</div>
			<div id="update_object_data" style="display:none">
				<div id="desc_uk" style="display:none;text-align:justify"><span><b>Describe in detail what data you
							would like to correct in the box below (e.g., updating your address or phone
							number).<br /><br /></b></span><br /><span style='color:red'><b>DO NOT include any sensitive
							information (i.e. credit card number, social security or insurance number, bank account
							number, etc.).</b></span><span><b> To update your payment card information, please go to <a
								style="text-decoration-line: underline !important;" target='__blank'
								href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> and click on "Update
							Credit Card". To update your social security number, social insurance number, tax
							identification number or bank account information, please read </span><a
						style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644'
						target='__blank'>FAQ 4644</a>.</b></div>

				<div id="desc" style="display:none;text-align:justify"><span><b>Describe in detail what data you would
							like to correct in the box below (e.g., updating your address or phone
							number).<br /><br /></b></span><span style='color:red'><b>DO NOT include any sensitive
							information (i.e. credit card number, social security or insurance number, bank account
							number, etc.).</b></span><span><b> To update your payment card information, please go to <a
								style="text-decoration-line: underline !important;" target='__blank'
								href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> and click on "Update
							Credit Card". To update your social security number, social insurance number, tax
							identification number or bank account information, please read </span><a
						style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644'
						target='__blank'>FAQ 4644</a>.</b></div>

				<div id="desc1" style="display:none; text-align: left;"><span style="color: red"><b>Please provide a
							description of what you would like to object to or restrict:</b></span></div>

				<!--<div id="caution">Do not include any sensitive information in the box below (i.e. Credit Card #, SSN, bank account #, birthday). To update those, please contact Beachbody Support at Customer Line: 1-800-470-7870 or Coach Line: 1-800-240-0913 and mention GDPR so that we can get you to the right support team.</div>-->
				<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input=""
					required="false" />
			</div>


			<!--<div id="other_object_data" style="display:none">
					<div id="desc"><span style="color: red"><b>Please provide a description of what you would like to stop or opt out of.</b></span></div>
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input="description of what you would like to stop or opt out of." required="false" /> 
				</div>-->

			<div id="delete_object_data" style="display:none">
				<div id="desc" style="text-align: left; text-align:justify;">
					<span style="color: red; text-align:left;"><b>To exercise the right to deletion, you must first
							cancel your Team BODi Coach account as required by BODi’s standard business practices.
							Please see FAQ [<a target='__blank' href='/app/answers/detail/a_id/9659'>9659</a>/<a
								target='__blank' href='/app/answers/detail/a_id/3544'>3544</a>] for more information on
							how to cancel your Coach account.<br /><br />Once your Coach account is successfully
							cancelled, you may request deletion of your information as follows:</b></span><br />

					<div style="color: red;margin-left: 24px">
						<p><b>
								1) Return to this webpage: <a
									href="https://faq.beachbody.com/app/gdpr_form">https://faq.beachbody.com/app/gdpr_form</a>.<br />
								2) Select “Customer” in the Member Type field.<br />
								3) Fill out all the fields, choose “Right of Deletion” and submit your request.
						</p></b>

					</div>

				</div>

			</div>

			<div id="delete_object_data_pc" style="display:none">
				<div id="desc" style="text-align: left; text-align:justify">
					<span style="color: red; text-align:left"><b>To exercise the right to deletion, you must first
							cancel your Team BODi Preferred Customer account as required by BODi’s standard business
							practices. Please see <a target='__blank' href='/app/answers/detail/a_id/3544'>FAQ 3544</a>
							for more information on how to cancel your Preferred Customer account.<br /><br />Once your
							Preferred Customer account is successfully cancelled, you may request deletion of your
							information as follows:</b></span>

					<div style="color: red;margin-left: 24px">
						<p><b>
								1) Return to this webpage: <a
									href="https://faq.beachbody.com/app/gdpr_form">https://faq.beachbody.com/app/gdpr_form</a>.<br />
								2) Select “Customer” in the Member Type field.<br />
								3) Fill out all the fields, choose “Right of Deletion” and submit your request.
						</p></b>

					</div>

				</div>
			</div>
			<div id="totalFields" style="display:none">
				<br />
				<div id="complete_info" style="text-align:left; font-size:15px;"><b>Please complete the fields below
						with the same information you provided to BODi when creating your account. We will use this to
						properly validate your request:</b></div>
				<br />
				<div id="contact_object_data" style="">
					<rn:widget path="custom/input/CustomFormInput" name="Contact.Name.First" initial_focus="false"
						label_input="#rn:msg:FIRST_NAME_LBL#" required="true" allow_external_login_updates="true"
						data-di-mask />
					<rn:widget path="custom/input/CustomFormInput" name="Contact.Name.Last" initial_focus="true"
						label_input="#rn:msg:LAST_NAME_LBL#" required="true" allow_external_login_updates="true"
						data-di-mask />
				</div>
				<!--<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="false" label_input="#rn:msg:EMAIL_ADDR_LBL#" label_validation="Confirm Email Address" require_validation="true"/>-->
				<div id="coach_fields" style="display:none">
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$coachcustomernumber" label_input="Coach ID"
						required="false" data-di-mask />
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$last_four_ssn" initial_focus="false"
						label_input="Last four digits of credit card used to pay your business service fee"
						required="false" always_show_mask="false" data-di-mask />
				</div>

				<div id="email_fields" data-di-mask>
					<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address" required="true"
						initial_focus="false" label_input="#rn:msg:EMAIL_ADDR_LBL#" allow_external_login_updates="true"
						data-di-mask />
				</div>

				<div id="phone_fields" data-di-mask>
					<rn:widget path="input/TextInput" name="Contact.Phones.MOBILE.Number" label_input="Phone Number"
						required="false" allow_external_login_updates="true" data-di-mask />
				</div>
				<div id="customer_fields" style="display:none">
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$billing_zip_postal_code"
						label_input="Billing Postal / Zip Code" required="false">
				</div>

				<div id="opt_out_info" style="text-align:left; font-size:15px;display:none;"><b>If you would like to
						opt-out of tracking cookies set by third parties that may be considered "sales," you can opt-out
						through our cookie manager by clicking <a
							onclick="Osano.cm.showDrawer('osano-cm-dom-info-dialog-open')">here</a>.</b></div>
				<div style="display:none">
					<rn:widget path="custom/input/TextGDPR" name="Incident.Threads" initial_focus="false"
						label_input="Question" required="false" />
				</div>
				<div style="display:none">
					<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing"
						default_value="1503" required="false" /> <!--change to 1503 when moved to prod-->
					<rn:widget path="input/TextInput" name="Incident.Subject" label_input="Subject"
						default_value="Data Subject Request Form Submittal" required="false" />
				</div>

				<div id="disclaimer_box" style="display:none">
					<rn:widget path="custom/input/checkboxDisclaimer" />
				</div>
				<div id="submit">
					<!--<div id="gdpr_title"><b>I am not a ROBOT</b></div>-->
					<div id="gdpr_captcha" style="margin-top:12px;"></div>
					<rn:widget path="custom/input/CheckBoxGDPR" />
					<div class="submit_gdpr">
						<rn:widget path="custom/input/SubmitGDPR" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#"
							on_success_url="/app/gdpr_confirm/" error_location="rn_ErrorLocation_gdpr"
							challenge_required="true" challenge_location="gdpr_captcha" />
					</div>
					<div id="t_and_c1" style="margin-top:10px;">BODi Terms and Conditions: <a
							href="https://www.teambeachbody.com/shop/us/terms-of-use?locale=en_US">US(EN)</a> | <a
							href="https://www.teambeachbody.com/shop/us/terms-of-use?locale=es_US">US(ES)</a> | <a
							href="https://www.teambeachbody.com/shop/gb/terms-of-use?locale=en_GB">UK</a> | <a
							href="https://www.teambeachbody.com/shop/ca/terms-of-use?locale=en_CA">CAN(EN)</a> | <a
							href=" https://www.teambeachbody.com/shop/ca/terms-of-use?locale=fr_CA">CAN(FR)</a></div>
					<div id="privacy_policy1">BODi Privacy Policy: <a
							href="https://www.teambeachbody.com/shop/us/privacy?locale=en_US">US(EN)</a> | <a
							href="https://www.teambeachbody.com/shop/us/privacy?locale=es_US">US(ES)</a> | <a
							href="https://www.teambeachbody.com/shop/gb/privacy?locale=en_GB">UK</a> | <a
							href="https://www.teambeachbody.com/shop/ca/privacy?locale=en_CA">CAN(EN)</a> | <a
							href="https://www.teambeachbody.com/shop/ca/privacy?locale=fr_CA">CAN(FR)</a></div>

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
<!-- The Modal -->
<div id="myModal" class="modal gdpr_modal">
	<!-- Modal content -->
	<div class="modal-content">
		<!-- <span class="close">&times;</span> -->
		<h4>Privacy Notice</h4>
		<div class="sample-switch">
			<h5>Additional info for Switch</h5>
			<div class="swtich-holder">
				<input type="checkbox" id="switch" /><label for="switch">Toggle</label>
			</div>
		</div>
		<p>Although BODi does not sell your personal information for monetary compensation, we and certain third party
			advertising, analytics, social media, and similar partners may collect data from visitors through cookies
			for analytics and in order to personalize your experience, including to serve you targeted ads and content.
			If you do not allow these cookies, you will still see advertising on our site and elsewhere online, but the
			advertisements you see may be less relevant to you. Under certain circumstances, the collection of personal
			information through these cookies may be considered a “sale” or “sharing” for cross-contextual behavioral
			advertising under California law, or “targeted advertising” under Virginia law. You may opt-out of this
			practice by clicking on the toggle switch so that it turns blue. Please be sure to click “Save” to save your
			preferences. If you use different devices or browsers, you may need to indicate your opt-out choices on each
			of those devices and browsers.</p>
	</div>

</div>

<script>
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function () {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function () {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>
<!--<script>
document.getElementById("osano-cm-drawer-toggle--category_MARKETING").style.display = "none";
document.getElementById("osano-cm-drawer-toggle--category_MARKETING--description").style.display = "none";
document.getElementById("osano-cm-MARKETING_disclosures").style.display = "none";
</script>	-->
<!--<script>
let checkbox = document.getElementById("terms_conditions_auth");
	  checkbox.addEventListener( "change", () => {
		 if ( checkbox.checked ) {
			document.getElementById("submit").style.display="none";
			document.getElementById("disclaimer_box").style.display="none";
			document.getElementById("customer_fields").style.display="none";
			document.getElementById("phone_fields").style.display="none";
			document.getElementById("coach_fields").style.display="none";
			document.getElementById("complete_info").style.display="none";

			document.getElementById("totalFields").style.display="block";

		 } 
	  });
</script>	-->