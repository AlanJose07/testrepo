<head>
<!-- US SPANISH --> 
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
		//echo ($date_limit_timestamp - $today_timestamp)/60/60/24;///
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
	
	<div>Para solicitar un cambio de posición, haz <strong><a href="/app/sponsor_change?change=placement" target="_blank">clic aquí</a>.</strong></div>
	<br/>
<div>Para solicitar un cambio de patrocinador, haz <strong><a href="/app/sponsor_change?change=sponsor" target="_blank">clic aquí</a>.</strong></div>
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
						
						 <h2 class="ccc_title">Cambio de Patrocinador</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>Usa este formulario para solicitar el cambio de tu patrocinador actual. Para obtener más información, consulta las <a href="/app/answers/detail/a_id/11715">FAQ 11715</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Campo requerido</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/sponsor_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Detalles de la Solicitud</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Escribe el nombre y el apellido del patrocinador que deseas tener" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Escribe la dirección de correo electrónico del patrocinador que deseas tener" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="Ingresa el ID de partner de tu partner deseado"/>
							<div style="display:none">
								<rn:widget path="input/TextInput"  name="Incident.Threads"/>
							</div>
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Sponsor Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Correo Electrónico" allow_external_login_updates="true" />

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
						
						 <h2 class="ccc_title">Cambio de Posición</h2>
						
						<div id="Language_Header_English" style="display:block;">
						<p><strong>	Utiliza este formulario para solicitar un cambio de posición para tu partner patrocinado personalmente (PP) o cliente preferente. Para obtener más información, consulta las <a href="/app/answers/detail/a_id/11715">FAQ 11715</a>.<br /><br /></strong>
							
							</p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Campo requerido</div>
							<div id="permissions"> <rn:widget path="custom/ResponsiveDesign/placement_change_checkbox"/></div>
		  					
							<div id = "request_details" style="display:none">
							<h2 style="color:black;font-size: 1.6em !important;">La información de tu partner patrocinado personalmente o cliente preferente</h2>
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_full_name"  label_input="Nombre Completo" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_email"  label_input="Dirección de Correo Electrónico" />
							
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$placement_sponsor_coach_id"  label_input="ID de Partner"/>
							<h2 style="color:black;font-size: 1.6em !important;">Detalles de la solicitud de cambio de posición</h2>
							
							<div id = "ps_coach_new_position">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$ps_coach_new_position"  label_input="Selecciona la nueva posición* de tu partner patrocinado personalmente (PP) o cliente preferente" />
							</div>
							
							<div id = "multiple_cbcs" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$multiple_cbcs"  label_input="Tienes varios centros de negocios?"/>
						    </div>
							<div id = "change_sponsor_cbc_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$change_sponsor_cbc_id"  label_input="¿Quieres cambiar el patrocinador de tu partner patrocinado personalmente o cliente preferente al ID de otro centro de negocios tuyo?"/>
						    </div>
							<div id = "ccc_transfer_coachorder" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coachorder"  label_input="Proporciona el ID del centro de negocios que deseas que patrocine a tu partner o cliente preferente" />
							</div>
							
							<div id = "new_coach_placed_specifically" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$new_coach_placed_specifically"  label_input="¿Quieres que tu nuevo partner se coloque en la lista debajo de un partner específico?"/>
						    </div>
							
							<div id = "ccc_transfer_coach_id" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate" name="Incident.c$ccc_transfer_coach_id"  label_input="ID de posición del Partner" />
							</div>
							
							<div id = "leg_placement" style="display:none">
							<rn:widget path="custom/ResponsiveDesign/placement_selectioninput" name="Incident.c$leg_placement"  label_input="¿Rama izquierda o derecha del ID de posición del partner?" />
						    </div>
							
						</div>
<div style="display:none">
<rn:widget path="custom/ResponsiveDesign/sponsor_placement_validate"  name="Incident.Subject" required="false" default_value="Placement Change Form Submittal"/>

<rn:widget path="input/TextInput" name="Contact.Emails.PRIMARY.Address" label_input="Dirección de Correo Electrónico" allow_external_login_updates="true" />

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
		<span style="color:#bf2600;font-weight: bold;">Recibes este mensaje porque estás fuera del plazo de 10 días y no eres elegible para solicitar un cambio de patrocinador. No hay excepciones a esta política.</span><br/><br/><span style="font-weight: bold;color:#172B4D;"> Entendemos que el apoyo es fundamental para lograr tus metas y aunque el cambio de patrocinador no es una opción, ¡estamos aquí para ayudarte! Disponemos de múltiples recursos para ayudarte, tanto si acabas de comenzar como si llevas tiempo con nosotros y quieres ampliarte.</span> &nbsp;<br/><br/>

		<ul style="padding-left: 15px;font-weight: 300;">
							<li><a href="https://coach.teambeachbody.com/esus" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">  Equipo de partner de línea ascendente</a>:  selecciona “equipo” en tu tablero para conectarte con partners de línea ascendente Diamante y Diamante Estrella dentro de tu organización. Conéctate y recibe los consejos de los mejores!&nbsp;</li>
							<li><a href="https://coach.teambeachbody.com/esus/biblioteca-de-entrenamiento?locale=es_us" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Biblioteca de capacitación The Office</a>:  busca dentro de nuestra colección de material de capacitación para la información referente que te ayudará a desarrollar tu negocio. Inicia sesión y pasa el cursor por encima de “capacitación”.&nbsp;</li>
							<li><a href="https://www.facebook.com/groups/331650074654310" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Página de capacitación de negocio BODi</a>: este es un grupo oficial de capacitación y apoyo de partners de BODi para cualquier partner que quiera elevar su negocio y aprender sobre las mejores prácticas.&nbsp;</li>

		</ul><br/>
	<span style="color:#bf2600;font-weight: bold;">Nota: por motivos de cumplimiento, atención al cliente no tiene las capacidades para ayudarte a cambiar tu patrocinador.</span><br/><br/>	
	
		</div>
	
	</div>
	
		<? endif; ?>
	<? else: ?>	

		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
		<div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
		<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
		Este formulario solo puede enviarlo un partner.
<br/><br/>
Consulta las preguntas frecuentes <a href="/app/answers/detail/a_id/11374">(FAQ) 11374</a>: Cambio de partner, para encontrar más detalles.
		<br/><br/>
	
		</div></div>
		
	<? endif; ?>
	
<? endif; ?>	

