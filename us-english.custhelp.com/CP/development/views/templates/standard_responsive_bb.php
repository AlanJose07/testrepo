<?
  if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])){
	$unsupported_browser = "/app/unsupported_browser";
	header('Location: ' . $unsupported_browser);
  }
  //echo 'User IP Address - '. $_SERVER['REMOTE_ADDR'];
   $CI = get_instance();		
   $chat = array("chat"=>" ","url"=>" ");		
   $CI->session->setSessionData($chat);
   $ip = $_SERVER['REMOTE_ADDR'];
   logmessage($ip );
   $out .= sprintf("%u", ip2long($ip));

  if($CI->session->getSessionData('ip_check')){ 
  	  //echo "Taking from session";
  	  //echo " ".$out." "; 
  	  $ip_check = trim($CI->session->getSessionData('ip_check'));		
  }else{
  	  //echo "Model call";
	  $ip_check= $this->model('custom/bbresponsive')->ip_check($out);
	  $ip_check = trim($ip_check);
  }
  $catid= getUrlParm('catid')||0;
  $cateory_id = getUrlParm('catid');
  $contactus_support = $this->uri->router->segments[3];
  if($contactus_support == "answers")
  $contactus_support =  $this->uri->router->segments[3].$this->uri->router->segments[4].$this->uri->router->segments[5].$this->uri->router->segments[7].$this->uri->router->segments[9].$this->uri->router->segments[11];

?>
<?php
 

//---for get quick answer link--//
$home = ($this->uri->router->segments[3] == "home");
$param = (getUrlParm("gethelp") != null) ? getUrlParm("gethelp") : 0;
//---for get quick answer link--//


$curr_url=$_SERVER['REQUEST_URI'];

//---for add to home screen--//
$page_ath="home";
$check_home="N";

if( strpos( $curr_url, $page_ath ) !== false ) 
{
	$check_home="Y";
} 
//---for add to home screen--//

//---for add to detail page--answer feedback--//

if( strpos( $curr_url, "detail") !== false ) 
{
	$detail="1";
} 
else
{
    $detail="0";
}
//---for add to detail page--answer feedback--//

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<rn:widget path="utils/ClickjackPrevention" />
	<rn:widget path="utils/AdvancedSecurityHeaders" content_type_options='nosniff' xss_protection=1  content_security_policy="script-src 'unsafe-inline' 'unsafe-eval'; style-src * 'unsafe-inline'; default-src 'self'; object-src 'none'; child-src 'self'; upgrade-insecure-requests" />
	<meta name="google-site-verification" content="AxrHWkj9UvuL2xLeAehkP25KI14B_-jL_NArYZ50EBc" />
	
<!--Quiq bot starts -->	
	<!--<script src="https://beachbody-stage.quiq-api.com/app/chat-ui/index.js" charset="UTF-8"></script>-->	
	<? $script = \RightNow\Utils\Config::getConfig(1000095); //CUSTOM_CFG_QUIQ_BOT_SCRIPT?>  	
	<script src="<? echo $script; ?>/app/chat-ui/index.js" charset="UTF-8"></script>	
	<!--Quiq bot ends -->
	
	<!-- Decibel - faq.beachbody.com -->
<link rel="dns-prefetch" href="//cdn.decibelinsight.net">
<link rel="dns-prefetch" href="//collection.decibelinsight.net">

<script type="text/javascript">
// <![CDATA[
	(function(d,e,c,i,b,el,it) {
		d._da_=d._da_||[];_da_.oldErr=d.onerror;_da_.err=[];
		d.onerror=function(){_da_.err.push(arguments);_da_.oldErr&&_da_.oldErr.apply(d,Array.prototype.slice.call(arguments));};
		d.DecibelInsight=b;d[b]=d[b]||function(){(d[b].q=d[b].q||[]).push(arguments);};
		el=e.createElement(c),it=e.getElementsByTagName(c)[0];el.async=1;el.src=i;it.parentNode.insertBefore(el,it);
	})(window,document,'script','https://cdn.decibelinsight.net/i/13996/612538/di.js','decibelInsight');
// ]]>
</script>

