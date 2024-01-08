<?
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || preg_match('~Trident/7.0(; Touch)?; rv:11.0~', $_SERVER['HTTP_USER_AGENT'])) {
  $unsupported_browser = "/app/unsupported_browser";
  header('Location: ' . $unsupported_browser);
}
//echo 'User IP Address - '. $_SERVER['REMOTE_ADDR'];
$CI = get_instance();
$chat = array("chat" => " ", "url" => " ");
$CI->session->setSessionData($chat);
$ip = $_SERVER['REMOTE_ADDR'];
logmessage($ip);
$out .= sprintf("%u", ip2long($ip));

if ($CI->session->getSessionData('ip_check')) {
  //echo "Taking from session";
  //echo " ".$out." "; 
  $ip_check = trim($CI->session->getSessionData('ip_check'));
} else {
  //echo "Model call";
  $ip_check = $this->model('custom/bbresponsive')->ip_check($out);
  $ip_check = trim($ip_check);
}
$catid = getUrlParm('catid') || 0;
$cateory_id = getUrlParm('catid');
$contactus_support = $this->uri->router->segments[3];
if ($contactus_support == "answers")
  $contactus_support =  $this->uri->router->segments[3] . $this->uri->router->segments[4] . $this->uri->router->segments[5] . $this->uri->router->segments[7] . $this->uri->router->segments[9] . $this->uri->router->segments[11];
?>
<?php


//---for get quick answer link--//
$home = ($this->uri->router->segments[3] == "home");
$param = (getUrlParm("gethelp") != null) ? getUrlParm("gethelp") : 0;
//---for get quick answer link--//


$curr_url = $_SERVER['REQUEST_URI'];

//---for add to home screen--//
$page_ath = "home";
$check_home = "N";

if (strpos($curr_url, $page_ath) !== false) {
  $check_home = "Y";
}
//---for add to home screen--//

//---for add to detail page--answer feedback--//

