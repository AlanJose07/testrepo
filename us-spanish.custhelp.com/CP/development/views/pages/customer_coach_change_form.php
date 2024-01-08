<head>
<style>
.CustCoachMessage{ 
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
<rn:meta title="Customer Partner Change" template="standard_responsive_bb.php" clickstream="incident_create" login_required="true"/>

<!-- login_required="true" -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    
<?php

$contact = get_instance()->model('Contact')->get()->result;
$contact_type = $contact->ContactType->ID;
$contact_id = $contact->ID;
//echo "<br> contact_type = ".$contact_type;
//echo "<br> contact_id = ".$contact_id;

$contact_country = isset($contact->Address->Country)?$contact->Address->Country->ID:0;
$contact_country_name = isset($contact->Address->Country)?$contact->Address->Country->LookupName:0;
//echo "<br> contact_country = ".$contact_country_name;
$contact_full = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contact_email = $contact_full->Emails[0]->Address;
$member_typ = $contact_full->CustomFields->c->member_type;
$coach_id = $contact_full->CustomFields->c->coach_id;
$guid = $contact_full->CustomFields->c->customer_guid;

//echo "<br> member_typ = ".$member_typ;
//echo "<br> coach_id = ".$coach_id;
//echo "<br> contact_email = ".$contact_email "<br>";

if ($guid){		
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid",$contact_country_name,null,null,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,$guid);		
} else {		
$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,null);		
}

//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id);

?>

<?
$contactfull = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contacttyp = $contactfull->ContactType->ID;
//echo "<br> contacttyp = ".$contacttyp;

?>
<? if($contacttyp != 1 && $contacttyp !=4): // Customer ?>

<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
		<div id="rn_content" class="rn_questionform">
            <div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">
                
            </div>

            <div class="container">
			<div class="rn_wrap rn_padding wrappad">
				<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;" >
				
					<div style="padding-left: 5px;">
					</div>
					<div id="rn_ErrorLocation_ccc"></div>
					<div class="form_section ccc_begin">
					
					 <h2 class="ccc_title"> Formulario de solicitud de partner</h2>
					
					<div id="Language_Header_English" style="display:block;">
					<p><strong>
					Usa este formulario para obtener o cambiar tu partner de BODi. Consulta las <a href="/app/answers/detail/a_id/3000/catid/0/TLP/0">FAQ 3000</a> para algunos consejos de cómo encontrar un partner de BODi adecuado para tu trayecto BODi.<br /><br />
	
						</strong></p>
						</div>
						<div class="rn_RequiredText rn_FloatRight">*&nbsp;Campo requerido</div>
						
      
						
							<!---------------------	 Language Dropdown-------------->
							<div style="display:none">
		                   <div id=div_country> <rn:widget path="input/SelectionInput" name="Contact.Address.Country" label_input="Country/Pais/Pays"  allow_external_login_updates="true"/></div>
							
							<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language" label_input="Language/Idioma/Langue" default_value="753"/> <!-- -->
							</div>
							<div id="email_redesign" class="cr_details">
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address" label_input="Dirección de correo electrónico" required="false" allow_external_login_updates="true" required="true"/>
							</div>
							
							<!-----------------Coach or Customer Dropdown-------------->
							
							<div id="coach_or_customer_english_redesign" style="display:block">
							<rn:widget path="custom/ccc_form/SelectionInputLanguage" name="Incident.CustomFields.c.member_type_eng" required="true" label_input="¿Tienes una referencia para un partner?" label_required="es requerido"/>
							</div>
							<div id = "yes_no_main_div" style = "display:none">
							<h2 style="color:black;font-size: 1.6em !important;">Ingresa la información de tu partner de BODi a continuación:</h2>
							<p>
						<!--<strong style="color:red;">
						Nota: 
						</strong>
						El Coach ingresado a continuación recibirá crédito por pedidos realizados dentro de los 14 días de esta solicitud. No se requiere ninguna acción adicional.
						</p>-->
							
							 <rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_email" label_input ="Correo electrónico del partner de BODi" required="false" />
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Nombre del partner de BODi" required="false" /> 
							
							<div style="padding:0px 0px 10px 0px;" id="permissions">						
<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b style="color:#FF0000"> *</b> Al marcar la casilla, verificas que la información del partner de BODi que has proporcionado en este formulario es completa y exacta. Tu solicitud puede retrasarse si se recibe información incorrecta.

