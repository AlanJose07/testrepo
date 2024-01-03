<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_encode_redirect"/>
<rn:widget path="custom/input/GetContact"/>
<?php
$first_name=rawurlencode($_POST['Contact_Name_First']);
$last_name=rawurlencode($_POST['Contact_Name_Last']);
$email=rawurlencode($_POST['Contact_Emails_PRIMARY_Address']);
$subject=rawurlencode($_POST['Incident_Subject']);
$_icf_3=rawurlencode($_POST['Incident_CustomFields_c_gogo_flight_num']);
$_icf_4=rawurlencode($_POST['Incident_CustomFields_c_gogo_flight_origin']);
$_icf_5=rawurlencode($_POST['Incident_CustomFields_c_gogo_flight_destination']);
$_icf_6=rawurlencode($_POST['Incident_CustomFields_c_gogo_tail_num']);
$_icf_7=rawurlencode($_POST['Incident_CustomFields_c_gogo_os_browser']);
$_icf_9=rawurlencode($_POST['Incident_CustomFields_c_mac_address']);


/* Airline Template-Start
$_icf_15=rawurlencode($_POST['Incident_CustomFields_c_client']);
$_icf_16=rawurlencode($_POST['Incident_CustomFields_c_page']);
 Airline Template-End*/  
$cat=(rawurlencode($_POST['Incident_Category'])!='') ? rawurlencode($_POST['Incident_Category']) : 0;

$cc=rawurlencode($_POST['cat_radio']);
$cust_cat=trim($cc);
if(empty($cust_cat)) {
    $cust_cat = "category not set";
  } else {
    $cust_cat =$cust_cat;
  }

$site_url=(rawurlencode($_POST['Incident_CustomFields_c_site_referrer_url'])!='') ? rawurlencode($_POST['Incident_CustomFields_c_site_referrer_url']) : 'Referrer is Empty';

	
	
	
/* Airline Template-Start (Incident.CustomFields.c.client/$_icf_15/Incident.CustomFields.c.page/$_icf_16)*/  		
$redirectURL = "/app/chat/chat_landing/Contact.Name.First/$first_name/Contact.Name.Last/$last_name/Contact.Email.0.Address/$email/Incident.Subject/$subject/Incident.CustomFields.c.gogo_flight_num/$_icf_3/Incident.CustomFields.c.gogo_flight_origin/$_icf_4/Incident.CustomFields.c.gogo_flight_destination/$_icf_5/Incident.CustomFields.c.gogo_tail_num/$_icf_6/Incident.CustomFields.c.mac_address/$_icf_9/Incident.CustomFields.c.gogo_os_browser/$_icf_7/Incident.CustomFields.c.customer_category/$cust_cat/c/$cat/Incident.CustomFields.c.site_referrer_url/$site_url";
/* Airline Template-End*/  
header('Location: '.$redirectURL);

?>
