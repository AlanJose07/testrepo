<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<rn:meta title="Formulario de Cancelación de Coach Independiente" template="standard_ccf.php" clickstream="incident_create"/>

<img src="/euf/assets/images/team_beachbody_coach_packages.png" height="60" width="300"/>
<div id="rn_PageTitle" class="rn_LiveHelp"><!--<input type="button" onclick="clear123()" value="Sign" name="Sign"/>-->
<h1><b>Formulario de cancelación de coach independiente</b></h1>
<div class="priceQuote">
	<I>
Este formulario te permite cancelar permanentemente tus cuentas de coach de Team Beachbody y cualquier otra membresía o suscripción a la que estés inscrito. Completa con precisión toda la información requerida. Tu cancelación podría demorarse si recibimos la información incorrecta.</I></div>
<b>*Campo obligatorio</b>
 <br/>
</div>
<div id="rn_PageContent" class="rn_Live">
  <div class="rn_Padding" >
    <form id="rn_QuestionSubmit" method="post" action="/cc/fattach/pdfSubmitSpanish" onload="clearString()">
      <div id="rn_ErrorLocation"></div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	 <rn:widget path="custom/input/TextInput_Spanish_CCF" name="Incident.c$coachcustomernumber" label_input="Identificación del coach" initial_focus="true" required="false"/> 
        </div>
        <div class="cus-col-md-6">
        	<rn:widget path="custom/input/TextInputEmail_French_CCF" name="Contact.Emails.PRIMARY.Address" label_input="Correo electrónico" label_error="Correo Electrónico" label_required="es requerido" label_invalid="es inválido" required="true"/>
            <em class="emailCommnets">Utiliza la dirección de correo electrónico que tenemos registrada en tu cuenta de coach.</em>
        </div>
      </div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	<rn:widget path="input/TextInput" name="Incidents.c$ccf_first_name" label_input="Nombre" label_required="es requerido" label_error="Nombre" required="true"/>
        	<em class="firstNameComments">Por favor ingrese su primer nombre exactamente como aparece en su cuenta de Coach.</em>

        </div>
        <div class="cus-col-md-6">
        	 <rn:widget path="input/TextInput" name="Incidents.c$ccf_last_name" label_input="Apellido" label_required="es requerido" label_error="Apellido" required="true"/>
        	 <em class="lastNameComments">Por favor ingrese su apellido exactamente como aparece en su cuenta de Coach</em>

        </div>
      </div>
       <div class="Indeprow businessName clear">
      		 <rn:widget path="input/TextInput" name="Incidents.c$ccf_business_name" label_input="Nombre del negocio (si corresponde) " required="false"/>
      </div>
      <div class="Indeprow clear SSN CanSep">
      	<div class="cus-col-md-6">
        	<!--<rn:widget path="custom/input/TextInputSSN_CCF" name="Incident.c$last_four_ssn" label_input="Últimos cuatro dígitos de SSN, EIN o SIN" label_error="Últimos cuatro dígitos de SSN, EIN o SIN" label_required="es requerido" required="true" language="Spanish"/>-->
       

