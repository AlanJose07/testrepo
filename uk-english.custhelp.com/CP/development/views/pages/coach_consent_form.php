<?
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])){
	$unsupported_browser = "/app/unsupported_browser";
	header('Location: ' . $unsupported_browser);
  }
?> 
<rn:meta title="Beachbody" login_required="true"/>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Decibel - faq.beachbody.co.uk -->
<link rel="dns-prefetch" href="//cdn.decibelinsight.net">
<link rel="dns-prefetch" href="//collection.decibelinsight.net">
<script type="text/javascript">
// <![CDATA[
	(function(d,e,c,i,b,el,it) {
		d._da_=d._da_||[];_da_.oldErr=d.onerror;_da_.err=[];
		d.onerror=function(){_da_.err.push(arguments);_da_.oldErr&&_da_.oldErr.apply(d,Array.prototype.slice.call(arguments));};
		d.DecibelInsight=b;d[b]=d[b]||function(){(d[b].q=d[b].q||[]).push(arguments);};
		el=e.createElement(c),it=e.getElementsByTagName(c)[0];el.async=1;el.src=i;it.parentNode.insertBefore(el,it);
	})(window,document,'script','https://cdn.decibelinsight.net/i/13996/612538/di.js','decibelInsight');
// ]]>
</script>
<!-- Decibel - faq.beachbody.co.uk -->
<head>
<style>
img {
    vertical-align: middle;
}
</style>
<link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
<title>Beachbody</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="/euf/assets/themes/responsive/css/coach_consent.css" rel="stylesheet">	
<script src="/euf/assets/themes/responsive/js/jquery_latest.js"></script>

<link href="/euf/assets/themes/responsive/css/beachbody.min.css" rel="stylesheet">
<script src="/euf/assets/themes/responsive/js/beachbody.min.js"></script>
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
</head>

<body>


<rn:condition logged_in="true">
<form id="rn_ChatLaunchForm" method="post" action="">
<div class="form-main">
<div class="form_table">
<div class="close">X</div>
<div id="rn_errorlocation_coach" style="display:none"></div>
<?php
		$contactid =$this->session->getProfile()->c_id->value;
		$authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
		$contact_type = $authorizeduser->ContactType->ID;
		$consent_full_name = $authorizeduser->CustomFields->c->consent_full_name;
		$consent_email = $authorizeduser->CustomFields->c->consent_email;
		$consent_phone = $authorizeduser->CustomFields->c->consent_phone;
		$consent_relationship = $authorizeduser->CustomFields->c->consent_relationship->ID;
		if($contact_type != 2):
		if(!empty($consent_email))
		{
			$message = 'The following individual is currently an authorized user on your account.  Click edit below to change authorized user information.';
			$action = 'Edit';
		}
		else
		{
			$message = 'There are currently no authorized users on your account.  Click "Add New" below to give consent to a new authorized user.';
			$action = 'Add New';
		}
?>

<div class="top-txt"><?php echo $message; ?></div>
<div id="page">   
<? if(!empty($consent_email))
        { ?>
    <span class="btn-n1">
        <label class="rmve-close" data-toggle="modal" data-target="#exampleModal"> x </label>
         <label type="button" class="" data-toggle="modal" data-target="#exampleModal">
  Remove
</label>
</span>
<? } ?> 
<input class="toggle-box" id="identifier-1" type="checkbox">
<label for="identifier-1"><?php echo $action; ?></label>
<div>
<hr>

<div class="content">

