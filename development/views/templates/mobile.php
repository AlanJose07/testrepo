<rn:meta javascript_module="mobile"/>
<? $CI = &get_instance();?>
<!DOCTYPE html>
<html lang="#rn:language_code#">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<rn:theme path="/euf/assets/themes/mobile" css="site.css"/>
<rn:head_content/>
<link rel="icon" href="images/favicon.png" type="image/png">
<script type="text/javascript">
window.addEventListener("load", function() { setTimeout(loaded, 100) }, false);
function loaded() {
	document.getElementById("rn_Navigation").style.visibility = "visible";
	window.scrollTo(0, 1); // pan to the bottom, hides the location bar
}
</script>

</head>
<?php
if($_SERVER['REQUEST_URI']=="/app/mobile/utils/create_account"||$_SERVER['REQUEST_URI']=="/app/mobile/ask"||$_SERVER['REQUEST_URI']=="/app/mobile/account/profile")
	header("Location:/app/home");
$CI = get_instance();
if(getUrlParm('flightNumber') || getUrlParm('tailNumber'))
	{
	
	$CI->session->setSessionData(array('flightNumber' => getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress')));
	
	}
	
 /*Airline Template-Start
if(getUrlParm('flightNumber') || getUrlParm('tailNumber'))  {
	$CI->session->setSessionData(array('airlineCode' => getUrlParm('airlineCode'),'airlineName' => getUrlParm('airlineName'),'flightNumber' => getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress'), client => getUrlParm('client'), page => getUrlParm('pages') ));
}


if(getUrlParm('client')=="video")
{
	  
	header('Location: /app/home/c/73/video/yes');
	exit;
	   
}
 Airline Template-End*/

// determine if the user is coming from the ground site or airborne site.
if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber')) {
	$showContactLink = false;
}
else {
	$showContactLink = true;
}
$redirect_to = $CI->page;
$switch_interface = ($redirect_to == 'answers/detail') ? 'home' : $redirect_to;
 
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

/*Airline Template-Start
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
Airline Template-End*/
	
//Storing first three parameters of flight number
$flgtNo  = substr($flightNumber, 0, 3);

/*Airline Template-Start*/
$video = getUrlParm('video');
$airline = $CI->model('custom/language_model')->getAirline($tailNumber);
	
$filter_airline = array_filter($airline);


if(!empty($filter_airline))
{
	$aline = $filter_airline[0];
	$acpu_type = $filter_airline[1];
}
/*Airline Template-End*/
?>


<body>
<noscript>
<h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
</noscript>
<header role="banner">
  <div class="rn_mob_header">
    <div class="rn_mob_logo"> 
	<!--Airline Template-Start-->
   <?php /*?> <?php 
	if($aline=="AAL" && $acpu_type=="ATG5") 
	{ ?>
      
      <a href="/app/home#rn:session#"><img src="/euf/assets/themes/standard/images/Ameridan_airways.png" alt="Gogo Logo"/></a>
      
      <?php }
	  
	 else { ?><?php */?>
	  <!--Airline Template-End-->
     
    <a href="/app/home"><img src="/euf/assets/images/layout/gogo_cc_logo.png" alt="Gogo Logo" /></a> </div>
    
    <!--Airline Template-Start--> <?php /*?><?php }?><?php */?>  <!--Airline Template-End-->
	 </div>
  </div>
  <rn:condition is_spider="false">
    <nav id="rn_Navigation" role="navigation">
      <div style="width:100%;">
        <div class="rn_FloatLeft" style="margin-top:10px;height:40px;">
          <? if(stristr($CI->page,"home")){ ?>
          <a href="http://airborne.gogoinflight.com"> <img src="images/back-to-gogo_blue.png"/> </a>
          <? } else { ?>
          <a href="/app/home"><img src="images/back-to-gogo_blue.png"/></a>
          <? } ?>
        </div>
        <div class="rn_mob_lan">
          <?php if($flgtNo=="JAL") { ?>
          <a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface, $CI->session->getSessionData('enc_str');?>">
          <div id="language_Navigation">
            <div class="JAP"></div>
            <span style="display:inline-block;">日本語 </span> </div>
          </a>
          <?php } ?>
          <? /*---If the flight number starts with “ACA”, the language toggle is provided in the Aircell site.  ---*/ ?>
          <?php if($flgtNo=="ACA" ) { ?>
          <a href="https://custhelpca.gogoinflight.com/app/<?php echo $switch_interface, $CI->session->getSessionData('enc_str');?>">
          <div id="language_Navigation">
            <div class="FRA"></div>
            <span style="display:inline-block;">Français</span> </div>
          </a>
          <?php } ?>
          <? /*---If the flight number starts with “AMX”, the language toggle is provided in the Aircell site.  ---*/ ?>
          <?php if($flgtNo=="AMX" ) { ?>
          <a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface, $CI->session->getSessionData('enc_str');?>">
          <div id="language_Navigation">
            <div class="SPA"></div>
            <span style="display:inline-block;">Español</span> </div>
          </a>
          <?php } ?>          
        </div>
      </div>
      <div id="rn_NavigationBar" role="navigation" class="rn_MobileNavigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="FAQs" link="/app/home" pages="home"/>
          </li>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="CHAT WITH US" link="/app/chat/chat_launch" pages="chat/chat_launch,chat/chat_landing "/>
          </li>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="SEARCH" link="/app/answers/search" pages="answers/search,answers/list,answers/detail" />
          </li>
        </ul>
      </div>
    </nav>
  </rn:condition>
</header>
<section role="main">
  <rn:page_content/>
</section>
<footer role="contentinfo">
  <div class="rn_FloatLeft"> <a href="javascript:window.scrollTo(0, 0);">#rn:msg:ARR_BACK_TO_TOP_LBL#</a> </div>
  <br>
  <br>
  <div class="rn_Floatleft">
    <ul>
      <li>
        <?php
		// determine if the user is coming from the ground site or airborne site.
		$CI = get_instance();
		
		  if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber'))  {
				 $Link = 'http://buy.gogoinflight.com/upp/terms.do';
		  }  
		  else  {
				$Link = 'http://gogoair.com/gogo/cms/term.do';
		  }  
		  echo "<a href=$Link>Terms of Use</a>";
	?>
      </li>
      <li>
        <?php
		// determine if the user is coming from the ground site or airborne site.
		$CI = get_instance();
		
		  if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber'))  {
				$Link = 'http://buy.gogoinflight.com/upp/privacy.do';
		  }
		  else  {
				$Link = 'http://gogoair.com/gogo/cms/privacy.do';
		  }  
		  echo "<a href=$Link>Privacy and Cookie Policy</a>";
	?>
      </li>
    </ul>
  </div>
  <br>
  <div class="rn_Floatleft"> &copy;<?php echo date("Y") ?>  Gogo LLC. All trademarks are the property of their respective owners.</a></div>
  <br/>
  <!------- End Added ------->
</footer>
</body>
</html>
