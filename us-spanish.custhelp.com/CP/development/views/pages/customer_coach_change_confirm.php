<rn:meta title="Customer Partner Change Confirmation" template="standard_responsive_bb.php" clickstream="ccc_confirm"/>
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
					<b><li style="color:red;">Oh no, se produjo un error al enviar su formulario. Vuelva a completar la solicitud para que un agente pueda procesarla.</li></b>
					<? else: ?>
					<strong style="font-weight:bold!important;margin-left:170px!important;/*margin-bottom:20px !important;*/"></strong>
					<? if($ctype == 4): ?>
					<b><li>Tu solicitud de cambio de partner cliente preferente ha sido enviado a Apoyo de BODi para su procesamiento</li></b>
					<? else: ?>
					<b><li>Tu solicitud de partner de BODi ha sido enviada para su procesamiento.</li></b>
					<? endif; ?>
					
					<li>Revisaremos su solicitud y le enviaremos un correo electronico dentro de las 24 horas.</li>
					<li>Tu número de expediente es <b>#rn:url_param_value:refno#</b></li></br>
					
					<!--<li>Para obtener más ayuda, visite nuestra <a target="_blank" href="/app/home/" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">pagina de soporte</a>.</li> -->
					<li>Para asegurar de que recibas comunicaciones de BODi y de tu nuevo partner de BODi, actualiza las preferencias y privacidad de tu correo electrónico <a target="_blank" href="<?= $base_uri?>" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">aquí</a>.</li> 
					<? endif; ?>
					</div>
      
    		</div>
		  </div>
		</div>
</div>