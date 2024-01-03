<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="mobile.php" clickstream="home"/>
<?php
 // store flight info in a session to be passed in the chat
 if(getUrlParm('flightNumber') || getUrlParm('tailNumber'))
	{
	
	$CI->session->setSessionData(array('flightNumber' => getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress')));
	
	}
	
	$CI = get_instance();
 	$ref=@$_SERVER[HTTP_REFERER];
	$CI->session->setSessionData(array('url' => $ref));

$flightNumber = "";

//Getting flight number from url parameters
$all_parameters = $CI->session->getSessionData('urlParameters');

if(array_key_exists('flightNumber', $all_parameters)) {
	if(is_array($all_parameters['flightNumber'])) {
		$flightNumber = end($all_parameters['flightNumber']);
	}
	else {
		$flightNumber = $all_parameters['flightNumber'];
	}
}

//Storing first three parameters of flight number
$flgtNo  = substr($flightNumber, 0, 3);

/*Airline Template-Start
	$video = getUrlParm('video');
	
	
	if($aline=="AAL" && $acpu_type=="ATG" && $video=="yes")
	{
	
	$flight = 100762;
	}
	
	else if($aline=="AAL" && $acpu_type=="ATG" && $video=="")
	{
	
	$flight = 100760;
	}


else
{
Airline Template-End*/
if($flgtNo=="ACA")
$flight = 100760;
elseif($flgtNo=="ASA")
$flight = 100761;
elseif($flgtNo=="AAL")
$flight = 100762;
elseif($flgtNo=="AMX")
$flight = 101147;	
elseif($flgtNo=="AWE")
$flight = 100763;
elseif($flgtNo=="DAL")
$flight = 100764;
elseif($flgtNo=="JAL")
$flight = 100765;
elseif($flgtNo=="TRS")
$flight = 100766;
elseif($flgtNo=="UAL")
$flight = 100767;
elseif($flgtNo=="VAL")
$flight = 100768;
elseif($flgtNo=="VIR")
$flight = 101228;
elseif($flgtNo=="null")
$flight = 100769;							
else
$flight = 100003;
 /*Airline Template-Start
}
Airline Template-End*/
$c=getUrlParm('c');
	if($c==NULL || $c=='' || $c==0) {$res_cat="Common Topics";}
	else { $res_cat=$CI->model('custom/language_model')->getCurrentCategory($c); }


?>

<section id="rn_PageContent" class="rn_Home">
  <div class="rn_Module">
    <rn:widget path="custom/reports/customMobilemultiline3" report_id="#rn:php:$flight#" per_page="10"/>
  </div>
</section>