<div class="full_width">
<div class="full_width_space">
<p><strong>This form must be completed and signed by a Coach in order to allow another individual (spouse, parent or adult child over the age of 18) to access and make the following changes to the Coach's account:</strong></p>
<p>(a) Change of subscription flavor or ship date <br>(b) Change of subscription shipping address<br>(c) Cancellation of subscription order (not including the required monthly business service fee).</p>
<p><strong>This form does not permit another individual to manage or operate the consenting Coach's account. Additionally, any Coach seeking to use their credit card to pay for another Coach or customer's orders may do so only within the guidelines of Section 5.1 of the Team Beachbody Coach Policies &amp; Procedures.</strong></p>
</div>
</div>
</div>
<?php 
		
		try {
		
		load_curl();
        
		//$this->session->getProfile()->email->value;
		//$url = $config_url."?email=".$this->session->getProfile()->email->value;
		//echo $this->session->getProfile()->c_id->value;
		
		$contact = get_instance()->model('Contact')->get()->result;
		$contact_role = $contact->CustomFields->c->member_type;
		$contact_rank = $contact->CustomFields->c->lifetime_rank;
		
		//$this->session->getProfile()->email->value	
		//$email = "kate_coach@yopmail.com";
		$url = \RightNow\Utils\Config::getConfig(1000069);  //CUSTOM_CFG_GET_AWS_IDM_DETAILS
		$key = \RightNow\Utils\Config::getConfig(1000068);	//CUSTOM_CFG_AWS_API_KEY  
		$payload= '{"searchFilterName": "email","searchFilterValue": "'. $this->session->getProfile()->email->value .'"}';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
											'api-key: AGENT:US:1234',
											'x-api-key: '.$key,
											'Content-Type: application/json'));
		//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resp = json_decode(curl_exec($ch));
		//echo "<pre>";
		//print_r($resp);
		if($log)
		{
			logmessage($resp);
		}
		if(curl_errno($ch)){
		throw new Exception(curl_error($ch));
		}
		 curl_close($ch);
			if($log)
			{
			logmessage($resp->searchUser->guid . 
			$resp->searchUser->gncCoachID .
			$resp->searchUser->customerType);
			}
			logmessage("GUID:".$resp->searchUser->guid . 
			"CoachID:".$resp->searchUser->gncCoachID ."CType:".
			$resp->searchUser->customerType);
			
			$guid = $resp->searchUser->guid;
			$coachId=$resp->searchUser->gncCoachID; 
			$role = $resp->searchUser->customerType;
					
		if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false ) 
		$membertypeid = 388;
		elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
		$membertypeid = 398;
		else
		$membertypeid = 389;
					
					if(!empty($role))
					{
					  if($role != $contact_role)
						{
							//echo "update contact with role";
							$this->model('custom/bbresponsive')->update_contact_with_value_from_IDM($this->session->getProfile()->c_id->value,$role,"role");
							
						}
					}

					if (strpos($role, 'COACH' ) !== false)
					{   
						$rank_url = \RightNow\Utils\Config::getConfig(1000052);  //CUSTOM_CFG_GET_COACH_TEAM
						$rankurl = $rank_url."?coachid=".$coachId ."&guid=". $guid ;
												
								$ch = curl_init($rankurl);
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:1234',
													'x-api-key: '.$key,
													'Content-Type: application/json',
													'id_token: 1234',
													'access_token: 1234'));
								curl_setopt($ch, CURLOPT_TIMEOUT, 30);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_URL, $rankurl);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								$jsonresp = json_decode(curl_exec($ch));
								if($log)
								{
								logmessage($jsonresp);
								}
								$rank = $jsonresp->coachLifetimeRank;
								//logmessage("rank" . $rank );
								if(curl_errno($ch)){
								throw new Exception(curl_error($ch));
								}
								curl_close($ch);
				
						if(!empty($rank))
						{
						  if($rank != $contact_rank)
							{
								//echo "update contact with rank";
								$this->model('custom/bbresponsive')->update_contact_with_value_from_IDM($this->session->getProfile()->c_id->value,$rank,"rank");
								
							}
						}			
								
						
					}
					else
					{
						$rank = 1;
					}
					
					if(is_null($role) OR is_null($rank) )
					{
						throw new Exception("search failed");
					}
						
		if($rank == 1 || $rank == 5 || $rank == 10 || $rank == 15)
		$lifetimeid = 478;
		elseif($rank == 20 || $rank == 25 || $rank == 30 || $rank == 35)
		$lifetimeid = 1365;
		elseif($rank == 40 || $rank == 45 || $rank == 50 || $rank == 55 ||
			   $rank == 60 || $rank == 65 || $rank == 70 || $rank == 75 ||
			   $rank == 80 || $rank == 85 || $rank == 90)
		$lifetimeid = 492;
		
		}
		
		//catch exception
		catch(Exception $e) {
		 // echo 'Message: ' .$e->getMessage();
		 logmessage($e->getMessage());
		 
		 $contact = get_instance()->model('Contact')->get()->result;
		 
		 if(empty($role)) // 2nd api exception should not affect overriding the values set for 1st API result
		 {
			 if($contact->CustomFields->c->member_type)
			 {
				$role = $contact->CustomFields->c->member_type;
				if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false ) 
				$membertypeid = 388;
				elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
				$membertypeid = 398;
				else
				$membertypeid = 389;
				
			 }
			 else
			 {
				$membertypeid = 389;
			 }
		 
		 }
		 
		 if($membertypeid == 388)
		 {
			if($contact->CustomFields->c->lifetime_rank)
			{
				$rank = $contact->CustomFields->c->lifetime_rank;
				if($rank == 1 || $rank == 5 || $rank == 10 || $rank == 15)
				$lifetimeid = 478;
				elseif($rank == 20 || $rank == 25 || $rank == 30 || $rank == 35)
				$lifetimeid = 1365;
				elseif($rank == 40 || $rank == 45 || $rank == 50 || $rank == 55 ||
					   $rank == 60 || $rank == 65 || $rank == 70 || $rank == 75 ||
					   $rank == 80 || $rank == 85 || $rank == 90)
				$lifetimeid = 492;
			}
			
			else
			{
				$lifetimeid = 478;
			}
		 }
		 
		}
		
		
?>

	<div id="coach_details" style="display:none">	
		<rn:widget path="input/SelectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" 
		 default_value="#rn:php:$lifetimeid#">
		<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="true" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Contact.Name.First"  label_input="First" required="false" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Contact.Name.Last"  label_input="Last" required="false" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Incident.c$guid"  label_input="Guid" default_value="#rn:php:$guid#"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$account_verified" label_input="Account Verified" default_value="1"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="1649"/>
		
		
	</div>	
		