</div>

</div>
		
							
							<div id="eng_last_head" style="display:none"><h4>La solicitud se procesará a las 24 horas del envío de la solicitud.</h4></div>
						
					   <div style="display:none">
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value="774"/>
					   <rn:widget path="custom/ccc_form/customer_coach_checkbox"  name="Incident.Subject" required="false" default_value="Your Beachbody Customer Partner Change Request"/>
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng" required="false" default_value="754"/>
					   </div>
					   
				<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm"/>
				
				</div>
			</form>
		  </div>
                </div>
		</div>
	</div>

<? else: ?>
<!-- PC - START -->

<? if($contacttyp == 4): // PC 
	$contactid = $this->session->getProfile()->c_id->value;
	$authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
	$currentidcoachdate = $authorizeduser->CustomFields->c->currentidcoachdate;
	$currentidpcdate = $authorizeduser->CustomFields->c->currentidpcdate;
	
	if($currentidcoachdate || $currentidpcdate){
		$today = date("Y/m/d");
		$today_timestamp = strtotime($today);
		$current_id_coach_date = $currentidcoachdate;
		$date_limit_currentidcoachdate = date('Y/m/d', strtotime($current_id_coach_date. ' + 10 days'));
		$date_limit_timestamp_currentidcoachdate = strtotime($date_limit_currentidcoachdate);
		
		$current_id_pc_date = $currentidpcdate;
		$date_limit_currentidpcdate = date('Y/m/d', strtotime($current_id_pc_date. ' + 10 days'));
		$date_limit_timestamp_currentidpcdate = strtotime($date_limit_currentidpcdate);
		//echo ($date_limit_timestamp - $today_timestamp)/60/60/24;
		
		
		
		if(( ( (($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0) || ($currentidcoachdate == NULL) )  &&  ( (($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0) || ($currentidpcdate == NULL) ) ) || (($currentidpcdate != NULL) && ($currentidcoachdate != NULL) && ((($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0) && (($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0))) ){
			$limit = 1; //inside time; form submission allowed
		}else{
			$limit = 2; //outside time ; update now allowed
		} 
	}else{
		$limit = 2;
	}
?>
	<? if($limit == 1): ?>
<div id="rn_IFrameContent" class="rn_OrderPage inner_updated_form_main">
		<div id="rn_content" class="rn_questionform">
            <div id="title_support" class="main_inner_top_heading" style="display:block;width:100%;">
                
            </div>
            <div class="container">
			<div class="rn_wrap rn_padding wrappad">
				<form id="rn_CustCoachChange" method="post" action="" onsubmit="return false;" >
				
					<div style="padding-left: 5px;">
					</div>
					<div id="rn_ErrorLocation_ccc"></div>
					<div class="form_section ccc_begin">
					  
					 <h2 class="ccc_title"> Cliente preferente: formulario de solicitud de cambio de partner</h2>
					
					<div id="Language_Header_English" style="display:block;">
					<p><strong>
					Usa este formulario para cambiar tu partner de BODi.<br /><br />
	
						</strong></p>
						</div>
						<div class="rn_RequiredText rn_FloatRight">*&nbsp;Campo requerido</div>
						
      
						
							<!---------------------	 Language Dropdown-------------->
							<div style="display:none">
		                   
							<div id=div_country> <rn:widget path="custom/ccc_form/SelectionInputCountry" name="Contact.Address.Country" label_input="Country/Pais/Pays" required="true" allow_external_login_updates="true"/></div>
							<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language" label_input="Language/Idioma/Langue" default_value="753"/>
							</div>
							<div id="email_redesign">
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address" label_input="Dirección de correo electrónico" required="false" allow_external_login_updates="true" required="true"/>
							</div>
							
							<!-----------------Coach or Customer Dropdown-------------->
							<div id="coach_or_customer_english_redesign" style="display:none">
							<rn:widget path="custom/ccc_form/SelectionInputLanguage" name="Incident.CustomFields.c.member_type_eng" required="false" label_input="¿Tienes una referencia para un partner?" label_required="es requerido"/>
							</div>
							<div id = "yes_no_main_div">
							<h2 style="color:black;font-size: 1.6em !important;">Introduce los datos del partner al que deseas ser transferido: </h2>
		
							 <rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_email" label_input ="Correo electrónico del partner" required="true" label_required="es requerido"/>
							<rn:widget path="custom/ccc_form/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Nombre del partner" required="true" /> 
							
							<div style="padding:0px 0px 10px 0px;" id="permissions">						
<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10" id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b style="color:#FF0000"> *</b> Al marcar la casilla, verificas que la información del partner que has proporcionado en este formulario es completa y exacta. Tu solicitud puede retrasarse si se recibe información incorrecta.
</div>
</div>
		
							
							<div id="eng_last_head" style="display:none"><h4>El reembolso se procesará en dos días hábiles a partir del envío de la solicitud.</h4></div>
						
					   <div style="display:none">
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing" required="false" default_value="1729"/>
					   <rn:widget path="custom/ccc_form/customer_coach_checkbox"  name="Incident.Subject" required="false" default_value="Your Beachbody Preferred Customer Partner Change Request"/>
					   <rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng" required="false" default_value="754"/>
					   </div>
					   
					  <p> El reembolso se procesará en dos días hábiles a partir del envío de la solicitud. </p>
					   
				<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm"/>
				
				</div>
			</form>
		  </div>
                </div>
		</div>
	</div>
	
	<? else: ?>
	
		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
		<div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
		<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
		<span style="color:#bf2600;font-weight: bold;">Está recibiendo este mensaje porque está fuera del plazo de 10 días y no es elegible para solicitar un cambio de Patrocinador; no hay excepciones a esta políca.</span><br/><br/><span style="font-weight: 300;">Sabemos que el apoyo es vital para alcanzar tus metas, y estamos aquí para brindarte algunas opciones.</span> &nbsp;<br/><br/>  

		<span style="font-weight: bold;">Opción 1: </span><span style="font-weight: 300;"><a href="https://www.beachbodyondemand.com/groups-about?locale=es_US" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">Unirte a un BODgroup</a> – Esta es una plataforma exclusiva y comunitaria de Beachbody que te ayuda a mantener la motivación y el compromiso, y a conectar con otras personas para lograr tus objetivos. Desde el sitio web y la app de BOD, también puedes registrar tus actividades diarias y tu progreso.<br/></br>Muchos partner dirigen BODgroups abiertos y estarán felices de que te unas a su grupo de apoyo mutuo aunque estés asignado a otro partner. Si tienes un partner en mente, puedes pedirle que te agregue o que te envíe el enlace de su BODgroup para que te unas.&nbsp;</span> &nbsp;<br/><br/> 

		<span style="font-weight: bold;">Opción 2: </span><span style="font-weight: 300;"><a href="https://www.facebook.com/groups/bodmembers" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">Grupo de BOD en Facebook</a> – Una gran parte de la motivación es encontrar tu tribu. Únete a nuestro próspero grupo de Facebook, compuesto por más de 95,000 miembros, para dar y recibir apoyo y mantener el compromiso junto a tus compañeros de fitness.&nbsp;</span> &nbsp;<br/><br/> 

		<span style="font-weight: bold;">Opción 3: </span><span style="font-weight: 300;"><a href="https://www.beachbodyondemand.com/blog/?" style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Blog de Beachbody</a> – Haz clic aquí para ver lo último en salud y fitness.&nbsp;</span> &nbsp;<br/><br/> 


	<span style="font-weight: 300;">Consulta las preguntas frecuentes <a href="/app/answers/detail/a_id/11374/catid/0/TLP/0" style="color:#0052CC;">FAQ 11374</a>: Cambio de partner, para encontrar más detalles.</span><br/><br/>	
		</div></div>
	
	<? endif; ?>
	
 <? else: ?>
<!-- PC - END -->
<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
    <div style="padding-left: 38px;font-weight: 600;"class="rn_ccc_restrict">
	<br/><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
	Este formulario solo puede ser enviado por un cliente o un cliente preferente. <br/><br/> Consulta las FAQ <a href="/app/answers/detail/a_id/11374/catid/0/TLP/0">11374</a>: obtener o cambiar mi partner de BODi para más detalles.<br/><br/>Si eres un partner de BODi que quiere cambiar su patrocinador, consulta las FAQ <a href="/app/answers/detail/a_id/11374/catid/0/TLP/0">11374</a>: Genealogía: cambio de patrocinador y cambio de posición.

</div></div>	

<? endif; ?> 		
<? endif; ?> 	