<?php
  if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~',$_SERVER['HTTP_USER_AGENT'])){
	$unsupported_browser = "/app/unsupported_browser";
	header('Location: ' . $unsupported_browser);
  }
  //echo 'User IP Address - '. $_SERVER['REMOTE_ADDR'];
   $CI = get_instance();		
   $chat = array("chat"=>" ","url"=>" ");		
   $CI->session->setSessionData($chat);
   $ip = $_SERVER['REMOTE_ADDR'];
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
  $cateory_id = getUrlParm('catid');
  $contactus_support = $this->uri->router->segments[3]; 
  if($contactus_support == "answers")
  $contactus_support =  $this->uri->router->segments[3].$this->uri->router->segments[4].$this->uri->router->segments[5].$this->uri->router->segments[7].$this->uri->router->segments[9].$this->uri->router->segments[11];
//---for get quick answer link--//
$home = ($this->uri->router->segments[3] == "home");
$param = (getUrlParm("gethelp") != null) ? getUrlParm("gethelp") : 0;
//---for get quick answer link--//


$curr_url=$_SERVER['REQUEST_URI'];

//---for add to home screen--..//
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
<meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1, maximum-scale=1, user-scalable=0">   

<meta http-equiv="cache-control" content="max-age=0" />		
<meta http-equiv="cache-control" content="no-cache" />		
<meta http-equiv="expires" content="-1" />		
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />		
<meta http-equiv="pragma" content="no-cache" />

<!--ADD TO HOME SCREEN-->

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Beachbody Support">
<!--ADD TO HOME SCREEN-->

<title>Beachbody</title>
<link href="/euf/assets/themes/responsive/css/beachbody.min.css" rel="stylesheet">
<link href="/euf/assets/themes/responsive/css/style_site.css" rel="stylesheet">
<link href="/euf/assets/themes/responsive/css/icon.min.css" rel="stylesheet">
<link rel="stylesheet" href="/euf/assets/themes/responsive/css/slick.min.css">


<link type="text/css" rel="stylesheet" href="/euf/assets/themes/responsive/css/contact_us_phase2.css" />
<rn:widget path="utils/CobrowsePremium" />

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
	


<link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/addtohomescreen.css" />
<!--ADD TO HOME SCREEN-->