<rn:widget path="custom/input/TextInputSSN_CCF" name="Incident.c$last_four_ssn" label_input="Los últimos 4 dígitos de la tarjeta de crédito que es utilizada para el pago de la tarifa de Servicio de Negocios" label_error="Últimos cuatro dígitos de SSN, EIN o SIN" label_required="es requerido" required="true" language="Spanish"/>


	   </div>
        <div class="cus-col-md-6 phone_number">
        	<rn:widget path="custom/input/TextInputEmail_French_CCF" name="Contact.Phones.MOBILE.Number" label_input="Teléfono" label_error="Teléfono" label_required="es requerido" label_invalid="es inválido" required="true"/>
        </div>
      </div>  
	   
	   <!--Life time rank-->
	  <div class="Indeprow businessName clear">
      	
			 <rn:widget path="custom/input/SelectionInput_CCF_life_time_rank" name="Incident.c$life_time_rank" initial_focus="false" label_input="Rango de por Vida" required="true">
      </div>
	   <!--Life time rank-->
	  
	  <div style="display:none">
	  <rn:widget path="input/FormInput" name="Incident.Subject" label_input="Subject" default_value="Forma de cancelación del coach recibida" required="false"/>
	  </div>
	   <div style="display:none">
	  <rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="675" required="false"/>
	  </div>
       <div class="Indeprow clear CoachRadio">
       		<rn:widget path="custom/input/SelectionInputRadioButton" name="Incident.c$ccf_reason_for_cancellation_sp" label_input="Selecciona la razón principal que mejor describa tu cancelación"  required="true"/>
            <!--<div id="other_reason" style="display:none">
            	<rn:widget path="custom/input/TextInput_Spanish_CCF_Other" name="Incidents.c$ccf_other_reason" label_input="Por favor especifica" label_error="Por favor especifica" label_required="es requerido" required="false"/>
            </div>-->
       </div>   
      <!-- <div class="coExperience">
	   		<rn:widget path="input/FormInput" name="Incident.c$ccf_coaching_experience"  textarea="true" maximum_length=1300 required="false" label_input="A continuación, proporciona cualquier detalle sobre tu experiencia como coach. Agradecemos tus comentarios."/>
       </div>-->
	 
	 <b><div id="memberships" class="canFormTitle01">
	 Otras membresías y suscripciones<sup>*</sup>
	 </div></b>
	
	<div class="CheckServiceLab"><b>Marca la casilla junto a los servicios que <u> deseas continuar recibiendo</u>:</b></div>
	 <div class="Indeprow clear">
	     <div class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_cancel_all_enrollments" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CCF_CANCEL_ALL_ENROLLMENTS_SPANISH#" required="false"/>
         </div>
         <div class="cus-col-md-6 serviceCheck">
         	<!--<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_TBB_CLUB_MEMBERSHIP_SPANISH#" required="false"/>-->
         	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="Membresía de Beachbody On Demand / Membresía de Team Beachbody Club" required="false"/>
         </div>
     </div>
      <div class="Indeprow clear">
	     <div class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_shakeology" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CCF_SHAKEOLOGY_SPANISH#" required="false"/>
         </div>
		 
		 
		 
		 
		 
		 
		  <div class="cus-col-md-6 serviceCheck">
		 
		  <rn:widget path="custom/input/CheckboxPerformance"/>
		 <div id="performance_select" class="cus-col-md-6 serviceCheck sBlock" style="display:none">
		
      	<!--<div class="cus-col-md-6">-->
        	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_performance_spanish" label_input="Beachbody Performance"label_required="es requerido"  required="false"/>
       <!-- </div>-->
		</div>
        
		</div>
		
		
     </div>
	 
	 <div class="Indeprow clear">
	 
 <div class="cus-col-md-6 serviceCheck">
<rn:widget path="custom/input/CheckboxShakeBoost"/>
<div id="shake_boost_select" class="cus-col-md-6 serviceCheck sBlock marg" style="display:none">
        	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_shakeology_boost_spanish" label_input="Shakeology Boost" label_required="es requerido" required="false"/>
        </div>
 </div>
 <div class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/Checkbox3DayRefresh"/>
      	<div id="select_3day" class="cus-col-md-6 serviceCheck sBlock" style="display:none">
		 
        	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_3_day_refresh_spanish" label_input="3 Day Refresh" label_required="es requerido"  required="false"/>
   
		</div>
		</div>
		
	 
	 
	 </div> 
	   <div class="Indeprow clear">
		 
		 <div class="cus-col-md-6 serviceCheck">
<div id="pro_team_select" class="cus-col-md-6 serviceCheck">
<rn:widget path="custom/input/SelectionInput_CCF" name="Incident.c$ccf_pro_team" display_as_checkbox="true" label_input="Pro Team" required="false"/>
</div>
</div>
		 
         <div class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_Spanish_CCF" name="Incident.c$ccf_other_continued_services" display_as_checkbox="true" label_input="Otros" required="false"/>
         </div>
         <div id ="checkbox_validation" style="display:none"><input type="text"  id="check_validate" /></div>
     </div>
					
