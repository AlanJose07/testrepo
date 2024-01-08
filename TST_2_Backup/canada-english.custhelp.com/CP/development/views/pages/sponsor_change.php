<head>
<!-- CANADA ENGLISH -->
<rn:meta title="Sponsor Change" template="standard_responsive_bb.php" clickstream="sponsor_change" login_required="true"/>
<link href="/euf/assets/themes/responsive/css/sponsor_placement.css" rel="stylesheet">
<!-- login_required="true" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<?php

$contact = get_instance()->model('Contact')->get()->result;
$contact_type = $contact->ContactType->ID;
$contact_id = $contact->ID;

$contact_country = isset($contact->Address->Country)?$contact->Address->Country->ID:0;
$contact_country_name = isset($contact->Address->Country)?
$contact->Address->Country->LookupName:0;

$contact_full = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contact_email = $contact_full->Emails[0]->Address;
$member_typ = $contact_full->CustomFields->c->member_type;
$coach_id = $contact_full->CustomFields->c->coach_id;
$guid = $contact_full->CustomFields->c->customer_guid;	



//echo "member_typ_befr = ".$member_typ ;
//print_r($contact_type);

/*
print_r($member_typ);
print_r($coach_id);
print_r($contact_email);
print_r($contact_country_name);
print_r($contact_type);

echo "contact_type_befr = ".$contact_type ;

echo "member_typ_befr = ".$member_typ ;
echo "coach_id_befr = ".$coach_id ;
echo "contact_email = ".$contact_email;
*/
//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id);
if ($guid){	
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid",$contact_country_name,null,null,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,$guid);	
} else {	
$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,null);	
}

?>

