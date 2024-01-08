<?
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])){
	$unsupported_browser = "/app/unsupported_browser";
	header('Location: ' . $unsupported_browser);
  }
?> 
<?
  $tlp =  getUrlParm('TLP');

  list($tlp, $name) = explode('.', $tlp);
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
    <link href="/euf/assets/themes/responsive/css/prechatsurvey_site.css" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Hotjar Tracking Code for faq.beachbody.com -->
	<style>
.pointer {cursor: pointer;}	
.noClick {
   pointer-events: none;
}
a.disable-click{
  /* pointer-events: none; */
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin-left: 20%;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 20px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.bb_logo {
	padding: 0 15px 15px 15px;
	border-bottom: 1px solid #e5e5e5;
	text-align:center;
	margin: 0 -15px 0 -15px;
}
#headingOrder, #heading {
	padding: 15px 0;
	text-align: center;
	font-size: 20pt;
	font-weight: 300;
	font-family: 'Proxima Nova Lt';
}

.info-text p {
	text-align: center;
	color: #222;
	margin: 0 0 17px 0 !important;
	font-size: 11pt;
	padding:0
}

</style>
	
</head>
<body class="yui-skin-sam yui3-skin-sam">
    <div id="rn_ChatContainer">
			<!--		<script>
					document.getElementById("rn_ChatContainer").classList.add("new-style");
					</script>-->
        <div id="rn_PageContent" class="rn_Live">
            <div class="rn_Padding">
                    <div id="rn_ChatDialogContainer" class="overlay">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitleLogo" class="rn_FloatLeft"><a href="/app/home"><img src=
						"/euf/assets/themes/responsive/images/logo.png"></a></div>
                     
                    </div>
				
				    <rn:condition logged_in="false">
					<div id="rn_SmsTitle" class="rn_FloatLeft">Please sign-in to proceed with call me now feature.</div>
					</rn:condition>
					 
					<?php 
					$CI = &get_instance();
					$flag = \RightNow\Utils\Url::getParameter('ref_no');
					
					if($flag)
					{
						if($CI->session->getSessionData('httpcode')!=200 && $CI->session->getSessionData('httpcode')!="")
						{?>
						  
		<div id="rn_SmsDialogTitle" class="rn_FloatLeft"></div>
		<div id="rn_ChatLaunchForm">
		<div class="container">
		<div class="row chat-agent">
		<div class="sliderform-wrap">
		<div class="chat-agent">
		<div class="col-md-5">
		<section class="contact-wrap">
		<div class="material-form form_fields prechatsurvey">
		<div id="rn_errorlocation_chat" style="display:none"></div>
			<div id="rn_SmsTitle" class="rn_FloatLeft">
			<? if($CI->session->getSessionData('errormessage'))
			   echo $CI->session->getSessionData('errormessage');
			   else
			   echo "Something went wrong. Please try again.";
			   $error = array("errormessage"=>"","httpcode"=>"");
			   $CI->session->setSessionData($error);
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
						  
						<?php }
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
		   $extension = \RightNow\Utils\Config::getConfig(1000055);  //CUSTOM_CFG_PHONE_COUNTRY_CODE
		   $log = \RightNow\Utils\Config::getConfig(1000053);  //CUSTOM_CFG_ENABLE_LOG
		   $prodval = getUrlParm('TLP');
		   $prodsp = explode('.', $prodval);
		   $prod=$prodsp[0];
           $CI = &get_instance();
           $c_id = $CI->session->getProfileData('c_id');?>
		   <rn:condition logged_in="true">
         <?  $homephone_1 = $this->model('custom/bbresponsive')->contact_homeph_fetch($c_id); 
		   //$contact = get_instance()->model('Contact')->get()->result;
		 //  $homephone_1 = $contact->Phones[1]->Number; 

		   $homephone_2 = preg_replace('/[^0-9]/s','',$homephone_1);
         if (substr($homephone_2, 0, strlen($extension)) == $extension) {
            $homephone = substr($homephone_2, strlen($extension));
        }else {
			$homephone = $homephone_2;
		} ?>
		</rn:condition>

  <? /*     print_r("cont");

        print_r($c_id);
        print_r("phwithCode");

        print_r($homephone_1);
		print_r("phwithoutCode");

          print_r($homephone);*/

		?>					
		
		<rn:condition logged_in="true">

		
				<input type="hidden" name="loggedin" value="loggedin" id="checkloggedin">
				
				<div id="rn_SmsTitle" class="rn_FloatLeft"><?php echo "Hi ".$this->session->getProfile()->first_name->value.", please confirm your number to get started." ?></div>
				 
				 <script>
				// document.getElementById("rn_ChatContainer").classList.add("fixed_height_login");
				 document.getElementById("rn_ChatContainer").classList.add("new-style");
				 </script>
				 			
				
				<div id="verified" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/CustomSelectionInput" name="Incident.c$account_verified"  
				 label_input="Account Verified" default_value="1"/>
				</div>

				
				<div id="email" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="true" allow_external_login_updates="true"/>
				</div>
				
				<div id="email-details" style="display:none">
				
				<?php if ($this->session->getProfile()->first_name->value !=""){ ?>
				<div id="first-name" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.First"  label_input="First name" required="true" allow_external_login_updates="true"/>
				</div>
				<?php } ?>
				<?php if ($this->session->getProfile()->last_name->value !=""){ ?>
				<div id="last-name" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.Last"  label_input="Last name" required="true" allow_external_login_updates="true"/>
				</div>
				<?php } ?>
				</div>
				
				
				<div id ="countryextension">
				<input type="text" name="extension" value='<?php echo $extension; ?>' id="extension" readonly="true">
				</div>
				<div id="phone" class="is-completed" style="display:block;position:sticky !important;">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$billing_zip_postal_code"  label_input="Phone number" required="false" allow_external_login_updates="true" default_value="#rn:php:$homephone#"/>
                
				</div>
				
			<!--<div id="agent-help" style="display:block">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.Threads"  label_input="How can our agent help you today?" required="true"/>
				</div>-->
				
				
				
				<div id="hidden_category" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$free_text"  label_input="" default_value="#rn:php:$catid#"/> 

				<div id="agent-help" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$coachcustomernumber"  label_input="" default_value="#rn:php:$prod#"/>
				</div>

				</div>
				
				<div id="facebook-routing" class="facebook-routing" style="display:none">
				<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" default_value="1960" label_input="">
				</div>
				
				<div id="contactchannel-routing" class="contactchannel-routing" style="display:none">
				<rn:widget path="input/SelectionInput" name="Incident.c$contact_channel" default_value="1474" label_input="">
				</div>

				<? if($tlp == 3784): ?> 
				<div id="queue-routing" class="queue-routing" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.Queue" label_input="" 
				 default_value="374">
				</div>				
				<? endif; ?>

				<? if($tlp != 3784): ?> 
				<div id="queue-routing" class="queue-routing" style="display:none">
				<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.Queue" label_input="" 
				 default_value="282">
				</div>				
				<? endif; ?>

				<div id="sms-rates" style="text-align:left !important;">
				
				Your account is now verified and your selections will be used to serve you faster. Click “Call Me” and the next available agent will assist you.

				
				</div>
									
				<div id="submit-button" style="display:block">
				<rn:widget path="custom/ResponsiveDesign/Submit" label_button="CALL ME" error_location="rn_errorlocation_chat" on_success_url='/app/home'/>	
				</div>
				<div id="sms-rates" style="text-align:left !important;padding-bottom:30px !important;">
				
				Please make sure your phone settings allow unknown callers.

				
				</div>	
		
			<div style="font-size:15px !important;color:#1378DD;text-align:center;">
				<p id="myPopup" class="pointer">General Phone Number</p>	
			</div> 

	    </rn:condition>
		

							
		</div>
							
		</section>
		</div>
		</div>
		</div>
		</div>
		
		</div>
		 
		 </form>
		
		
		<? } ?>

		</div>

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
 <!--Call me now start-->