<!--	<rn:widget path="custom/input/SelectionInputDS" name="Incident.c$ccf_other_continued_services" display_as_checkbox="true" label_input="Other" required="false"/>-->
<div id="other_service" style="display:none">
	<rn:widget path="input/TextInput_Spanish_CCF_Other" name="Incident.c$ccf_membership_and_enrollment" label_input="Por favor Especificar y enumerar todo lo que corresponda" label_error="Por favor Especificar y enumerar todo lo que corresponda" label_required="es requerido" required="false"/>
	</div>
	<div class="priceQuote">
	<I>
	*Los precios no incluyen cargos por envío y manejo ni impuestos.</I></div>	
	<div class="priceQuote">
	<!--I>Por favor recuerde, que si usted cancela o no cuenta con una membresia de Beachbody On Demand, usted no tendra acceso a transmitir los videos y no obtendra el 10% de descuento en sus futuras compras. Si usted continua con la membresia de Beachbody On Demand, usted obtendra el 10% de descuento sobre precios de lista.</I-->	</div>

	 <b><div class="canFormTitle01" id="terms_of_cancellation">Términos de cancelación<sup>*</sup></div></b>
	 <div class="priceQuote"><I>Marca todas las casillas para firmar y enviar tu cancelación</I></div>

	<div class="CheckServiceLab"><b>Al firmar y enviar este formulario, entiendo lo siguiente:</b></div>
	<div class="submitPoints">
    <input type="checkbox" id ="term1" required/><span>Perderé el 25 % de descuento para coaches en todos los pedidos futuros, y toda membresía o suscripción continuada indicada arriba.</span>
    </div>
	
	<div class="submitPoints">
	<input type="checkbox" id ="term2" required/><span>Acepto el cargo por los productos relacionados con cualquier membresía o suscripción continuada, y entiendo que puedo cancelar en cualquier momento llamando a Servicio al cliente al 1 (800) 470-7870. </span>
    </div>
	
    <div class="submitPoints">
	<input type="checkbox" id ="term3" required/><span>Pierdo el derecho de vender productos de Team Beachbody.</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox"  id ="term4" required/><span>Ya no seré elegible para ganar una comisión en virtud del plan de compensación de Team Beachbody.</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term5" required/><span>Abandono permanentemente mi posición dentro de la genealogía de Team Beachbody, así como todas las bonificaciones, comisiones u otros tipos de compensación pendientes.</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term6" required/><span>No podré volver a registrarme como un coach de Team Beachbody hasta dentro de seis meses calendario a partir de la fecha de mi cancelación, o si deseara volver a registrarme con un nuevo patrocinador, o con mi patrocinador original en una rama diferente de la organización de mi patrocinador, (consulta la Sección 3.6.3 de las Políticas y procedimientos del coach de Team Beachbody).</span>
    </div>
<div class="Indeprow clear">
	<div class="signaturePane">

<div class="sigPad" id="signature"> <b id="signLabel">Ingrese /s/ antes de su nombre; por ejemplo, /s/ Juan Sánchez. Esto indica su firma electrónica, confirmando su consentimiento a los términos y condiciones.
Firma con /s/ antes de su nombre<sup><font color="#DB1E1E" size="-1">*</font></sup></b><br />
  
   		<!--<div id = "canvas123">
   
        <canvas class="pad" width="450" height="170" style="border:#666666 1px solid" required="false" id="canvas" onmouseout="convert()" style="padding-bottom:10px"></canvas> 
		</div> -->
		
		<input type="text" name="signatureText" id="html-content-holder"   maxlength="100"><br>

	
        <input type=hidden name=output class=output required>
        <br />


		<div class="bySigning" id="signtext"><I>Al firmar, certifico que soy el titular actual de la cuenta del Centro de negocio de coaches y/o estoy autorizado a cancelar esta cuenta. Si tenemos cualquier pregunta, nos comunicaremos contigo a la información que indicaste arriba.</I></div>
        <input type="hidden" name="base64_encoded_string" id="base64_encoded_string" >
		<input type="hidden" name="test_canvas" id="test_canvas" >
	<!--<button class=clearButton onclick="clearSignature()" id="clear_button">Firma legible </button>-->
	<!--<input type="button" class="clearButton" onclick="clear()" id="clear_button" value="Clear Signature" name="Clear Signature"/>-->
		
		<!--<rn:widget path="custom/input/SelectRadioButton" name="Incident.c$member_type_new" label_input="Member type"  required="false"/>-->
 