<rn:widget path="custom/ResponsiveDesign/ErrorRedirection" />
<? $cookie_consent = \RightNow\Utils\Config::getConfig(1000063); //CUSTOM_CFG_COOKIE_CONSENT_NOTICE 
   $cookieid = \RightNow\Utils\Config::getMessage(CUSTOM_MSG_OSANA_COOKIE_ID);
?>  
<? if($cateory_id): ?>
<? //to remove index from google for disabled categories also make the page not found if it is disabled ?>
<? $enable_disable = $this->model('custom/bbresponsive')->get_enabled_category($cateory_id,$contactus_support);  ?>
<? endif; ?>
<? if($enable_disable == 2 && ($contactus_support=="contactus_support" || $contactus_support=="gethelp" || $contactus_support=="contactus_sub_level" || $contactus_support=="answersdetaila_idcatidcatnmeTLP")): ?>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<?php
$url = "/app/pagenotfound";
 header('Location: ' . $url);
?>
<? endif; ?>

<? if(strpos($_SERVER['REQUEST_URI'], 'contactus_support_chat') !== false): ?>
<META NAME="robots" CONTENT="noindex, nofollow">
<rn:meta noindex="true"/>
<? else: ?>
<META NAME="robots" CONTENT="index, follow">
<? endif; ?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">  

<meta http-equiv="cache-control" content="max-age=0" />		
<meta http-equiv="cache-control" content="no-cache" />		
<meta http-equiv="expires" content="-1" />		
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />		
<meta http-equiv="pragma" content="no-cache" />

<!--ensure the correct interface is returned in search results based on the user's country - start-->
<link rel="alternate" hreflang="en-gb" href="https://uk-english--tst2.custhelp.com" />
<link rel="alternate" hreflang="en-ca" href="https://canada-english--tst2.custhelp.com" />
<link rel="alternate" hreflang="fr-ca" href="https://canada-french--tst2.custhelp.com" />
<link rel="alternate" hreflang="es-us" href="https://us-spanish--tst2.custhelp.com/" />
<link rel="alternate" hreflang="x-default" href="https://us-english--tst2.custhelp.com" /> 
<!--ensure the correct interface is returned in search results based on the user's country - end-->

<!--ADD TO HOME SCREEN-->

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Beachbody Support">
<!--ADD TO HOME SCREEN-->

<title>Beachbody</title>
<link href="/euf/assets/themes/responsive/css/beachbody.min.css" rel="stylesheet">
<link href="/euf/assets/themes/responsive/css/icon.min.css" rel="stylesheet">
<link rel="stylesheet" href="/euf/assets/themes/responsive/css/slick.min.css">


<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/contact_us_phase2.css" />


<!--ADD TO HOME SCREEN-->
 

<link rel="shortcut icon" type="image/png" sizes="192x192"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
	
	
<link rel="apple-touch-icon" sizes="192x192" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
<link rel="apple-touch-icon" sizes="180x180" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_180x180_Blue.png">
<link rel="apple-touch-icon" sizes="152x152" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_152x152_Blue.png">
<link rel="apple-touch-icon" sizes="144x144" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_144x144_Blue.png">
<link rel="apple-touch-icon" sizes="120x120" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_120x120_Blue.png">
<link rel="apple-touch-icon" sizes="114x114" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_144x144_Blue.png">

<link rel="apple-touch-icon" sizes="76x76" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_76x76_Blue.png">
<link rel="apple-touch-icon" sizes="72x72" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_72x72_Blue.png">
<link rel="apple-touch-icon" sizes="60x60" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_60x60_Blue.png">

<link rel="apple-touch-icon" sizes="58x58" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_58x58_Blue.png">
<link rel="apple-touch-icon" sizes="57x57" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_57x57_Blue.png">



<link rel="icon" type="image/png" sizes="192x192"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
<link rel="icon" type="image/png" sizes="96x96" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_96x96_Blue.png">
<link rel="icon" type="image/png" sizes="58x58" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_58x58_Blue.png">
<link rel="icon" type="image/png" sizes="57x57" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_57x57_Blue.png">
<link rel="icon" type="image/png" sizes="32x32" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_32x32_Blue.png">
<link rel="icon" type="image/png" sizes="16x16" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_16x16_Blue.png">

  

