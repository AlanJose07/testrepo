<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard_responsive_bb.php" clickstream="home"/>

<!---for ask an expert-->
<script src="/euf/assets/js/modernizr-2.8.3.min.js"></script>
<!--<link rel="stylesheet" href="css/main.css">-->
<!---for ask an expert-->

<!---very importan styles-->
<style>
.rn_MaskOverlay,.rn_Mask {
    display: none;
}
.readonlybody{
pointer-events: none;
}
</style>
<!---very importan styles-->

<?
  
  $catid = getUrlParm('catid');
  $a_id = getUrlParm('a_id');
  
  if($a_id != 0)
  {
  $remove_bookmarked_url = $this->model('custom/bbresponsive')->remove_bookmarked_url($catid,"contactus_support");
 // print_r($remove_bookmarked_url);
 // die();
  	if($a_id != $remove_bookmarked_url['answer_report_id'])
		{
		$url = "/app/pagenotfound";
 		header('Location: ' . $url);
		}
  }
?>
<div class="content-wrapper">

<div id="primary-categories" class="container primary_cat">
  <div class="col">
    <div class="get_help all_chat_fields"> 
<rn:widget path="custom/ResponsiveDesign/ChannelDisplayAnswer" />	

<input type="hidden" id="hidden-channel-value" value="0">
<form id="rn_ChatLaunchForm" method="post" action="">

        <div id="rec_channel_details">
		<rn:widget path="custom/ResponsiveDesign/ChannelDisplay" name="Incident.c$recommended_channel" label_input="Member Type" required="false"/>
		</div>
		
		<div class="overlay-form" id="self-service">
		 <div class="slideUpForm" id="self-service-form">
		 <div class="slide-form-head">
		 
		 <h1 id="chat-title" style="display:none">Chat with an agent</h1>  
		 <h1 id="phone-title" style="display:none">Call Support</h1>
		 <h1 id="email-title" style="display:none">Email Us</h1>
		 <h1 id="email-conf-title" style="display:none">Email Confirmation</h1>
		 <h1 id="facebook-title" style="display:none">Facebook Messenger</h1>
		 
		 <span class="close-reccomend" onclick="redirect_from_email()">X</span> </div>
		<div class="container">
		<div class="row chat-agent">
		<div class="sliderform-wrap">
		<div class="chat-agent">
		 <div class="col-md-5">
		<section class="contact-wrap">
		<div class="material-form form_fields">
		<div id="rn_errorlocation_chat" style="display:none"></div>
		
		
		<div id="membertype" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/MemberType" name="Incident.c$member_type_new" label_input="Member Type" required="true"/>
		</div>
		
		<div id="hide-for-email-confirm-popup" style="display:block">
		<div id="box-style-email">
		
		<div id="email" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email Address" required="true" allow_external_login_updates="true"/>
		</div>
		<div id="email-details" style="display:none">
		<div id="first-name" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.First"  label_input="First" required="true" allow_external_login_updates="true"/>
		</div>
		
		<div id="last-name" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Contact.Name.Last"  label_input="Last" required="true" allow_external_login_updates="true"/>
		</div>
		</div>
		
		<div id="zipcode" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$billing_zip_postal_code" label_input="Billing Zip Code" required="true"/>
		</div>

		<div id="description" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.Threads"  label_input="Description" required="true"/> 
		</div>

		<div id="order-no" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$orderno"  label_input="Order #" /> 
		</div>
        <!--
		<div id="bike-serial" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$bike_serial_number"  label_input="Bike Serial #" /> 
		</div>

		<div id="tablet-id" style="display:block">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$tablet_serial"  label_input="Tablet Serial #" /> 
		</div>-->
		
		<div id="hidden_category" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/TextInput" name="Incident.c$free_text"  label_input="How can our agent help you today?"  default_value="#rn:php:$catid#"/> 
		</div>
		
		
		<div id="file-upload" style="display:none">
		
		
		<rn:widget path="custom/ResponsiveDesign/CustomFileAttachmentUpload"/>
		</div>
		
		<div id="facebook-routing" class="facebook-routing" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/SelectionInput" name="Incident.c$form_routing" label_input="">
		<rn:widget path="input/TextInput"  name="Incident.Subject" required="false" default_value="Your Ladder Support Request"/>
		</div>
		
		</div>
		
		<div id="submit-button" style="display:none">
		<rn:widget path="custom/ResponsiveDesign/Submit" error_location="rn_errorlocation_chat" on_success_url='none'/>	
		</div>
		      
		<div id="spanish-message-outbound-time" style="display:none">
		La opción de chat en Español, no está disponible en estos momentos. Por favor, intente de nuevo durante los horarios de chat en Español listados a continuación, o seleccione la opción en Inglés (English), para recibir soporte ahora mismo.
		</div> 
		
		<div id="spanish-message-chat-not-available" style="display:none">
		La opción de chat en Español, no está disponible en estos momentos. Por favor intente de nuevo más tarde, o seleccione la opción en Inglés (English) para recibir soporte ahora mismo.
		</div>
		
		</div><!--hide-for-email-confirm-popup--> 
	
		</div>
		</section>
		</div> <!-- *****-->
		
		
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
		
		 <div id="diamond-chat-hours" style="display:none">
		 <div id="bblive-chat-status" style="display:none">
		 <rn:widget path="chat/ChatStatus" />
		 </div>
		 <rn:widget path="custom/ResponsiveDesign/DiamondChatHour" label_chat_hours ="Diamond Line" />  
		 </div>
		 
		 <div id="bblive-chat-hours" style="display:none">
		 <rn:widget path="chat/ChatStatus" />
		 <rn:widget path="custom/ResponsiveDesign/BbliveChatHour" label_chat_hours ="Beachbody LIVE! Instructor Chat hours are listed below." />  
		 </div>
		 
		 </figcaption>
		 </figure>
		 </div>
		 </div><!-- *****-->


