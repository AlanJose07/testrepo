<head>
	<style>
		.CustCoachMessage {
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
	<rn:meta title="Customer Partner Change" template="standard_responsive_bb.php" clickstream="incident_create"
		login_required="true" />
	<!-- login_required="true" -->
</head>
<?php

$contact = get_instance()->model('Contact')->get()->result;
$contact_type = $contact->ContactType->ID;
$contact_id = $contact->ID;

$contact_country = isset($contact->Address->Country) ? $contact->Address->Country->ID : 0;
$contact_country_name = isset($contact->Address->Country) ?
	$contact->Address->Country->LookupName : 0;

$contact_full = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contact_email = $contact_full->Emails[0]->Address;
$member_typ = $contact_full->CustomFields->c->member_type;
$coach_id = $contact_full->CustomFields->c->coach_id;
$guid = $contact_full->CustomFields->c->customer_guid;

//print_r($member_typ);
//print_r($coach_id);
//print_r($contact_email);
//print_r($contact_country_name);
//print_r($contact_type);

//echo "contact_type_befr = ".$contact_type ;

//echo "member_typ_befr = ".$member_typ ;
//echo "coach_id_befr = ".$coach_id ;
//echo "contact_email = ".$contact_email "<br>";

if ($guid) {
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid", $contact_country_name, null, null, null, null, null, "CUST", $member_typ, $contact_type, $coach_id, $guid, $contact_email);
} else {
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email", $contact_country_name, null, $contact_email, null, null, null, "CUST", $member_typ, $contact_type, $coach_id, null, $contact_email);
}

//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id);

$base_uri = '';
if ($contact_country != 0) {
	if ($contact_country == 2) //Canada
	{
		$base_uri = 'https://faq.beachbody.ca';
	}
	if ($contact_country == 7) //UK
	{
		$base_uri = 'https://faq.beachbody.co.uk';
	}
}
?>

<?
$contactfull = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contacttyp = $contactfull->ContactType->ID;
//echo "<br> contacttyp_after = ".$contacttyp;
//print_r($contacttyp);

?>

<? if ($contacttyp != 1 && $contacttyp != 4): // Customer & PC 
	
	?>
	
	<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
		<div id="rn_content" class="rn_questionform">
			<div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">

			</div>

			<div class="container">
				<div class="rn_wrap rn_padding wrappad">
					<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;">

						<div style="padding-left: 5px;">
						</div>
						<div id="rn_ErrorLocation_ccc"></div>
						<div class="form_section ccc_begin">

							<h2 class="ccc_title"> Partner Request Form </h2>

							<div id="Language_Header_English" style="display:block;">
								<p><strong>
										Use this form to get or change your BODi Partner. Refer to <a
											href="/app/answers/detail/a_id/3000/catid/0/TLP/0">FAQ 3000</a> for some tips on
										how to find a BODi Partner that's right for your BODi journey.<br /><br />

									</strong></p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>


							<div id=div_country>
								<rn:widget path="custom/ccc_form/SelectionInputCountry" name="Contact.Address.Country"
									label_input="Country" required="true" allow_external_login_updates="true" />
							</div>
							<!---------------------	 Language Dropdown-------------->
							<div style="display:none">


								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language"
									label_input="Language/Idioma/Langue" default_value="751" />
							</div>
							<div id="email_redesign" class="cr_details">
								<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address"
									label_input="Email Address" required="false" allow_external_login_updates="true"
									required="true" />
							</div>

							<!-----------------Coach or Customer Dropdown-------------->

							<div id="coach_or_customer_english_redesign" style="display:block">
								<rn:widget path="custom/ccc_form/SelectionInputLanguage"
									name="Incident.CustomFields.c.member_type_eng" required="true"
									label_input="Do you have a Partner referral?" />
							</div>
							<div id="yes_no_main_div" style="display:none">
								<h2 style="color:black;font-size: 1.6em !important;">Enter your BODi Partner’s Information
									below: </h2>
								<p>
									<!--<strong style="color:red;">
						Note: 
						</strong>
						The Coach entered below will receive credit for orders placed within 14 days of this request. No additional action is required.
						</p>-->

									<rn:widget path="custom/ccc_form/TextInputCCC"
										name="Incident.CustomFields.c.ccc_transfer_coach_email"
										label_input="BODi Partner Email Address" required="false" />
									<rn:widget path="custom/ccc_form/TextInputCCC"
										name="Incident.CustomFields.c.ccc_transfer_coach_name"
										label_input="BODi Partner Name" required="false" />

								<div style="padding:0px 0px 10px 0px;" id="permissions">
									<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10"
										id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b
										style="color:#FF0000"> *</b> By checking the box, you are verifying that the BODi
									Partner information you provided in this form is complete and accurate. Your request may
									be delayed if incorrect information is received.

								</div>

							</div>


							<div id="eng_last_head" style="display:none">
								<h4>The request will be processed within 24 hours of submission.</h4>
							</div>

							<div style="display:none">
								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing"
									required="false" default_value="772" />
								<rn:widget path="custom/ccc_form/customer_coach_checkbox" name="Incident.Subject"
									required="false" default_value="Your BODi Customer Partner Change Request" />
								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng"
									required="false" default_value="754" />
							</div>

							<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc"
								label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm/ctype/2" />

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<? else: ?>
	<? if ($contacttyp == 4): // PC 
				date_default_timezone_set('Pacific Standard Time');
				$contactid = $this->session->getProfile()->c_id->value;
				$authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
				$currentidcoachdate = $authorizeduser->CustomFields->c->currentidcoachdate;
				$currentidpcdate = $authorizeduser->CustomFields->c->currentidpcdate;

				if ($currentidcoachdate || $currentidpcdate) {
					// echo $currentidcoachdate."--PC Date-".$currentidpcdate."<br>";
					$today = date("Y/m/d");
					// echo "<br> today = ".$today;
					$today_timestamp = strtotime($today);

					$current_id_coach_date = $currentidcoachdate;
					//echo "<br><br> current_id_coach_date = ".$current_id_coach_date;
					$date_limit_currentidcoachdate = date('Y/m/d', strtotime($current_id_coach_date . ' + 10 days'));
					
					//echo "<br> date_limit_currentidcoachdate (+10) = ".$date_limit_currentidcoachdate;
					$date_limit_timestamp_currentidcoachdate = strtotime($date_limit_currentidcoachdate);

					//echo "<br><br> currentidpcdate = ".$currentidpcdate;
		
					$current_id_pc_date = $currentidpcdate;
					//echo "<br><br> updated currentidpcdate = ".$currentidpcdate;
					//echo "<br><br> current_id_pc_date = ".$current_id_pc_date;
					$date_limit_currentidpcdate = date('Y/m/d', strtotime($current_id_pc_date . ' + 10 days'));
					//echo "<br> date_limit_currentidpcdate (+10) = ".$date_limit_currentidpcdate;
					$date_limit_timestamp_currentidpcdate = strtotime($date_limit_currentidpcdate);

					/*echo "<br> (date_limit_timestamp_currentidcoachdate - today_timestamp)/60/60/24 = ".($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24;
						  echo "<br> >=0 AND <br>";
						  echo "<br> (date_limit_timestamp_currentidpcdate - today_timestamp)/60/60/24 = ".($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24;
						  echo "<br> >=0 <br>";*/

					//if((($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0)||(($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0))
					/*echo "<br><br> CONDTN 1: ".($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24;
						  echo "<br> CONDTN 1: ".($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24;*/

					/*if(($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0)
						  {
							  echo "1T";
						  }
						  else
						  {
							  echo "1F";
						  }
						  if($currentidcoachdate == NULL)
						  {
							  echo "2T";
						  }
						  else
						  {
							  echo "2F";
						  }
						  if(($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0)
						  {
							  echo "3T";
						  }
						  else
						  {
							  echo "3F";
						  }
						  if($currentidpcdate == NULL)
						  {
							  echo "4T";
						  }
						  else
						  {
							  echo "4F";
						  }
						  if($currentidpcdate != NULL)
						  {
							  echo "5T";
						  }
						  else
						  {
							  echo "5F";
						  }
						  if($currentidcoachdate != NULL)
						  {
							  echo "6T";
						  }
						  else
						  {
							  echo "6F";
						  }
						  if(($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0)
						  {
							  echo "7T";
						  }
						  else
						  {
							  echo "7F";
						  }
						  if(($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0)
						  {
							  echo "8T";
						  }
						  else
						  {
							  echo "8F";
						  }
						  die;*/

					if ((((($date_limit_timestamp_currentidcoachdate - $today_timestamp) / 60 / 60 / 24 >= 0) || ($currentidcoachdate == NULL)) && ((($date_limit_timestamp_currentidpcdate - $today_timestamp) / 60 / 60 / 24 >= 0) || ($currentidpcdate == NULL))) || (($currentidpcdate != NULL) && ($currentidcoachdate != NULL) && ((($date_limit_timestamp_currentidcoachdate - $today_timestamp) / 60 / 60 / 24 >= 0) && (($date_limit_timestamp_currentidpcdate - $today_timestamp) / 60 / 60 / 24 >= 0)))) {
						$limit = 1; //inside time; form submission allowed
					} else {
						$limit = 2; //outside time ; update now allowed
					}
				} else {
					$limit = 2;
				}
				//echo "\n \n === limit is : ".$limit;
				//die("----------------");
		
				?>

		<? if ($limit == 1): ?>
			<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
				<div id="rn_content" class="rn_questionform">
					<div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">

					</div>

					<div class="container">
						<div class="rn_wrap rn_padding wrappad">
							<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;">

								<div style="padding-left: 5px;">
								</div>
								<div id="rn_ErrorLocation_ccc"></div>
								<div class="form_section ccc_begin">

									<h2 class="ccc_title"> Preferred Customer: Partner Change Request Form</h2>

									<div id="Language_Header_English" style="display:block;">
										<p><strong>
												Use this form to change your BODi Partner.<br /><br />

											</strong></p>
									</div>
									<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>


									<div id=div_country>
										<rn:widget path="custom/ccc_form/SelectionInputCountry" name="Contact.Address.Country"
											label_input="Country" required="true" allow_external_login_updates="true" />
									</div>
									<!---------------------	 Language Dropdown-------------->
									<div style="display:none">


										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language"
											label_input="Language/Idioma/Langue" default_value="751" />
									</div>
									<div id="email_redesign">
										<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address"
											label_input="Email Address" required="false" allow_external_login_updates="true"
											required="true" />
									</div>

									<!-----------------Coach or Customer Dropdown-------------->
									<div id="coach_or_customer_english_redesign" style="display:none">
										<rn:widget path="custom/ccc_form/SelectionInputLanguage"
											name="Incident.CustomFields.c.member_type_eng" required="false"
											label_input="Do you have a Partner referral?" />
									</div>
									<div id="yes_no_main_div">
										<h2 style="color:black;font-size: 1.6em !important;">Enter the Partner information of whom
											you would like to be transferred to: </h2>

										<rn:widget path="custom/ccc_form/TextInputCCC"
											name="Incident.CustomFields.c.ccc_transfer_coach_email"
											label_input="Partner Email Address" required="true" />
										<rn:widget path="custom/ccc_form/TextInputCCC"
											name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Partner Name"
											required="true" />

										<div style="padding:0px 0px 10px 0px;" id="permissions">
											<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10"
												id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b
												style="color:#FF0000"> *</b> By checking the box, you are verifying that the Partner
											information you provided in this form is complete and accurate. Your request may be
											delayed if incorrect information is received.

										</div>

									</div>


									<div id="eng_last_head" style="display:none">
										<h4>The request will be processed within 2 business days of submission.</h4>
									</div>


									<div style="display:none">
										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing"
											required="false" default_value="1731" />
										<rn:widget path="custom/ccc_form/customer_coach_checkbox" name="Incident.Subject"
											required="false" default_value="Your BODi Preferred Customer Partner Change Request" />
										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng"
											required="false" default_value="754" />
									</div>

									<p> The request will be processed within 2 business days of submission. </p>

									<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc"
										label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm/ctype/4" />

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<? else: ?>

			<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
				<div style="padding-left: 38px;font-weight: 600;" class="rn_ccc_restrict">
					<br /><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
					<span style="color:#bf2600;font-weight: bold;">You are receiving this message because you are outside of the
						10-day time-frame and are ineligible to request a Sponsor change - there are no exceptions to this
						policy.</span><br /><br /><span style="font-weight: bold;color:#172B4D;">We understand that support is vital
						in reaching your goals and although Sponsor change is not an option, we are here to help! We have multiple
						resources to help you, whether you are just getting started or have been with us for a while and want to
						expand. </span> &nbsp;<br /><br /><span style="font-weight: 300;">Explore these options to maximize
						success:</span> &nbsp;<br /><br />

					<ol style="padding-left: 30px;font-weight: 300;">
						<li><a href="https://www.beachbodyondemand.com/groups-about?locale=en_US"
								style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">Join a
								BODgroup</a>: This is a Beachbody exclusive community-based platform that helps you stay motivated,
							accountable, and connected to reach your goals. Within the BOD site/app, you can also track your daily
							activities and progress.<br />Many Partners run open BODgroups and are more than happy to have you join
							their accountability group even if you are assigned to a different Partner. If you have a Partner in
							mind, you can either ask them to add you or they can send you their BODgroup link to join.&nbsp;</li>
						<li><a href="https://www.facebook.com/groups/bodmembers"
								style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">BOD
								Facebook Group</a>: A big part of being motivated is finding your tribe. Join our thriving Facebook
							group of over 95K members for peer support and accountability.&nbsp;</li>
						<li><a href="https://www.beachbodyondemand.com/blog/?"
								style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;"
								target="_blank">Beachbody Blog</a>: Click here for the latest in health and fitness.&nbsp;</li>

					</ol><br />
					<span style="font-weight: 300;">For additional details on this policy, view <a
							href="/app/answers/detail/a_id/2336/catid/0/TLP/0" style="color:#0052CC;">FAQ 2336</a>.</span>
					<br /><br />
				</div>
			</div>

		<? endif; ?>

	<? else: ?>
		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
			<div style="padding-left: 38px;font-weight: 600;" class="rn_ccc_restrict">
				<br /><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
				This form can only be submitted by a Customer/Preferred Customer. <br /><br /> Please reference FAQ <a
					href="<?= $base_uri ?>/app/answers/detail/a_id/2336/catid/0/TLP/0">2336</a>: Get or Change my BODi Partner
				for additional details.<br /><br />If you are a BODi Partner attempting to change your Sponsor, please reference
				FAQ <a href="<?= $base_uri ?>/app/answers/detail/a_id/2337/catid/0/TLP/0">2337</a>: Genealogy - Sponsor Change &
				Placement Change.

			</div>
		</div>
	<? endif; ?>

<? endif; ?>