<hr>
<input type="hidden" name="consent_full_name" id="consent_full_name" value="<?php echo $consent_full_name;?>">
<input type="hidden" name="consent_email" id="consent_email" value="<?php echo $consent_email;?>">
<input type="hidden" name="consent_phone" id="consent_phone" value="<?php echo $consent_phone;?>">
<input type="hidden" name="consent_relationship" id="consent_relationship" value="<?php echo $consent_relationship;?>">

<div class="content" id="authorized_party">
<div class="full_width">
<p class="h-m">Enter the information for the authorized party below:</p>
</div>
<div class="feield-section">
<div class="field-box">
<rn:widget path="input/TextInput" name="Contact.c$consent_full_name"  label_input="Full Name" required="true" allow_external_login_updates="true"/>
</div>
<div class="field-box">
<rn:widget path="input/TextInput" name="Contact.c$consent_email"  label_input="Email Address" required="true" allow_external_login_updates="true"/>
</div>
<div class="field-box">
<rn:widget path="custom/ResponsiveDesign/coach_consent_validate" name="Contact.c$consent_phone"  label_input="Phone Number" required="true" allow_external_login_updates="true"/>
</div>
<div class="field-box">
<rn:widget path="input/SelectionInput" name="Contact.c$consent_relationship"  label_input="What is their relation to you?" required="true" allow_external_login_updates="true"/>
</div>

</div>
</div>
<hr>

<div class="content">
<div style="padding:5px 0px 10px 0px;" id="permissions">
<div><strong>By filling out this form, you are providing permission for the "authorized party" to make the following administrative changes to your account:</strong><b style="color:#FF0000">*</b></div>
<div style="padding:15px 0 10px 0">
<ul>
<li id="permission1"><input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_0" value="CheckBox-0"> Change of Contact Information (i.e billing or shipping address)</li>
<li><input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_1" value="CheckBox-1"> Change of form of payment**</li>
<li><input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_2" value="CheckBox-2"> Change to subscription orders</li>
</ul>
</div>
</div>
<div><strong>**Another individual may not change banking and compensation information, such as the means by which commissions are paid (updates to the EFT or check settings). Additionally no one else but the Coach named on the account may voluntarily close the account.</strong></div>
<div style="margin-top:20px;"><strong>
By signing below, you are consenting to the use of an Electronic Record and authorizing these changes as the Coach Account holder and understand these changes will remain in effect until you change or revoke this authorization using this form.
</strong><b class="icon_required" style="color:#FF0000">*</b></div>
<p><i>Simply type /s/ before your name; eg., /s/ John Smith. This identifies it as being a signature, letting us know that you consent to the terms and conditions.</i></p>
<!-- <p><b>Signature: </b><b style="color:#FF0000">*</b></p> -->
<!--<rn:widget path="custom/ResponsiveDesign/signature"/>-->
<div>
<input type="text" name="signature" id="signature" style="width: 50%;border-radius: 0px;height: 40px;" />
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/coach_consent_validate"  name="Incident.Subject" required="false" default_value="Coach Account Consent Form Submittal"/>
</div>
</div>
<div class="sub-but">
<rn:widget path="custom/ResponsiveDesign/CustomSubmit" error_location="rn_errorlocation_coach" on_success_url='/app/coach_consent_confirm'/>	
</div>
</div>
</div>
</div>

<? else: ?>
<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
    <div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
	<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
	This form can only be submitted by a Coach.<br/><br/>

</div></div>


<? endif; ?> 
</div>

</div>
</form>
<!-- Modal -->
<form id = "coachremove" method="post" action="/cc/bbresponsivecontroller/coach_consent_remove">
<div style="display:none">
<rn:widget path="input/TextInput" name="Incident.c$free_text"  default_value = "#rn:php:$contactid#" label_input="ContactId"/>
<rn:widget path="input/SelectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" 
		 default_value="#rn:php:$lifetimeid#">
		<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="true" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Contact.Name.First"  label_input="First" required="false" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Contact.Name.Last"  label_input="Last" required="false" allow_external_login_updates="true"/>
		<rn:widget path="input/TextInput" name="Incident.c$guid"  label_input="Guid" default_value="#rn:php:$guid#"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$account_verified" label_input="Account Verified" default_value="1"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="1649"/>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please confirm that you want to remove <? echo ucwords($consent_full_name); ?> as an authorized party on your account
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sty" data-dismiss="modal">Cancel</button>
       <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
	   
		<rn:widget path="custom/ResponsiveDesign/CoachConsentRemove" class="btn btn-primary" on_success_url='/app/coach_consent_confirm' label_button="Confirm" label_submitting_message="Confirm"/>
		
      </div>
    </div>
  </div>
</div>
</form>
<rn:condition_else/>
<div class="form-main">
<div class="form_table">
<div class="content">

<div class="full_width">
<div class="top-txt" style="text-align: center;">
Please sign-in to proceed with coach account consent form. </div>
</div>
</div>
</div>
</div>
 </rn:condition>
 
<script>

$(".close").on('click', function() { 
window.location.href = '/app/home'; 
})
</script> 
</body>
</html>