</div>
</div>	
</div>

<div id="after-submit-email" style="display:none"></div>

<div id="phone-us" style="display:none">
<rn:widget path="custom/ResponsiveDesign/PhoneHourDetails" interface=1/>
</div>

</div>	
</div>
</div>		
		 
</form>

<div id="ask-an-expert-show" style="display:none">




<div class="overlay-form" id="ask-expert">
<div class="slideUpForm" id="ask-expert-form">
<div class="slide-form-head">
<h1 id="ask-title" style="display:none">Ask an Expert</h1>
<span class="close-reccomend" onclick="redirect_from_email()">X</span> </div>
<div class="container">
<div class="row chat-agent">
<div class="sliderform-wrap">
<div class="chat-agent">
<div class="col-md-5">
<section class="contact-wrap">

<!---->

<div class="material-form ask-an-expert-div js-wrapper">
                          
   <div id="rn_ErrorLocation_directly" style="display:none" ></div>
      <form id="expertForm" class="contactForm" method="post" action="javascript:;">   

		<div id="div_ask_text">
		Ask an expert for help with general questions. Experts are fellow
		customers, hand-picked based on their knowledge and experience.<br /><br />
		For assistance with your order or account, please chat with an agent.
		</div>	  
               
		<div id="ask_error" style="color:#CC0000; font-size:13px; padding-bottom:10px;"></div>
		
		<div class="input-block floating-field contactForm__inputGroup">
		<label class="contactForm__label" for="directlyChannelName">First Name<span class="rn_Required"> *</span></label>
		<input type="text" id="directlyChannelFirstName" class="form-control contactForm__input js-contact-input">
		</div>
					
		<div class="input-block floating-field contactForm__inputGroup">
		<label class="contactForm__label" for="directlyChannelName">Last Name<span class="rn_Required"> *</span></label>
		<input type="text"  id="directlyChannelLastName" class="form-control contactForm__input js-contact-input">
		</div>
					
		<div class="input-block floating-field contactForm__inputGroup">
		<label class="contactForm__label" for="directlyChannelEmail">Email Address <span class="rn_Required"> *</span></label>
		<input type="email" id="directlyChannelEmail" class="form-control contactForm__input js-contact-input">
		</div>
					
		<div class="input-block floating-field textarea contactForm__inputGroup">
		<label class="contactForm__label" for="directlyChannelQuestion">Your Question<span class="rn_Required"> *</span></label>
		<textarea rows="5" id="directlyChannelQuestion" class="form-control contactForm__textarea js-contact-input"></textarea>
		</div>
		
		<p class="contactForm__submitGroup">
			<button class="btn square-button material-btn button" type="submit" onclick="ask_validation();">Ask an expert</button>
		</p>
				
		</form>
 </div>
				  
 <!---->

