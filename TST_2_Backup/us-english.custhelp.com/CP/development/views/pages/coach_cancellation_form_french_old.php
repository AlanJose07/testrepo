
<rn:meta title="Entraîneur Indépendant Formulaire D'annulation" template="standard_ccf.php" clickstream="incident_create"/>
<img src="/euf/assets/images/team_beachbody_coach_packages.png" height="60" width="300"/>
<div id="rn_PageTitle" class="rn_LiveHelp"><!--<input type="button" onclick="clear123()" value="Sign" name="Sign"/>-->
<h1><b>Formulaire d'annulation de coach indépendant de Team Beachbody Canada, LP</b></h1>
<div class="priceQuote">
	<I>
Ce formulaire vous permet d'annuler définitivement votre compte Coach Team Beachbody et tous les autres abonnements et inscriptions dont vous aurez pu vous être inscrits. S'il vous plaît remplir toutes les informations requises avec précision. Votre annulation peut être retardée si nous recevons des informations incorrectes. </I></div>
<b>*Obligatoire</b>
 <br/>
</div>
<div id="rn_PageContent" class="rn_Live">
  <div class="rn_Padding" >
    <form id="rn_QuestionSubmit" method="post" action="/cc/fattach/pdfSubmitFrench" onload="clearString()">
      <div id="rn_ErrorLocation"></div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	 <rn:widget path="custom/input/TextInput_French_CCF" name="Incident.c$coachcustomernumber" label_input="Id. de Coach Team Beachbody (si connu)" initial_focus="true" required="false"/> 
        </div>
        <div class="cus-col-md-6">
        	<rn:widget path="custom/input/TextInputEmail_French_CCF" name="Contact.Emails.PRIMARY.Address" label_input="Courriel" label_error="Courriel" label_required="est requis" label_invalid="est invalide" required="true"/>
            <em class="emailCommnets">S'il vous plaît utiliser l'adresse e-mail associée à votre compte coach</em>
        </div>
      </div>
      <div class="Indeprow clear CanSep">
      	<div class="cus-col-md-6">
        	<rn:widget path="input/TextInput" name="Incidents.c$ccf_first_name" label_input="Prénom" label_required="est requis" label_error="Prénom" required="true"/>
        	<em class="firstNameComments">Veuillez écrire votre prénom exactement comme il apparaît sur votre compte Coach. </em>
        </div>
        <div class="cus-col-md-6">
        	 <rn:widget path="input/TextInput" name="Incidents.c$ccf_last_name" label_input="Nom" label_required="est requis" label_error="Nom" required="true"/>
        	 <em class="lastNameComments">Veuillez écrire votre nom de famille exactement comme il apparaît sur votre compte Coach.</em>
        </div>
      </div>
       <div class="Indeprow businessName clear">
      		 <rn:widget path="input/TextInput" name="Incidents.c$ccf_business_name" label_input="Nom de l’entreprise (si applicable)" required="false"/>
      </div>
      <div class="Indeprow clear SSN CanSep">
      	<div class="cus-col-md-6">
        	<!--<rn:widget path="custom/input/TextInputSSN_CCF" name="Incident.c$last_four_ssn" label_input="4 derniers chiffres du numéro d’assurance sociale (NAS)" label_error="4 derniers chiffres du numéro d’assurance sociale (NAS)" label_required="est requis" required="true" language="French"/>-->
			
			<rn:widget path="custom/input/TextInputSSN_CCF" name="Incident.c$last_four_ssn" label_input="4 derniers chiffres de la carte de crédit enregistrée pour vos frais de services du compte Coach" label_error="4 derniers chiffres de la carte de crédit enregistrée pour vos frais de services du compte Coach OU 4 dernier chiffre de votre Assurance Social" label_required="est requis" required="true" language="French"/>
			
        </div> 
        <div class="cus-col-md-6 phone_number">   
        	<rn:widget path="custom/input/TextInputEmail_French_CCF" name="Contact.Phones.MOBILE.Number" label_input="Téléphone" label_error="Téléphone" label_required="est requis" label_invalid="est invalide" required="true"/>
        </div>
      </div>  
	  
	   <!--Life time rank-->
	  <div class="Indeprow businessName clear">
      	
			 <rn:widget path="custom/input/SelectionInput_CCF_life_time_rank" name="Incident.c$life_time_rank" initial_focus="false" label_input="Rang à vie" required="true">
      </div>
	   <!--Life time rank-->
	  
	  
	  <div style="display:none">
	  <rn:widget path="input/FormInput" name="Incident.Subject" label_input="Subject" default_value="Votre formulaire d’annulation du Compte Coach a été reçu" required="false"/>
	  </div>
	   <div style="display:none">
	  <rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="674" required="false"/>
	  </div>
       <div class="Indeprow clear CoachRadio">
       		<rn:widget path="custom/input/SelectionInputRadioButton" name="Incident.c$ccf_reason_for_cancellation_fr" label_input="Raison principale de l'annulation" label_error="Sélectionnez la raison qui correspond le mieux à votre annulation" label_required="est obligatoire" required="true"/>
            <!--<div id="other_reason" style="display:none">
            	<rn:widget path="custom/input/TextInput_French_CCF_Other" name="Incidents.c$ccf_other_reason" label_input="Veuillez Préciser" label_error="Veuillez Préciser" label_required="est requis" required="false"/>
            </div>-->
       </div>   
       <!--<div class="coExperience">
	   		<rn:widget path="input/FormInput" name="Incident.c$ccf_coaching_experience"  textarea="true" maximum_length=1300 required="false" label_input="Veuillez ajouter tout commentaire sur votre expérience de Coach Team Beachbody dans la case ci-dessous. Votre avis nous est précieux."/>
       </div>-->
	 
	 <b><div id="memberships" class="canFormTitle01">
	 Autres abonnements et Inscriptions<sup>*</sup>
	 </div></b>
     
	 
	
	<div class="CheckServiceLab"><b>Veuillez cocher la case correspondante du service <u>que vous désirez continuer</u>:</b></div>
	 <div class="Indeprow clear">
	     <div class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_cancel_all_enrollments" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CCF_CANCEL_ALL_ENROLLMENTS_FRENCH#" required="false"/>
         </div>
         <div class="cus-col-md-6 serviceCheck">
         	<!--<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_TBB_CLUB_MEMBERSHIP_FRENCH#" required="false"/>-->
         	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_tbb_club_membership" display_as_checkbox="true" label_input="Abonnement Beachbody sur demande /Abonnement Team Beachbody Club" required="false"/>
         </div>
     </div>
      <div class="Indeprow clear">
	     <div class="cus-col-md-6 serviceCheck">
         	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_shakeology" display_as_checkbox="true" label_input="#rn:msg:CUSTOM_MSG_CCF_SHAKEOLOGY_FRENCH#" required="false"/>
         </div>
		 
		 
		 
		 
		 <div class="cus-col-md-6 serviceCheck">
		 
		  <rn:widget path="custom/input/CheckboxPerformance"/>
		 <div id="performance_select" class="cus-col-md-6 serviceCheck sBlock" style="display:none">
		
      	<!--<div class="cus-col-md-6">-->
        	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_performance_french" label_input="Beachbody Performance" label_required="est requis" required="false"/>
       <!-- </div>-->
		</div>
        
		</div>
		
		 </div>
		 
		 
		 
		 
		 <div class="Indeprow clear">

 <div class="cus-col-md-6 serviceCheck">
