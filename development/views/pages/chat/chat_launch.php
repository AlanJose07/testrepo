<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_request"/>

<?php
$clang= $CI->session->getSessionData('clang');
if($clang=="en_AU")
{
?>
<script>
document.onreadystatechange = function() {
      if (document.readyState !== "complete") {	
		  document.querySelector(".loader-overlay").style.display = "block";            
          document.querySelector(".loader").style.display = "block";
      } else {
          document.querySelector(".loader-overlay").style.display = "none";            
          document.querySelector(".loader").style.display = "none";           
      }
  };
</script>
<div class="loader">
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	<div></div>
	
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" data-automation="loader-plane" class="loader-plane"><path fill="#5A5A5A" fill-rule="nonzero" d="M8.802.075c.445-.132.777-.09.995.128.218.218.26.55.128.995-.133.446-.403.872-.81 1.28L7.521 4.07l1.28 4.236c.019.095 0 .17-.057.228l-.825.824a.23.23 0 0 1-.199.071.26.26 0 0 1-.185-.113L5.39 6.202 3.826 7.766l.327 1.322c.019.095 0 .17-.057.228l-.611.61a.23.23 0 0 1-.2.072.228.228 0 0 1-.17-.1L1.907 8.093.102 6.885a.228.228 0 0 1-.1-.17.23.23 0 0 1 .071-.2l.611-.611c.057-.057.133-.076.228-.057l1.322.327L3.798 4.61.684 2.464a.26.26 0 0 1-.113-.185.23.23 0 0 1 .07-.2l.825-.824c.057-.057.133-.076.228-.057l4.236 1.28L7.522.886c.408-.408.834-.678 1.28-.81z"></path></svg> 
</div>
<div class="loader-overlay"></div> 
<? } ?>
<? /*---Getting keyword parameter from url---*/ ?>
<?php
$cur_url=$_SERVER['REQUEST_URI'];
if(getUrlParm('lo') && (strpos($cur_url,'chat_launch'))!== false)
{
	$newurl=str_replace("chat_launch","chat_lang",$cur_url);
	header("Location:".$newurl);
}
$ref_url=$CI->session->getSessionData('url');
if($ref_url!='' && $ref_url!="https://care.inflightinternet.com/ci/admin/overview")
{
	if(strpos($ref_url,"https://care.inflightinternet.com/app")!== FALSE)
	{
		$ref_url='';
		$ref_url=@$_SERVER[HTTP_REFERER];
		if(strpos($ref_url,"https://care.inflightinternet.com/app")!== FALSE)
			$ref_url='';
	}
	if(strlen($ref_url)>254)
	{
		 $ref_url = substr($ref_url,0,254);
	}
	$ref=$ref_url;

}
else
{
	$CI = get_instance();
 	$ref=@$_SERVER[HTTP_REFERER];
	
	
	if(strpos($ref,"https://care.inflightinternet.com/app")!== FALSE)
	{
		$ref='';
	}
	else
	{
		if(strlen($ref)>254)
		{
			 $ref = substr($ref,0,254);
		}
		$ref=$ref;
	}
	
}
 if(strlen(getUrlParm('kw'))){
	$topic = getUrlParm('kw');
 }else{
	$topic = "";
 }
?>
<?php

