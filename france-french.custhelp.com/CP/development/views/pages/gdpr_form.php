<head>
<rn:meta title="GDPR FORM" template="standard_responsive_bb.php" clickstream="incident_create"/>
<style>
select
{
	width: 24.5%;
}
#rn_QuestionSubmit_GDPR
{
	width: 100%;
}
/*.rn_Email {
    height: 28px;
}*/
#terms_conditions
{
	margin-right: 10px;
	margin-top: 15px;
	//margin-bottom: 15px;
}
#terms_link
{
	text-decoration:underline;
	font-weight:bold;
}
.rn_TextInput .rn_Text, .rn_TextInput .rn_Email, .rn_TextInput .rn_Url, .rn_TextInput .rn_TextArea {
    width: 24%;
}
#recaptcha_area{
margin: auto;
}
.rn_CheckBoxGDPR{
margin-right: 83px;
}
.ask-page #rn_QuestionSubmit_GDPR {
    width: 520px;
    margin: 0 auto;
}
.rn_SelectionInput legend, .rn_SelectionInput label, .ask-page #rn_QuestionSubmit_GDPR  .rn_TextInput .rn_Label{
	text-align:left;
}
.ask-page #rn_QuestionSubmit_GDPR select{	
	width:100% !important;
}
.rn_TextInput .rn_Text, .rn_TextInput .rn_Email, .rn_TextInput .rn_Url, .rn_TextInput .rn_TextArea {
    width: 100%;
	box-sizing:border-box;
}
.rn_LiveHelp #title_support {
    font-size: 18px !important; 
    font-weight: normal;
    margin: 0;
    padding: 24px 0 10px 3px;
}
#submit #gdpr_title {
    text-align: left;
    margin-bottom: 5px;
}
.rn_CheckBoxGDPR {
    margin-right: 0;
    text-align: left;
}
.rn_SubmitGDPR.rn_FormSubmit {
    text-align: left;
    margin-top: 11px;
}
a
{
	text-decoration:underline;
	color:#0079C1;
}

/*label[id^="rn_TextGDPR_"][id$="_Label"]{
	display:none;
}*/
.rn_MessageBox {
    background-color: #FFFFE0;
    border: 1px solid #808080;
    color: #990000;
    margin: 10px 0;
    padding: 6px;
}
input[type=submit]:not(.sign_in_akamai), button {
  /*background: #0E53A7 url(images/buttonGradientCombo.png) 0px 0px repeat-x;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.5);
    border: 1px solid #304764;
    color: #FFF;
    cursor: pointer;
    font: bold 12px Helvetica,Arial,sans-serif;
    line-height: normal;
    margin-right: 6px;
    padding: 6px 8px;
    text-decoration: none;
    text-shadow: 2px 2px 2px rgba(0,0,0,0.25);*/
    background-color: #0D47A1 !important;
    color: #fff !important;
    padding: 4px 17px !important;
    font-size: 14pt !important;
    transition: 0.25s;
    border-radius: 4px;
 }

   
#rn_ErrorLocation_gdpr a
{
	color: red;	
}

select {
    //width: 365px;
    height: 32px;
    padding-left: 7px;
}

</style>

</head>
<!--<header>
<img src="https://www.beachbody.com/images/beachbody/en_us/global/bbv6/beachbody_logo.png" height="50px" width="225px"/>
</header>-->
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<div id="rn_PageTitle" class="rn_LiveHelp">
	<div id="title_support" style="display:block; text-align:center;margin-top: 0px;">
		<h2>Formulaire de demande d’exercice des droits des personnes concernées</h2>
		
	</div>
	<!--<div id="gdpr_instructions">
		Use this form to make specific data account requests. Please fill out all required information accurately. Your request may be declined if incorrect information is received. For answers to frequently asked questions, please visit </span><a href='https://faq.beachbody.com/app/answers/detail/a_id/4644' target='__blank'>FAQ 3436</a>.
	</div>-->
	<!--<div id="call_support">
		Answers to frequently asked questions regarding these requests can be found in <a href="/app/answers/detail/a_id/9909/~/beachbody-support-contact-information/lob/<? echo $tabval; ?>"></a>.
	</div>-->
	<br/>
