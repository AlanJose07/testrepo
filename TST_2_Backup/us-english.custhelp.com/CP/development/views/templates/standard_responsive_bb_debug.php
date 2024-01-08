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


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--ADD TO HOME SCREEN-->

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Beachbody Support">
<!--ADD TO HOME SCREEN-->

<title>Beachbody</title>
<link href="/euf/assets/themes/responsive/css/beachbody.min.css" rel="stylesheet">
<link href="/euf/assets/themes/responsive/css/style.css" rel="stylesheet">
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

  

<link rel="manifest" href="/euf/assets/images/mobile-icons/manifest.json">
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
</head>

<body>
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
      <div class="col-md-1 col-sm-1">
        <div class="logo"><a href="https://faq.beachbody.com/app/home"> <img src="/euf/assets/themes/responsive/images/logo.png"></a></div>
      </div>
      <div class="col-md-11 col-sm-11">
        <div class="menu-tigger"> <span></span> <span></span> <span></span> </div>
        <nav>
          <ul>
            <li><a href="https://www.beachbodyondemand.com/" onClick="click_tracking('Menu Links - BOD')">Beachbody On Demand</a></li>
            <li><a href="https://coach.teambeachbody.com" onClick="click_tracking('Menu Links - Coach Office')">Coach Office</a></li>
            <li><a href="https://www.teambeachbody.com/shop/us/coach?locale=en_US&destPage=coach" onClick="click_tracking('Menu Links - Become Coach')">Become a Coach</a></li>
            <li><a href="https://www.beachbodylive.com" onClick="click_tracking('Menu Links - BB Live')">Beachbody LIVE!</a></li>
            <li><a href="https://www.mychallengetrackerportal.com" onClick="click_tracking('Menu Links - Challenge Tracker')">My Challenge Tracker</a></li>
            <li><a href="https://community.beachbody.com/s/" onClick="click_tracking('Menu Links - Community')">Community</a></li>      
            <li><a href="https://www.teambeachbody.com/shop/us/b" onClick="click_tracking('Menu Links - Shop')">Shop</a></li> 
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
    <div class="inner-nav row">
	
      <div class="container"> 
	  <rn:condition show_on_pages="home">
	  <a class="navbar-brand">Support</a>
	  </rn:condition>
	   <rn:condition hide_on_pages="home">
	  <a class="navbar-brand" href="https://faq.beachbody.com/app/home" onClick="click_tracking('Support')">Support</a>
	  </rn:condition>
        <nav>
           <!--<div id="collapsed_nav" class="hamburger"> <span class="line"></span> <span class="line"></span> <span class="line"></span> </div>--> 
            <div id="collapsed_nav"><a class="arrow-icon">
  <span class="left-bar"></span>
  <span class="right-bar"></span>
</a></div>
            
          <ul id="nav_ul">
            <li class="nav_li">
			<? if ($home) { ?>
				<a href="#" class="nav_link" id="gethelplink" onClick="click_tracking('Get Quick Answers')">GET QUICK ANSWERS</a>
			<? } else {  ?>
				<a href="/app/home/gethelp/1" class="nav_link"  onClick="click_tracking('Get Quick Answers')">GET QUICK ANSWERS</a>
			<? } ?>
			</li>
            <li class="nav_li"><a href="#" class="nav_link">
           <div class="c-dropdown js-dropdown">
                <input type="hidden" name="Framework" id="Framework" class="js-dropdown__input">
                <img src="" id = "selectedFlag">
                <span class="c-button c-button--dropdown js-dropdown__current"><img src="/euf/assets/themes/responsive/images/us.png" id="selectedFlag">US</span>
                <ul class="c-dropdown__list">
				
                  <li  onclick="location.href='https://faq.beachbody.com/app/home';" class="c-dropdown__item" data-dropdown-value="English" imageName ="/euf/assets/themes/responsive/images/us.png" ><img src="/euf/assets/themes/responsive/images/us.png">US</li>
				  
                  <li  onclick="location.href='https://faq.beachbody.ca/app/home';" class="c-dropdown__item" data-dropdown-value="UK" imageName ="/euf/assets/themes/responsive/images/ca.png"><img src="/euf/assets/themes/responsive/images/ca.png">CANADA</li>
				  
                  <li onClick="location.href='https://faq.beachbody.co.uk/app/home';" class="c-dropdown__item" data-dropdown-value="Canada" imageName ="/euf/assets/themes/responsive/images/uk.png"><img src="/euf/assets/themes/responsive/images/uk.png">UK</li>
				  
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
      <h1>Welcome to Beachbody Support</h1>
      <div class="search-wrap">
         <form class="form-horizontal" onSubmit="return false;">
            <rn:container report_id="176">
            <div class="form-group form-group-md">
              <rn:widget path="search/KeywordText" label_text="" label_placeholder="Enter your question or an FAQ#" initial_focus="false"/>
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

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                    The above code explanation is at the starting of the code.**by jithin jose ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<!-- Bread Crumb -->
<rn:condition hide_on_pages="list_generic">
<section>
    <div class="container">
      <div class="row">
        <!--<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="#">Get Help And Learn</a> </span> <span class="breadcrumb"> My Shakeology </span> </div>-->
		<rn:widget path="custom/ResponsiveDesign/CustomBreadCrumbDuplicate" />
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

<!--<rn:widget path="custom/ResponsiveDesign/ServiceAlert" />-->
</div>
<div class="push"></div>
</div>
<!-- End Contents --> 

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
	 <rn:condition show_on_pages="home,gethelp,answers/detail,answers/list,answers/list_generic,answers/most_popular_answers">
      <div class="cont-button">
	 
      <a href="https://faq.beachbody.com/app/contactus" onClick="click_tracking('Contact Us')">Contact Us</a> 
       
      </div>
	  </rn:condition> 
     <!-- <p>© 2018 Beachbody, LLC. All Rights Reserved.</p>
      <span>Beachbody, LLC is the owner of the Beachbody and Team Beachbody trademarks, and all related designs, trademarks, copyrights, and other intellectual property.</span> -->
	  </div>
  </div>
</footer>
<!-- End Footer -->
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
	
	$("#gethelplink").click(function() {
		scrollToGetHelp();
	});
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




function click_tracking(text) {
	//alert("clicked --"+text);
	var page_url = String(window.location.href);
	//alert(page_url);
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
		   url: 'https://faq.beachbody.com/cc/bbresponsivecontroller/click_tracking',  
		   data:  {url: page_url, mob: mobile, click_text: clicked_link},
		   async:true,
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
</html>