/*--flight info fields ---*/

	$_icf_3 = ($CI->session->getSessionData('flightNumber')!='') ? $CI->session->getSessionData('flightNumber') : 'null';
	$_icf_4 = ($CI->session->getSessionData('flightOrigin')!='') ? $CI->session->getSessionData('flightOrigin') : 'null';
	$_icf_5 = ($CI->session->getSessionData('flightDestination')!='') ? $CI->session->getSessionData('flightDestination') : 'null';
	$_icf_6 = ($CI->session->getSessionData('tailNumber')!='') ? $CI->session->getSessionData('tailNumber') : 'Ground';
	$_icf_7 = ($CI->session->getSessionData('browserOs')!='') ? $CI->session->getsSessionData('browserOs') : substr($_SERVER['HTTP_USER_AGENT'],13,70);
    $_icf_9 = ($CI->session->getSessionData('macAddress')!='') ? $CI->session->getSessionData('macAddress') : 'null';
	$_icf_15 = ($CI->session->getSessionData('deviceId')!='') ? $CI->session->getSessionData('deviceId') : 'null';
	$_icf_37 = ($CI->session->getSessionData('uxdId')!='') ? $CI->session->getSessionData('uxdId') : 'null';


   $category = "";
   $all_param = $CI->session->getSessionData('urlParameters');
   $all_parameters= array();
	foreach($all_param as $array) {
 	foreach($array as $k=>$v) {
    $all_parameters[$k][] = $v;
 	   }
	   }	
		if(array_key_exists('c', $all_parameters))
		{
			if(is_array($all_parameters['c']))
			{
				$category = end($all_parameters['c']);
			}
			else
			{
				$category = $all_parameters['c'];
			}
		}
	if(array_key_exists('tailNumber', $all_parameters))
	{
		if(is_array($all_parameters['tailNumber']))
		{
			$tailNumber = end($all_parameters['tailNumber']);
		}
		else
		{
		$tailNumber = $all_parameters['tailNumber'];
		}
	}
	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];

?>
<script src="js/jquery.min.js"></script>
<? if($flgtNo!="CPA") { ?>
<div class="req-wtext"><sup>*</sup>All fields required</div>
<?}?>

<div style="width:100%;"> <span class="rn_ChatLaunchFormHeader">We're here to help.<? if($flgtNo=="CPA") echo 'Simply enter your name, email address and a help topic,then click "Chat".';?></span> <br/>
  <br/>
