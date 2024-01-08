<rn:meta title="Contact Us Confirmation" template="standard_responsive_bb.php" clickstream="openfit_confirm"/>

<style>
    body{
        width:100% !important;
    }
</style> 
<div class="confirm confirm_container container">
<div style="padding:0;text-align: center;">
	<!--<img height="60" width="300" alt="" src="https://faq.beachbody.com/euf/assets/images/team_beachbody_coach_packages.png">-->
</div>
	<div id="rn_IFrameContent" class="rn_OrderPage">
  		<div id="rn_content" class="rn_questionform">
    		<div class="rn_wrap">   
					
					<div id="confirm_eng">
					<rn:condition url_parameter_check="refno != null">
				
					</rn:condition>
					
					<? $response = getUrlParm('refno');
					   if(empty($response)): ?>
					<b><li style="color:red;">Oops, an error occurred while submitting your form. To complete your request, please try again.</li></b>
					<? else: ?>
					<strong style="font-weight:bold!important;margin-left:170px!important;/*margin-bottom:20px !important;*/"></strong>
					<b><li>Your Request was successfully submitted.</li></b>
					<li>We will review your request and email you within two business days.</li>
					<li>You may use this reference number for follow up: <b>#rn:url_param_value:refno#</b> </li></br>
					
					<? endif; ?>
					</div>
      
    		</div>
		  </div>
		</div>
</div>