if (strpos($curr_url, "detail") !== false) {
  $detail = "1";
} else {
  $detail = "0";
}
//---for add to detail page--answer feedback--//

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <? $cookie_consent = \RightNow\Utils\Config::getConfig(1000063); //CUSTOM_CFG_COOKIE_CONSENT_NOTICE 
  $cookieid = \RightNow\Utils\Config::getMessage(CUSTOM_MSG_OSANA_COOKIE_ID);
  ?>
  <? if ($cateory_id) : ?>
    <? //to remove index from google for disabled categories also make the page not found if it is disabled 
    ?>
    <? $enable_disable = $this->model('custom/bbresponsive')->get_enabled_category($cateory_id, $contactus_support);  ?>
  <? endif; ?>
  <? if ($enable_disable == 2 && ($contactus_support == "contactus_support" || $contactus_support == "gethelp" || $contactus_support == "contactus_sub_level" || $contactus_support == "answersdetaila_idcatidcatnmeTLP")) : ?>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <?php
    $url = "/app/pagenotfound";
    header('Location: ' . $url);
    ?>
  <? endif; ?>

  <? if (strpos($_SERVER['REQUEST_URI'], 'contactus_support_chat') !== false) : ?>
    <META NAME="robots" CONTENT="noindex, nofollow">
    <rn:meta noindex="true" />
  <? else : ?>
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
  <link rel="alternate" hreflang="en-gb" href="https://faq.beachbody.co.uk" />
  <link rel="alternate" hreflang="en-ca" href="https://faq.beachbody.ca" />
  <link rel="alternate" hreflang="fr-ca" href="https://faq.fr.beachbody.ca" />
  <link rel="alternate" hreflang="es-us" href="https://faq.es.beachbody.com/" />
  <link rel="alternate" hreflang="x-default" href="https://faq.beachbody.com" />
  <!--ensure the correct interface is returned in search results based on the user's country - end-->

  <!--ADD TO HOME SCREEN-->

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="Beachbody Support">
  <!--ADD TO HOME SCREEN-->

  <title>Openfit</title>
  <link href="/euf/assets/themes/responsive/css/beachbody.min.css" rel="stylesheet">
  <link href="/euf/assets/themes/responsive/css/icon.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/euf/assets/themes/responsive/css/slick.min.css">


  <link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/contact_us_phase2.css" />
  <link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/openfit_site.css" />


  <!--ADD TO HOME SCREEN-->
  
  <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/openfit_icon.png">

  <!-- <link rel="manifest" href="/euf/assets/images/mobile-icons/manifest.json"> -->
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <rn:widget path="utils/CobrowsePremium" />
  <link type="text/css" rel="stylesheet" href="/euf/assets/themes/standard/addtohomescreen.css" />
  <!--ADD TO HOME SCREEN-->


  <link href="/euf/assets/themes/responsive/css/style_site.css" rel="stylesheet">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		.osano-cm-dialog {
		  display: none;
		}
		.osano-cm-widget {
		  display: none;
		}
		
		.osano-cm-label {
		  position: relative;
		  visibility: hidden;
		  font-size: 0;
		  padding-bottom: 1em;
		}
		.osano-cm-label::after {
		  content: "Do Not Sell My Personal Information";
		  visibility: visible;
		  font-weight: bold;
		  width: 300px;
		  display: flex;
		  position: absolute;
		  top: 0;
		}
		.osano-cm-widget {
		  display: none;
		}
		.osano-cm-header {
		  display: none;
		}
		.osano-cm-view--type_consent .osano-cm-list-item:nth-child(1) {
		  display: none;
		}
		.osano-cm-view--type_consent .osano-cm-list-item:nth-child(2) {
		  display: none;
		}
		.osano-cm-view--type_consent .osano-cm-list-item:nth-child(3) {
		  display: none;
		}
		.osano-cm-view--type_consent .osano-cm-list-item:nth-child(4) {
		  display: none;
		}
		.osano-cm-view--type_consent
		  .osano-cm-list-item:nth-child(5)
		  .osano-cm-description
		  p {
		  display: none;
		}
		.osano-cm-view--type_consent
		  .osano-cm-list-item:nth-child(5)
		  .osano-cm-description::after {
		  font-size: 0.75em;
		  font-weight: 300;
		  content: 'California law broadly defines a "sale" to include certain data collection on our sites and use by third parties for purposes of targeted online advertising. Although Beachbody does not sell your personal information for monetary compensation, we may use third party cookies that collect information about your visits for analytics and to help personalize your experience, including with targeted ads. This may potentially be considered a "sale" under California law. You may opt-out of this practice by turning on the toggle switch and clicking "Save." Please note, if you use different computers or browsers, you may need to indicate your opt-out choices again on those computers and browsers.';
		}
		div.osano-cm-info__info-views.osano-cm-info-views.osano-cm-info-views--position_0
		  > div
		  > p:nth-child(1) {
		  display: none;
		}
		.osano-cm-info-dialog-header {
		  min-height: 50px;
		}
		.osano-cm-info {
		  position: fixed;
		  bottom: 0;
		  right: 0;
		  font-size: 15pt;
		  padding: 1px;
		  box-shadow: none;
		}
		.osano-cm-info-views {
		  height: calc(100% - 50px);
		}
		.osano-cm-button {
		  border-color: #cacada;
		  border-radius: 35px;
		}
		.osano-cm-button:hover {
		  background: white;
		  color: #3a9ffd;
		}
		.osano-cm-close,
		.osano-cm-close:hover,
		.osano-cm-close:focus {
		  transform: none;
		  transition: none;
		}
		.osano-cm-dialog {
		  display: none;
		}
	</style>

</head>