<? 	$change = $_GET['change'];
	$contactid = $this->session->getProfile()->c_id->value;
	$authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
	$currentidcoachdate = $authorizeduser->CustomFields->c->currentidcoachdate;
	$currentidpcdate = $authorizeduser->CustomFields->c->currentidpcdate;
	$customertype = $authorizeduser->ContactType->ID;
	if($customertype == 1)
		$role = 'coach';
	elseif($customertype == 4)
		$role = 'pc';	
	if($currentidcoachdate || $currentidpcdate){
		$today = date("Y/m/d");
		$today_timestamp = strtotime($today);
		$current_id_coach_date = date('m/d/Y', $currentidcoachdate);
		$date_limit_currentidcoachdate = date('Y-m-d', strtotime($current_id_coach_date. ' + 10 days'));
		$date_limit_timestamp_currentidcoachdate = strtotime($date_limit_currentidcoachdate);
		
		$current_id_pc_date = date('m/d/Y', $currentidpcdate);
		$date_limit_currentidpcdate = date('Y-m-d', strtotime($current_id_pc_date. ' + 10 days'));
		$date_limit_timestamp_currentidpcdate = strtotime($date_limit_currentidpcdate);
		//echo ($date_limit_timestamp - $today_timestamp)/60/60/24;
		//if((($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0)||(($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0)){
		if(( ( (($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0) || ($currentidcoachdate == NULL) )  &&  ( (($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0) || ($currentidpcdate == NULL) ) ) || (($currentidpcdate != NULL) && ($currentidcoachdate != NULL) && ((($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0) && (($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0))) ){
			$limit = 1; //inside time; form submission allowed
		}else{
			$limit = 2; //outside time ; update now allowed
		} 
	}else{
		$limit = 2;
	}	
	$CI = get_instance();//get codeIgniter instance
	$guid = $CI->session->getSessionData("guid");
	if($change == "sponsor"){
		$changeid = '1748';
	}elseif($change == "placement") {
		$changeid = '1747';
	}
//$limit = 1;
//$role = "coach";
?>	

<? if($change != 'sponsor' && $change != 'placement'): ?>

	<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
    <div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
	<br/>
	
	<div>To request a Placement Change <strong><a href="/app/sponsor_change?change=placement" target="_blank">click here</a>.</strong></div>
	<br/>
<div>To request a Sponsor Change <strong><a href="/app/sponsor_change?change=sponsor" target="_blank">click here</a>.</strong></div>
	</div></div>

<? else: ?>

	<? if($role == 'coach'): ?>
		<? if($change == 'sponsor' && $limit == 1): ?>
		<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
			<div id="rn_content" class="rn_questionform">
				<div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">
					
				</div>
	
				<div class="container">
				<div class="rn_wrap rn_padding wrappad">
					<form id="rn_sponsorChange" method="post" action="/cc/AjaxCustom/sendSponsorForm" onsubmit="return false;" >
					
						<div style="padding-left: 5px;"></div>
						<div id="rn_ErrorLocation_ccc"></div>
						<div class="form_section ccc_begin">
						
						 <h2 class="ccc_title">Sponsor Change</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>Use this form to request the change of your current Sponsor. For more information please visit <a href="/app/answers/detail/a_id/2337">FAQ 2337</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/sponsor_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Request Details</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Enter your desired Sponsor's first and last name" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Enter your desired Sponsor's email" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="Enter your desired Sponsor's Partner ID"/>
							<div style="display:none">
								<rn:widget path="input/TextInput"  name="Incident.Threads"/>
							</div>
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Sponsor Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" allow_external_login_updates="true" />

<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value="1748"/><!-- UPDATE -->

</div>						
					<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/sponsor_placement_change_confirm/change/1748"/>
					</div>
				</form>
			  </div>
					</div>
			</div>
		</div>
		<? elseif($change == 'placement'): ?>
		<?
						try					
						{
							    if(function_exists('curl_init') === false){
									load_curl();
								}
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
								$guid = $resp->searchUser->guid;
								$coachId=$resp->searchUser->gncCoachID;
								$role = $resp->searchUser->customerType;
								if (strpos($role, 'COACH' ) !== false)
								{ 
										$rank_url = \RightNow\Utils\Config::getConfig(1000052);  //CUSTOM_CFG_GET_COACH_TEAM
										$key = \RightNow\Utils\Config::getConfig(1000068);	//CUSTOM_CFG_AWS_API_KEY  
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
										$rank = $jsonresp->coachLifetimeRank;
								
										if(curl_errno($ch)){
										throw new Exception(curl_error($ch));
										}
										curl_close($ch);
										if(!empty($rank) && $rank>=40 && $rank<=90)
										{
											$form_routing=1869;
										}
										else
											$form_routing=1747;
				
								}
						}
						catch(Exception $e) 
						{
							echo 'Message: ' .$e->getMessage();
						}
		     ?>
			<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
			<div id="rn_content" class="rn_questionform">
				<div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">
					
				</div>
	
				<div class="container">
				<div class="rn_wrap rn_padding wrappad">
					<form id="rn_sponsorChange" method="post" action="/cc/AjaxCustom/sendPlacementForm" onsubmit="return false;" >
					
						<div style="padding-left: 5px;"></div>
						<div id="rn_ErrorLocation_ccc"></div>
						<div class="form_section ccc_begin">
						
						 <h2 class="ccc_title">Placement Change</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>Use this form to request a Placement Change for your Personally Sponsored (PS) Partner/Preferred Customer. For more information please visit <a href="/app/answers/detail/a_id/2337">FAQ 2337</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/placement_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Your Personally Sponsored Partner/Preferred Customer’s Information</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Full Name" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Email Address" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="Partner ID"/>
							<h2 style="color:black;font-size: 1.6em !important;">Placement Change Request Details</h2>
							
							<div id = "ps_coach_new_position">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$ps_coach_new_position"  label_input="Please select your PS Partner/Preferred Customer new Position" />
							</div>
							
							<div id = "multiple_cbcs" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$multiple_cbcs"  label_input="Do you own multiple Business Centers?"/>
						    </div>
							<div id = "change_sponsor_cbc_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$change_sponsor_cbc_id"  label_input="Would you like to change the Sponsor of your Personally Sponsored Partner/Preferred Customer to a different Business Center ID that you own?"/>
						    </div>
							<div id = "ccc_transfer_coachorder" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coachorder"  label_input="Please provide the Business Center ID that you’d like your Partner/Preferred Customer sponsored by" />
							</div>
							
							<div id = "new_coach_placed_specifically" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$new_coach_placed_specifically"  label_input="Would you like your new Partner placed on a specific leg under a specific Partner?"/>
						    </div>
							
							<div id = "ccc_transfer_coach_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_id"  label_input="Partner Placement ID" />
							</div>
							
							<div id = "leg_placement" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$leg_placement"  label_input="Left or Right leg of the Partner Placement ID?"/>
						    </div>
							
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Placement Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" allow_external_login_updates="true" />

<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value="#rn:php:$form_routing#"/>

</div>					
							<div style="display:none">
								<rn:widget path="input/TextInput"  name="Incident.Threads"/>
							</div>	
					<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/sponsor_placement_change_confirm/change/1747"/>
					</div>
				</form>
			  </div>
					</div>
			</div>
		</div>
			<? elseif($change == 'sponsor' && $limit == 2): ?>
		
				<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
<div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
<span style="color:#bf2600;font-weight: bold;">You are receiving this message because you are outside of the 10-day time-frame and are ineligible to request a Sponsor change - there are no exceptions to this policy.</span><br/><br/><span style="font-weight: bold;color:#172B4D;"> We understand that support is vital in reaching your goals and although Sponsor change is not an option, we are here to help! We have multiple resources to help you, whether you are just getting started or have been with us for a while and want to expand.</span> &nbsp;<br/><br/>

<ol style="padding-left: 40px;font-weight: 300;">
        <li><a href="https://coach.teambeachbody.com/welcome?error=login_required&error_description=No+authenticated+session+found.&state=15f6f97a930a485fafc25c33bd733303" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">Upline Partner Team</a>:  Select “Team” on your dashboard to connect with upline Diamond and Star Diamond Partners within your organization – get connected and get tips from the best.&nbsp;</li>
        <li><a href="https://coach.teambeachbody.com/welcome?error=login_required&error_description=No+authenticated+session+found.&state=15f6f97a930a485fafc25c33bd733303" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">The Office Training Library</a>: Search our collection of training materials to reference information that will help you develop your business. Once logged in, hover over “Training.” &nbsp;</li>
        <li><a href="https://www.facebook.com/groups/714750508580210/" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">BODi Businees Training Page</a>: This is an Official BODi Partner training and support group for any Partner who wants to elevate their business and learn best practices.&nbsp;</li>

</ol><br/>
<span style="color:#bf2600;font-weight: bold;">Note: For compliance reasons, Customer Support does not have the ability to assist with changing your Sponsor.
</span> <br/><br/> 
</div></div>
		
			<? endif; ?>
	<? else: ?>	

		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
		<div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
		<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
		This form can only be submitted by a Partner. <br/><br/> Please reference <a href="/app/answers/detail/a_id/2336">FAQ 2336</a>: Change My Partner for additional details.<br/><br/>
	
		</div></div>
		
	<? endif; ?>
	
<? endif; ?>	