</div>
<div id="rn_PageContent" class="rn_Live ask-page">
	<div class="rn_Padding" >
		<form id="rn_QuestionSubmit_GDPR" method="post" action="/cc/ajaxCustom/sendFormGDPR">	
			<p style="text-align: justify;">Veuillez utiliser ce formulaire pour envoyer vos demandes concernant les données récoltées et conservées sur votre compte par BODi (droits des personnes concernées). Veuillez saisir toutes les informations requises de manière exacte, car nous les utiliserons pour valider votre identité. Votre demande pourrait être retardée ou rejetée en cas d’informations incorrectes.<br/><br/>Vous trouverez la foire aux questions concernant les droits de la personne concernée dans la </span><a href='/app/answers/detail/a_id/3436' target='__blank'>FAQ 3436</a>.</p>
			
			<p style="color:red"><b>*Champ requis</b></p>
			<div id="rn_ErrorLocation_gdpr"></div>
			
			<rn:widget path="custom/input/SelectGDPR" name="Contact.Address.Country" required="true" label_input="Sélectionnez votre pays de résidence"  initial_focus="true" default_value="23" label_required="%s sont requis" allow_external_login_updates="true"/>
			
			<div id="CountryFields">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$member_type_new" required="true" label_input="Sélectionnez votre type d’abonnement"  initial_focus="false" label_required="%s sont requis"/>
				
				<div id="right_type_data" style="display:none;">
				<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_right_type" label_input="Sélectionnez le droit des personnes concernées que vous souhaitez exercer" required="true" label_required="%s sont requis"/>
				</div>
				<div id="my_object_data" style="display:none; margin-left: 20px;">
					<!--<rn:widget path="custom/input/SelectGDPR" name="Incident.c$object_my_data" required="false" label_input="Select Object Data"  initial_focus="false" />-->
					<rn:widget path="custom/input/SelectGDPR" name="Incident.c$dsrm_object_data" required="false" label_input="De quelle(s) option(s) souhaitez-vous vous désinscrire:"  initial_focus="false" label_required="%s sont requis"/>
				</div>
				<div id="update_object_data" style="display:none">
					<div id="desc_uk" style="display:none;text-align:justify"><span><b>Décrivez en détail les données que vous souhaitez rectifier dans la case ci-dessous (par ex., mettre à jour votre adresse ou votre numéro de téléphone).<br/></b></span><br/><span style='color:red'><b>N’incluez PAS d’informations sensibles (par ex., le numéro de votre carte de crédit, votre numéro de sécurité sociale ou d’assurance, le numéro de votre compte bancaire, etc.).</b></span><span><b> Pour mettre à jour les informations liées à votre carte de paiement, veuillez vous rendre sur <a style="text-decoration-line: underline !important;" target='__blank' href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> et cliquer sur "Mettre à jour ma carte de crédit". Pour mettre à jour votre numéro de sécurité sociale, d’assurance sociale, d’identification fiscale ou les informations de votre compte bancaire, veuillez consulter la </span><a style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644' target='__blank'>FAQ 4644</a>.</b></div>
					
					<div id="desc" style="display:none;text-align:justify"><span><b>Décrivez en détail les données que vous souhaitez rectifier dans la case ci-dessous (par ex., mettre à jour votre adresse ou votre numéro de téléphone).<br/></b></span><br/><span style='color:red'><b>N’incluez PAS d’informations sensibles (par ex., le numéro de votre carte de crédit, votre numéro de sécurité sociale ou d’assurance, le numéro de votre compte bancaire, etc.).</b></span><span><b> Pour mettre à jour les informations liées à votre carte de paiement, veuillez vous rendre sur <a style="text-decoration-line: underline !important;" target='__blank' href='http://www.beachbodysupport.com'>www.BeachbodySupport.com</a> et cliquer sur "Mettre à jour ma carte de crédit". Pour mettre à jour votre numéro de sécurité sociale, d’assurance sociale, d’identification fiscale ou les informations de votre compte bancaire, veuillez consulter la </span><a style="text-decoration-line: underline !important;" href='/app/answers/detail/a_id/4644' target='__blank'>FAQ 4644</a>.</b></div>
					
					
					<div id="desc1" style="display:none; text-align: left;"><span style="color: red"><b>Veuillez saisir une description des éléments auxquels vous souhaitez vous opposer ou dont vous souhaitez limiter le traitement:</b></span></div>

					<!--<div id="caution">Do not include any sensitive information in the box below (i.e. Credit Card #, SSN, bank account #, birthday). To update those, please contact Beachbody Support at Customer Line: 1-800-470-7870 or Coach Line: 1-800-240-0913 and mention GDPR so that we can get you to the right support team.</div>-->
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input="" required="false" label_required="%s sont requis"/> 
				</div>
				

				<!--<div id="other_object_data" style="display:none">
					<div id="desc"><span style="color: red"><b>Please provide a description of what you would like to stop or opt out of.</b></span></div>
					<rn:widget path="custom/input/TextGDPR" name="Incident.c$gdpr_text" initial_focus="false" label_input="description of what you would like to stop or opt out of." required="false" /> 
				</div>-->
				
				<div id="delete_object_data" style="display:none">
						<div id="desc" style="text-align: left;">
							<span style="color: red; text-align:left"><b>Pour exercer votre droit à l’effacement, vous devez d’abord annuler votre compte Coach de Team BODi, tel que requis par les pratiques opérationnelles habituelles de BODi. Veuillez consulter la <a target='__blank' href='/app/answers/detail/a_id/9659'>FAQ 9659</a> pour plus d’informations concernant l’annulation de votre compte Coach.<br/><br/>Après l’annulation de votre compte Coach, vous pourrez demander l’effacement de vos données comme suit:</b></span>
													
							<div style="color: red;margin-left: 24px">
								<p><b>
									1) Retournez sur la page Internet suivante: <a href="https://faq.beachbody.fr/app/gdpr_form">https://faq.beachbody.fr/app/gdpr_form</a>.<br/>
									2) Sélectionnez "Client" dans le champ "Type d’abonnement"..<br/>
									3) Remplissez tous les champs, choisissez "Droit à l’effacement" et envoyez votre demande.


								</p></b>
								
							</div>
						
						</div>

				</div>
                <div id="delete_object_data_pc" style="display:none">
                        <div id="desc" style="text-align: left;">
                            <span style="color: red; text-align:left"><b>Pour exercer votre droit à l’effacement, vous devez d’abord annuler votre compte Client Privilégié de Team BODi, tel que requis par les pratiques opérationnelles habituelles de BODi. Veuillez consulter la <a target='__blank' href='https://faq.beachbody.fr/app/answers/detail/a_id/13633'>FAQ 13633</a> pour plus d’informations concernant l’annulation de votre compte Client Privilégié.<br/><br/>Après l’annulation de votre compte Client Privilégié, vous pourrez demander l’effacement de vos données comme suit:</b></span>
                                                    
                            <div style="color: red;margin-left: 24px">
                                <p><b>
                                    1) Retournez sur la page Internet suivante: <a href="https://faq.beachbody.fr/app/gdpr_form">https://faq.beachbody.fr/app/gdpr_form</a>.<br/>
                                    2) Sélectionnez "Client" dans le champ "Type d’abonnement"..<br/>
                                    3) Remplissez tous les champs, choisissez "Droit à l’effacement" et envoyez votre demande.
                                </p></b>
                                
                            </div>
                        
                        </div>
                </div>
				<div id="totalFields" style="display:none">
					<br/>
					<div id="complete_info" style="text-align:left; font-size:15px;"><b>Veuillez compléter les champs ci-dessous avec les mêmes informations que vous avez fournies à BODi lors de la création de votre compte. Nous utiliserons les éléments suivants pour valider correctement votre demande:</b></div>
					<br/>
					<div id="contact_object_data" style="">
					<rn:widget path="custom/input/CustomFormInput" name="Contact.Name.First" label_input="Prénom" required="true" label_required="%s sont requis" allow_external_login_updates="true"/>
					<rn:widget path="custom/input/CustomFormInput" name="Contact.Name.Last" label_input="Nom" required="true" label_required="%s sont requis" allow_external_login_updates="true"/>
					</div>
					<!--<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="false" label_input="#rn:msg:EMAIL_ADDR_LBL#" label_validation="Confirm Email Address" require_validation="true"/>-->
					<div id="coach_fields" style="display:none">
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$coachcustomernumber" label_input="Identifiant de coach" required="false" label_required="%s sont requis"/>
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$last_four_ssn" initial_focus="false" label_input="Les quatre derniers chiffres de la carte de crédit utilisée pour régler vos frais de service mensuels" required="false" always_show_mask="false" label_required="%s sont requis"/>
					</div>
					
					<div id="phone_fields">
					<rn:widget path="custom/input/CustomFormInput" name="Contact.Phones.MOBILE.Number" label_input="Numéro de téléphone" required="true" label_required="%s sont requis" allow_external_login_updates="true"/>
					</div>
					<div id="customer_fields" style="display:none">
						<rn:widget path="custom/input/TextGDPR" name="Incident.c$billing_zip_postal_code" label_input="Code postal / ZIP de l’adresse de facturation" required="false" label_required="%s sont requis">
					</div>
					<div id="email_fields"> 
					<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="false" label_input="Adresse e-mail" label_required="%s sont requis" allow_external_login_updates="true"/>
					</div>
					<div style="display:none">
					<rn:widget path="custom/input/TextGDPR" name="Incident.Threads" initial_focus="false" label_input="Question" required="false"/> 
					</div>
					<div style="display:none">
						<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value="1503" required="false"/> <!--change to 1503 when moved to prod-->
						<rn:widget path="custom/input/CustomFormInput" name="Incident.Subject" label_input="Subject" default_value="Data Subject Request Form Submittal" required="false" />
					</div>
					
					<div id="disclaimer_box" style="display:none">
						<rn:widget path="custom/input/checkboxDisclaimer" />
					</div>
					<div id="submit">
						<!--<div id="gdpr_title"><b>I am not a ROBOT</b></div>-->
						<div id ="gdpr_captcha" style="margin-top:12px;"></div>					
						<rn:widget path="custom/input/CheckBoxGDPR" />
						<rn:widget path="custom/input/SubmitGDPR" label_button="Envoyer" on_success_url="/app/gdpr_confirm/" error_location="rn_ErrorLocation_gdpr" challenge_required="true" challenge_location="gdpr_captcha"/>
						<div id="t_and_c1" style="margin-top:10px;">Conditions générales de BODi: <a href="https://www.teambeachbody.com/shop/fr/terms-of-use">FRANCE(FR)</a> </div>					
						<div id="privacy_policy1">Politique de confidentialité de BODi: <a href="https://www.teambeachbody.com/shop/fr/privacy">FRANCE(FR)</a> </div>

					</div>
					
					<!--<div id="submit">	
					https://www.teambeachbody.com/shop/fr/privacy?locale=en_GB									
						<div  class="g-recaptcha" data-sitekey="6LeDG0gUAAAAABJd_uMgBi5xkgTc7Z1g-DD7deUi"></div>
						<rn:widget path="custom/input/CheckBoxGDPR" />
						<rn:widget path="custom/input/SubmitGDPR" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/gdpr_confirm" error_location="rn_ErrorLocation_gdpr"/>
					</div>-->
					

				</div>
				
			</div>
			
		</form>
	</div>
</div>