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
<?
$CI = &get_instance();
//$catid= getUrlParm('catid');
$incidentid = getUrlParm('incidentid');
$phnumber = getUrlParm('phnumber');
$coachdate = getUrlParm('coachdate');

$interface = $this->model('custom/bbresponsive')->interface_fetch($incidentid);
$skillID_url = getUrlParm('skillid');
$a = 1;
$authtoken = $this->model('custom/bbresponsive')->token_fetch($a,$incidentid);

//print_r ($interface);

//print_r ($coachdate);

//$skillID = 10483214; //tem

if(!empty($skillID_url)){
  $skillID = $skillID_url;
}else{
  $skillID =  \RightNow\Utils\Config::getConfig(1000080); //CUSTOM_CFG_CALL_ME_NOW_DEFAULT_VOICE_SKILL
}
//print_r($skillID);
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
#rn_ChatLaunchForm {
  min-height: calc(100vh - 130px) !important;
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
                    <div id="rn_ChatDialogContainer" class="">
                    <div id="rn_ChatDialogHeaderContainer">
                        <div id="rn_ChatDialogTitleLogo" class="rn_FloatLeft"><a href="/app/home"><img src=
						"/euf/assets/themes/responsive/images/logo.png"></a></div>
                     
                    </div>

					 <?
if($CI->session->getSessionData('iscallmenowavailable')=='true'){
 // if($CI->session->getSessionData('iscallmenowavailable')=='true'){

	$CI->session->setSessionData(array('iscallmenowavailable' => 'false'));
	//https://home-c35.nice-incontact.com/inContact/ChatClient/ChatClientPatron.aspx?poc=e0e48023-9106-4a92-b8a9-3919bd71c4cb&bu=4599337
?>
<div class="pagecontainer-screen-chat">
        <div class="card-headercont">
            <img src="/euf/assets/themes/responsive/images/logo.png" style="
    width: 30px;">
        </div>  


<!--API Call starts-->

<?
if (!function_exists("\curl_init"))
{
    \load_curl();
}

$ch = curl_init();
$scriptname = \RightNow\Utils\Config::getConfig(1000079);

curl_setopt_array($ch, array(
  CURLOPT_URL => "https://api-c35.nice-incontact.com/incontactapi/services/v25.0/scripts/search?scriptName=$scriptname&includeInactive=false",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
   'Authorization: Bearer '.$authtoken
  ),
));

$response1 = (array) json_decode(curl_exec($ch),true);
$httpcode1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);

if($err)

{

   // print_r($err);

}

curl_close($ch);


$scripdetails = $response1['scriptSearchDetails'][0]['masterID'];
//print_r($scripdetails);
 
 ?>
 <!--3rd CAll-->

 <?php

$curlpost = curl_init();

//$urlcall = "https://api-c35.nice-incontact.com/incontactapi/services/v25.0/scripts/$scripdetails/start?skillId=$skillID&amp;parameters='$phnumber|$incidentid|$skillID|$coachdate'";

$urlcall = "https://api-c35.nice-incontact.com/incontactapi/services/v25.0/scripts/$scripdetails/start?skillId=$skillID";
$postParameter = ["parameters" => $phnumber. '|' . $incidentid. '|' .$skillID. '|' .$coachdate. '|' .$interface];	
//print_r($postParameter);

//print_r($urlcall);

curl_setopt_array($curlpost, array(
  CURLOPT_URL => $urlcall,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'accept: application/json',
    'Authorization: Bearer '.$authtoken
  ),
  CURLOPT_POSTFIELDS =>$postParameter
));

$response2 = (array) json_decode(curl_exec($curlpost),true);
$httpcode2 = curl_getinfo($curlpost, CURLINFO_HTTP_CODE);
$contID = $response2['contactId'];
//print_r($contID);
curl_close($curlpost);
$niccontactupdate = $this->model('custom/bbresponsive')->incident_nice_contact($incidentid,$contID);

//print_r($httpcode2);
//print_r($response2);


?>
<!--API Call ends-->
<?php
if($httpcode2 != 200 && $httpcode2 !="" || $httpcode1 != 200 && $httpcode1 !="" || $httpcode != 200 && $httpcode !="")
						{?>
               <div id="rn_SmsTitle" class="rn_FloatLeft" style="font-size:18px !important;">Something went wrong. Please try again.</div>
<? }else {?>
<div id="rn_SmsTitle" class="rn_FloatLeft" style="font-size:18px !important;">Your Call is being connected.</div>
<div id="rn_SmsDialogTitle" class="" style="padding:12px 10px 100% 10px !important;font-size:16px !important;">
   Please answer your phone when it rings.
</div>
</div>
<?php
}?>
    </div>

<? }else{
header("Location: /app/home");
}?>
					

					
               
                    <div id="rn_InChatButtonContainer">
					<div class="print_button">
					<!--<rn:widget path="chat/ChatPrintButton" label_print="Print this chat" print_icon_path="/euf/assets/themes/responsive/images/print_chat_transcript.PNG"/>-->
					</div>
					
                    </div>

					
            </div>
		</div>	
</div>

</body>
</html>