<rn:widget path="custom/input/CheckboxShakeBoost"/>
<div id="shake_boost_select" class="cus-col-md-6 serviceCheck sBlock marg" style="display:none">
        	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_shakeology_boost_french" label_input="Shakeology Boost" label_required="est requis" required="false"/>
        </div>
 </div>
 <div class="cus-col-md-6 serviceCheck">
		<rn:widget path="custom/input/Checkbox3DayRefresh"/>
      	<div id="select_3day" class="cus-col-md-6 serviceCheck sBlock" style="display:none">
		 
        	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_3_day_refresh_french" label_input="3 jours Refresh" label_required="est requis" required="false"/>
   
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
         	<rn:widget path="custom/input/SelectionInput_French_CCF" name="Incident.c$ccf_other_continued_services" display_as_checkbox="true" label_input="Autres" required="false"/>
         </div>
         <div id ="checkbox_validation" style="display:none"><input type="text"  id="check_validate" /></div>
     </div>
					
<!--	<rn:widget path="custom/input/SelectionInputDS" name="Incident.c$ccf_other_continued_services" display_as_checkbox="true" label_input="Other" required="false"/>-->
<div id="other_service" style="display:none">
	<rn:widget path="input/TextInput_French_CCF_Other" name="Incident.c$ccf_membership_and_enrollment" label_input="S'il vous plaît préciser et énumérer toutes les cases" label_error="S'il vous plaît préciser et énumérer toutes les cases" label_required="est requis" required="false"/>
	</div>
	<div class="priceQuote"><I>*Les prix ci-dessous indiqués n’inclus pas les frais de port et taxes</I></div>
	<div class="priceQuote">
	<!--I>Souvenez-vous que si vous annulez ou n'avez pas d'abonnement à Beachbody On Demand, vous n'aurez pas accès au téléchargement, et vous n’obtiendrez pas 10% de rabais sur vos prochains achats. Si vous conservez votre adhésion à Beachbody On Demand, vous obtiendrez 10% de rabais sur les prix indiqués.</I-->	</div>

	 <b><div class="canFormTitle01" id="terms_of_cancellation">Conditions de l’annulation<sup>*</sup></div></b>
	 <div class="priceQuote"><I>Veuillez cocher toutes les cases pour signer et soumettre votre annulation</I></div>

	<div class="CheckServiceLab"><b>En signant et soumettant ce formulaire, J’atteste ce qui suit :</b></div>
	<div class="submitPoints">
    <input type="checkbox" id ="term1" required/><span>Je perdrai le 25% de rabais sur tous les produits Team Beachbody et abonnements indiqués plus haut</span>
    </div>
	<div class="submitPoints">
	<input type="checkbox" id ="term2" required/><span>Pour tout abonnement et inscription que je désire continuer, J'atteste les charges qui surviendront et approuve que je pourrai  annuler à tout moment en appelant le service à la clientèle au 1 (800) 470-7870</span>
    </div>
    <div class="submitPoints">
	<input type="checkbox" id ="term3" required/><span>Je perdrai mon droit de vendre les produits Team Beachbody</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox"  id ="term4" required/><span>Je ne suis plus admissible à gagner des commissions selon les termes du plan de compensation Team Beachbody</span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term5" required/><span>J’abandonne indéfiniment ma position dans l’arbre généalogique de Team Beachbody, y compris les bonus et commissions en cours ou tout autre forme de compensation </span>
    </div>
     <div class="submitPoints">
	<input type="checkbox" id ="term6" required/><span>Je ne pourrai pas me réinscrire en tant que Coach Team Beachbody avant une période de 6 mois suivant la date de mon annulation si je désire me réinscrire avec un nouveau Sponsor Coach, ou avec mon Sponsor Coach d’origine sur une Jambe différente de son organisation (veuillez consulter la Section 3.6.3 des politiques et procédures de coach du Team Beachbody).</span>
    </div>