</section>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div><!-- ask an expert -->
                                                                                                            
</div>
</div>
</div>
</div>
	
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<script src="/euf/assets/themes/responsive/js/recommendedchannel.js"></script>	

<!-- ask an expert-->

<script>

function redirect_from_email()
{

     if(document.getElementById("hidden-channel-value").value=="redirect_from_email")
	 {
	 $('body').removeClass("hide-scroll");
	 window.location="/app/home";
	 var a = document.body;
     a.classList.add("readonlybody");
	 }
	 else if(document.getElementById("hidden-channel-value").value=="hide-show-scroll-expert")
	 {
	   $('body').removeClass("hide-scroll");
	 }
	 else
	 {
	  $('body').removeClass("hide-scroll");
	 }
	 
	 $("body").removeClass("v-scroll-hide").addClass("v-scroll");
}


 function setFocus(fieldFocus)
 {

	 if(fieldFocus==1){
		document.getElementById("directlyChannelName").focus();
	 }
	  if(fieldFocus==2){
		document.getElementById("directlyChannelEmail").focus();
	 }
	  if(fieldFocus==3){
		document.getElementById("directlyChannelQuestion").focus();
	 }
	 if(fieldFocus==4){
		document.getElementById("directlyChannelFirstName").focus();
	 }
	 if(fieldFocus==5){
		document.getElementById("directlyChannelLastName").focus();
	 }
 
 }
 
