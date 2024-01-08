
 <? $actual_link = $_SERVER['REQUEST_URI']; 
    $text = str_replace('/app/contactus_support_fb/', ' ', $actual_link);
    $text = trim($text);
	
	$login_mobile_url_redirect = "/app/chat/facebooksurvey/".$text;
	
 ?>
 
 
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
	<div class="container">
		<div class="row">
			<div class="contact-us contact-widget">
				<div class="chat-reccomend">
					<div class="box-widget">						
						<ul class="boxes-3 rec-boxes" id = "mobile_fb_click_start_session">
							
<rn:condition logged_in="false">			
						   <a href="javascript:void(0);" class="self-service-form active-chat" id=
						   "rn_<?= $this->instanceID ?>">   
							<div id="recommended-title-div">Para un servicio más rápido</div>
							<li>
								<span>Iniciar Sesión</span>
							</li>
							</a>	
<rn:condition_else/>
							<a href="<?= $login_mobile_url_redirect ?>" class="self-service-form active-chat" id="rn_<?= $this->instanceID ?>">   
							<div id="recommended-title-div">Para un servicio más rápido</div>
							<li>
								
								<span>Iniciar Sesión</span>
							</li>
							</a>
</rn:condition>					
						</ul>
						<rn:condition logged_in="false">
						<div class="continue-as-guest-box">
							<a href = "<?= $login_mobile_url_redirect ?>" > Continuar como invitado</a>
							<p>Necesitará ingresar información adicional para la verificación de la cuenta.</p>
						</div>
						</rn:condition>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

