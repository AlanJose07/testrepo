<rn:meta title="Customer Paartner Change Confirmation" template="standard_responsive_bb.php" clickstream="ccc_confirm"/>
<style>
    body{
        width:100% !important;
    }
</style> 
<?
 $contactid =$this->session->getProfile()->c_id->value;
 $authorizeduser = $this->model('custom/bbresponsive')->fetchauthorizeduser($this->session->getProfile()->c_id->value);
 $consent_guid = $authorizeduser->CustomFields->c->customer_guid;
 $base_uri='https://preferencecenter.beachbody.com/?guid='.$consent_guid;
?>
<div class="confirm confirm_container container">
<div style="padding:0;text-align: center;">
	<!--<img height="60" width="300" alt="" src="https://faq.beachbody.com/euf/assets/images/team_beachbody_coach_packages.png">-->
</div>
	<div id="rn_IFrameContent" class="rn_OrderPage">
  		<div id="rn_content" class="rn_questionform">
    		<div class="rn_wrap">   
					
					<div id="confirm_eng">
					<rn:condition url_parameter_check="refno != null">
					
					</rn:condition>
					<? $response = getUrlParm('response');
					   if(!empty($response)): ?>
					<b><li style="color:red;">Oups, une erreur s'est produite lors de la soumission de votre formulaire.  Pour traiter votre demande, veuillez réessayer.</li></b>
					<? else: ?>
					<strong style="font-weight:bold!important;margin-left:170px!important;/*margin-bottom:20px !important;*/"></strong>
					<!-- PC - START -->
					<? if($ctype == 4): ?>
					<b><li>Votre demande de changement de partner pour client privilégié a bien été envoyée à l’Assistance BODi et sera bientôt traitée.</li></b>
					<? else: ?>
					<b><li>Votre demande de partner BODi a bien été envoyée et sera bientôt traitée.</li></b>
					<? endif; ?>
					<!-- PC - END -->
					
					<!-- <b><li>Votre demande de changement de coach pour client a été soumise à un agent pour résolution. </li></b>-->
					<li>Nous examinerons votre demande et vous enverrons un e-mail dans les prochaines 24 heures.</li>
					<li>Votre numéro de dossier est le <b>#rn:url_param_value:refno#</b></li></br>
					<!--<li>Pour plus d'assistance, veuillez visiter notre <a target="_blank" href="/app/home/" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">site d'assistance</a>.</li>-->
					<li>Pour vous assurer de recevoir les messages de BODi et de votre nouveau partner BODi, pensez à mettre à jour vos préférences concernant les e-mails et la confidentialité <a target="_blank" href="<?= $base_uri?>" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">ici</a>.</li>
					<? endif; ?>
					</div>
      
    		</div>
		  </div>
		</div>
</div>