<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
.banner {
	z-index: 0 !important;
}
.d-none{display: none;}
.hamburger-menu nav ul li a .c-button--dropdown:hover, .hamburger-menu nav ul li a .c-button--dropdown:hover:after {
color: #fff;
}
.hamburger-menu nav ul li .c-dropdown.js-dropdown.is-open ul.c-dropdown__list{
position: relative;
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
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<body class="v-scroll">
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
      <div class="col-md-12 col-sm-12 col-lg-1 col-xs-12 txt-center-mob-tab"> <!-- SSO related codes -->
        <div class="logo"><a href="/app/home"> <img src="/euf/assets/themes/responsive/images/logo.png"></a></div>
      </div>
       <!-- SSO related codes -->
	  <div class="col-md-12 col-sm-12 col-lg-11 col-xs-12 ">
	  
	   <div class="login-btn-custom sign-in">
            
                 <rn:condition logged_in="false"> 
				 <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?> 		 
                        
                  </rn:condition>   
                       <div class = "sign-out-mobile">
				       <rn:condition logged_in="true">
						<rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Cerrar sesión" id="logout"/>   
						</rn:condition>
					   </div>
        	  </div>
			  
		<div class="my-order-btn">
		<a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">Mis Pedidos</a>
		</div>
			  
		<!-- SSO related codes -->
        <div class="menu-tigger"> <span></span> <span></span> <span></span> </div>
        <nav>
          <ul>
            <li><a href="https://www.beachbodyondemand.com/" onClick="click_tracking('Menu Links - BOD')">Beachbody On Demand</a></li>
            <li><a href="https://coach.teambeachbody.com/esus/signin-es" onClick="click_tracking('Menu Links - Coach Office')">Oficina de Coach</a></li>
            <li><a href="https://www.teambeachbody.com/shop/us/coach?locale=es_US&destPage=coach" onClick="click_tracking('Menu Links - Become Coach')">Conviértete  en Coach</a></li>
            <li><a href="https://beachbodyondemand.com/groups" onClick="click_tracking('Menu Links - BODgroups')">BODgroups</a></li>
            <li><a href="https://community.beachbody.com/s/" onClick="click_tracking('Menu Links - Community')">Comunidad</a></li>      
            <li><a href="https://www.teambeachbody.com/shop/us/b" onClick="click_tracking('Menu Links - Shop')">Tienda</a></li> 
			<li class="hide-mobile-only"><a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">Mis Pedidos</a></li>

			<li class="nav_li"><a href="#" class="nav_link">
			<div class="c-dropdown js-dropdown">
			<input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
			<img src="" id = "selectedFlag">
			<span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US (ESPAÑOL)</span>
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

			<!-- SSO related codes -->	
			<li>
				<div class="hide-on-mobile">      
					 <rn:condition logged_in="false">          
                         <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?> 		  
					</rn:condition>	  
					<rn:condition logged_in="true">
						<rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Cerrar sesión" id="logout"/>   
						</rn:condition>
					                              
				</div>
						
				       
			</li>
			<!-- SSO related codes -->	
          </ul>
        </nav>
      </div>
    </div>
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
  <div class="container-fluid">
    <div class="inner-nav row d-none">
	
      <div class="container"> 
	  <rn:condition show_on_pages="home">
	  <a class="navbar-brand">Soporte</a>
	  </rn:condition>
	   <rn:condition hide_on_pages="home">
	  <a class="navbar-brand" href="/app/home" onClick="click_tracking('Support')">Soporte</a>
	  </rn:condition>
        <nav>
           <!--<div id="collapsed_nav" class="hamburger"> <span class="line"></span> <span class="line"></span> <span class="line"></span> </div>--> 
            <div id="collapsed_nav"><a class="arrow-icon">
  <span class="left-bar"></span>
  <span class="right-bar"></span>
</a></div>
            
          <ul id="nav_ul">
            <li class="nav_li">
			<rn:condition hide_on_pages="contactus,contactus_support,contactus_sub_level">
			<? if ($home) { ?>
				<a href="/app/contactus" class="nav_link" id="gethelplink" onClick="click_tracking('CONTÁCTANOS')">CONTÁCTANOS</a>
			<? } else { ?>
				<a href="/app/contactus" class="nav_link"  onClick="click_tracking('CONTÁCTANOS')">CONTÁCTANOS</a>
			<? } ?>
			</rn:condition>
			</li>
            <li class="nav_li"><a href="#" class="nav_link">    
           <div class="c-dropdown js-dropdown">
                <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
                <img src="" id = "selectedFlag">
                <span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US (ESPAÑOL)</span>
                <ul class="c-dropdown__list">
				
				     <li  onclick="location.href='https://faq.beachbody.com/app/home';" class="c-dropdown__item" data-dropdown-value="English" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ENGLISH)</li>
				  
				   <li  onclick="location.href='https://faq.es.beachbody.com/app/home';" class="c-dropdown__item" data-dropdown-value="Spanish" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US (ESPAÑOL)</li>
				  
                  <li  onclick="location.href='https://faq.beachbody.ca/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (ENGLISH)</li>
				  
				  <li  onclick="location.href='https://faq.fr.beachbody.ca/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (FRANÇAIS)</li>
				  
                  <li onClick="location.href='https://faq.beachbody.co.uk/app/home';" class="c-dropdown__item" data-dropdown-value="UK" imageName ="/euf/assets/themes/responsive/images/uk.png"><img src="/euf/assets/themes/responsive/images/uk.png">UK (ENGLISH)</li>
				  
				  <li onClick="location.href='https://faq.beachbody.fr/app/home';" class="c-dropdown__item" data-dropdown-value="FRANCE" imageName ="/euf/assets/themes/responsive/images/france.png"><img src="/euf/assets/themes/responsive/images/france.png">FRANCE (FRANÇAIS)</li>
				  
                </ul>
              </div>
			 <!-- <div class="flag_menu">
    <select name="countries" id="countries">
	  <option value='canada' data-image="url(/euf/assets/themes/responsive/images/us.svg)" selected>USA</option>
      <option value='usa' data-image="/euf/assets/themes/responsive/images/ca.svg" >CANADA</option>
      <option value='uk' data-image="/euf/assets/themes/responsive/images/gb.svg" >UK</option>
    </select>
  </div>-->
			  
              </a></li>
          </ul>
        </nav>
      </div>
    </div>
	
    <div class="banner-ontents">
	 <!-- SSO related work -->
	  <rn:condition logged_in="false">
      <h1>Bienvenido a Soporte de Beachbody</h1>
	  <rn:condition_else/>
	   <h1><?php echo "Hola ".$this->session->getProfile()->first_name->value.", Bienvenido a Soporte de Beachbody" ?></h1>
	   </rn:condition>
	  <!-- SSO related work -->
      <div class="search-wrap">
         <form class="form-horizontal" onSubmit="return false;">
            <!--<rn:container report_id="176">-->
            <rn:container report_id="143299">
            <div class="form-group form-group-md">
              <rn:widget path="search/KeywordText" label_text="" label_placeholder="Ingresa tu pregunta o FAQ#" initial_focus="false"/>
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
	 
      <a href="/app/contactus" onClick="click_tracking('Contáctanos')">Contáctanos</a> 
       
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
	  <a href="javascript:void(0);" class="manage-cookies" onClick="click_tracking('Manage Cookies')">Administrar cookies</a> 
	  </div>
	  <? endif; ?>
	  <? endif; ?>
     <!-- <p>© 2018 Beachbody, LLC. All Rights Reserved.</p>
      <span>Beachbody, LLC is the owner of the Beachbody and Team Beachbody trademarks, and all related designs, trademarks, copyrights, and other intellectual property.</span> -->
	  </div>
  </div>