function ask_validation()
{
	
	//ask an expert form validation
	

	document.getElementById("rn_ErrorLocation_directly").innerHTML = "";
	
	//================ask error yellow================
	if(document.getElementById("directlyChannelEmail"))
	{
		var errdirectlyChannelEmail = document.getElementById("directlyChannelEmail");
		errdirectlyChannelEmail.classList.remove("rn_ErrorField");
	}
	
	if(document.getElementById("directlyChannelQuestion"))
	{
		var errdirectlyChannelQuestion = document.getElementById("directlyChannelQuestion");
		errdirectlyChannelQuestion.classList.remove("rn_ErrorField");
	}
	
	if(document.getElementById("directlyChannelFirstName"))
	{
		var errdirectlyChannelFirstName = document.getElementById("directlyChannelFirstName");
		errdirectlyChannelFirstName.classList.remove("rn_ErrorField");
	}
	
	if(document.getElementById("directlyChannelLastName"))
	{
		var errdirectlyChannelLastName = document.getElementById("directlyChannelLastName");
		errdirectlyChannelLastName.classList.remove("rn_ErrorField");
	}
						
	
	//================ask error yellow================
	
	//var name;
	var email;
	var question;
	var firstname;
	var lastname;
	
	
	if(document.getElementById("directlyChannelEmail"))
	{
		email = document.getElementById("directlyChannelEmail").value;
	}
	if(document.getElementById("directlyChannelQuestion"))
	{
		question = document.getElementById("directlyChannelQuestion").value;
	}
	if(document.getElementById("directlyChannelFirstName"))
	{
		firstname = document.getElementById("directlyChannelFirstName").value;
	}
	if(document.getElementById("directlyChannelLastName"))
	{
		lastname = document.getElementById("directlyChannelLastName").value;
	}
	
			
		if(firstname == "")
		{
			document.getElementById("rn_ErrorLocation_directly").innerHTML +="<div onclick='setFocus(4)'><a style='cursor:pointer'><b>First Name is required"+"</b></a></div>";
			
			//var askError = document.getElementById("rn_ErrorLocation_directly");
			//askError.className += "rn_MessageBox rn_ErrorMessage";
			
			document.getElementById("directlyChannelFirstName").className+=" rn_ErrorField";
			
		}
		if(lastname == "")
		{
			document.getElementById("rn_ErrorLocation_directly").innerHTML +="<div onclick='setFocus(5)'><a style='cursor:pointer'><b>Last Name is required"+"</b></a></div>";
			
			//var askError = document.getElementById("rn_ErrorLocation_directly");
			//askError.className += "rn_MessageBox rn_ErrorMessage";
			
			document.getElementById("directlyChannelLastName").className+=" rn_ErrorField";
		}
		
		if(email == "")
		{
			
			document.getElementById("rn_ErrorLocation_directly").innerHTML +="<div onclick='setFocus(2)'><a style='cursor:pointer'><b>Email Address is required"+"</b></a></div>";
			
			//var askError = document.getElementById("rn_ErrorLocation_directly");
			//askError.className += "rn_MessageBox rn_ErrorMessage";
			
			document.getElementById("directlyChannelEmail").className+=" rn_ErrorField"; 
			
		} 
		
		if(email!= "")
		{
			var atpos = email.indexOf("@");
			var dotpos = email.lastIndexOf(".");
			var invalidEmail='NO';
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) 
			{
				
				
				document.getElementById("rn_ErrorLocation_directly").innerHTML +="<div onclick='setFocus(2)'><a style='cursor:pointer'><b>Email Address is invalid"+"</b></a></div>";
			
				//var askError = document.getElementById("rn_ErrorLocation_directly");
				//askError.className += "rn_MessageBox rn_ErrorMessage";

				invalidEmail='YES';
				
				document.getElementById("directlyChannelEmail").className+=" rn_ErrorField"; 
			} 
		}	
		
		
		if(question == "")
		{
			
			document.getElementById("rn_ErrorLocation_directly").innerHTML +="<div onclick='setFocus(3)'><a style='cursor:pointer'><b>Question is required"+"</b></a></div>";
			
			//var askError = document.getElementById("rn_ErrorLocation_directly");
			//askError.className += "rn_MessageBox rn_ErrorMessage";
			
			document.getElementById("directlyChannelQuestion").className+=" rn_ErrorField";
			
		}
		
		if(email=="" || question=="" || firstname=="" || lastname=="" || invalidEmail=='YES' )
		{
		   document.getElementById("rn_ErrorLocation_directly").style.display = "block";
	  
		   var hasclass1=document.getElementById("rn_ErrorLocation_directly").classList.contains('rn_MessageBox');
		   var hasclass2=document.getElementById("rn_ErrorLocation_directly").classList.contains('rn_ErrorMessage');
		   if(hasclass1==false && hasclass2==false)
		   {
		   var error_display_ask=document.getElementById("rn_ErrorLocation_directly");
		   error_display_ask.className += "rn_MessageBox rn_ErrorMessage";
		   }
			//window.scroll(0,0);
			
		}
		else
		{
		    
			document.getElementById("rn_ErrorLocation_directly").style.display = "none";
			
			//document.getElementById("directly").style.display = "block";
		}
	
}
</script>
<script src="/euf/assets/js/plugins.js"></script>
<script src="/euf/assets/themes/responsive/js/main.js"></script>


  <!--Google Analytics: change UA-XXXXX-X to be your site's ID.-->
     <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];

            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>


 <script>
            (function(d, i, r, e, c, t, l, y) {
                i[r] = i[r] || function() {
                    (i[r].cq = i[r].cq || []).push(arguments)
                };
                l = d.createElement(c);
                l.id = "directlyRTMScript";
                l.src = e;
                l.async = 1;
                y = d.getElementsByTagName(c)[0];
                d.addEventListener(t, function() {
                    y.parentNode.insertBefore(l, y);
                });
            })(document, window, "DirectlyRTM", "https://www.directly.com/widgets/rtm/embed.js", "script", "DOMContentLoaded");
            //DirectlyRTM("config",{id: "8a12a3ca54d1a8a50154d4fbaaef1cd9" });//old id
			 DirectlyRTM("config",{id: "8a2968fc58855a2401588e33b1a467f6" });
        </script>
<!-- ask an expert-->


<form id="hidden_form" method="post" action="/app/chat/chat_landing" style="display:none" target="chat_landing">


<!-- The below code is used to get the selected category and set it into a text input field and post to the chat landing page-->
<? $selected_cat_id=getUrlParm("catid");?>
<input type="text" name="selected_category" value="<?= $selected_cat_id?>">
<!-- above is the explanation-->


<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$recommended_channel" required="false" initial_focus="false" label_input="Channel" />
<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$member_type_new" required="false" initial_focus="false" label_input="Member Type" />
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$coachcustomernumber" label_input="Coach ID" required="false"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$last_four_ssn" label_input="Last 4 digits of Credit Card on file for BSF" required="false"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$life_time_rank" label_input="Lifetime Rank" required="false">
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.c$billing_zip_postal_code" label_input="Billing Zip Code" required="false"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Emails.PRIMARY.Address"  label_input="Email" required="false" allow_external_login_updates="true"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Name.First"  label_input="First" required="false" allow_external_login_updates="true"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Contact.Name.Last"  label_input="Last" required="false" allow_external_login_updates="true"/>
<rn:widget path="custom/Chat_Hidden_Fields/ChatTextInput" name="Incident.Threads"  label_input="How can our agent help you today?" required="false"/> 
<rn:widget path="custom/Chat_Hidden_Fields/ChatSlectionInput" name="Incident.c$language_shk" label_input="Preferred Response Language" default_value="1182" interface=1 required="false"/>
		