<body class="v-scroll">


  <!-- Hotjar Tracking Code for faq.beachbody.com -->

  <script>
    (function(h, o, t, j, a, r) {

      h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments)
      };

      h._hjSettings = {
        hjid: 977138,
        hjsv: 6
      };

      a = o.getElementsByTagName('head')[0];

      r = o.createElement('script');
      r.async = 1;

      r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;

      a.appendChild(r);

    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
  </script>

  <!-- Hotjar Tracking Code for faq.beachbody.com -->



  <!--ADD TO HOME SCREEN-->
  <script src="/euf/assets/js/addtohomescreen.js"></script>

  <script>
    //Add to some screen popup will display only in home page at the initial time.After that it won't display
    //After clearing the web cache the popup will show again
    //initially the value of "localStorage.getItem('first')" will be null and once the popup comes the value will
    // set as "nope"

    var is_home_page = '<?php echo $check_home; ?>';


    var mobile = 1; //web

    if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      mobile = 2; //mobile
    }

    /* alert("local--"+localStorage.getItem('first'));
     alert("mobile--"+mobile);
     alert("home-"+is_home_page);
     */
    if ((mobile == 2) && (is_home_page == "Y") && (localStorage.getItem('first') === null)) {
      localStorage.setItem('first', 'nope');

      var ath = addToHomescreen({
        // debug: 'android',           // activate debug mode in ios emulation
        skipFirstVisit: false, // show at first access
        startDelay: 0, // display the message right away
        lifespan: 0, // do not automatically kill the call out
        displayPace: 0, // do not obey the display pace
        privateModeOverride: true, // show the message in private mode
        maxDisplayCount: 0, // do not obey the max display count
        autostart: true
      });
    }
  </script>


  <!--ADD TO HOME SCREEN-->

  <div class="full-wrapper">
    <!-- Header -->
    <div class="hamburger-menu">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
             <div class="menu-tigger"> <span></span> <span></span> <span></span> </div>
          </div>
          <div class="col-md-2 col-sm-5 col-lg-3 col-xs-5 txt-center-mob-tab">
            <div><a href="/app/home"> <img class="header-logo" src="/euf/assets/themes/responsive/images/header-logo.svg#Logo-usage"></a></div>
          </div>
          <div class="col-md-10 col-sm-0 col-lg-9 col-xs-7 pr-xs-0 ">
           <div class="header-right">
            
              <!-- <div class="login-btn-custom sign-in">

              <rn:condition logged_in="false">
                <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?>
              </rn:condition>
              <div class="sign-out-mobile">
                <rn:condition logged_in="true">
                  <rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Sign Out" id="logout" />
                </rn:condition>
              </div>
            </div> -->
              <nav>
            <!-- <ul>
            <li><a href="https://www.beachbodyondemand.com/" onClick="click_tracking('Menu Links - BOD')">Beachbody On Demand</a></li>
            <li><a href="https://coach.teambeachbody.com" onClick="click_tracking('Menu Links - Coach Office')">Coach Office</a></li>
            <li><a href="https://www.teambeachbody.com/shop/us/coach?locale=en_US&destPage=coach" onClick="click_tracking('Menu Links - Become Coach')">Become a Coach</a></li>
            <li><a href="https://beachbodyondemand.com/groups" onClick="click_tracking('Menu Links - BODgroups')">BODgroups</a></li>
            <li><a href="https://community.beachbody.com/s/" onClick="click_tracking('Menu Links - Community')">Community</a></li>      
            <li><a href="https://www.teambeachbody.com/shop/us/b" onClick="click_tracking('Menu Links - Shop')">Shop</a></li>
      <li class="hide-mobile-only"><a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">My Orders</a></li> 
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
      
          </ul> -->
            <ul>
              <li><a class="header-list" href="https://www.openfit.com/openfit-fitness/" onClick="click_tracking('Menu Links - Fitness Programs')">Fitness Programs</a></li>
              <li><a class="header-list" href="https://www.openfit.com/fit/schedule/" onClick="click_tracking('Menu Links - Schedule')">Schedule</a></li>
              <li><a class="header-list" href="https://www.openfit.com/openfit-nutrition/" onClick="click_tracking('Menu Links - Nutrition Plans')">Nutrition Plans</a></li>
              <li><a class="header-list" href="https://www.openfit.com/collections/shop-all/" onClick="click_tracking('Menu Links - Ladder Supplements')">Ladder Supplements</a></li>
              <li><a class="header-list" href="https://www.openfit.com/articles/" onClick="click_tracking('Menu Links - Articles')">Articles</a></li>
              <!--   <li><a href="https://www.teambeachbody.com/shop/us/b" onClick="click_tracking('Menu Links - Shop')">Shop</a></li>
      <li class="hide-mobile-only"><a href="https://www.teambeachbody.com/shop/us/account/settings?tab=MyOrders" onClick="click_tracking('Menu Links - My Orders')">My Orders</a></li>  -->
              <!-- <li>    
        <div class="hide-on-mobile">          
           <rn:condition logged_in="false">             
                       <rn:widget path="custom/ResponsiveDesign/OverridedOpenLogin" sub_id='#rn:php:"openlogin_$provider"#' display_in_dialog="false" /> <? /* Attributes Default to Facebook */ ?>             
          </rn:condition>       
                                            
        </div>    
          <rn:condition logged_in="true">   
        <rn:widget path="custom/ResponsiveDesign/CustomLogoutLink" Label="Sign Out" id="logout"/>       
        </rn:condition>           
      </li> -->

            </ul>
          </nav>
          <div class="header-right">
                <!-- <a href="https://www.openfit.com/login/">Log In</a> -->
                <button type="button" class="trial-butn">FREE TRIAL</button>
              </div>
         
        
           </div>
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
      <div class="inner-nav row">

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
                    <a href="/app/contactus" class="nav_link" onClick="click_tracking('CONTACT SUPPORT')">CONTACT SUPPORT</a>
                  <? } ?>
                </rn:condition>
              </li>
              <!--<li class="nav_li"><a href="#" class="nav_link">
                  <div class="c-dropdown js-dropdown">
                    <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
                    <img src="" id="selectedFlag">
                    <span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US (ENGLISH)</span>
                    <ul class="c-dropdown__list">

                      <li onClick="location.href='https://faq.beachbody.com/app/home';" class="c-dropdown__item" data-dropdown-value="English" imageName="/euf/assets/themes/responsive/images/us.png"><img src="/euf/assets/themes/responsive/images/us.png">US (ENGLISH)</li>

                      <li onClick="location.href='https://faq.es.beachbody.com/app/home';" class="c-dropdown__item" data-dropdown-value="Spanish" imageName="/euf/assets/themes/responsive/images/us.png"><img src="/euf/assets/themes/responsive/images/us.png">US (ESPA�OL)</li>

                      <li onClick="location.href='https://faq.beachbody.ca/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (ENGLISH)</li>

                      <li onClick="location.href='https://faq.fr.beachbody.ca/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA (FRAN�AIS)</li>

                      <li onClick="location.href='https://faq.beachbody.co.uk/app/home';" class="c-dropdown__item" data-dropdown-value="UK" imageName="/euf/assets/themes/responsive/images/uk.png"><img src="/euf/assets/themes/responsive/images/uk.png">UK (ENGLISH)</li>

                      <li onClick="location.href='https://faq.beachbody.fr/app/home';" class="c-dropdown__item" data-dropdown-value="FRANCE" imageName="/euf/assets/themes/responsive/images/france.png"><img src="/euf/assets/themes/responsive/images/france.png">FRANCE (FRAN�AIS)</li>

                    </ul>
                  </div>
                </a></li> -->
            </ul>
          </nav>
        </div>
      </div>

      <div class="banner-ontents">

        <rn:condition logged_in="false">
          <h1>Welcome to Openfit and Ladder Support</h1>
          <rn:condition_else />
          <h1><?php echo "Hi " . $this->session->getProfile()->first_name->value . ", Welcome to Openfit and Ladder Support" ?></h1>
        </rn:condition>

        <div class="search-wrap">
          <form class="form-horizontal" onSubmit="return false;">
            <rn:container report_id="176">
              <div class="form-group form-group-md">
                <rn:widget path="custom/ResponsiveDesign/KeywordText" label_text="" label_placeholder="Enter a question or FAQ#" initial_focus="false" />
                <span class="input-group-btn">
                  <rn:widget path="search/SearchButton" report_page_url="/app/answers/list" />
                </span>
              </div>
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
    <rn:page_content />

    <rn:widget path="custom/ResponsiveDesign/ServiceAlert" />
    <? $shadowpopup = \RightNow\Utils\Config::getConfig(1000060); //CUSTOM_CFG_SHADOW_POPUP
    ?>
    <? if ($shadowpopup) : ?>
      <rn:widget path="custom/ResponsiveDesign/ShadowPopupContactus" />
    <? endif; ?>
  </div>
  <div class="push"></div>
  </div>
  <!-- End Contents -->

  <!-- Footer -->
  <footer class="opa-footer-fix">
    <div class="container-fluid" style="width: 100%;">
   
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 text-sm-center">
          <div class="footer-section">
            <ul>
              <li>Program Guides</li>
              <li><a href="https://www.openfit.com/p/xtend-barre">Xtend Barre</a></li>
              <li><a href="https://www.openfit.com/p/xb-pilates">Xtend Barre Pilates</a></li>
              <li><a href="https://www.openfit.com/p/rough-around-the-edges">Rough Around The Edges</a></li>
              <li><a href="https://www.openfit.com/p/yoga52">Yoga52</a></li>
              <li><a href="https://www.openfit.com/p/600-secs">600 Secs</a></li>
              <li><a href="https://www.openfit.com/p/t-minus-30">Tough Mudder T-Minus 30</a></li>
              <li><a href="https://www.openfit.com/p/sugar-free-3">Sugar Free 3</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4 text-sm-center">
          <div class="footer-section">
            <ul>
              <li>About Us</li>
              <li><a href="https://www.openfit.com/about">About Openfit</a></li>
              <li><a href="https://www.openfit.com/community">Community</a></li>
              <li><a href="https://thebeachbodycompany.com/">Company Info</a></li>
              <li><a href="https://www.openfit.com/plans/partnerships/">Partner with Us</a></li>
              <li><a href="https://www.openfit.com/plans/affiliate/">Openfit Affiliate Program</a></li>
              <li><a href="https://www.openfit.com/plans/student/">Student Discount</a></li>
			  <li><a href="https://www.openfit.com/press">Press</a></li>
              <li><a href="https://billing.openfit.com/fine-print/terms-of-use">Terms and Conditions</a></li>
              <li><a href="https://www.openfit.com/fine-print/privacy-policy/">Privacy Policy</a></li>
              <li><a href="https://www.openfit.com/fine-print/suppliercode/">Supplier Code</a></li>
              <li><a href="https://www.openfit.com/fine-print/casupplychain/">CA Supply Chain</a></li>
              <li><a href="/app/home">Help/FAQ</a></li>
              <li><a id="do_not_sell_my_info">Do Not Sell My Info</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-sm-center">
             <div class="footer-section">
            <ul>
             <li>Follow Us On</li>
             <li>
               <div class="follow-app"> 
               <a href="https://www.facebook.com/openfit/"> <img src="/euf/assets/themes/responsive/images/facebook (1).svg#facebook-usage"> </a>
                 <a href="https://twitter.com/MyOpenfit"> <img src="/euf/assets/themes/responsive/images/twitter.svg#twitter-usage"> </a>
                  <a href="https://www.instagram.com/myopenfit/">  <img src="/euf/assets/themes/responsive/images/instagram.svg#instagram-usage"> </a>
              </div>
             </li>
            </ul>
          </div>
        </div>
      </div>
	
		
        </div>
  </div>
  <rn:condition show_on_pages="home,gethelp,answers/detail,answers/list,answers/list_generic,answers/most_popular_answers">
				  <div class="cont-button-new-contactus">
				 
					  <a href="/app/contactus" onClick="click_tracking('Contact Us')">Contact Us</a> 
				   
				  </div>
				  </rn:condition>  
  </footer>
  <!-- End Footer -->

  <script type="text/javascript" src="https://nebula-cdn.kampyle.com/wu/384315/onsite/embed.js" async></script>