<div class="Indeprow clear">
	<div class="signaturePane">

<div class="sigPad" id="signature"> <b id="signLabel">Tapez simplement /s/ avant votre nom; Par exemple, /s/ John Smith. Ceci l'identifie comme une signature nous informant que vous consentez aux termes et conditions.
<!--<sup><font color="#DB1E1E" size="-1">*</font></sup>--></b><br />
  
   <!--<div id = "canvas123">
   
        <canvas class="pad" width="450" height="170" style="border:#666666 1px solid" required="false" id="canvas" onmouseout="convert()" style="padding-bottom:10px"></canvas> 
		</div> -->
		
		<input type="text" name="signatureText" id="html-content-holder"  maxlength="100"><br>

	
        <input type=hidden name=output class=output required>
        
<br />


		<div class="bySigning" id="signtext">
		Signature avec /s/ avant votre nom<br /><br />
		<I>En signant ce formulaire, je certifie que je suis le propriétaire véritable du compte d’entreprise Coach et/ou autorise l’annulation de ce compte. Si nous avons des questions, nous vous contacterons au travers des informations fournies plus haut.</I></div>
        <input type="hidden" name="base64_encoded_string" id="base64_encoded_string" >
		<input type="hidden" name="test_canvas" id="test_canvas" >
	<!--<button class=clearButton onclick="clearSignature()" id="clear_button">Effacer Signature</button>-->
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
		<div style="display:inline"> <span><b>Date </b>(Heure du Pacifique):</span></div>
			<?php echo date('m-d-Y');?>
  <div class="importTxt"> <b>IMPORTANT</b> La soumission de ce formulaire n’annule pas/ou mettre en attente les facturations en cours pendant ce processus. Vous pourriez être facturé pour ces commandes.</div>
  <div class="cancelSubmitBtn">
  	<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation" label_button="SOUMETTRE"/>
  </div>
<div class="float_left"> </div>
<div id="submit" ></div>
    </form>
	<img style="display:none" id="SignatureImage"/>
  </div>
</div>


<style>
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
  
  /* $('#canvas').bind('touchend', function(event) 
{
var myString = document.getElementById('canvas').toDataURL("image/jpeg",0.5);
	document.getElementById("base64_encoded_string").value=myString;
	document.getElementById("SignatureImage").src=myString;
});*/
/*
 * Converts the signature drawn on the canvas to base64
 */
 

/*var canvas = document.getElementById('canvas'),*/
/*
* Returns a drawing context on the canvas
*/
/*ctx = canvas.getContext('2d');*/


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
	
	
	//	var emptyString_white="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACqAcIDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/igAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAP/9k=";
		
		
		
		
	
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
}*/


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
<!--<script>
/*
* Clears the value of the field whether base64 encoded string is saved
*/
function clearSignature(){
	document.getElementById("base64_encoded_string").value="";
}

</script>-->

<script>

</script>
