<?
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])){
	$unsupported_browser = "/app/unsupported_browser";
	header('Location: ' . $unsupported_browser);
  }
?> 
<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta clickstream="prechatsurvey" javascript_module="standard" include_chat="true" noindex="true"/>
<head>
    <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
    <meta charset="utf-8"/>
    <title>Beachbody</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--[if lt IE 9]><script type="text/javascript" src="/euf/core/static/html5.js"></script><![endif]-->
    <rn:theme path="/euf/assets/themes/standard" css="site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
	<link href="/euf/assets/themes/responsive/css/chat_landing_style_site.css" rel="stylesheet">
    <link href="/euf/assets/themes/standard/contact_us_phase2_site.css" rel="stylesheet">
    <rn:head_content/>
    <rn:widget path="utils/ClickjackPrevention"/>
    <rn:widget path="utils/AdvancedSecurityHeaders"/>
    <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
    <link href="/euf/assets/themes/responsive/css/prechatsurvey_dev.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
#file-upload input[type="file"] {
    border: 1px solid #1378db !important;
    padding: 8px 15px;
    font-weight: 500;
    box-shadow: none;
    width: 100%;
    position: relative;
    left: 2px;
    background: transparent;
    border-radius: 4px;
}
#file-upload label {
    color: #8e8e8e;
    font-weight: 300;
    font-size: 15px !important;
}
.rn_ChatDialogTitle{
    margin-bottom: 13px;
}
div.rn_CustomFileAttachmentUpload  {
    padding-bottom: 10px;
}

span.rn_Required {
    font-size: 19px;
    position: absolute;
    margin-left: 1px;
    color: #C10000;
}
.rn_Thumbnail{
    margin-left: 24px;
}	
li{
font-size: 14px;
    margin-top: 10px;

}
</style>	
	
</head>
<body class="yui-skin-sam yui3-skin-sam">

<? $cookie_consent = \RightNow\Utils\Config::getConfig(1000063); //CUSTOM_CFG_COOKIE_CONSENT_NOTICE ?>  
<? if($cookie_consent): ?>
<!-- CookiePro Cookies Consent Notice start for faq.beachbody.com 
<script type="text/javascript" src="https://cookie-cdn.cookiepro.com/consent/b461bee9-443d-4fd3-9dd9-68a96af78471/OtAutoBlock.js" ></script>
<script src="https://cookie-cdn.cookiepro.com/scripttemplates/otSDKStub.js" data-document-language="true" type="text/javascript" charset="UTF-8" data-domain-script="b461bee9-443d-4fd3-9dd9-68a96af78471" ></script>
<script type="text/javascript">
function OptanonWrapper() { }
</script>
<!-- CookiePro Cookies Consent Notice end for faq.beachbody.com -->