</body>
<!-- <script key="osano-script" src='https://cmp.osano.com/AzZcuESCJWcN06dnY/489875d9-4634-4f48-b6fa-554676eeb55b/osano.js?language=en&variant=one'/>-->
<script key="osano-script" src="https://cmp.osano.com/AzZcuESCJWcN06dnY/489875d9-4634-4f48-b6fa-554676eeb55b/osano.js?language=en&variant=one" />
<script>
function doNotSellMyInfo()
{
	alert("do not sell my info");
}
</script>
<script src="/euf/assets/themes/responsive/js/slick.min.js"></script>
<script src="/euf/assets/themes/responsive/js/beachbody.min.js"></script>
<script src="/euf/assets/themes/responsive/js/nav.js"></script>
<script src="/euf/assets/themes/responsive/js/form.js"></script>

<script>
  $(document).ready(function() {

    window.setInterval(function() {
      $(".mat-input").focus(function() {
        $(this).parent().addClass("is-active is-completed");
      });

      $(".mat-input").focusout(function() {
        if ($(this).val() === "")
          $(this).parent().removeClass("is-completed");
        $(this).parent().removeClass("is-active");
      });

    }, 1000);
  });
</script>

<script>
  var param = <?= $param; ?>;
  var detail = <?= $detail; ?>;

  $(document).ready(function() {

    var doc_height = $(document).height();
    var win_height = $(window).height();
    var doc_win_diff = doc_height - win_height;

    document.getElementById("stickyclass_hide_show").value = doc_win_diff + "-" + $('.inner-nav').height();

    if (detail == "1") {
      $('body').addClass("yui-skin-sam");
      $('body').addClass("yui3-skin-sam");
    } else {
      $('body').removeClass("yui-skin-sam");
      $('body').removeClass("yui3-skin-sam");
    }


    if (param == 1) {
      scrollToGetHelp();
    }

  });

  function scrollToGetHelp() {
    if (screen.width <= 768) {

      $('html,body').animate({
        scrollTop: $(".get-help").offset().top - 200
      }, 1000);
    } else {

      $('html,body').animate({
        scrollTop: $(".get-help").offset().top - 100
      }, 1000);
    }
  }


  function changeorientation() {
    var doc_height = $(document).height();
    var win_height = $(window).height();
    var doc_win_diff = doc_height - win_height;
    document.getElementById("stickyclass_hide_show").value = doc_win_diff + "-" + $('.inner-nav').height();
  }

  // Listen for orientation changes
  window.addEventListener("orientationchange", function() {
    // Announce the new orientation number
    if (window.orientation == 0) {
      changeorientation();
    } else if (window.orientation == 90) {
      changeorientation();
    } else if (window.orientation == -90) {
      changeorientation();
    }
  }, false);
