
 <? $actual_link = $_SERVER['REQUEST_URI']; 
    $text = str_replace('/app/contactus_support_chat/', ' ', $actual_link);
    $text = trim($text);
	
	$login_mobile_url_redirect = "/app/chat/prechatsurvey/".$text;
	
 ?>
 
 
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
	<div class="container">
		<div class="row">
			<div class="contact-us contact-widget">
				<div class="chat-reccomend">
					<div class="box-widget">						
						<ul class="boxes-3 rec-boxes" id = "mobile_click_start_session">
							
<rn:condition logged_in="false">			
						   <a href="javascript:void(0);" class="self-service-form active-chat" id=
						   "rn_<?= $this->instanceID ?>">   
							<div id="recommended-title-div">For Faster Service</div>
							<li>
								<div class="chtrec-icon"><img src=
								"/euf/assets/themes/responsive/images/contactus_selfservice/Update_Account_Information.png"></div>
								<span>Log-in</span>
							</li>
							</a>	
<rn:condition_else/>
							<a href="<?= $login_mobile_url_redirect ?>" class="self-service-form active-chat" id="rn_<?= $this->instanceID ?>">   
							<div id="recommended-title-div">For Faster Service</div>
							<li>
								<div class="chtrec-icon"><img src=
								"/euf/assets/themes/responsive/images/contactus_selfservice/Update_Account_Information.png"></div>
								<span>Log-in</span>
							</li>
							</a>
</rn:condition>					
						</ul>
						<rn:condition logged_in="false">
						<div class="continue-as-guest-box">
							<a href = "<?= $login_mobile_url_redirect ?>" > Continue as Guest</a>
							<p>You will need to provide additional information for verification.</p>
						</div>
						</rn:condition>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