<!-- <link rel="manifest" href="/euf/assets/images/mobile-icons/manifest.json"> -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

         
<link rel="apple-touch-icon-precomposed" sizes="192x192" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_180x180_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_152x152_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_144x144_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_120x120_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_144x144_Blue.png">

<link rel="apple-touch-icon-precomposed" sizes="76x76" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_76x76_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_72x72_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_60x60_Blue.png">

<link rel="apple-touch-icon-precomposed" sizes="58x58" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_58x58_Blue.png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/euf/assets/themes/mobile/images/BB_Support_Stacked_57x57_Blue.png">
	

<rn:widget path="utils/CobrowsePremium" />
<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/addtohomescreen.css" />
<!--ADD TO HOME SCREEN-->


<link href="/euf/assets/themes/responsive/css/style.css" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
		.d-none{display: none;} 
		.hamburger-menu nav ul li a .c-button--dropdown:hover, .hamburger-menu nav ul li a .c-button--dropdown:hover:after {
		    color: #fff;

		}
		.hamburger-menu nav ul li .c-dropdown.js-dropdown.is-open ul.c-dropdown__list{
			position: relative;
		}
		.banner-ontents{
			z-index: 0;
		}
		@media only screen and (max-width: 1199px){
			.hamburger-menu nav ul li .c-dropdown.js-dropdown.is-open ul.c-dropdown__list li {
			    line-height: 36px;
			}
			.hamburger-menu nav.res-menu > ul{
			    background: #111;
			}
		} 
		@media only screen and (max-width: 767px){
			.hamburger-menu nav ul li a, .c-dropdown__item{
			    font-size: 15px !important;
			}
			.c-dropdown.js-dropdown.is-open {
			    left: 22px;
			} 
		}
		@media only screen and (min-width: 768px){
			.hamburger-menu nav ul li .c-dropdown.js-dropdown.is-open ul.c-dropdown__list {
			    z-index: 9;
			    top: 109%;
			    left: -1rem;
			    position: absolute;
			} 
		}
		
		@media only screen and (max-width: 600px) {	
		.cont-button	
		{	
		flex-direction: column;	
		display: flex;	
    			justify-content: center;	
    			column-gap: 5px;	
		}	
		.quiq-chat	
		{	
		margin-bottom:10px;	
		}	
		footer {	
			height : unset;	
			min-height: 100px;	
		/*height : fit-content;	
		padding: 100px 0px 0px 0px;	
		height: 200px;*/	
		}	
		}

	</style>
</head>

<body class="v-scroll">

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

<!--ADD TO HOME SCREEN-->
<script src="/euf/assets/js/addtohomescreen.js"></script>

<script>
  
  //Add to some screen popup will display only in home page at the initial time.After that it won't display
  //After clearing the web cache the popup will show again
  //initially the value of "localStorage.getItem('first')" will be null and once the popup comes the value will
  // set as "nope"
  
  var is_home_page='<?php echo $check_home ;?>';
  
  
	var mobile = 1;//web
		
	if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) 
	{
		mobile = 2;//mobile
	}
	
	/* alert("local--"+localStorage.getItem('first'));
	 alert("mobile--"+mobile);
	 alert("home-"+is_home_page);
	 */
  if(  ( mobile==2 ) && (is_home_page=="Y") && (localStorage.getItem('first') === null) )
  {
	localStorage.setItem('first','nope');
	
	var ath = addToHomescreen({
	   // debug: 'android',           // activate debug mode in ios emulation
		skipFirstVisit: false,	// show at first access
		startDelay: 0,          // display the message right away
		lifespan: 0,            // do not automatically kill the call out
		displayPace: 0,         // do not obey the display pace
		privateModeOverride: true,	// show the message in private mode
		maxDisplayCount: 0 ,     // do not obey the max display count
		autostart: true	
	});
 }
	
</script>

				
 <!--ADD TO HOME SCREEN-->
 