<div id="div_imgAttach"></div>
		
        <br />
	
		
		<!--<div class="clearButton clearSign" onclick="clear()">Clear Signature</div>-->
        <!--<input type="submit" name="submit" value="Send" onclick="return convert();"/>-->
	<!--<rn:widget path="custom/input/Submit_DS" />-->
	
		</div>
		</div>
		</div>
		<div style="display:inline"> <span><b>Fecha </b>(horario del Pacífico):</span></div>
			<?php echo date('m-d-Y');?>
  <div class="importTxt"> <b>IMPORTANTE:</b> El envío de este formulario no suspende ni cancela los cargos o envíos pendientes que estén en proceso o programados durante el tiempo que tome este proceso. Se te podrían hacer cargos por estos pedidos.</div>
  <div class="cancelSubmitBtn">
  	<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation" label_button="Enviar"/>
  </div>
<div class="float_left"> </div>
<div id="submit" ></div>
    </form>
	<img style="display:none" id="SignatureImage"/>
  </div>
</div>


<style>

.emailCommnets{
	font-size:11px !important;
}


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
/*
.SSN .cus-col-md-6 label{
	font-size:13px !important;
}*/
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

<!--<script>
function clearString(){
	document.getElementById("base64_encoded_string").value="";
}
</script>-->








<script src="https://files.codepedia.info/uploads/iScripts/html2canvas.js"></script>

<!--<script src="/euf/assets/js/sign/jquery.signaturepad.min.js"></script>-->
<script>
  /*$(document).ready(function () {
    $('.sigPad').signaturePad({drawOnly:true});
  });*/
  
  /*
  Listens for end of touch event to convert the signature drawn on the canvas to base64 encoded string
  (For IPAD)
  */
   /*$('#canvas').bind('touchend', function(event) 
{
var myString = document.getElementById('canvas').toDataURL("image/jpeg",0.5);
	document.getElementById("base64_encoded_string").value=myString;
	document.getElementById("SignatureImage").src=myString;
});*/
  
/*
 * Converts the signature drawn on the canvas to base64
 */
 

//var canvas = document.getElementById('canvas'),
/*
* Returns a drawing context on the canvas
*/
//ctx = canvas.getContext('2d');


//function doCanvas() {
    /*
	*  Fills the canvas with specified color.
	*/
  /*  ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
	ctx.strokeStyle="#FF0000";
 
}

doCanvas();


function convert() {*/

	/*
	* toDataURL() returns a data URI containing a representation of the image in the format specified by the type parameter
	* (defaults to PNG). 
	*/
	//var canvas = document.getElementById('canvas');
	
	
		//var emptyString_white="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACqAcIDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/igAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAP/9k=";
		
		
		
		
	
	/*var myString = document.getElementById('canvas').toDataURL("image/jpeg",0.5);
	
	if((myString!=emptyString_white))//checks if base64 encoded string represents an empty canvas
	{
	document.getElementById("base64_encoded_string").value=myString;
	document.getElementById("SignatureImage").src=myString;
	}
	else
	{
		document.getElementById("base64_encoded_string").value="";
	}
	

	
	return true;
} */
$(document).ready(function()
{
	//var emptyString_white="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACqAcIDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/igAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAP/9k=";
	
	var element = $("#html-content-holder"); // global variable
	var getCanvas; // global variable
	$("#html-content-holder").on("keyup", function () 
	{
         
        
		
			 //var myString = canvas.toDataURL("image/jpeg",0.5);
			var myString = document.getElementById("html-content-holder").value;

			 if(document.getElementById("html-content-holder").value!="")//checks if base64 encoded string represents an empty canvas
			{
				
				$("#base64_encoded_string").attr('value',myString);
				//alert("x");
				console.log(document.getElementById("base64_encoded_string").value);
				//$("#SignatureImage").attr('src',myString);
			}
			else
			{
				
				$("#base64_encoded_string").attr('value',"");
				//alert("y");
				//$("#SignatureImage").attr('src',"");
			}
			
		 
    });	
});

</script>
<script>
/*
* Clears the value of the field whether base64 encoded string is saved
*/
/*function clearSignature(){
	document.getElementById("base64_encoded_string").value="";
}*/

</script>

<script>

</script>
