<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_request"/>

<? /*---Getting keyword parameter from url---*/ ?>
<?php
$cur_url=$_SERVER['REQUEST_URI'];
if(getUrlParm('lo') && (strpos($cur_url,'chat_launch'))!== false)
{
	$newurl=str_replace("chat_launch","chat_lang",$cur_url);
	header("Location:".$newurl);
}
$ref_url=$CI->session->getSessionData('url');
if($ref_url!='' && $ref_url!="https://custhelp.gogoinflight.com/ci/admin/overview")
{
	if(strpos($ref_url,"https://custhelp.gogoinflight.com/app")!== FALSE)
	{
		$ref_url='';
		$ref_url=@$_SERVER[HTTP_REFERER];
		if(strpos($ref_url,"https://custhelp.gogoinflight.com/app")!== FALSE)
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
	
	
	if(strpos($ref,"https://custhelp.gogoinflight.com/app")!== FALSE)
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
	$_icf_15 = ($CI->session->getSessionData('deviceid')!='') ? $CI->session->getSessionData('deviceid') : 'null';
	$_icf_37 = ($CI->session->getSessionData('uxdid')!='') ? $CI->session->getSessionData('uxdid') : 'null';


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
<div style="width:100%; padding-top:10px;"> <span class="rn_ChatLaunchFormHeader">We're here to help. Simply enter your name, email address and a help topic,then click "chat with Gogo". </span> <br/>
  <br/>
</div>
<div class="main-container-chat">
  
  <div id="rn_PageContent" class="rn_Live">
    <div class="rn_Padding" >
      <rn:condition chat_available="true">
        <div id="rn_ChatLaunchFormDiv" class="rn_ChatForm">
          <div id="ChatForm" style="margin-top:20px;">
            
            <?php
             $CI = get_instance();
 			 $sid=$CI->session->getSessionData('sessionID');
			 
			?>
            
            
            <form id="rn_ChatLaunchForm" method="post" action="/app/chat/chat_landing/sid/<?php echo $sid?>">
              <div id="rn_ErrorLocation"></div>
              <rn:condition config_check="COMMON:intl_nameorder == 1">
			  <?php 
			  
			  
			   if($flgtNo=="CPA"){?>
                <rn:widget path="custom/input/CustomText" name="Contact.Name.Last" placeholder="Last Name" label_input="" required="true"/>
                <rn:widget path="custom/input/CustomText" name="Contact.Name.First" placeholder="First Name" label_input="" required="true"/>
				<?php } 
				else
				{
			   ?>
				<rn:widget path="input/TextInput" name="Contact.Name.Last"  label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
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
				<rn:widget path="input/TextInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#"  required="true" initial_focus="true"/>
                <rn:widget path="input/TextInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
				<?php } ?>
              </rn:condition>
              
			   <?php if($flgtNo=="CPA"){?>
              <rn:widget path="custom/input/CustomText" name="Contact.Emails.PRIMARY.Address" placeholder="Email" required="true"  label_input=""/>
              <rn:widget path="custom/input/CustomText" name="Incident.Subject" required="true" placeholder="Topic" label_input="" default_value="#rn:php:$topic#"/>
			  <? } 
			  else
			  {?>
			  <rn:widget path="custom/input/TextInputCustom" name="Contact.Emails.PRIMARY.Address" required="true"  label_input="Your Email"/>
              <rn:widget path="custom/input/TextInputCustom" name="Incident.Subject" required="true" label_input="Topic" default_value="#rn:php:$topic#"/>
			  <? } ?>
              <!--customized for radio button-->
               <rn:widget path="custom/input/CategoryRadio" name="Incident.Category" label_input="Which category can we help you with?" data_type="Categories" required="true" required_lvl=1/>
               
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
				<rn:widget path="custom/chat/CustomProdCat" name="Incident.Category" label_input="Services" data_type="Categories" required_lvl=1/>
				<? } ?>
                <rn:widget path="custom/input/TextInputCategory" name="Incident.c$customer_category" label_input="Services" /> 
                      
                
               
				 <rn:widget path="input/FormInput" name="Incident.c$site_referrer_url" label_input="Site Referrer URL" default_value="#rn:php:$ref#"/>
				 
                
              </div>
              <rn:widget path="chat/ChatLaunchButton" open_in_new_window="false" error_location="rn_ErrorLocation" label_button="Chat with Gogo"/>
              <br />
              <br />
            </form>
          </div>
        </div>
      </rn:condition>
    </div>
  </div>
</div>


