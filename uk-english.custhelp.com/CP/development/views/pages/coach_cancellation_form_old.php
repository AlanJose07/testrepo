
<rn:meta title="Coach Cancellation Form" template="standard_ccf.php" clickstream="incident_create"/>
<img src="/euf/assets/images/team_beachbody_coach_packages.png" height="60" width="300"/>
<div id="rn_PageTitle" class="rn_LiveHelp">
<h1><b>Independent Coach Cancellation Form (UK)</b></h1>
<div class="priceQuote">
	<I>
This form allows you to permanently cancel your Team Beachbody Coach accounts and any other memberships or subscriptions in which you may have enrolled. Please fill out all required information accurately. Your cancellation may be delayed if we receive incorrect information. </I></div>
<b>*Required</b>
 <br/>
</div>
<div id="rn_PageContent" class="rn_Live">
  <div class="rn_Padding" >
    <form id="rn_QuestionSubmit" method="post" action="/cc/fattach/digitalSubmit" >
      <div id="rn_ErrorLocation"></div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	 <rn:widget path="custom/input/TextInput_CCF" name="Incident.c$coachcustomernumber" label_input="Coach ID" initial_focus="true" required="false"/> 
        </div>
        <div class="cus-col-md-6">
        	<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" label_input="Email"  required="true"/>
            <em class="emailCommnets">Please use the email address on file for your coach account</em>
        </div>
      </div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	<rn:widget path="input/TextInput" name="Incidents.c$ccf_first_name" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
        	<em class="firstNameComments">Please type your first name exactly as it appears on your Coach account</em>
        </div>
        <div class="cus-col-md-6">
        	 <rn:widget path="input/TextInput" name="Incidents.c$ccf_last_name" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
        	 <em class="lastNameComments">Please type your last name exactly as it appears on your Coach account</em>
        </div>
      </div>
       <div class="Indeprow businessName clear">
      		 <rn:widget path="input/TextInput" name="Incidents.c$ccf_business_name" label_input="Business Name (If Applicable)" required="false"/>
      </div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
		
        	<!--<rn:widget path="input/TextInput" name="Incident.c$last_four_ssn" label_input="Last 4 digits of SSN, EIN or SIN" required="true"/>-->
			<rn:widget path="input/TextInput" name="Incident.c$last_four_cc" label_input="Last 4 digits of Credit Card on file for BSF Fees" required="true"/>
			 
        </div>
        <div class="cus-col-md-6">
        	<rn:widget path="input/TextInput" name="Contact.Phones.MOBILE.Number" label_input="Phone" required="true" minimum_length=10/>
        </div>
      </div> 

 <!--Life time rank-->
	  <div class="Indeprow businessName clear">
      	
			 <rn:widget path="custom/input/SelectionInput_CCF_life_time_rank" name="Incident.c$life_time_rank"  label_input="Lifetime Rank" required="true">
      </div>
	   <!--Life time rank-->
	  
	  <div style="display:none">
	  <rn:widget path="input/FormInput" name="Incident.Subject" label_input="Subject" default_value="Coach Cancellation Form Received" required="false"/>
	  </div>
	   <div style="display:none">
	  <rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="1356" required="false"/>
	  </div>
       <div class="Indeprow clear CoachRadio">
       		<rn:widget path="custom/input/SelectionInputRadioButton" name="Incident.c$ccf_reason_for_cancellation" label_input="Select the primary reason that best describes your cancellation" required="true"/>
          
       </div> 
	     
	
	 
	 <b><div id="memberships" class="canFormTitle01">
	 Other Memberships and Subscriptions<sup style="color: #C63F6F;">*</sup>
	 </div></b>
     
	 
	
	<div class="CheckServiceLab"><b>Please check the box next to which services <u>you would like to continue</u>:</b></div>
	 <div class="Indeprow clear">
	     <div id="cancel_all_enrollments" class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_cancel_all_enrollments" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CANCEL_ALL_ENROLLMENTS#" required="false"/>
         </div>
         <div id="club_membership" class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_TBB_CLUB_MEMBERSHIP#" required="false"/>
         	<!--<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CANCEL_ALL_ENROLLMENTS#" required="false"/>-->
         </div>
     </div>
      <div class="Indeprow clear">
	     <div id="shakeology" class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_shakeology" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_SHAKEOLOGY#" required="false"/>
         </div>
		 
		 
		  
		 
		 
		  <div class="cus-col-md-6 serviceCheck">
		 
		  <rn:widget path="custom/input/CheckboxPerformance"/>
		 <div id="performance_select" class="cus-col-md-6 serviceCheck sBlock" style="display:none">
		
      	<!--<div class="cus-col-md-6">-->
        	<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_performance_uk" label_input="Monthly Beachbody Performance" required="false"/>
       <!-- </div>-->
		</div>
        
		</div>
     </div> 
	 
	 
	 <?php
	 /*
	 ?>
		<div class="Indeprow clear">

		<div class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/CheckboxShakeBoost"/>
		<div id="shake_boost_select" class="cus-col-md-6 serviceCheck sBlock marg" style="display:none">
		<!--<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_shakeology_boost" label_input="Shakeology Boost" required="false"/>-->
		</div>
		</div>
		<div class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/Checkbox3DayRefresh"/>
		<div id="select_3day" class="cus-col-md-6 serviceCheck sBlock" style="display:none">

		<!--<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_3_day_refresh" label_input="3 Day Refresh" required="false"/>-->

		</div>
		</div>

		</div> 
	 
	 <?php
	 */
	 ?>
	 
	   <div class="Indeprow clear">
	   
		<div class="cus-col-md-6 serviceCheck">
		<div id="pro_team_select" class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_pro_team" display_as_checkbox="true" label_input="Pro Team" required="false"/>
		</div>
		</div>
	   
	   
		<div class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_other_continued_services" display_as_checkbox="true" label_input="Other" required="false"/>
		</div>
		 
         <div style="display:none"><input type="text"  id="check_validate" /></div>
		 </div>
				