<div class="full-wrapper">  
<!-- Header -->
<div class="hamburger-menu">
  <div class="container">
    <div class="row">
    <rn:condition hide_on_pages="answers/Australia,answers/Australia_details">
      <div class="col-md-12 col-sm-12 col-lg-1 col-xs-12 txt-center-mob-tab">
        <div class="logo"><a href="/app/home"> <img src="/euf/assets/themes/responsive/images/logo.png"></a></div>
      </div>
    </rn:condition>
	<rn:condition show_on_pages="answers/Australia,answers/Australia_details">
	  <div class="col-md-12 col-sm-12 col-lg-1 col-xs-12 txt-center-mob-tab">
        <div class="logo"><img src="/euf/assets/themes/responsive/images/logo.png"></div>
      </div>
	</rn:condition>
	  <rn:condition hide_on_pages="answers/Australia,answers/Australia_details">
      <div class="col-md-12 col-sm-12 col-lg-11 col-xs-12 ">
	  	<div class="login-btn-custom sign-in">		
            		
                 <rn:condition logged_in="false"> 		
                        <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?> 		     			
                  </rn:condition>   		
                       <div class = "sign-out-mobile">		
				        <rn:condition logged_in="true">		
						<rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Sign Out" id="logout"/>   		
						</rn:condition>		
					   </div>		
         </div>
		 
		<div class="my-order-btn">
		<a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">My Orders</a>
		</div>
		
        <div class="menu-tigger"> <span></span> <span></span> <span></span> </div>
        <nav>
          <ul>
            <li><a href="https://www.beachbodyondemand.com/" onClick="click_tracking('Menu Links - BOD')">Beachbody On Demand</a></li>
            <li><a href="https://coach.teambeachbody.com" onClick="click_tracking('Menu Links - Coach Office')">Coach Office</a></li>
            <li><a href="https://www.teambeachbody.com/shop/us/coach?locale=en_US&destPage=coach" onClick="click_tracking('Menu Links - Become Coach')">Become a Coach</a></li>
            <li><a href="https://beachbodyondemand.com/groups" onClick="click_tracking('Menu Links - BODgroups')">BODgroups</a></li>
            <li><a href="https://community.beachbody.com/s/" onClick="click_tracking('Menu Links - Community')">Community</a></li>      
            <li><a href="https://www.teambeachbody.com/shop/us/b" onClick="click_tracking('Menu Links - Shop')">Shop</a></li>
			<li class="hide-mobile-only"><a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">My Orders</a></li> 
			<li class="nav_li"><a href="#" class="nav_link">
           <div class="c-dropdown js-dropdown">
                <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
                <img src="" id = "selectedFlag">
                <span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US (ENGLISH)</span>
                <ul class="c-dropdown__list">
				
                  <li  onclick="location.href='https://us-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="English" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ENGLISH)</li>
				  
				   <li  onclick="location.href='https://us-spanish--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Spanish" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ESPAÑOL)</li>
				  
                  <li  onclick="location.href='https://canada-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (ENGLISH)</li>
				  
				  <li  onclick="location.href='https://canada-french--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (FRANÇAIS)</li>
				  
                  <li onClick="location.href='https://uk-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="UK" imageName ="/euf/assets/themes/responsive/images/uk.png"><img src="/euf/assets/themes/responsive/images/uk.png">UK (ENGLISH)</li>
				  
				 <li onClick="location.href='https://france-french--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="FRANCE" imageName ="/euf/assets/themes/responsive/images/france.png"><img src="/euf/assets/themes/responsive/images/france.png">FRANCE (FRANÇAIS)</li>
				  
                </ul>
              </div>   
              </a></li>
			<li>		
				<div class="hide-on-mobile">      		
					 <rn:condition logged_in="false">          		
                       <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?> 		     		
					</rn:condition>	  		
					                              		
				</div>		
			    <rn:condition logged_in="true">		
				<rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Sign Out" id="logout"/>	
				</rn:condition>       		
			</li>
			
          </ul>
        </nav>
      </div>
    </div>
 </rn:condition> 
  </div>
</div>
<!-- End Header --> 



<!-- Search Banner -->

