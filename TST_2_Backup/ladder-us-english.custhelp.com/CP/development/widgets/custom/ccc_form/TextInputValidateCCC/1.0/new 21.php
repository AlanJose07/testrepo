	<rn:meta title="Customer Coach Change" template="custcoachchangetemplate.php" clickstream="incident_create"/>
	<div id="rn_IFrameContent" class="rn_OrderPage">
		<div id="rn_content" class="rn_questionform">
			<div class="rn_wrap rn_padding wrappad">
				<form id="rn_CustCoachChange" method="post" action="/ci/ajaxRequest/sendForm" onsubmit="return false;" >
					<div style="text-align:center;">
	<img height="60" width="300" alt="" src="https://faq.beachbody.com/euf/assets/images/team_beachbody_coach_packages.png">
					</div>
					<div id="main_heading_english" style="display:block;padding-left:15px;"><h2 style="align:center;">Customer Coach Change Request Form  				</h2>
					</div>
					<br />
					<div id="rn_ErrorLocation"></div>
					<div style="padding-left:15px">
					
					<div id="Language_Header_English" style="display:none;">
					<p><strong>
						  Use this form to change the Team Beachbody Coach assigned to a customer. Please fill out all required information accurately. Your request may be delayed if incorrect information is received.<br /><br />
	
	Answers to frequently asked questions regarding the Customer Coach Change process can be found in <span><a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/2336/kw/2336/~/customer-coach-change%3a-how-to-change-the-coach-assignment-of-a-customer/lob/coach" style="color: #0000ff; background-color: #ffffff;">FAQ 2336</a>
	</span>
	
						</strong></p>
						</div>
						
						<div id="Language_Header_French" style="display:none;">
						<h2 style="align:center;">Formulaire de demande du changement de Coach pour client  </h2>
						<br />
						
						<p><strong>
						  Utilisez ce formulaire pour changer le Coach Team Beachbody assigné à un client. Veuillez remplir tous les champs requis avec des renseignements exacts. Votre demande pourrait être retardée si des renseignements erronés sont fournis.
						<br /><br />
	 
	Vous trouverez des réponses aux questions relatives au processus de changement de coach d'un client dans la  <span><a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/2336/kw/2336/~/customer-coach-change%3a-how-to-change-the-coach-assignment-of-a-customer/lob/coach" style="color: #0000ff; background-color: #ffffff;">FAQ 2336</a>
	</span>
	
						</strong></p>
						</div>
						<br />
	
						<div id="Language_Header_Spanish" style="display:none;">
						<h2 style="align:center;">Formulario de solicitud de cambio de coach de un cliente </h2>
						<br />
						
						<p><strong>
						  Utiliza este formulario para cambiar el coach de Team Beachbody asignado a un cliente. Completa con precisión toda la información requerida. Tu solicitud se podría demorar si recibimos la información incorrecta.
						<br /><br />
	 
	Puedes encontrar respuestas a las preguntas frecuentes sobre el proceso de Cambio de coach de un cliente en la <span><a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/2336/kw/2336/~/customer-coach-change%3a-how-to-change-the-coach-assignment-of-a-customer/lob/coach" style="color: #0000ff; background-color: #ffffff;">FAQ 2336</a>
	</span>
	
						</strong></p>
						</div>
						
						<div id="Coach_Header_English" style="display:none;">
						<p>
						<strong style="color:red;">
						Note: If you are a new Coach seeking to change your sponsor, please do not submit this form. Instead, follow the process in <span style="color: #0000ff;">
	<a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/1488/kw/1488/~/sponsor-change-requirements-%2f-process-time/lob/coach" style="color: #0000ff;">FAQ 1488</a>
	</span> to request a sponsorship change. This form should only be used to change the coach assignment of a customer. 
						</strong>
						</p>
						</div>
						<div id="Coach_Header_French" style="display:none;">
						<p>
						<strong style="color:red;">
						Remarque : Si vous êtes un nouveau coach à la recherche d'un parrain, veuillez ne pas envoyer ce formulaire. Suivez plutôt le processus de la <span style="color: #0000ff;">
	<a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/1488/kw/1488/~/sponsor-change-requirements-%2f-process-time/lob/coach" style="color: #0000ff;">FAQ 1488</a>
	</span> pour demander un changement de parrain. Ce formulaire devrait uniquement servir à changer le coach assigné à un client.  
						</strong>
						</p>
						</div>
						
						<div id="Coach_Header_Spanish" style="display:none;">
						<p>
						<strong style="color:red;">
						Nota: Si eres un nuevo coach que busca cambiar de patrocinador, no envíes este formulario, sino sigue el proceso que se indica en la <span style="color: #0000ff;">
	<a target="_blank" href="https://faq.beachbody.com/app/answers/detail/a_id/1488/kw/1488/~/sponsor-change-requirements-%2f-process-time/lob/coach" style="color: #0000ff;">FAQ 1488</a>
	</span> para cambiar de patrocinador. Este formulario es solo para cambiar el coach asignado a un cliente.  
						</strong>
						</p>
						</div>
						
						
						<div id = "email_validate" style="display:none">
						<input type="text"  id="check_email_validate" value="0" />
						</div>
						<div id = "validate_required" style="display:none">
						<input type="text"  id="check_validate" />
						</div>
	
	
						
						<div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
						
						
							<!---------------------	 Language Dropdown-------------->
		
							<rn:widget path="custom/customercoachchange/SelectionInputLanguage" name="Incident.CustomFields.c.ccc_language" label_input="Language/Idioma/Langue" required="true"/>
							
							<!-----------------Coach or Customer Dropdown-------------->
							
							<div id="coach_or_customer_english" style="display:none">
							<rn:widget path="custom/customercoachchange/SelectionInputLanguage" name="Incident.CustomFields.c.member_type" required="false" label_input="Are you a Customer or a Coach?"/>
							</div>
							
							<div id="coach_or_customer_french" style="display:none">
							<rn:widget path="custom/customercoachchange/SelectionInputLanguage" name="Incident.CustomFields.c.member_type_fre" required="false"label_input="Êtes-vous un client ou un coach?"/>
							</div>
							
							<div id="coach_or_customer_spanish" style="display:none">
							<rn:widget path="custom/customercoachchange/SelectionInputLanguage" name="Incident.CustomFields.c.member_type_spa" required="false"label_input="¿Eres un cliente o un coach?"/>
							</div><br />
							
							<!-----------------I'm Coach------------------------------------->
							
							<div id="full_name" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_requestor_name" label_input="Full Name" required="false" />
							</div>
							
							<div id="coach_customer_id" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.coachcustomernumber"  label_input="Coach ID" required="false"/> 
							</div>
							
							<div id="ssn" style="display:none">
							<rn:widget path="custom/input/customTextInputSSN_CCC" name="Incident.CustomFields.c.last_four_ssn" required="false"  label_input = "Last 4 digits of social security number" always_show_mask= "false" />
							</div>
							
							<div id="zip" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.billing_zip"  label_input="Billing Zip Code" required="false"/>
							</div>
							
							<div id="email" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" required="false" />
							</div>
							
							<div id="telephone" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_requestor_phone" label_input ="Telephone Number" required="false" />
							</div>
							
							<div id="coach_eng_sub_head1" style="display:none"><h2 style="color:black;">Enter the information of the customer you would like transferred to you. </h2><br /></div>
							
							<div id="coach_fre_sub_head1" style="display:none"><h2 style="color:black;">Saisissez les renseignements du client que vous voudriez que l'on vous transfère.</h2><br /></div>
							
							<div id="coach_spa_sub_head1" style="display:none"><h2 style="color:black;">Ingresa la información del cliente que quieres que se te asigne.</h2><br /></div>
							<div id="cust_eng_sub_head1" style="display:none"><h2 style="color:black;">Enter the Coach information of whom you would like to be transferred to.
							</h2><br /></div>
							<div id="cust_fre_sub_head1" style="display:none"><h2 style="color:black;">Saisissez les renseignements du coach à qui vous voudriez être transféré.
							</h2><br /></div>
							<div id="cust_spa_sub_head1" style="display:none"><h2 style="color:black;">Ingresa la información del coach al que deseas ser asignado.
							</h2><br /></div>
							
							<div id="cust_coach_info" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_id" required="false" label_input="Coach ID#" />
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_name" label_input="Coach Name" required="false" />
							
							
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coach_email" label_input ="Coach Email Address" required="false" />
							<rn:widget path="input/TextInputValidate" name="Incident.CustomFields.c.ccc_transfer_coach_email" label_input="Confirm Email Address" required="false" />
							<!--<input type="text" id="confirm_email" name="Confirm Email Address"style="width: 450px"/>-->
							
							<div id="email_alert" style="color:#FF0000"></div>
							<div id="email_add_coach_eng" style="display:none">	<h4>Please use the email address on file for your coach's account</h4></div>
							<div id="email_add_coach_fre" style="display:none">	<h4>Veuillez utiliser l'adresse courriel dans le dossier de votre compte de coach. </h4></div>
							<div id="email_add_coach_spa" style="display:none">	<h4>Utiliza la dirección de correo electrónico que tenemos registrada en la cuenta de tu coach.
							</h4></div>
							
							</div>
						<!--------Would you like to transfer the credit of  recent order to  new Coach------>	
							
							<div id="tvcdropdown" style="display:none;">
							<rn:widget path="custom/customercoachchange/SelectionInputLanguage" name="Incident.CustomFields.c.ccc_transfer_vc_eng" label_input =" Would you like to transfer the credit of your recent order to your new Coach? " required="false"/>
							</div>
							
							<div id="transfer_vc_customer_eng_yes" style="display:none;">
							<strong> Transfer Beachbody Order to Coach:</strong><br /><br />
							
							
							Customers can transfer their Beachbody.com or direct response order to a Coach account if they meet the following requirements:
							<li>	• They paid the full cost of their order within 14 days of the order date</li>
							<li>    • They have a Team Beachbody account</li>
							<li>	• They made the request within 31 days of the order date</li>
							<br />
							<br />
							<strong>Transfer Customer Order from one Coach to Another: </strong><br />
							<br />
							
							Customers or Coaches can transfer an order from one Coach to another Coach if they make the request within 14 days of the order date.<br />
							
							</div>
							
							 
							 
							 
							<div id="transfer_vc_customer_fre_yes" style="display:none;">
							<strong>Transfert de la commande de Beachbody à un coach:</strong><br /><br />
							
							
							Les clients peuvent transférer leurs commandes de Beachbody.com ou directes à un compte de coach s'ils répondent aux critères suivants :
							<li>  • Ils ont payé le prix complet de leur commande dans les 14 jours suivant la date de la commande</li>
							<li>  • Ils ont un compte du Team Beachbody</li>
							<li>  • Ils ont fait la demande dans les 31 jours suivant la date de la commande</li>
							 <br />
							<br />
							<strong>Transfert de la commande du client d'un coach à un autre : </strong> <br /><br />
							
							
							 Les clients ou les coachs peuvent transférer une commande d'un coach à un autre s'ils en font la demande dans les 14 jours suivant la date de la commande.<br />
							
							 <!--<rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.orderno" label_input =" Votre numéro de commande" />-->
							</div>
							
							<div id="transfer_vc_customer_spa_yes" style="display:none;">
							<strong> Transferir un pedido de Beachbody al coach:</strong><br /><br />
							
							
							 Los clientes pueden transferir un pedido de Beachbody.com o de repuesta directa a la cuenta de su coach si cumplen con los siguientes requisitos:
							<li>	 • Han pagado el costo total de su pedido en un plazo de 14 días después de la fecha del pedido.</li>
							<li>	 • Tienen una cuenta de Team Beachbody.</li>
							<li>   • Presentaron la solicitud en un plazo de 31 días después de la fecha del pedido.</li>
							<br />
							<br />
							<strong>Transferir el pedido de un cliente de un coach a otro: </strong><br />
							<br />
							
							 Los clientes o coaches pueden transferir un pedido de un coach a otro si presentan la solicitud en un plazo de 14 días después de la fecha del pedido.<br />
							
							 <!--<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.orderno" />-->
							 </div>
	
							
							
							
							<div id="your_order_no" style="display:none;">
						    <rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_custorder" label_input ="Your Order Number" />
							 </div>
							<div id="cust_eng_last_head" style="display:none"><h4>The request will be processed within 2 business days of submission.</h4></div>
							<div id="cust_fre_last_head" style="display:none"><h4>La demande sera traitée dans les 2 jours ouvrables suivant la date de l'envoi</h4></div>
							<div id="cust_spa_last_head" style="display:none"><h4>El reembolso se procesará en dos días hábiles a partir del envío de la solicitud.</h4></div>
							</div>
	
	
							<div id="cust_fullname" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_cust_name" label_input="Customer Full Name" required="false" />
							</div>
							
							<div id="cust_id" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_cust_id" required="false" label_input="Customer ID" />
							</div>
							<div id="coach_eng_sub_head2" style="display:none"><h3> At least one data point from the following must be provided:  </h3><br /></div>
							<div id="coach_fre_sub_head2" style="display:none"><h3> Au minimum une des informations ci-dessous est requise:</h3><br /></div>
							<div id="coach_spa_sub_head2" style="display:none"><h3> Debes proporcionar al menos uno de los siguientes datos:</h3><br /></div>
								
							<div id="customer_details" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_cust_email" label_input ="Customer Email" />
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_cust_phone" label_input ="Customer Telephone Number" />
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_cust_address" label_input ="Customer Shipping Address" />
							</div>
							<div id="coach_eng_sub_head3" style="display:none"><h3> At least one data point from the following must be provided:</h3><br /></div>
							<div id="coach_fre_sub_head3" style="display:none"><h3>Au moins une donnée parmi les suivantes doit être fournie :</h3><br /></div>
							<div id="coach_spa_sub_head3" style="display:none"><h3> Debes proporcionar al menos uno de los siguientes datos:</h3><br /></div>				
					
							<div id="order_details" style="display:none">
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.ccc_transfer_coachorder" label_input ="Enter Original Order #" />
							<rn:widget path="custom/customercoachchange/TextInputCCC" name="Incident.CustomFields.c.last_four_cc"  label_input = "Enter Last 4 digits of Credit Card Used to Place Order" always_show_mask= "false" />
							</div>
							
							<div id="transfer_vc_coach_eng_yes" style="display:none;">
							<strong> Transfer Beachbody Order to Coach:</strong><br /><br />
							
							Customers can transfer their Beachbody.com or direct response order to a Coach account if they meet the following requirements
							<li>• They paid the full cost of their order within 14 days of the order date</li>
							<li>• They have a Team Beachbody account</li>
							<li>• They made the request within 31 days of the order date</li>
							<br />
							<br />
							<strong>Transfer Customer Order from one Coach to Another:</strong> <br /><br />
							
							Customers or Coaches can transfer an order from one Coach to another Coach if they make the request within 14 days of the order date.<br />
							
							</div>
							<div id="transfer_vc_coach_fre_yes" style="display:none;">
							
							<strong>Transfert de la commande de Beachbody à un coach:</strong><br /><br />
							
							
							Les clients peuvent transférer leurs commandes de Beachbody.com ou directes à un compte de coach s'ils répondent aux critères suivants :
							 <li> • Ils ont payé le prix complet de leur commande dans les 14 jours suivant la date de la commande</li>			 <li> • Ils ont un compte du Team Beachbody</li>
							 <li> • Ils ont fait la demande dans les 31 jours suivant la date de la commande</li>
							 <br />
							<br />
							<strong>Transfert de la commande du client d'un coach à un autre : </strong><br />
							<br />
							
							 Les clients ou les coachs peuvent transférer une commande d'un coach à un autre s'ils en font la demande dans les 14 jours suivant la date de la commande.<br />
							
							</div>
							<div id="transfer_vc_coach_spa_yes" style="display:none;">
							
							<strong> Transferir un pedido de Beachbody al coach:</strong><br /><br />
							
							
							Los clientes pueden transferir un pedido de Beachbody.com o de repuesta directa a la cuenta de su coach si cumplen con los siguientes requisitos:
							<li> • Han pagado el costo total de su pedido en un plazo de 14 días después de la fecha del pedido.</li>
							<li> • Tienen una cuenta de Team Beachbody.</li>
							<li>  • Presentaron la solicitud en un plazo de 31 días después de la fecha del pedido.</li>
							 <br />
							<br />
							<strong>Transferir el pedido de un cliente de un coach a otro: </strong><br />
							<br />
							
							 Los clientes o coaches pueden transferir un pedido de un coach a otro si presentan la solicitud en un plazo de 14 días después de la fecha del pedido.<br />
							
							</div>
							
							<!--<div id="tvc_eng" style="display:none">
											
							
							<h4>The request will be processed within 2 business days of submission.</h4>
							</div>
							
							<div id="tvc_fre" style="display:none">
							
							
							
							<h4>La demande sera traitée dans les 2 jours ouvrables suivant la date de l'envoi</h4>
							</div>
							<div id="tvc_spa" style="display:none">
							
							
							<h4>El reembolso se procesará en dos días hábiles a partir del envío de la solicitud.</h4>
							</div>-->
					
		
				<rn:widget path="input/FormSubmit" error_location="rn_ErrorLocation" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/ask_confirm"/>
				</div>
			</form>
		  </div>
		</div>
	</div>
	<script>
	
	document.getElementById("check_validate").value = "0";
	document.getElementById("email_validate").value = "0";
	
	$("#shipment_visible br").remove();
	</script>