</form>	



<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                                                        order status and credit card 
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<!--ORDER  STATUS-->

<div id="myModal" class="modal View_Modal pop-modal">

 
  <div class="modal-content Bb_modal">
  	<div class="model-inner">
    <span class="close" id="orderClose" >X</span>
	 <div class="cmp_logo"><img src="/euf/assets/images/beachbody_logo_site.png"></div>
	<div id="headingOrder">ORDER STATUS</div>    
	
	 <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
	 <p>*Coaches-Coach Online Office results are <br>updated more frequently. Please visit the Coach <br>Online Office for timely updates.</p>
	 </div> 
	 
	 
	<div id="invalid_data" name="invalid_phone"></div>
	  
	<div id="valid_data">
	</div>  
	       
	<div id="errors"></div>
	<div id="display_chat"></div>
    
  <form id="rn_QuestionSubmit" method="post">
  
        <div id="rn_ErrorLocation"></div>
		 	
        <div class="form-dv">
        
       		     <div class="left-box">
                     <rn:widget path="custom/ResponsiveDesign/countrySelectionInput_OrderStatus" name="Contact.Address.Country" required="false" label_input = "Country/Pais/Pays" default_value='1' allow_external_login_updates="true"/>
                </div>
          
		  
			  <div class="left-box">
                    <rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.order_number"
       		          label_input="Order Number" required="false"/>
                </div>
                
                   
                <div class="mid-box">
                 <span class="text-1">Step 1:</span>
               <span class="text-center"> -or- </span></div>
                 
               <div class="right-box">
              	 <rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.email" 
               	  label_input="Email" required="false"/>    
                </div>
             
        </div>
        
        
        <div class="dvd-Dv">
        	<p> </p>
        </div>
        
            <div class="form-dv"> 
            
                <div class="center-box">
                <div class="text-2">Step 2:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCO" name="CO.order_tracking_new.zip_code" 
               		label_input="Zip/Postal Code" required="false"/>
                     
                </div>
                 
                            
                <div class="info-text"><p>*Enter email and zip / post / postal code of shipping address.</p></div>
                
               
                 
			</div>
			 <div class="model-footer">
                   
					    <rn:widget path="custom/ResponsiveDesign/FormSubmitOrderStatus" error_location="rn_ErrorLocation" interface_type="true"/>
                      
              </div>
			
			
			
		<input type="text" id="email_instance" style="display:none"/>
		<input type="text" id="zip_code_instance" style="display:none"/>
		<input type="text" id="order_number_instance" style="display:none"/>
				
        </form>
		
		
  </div>
</div>
</div>

<!--ORDER  STATUS-->

<!--CREDIT CARD UPDATE-->

