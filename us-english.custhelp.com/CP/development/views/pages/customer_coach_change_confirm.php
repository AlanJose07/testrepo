<rn:meta title="Customer Partner Change Confirmation" template="standard_responsive_bb.php" clickstream="ccc_confirm"/>
<style>
    body{
        width:100% !important;
    }
</style> 
<?
 $contactid =$this->session->getProfile()->c_id->value;
 $authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
 $consent_guid = $authorizeduser->CustomFields->c->customer_guid;
 $base_uri='https://preferencecenter.beachbody.com/?guid='.$consent_guid;
?>
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
					<? else: 
						$ctype = getUrlParm('ctype');
					?>
					
					<strong style="font-weight:bold!important;margin-left:170px!important;/*margin-bottom:20px !important;*/"></strong>
					<? if($ctype == 4): ?>
					<b><li>Your Preferred Customer Partner Change Request Has Been Submitted to BODi Support for Processing</li></b>
					<? else: ?>
					<b><li>Your BODi Partner Request has been submitted for processing.</li></b>
					<? endif; ?>
					<li>We will review your request and email you within 24 hours</li>
					<li>Your incident number is <b>#rn:url_param_value:refno#</b> </li></br>
					
					<!--<li>For further assistance, please click on the below links to chat with an agent.</li>
					<span><a target="_blank" href="https://faq.beachbody.com/app/contactus" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">United States</a>
					</span>
					
					<span><a target="_blank" href="https://faq.beachbody.ca/app/contactus" style="color: #0000ff; background-color: #ffffff;">Canada</a>
					</span>
					-->
					
					<!--<li>For further assistance, please visit our <a target="_blank" href="/app/home/" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">support site</a>.</li>-->
					<li>To ensure you will receive communications from BODi and your new BODi Partner, update your privacy and email preferences <a target="_blank" href="<?= $base_uri?>" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">here</a>.</li>
					<? endif; ?>
					</div>
      
    		</div>
		  </div>
		</div>
</div>