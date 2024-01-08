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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

$contact = get_instance()->model('Contact')->get()->result;
$contact_type = $contact->ContactType->ID;
$contact_id = $contact->ID;

$contact_country = isset($contact->Address->Country) ? $contact->Address->Country->ID : 0;
$contact_country_name = isset($contact->Address->Country) ? $contact->Address->Country->LookupName : 0;
//echo "<br> contact_country = ".$contact_country_name;
$contact_full = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contact_email = $contact_full->Emails[0]->Address;
$member_typ = $contact_full->CustomFields->c->member_type;
$coach_id = $contact_full->CustomFields->c->coach_id;
$guid = $contact_full->CustomFields->c->customer_guid;

/*echo "<br> contact_type = ".$contact_type;
echo "<br> member_typ = ".$member_typ;
echo "<br> contact_email = ".$contact_email;
echo "<br> coach_id = ".$coach_id;
*/

//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id);

if ($guid) {
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid", $contact_country_name, null, null, null, null, null, "CUST", $member_typ, $contact_type, $coach_id, $guid);
} else {
	$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email", $contact_country_name, null, $contact_email, null, null, null, "CUST", $member_typ, $contact_type, $coach_id, null);
}

$contactfull = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);
$contacttyp = $contactfull->ContactType->ID;
//echo "<br> contacttyp = ".$contacttyp;

?>