<rn:condition show_on_pages="home">
<section class="banner">
</rn:condition>
<rn:condition hide_on_pages="home">
<section class="banner inner-banner">
</rn:condition>

  <div class="banner-overlay"></div>
  <div id="tt" style="display:none"></div>
 <rn:condition hide_on_pages="answers/Australia,answers/Australia_details">
  <div class="container-fluid">
    <div class="inner-nav row  d-none"> 
	
      <div class="container"> 
	  <rn:condition show_on_pages="home">
	  <a class="navbar-brand">Support</a>
	  </rn:condition>
	   <rn:condition hide_on_pages="home">
	  <a class="navbar-brand" href="/app/home" onClick="click_tracking('Support')">Support</a>
	  </rn:condition>
        <nav>
           <!--<div id="collapsed_nav" class="hamburger"> <span class="line"></span> <span class="line"></span> <span class="line"></span> </div>--> 
            <div id="collapsed_nav"><a class="arrow-icon">
  <span class="left-bar"></span>
  <span class="right-bar"></span>
</a></div>
            
          <ul id="nav_ul">
           <li class="nav_li">
			<rn:condition hide_on_pages="contactus,contactus_support,contactus_sub_level,chat_mobile">
			<? if ($home) { ?>
				<a href="/app/contactus" class="nav_link" id="gethelplink" onClick="click_tracking('CONTACT SUPPORT')">CONTACT SUPPORT</a>   
			<? } else {  ?>
				<a href="/app/contactus" class="nav_link"  onClick="click_tracking('CONTACT SUPPORT')">CONTACT SUPPORT</a>
			<? } ?>
			</rn:condition>
			</li>
            <li class="nav_li"><a href="#" class="nav_link">
           <div class="c-dropdown js-dropdown">
                <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
                <img src="" id = "selectedFlag">
                <span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US (ENGLISH)</span>
                <ul class="c-dropdown__list">
				
                  <li  onclick="location.href='https://us-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="English" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ENGLISH)</li>
				  
				   <li  onclick="location.href='https://us-spanish--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Spanish" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ESPAÑOL)</li>
				  
                  <li  onclick="location.href='https://canada-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (ENGLISH)</li>
				  
				  <li  onclick="location.href='https://canada-french--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (FRANÇAIS)</li>
				  
                  <li onClick="location.href='https://uk-english--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="UK" imageName ="/euf/assets/themes/responsive/images/uk.png"><img src="/euf/assets/themes/responsive/images/uk.png">UK (ENGLISH)</li>
				  
				 <li onClick="location.href='https://france-french--tst2.custhelp.com/app/home';" class="c-dropdown__item" data-dropdown-value="FRANCE" imageName ="/euf/assets/themes/responsive/images/france.png"><img src="/euf/assets/themes/responsive/images/france.png">FRANCE (FRANÇAIS)</li>
				  
                </ul>
              </div>   
              </a></li>
          </ul>
        </nav>
      </div>
    </div>
	</rn:condition>
    <div class="banner-ontents">
	
	<rn:condition logged_in="false">
      <h1>Welcome to Beachbody Support</h1>
	  <rn:condition_else/>		
	   <h1><?php echo "Hi ".$this->session->getProfile()->first_name->value.", Welcome to Beachbody Support" ?></h1>		
	   </rn:condition>
	   
      <div class="search-wrap">
         <form class="form-horizontal" onSubmit="return false;">
            <rn:container report_id="176">
            <div class="form-group form-group-md">
              <rn:widget path="custom/ResponsiveDesign/KeywordText" label_text="" label_placeholder="Enter a question or FAQ#" initial_focus="false"/>
              <span class="input-group-btn">
              <rn:widget path="search/SearchButton" report_page_url="/app/answers/list"/>
              </span> </div>
             </rn:container>
        </form>
      </div>
    </div>    
  </div>
</section>
<!-- End Search Banner --> 


<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- The below code contains a hidden field and a script. This is used to set the top level parent information[category name and id of the home and contact us page]. Initially in the home page the value of the hidden field is set to no value. After clicking the category from the home or contact us, its URL will contain the mentioned information in the parameter TLP. By using the script the information in the TLP is set to the hidden field.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<input type="hidden" name="parent_category_id" id="parent_category_id">
<script src="/euf/assets/themes/responsive/js/settoplevelparent.js"></script>
<input type="hidden" name="stickyclass_hide_show" id="stickyclass_hide_show">
<input type="hidden" name="stickyclass_hide_show_answerlist" id="stickyclass_hide_show_answerlist" value="1">

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                    The above code explanation is at the starting of the code.**by jithin jose ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<!-- Bread Crumb -->
<rn:condition hide_on_pages="list_generic">
<section>
    <div class="container">
      <div class="row">
        <!--<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="#">Get Help And Learn</a> </span> <span class="breadcrumb"> My Shakeology </span> </div>-->
		<rn:widget path="custom/ResponsiveDesign/CustomBreadCrumb" />
      </div>
    </div>
  </section>
