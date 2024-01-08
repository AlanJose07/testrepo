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
    <link href="/euf/assets/themes/standard/contact_us_phase2.css" rel="stylesheet">
    <rn:head_content/>
    <rn:widget path="utils/ClickjackPrevention"/>
    <rn:widget path="utils/AdvancedSecurityHeaders"/>
    <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
    <link href="/euf/assets/themes/responsive/css/prechatsurvey_dev.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Hotjar Tracking Code for faq.beachbody.com -->

<script>

    (function(h,o,t,j,a,r){

        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};

        h._hjSettings={hjid:977138,hjsv:6};

        a=o.getElementsByTagName('head')[0];

        r=o.createElement('script');r.async=1;

        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;

        a.appendChild(r);

    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');

</script>

<!-- Hotjar Tracking Code for faq.beachbody.com -->


	
</head>
<body class="yui-skin-sam yui3-skin-sam">
    <div id="rn_ChatContainer">
        <div id="rn_PageContent" class="rn_Live">
            <div class="rn_Padding">
                    <div id="rn_ChatDialogContainer" class="overlay">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitleLogo" class="rn_FloatLeft"><a href="/app/home"><img src=
						"/euf/assets/themes/responsive/images/logo.png"></a></div>
                     
                    </div>
				
				    <rn:condition logged_in="false">
					<div id="rn_ChatDialogTitle" class="rn_FloatLeft">Please enter your question below.<!--#rn:msg:CHAT_LBL#--></div>
					</rn:condition>
					
	    <input type="hidden" id="hidden-channel-value" value="0">
		
		<div style="visibility:hidden; position:absolute">
		<? $chat_platform = \RightNow\Utils\Config::getConfig(1000065); //CUSTOM_CFG_CHAT_PLATFORM 
   		   $chat_platform = trim($chat_platform);
		   if($chat_platform == 'Oracle' || $chat_platform == 'oracle' || $chat_platform == 'ORACLE'):
		?>
		   <form id="hidden_form" method="post" action="/app/chat/chat_landing" target="_blank">
		   <? endif; ?>	
						
						
		<!-- The below code is used to get the selected category and set it into a text input field and post to the chat landing page-->
						
		<? $selected_cat_id=getUrlParm("catid");
		   $top_parent = getUrlParm("TLP");
		   $top_parent = explode(".",$top_parent);
		   $top_parent_id = trim($top_parent[0]);
		   $product_array = $this->model('custom/bbresponsive')->UADMappingProduct($selected_cat_id);
		   $product = $product_array['Product'];  //real time call should be made to know the product mapping from the UAD mapping table
		   
		?>
		<? if($chat_platform == 'Oracle' || $chat_platform == 'oracle' || $chat_platform == 'ORACLE'): ?>
		<input type="text" name="selected_category" id="selected_category" value="<?= $selected_cat_id?>">
		<input type="text" name="top_parent" id="top_parent" value="<?= $top_parent_id?>">
		<input type="text" name="uad_mapping_product" id="uad_mapping_product" value="<?= $product?>">
						
		<!-- above is the explanation-->
						
						
		<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$recommended_channel" required="false" initial_focus="false"  	
		 label_input="Channel" default_value="1529"/>
		 
		 <rn:condition logged_in="true">
		 
		 <rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$account_verified" required="false" initial_focus="false" 
		 label_input="Account Verified" />
		 
		 <rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$guid" label_input="Guid" required="false"/>
		 
		 </rn:condition>
		 
		<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$member_type_new" required="false" initial_focus="false" 
		 label_input="Member Type" />
		 
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$coachcustomernumber" label_input="Coach ID" required="false"/>
		
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$last_four_ssn" 
		 label_input="Last 4 digits of Credit Card on file for BSF" required="false"/>
		 
		<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" required="false">
		
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$billing_zip_postal_code" label_input="Billing Zip Code" 
		 required="false"/>
		 
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="false" allow_external_login_updates="true"/>
		
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Name.First"  label_input="First" required="false" allow_external_login_updates="true"/>
		
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Name.Last"  label_input="Last" required="false" allow_external_login_updates="true"/>
		
		<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.Threads"  label_input="How can our agent help you today?" 
		 required="false"/> 

        <rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$language_shk" label_input="Preferred Response Language" 
		 default_value="1182" interface=1 required="false"/>	
		 
		 					
						
		</form>	
		<? endif; ?>
		</div>
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
				 
		
		<rn:condition logged_in="false">
		
		<input type="hidden" name="loggedin" value="" id="checkloggedin">
		
		<div id="membertype" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/MemberType" name="Incident.c$member_type_new" label_input="Member Type" required="true"/>
		</div>
		
		<div id="bsf" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$last_four_ssn" label_input="Last 4 digits of Credit Card on file for BSF"         required="true"/>
		</div>
		
		<div id="lifetimerank" class="life_time_rank" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" required="true">
		</div>
				
		<div id="zipcode" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$billing_zip_postal_code" label_input="Billing Zip Code" required="true"/>
		</div>
		
		<div id="email" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="true" allow_external_login_updates="true"/>
		</div>
		
		<div id="email-details" style="display:none">
		
		<div id="first-name" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.First"  label_input="First" required="true" allow_external_login_updates="true"/>
		</div>
		
		<div id="last-name" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.Last"  label_input="Last" required="true" allow_external_login_updates="true"/>
		</div>
		
		</div>
		
		<div id="agent-help" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.Threads"  label_input="How can our agent help you today?" required="true"/>
		</div>
		
		<div id="hidden_category" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$free_text"  label_input="How can our agent help you today?" 
		default_value="#rn:php:$catid#"/> 
		<? if($chat_platform <> 'Oracle' && $chat_platform <> 'oracle' && $chat_platform <> 'ORACLE'): ?>
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$coachcustomernumber"  label_input="Product" 
		default_value="#rn:php:$product#"/> 
		<rn:widget path="input/SelectionInput" name="Incident.c$contact_channel" label_input="Contact Channel" 
		default_value="1476" required="false"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" 
		default_value="1708" required="false"/>
		<? endif; ?>
		<rn:widget path="input/SelectionInput" name="Incident.c$recommended_channel" label_input="Recommended Channel" 
		 default_value="1529" required="false"/>
		</div>
				
		<div id="language-permanent-hide" style="display:none">
		
		<div id="language" class="life_time_rank" style="display:none">
	    <rn:widget path="custom/ResponsiveDesign/Language" name="Incident.c$language_shk" label_input="Preferred Response Language" 
		 default_value="1182" interface=1 required="true"/>
		</div>
		
		</div>
							
		<div id="submit-button" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/Submit" error_location="rn_errorlocation_chat" on_success_url='none'/>	
		</div>
		
		<div id="popup-message-guest"  style="text-align: center;display: none;">
			<p>	
				If your chat doesn’t start automatically, please make sure pop-up are allowed for this website.
			</p>
		</div>
		
		
		
		<rn:condition_else/>
		
		
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
		
		//$this->session->getProfile()->email->value	
		//$email = "kate_coach@yopmail.com";
		$url = \RightNow\Utils\Config::getConfig(1000069);  //CUSTOM_CFG_GET_AWS_IDM_DETAILS
		$key = \RightNow\Utils\Config::getConfig(1000068);	//CUSTOM_CFG_AWS_API_KEY  
		$payload= '{"searchFilterName": "email","searchFilterValue": "'. $this->session->getProfile()->email->value .'"}';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
											'api-key: AGENT:US:1234',
											'x-api-key: '.$key,
											'Content-Type: application/json'));
		//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resp = json_decode(curl_exec($ch));
		//echo "<pre>";
		//print_r($resp);
		if($log)
		{
			logmessage($resp);
		}
		if(curl_errno($ch)){
		throw new Exception(curl_error($ch));
		}
		 curl_close($ch);
			if($log)
			{
			logmessage($resp->searchUser->guid . 
			$resp->searchUser->gncCoachID .
			$resp->searchUser->customerType);
			}
			
			logmessage("GUID:".$resp->searchUser->guid . 
			"CoachID:".$resp->searchUser->gncCoachID ."CType:".
			$resp->searchUser->customerType);
			
			$guid = $resp->searchUser->guid;
			$coachId=$resp->searchUser->gncCoachID; 
			$role = $resp->searchUser->customerType;
					
		if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false || strpos( $role, 'PARTNER' ) !== false || strpos( $role, 'Partner' ) !== false || strpos( $role, 'partner' ) !== false ) 
		$membertypeid = 388;
		elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
		$membertypeid = 398;
		elseif(strpos( $role, 'PC' ) !== false)
        $membertypeid = 1725;
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

					if (strpos($role, 'COACH' ) !== false || strpos($role, 'PARTNER' ) !== false)
					{   
						$rank_url = \RightNow\Utils\Config::getConfig(1000052);  //CUSTOM_CFG_GET_COACH_TEAM
						$rankurl = $rank_url."?coachid=".$coachId ."&guid=". $guid ;
												
								$ch = curl_init($rankurl);
								curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:1234',
													'x-api-key: '.$key,
													'Content-Type: application/json',
													'id_token: 1234',
													'access_token: 1234'));
								curl_setopt($ch, CURLOPT_TIMEOUT, 30);
								curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_URL, $rankurl);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								$jsonresp = json_decode(curl_exec($ch));
								logmessage("coachteam");
								logmessage($jsonresp);
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
				if( strpos( $role, 'COACH' ) !== false || strpos( $role, 'Coach' ) !== false || strpos( $role, 'coach' ) !== false || strpos( $role, 'partner' ) !== false || strpos( $role, 'Partner' ) !== false || strpos( $role, 'PARTNER' ) !== false ) 
				$membertypeid = 388;
				elseif(strpos( $role, 'BBLIVE' ) !== false || strpos( $role, 'Beachbody LIVE! Instructor' ) !== false || strpos( $role, 'BEACHBODY LIVE! INSTRUCTOR' ) !== false || strpos( $role, 'BEACHBODYLIVE' ) !== false)
				$membertypeid = 398;
				elseif(strpos( $role, 'PC' ) !== false)
                $membertypeid = 1725;
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
		<div id="rn_ChatDialogTitle" class="rn_FloatLeft"><?php echo "Hi ".$this->session->getProfile()->first_name->value.", how can we help you 	 
		 today?" ?></div>
		 
	 	 <script>
		// document.getElementById("rn_ChatContainer").classList.add("fixed_height_login");
		 document.getElementById("rn_ChatContainer").classList.add("new-style");
		 </script>
		 
	   	<div id="membertype" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/MemberType" name="Incident.c$member_type_new" label_input="Member Type" required="true"         default_value="#rn:php:$membertypeid#"/>
		</div>
		
		
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
		
		<?php if ($this->session->getProfile()->first_name->value !=""){ ?>
		<div id="first-name" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.First"  label_input="First" required="true" allow_external_login_updates="true"/>
		</div>
		<?php } ?>
		<?php if ($this->session->getProfile()->last_name->value !=""){ ?>
		<div id="last-name" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.Last"  label_input="Last" required="true" allow_external_login_updates="true"/>
		</div>
		<?php } ?>
		</div>
		
		<div id="agent-help" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.Threads"  label_input="How can our agent help you today?" required="true"/>
		</div>
		
		<div id="hidden_category" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$free_text"  label_input="How can our agent help you today?" 
		default_value="#rn:php:$catid#"/> 
		<? if($chat_platform <> 'Oracle' && $chat_platform <> 'oracle' && $chat_platform <> 'ORACLE'): ?>
		<!--coachcustomernumber field is not used to store this value. This is exchanged in bbresponsivecontroller to set it to 
			prodcut field. Why i have to use this is that since product doesnt have visibility on, we cannot set it using the
			standard product category widget. Its difficult to turn on the visibility since there are a lot of products. -->
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$coachcustomernumber"  label_input="Product" 
		default_value="#rn:php:$product#"/> 
		<rn:widget path="input/SelectionInput" name="Incident.c$contact_channel" label_input="Contact Channel" 
		default_value="1476" required="false"/>
		<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" 
		default_value="1708" required="false"/>
		<? endif; ?>
		<rn:widget path="input/SelectionInput" name="Incident.c$recommended_channel" label_input="Recommended Channel" default_value="1529" required="false"/>
		</div>
				
		<div id="language-permanent-hide" style="display:none">
		
		<div id="language" class="life_time_rank" style="display:none">
	    <rn:widget path="custom/ResponsiveDesign/Language" name="Incident.c$language_shk" label_input="Preferred Response Language" 
		 default_value="1182" interface=1 required="true"/>
		</div>
		
		</div>
		
		<? if($membertypeid == 388): ?> 
		<div id="lifetimerank" class="life_time_rank" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" 
		 default_value="#rn:php:$lifetimeid#">
		</div>
		
		<? endif; ?>
							
		<div id="submit-button" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/Submit" error_location="rn_errorlocation_chat" on_success_url='none'/>	
		</div>
		
		<div id="popup-message-loggedin"  style="text-align: center;display: none;">
			<p>	
				If your chat doesn’t start automatically, please make sure pop-up are allowed for this website.
			</p>
		</div>
		
		
		
	    </rn:condition>
		
		

							
		</div>
							
		</section>
		</div>
		</div>
		</div>
		</div>
		
		</div>
		
		 <div class="col-md-4 col-md-offset-3 col-xs-12">
		 <div class="message-card">
		 <figure id="remove-callus-email">
		 <figcaption>
		 <div id="regular-chat-hours" style="display:none">
		 <rn:widget path="chat/ChatStatus" />
		 <rn:widget path="chat/ChatHours" label_chat_hours ="Customer Support"/>
	     </div>
	
		 <div id="spanish-chat-hours" style="display:none">
		 <rn:widget path="custom/ResponsiveDesign/SpanishChatHour" label_chat_hours ="Chat en Español" />  
		 </div>
		
		 <div id="diamond-chat-hours" style="display:block">
		 <div id="bblive-chat-status" style="display:none">
		 <rn:widget path="chat/ChatStatus" />
		 </div>
		 <rn:widget path="custom/ResponsiveDesign/DiamondChatHour" label_chat_hours ="Diamond Line" />  
		 </div>
		 
		 <div id="bblive-chat-hours" style="display:none">
		 <rn:widget path="chat/ChatStatus" />
		 <rn:widget path="custom/ResponsiveDesign/BbliveChatHour" label_chat_hours ="Beachbody LIVE! Instructor Chat hours are listed below." />  
		 </div>
		 
		 <div id="rec_channel_details" style="display:none">				
		
			<rn:widget path="custom/ResponsiveDesign/ChannelDisplayPreChatSurvey" name="Incident.c$recommended_channel" 
			 label_input="Member Type" required="false" channel="2"/>
		 
		 </div>
		
		 
		 </figcaption>
		 </figure>
		 </div>
		 </div><!-- *****-->

		</form>
		
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
    $(document).ready(function() {

        window.setInterval(function(){
            $(".mat-input").focus(function(){
              $(this).parent().addClass("is-active is-completed");
            });

            $(".mat-input").focusout(function(){
              if($(this).val() === "" && !$(this).attr("placeholder"))
                $(this).parent().removeClass("is-completed");
              $(this).parent().removeClass("is-active");
            })
            
        }, 1000);
    });
</script>
<script>
window.onload = function(e){ 
    $("#rn_ChatDialogContainer").removeClass("overlay");
}

</script>
</body>
</html>
