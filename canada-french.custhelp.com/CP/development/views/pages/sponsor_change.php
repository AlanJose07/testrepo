<head>
<!-- CANADA FRENCH -->
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

if ($guid){	
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid",$contact_country_name,null,null,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,$guid);	
} else {	
$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,null);	
}

//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id);

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
	
	<div>Pour demander un changement de placement, <strong><a href="/app/sponsor_change?change=placement" target="_blank">cliquez ici</a>.</strong></div>
	<br/>
<div>Pour demander un changement de parrain, <strong><a href="/app/sponsor_change?change=sponsor" target="_blank">cliquez ici</a>.</strong></div>
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
						
						 <h2 class="ccc_title">Changement de Parrain</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>Utilisez ce formulaire pour demander le changement de votre parrain actuel. Pour plus d’informations, consultez la <a href="/app/answers/detail/a_id/12569">FAQ 12569</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Champs requis</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/sponsor_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Détails de la Demande</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Saisissez le prénom et le nom du parrain que vous souhaitez avoir" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Saisissez l’e-mail du parrain que vous souhaitez avoir" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="Saisissez l’identifiant partner du parrain que vous souhaitez avoir"/>
							<div style="display:none">
								<rn:widget path="input/TextInput"  name="Incident.Threads"/>
							</div>
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Sponsor Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Adresse E-mail" allow_external_login_updates="true" />

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
						
						 <h2 class="ccc_title">Changement de Placement</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>Utilisez ce formulaire pour demander un changement de placement pour votre partner personnellement parrainé (PP) ou votre client privilégié. Pour plus d’informations, consultez la <a href="/app/answers/detail/a_id/12569">FAQ 12569</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Champs requis</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/placement_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Informations de votre partner personnellement parrainé ou client privilégié</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Nom complet" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Adresse E-mail" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="Identifiant de Partner"/>
							<h2 style="color:black;font-size: 1.6em !important;">Détails de la demande de changement de placement</h2>
							
							<div id = "ps_coach_new_position">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$ps_coach_new_position"  label_input="Veuillez sélectionner le nouveau placement de votre partner PP/client privilégié" />
							</div>
							
							<div id = "multiple_cbcs" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$multiple_cbcs"  label_input="Possédez-vous plusieurs centres d’activité?"/>
						    </div>
							<div id = "change_sponsor_cbc_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$change_sponsor_cbc_id"  label_input="Souhaitez-vous changer le parrain de votre partner PP/client privilégié et utiliser l’identifiant d’un autre de vos centres d’activité ?"/>
						    </div>
							<div id = "ccc_transfer_coachorder" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coachorder"  label_input="Veuillez indiquer l’identifiant du centre d’activité que vous souhaitez utiliser pour parrainer votre partner/client privilégié" />
							</div>
							
							<div id = "new_coach_placed_specifically" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$new_coach_placed_specifically"  label_input="Souhaitez-vous que votre nouveau partner soit placé dans une branche spécifique sous un partner spécifique?"/>
						    </div>
							
							<div id = "ccc_transfer_coach_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_id"  label_input="Identifiant de Placement du Partner" />
							</div>
							
							<div id = "leg_placement" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$leg_placement"  label_input="Branche gauche ou droite de l’identifiant de placement du partner?"/>
						    </div>
							
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Placement Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Adresse E-mail" allow_external_login_updates="true" />

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
		<span style="color:#bf2600;font-weight: bold;">Vous recevez ce message car vous avez dépassé le délai de 10 jours et que vous n’avez pas le droit de demander un changement de parrain. Il n’y a pas d’exception à cette politique.</span><br/><br/><span style="font-weight: bold;color:#172B4D;"> Nous comprenons que le soutien est vital pour atteindre vos objectifs, et bien que le changement de parrain ne soit pas une option, nous sommes là pour vous aider ! Nous mettons de nombreuses ressources à votre disposition, que vous veniez de démarrer ou que vous ayez une certaine ancienneté et souhaitiez vous développer.</span> &nbsp;<br/><br/>

		<ul style="padding-left: 15px;font-weight: 300;">
							<li><a href="https://coach.teambeachbody.com/frfr/bibliotheque-de-formation-2?locale=fr_fr" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Équipe des partners de la lignée ascendante</a>:  Sélectionnez « Équipe » sur votre tableau de bord pour entrer en contact avec les partners Diamant et Diamant étoile de la lignée ascendante au sein de votre organisation et obtenir des conseils des meilleurs !&nbsp;</li>
							<li><a href="https://coach.teambeachbody.com/frfr/bibliotheque-de-formation-2?locale=fr_fr" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Bibliothèque de formation de The Office</a>: Recherchez dans notre collection de ressources de formation pour trouver toutes les informations qui vous aideront à développer votre entreprise. Une fois connecté, passez la souris sur « Formation ».&nbsp;</li>
							<li><a href="https://www.facebook.com/groups/beachbodycoachsfrancophones" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Page de formation des entreprises BODi</a> : Il s’agit d’un groupe officiel de formation et de soutien destiné à tous les partners BODi qui souhaitent développer leur entreprise et apprendre les meilleures pratiques.&nbsp;</li>

		</ul><br/>
	<span style="color:#bf2600;font-weight: bold;">Remarque : Pour des raisons de conformité, le Service client n’est pas en mesure de vous assister dans le changement de votre parrain.</span><br/><br/>			
		</div>
	
	</div>
		
			<? endif; ?>
	<? else: ?>	

		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
		<div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
		<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
		Ce formulaire doit être envoyé par un Partner. <br/><br/> Veuillez consulter la <a href="/app/answers/detail/a_id/11893">FAQ 11893</a>: Changer mon partner, pour plus de détails.
		<br/><br/>
	
		</div></div>
		
	<? endif; ?>
	
<? endif; ?>	