</footer>
<!-- End Footer -->

<script type="text/javascript" src="https://nebula-cdn.kampyle.com/wu/384315/onsite/embed.js" async></script>

</body>
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
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
	
  // if (window.matchMedia("(orientation: portrait)").matches) {
  // alert("hii");  
   // } 
</script>

<script>

var param = <?=$param;?>;
var detail = <?=$detail;?>;

$(document).ready(function() {
/*if( navigator.userAgent.indexOf("Safari") > -1 ){
   alert('Safari');
  }
  else
  {
    alert("hii");    
  }*/
 
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
	
	/*$("#gethelplink").click(function() {
		scrollToGetHelp();
	});*/
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


try
{
	$('.message-close').on('click', function(e) {
	  $('.message').hide();//addClass('close');
	  try
	  {
	  	console.log("checking service alert");
	  	localStorage.setItem("service_alert_sessions", 2);
	  	//sessionStorage.setItem("service_alert_session",2);
		//var ss = sessionStorage.getItem("service_alert_session");
	  	//document.getElementById('sa_session_val').value = 2;
	  }
	  catch(err_inner)
	  {}
	})
}
catch(err)
{

}

</script>
<script>

$(document).ready(function(){
		var policyLink = jQuery('.osano-cm-storage-policy');
		policyLink.attr('href', 'https://www.teambeachbody.com/shop/us/privacy?locale=es_US');
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
		$(document).on('click','.open-manage-cookie',function(){
			window.Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
		});
        $(".manage-cookies").click(function() {
            Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
        });
});



function click_tracking(text,catid = 0,ans_views = 0) {
	//alert("clicked --"+text);
	var page_url = String(window.location.href);
	if(catid == 0)
	{
		var exploded_url = page_url.split('/');
		var cat_id_index = exploded_url.indexOf('catid');
		catid = exploded_url[cat_id_index+1];
	}
	//alert(page_url);
	var mobile = 1;
	var clicked_link = String(text);
	//alert(page_url);
	//alert(clicked_link);
	
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
			 ajaxResult=data;
			  //alert("success");
			}
			  
			});
	}
	catch(err2)
	{
		//alert("check console");
		console.log(err2);
	}
	
}

</script>
<? if($ip_check == 'FR' || $ip_check == 'GB'): ?>
<? if($cookie_consent): ?>
<script src="https://cmp.osano.com/AzZcuESCJWcN06dnY/<? echo $cookieid; ?>/osano.js"></script>
<? endif; ?>
<? endif; ?>
</html>