<div id="myModal_ccu" class="modal View_Modal pop-modal card_popup">

  <!-- Modal content -->
  <div class="modal-content Bb_modal">
  	<div class="model-inner">
   <!-- <span class="close" onClick="closePopUp()"  style="display: none">X</span>-->
	<span class="close" onClick="closePopUp()">X</span>
	 <div class="cmp_logo"><img src="/euf/assets/images/beachbody_logo_site.png"></div>
	<div id="heading">Credit Card Update</div>
	

	
	<!-- <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
	 <p>*Coaches-Coach Online Office results are <br>updated more frequently. Please visit the Coach <br>Online Office for timely updates.</p>
	 </div>-->
	 
	  
	<div id="invalid_data" name="invalid_phone"></div>
	  
	<div id="valid_data_vv">
	</div>  
	       
	<div id="errors"></div>
	<div id="display_chat"></div>
    <div id="form123"> 
		<form id="rn_QuestionSubmit_vv" method="post">
   
        <div id="rn_ErrorLocation_vv"></div>
        
        
        
			
        <div class="form-dv">
        
       		          		
			<div class="center-box">
                <div class="text-2">Step 1:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCOCreditCardUpdate" name="CO.order_tracking_new.email" 
               	  label_input="Email" required="false"/>
                     
                </div>	
		       
        </div>
		
		 
        
        <div class="dvd-Dv">
        	<p> <!-- enter your order number below --></p>
        </div>
        
            <div class="form-dv"> 
            
                <div class="center-box">
                <div class="text-2">Step 2:</div>
                	<rn:widget path="custom/ResponsiveDesign/TextInputCOCreditCardUpdate" name="CO.order_tracking_new.zip_code" 
               		label_input="Zip / Postal Code" required="false"/>
                     
                </div>
                
                  
                            
                <!--<div class="info-text"><p>*Enter email and zip / postal code of Shipping Address.</p></div>-->
                		
                  
			</div>
			<div class="model-footer">
                      
                      <rn:widget path="custom/ResponsiveDesign/recordSearchSubmit" error_location="rn_ErrorLocation_vv" interface_type="true"/> 
                </div>
			
			
		<intput type="text" id="email_instance_cc" style="display:none"/>
		<intput type="text" id="zip_code_instance_cc" style="display:none"/>
	
				
        </form>
	</div>
	<div id="responseMessage_cc"></div>
	<div id="closeButton" style="display:none !important"> <input type="button" name="close" value="CLOSE" onClick="closePopUp()"></div>
	<div id="formdisplay" style="display: none">
		
		<form id="form" onsubmit="return false">
				
				<div id="displaynote" >
					<h4 style="color: red">Please expect these changes to take up to 24 hours to be applied to your account.</h4>
				</div>
				<br/><br/>
				<div class="clsCardTypes">
						
    				<div class="clsCardDetails"><p>Please enter your new card details</p>
      				  <img src="/euf/assets/images/cardTypes.png"/>
					</div>
					
   				 </div><br/><br/>
				 
				 
   				 <div id="rn_ErrorLocation_vv" style="color:red"></div>
   				 
				
				
				<!--<rn:widget path="input/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.full_name" label="Name on the card"/>-->
				
				<div id="firstName" style="display: none">	
				<rn:widget path="input/TextInput" name="Contact.Name.First" required="true" label="First Name" label_input="First name" allow_external_login_updates="true"/><br/>
				</div>
				<div id="lastName" style="display: none">	
				<rn:widget path="input/TextInput" name="Contact.Name.Last" required="true" label="Last Name" label_input="Last name" allow_external_login_updates="true"/>
				</div><br/><br/><br/>
				<!---------------------------------Updated by jithin(below code) select credit card type based on country selection------------------------------------------>
				<div class="country">
				<rn:widget path="custom/ResponsiveDesign/countrySelectionInput_ccu" name="Contact.Address.Country" required="true" label_input = "Country" default_value='1' allow_external_login_updates="true"/>
				</div>
				
				<div class="card_type" id="test">		  		
				<rn:widget path="custom/ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.credit_card_type" required="true" label_input="Credit Card Type"/>
				</div>
				<!---------------------------------Updated by jithin(above code) select credit card type based on country selection------------------------------------------>
				<div>	
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.full_name" required="true" label="Name on the card"/><br/>
				</div>
				<div class="">
				<div class=""><!--credit_card_number-->
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.credit_card_number" required="true" label="Credit card number"/>
				</div>
				<!--<div class="credit_card_cvv">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.security_code" required="true" label="CVV / CSC"/><br/>
				</div>-->
				</div><br/>
				<div class="credit_card_expiry">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.exp_month" required="true" label="Expiration"/>
				<div class="cvv year">
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.exp_year" required="true" label=""/><br/>
				</div>
				</div><br/><br/>
				

				<br/><br/><br/>
				<div  class="clsCredirCardLbl">
				<br/>
					Enter your credit card billing address
				</div>        
				<br/><br/>
				
				<div>
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_address" required="true" label="Address line1"/><br/>
				</div>
				<div>
				<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.apt_suite" label="Address line2"/>
				</div>
				<div class="">
					<div class="city">
					<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_city" required="true" label="City/Town"/>
					</div>
					<div class="state" id="state_req">
					<!--<rn:widget path="input/SelectionInput" name="Contact.Address.StateOrProvince" label_input="State / Province" required="true" required="false" />-->
					
					<rn:widget path="custom/ResponsiveDesign/SelectionInputState" name="Contact.Address.StateOrProvince" label_input="State / Province" required="true" required="false" allow_external_login_updates="true"/>
					</div>
				</div>
				<!--<rn:widget path="input/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_state_province" label="State"/>-->
				<div class="">
					<div class="zip">
					<rn:widget path="ResponsiveDesign/UpdateCreditCardFormInput" name="Update_Acnt.Update_Account_Info.bill_to_postal_code" required="true" label="Zip / Post / Postal code"/>
					</div>
					<!--<div class="country">
					<rn:widget path="custom/input/countrySelectionInput_ccu" name="Contact.Address.Country" required="true" label_input = "Country"/>
					</div>-->
				</div>
				
				<div>
				<rn:widget path="custom/ResponsiveDesign/UpdateCreditCardFormSubmit" name="" required="false" />
				</div>

		</form>
	</div>

  </div>
