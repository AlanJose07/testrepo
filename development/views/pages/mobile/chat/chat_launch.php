
<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="mobile.php" clickstream="chat_request"/>
<?php
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
if(strlen(getUrlParm('kw')))
{
	$topic = getUrlParm('kw');
}
else
{
	$topic = " ";
}
 
// flight info fields -----------------
$_icf_3 = ($CI->session->getSessionData('flightNumber')!='') ? $CI->session->getSessionData('flightNumber') : 'null';
$_icf_4 = ($CI->session->getSessionData('flightOrigin')!='') ? $CI->session->getSessionData('flightOrigin') : 'null';
$_icf_5 = ($CI->session->getSessionData('flightDestination')!='') ? $CI->session->getSessionData('flightDestination') : 'null';
$_icf_6 = ($CI->session->getSessionData('tailNumber')!='') ? $CI->session->getSessionData('tailNumber') : 'Ground';
$_icf_7 = ($CI->session->getSessionData('browserOs')!='') ? $CI->session->getsSessionData('browserOs') : substr($_SERVER['HTTP_USER_AGENT'],13,70);	
$_icf_9 = ($CI->session->getSessionData('macAddress')!='') ? $CI->session->getSessionData('macAddress') : 'null';

/*Airline Template-Start
	$_icf_15 = ($CI->session->getSessionData('client')!='') ? $CI->session->getSessionData('client') : 'null';
	$_icf_16 = ($CI->session->getSessionData('page')!='') ? $CI->session->getSessionData('page') : 'null';
Airline Template-End*/	
 $category = "";
   $all_parameters = $CI->session->getSessionData('urlParameters');
			
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
		

?>

<section id="rn_PageContent" class="rn_LiveHelp">
  <div class="rn_Padding" >
    <rn:condition chat_available="true">
      <div class="rn_ChatForm">
        <?php /*---Sanal -- specifying form action, so that it should redirect to chat landing page--*/ ?>
        <form id="rn_chatLaunchForm" method="post" action="/app/chat/chat_mobile_redirect/">
          <div id="rn_ErrorLocation"></div>
          <fieldset>
          <rn:condition config_check="COMMON:intl_nameorder == 1">
            <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
            <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
            <rn:condition_else/>
            <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
            <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
          </rn:condition>
          <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" label_input="Your Email" />
          <rn:widget path="input/FormInput" name="incident.Subject" required="true" label_input="Topic" default_value="#rn:php:$topic#"/>
          <? /*---Hiding fields, these values are shown in chat workspace--*/?>
          <div style="display:none">
            <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_num" required="true" label_input="Flight Number" default_value="#rn:php:$_icf_3#"/>
            <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_origin" required="true" label_input="Flight Origin" default_value="#rn:php:$_icf_4#"/>
            <rn:widget path="input/FormInput" name="Incident.c$gogo_flight_destination" required="true" label_input="Flight Destination" default_value="#rn:php:$_icf_5#"/>
            <rn:widget path="input/FormInput" name="Incident.c$gogo_tail_num" required="true" label_input="Tail Number" default_value="#rn:php:$_icf_6#"/>
            <rn:widget path="input/FormInput" name="Incident.c$gogo_os_browser" required="true" label_input="Browser" default_value="#rn:php:$_icf_7#"/>
            <rn:widget path="input/FormInput" name="Incident.c$mac_address" required="false" label_input="Mac Address" default_value="#rn:php:$_icf_9#"/>
            
        <!--Airline Template-Start
                <rn:widget path="input/FormInput" name="Incident.c$client" label_input="Client" default_value="#rn:php:$_icf_15#"/>
                <rn:widget path="input/FormInput" name="Incident.c$page" label_input="Page" default_value="#rn:php:$_icf_16#"/>
        Airline Template-End-->
            <rn:widget path="input/MobileProductCategoryInput" label_input="Services" data_type="Category"  default_value="#rn:php:$category#" required_lvl=0/> 
			 <rn:widget path="input/FormInput" name="Incident.c$site_referrer_url" label_input="Site Referrer URL" default_value="#rn:php:$ref#"/>
          </div>
          </fieldset>
          <br />
          <rn:widget path="chat/ChatLaunchButton" 
                            error_location="rn_ErrorLocation" 
                            open_in_new_window="false"
                            label_form_header="" 
                            add_params_to_url="q_id,pac,request_source,p,c,survey_send_id,survey_send_delay,survey_comp_id,survey_term_id" label_button="Chat with Gogo" />
          <br />
          <br />
        </form>
      </div>
    </rn:condition>
  </div>
</section>