<? endif; ?>

    <div id="rn_ChatContainer">
		<script>
		document.getElementById("rn_ChatContainer").classList.add("new-style");
		</script>
        <div id="rn_PageContent" class="rn_Live">
            <div class="rn_Padding">
                    <div id="rn_ChatDialogContainer" class="overlay">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitleLogo" class="rn_FloatLeft"><a href="/app/home"><img src=
						"/euf/assets/themes/responsive/images/logo.png"></a></div>
                     
                    </div>
					
				<!--	<rn:condition logged_in="false">
					<div id="rn_EmailTitle" class="rn_FloatLeft">Veuillez vous connecter pour continuer avec soumettre une fonctionnalité de document.</div>
					</rn:condition> -->
					
					<?php 
					$CI = &get_instance();
					$flag = \RightNow\Utils\Url::getParameter('refno');
					$check = false;
					$ref_no_present = $_SERVER['REQUEST_URI'];
					if (strpos($ref_no_present, 'refno') !== false) {
						$check = true;
					}
					
					if($check)
					{
						if(empty($flag))
						{?>
						  
		<div id="rn_EmailDialogTitle" class="rn_FloatLeft"></div>
		<div id="rn_ChatLaunchForm">
		<div class="container">
		<div class="row chat-agent">
		<div class="sliderform-wrap">
		<div class="chat-agent">
		<div class="col-md-5">
		<section class="contact-wrap">
		<div class="material-form form_fields prechatsurvey">
		<div id="rn_errorlocation_chat" style="display:none"></div>
			<div id="rn_EmailTitle" class="rn_FloatLeft">
			<? 
			   echo "Quelque chose a mal tourné. Veuillez réessayer.";
			 
			 ?> 
			</div>
				<script>
				document.getElementById("rn_ChatContainer").classList.add("new-style");
				</script>
		</div>
				
		</section>
		</div>
		</div>
		</div>
		</div>
		</div>				  
						  
						<?php }else{
					?>
		<!--<div id="rn_EmailDialogTitle" class="rn_FloatLeft">Votre document a été envoyé</div> -->
		<div id="rn_ChatLaunchForm">
		<div class="container">
		<div class="row chat-agent">
		<div class="sliderform-wrap">
		<div class="chat-agent">
		<div class="col-md-5">
		<section class="contact-wrap">
		<div class="material-form form_fields prechatsurvey">
		<div id="rn_errorlocation_chat" style="display:none"></div>
			<div id="rn_EmailTitle" class="rn_FloatLeft">
			Votre requête à bien été envoyée. Nous vous répondrons dans un délai d'un jour ouvrable. Numéro de référence: <?php echo $flag; ?> 
			</div>
				<script>
				document.getElementById("rn_ChatContainer").classList.add("new-style");
				</script>
		</div>
				
		</section>
		</div>
		</div>
		</div>
		</div>
		</div>
	
					
					<?
					 }
					} 
					else
					{
					?>
					
					
	    <input type="hidden" id="hidden-channel-value" value="0">
		
		
	    <form id="rn_ChatLaunchForm" method="post" action="">
		
		<div class="container">
		<div class="row chat-agent">
		<div class="sliderform-wrap">
		<div class="chat-agent">
		<div class="col-md-5">
		<section class="contact-wrap">
		<div class="material-form form_fields prechatsurvey">
		<div id="rn_errorlocation_chat" style="display:none"></div>
							
	    <? $catid= getUrlParm('catid');
		   $log = \RightNow\Utils\Config::getConfig(1000053);  //CUSTOM_CFG_ENABLE_LOG
		?>		
		
		<rn:condition logged_in="true">			
		
		<input type="hidden" name="loggedin" value="loggedin" id="checkloggedin">
		
		<?php 
			try {
		
		load_curl();
        
		//$this->session->getProfile()->email->value;
		//$url = $config_url."?email=".$this->session->getProfile()->email->value;
		//echo $this->session->getProfile()->c_id->value;
		
		$contact = get_instance()->model('Contact')->get()->result;
		$contact_role = $contact->CustomFields->c->member_type;
		$contact_rank = $contact->CustomFields->c->lifetime_rank;
		
		//echo $url;
        //$url = "https://apimdev.beachbody.com:8443/api/v1/idm/account/getCustomerRole?email=katottullux-3482@yopmail.com";
        
        /*$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contextId = json_decode(curl_exec($ch));
        
        curl_close($ch);
		
		//echo "<pre>";
		/*print_r($contextId);
		
		//echo "</pre>";
		echo $rank;
		echo "<br>";
		echo $contextId->GUID;
		echo "<br>";
		
		//$lifetimeid = 492;
		*/	
				
				$url = \RightNow\Utils\Config::getConfig(1000051);  //CUSTOM_CFG_GET_IDM_DETAILS
				  $apiUser          = \RightNow\Utils\Config::getConfig(1000030);		//CUSTOM_CFG_EBS_SYNC_USERID					
                $apiPassword      = \RightNow\Utils\Config::getConfig(1000031);     //CUSTOM_CFG_EBS_SYNC_PASSWORD  
				$payload= '{"searchFilterName": "email","searchFilterValue": '. $this->session->getProfile()->email->value .'}';
				/*'<?xml version="1.0" encoding="UTF-8"?>
				 <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:prox="http://proxy.beachbody.com/">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <prox:searchOIMIdentity>
						<search_identity_request><searchFilterName>email</searchFilterName>
						<searchFilterValue>'.$this->session->getProfile()->email->value .'</searchFilterValue>
						</search_identity_request>
					  </prox:searchOIMIdentity>
				   </soapenv:Body>
				</soapenv:Envelope>';*/
				 $ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
				//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				if (!empty($apiUser))
			{
				curl_setopt($ch, CURLOPT_USERPWD, $apiUser . ":" . $apiPassword);				
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			}
				$resp = json_decode(curl_exec($ch));
				if($log)
				{
				logmessage($resp);
				}
				if(curl_errno($ch)){
				throw new Exception(curl_error($ch));
				}
				 curl_close($ch);
				 //logmessage($resp);
				/* $p1 = xml_parser_create();
		
				xml_parse_into_struct($p1,$resp , $vals1, $index1);
				xml_parser_free($p1);
				foreach($vals1 as $val) {
					
					
					if($val['tag'] == "STATUS")
					{
						$oimstatus = $val['value'];
						
					}elseif($val['tag'] == "GUID")
					{
						$guid =  $val['value'];
					}elseif($val['tag'] == "GNCCOACHID")
					{
						$coachId =  $val['value'];
					}elseif($val['tag'] == "CUSTOMERTYPE")
					{
						$role =  $val['value'];
					}
					}*/
					if($log)
					{
					logmessage($resp->search_identity_response->searchUser->guid . 
					$resp->search_identity_response->searchUser->gncCoachID .
					$resp->search_identity_response->searchUser->customerType);
					}
					
					$guid = $resp->search_identity_response->searchUser->guid;
					$coachId=$resp->search_identity_response->searchUser->gncCoachID; 
					$role = $resp->search_identity_response->searchUser->customerType;
					
		if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false ) 
		$membertypeid = 388;
		elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
		$membertypeid = 398;
		else
		$membertypeid = 389;
					
					if(!empty($role))
					{
					  if($role != $contact_role)
						{
							//echo "update contact with role";
							$this->model('custom/bbresponsive')->update_contact_with_value_from_IDM($this->session->getProfile()->c_id->value,$role,"role");
							
						}
					}

					if (strpos($role, 'COACH' ) !== false)
					{   
						$rank_url = \RightNow\Utils\Config::getConfig(1000052);  //CUSTOM_CFG_GET_COACH_TEAM
						$rankurl = $rank_url."?coachid=".$coachId ."&guid=". $guid ;
												
								$ch = curl_init($rankurl);
								curl_setopt($ch, CURLOPT_TIMEOUT, 30);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_URL, $rankurl);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								$jsonresp = json_decode(curl_exec($ch));
								if($log)
								{
								logmessage($jsonresp);
								}
								$rank = $jsonresp->coachLifetimeRank;
								//logmessage("rank" . $rank );
								if(curl_errno($ch)){
								throw new Exception(curl_error($ch));
								}
								curl_close($ch);
				
						if(!empty($rank))
						{
						  if($rank != $contact_rank)
							{
								//echo "update contact with rank";
								$this->model('custom/bbresponsive')->update_contact_with_value_from_IDM($this->session->getProfile()->c_id->value,$rank,"rank");
								
							}
						}			
								
						
					}
					else
					{
						$rank = 1;
					}
					
					if(is_null($role) OR is_null($rank) )
					{
						throw new Exception("search failed");
					}
						
		if($rank == 1 || $rank == 5 || $rank == 10 || $rank == 15)
		$lifetimeid = 478;
		elseif($rank == 20 || $rank == 25 || $rank == 30 || $rank == 35)
		$lifetimeid = 1365;
		elseif($rank == 40 || $rank == 45 || $rank == 50 || $rank == 55 ||
			   $rank == 60 || $rank == 65 || $rank == 70 || $rank == 75 ||
			   $rank == 80 || $rank == 85 || $rank == 90)
		$lifetimeid = 492;
		
		}
		
		//catch exception
		catch(Exception $e) {
		 // echo 'Message: ' .$e->getMessage();
		 logmessage($e->getMessage());
		 
		 $contact = get_instance()->model('Contact')->get()->result;
		 
		 if(empty($role)) // 2nd api exception should not affect overriding the values set for 1st API result
		 {
			 if($contact->CustomFields->c->member_type)
			 {
				$role = $contact->CustomFields->c->member_type;
				if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false ) 
				$membertypeid = 388;
				elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
				$membertypeid = 398;
				else
				$membertypeid = 389;
				
			 }
			 else
			 {
				$membertypeid = 389;
			 }
		 
		 }
		 
		 if($membertypeid == 388)
		 {
			if($contact->CustomFields->c->lifetime_rank)
			{
				$rank = $contact->CustomFields->c->lifetime_rank;
				if($rank == 1 || $rank == 5 || $rank == 10 || $rank == 15)
				$lifetimeid = 478;
				elseif($rank == 20 || $rank == 25 || $rank == 30 || $rank == 35)
				$lifetimeid = 1365;
				elseif($rank == 40 || $rank == 45 || $rank == 50 || $rank == 55 ||
					   $rank == 60 || $rank == 65 || $rank == 70 || $rank == 75 ||
					   $rank == 80 || $rank == 85 || $rank == 90)
				$lifetimeid = 492;
			}
			
			else
			{
				$lifetimeid = 478;
			}
		 }
		 
		}
		
		
		?>
		<div id="rn_ChatDialogTitle" class="rn_FloatLeft" style="padding-bottom: 22px;"><?php echo "Bonjour ".$this->session->getProfile()->first_name->value.", Envoyer un Document" ?></div>
		 
	 	 <script>
		// document.getElementById("rn_ChatContainer").classList.add("fixed_height_login");
		 document.getElementById("rn_ChatContainer").classList.add("new-style");
		 </script>
		 
		<div id="guid" style="display:none">
		<rn:widget path="input/TextInput" name="Incident.c$guid"  label_input="Guid" 
		 default_value="#rn:php:$guid#"/>
		</div>
		
		<div id="verified" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/CustomSelectionInput" name="Incident.c$account_verified"  
		 label_input="Account Verified" default_value="1"/>
		</div>

		
		<div id="email" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="true" allow_external_login_updates="true"/>
		</div>
		
		<div id="email-details" style="display:none">
		
		<div id="first-name" style="display:block">
		<rn:widget path="input/TextInput" name="Contact.Name.First"  label_input="First" required="false" allow_external_login_updates="true"/>
		</div>
		
		<div id="last-name" style="display:block">
		<rn:widget path="input/TextInput" name="Contact.Name.Last"  label_input="Last" required="false" allow_external_login_updates="true"/>
		</div>
		
		</div>
		
		
		<div id="file-upload" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/CustomFileAttachmentUpload" label_input="Joindre des Documents" min_required_attachments="1"/>
		</div>
		
		
		<div id="hidden_category" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$free_text"  label_input="Entrez votre question ICI" 
		default_value="#rn:php:$catid#"/> 
		</div>
		
		<? if($catid == 2850): ?> 
		
		<div id="form_routing" class="form_routing" style="display:none">
		<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" 
		 default_value="1656">
		</div>
		
		<? endif; ?>
					
		<div id="lifetimerank_fb" class="life_time_rank_fb" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" 
		 default_value="#rn:php:$lifetimeid#">
		</div>
								
		<div id="submit-button" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/Submit" label_button="Envoyer" error_location="rn_errorlocation_chat" on_success_url='none'/>	
		</div>
		
		 </rn:condition>
							
		</div>
							
		</section>
		</div>
		</div>
		</div>
		</div>
		
		</div>
		
		<!-- <div class="col-md-4 col-md-offset-3 col-xs-12">
		 <div class="message-card">
		 <figure id="remove-callus-email">
		 <figcaption>
		
	
	
		 
		 <div id="rec_channel_details" style="display:block">				
		
			<rn:widget path="custom/ResponsiveDesign/ChannelDisplayPreChatSurvey" name="Incident.c$recommended_channel" 
			 label_input="Member Type" required="false" channel="1"/>
		 
		 </div>
		
		 
		 </figcaption>
		 </figure>
		 </div>
		 </div><!-- *****-->

		</form>
		<? } ?>
		</div>
		</div>
		</div>
		</div>
		
					
		

					
                
                    <div id="rn_InChatButtonContainer">
					<div class="print_button">
					<!--<rn:widget path="chat/ChatPrintButton" label_print="Print this chat" print_icon_path="/euf/assets/themes/responsive/images/print_chat_transcript.PNG"/>-->
					</div>
					
                    </div>
                    <!--<rn:widget path="chat/VirtualAssistantSimilarMatches"/>
                    <rn:widget path="chat/VirtualAssistantFeedback"/>-->
             
        <div id="rn_ChatFooter">
            <div class="rn_FloatRight">
                <!--<rn:widget path="utils/OracleLogo"/>-->
            </div>
        </div>
    
    <script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>

<script>
window.onload = function(e){ 
    $("#rn_ChatDialogContainer").removeClass("overlay");
}

</script>



</body>
</html>