</div>
</div>
<!--CREDIT CARD UPDATE-->


<script>
	
	

//========================ORDER STATUS========================//	
	
// When the user clicks on <span> (x), close the modal
var modal = document.getElementById('myModal');
//var span = document.getElementsByClassName("close")[0];

var span = document.getElementById('orderClose');
	
	
	
span.onclick = function() {
	
	
document.getElementsByName("Contact.Address.Country")[0].value=1;
	
document.getElementById("rn_QuestionSubmit").style.display = "block";

var email_label = 'rn_'+document.getElementById("email_instance").value+'_Label';
var zip_label = 'rn_'+document.getElementById("zip_code_instance").value+'_Label';
var order_label = 'rn_'+document.getElementById("order_number_instance").value+'_Label';

/*
document.getElementById(email_label).className = "rn_Label";
document.getElementById(zip_label).className = "rn_Label";
document.getElementById(order_label).className = "rn_Label";
*/

document.getElementById("errors").innerHTML = "";
document.getElementById("rn_ErrorLocation").innerHTML = "";

document.getElementById("rn_ErrorLocation").className = "";
document.getElementById("valid_data").innerHTML="";

document.getElementById("display_chat").innerHTML = "";

document.getElementsByName("CO.order_tracking_new.email")[0].value ="";
document.getElementsByName("CO.order_tracking_new.email")[0].className="rn_Text";

document.getElementsByName("CO.order_tracking_new.zip_code")[0].value="";
document.getElementsByName("CO.order_tracking_new.zip_code")[0].className="rn_Text";


document.getElementsByName("CO.order_tracking_new.order_number")[0].value="";
document.getElementsByName("CO.order_tracking_new.order_number")[0].className="rn_Text";




modal.style.display = "none";
	
document.getElementById('odrSub').style.display="block";
document.getElementById('odrSub').style.visibility="visible";	
	
}

//========================ORDER STATUS========================//