<? if ($contacttyp != 1 && $contacttyp != 4): // Customer ?>

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

							<h2 class="ccc_title"> Formulaire de demande de partner </h2>

							<div id="Language_Header_English" style="display:block;">
								<p><strong>
										Utilisez ce formulaire pour obtenir ou changer votre partner BODi. Reportez-vous à
										la <a href="/app/answers/detail/a_id/3000/catid/0/TLP/0">FAQ 3000</a> pour obtenir
										des conseils sur la manière de trouver un partner BODi adapté à votre
										parcours.<br /><br />

									</strong></p>
							</div>
							<div class="rn_RequiredText rn_FloatRight">*&nbsp;Champs requis</div>



							<!---------------------	 Language Dropdown-------------->
							<div style="display:none">
								<div id=div_country>
									<rn:widget path="input/SelectionInput" name="Contact.Address.Country"
										label_input="Country/Pais/Pays" allow_external_login_updates="true" />
								</div>

								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language"
									label_input="Language/Idioma/Langue" default_value="752" />
							</div>
							<div id="email_redesign" class="cr_details">
								<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address"
									label_input="Adresse e-mail" required="false" allow_external_login_updates="true"
									required="true" />
							</div>

							<!-----------------Coach or Customer Dropdown-------------->

							<div id="coach_or_customer_english_redesign" style="display:block">
								<rn:widget path="custom/ccc_form/SelectionInputLanguage"
									name="Incident.CustomFields.c.member_type_eng" required="true"
									label_input="Un partner vous a été recommandé?" label_required="est requis" />
							</div>
							<div id="yes_no_main_div" style="display:none">
								<h2 style="color:black;font-size: 1.6em !important;">Saisissez ci-dessous les informations
									relatives à votre partner BODi :</h2>
								<p>
									<!--<strong style="color:red;">
						Remarque: 
						</strong>
						Le coach entré ci-dessous recevra les bénéfices associés aux commandes passées dans les 14 jours suivant cette demande. Aucune action supplémentaire n'est requise.
						</p>-->

									<rn:widget path="custom/ccc_form/TextInputCCC"
										name="Incident.CustomFields.c.ccc_transfer_coach_email"
										label_input="Adresse e-mail du partner BODi" required="false" />
									<rn:widget path="custom/ccc_form/TextInputCCC"
										name="Incident.CustomFields.c.ccc_transfer_coach_name"
										label_input="Nom du partner BODi" required="false" />

								<div style="padding:0px 0px 10px 0px;" id="permissions">
									<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10"
										id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b
										style="color:#FF0000"> *</b> En cochant la case, vous confirmez que les informations
									du partner BODi que vous avez fournies dans ce formulaire sont complètes et exactes.
									Votre demande pourrait être retardée si certaines informations fournies sont erronées.

								</div>

							</div>


							<div id="eng_last_head" style="display:none">
								<h4>La demande sera traitée dans les 24 heures suivant son envoi.</h4>
							</div>

							<div style="display:none">
								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing"
									required="false" default_value="1626" />
								<rn:widget path="custom/ccc_form/customer_coach_checkbox" name="Incident.Subject"
									required="false" default_value="Your Beachbody Customer Partner Change Request" />
								<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng"
									required="false" default_value="754" />
							</div>

							<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc"
								label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm" />

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<? else: ?>
	<!-- PC - START -->

	<? if ($contacttyp == 4): // PC 
			date_default_timezone_set('Pacific Standard Time');
				$contactid = $this->session->getProfile()->c_id->value;
				$authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
				$currentidcoachdate = $authorizeduser->CustomFields->c->currentidcoachdate;
				$currentidpcdate = $authorizeduser->CustomFields->c->currentidpcdate;

				if ($currentidcoachdate || $currentidpcdate) {
					$today = date("Y/m/d");
					$today_timestamp = strtotime($today);
					$current_id_coach_date = date("Y/m/d", $currentidcoachdate);
					$date_limit_currentidcoachdate = date('Y/m/d',strtotime($current_id_coach_date . ' + 10 days'));
					$date_limit_timestamp_currentidcoachdate = strtotime($date_limit_currentidcoachdate);

					$current_id_pc_date = date("Y/m/d",$currentidpcdate);
					$date_limit_currentidpcdate = date('Y/m/d', strtotime($current_id_pc_date . ' + 10 days'));
					$date_limit_timestamp_currentidpcdate = strtotime($date_limit_currentidpcdate);
					//echo ($date_limit_timestamp - $today_timestamp)/60/60/24;
					//if((($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidcoachdate - $today_timestamp)/60/60/24 >=0)||(($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 <=10 && ($date_limit_timestamp_currentidpcdate - $today_timestamp)/60/60/24 >=0)){
		
					if ((((($date_limit_timestamp_currentidcoachdate - $today_timestamp) / 60 / 60 / 24 >= 0) || ($currentidcoachdate == NULL)) && ((($date_limit_timestamp_currentidpcdate - $today_timestamp) / 60 / 60 / 24 >= 0) || ($currentidpcdate == NULL))) || (($currentidpcdate != NULL) && ($currentidcoachdate != NULL) && ((($date_limit_timestamp_currentidcoachdate - $today_timestamp) / 60 / 60 / 24 >= 0) && (($date_limit_timestamp_currentidpcdate - $today_timestamp) / 60 / 60 / 24 >= 0)))) {
						$limit = 1; //inside time; form submission allowed
					} else {
						$limit = 2; //outside time ; update now allowed
					}
				} else {
					$limit = 2;
				}
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

									<h2 class="ccc_title"> Client privilégié : Formulaire de demande de changement de partner</h2>

									<div id="Language_Header_English" style="display:block;">
										<p><strong>
												Utilisez ce formulaire pour changer votre partner BODi.<br /><br />

											</strong></p>
									</div>
									<div class="rn_RequiredText rn_FloatRight">*&nbsp;Champs requis</div>



									<!---------------------	 Language Dropdown-------------->
									<div style="display:none">

										<div id=div_country>
											<rn:widget path="custom/ccc_form/SelectionInputCountry" name="Contact.Address.Country"
												label_input="Country" required="true" allow_external_login_updates="true" />
										</div>
										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_language"
											label_input="Language/Idioma/Langue" default_value="752" />
									</div>
									<div id="email_redesign">
										<rn:widget path="custom/ccc_form/TextInputCCC" name="Contact.Emails.PRIMARY.Address"
											label_input="Adresse courriel" required="false" allow_external_login_updates="true"
											required="true" />
									</div>

									<!-----------------Coach or Customer Dropdown-------------->
									<div id="coach_or_customer_english_redesign" style="display:none">
										<rn:widget path="custom/ccc_form/SelectionInputLanguage"
											name="Incident.CustomFields.c.member_type_eng" required="false"
											label_input="Un partner vous a été recommandé?" />
									</div>
									<div id="yes_no_main_div">
										<h2 style="color:black;font-size: 1.6em !important;">Saisissez les coordonnées du partner
											auprès duquel vous souhaitez être transféré : </h2>

										<rn:widget path="custom/ccc_form/TextInputCCC"
											name="Incident.CustomFields.c.ccc_transfer_coach_email"
											label_input="Adresse e-mail du partner" required="true" />
										<rn:widget path="custom/ccc_form/TextInputCCC"
											name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Nom du partner"
											required="true" />

										<div style="padding:0px 0px 10px 0px;" id="permissions">
											<input type="checkbox" name="RESULT_CheckBox-21" class="m-r-10"
												id="RESULT_CheckBox-21_0" value="CheckBox-0" style="width: 20px;height: 20px;"><b
												style="color:#FF0000"> *</b> En cochant la case, vous confirmez que les informations
											du partner que vous avez fournies dans ce formulaire sont complètes et exactes. Votre
											demande pourrait être retardée si certaines informations fournies sont erronées.
										</div>
									</div>


									<div id="eng_last_head" style="display:none">
										<h4>La demande sera traitée dans les 2 jours ouvrables suivant la date de l'envoi.</h4>
									</div>

									<div style="display:none">
										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.form_routing"
											required="false" default_value="1728" />
										<rn:widget path="custom/ccc_form/customer_coach_checkbox" name="Incident.Subject"
											required="false"
											default_value="Your Beachbody Preferred Customer Partner Change Request" />
										<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.ccc_transfer_vc_eng"
											required="false" default_value="754" />
									</div>

									<p> La demande sera traitée dans les 2 jours ouvrables suivant la date de l'envoi. </p>

									<rn:widget path="custom/ccc_form/FormSubmitCCC_responsive" error_location="rn_ErrorLocation_ccc"
										label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/customer_coach_change_confirm" />

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
					<span style="color:#bf2600;font-weight: bold;">Vous recevez ce message, car vous êtes en dehors du délai de 10
						jours et n'êtes pas éligible pour demander un changement de Partner Sponsor - il n'y a aucune exception à
						cette politique.</span><br /><br /><span style="font-weight: 300;">Nous comprenons que ce soutien est
						essentiel pour atteindre vos résultats et nous sommes ici pour vous proposer plusieurs options.</span>
					&nbsp;<br /><br />

					<span style="font-weight: bold;">Option n° 1: </span><span style="font-weight: 300;"><a
							href="https://www.beachbodyondemand.com/groups-about?locale=fr_FR"
							style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank">Rejoignez
							un BODgroup</a> – Il s’agit d’une plateforme communautaire exclusive de Beachbody qui favorise la
						motivation, la responsabilisation et les liens avec votre groupe pour atteindre vos objectifs. Sur le site
						et l’application BOD, vous pouvez aussi effectuer le suivi de vos activités et de vos progrès
						quotidiens.<br /></br>De nombreux partners dirigent un BODgroup ouvert et sont ravis de vous voir rejoindre
						leur groupe d’engagement, même si un partner différent vous est attribué. Si vous pensez à un partner en
						particulier, vous pouvez lui demander de vous ajouter ou il peut vous envoyer le lien de son BODgroup pour
						que vous vous y joigniez.&nbsp;</span> &nbsp;<br /><br />

					<span style="font-weight: bold;">Option n° 2: </span><span style="font-weight: 300;"><a
							href="https://www.facebook.com/groups/bodmembers"
							style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Groupe
							Facebook BOD </a> – Pour être motivé, il est important de trouver votre tribu. Rejoignez notre groupe
						Facebook florissant de plus de 95 000 membres pour obtenir soutien et responsabilisation entre
						participants.&nbsp;</span> &nbsp;<br /><br />

					<span style="font-weight: bold;">Option n° 3: </span><span style="font-weight: 300;"><a
							href="https://www.beachbodyondemand.com/blog/?"
							style="color:#0052CC;font-weight:bold;text-decoration:none;text-indent:0in;" target="_blank"> Blog
							Beachbody</a> – Cliquez ici pour connaître les dernières nouvelles sur la santé et le
						fitness.&nbsp;</span> &nbsp;<br /><br />

					<span style="font-weight: 300;">Veuillez consulter la <a href="/app/answers/detail/a_id/11893/catid/0/TLP/0"
							style="color:#0052CC;">FAQ 11893</a>: Changer mon partner, pour plus de détails.</span> <br /><br />
				</div>
			</div>

		<? endif; ?>

	<? else: ?>
		<!-- PC - END -->
		<div id="rn_ccc_top" class="rn_ccc_restrict_top" style="width: 85%">
			<div style="padding-left: 38px;font-weight: 600;" class="rn_ccc_restrict">
				<br /><img src="/euf/assets/themes/responsive/images/error_icon.PNG">
				Ce formulaire ne peut être soumis que par un client ou un client privilégié. <br /><br /> Pour plus de détails,
				veuillez consulter la FAQ <a href="/app/answers/detail/a_id/11893/catid/0/TLP/0">11893</a>: Obtenir ou changer
				de partner BODi.<br /><br />Si vous êtes un partner BODi et que vous souhaitez changer de parrain, veuillez
				consulter la FAQ <a href="/app/answers/detail/a_id/11893/catid/0/TLP/0">11893</a>: Généalogie - Changement de
				parrain et changement de placement.

			</div>
		</div>

	<? endif; ?>
<? endif; ?>