</rn:condition> 
<!-- End Bread Crumb -->
<!-- Contents -->
<rn:condition show_on_pages="home">
<div class="content-wrapper" id="OPA">
</rn:condition>
<rn:condition hide_on_pages="home,contactus">
<div class="content-wrapper inner-content-wrapper" id="OPA">
</rn:condition>           
<rn:page_content/>

<rn:widget path="custom/ResponsiveDesign/ServiceAlert" />
<? $shadowpopup = \RightNow\Utils\Config::getConfig(1000060); //CUSTOM_CFG_SHADOW_POPUP?>  
<? if($shadowpopup): ?>
<rn:widget path="custom/ResponsiveDesign/ShadowPopupContactus" />
<? endif; ?>
</div>
<div class="push"></div>
</div>
<!-- End Contents --> 

<!-- Footer -->
<footer class="opa-footer-fix">
  <div class="container opa-footer-fix-container">
    <div class="row">
	 <rn:condition show_on_pages="home,gethelp,answers/detail,answers/list,answers/list_generic,answers/most_popular_answers">
      <div class="cont-button">
	 
<!--Quiq bot starts -->	
<script>	
  		var chat = Quiq({	
   		pageConfigurationId: 'web-chat'	
 		});	
	 </script>	
	 <style>	
      .quiq_pointer {	
         cursor: pointer;	
      }	
	  .bot_img {	
		width : 30px;	
	  }	
	  </style>	
	  <? $quiqbot = \RightNow\Utils\Config::getConfig(1000096); //CUSTOM_CFG_QUIQ_BOT?>  	
		
	  <? if($quiqbot): ?>	
		<a class="quiq-chat quiq_pointer" onClick="click_tracking('Chat Now')"><img src="/euf/assets/images/chat.png" class="bot_img"> Chat Now</a> <?$nbsp;$nbsp;$nbsp;?> 	
		 	
      <a href="/app/contactus" onClick="click_tracking('Contact Us')">Contact Options</a> 	
	  <? else: ?>	
		<a href="/app/contactus" onClick="click_tracking('Contact Us')">Contact Us</a> 	
	  <? endif; ?>	
	 <!--Quiq bot ends -->
       
      </div>
	  </rn:condition> 

	  <rn:condition show_on_pages="answers/Australia,answers/Australia_details">
      <div class="cont-button">
	 
      <a href="mailto:australia@custhelp.com" >Email Us</a> 
       
      </div>
	  </rn:condition> 

	  <? if($ip_check == 'FR' || $ip_check == 'GB'): ?>
	  <? if($cookie_consent): ?>
	   <style>
		footer {
			height: 124px;
		}
		.cont-button{
			padding: 20px 0 29px 0px;
		}

	  </style>
	  <div class = "manage-cookies-opa-fix">
	  <a href="javascript:void(0);" class="manage-cookies" onClick="click_tracking('Manage Cookies')">Manage Cookies</a> 
	  </div>
	  <? endif; ?>
	  <? endif; ?>
	  </div>
  </div>       
</footer>
<!-- End Footer -->

<script type="text/javascript" src="https://nebula-cdn.kampyle.com/wu/384315/onsite/embed.js" async></script>

</body>

<script src="/euf/assets/themes/responsive/js/slick.min.js"></script>
<script src="/euf/assets/themes/responsive/js/beachbody.min.js"></script>
<script src="/euf/assets/themes/responsive/js/nav.js"></script>
<script src="/euf/assets/themes/responsive/js/form.js"></script>

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

var param = <?=$param;?>;
var detail = <?=$detail;?>;