//========================CREDIT CARD UPDATE==================//
function redirectNextPage_vv() {

  
   //track_credit_card_update_clicks('next');

	$("div #rn_ErrorLocation_vv").hide();
	//$("#responseMessage").hide();

	document.getElementById("valid_data_vv").style.display = "none";
	document.getElementById("rn_QuestionSubmit_vv").style.display = "none";	

	document.getElementById("formdisplay").style.display = "block";
	
		
	//Edited by jithin[below code] 
    document.getElementsByName("Contact.Address.Country")[1].value=1;
	document.getElementsByName('Contact.Address.StateOrProvince')[0].removeAttribute("disabled");
	var children = document.getElementById("state_req").children;
	//document.getElementById(children[0].id+"_Label")['childNodes'][0]['data']="State / Province";
	document.getElementById(children[0].id+"_Label")['innerHTML']="State / Province<span class='rn_Required'> *</span>";
	//console.log(document.getElementById(children[0].id+"_Label"));
	//----------------------------ajax call for creating the state corresponding to country US----------------
		var c_id = document.getElementsByName("Contact.Address.Country")[1].value;
 	 	$.ajax({
	            url:"/cc/AjaxCustom1/countrybasedstateorprovince",
	            data:{ country_id: c_id}, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
				var children = document.getElementById("state_req").children;	
			    document.getElementById(children[0].id+"_Contact.Address.StateOrProvince").innerHTML = '';
				var select= document.getElementById(children[0].id+"_Contact.Address.StateOrProvince");
				var option = document.createElement('option');
				option.value = "";
				option.text  = "--";  
				select.add(option);
		        for(var i=0;i<response.length;i++) {
				var option = document.createElement('option');
				option.value = response[i].ID;
				option.text  = response[i].Name;  
				select.add(option);
	        	}
	          });
			  
			  /*.error(function(response) {
	            alert("got error");
	           
       	 });*/
		 

		 $.ajax({
	            url:"/cc/AjaxCustom1/screenCardTypesByCountry",
	            data:{ country_id: c_id}, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
				var children = document.getElementById("test").children;
                document.getElementById(children[1].id).innerHTML='';
				var select= document.getElementById(children[1].id);
				var option = document.createElement('option');
				option.value = "";
				option.text  = "--";  
				select.add(option);
		        for(var i=0;i<response.length;i++) {
				var option = document.createElement('option');
				option.value = response[i].ID;
				option.text  = response[i].LookupName;  
				select.add(option);
	        	}
	          });
			  /*.error(function(response) {
	            alert("got error");
	           
       	 });*/
	//----------------------------------------------------------------------------------------------
	
	  
	//Edited by jithin[above code]
	
	
	document.getElementById("LoadingIconMain").setAttribute("class", "rn_Hidden");
	
	document.getElementsByName("form3_submitMain")[0].removeAttribute("disabled");
	

	$("div #heading").empty();
	$("div #rn_ErrorLocation_vv").empty();
	
	//document.getElementById('myModal_ccu').style.display = "none";
	
	//----------------------------ajax call for checking whether the contact exists or not----------------
	
	
		var fdata = {};
		//console.log(JSON.stringify($("#rn_QuestionSubmit_vv").serializeArray()));
  		fdata["form"] = JSON.stringify($("#rn_QuestionSubmit_vv").serializeArray());
  		
 	 	$.ajax({
	            url:"/cc/CreditCardUpdate/UpdateCreditCard1",
	            data:fdata, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
	        	//console.log(response);
				
							 
	        	if(response.result.count > 0){
	        		document.getElementById("firstName").style.display="none";
	        		document.getElementById("lastName").style.display="none";

	        		
	        	}else{
	        		document.getElementById("firstName").style.display="block";
	        		document.getElementById("lastName").style.display="block";



	        	}
				});
				
	         /* .error(function(response) {
	            alert("got error");
	           
       	 });*/
	
	
	//----------------------------------------------------------------------------------------------
	
}


function closePopUp()
{
	
	document.getElementById('closeButton').style.display = "none";
	
	document.getElementsByName("Update_Acnt.Update_Account_Info.full_name")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.credit_card_number")[0].value="";
	//document.getElementsByName("Update_Acnt.Update_Account_Info.security_code")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.exp_year")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.exp_month")[0].value="";
	document.getElementsByName("Contact.Address.StateOrProvince")[0].value="";
	document.getElementsByName("Contact.Address.Country")[0].value=1;
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_address")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.apt_suite")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_city")[0].value="";
	document.getElementsByName("Update_Acnt.Update_Account_Info.bill_to_postal_code")[0].value="";
	
	
	
	$("#responseMessage_cc").hide();
	document.getElementById('myModal_ccu').style.display = "none";
	
	
document.getElementById("rn_QuestionSubmit_vv").style.display = "block";

var email_label_cc = 'rn_'+document.getElementById("email_instance_cc").value+'_Label';
var zip_label_cc = 'rn_'+document.getElementById("zip_code_instance_cc").value+'_Label';

/*
document.getElementById(email_label_cc).className = "rn_Label";
document.getElementById(zip_label_cc).className = "rn_Label";
*/


document.getElementById("errors").innerHTML = "";
document.getElementById("rn_ErrorLocation_vv").innerHTML = "";

document.getElementById("rn_ErrorLocation_vv").className = "";
document.getElementById("valid_data_vv").innerHTML="";

document.getElementById("display_chat").innerHTML = "";


document.getElementsByName("CO.order_tracking_new.email")[1].value ="";
document.getElementsByName("CO.order_tracking_new.email")[1].className="rn_Text";

document.getElementsByName("CO.order_tracking_new.zip_code")[1].value="";
document.getElementsByName("CO.order_tracking_new.zip_code")[1].className="rn_Text";


}
//========================CREDIT CARD UPDATE==================//

</script>
     

	
	                                                                                 