</script>
<script>
  $(document).ready(function() {
  
  $(".trial-butn").click(function() {
  	window.location.href = "https://www.openfit.com/plans/pricing/";
  });
   });
    // Change Osano banner's text content; will delete once Osano corrects it on their end
   /* if (window.Osano) {
      window.Osano.cm.addEventListener("osano-cm-initialized", function(consentObject) {
        var manageCookies = $('<a></a>').attr({
          'href': 'javascript:void(0);',
          'target': '_self',
          'title': 'Manage Cookies',
          'class': 'osano-cm-link open-manage-cookie'
        });
        var userBrowserLanguage = window.navigator.language || window.navigator.userLanguage;
        var cookiesText = userBrowserLanguage == 'fr' ? 'G�rer les cookies' : (userBrowserLanguage == 'es' ? 'Administrar cookies' : 'Manage Cookies');
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
    $(".open-manage-cookie").click(function() {
    $(document).on('click', '.open-manage-cookie', function() {
      window.Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
    });
    $(".manage-cookies").click(function() {
      Osano.cm.showDrawer('osano-cm-dom-info-dialog-open');
    });
  });*/


  function click_tracking(text, catid = 0, ans_views = 0) {
    var page_url = String(window.location.href);
    if (catid == 0) {
      var exploded_url = page_url.split('/');
      var cat_id_index = exploded_url.indexOf('catid');
      catid = exploded_url[cat_id_index + 1];
    }

    var mobile = 1;
    var clicked_link = String(text);
    try {
      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        mobile = 2;
      }
    } catch (err) {}
    try {

      $.ajax({
        url: '/cc/bbresponsivecontroller/click_tracking',
        data: {
          url: page_url,
          mob: mobile,
          click_text: clicked_link,
          cat_id: catid,
          ans_view: ans_views
        },
        async: false,
        dataType: "json",
        type: "POST",
        success: function(data) {
          /*ajaxResult=data;
          alert("success");*/
        }

      });

    } catch (err2) {

    }

  }
  
</script>

<script>
$(document).ready(function() {
	$('#do_not_sell_my_info').click(function(){
		window['Osano'].cm.showDrawer('osano-cm-dom-info-dialog-open');
	});
});
</script>
<? if ($ip_check == 'FR' || $ip_check == 'GB') : ?>
  <? if ($cookie_consent) : ?>
   <!-- <script src="https://cmp.osano.com/AzZcuESCJWcN06dnY/<? //echo $cookieid; ?>/osano.js"></script> -->
  <? endif; ?>
<? endif; ?>


</html>