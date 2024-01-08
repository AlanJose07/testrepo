<rn:meta title="Customer Coach Change Confirmation" template="standard_responsive_bb.php" clickstream="ccc_confirm"/>

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
					
					<? $response = getUrlParm('response');
					   if(!empty($response)): ?>
					<b><li style="color:red;">Oops, an error occurred while submitting your form. To complete your request, please try again.</li></b>
					<? else: ?>
					<strong style="font-weight:bold!important;margin-left:170px!important;/*margin-bottom:20px !important;*/"></strong>
					<b><li>Your Customer Coach Change Request Has Been Submitted to an Agent for Processing</li></b>
					<li>We will review your request and email you within two business days.</li>
					<li>Your incident number is <b>#rn:url_param_value:refno#</b> </li></br>
					
					<!--<li>For further assistance, please click on the below links to chat with an agent.</li>
					<span><a target="_blank" href="https://faq.beachbody.com/app/contactus" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">United States</a>
					</span>
					
					<span><a target="_blank" href="https://faq.beachbody.ca/app/contactus" style="color: #0000ff; background-color: #ffffff;">Canada</a>
					</span>
					-->
					
					<li>For further assistance, please visit our <a target="_blank" href="/app/home/" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">support site</a>.</li>
					<? endif; ?>
					</div>
      
    		</div>
		  </div>
		</div>
</div>