$(document).ready(function() {
 
var doc_height=$(document).height();
var win_height=$(window).height();
var doc_win_diff=doc_height-win_height;

document.getElementById("stickyclass_hide_show").value=doc_win_diff+"-"+$('.inner-nav').height();

if(detail=="1")
{
  $('body').addClass("yui-skin-sam");
  $('body').addClass("yui3-skin-sam");
}
else
{
  $('body').removeClass("yui-skin-sam");
  $('body').removeClass("yui3-skin-sam");
}


	if (param == 1) {
		scrollToGetHelp();   
	}
	
});

function scrollToGetHelp() {
if(screen.width<=768)
    {
	   
	$('html,body').animate({scrollTop:$(".get-help").offset().top-200}, 1000);   
	}
	else
	{
	
	$('html,body').animate({scrollTop:$(".get-help").offset().top-100}, 1000);
	}
}


function changeorientation()
  {
	  var doc_height=$(document).height();
      var win_height=$(window).height();
      var doc_win_diff=doc_height-win_height;
      document.getElementById("stickyclass_hide_show").value=doc_win_diff+"-"+$('.inner-nav').height();
  } 
  
 // Listen for orientation changes
window.addEventListener("orientationchange", function() {
  // Announce the new orientation number
  if(window.orientation==0)
  {
	  changeorientation();
  }
  else if(window.orientation==90)
  {
	  changeorientation(); 
  }
  else if(window.orientation==-90)
  {
	   changeorientation();
  }
}, false);

</script>
<script>

$(document).ready(function(){
		// Change Osano banner's text content; will delete once Osano corrects it on their end
		if (window.Osano) {
			 window.Osano.cm.addEventListener("osano-cm-initialized", function (consentObject) {
				var manageCookies = $('<a></a>').attr({
				'href': 'javascript:void(0);', 'target': '_self', 'title': 'Manage Cookies',
				'class': 'osano-cm-link open-manage-cookie'
				});
				var userBrowserLanguage = window.navigator.language || window.navigator.userLanguage;
				var cookiesText = userBrowserLanguage == 'fr' ? 'Gérer les cookies' : (userBrowserLanguage == 'es' ? 'Administrar cookies' : 'Manage Cookies');
				//var cookiesText = 'Manage Cookies';
				$(manageCookies).text(cookiesText);
				$(manageCookies).css('margin-left', '10px');
				var layerOneText = $("span.osano-cm-content__message").text();
				layerOneText = layerOneText
				.replace("functionality, including analytics", "functionality, as well as analytics")
				.replace("y compris l'analyse", "ainsi que l'analyse");
				// For a complete text change, use this to override:
				// layerOneText = '';
				$("span.osano-cm-content__message").text(layerOneText);
				$("a.osano-cm-storage-policy").after(manageCookies);
				$("div.osano-cm-window__dialog").show();
			});
		}
		// Triggering Osano Cookies Preferences drawer to open
		//$(".open-manage-cookie").click(function() {
		$(document).on('click','.open-manage-cookie',function(){
			window.Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
		});
        $(".manage-cookies").click(function() {
            Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
        });
});


function click_tracking(text,catid = 0,ans_views = 0) {
	var page_url = String(window.location.href);
	if(catid == 0)
	{
		var exploded_url = page_url.split('/');
		var cat_id_index = exploded_url.indexOf('catid');
		catid = exploded_url[cat_id_index+1];
	}
	
	var mobile = 1;
	var clicked_link = String(text);
	try {
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			mobile = 2;
		}
	}
	catch(err)
	{}
	try
	{
		
		$.ajax({
		   url: '/cc/bbresponsivecontroller/click_tracking',  
		   data:  {url: page_url, mob: mobile, click_text: clicked_link, cat_id:catid, ans_view:ans_views},
		   async:false,
		   dataType: "json", 
		   type: "POST",
			  success: function(data) { 
			 /*ajaxResult=data;
			 alert("success");*/
			}
			  
			});
		
	}
	catch(err2)
	{
		
	}
	
}

</script>
<? if($ip_check == 'FR' || $ip_check == 'GB'): ?>
<? if($cookie_consent): ?>
<script src="https://cmp.osano.com/AzZcuESCJWcN06dnY/<? echo $cookieid; ?>/osano.js"></script>
<? endif; ?>
<? endif; ?>



</html>