<div id="other_service" style="display:none">
	<rn:widget path="input/TextInput_CCF_Other" name="Incident.c$ccf_membership_and_enrollment" label_input="Please specify and list all that apply" required="false"/>
	</div>
	 
	

	<div class="priceQuote">
	<I>
	*Prices do not include postage & package, and tax.</I></div>	
	<!--<div class="priceQuote">
	<I>	
**Please remember, if you cancel or do not have a Beachbody On Demand membership, you will not have access to stream and will not get 10% off on future orders. If you keep your Beachbody On Demand membership, you will get 10% off the prices listed.</I></div>-->

	 <b><div class="canFormTitle01" id="terms_of_cancellation">Terms of Cancellation<sup style="color: #C63F6F;">*</sup></div></b>
	 <div class="priceQuote"><I>Please check all boxes to sign and submit your cancellation</I></div>

	<div class="CheckServiceLab"><b>By signing and submitting this form, I understand the following:</b></div>
	
	<div class="submitPoints">
    <input type="checkbox" id ="term1" required/><span>I will lose the 25% Coach discount on all future orders and any memberships or subscriptions I continued above</span>
    </div>
	 <div class="submitPoints">
	<input type="checkbox" id ="term2" required/><span>For any memberships or subscriptions which I continued, I agree to the charges for those products and understand I may cancel at any time by calling Customer Service at 0800-953-6100 </span>
    </div>
    <div class="submitPoints">
	<input type="checkbox" id ="term3" required/><span>I lose the right to sell Team Beachbody products</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox"  id ="term4" required/><span>I am no longer eligible to earn commission under the Team Beachbody Compensation Plan</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term5" required/><span>I am permanently abandoning my position within the Team Beachbody genealogy, as well as any pending bonuses, commissions, or any other forms of compensation</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term6" required/><span>I may not re-enroll as a Team Beachbody Coach until six calendar months from the date of my cancellation if I wish to re-enroll with a new sponsor, or with my original sponsor on a different leg of the sponsor’s organization (please refer to the Team Beachbody Coach Policies & Procedures, Section 3.6.3)</span>
    </div>