<!-- The Modal -->
<div id="myModal" class="modal View_Modal pop-modal messagepopupclose"> 

<!-- Modal content -->
<div class="modal-content Bb_modal">
	<div class="model-inner">
  <span class="close" id="orderClose1" >x</span>
   <div class="bb_logo" ><img class="img-responsive" style="max-width:90%;" src="/euf/assets/images/beachbody_logo_site.png"></div>
  <div id="headingOrder"></div>    
  
   <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
   <p style="font-size: 16px;text-align:left;">
   We recommend using "Call Me" for faster support. An agent will be able to assist you based on the selections you provided.
   </p>
   <p style="font-size: 16px;text-align:left;">
   If you prefer to call Beachbody Support, please be aware that you will be asked a series of questions to verify your identity as well as go through our menu options.
   </p>
   <p style="font-size: 16px;text-align:left;">
   <a href="tel:8667379407">866-737-9407</a>
   </p>
  </div>
  </div>
</div>


</div>
<!--Call me now end-->   
    <script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
    <script>
    $(document).ready(function() {

        window.setInterval(function(){
            $(".mat-input").focus(function(){ 
              $(this).parent().addClass("is-active is-completed");
            });

            $(".mat-input").focusout(function(){ 
              if($(this).val() === "")
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

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myPopup");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


</script>
</body>
</html>