</div>
<div class="main-container-chat">
  
  <div id="rn_PageContent" class="rn_Live">
    <div>
      <rn:condition chat_available="true">
        <div id="rn_ChatLaunchFormDiv" class="rn_ChatForm">
          <div id="ChatForm" style="margin-top:10px;">
            
            <?php
             $CI = get_instance();

 			 $sid=$CI->session->getSessionData('sessionID');
			  if($CI->session->getSessionData('USER_SESSION_COOKIE_EXIPIRE')=="Enable"){
				$action= "/app/chat/chat_landing/sid/".$sid ;	
				if(getUrlParm('tailNumber'))
				{
					$action="/app/chat/chat_landing/sid/".$sid."/flightNumber/".getUrlParm('flightNumber')."/flightOrigin/".getUrlParm('flightOrigin')."/flightDestination/".getUrlParm('flightDestination')."/tailNumber/".getUrlParm('tailNumber')."/clang/".getUrlParm('clang');
				}
				
			  }
			  else{
				$action= "/app/chat/chat_landing/sid/".$sid ;
			  }
			  
			  
			 
			?>
            
            
            <form id="rn_ChatLaunchForm" method="post" action="<?php echo $action;?>">
              <div id="rn_ErrorLocation"  <? if($flgtNo!="CPA") { ?> style="display:none;" <? } ?>></div>
              <rn:condition config_check="COMMON:intl_nameorder == 1">
			  <?php 
			  
			  
			   if($flgtNo=="CPA"){?>
                <rn:widget path="custom/input/CustomText" name="Contact.Name.Last" placeholder="Last Name" label_input="" required="true"/>
                <rn:widget path="custom/input/CustomText" name="Contact.Name.First" placeholder="First Name" label_input="" required="true"/>
				<?php } 
				else
				{
			   ?>
				<rn:widget path="input/TextInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
                <rn:widget path="input/TextInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
				<?php } ?>
                <rn:condition_else/>
				 <?php if($flgtNo=="CPA"){?>
                 <!--customized for placeholder-->
                <rn:widget path="custom/input/CustomText" name="Contact.Name.First" placeholder="First Name" label_input=""  required="true" initial_focus="true"/>
                <rn:widget path="custom/input/CustomText" name="Contact.Name.Last" placeholder="Last Name" label_input="" required="true"/>
				<?php } 
				else
				{ ?>
				<rn:widget path="custom/custom/customTextFormInput" name="Contact.Name.First" label_input="" required="true" initial_focus="true" placeholder="First name" label_required="Please enter a valid first name." />
				<div class="err-message" id="firstname"></div>
                <rn:widget path="custom/custom/customTextFormInput" name="Contact.Name.Last" label_input="" required="true" placeholder="Last name" label_required="Please enter a valid last name."/>
				<div class="err-message" id="lastname"></div>
				<?php } ?>
              </rn:condition>
              
			   <?php if($flgtNo=="CPA"){?>
              <rn:widget path="custom/input/CustomText" name="Contact.Emails.PRIMARY.Address" placeholder="Email" required="true"  label_input=""/>
			 
              <rn:widget path="custom/input/CustomText" name="Incident.Subject" required="true" placeholder="Topic" label_input="" default_value="#rn:php:$topic#"/>
			 
			  <? } 
			  else
			  {?>
			  <rn:widget path="custom/custom/customTextFormInput" name="Contact.Emails.PRIMARY.Address" required="true"  label_input="" label_validation="Please enter a valid email." label_required="Please enter a valid email." label_error ="Please enter a valid email." placeholder="Email"/>
			   <div class="err-message" id="email"></div>
              <rn:widget path="custom/custom/customTextFormInput" name="Incident.Subject" required="true" label_input="" default_value="#rn:php:$topic#" label_required="Please enter a valid topic." placeholder="Topic"/>
			   <div class="err-message" id="topic"></div>
			  <? } ?>
			   <?php if($flgtNo=="CPA"){?>
              <!--customized for radio button-->
               <rn:widget path="custom/input/CategoryRadio" name="Incident.Category" label_input="Which category can we help you with?" data_type="Categories" required="true" required_lvl=1/>
                <? } ?>
			 <?php /*---Hiding fields, these values are shown in chat workspace --*/?>
              <div style="display:none"> 
                <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_num" label_input="Flight Number" default_value="#rn:php:$_icf_3#"/>
                <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_origin" label_input="Flight Origin" default_value="#rn:php:$_icf_4#"/>
                <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_destination" label_input="Flight Destination" default_value="#rn:php:$_icf_5#"/>
                <rn:widget path="input/FormInput" name="Incident.c$gogo_tail_num" label_input="Tail Number" default_value="#rn:php:$_icf_6#"/>
                <rn:widget path="input/FormInput" name="Incident.c$gogo_os_browser" label_input="Browser" default_value="#rn:php:$_icf_7#"/>
                <rn:widget path="input/FormInput" name="Incident.c$mac_address" label_input="Mac Address" default_value="#rn:php:$_icf_9#"/>
				<rn:widget path="input/FormInput" name="Incident.c$deviceid" label_input="deviceid" default_value="#rn:php:$_icf_15#"/>
				<rn:widget path="input/FormInput" name="Incident.c$uxdid" label_input="uxdid" default_value="#rn:php:$_icf_37#"/>


				<?php if($flgtNo=="CPA"){?>
                <!--selecting product/category when opening workspace during chat-->
                <rn:widget path="custom/chat/CustomProdCatInput" name="Incident.Category" label_input="Services" data_type="Categories" required_lvl=1/>
				<? } else
				{?>
				<!--<rn:widget path="custom/chat/CustomProdCat" name="Incident.Category" label_input="Services" data_type="Categories" required_lvl=1/>-->
				<? } ?>
                <rn:widget path="custom/input/TextInputCategory" name="Incident.c$customer_category" label_input="Services" /> 
                      
                
               
				 <rn:widget path="input/FormInput" name="Incident.c$site_referrer_url" label_input="Site Referrer URL" default_value="#rn:php:$ref#"/>
				 
                
              </div>
			  <? if($flgtNo=="CPA") { ?>
              <rn:widget path="chat/ChatLaunchButton" open_in_new_window="false" error_location="rn_ErrorLocation" label_button="Chat"/>
			   <? } else { ?>
			    <rn:widget path="chat/ChatLaunchButton" open_in_new_window="false" error_location="rn_ErrorLocation" label_button="Chat"/>
			    <rn:widget path="custom/custom/buttonEnable" />
			   <? } ?>
			
              <br />
              <br />
            </form>
          </div>
        </div>
      </rn:condition>
    </div>
  </div>
</div>