<div class="Indeprow clear">
	<div class="signaturePane">

<div class="sigPad" id="signature"> <b id="signLabel">Simply type /s/ before your name; e.g., /s/ John Smith. This identifies it as being a signature, letting us know that you consent to the terms and conditions.<!--<sup><font color="#DB1E1E" size="-1">*</font></sup>--></b><br />
  
   <!--<div id = "canvas123">
        <canvas class=pad width="450" height="170" style="border:#666666 1px solid" required="false" id="canvas" onmouseout="convert()" style="padding-bottom:10px"></canvas>
		</div>-->
		 <input type="text" name="signatureText" id="html-content-holder" maxlength="100"><br>
		<!--<div id = "canvas123">
			<div id="previewImage" style="display:none"></div>
		</div>-->
        <input type=hidden name=output class=output required>
        <br />
       

		<div class="bySigning" id="signtext">
		Signature with /s/ before your name<br /><br />
		<I>By signing, I certify I am the current account holder of the Coach Business Center and/or authorized to cancel this account. If we have any questions, we will contact you at the information you provided above.</I></div>
        <input type="hidden" name="base64_encoded_string" id="base64_encoded_string" >
		<input type="hidden" name="test_canvas" id="test_canvas" >
	<!--<button class=clearButton onClick="clearSignature()" id="clear_button">Clear Signature</button>-->

 
<div id="div_imgAttach"></div>
		
        <br />
	
	
		</div>
		</div>
		</div>
		<div style="display:inline"> <span><b>Date </b>(Pacific Time):</span></div>
			<?php echo date('m-d-Y');?>
  <div class="importTxt"> <b>IMPORTANT</b>  Submission of this form does not hold or cancel pending charges/shipment already in progress or scheduled during this processing time. You may be charged for these orders.</div>
  <div class="cancelSubmitBtn">
  	<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation"/>
  </div>
<div class="float_left"> </div>
<div id="submit" ></div>

    </form>
	<img  id="SignatureImage" style="display:none"/>
  </div>
  

</div>
<div class="relative">
	<!--<img src="/euf/assets/images/CoachCancellationSampleScreenShot.JPG"  alt="Sample Screenshot" height="300" width="300">-->
</div>

<style>
.error .signmsg
{
	color:#DB1E1E;	
}
.signaturePane .bySigning{
	width:100%!important;
}

.bySigning{
	color:#000000!important;
	font-size:14px;
	width:100%!important;
}
.error{
	margin-left: 220px;
    position: absolute;
}

div.sigPad b, div.sigPad canvas{
	float:left;
}

.float_left, div.sigPad b{
	float:left;
	width: 100%;
}
.example{
	font-weight:normal;
}
.rn_other{
	font-weight:normal!important;
	font-size:14px;
}
/*#clear_button{
background-color:#FFFFFF;
height:70px;
width:70px;
/*border:none;
}*/
#signtext{
color:#000000 !important;
font-size:14px !important;
}
#rn_Body
{
	border-top:none;
}

input[type=checkbox]
{
padding-top:10px;
}
.rn_FormSubmit .rn_Loading:before {
content:"" !important;
}
</style>

<script>
document.getElementById("check_validate").value = "0";
</script>

<script src="https://files.codepedia.info/uploads/iScripts/html2canvas.js"></script>
<script>
 
$(document).ready(function()
{
	
	var element = $("#html-content-holder"); // global variable
	var getCanvas; // global variable
	$("#html-content-holder").on("keyup", function () 
	{
        	
			var myString = document.getElementById("html-content-holder").value;

			if(document.getElementById("html-content-holder").value!="")//checks if base64 encoded string represents an empty canvas
			{
				$("#base64_encoded_string").attr('value',myString);
				console.log(document.getElementById("base64_encoded_string").value);
			}
			else
			{
				$("#base64_encoded_string").attr('value',"");
			}
			
		 
    });	
});
</script>
