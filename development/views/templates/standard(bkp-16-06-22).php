<!DOCTYPE html>
<html lang="#rn:language_code#" >
<rn:meta javascript_module="standard"/>
<head>
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no"/>
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:theme path="/euf/assets/themes/standard" css="site.css,
		{YUI}/widget-stack/assets/skins/sam/widget-stack.css,
		{YUI}/widget-modality/assets/skins/sam/widget-modality.css,
		{YUI}/overlay/assets/overlay-core.css,
		{YUI}/panel/assets/skins/sam/panel.css" />
<rn:theme path="/euf/assets/themes/cathay" css="site.css,
		{YUI}/widget-stack/assets/skins/sam/widget-stack.css,
		{YUI}/widget-modality/assets/skins/sam/widget-modality.css,
		{YUI}/overlay/assets/overlay-core.css,
		{YUI}/panel/assets/skins/sam/panel.css" />
<rn:head_content/>
<link rel="icon" href="/euf/assets/themes/standard/images/favicon.png" type="image/png"/>
<link href="/euf/assets/themes/standard/gogo.css" type="text/css" /> 
<!-- CSS For Chat Button -->
<style>


/*Select Language */
.language-select{float:right;background:#fff;    padding-left: 7px;z-index: 9999 !important;}
.map{display: inline-block !important;
    float: left;
    font-size: 16px !important;
    color: #525252;
    padding-right: 3px !important;}
.social-links {
  margin-top: 15px;
  color: #000;
  font-family: sans-serif;
}
.social-links li {
	display: block;
	list-style-type: none;
	font-size: 14px;
}

#lang-form div {
  margin-top: 1px;
}

#lang-form #dropdown-wrapper {
  width: 100px;
  margin-top:5px;
  z-index: 1000;
}
#lang-form .dropdownbox {
  width: 100px;
}
#lang-form #dropdown-wrapper ul li a{text-decoration:none; color:#000}
.language-select .dropdownbox {
  margin: 0 auto;
  cursor: pointer;
}

.language-select .dropdownbox > p {
  display: block;
  user-select: none;
  -moz-user-select: none;
  /* Safari */
  -khtml-user-select: none;
}

.language-select ul.menu {
  margin: 0px 0px 0px 19px;
  padding: 0px;
  list-style: none;
  position: relative;
  width: 100px;
  overflow: hidden;
  height: 0;
  margin-top: 2px;
  /*-moz-transform:scale(0); */
  color: #000;
  cursor: pointer;
  user-select: none;
  -moz-user-select: none;
  /* Safari */
  -khtml-user-select: none;
}

.language-select ul.menu li {
  padding: 2px 0;
  color: #000;
  display:block;
}

.language-select ul.menu li:hover {
  color: #2E408A;
  /*background: #1F8EC1;*/
}

.language-select .menu.showMenu {
  /*-moz-transform:scale(1);*/
  height:auto;
}

</style>
</head>
<?php

if($_SERVER['REQUEST_URI']=="/app/utils/create_account"||$_SERVER['REQUEST_URI']=="/app/account/profile")
header("Location:/app/home");
$cur_url=$_SERVER['REQUEST_URI'];
$CI = get_instance();
$clang= $CI->session->getSessionData('clang');
$flightNumber=getUrlParm('flightNumber');
$flgtNo=substr($flightNumber, 0, 3);
if($flgtNo=="CPA")
   {
   if($clang=="ko_KR" && getUrlParm('ko')!=1)
   {
   header("Location:".$cur_url."/ko/1");
   }
   if($clang=="de_DE" && getUrlParm('ge')!=1)
   header("Location:".$cur_url."/ge/1");
   
   }
   
   $CI = get_instance();
   $clang= $CI->session->getSessionData('clang');
    if(getUrlParm('tailNumber'))
	{
	
	$CI->session->setSessionData(array('flightNumber' =>getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress')));
	
	}
	
 // determine if the user is coming from the ground site or airborne site.
 if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber')){
  $showContactLink = false;
 }else{
  $showContactLink = true;
 }
 
 
 $redirect_to = $CI->page;
 
 $switch_interface = ($redirect_to == 'answers/detail') ? 'home' : $redirect_to;
 
?>
<?php

	$flightNumber = "";
	//setting session with url parameters
	$ses=$CI->session->getSessionData('enc_str');
	$ses = ltrim($ses, '/');
	$all_param= $CI->session->getSessionData('urlParameters');
	$all_parameters= array();
	foreach($all_param as $array) {
 	foreach($array as $k=>$v) {
    $all_parameters[$k][] = $v;
 	   }
	   }
	
	if(array_key_exists('flightNumber', $all_parameters))
	{
			if(is_array($all_parameters['flightNumber']))
			{
				$flightNumber = end($all_parameters['flightNumber']);
			}
			else
			{
				$flightNumber = $all_parameters['flightNumber'];
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
	
	
	//Storing first three parameters of flight number
	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];
	
	if(array_key_exists('clang', $all_parameters))
	{
			if(is_array($all_parameters['clang']))
			{
				$clang = end($all_parameters['clang']);
			}
			else
			{
				$clang = $all_parameters['clang'];
			}
			
	}
	
	
?>
<body class="yui-skin-sam yui3-skin-sam">
<div id="rn_Container" class="rn_Gogo_Container">
  <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
  <div id="rn_Header" role="banner" class="rn_Gogo_Header">
    <noscript>
    <h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
    </noscript>
    <div class="header_logo"> 
	<?php
	if($flgtNo=="CPA"){?>
    <a href="/app/home#rn:session#" class="brand"><img src="/euf/assets/themes/cathay/images/Cathay_Pacific_logo.png" alt="Cathay"/></a> 
    <?php }
	else{?>
    <a href="/app/home#rn:session#"><img src="/euf/assets/images/layout/gogo_cc_logo.png" alt="Gogo Logo"/></a>
    <?php }?>
	
   
    <? /*---If the flight number starts with “TAM”, the language toggle is provided in the Aircell site.  ---*/ ?>
      <?php  if((strpos($flgtNo,'TAM')!== false) && ($clang=="en_US" || $clang=="es_MX"||$clang=="pt_BR"||$clang=="es_BO"))  { ?>
    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
<li>
<div>
<div id="lang-form">
  
<div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</div>
  
  <div id="dropdown-wrapper">
    <ul name="lang" id="select-language-menu" class="menu">
        <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','es_MX','es_BO'],'pt_BR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
          Português
          <div class="lang-code" style="display: none;">Português &#9662;</div></a>
        </li>
        <li><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','es_MX'],'es_BO',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
          Español
          <div class="lang-code" style="display: none;">Español &#9662;</div></a>
        </li>
    </ul>
  </div>
</div>
</div>
</li>
</ul>
        </div>
             
      <?php } ?>
	   <? /*---If the flight number starts with “CPA”, the language toggle is provided in the Aircell site.  ---*/ ?>
	   <?php
	    
	   if($flgtNo=="CPA" && $clang=="en_US" && getUrlParm('ge')!="1")  { 
	  
	   ?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">
	
	<li class="selected"><a href="https://custhelpyue.gogoinflight.com/app/home<?php echo str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_HK' ,$CI->session->getSessionData('enc_str'));?>">

         繁體中文

          <div class="lang-code" style="display: none;">繁體中文 &#9662;</div></a>

        </li>
		
		<li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/home<?php echo str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_CN' ,$CI->session->getSessionData('enc_str'));?>">

         简体中文

          <div class="lang-code" style="display: none;">简体中文 &#9662;</div></a>

        </li>
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/home<?php echo str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'ja_JP' ,$CI->session->getSessionData('enc_str'));?>">

          日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
			<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'ko_KR' ,$CI->session->getSessionData('enc_str'))."/ko/1";?>">
          한국어

          <div class="lang-code" style="display: none;">한국어 &#9662;</div></a>

        </li>
      <li class="selected"><a href="https://custhelpca.gogoinflight.com/app/home<?php echo str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'fr_FR' ,$CI->session->getSessionData('enc_str'));?>">
Français

          <div class="lang-code" style="display: none;">Français &#9662;</div></a>

        </li>
	
		<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'de_DE' ,$CI->session->getSessionData('enc_str'))."/ge/1";?>">

         Deutsch

          <div class="lang-code" style="display: none;">Deutsch &#9662;</div></a>

        </li>
		
		
		
		
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	 
	<?php }?>
	<?php
	 if($flgtNo=="CPA" && $clang=="ko_KR" && getUrlParm('ko')==1)  { 
	   ?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">
	<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'en_US' ,$CI->session->getSessionData('enc_str'));?>">
          English

          <div class="lang-code" style="display: none;">English &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpyue.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_HK' ,$CI->session->getSessionData('enc_str'));?>">

         繁體中文

          <div class="lang-code" style="display: none;">繁體中文 &#9662;</div></a>

        </li>
		
		<li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_CN' ,$CI->session->getSessionData('enc_str'));?>">

         简体中文

          <div class="lang-code" style="display: none;">简体中文 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'ja_JP' ,$CI->session->getSessionData('enc_str'));?>">

          日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
      <li class="selected"><a href="https://custhelpca.gogoinflight.com/app/home<?php echo  str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'fr_FR' ,$CI->session->getSessionData('enc_str'));?>">

          Français

          <div class="lang-code" style="display: none;">Français &#9662;</div></a>

        </li>
		 
		
		
		<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'de_DE' ,$CI->session->getSessionData('enc_str'))."/ge/1";?>">

         Deutsch

          <div class="lang-code" style="display: none;">Deutsch &#9662;</div></a>

        </li>
		
		
		
		
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	 
	<?php }?>
	

	<?php
	 /* ge is for German*/
	   if($flgtNo=="CPA" && $clang="de_DE" && getUrlParm('ge')==1)  {  
	   ?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">
	<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'en_US' ,$CI->session->getSessionData('enc_str'));?>">

         English

          <div class="lang-code" style="display: none;">English &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpyue.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_HK' ,$CI->session->getSessionData('enc_str'));?>">

         繁體中文

          <div class="lang-code" style="display: none;">繁體中文 &#9662;</div></a>

        </li>
		
		<li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'zh_CN' ,$CI->session->getSessionData('enc_str'));?>">

         简体中文

          <div class="lang-code" style="display: none;">简体中文 &#9662;</div></a>
        </li>
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'ja_JP' ,$CI->session->getSessionData('enc_str'));?>">

          日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'ko_KR' ,$CI->session->getSessionData('enc_str'))."/ko/1";?>">
          한국어

          <div class="lang-code" style="display: none;">한국어 &#9662;</div></a>

        </li>
      <li class="selected"><a href="https://custhelpca.gogoinflight.com/app/home<?php echo str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_HK','zh_CN','de_DE'],'fr_FR' ,$CI->session->getSessionData('enc_str'));?>">

          Français

          <div class="lang-code" style="display: none;">Français &#9662;</div></a>

        </li>
		
		
		
		
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>

	<?php }?>
	 
	
	   	<?php
		$clang= $CI->session->getSessionData('clang');
		if(array_key_exists('clang', $all_parameters))
	{
			if(is_array($all_parameters['clang']))
			{
				$clang = end($all_parameters['clang']);
			}
			else
			{
				$clang = $all_parameters['clang'];
			}
			
	}
		
		?>
      
     
	  
	<? /*---If the flight number starts with “DAL” and clang parameter is "en_US" or "ja_JP" */?>
	
	<?php if($flgtNo=="DAL" && ($clang=="en_US" || $clang=="ja_JP")) {  ?>
	    
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">

       <li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','ja_JP'],'zh_CN',$CI->session->getSessionData('enc_str'));?>">

          中文

          <div class="lang-code" style="display: none;">中文 &#9662;</div></a>

        </li>
		
		
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US'],'ja_JP', $CI->session->getSessionData('enc_str'))."/tog/1";?>">

         日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','ja_JP'],'es_MX', $CI->session->getSessionData('enc_str'))."/tog/1";?>">

          Español

          <div class="lang-code" style="display: none;">Español &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','ja_JP'],'pt_BR', $CI->session->getSessionData('enc_str'))."/tog/1";?>">

         Português

          <div class="lang-code" style="display: none;">Português &#9662;</div></a>

        </li>
	
		 <li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','ja_JP'],'ko_KR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

         한국어

         <div class="lang-code" style="display: none;">한국어 &#9662;</div></a>

        </li>
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	 
	<?php }?>
		
	 
	 
	 

	
	
	 <? /*---If the flight number starts with “DAL” and clang parameter is "ko_KR", the language toggle is provided in the 한국어 site ---*/ ?>
	  
	  <?php if($flgtNo=="DAL" && $clang=="ko_KR") {?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">

      <li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ko_KR'],'en_US',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

          English

          <div class="lang-code" style="display: none;">English &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ko_KR'],'ja_JP',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

         日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ko_KR'],'es_MX',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

          Español

          <div class="lang-code" style="display: none;">Español &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ko_KR'],'pt_BR', $CI->session->getSessionData('enc_str'))."/tog/1";?>">

         Português

          <div class="lang-code" style="display: none;">Português &#9662;</div></a>

        </li>
	
		 <li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ko_KR'],'zh_CN',$CI->session->getSessionData('enc_str'));?>">

         中文

         <div class="lang-code" style="display: none;">中文 &#9662;</div></a>

        </li>
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	 
	<?php }?>
	
	 
	 
	
	
	 <? /*---If the flight number starts with “DAL” and clang="es_MX", the language toggle is provided in the English site.  ---*/ ?>
	  <?php  if($flgtNo=="DAL" && $clang=="es_MX" ) {?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">

      <li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX'],'ko_KR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

          한국어

          <div class="lang-code" style="display: none;">한국어 &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX'],'ja_JP',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

         日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,$CI->session->getSessionData('enc_str') ."/tog/1";?>">

          Español

          <div class="lang-code" style="display: none;">Español &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX'],'pt_BR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

         Português

          <div class="lang-code" style="display: none;">Português &#9662;</div></a>

        </li>
		 
         <li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX'],'zh_CN',$CI->session->getSessionData('enc_str'));?>">
         中文

         <div class="lang-code" style="display: none;">中文 &#9662;</div></a>

        </li>
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	<?php }?>
	<? /*---If the flight number starts with “DAL” and clang="pt_BR", the language toggle is provided in the English site.  ---*/ ?>
	  <?php  if($flgtNo=="DAL" && $clang=="pt_BR" ) {?>
	    <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
		<li>
		<div>
        <div id="lang-form">
		 <div id="language-selected" class="dropdownbox"><span>Language</span> <span>▾</span></div>
        <div id="dropdown-wrapper">

    <ul name="lang" id="select-language-menu" class="menu">

      <li class="selected"><a href="https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['pt_BR'],'ko_KR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

          한국어

          <div class="lang-code" style="display: none;">한국어 &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelpjp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['pt_BR'],'ja_JP',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

         日本語

          <div class="lang-code" style="display: none;">日本語 &#9662;</div></a>

        </li>
		<li class="selected"><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['pt_BR'],'es_MX',$CI->session->getSessionData('enc_str'))."/tog/1";?>">

          Español

          <div class="lang-code" style="display: none;">Español &#9662;</div></a>

        </li>
		
		 <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,$CI->session->getSessionData('enc_str')."/tog/1";?>">

         Português

          <div class="lang-code" style="display: none;">Português &#9662;</div></a>

        </li>
		 
         <li class="selected"><a href="https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['pt_BR'],'zh_CN',$CI->session->getSessionData('enc_str'));?>">
         中文

         <div class="lang-code" style="display: none;">中文 &#9662;</div></a>

        </li>
	 </ul>
     </div>
    </div>
    </div>
     </li>
     </ul>
    </div>
	 
	 
	 
	<?php }?>
	
	
	

	<? /*---If the flight number starts with “IBE”, the language toggle is provided in the aircell site ---*/ ?>
	
      <?php  if($flgtNo=="IBE") { ?>
      <a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','es_BO','fr_CA','pt_BR','en_US','zh_CN','ko_KR'],'es_BO',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      <div id="language_Navigation">
        <!--<div class="SPA"></div>-->
        <span style="display:inline-block;">Español</span></div>
      </a>
      <?php } ?>
	
	<? /*---If the flight number starts with “JAL”, the language toggle is provided in the aircell site ---*/ ?>
	
      <?php  if($flgtNo=="JAL") { ?>
      <a href="https://custhelpjp.gogoinflight.com/app/home<?php echo str_replace(['es_MX','es_BO','fr_CA','pt_BR','en_US','zh_CN','ko_KR'],'ja_JP',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      <!--gogo-jp--tst.custhelp-->
      <div id="language_Navigation">
        <!--<div class="JAP"></div>-->
        <span style="display:inline-block;">日本語 </span></div>
      </a>
      <?php } ?>

      <? /*---If the flight number starts with “JTA”, the language toggle is provided in the aircell site ---*/ ?>
      <?php  if($flgtNo=="JTA") { ?>
      <a href="https://custhelpjp.gogoinflight.com/app/home<?php echo str_replace(['es_MX','es_BO','fr_CA','pt_BR','en_US','zh_CN','ko_KR'],'ja_JP',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      <!--gogo-jp--tst.custhelp-->
      <div id="language_Navigation">
        <!--<div class="JAP"></div>-->
        <span style="display:inline-block;">日本語 </span></div>
      </a>
      <?php } ?>
            
      <? /*---If the flight number starts with “ACA”, the language toggle is provided in the Aircell site.  ---*/ ?>
      <?php  if($flgtNo=="ACA" ) { ?>
      <a href="https://custhelpca.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','es_BO','ja_JP','pt_BR','en_US','zh_CN','ko_KR'],'fr_CA',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      <!--gogo-ca--tst.custhelp-->
      <div id="language_Navigation">
        <!--<div class="FRA"></div>-->
        <span style="display:inline-block;">Français</span> </div>
      </a>
      <?php } ?>

      <? /*---If the flight number starts with “ROU”, the language toggle is provided in the Aircell site.  ---*/ ?>
      <?php  if($flgtNo=="ROU" ) { ?>
      <a href="https://custhelpca.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','es_BO','ja_JP','pt_BR','en_US','zh_CN','ko_KR'],'fr_CA',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      <!--gogo-ca--tst.custhelp-->
      <div id="language_Navigation">
        <!--<div class="FRA"></div>-->
        <span style="display:inline-block;">Français</span> </div>
      </a>
      <?php } ?>
      
	  <? /*---If the flight number starts with “GOL”, the language toggle is provided in the Aircell site.  ---*/ ?>
      <?php  if((strpos($flgtNo,'G3')!== false) ||(strpos($flgtNo,'GLO')!== false))  { ?>
      
        <div class="language-select">
        <ul class="social-links">
        <li class="map">&#127759;</li>
<li>
<div>
<div id="lang-form">
  
<div id="language-selected" class="dropdownbox">Língua &#9662;</div>
  
  <div id="dropdown-wrapper">
    <ul name="lang" id="select-language-menu" class="menu">
        <li class="selected"><a href="https://custhelppt.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','es_BO','fr_CA','ja_JP','en_US','zh_CN','ko_KR'],'pt_BR',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
          Português
          <div class="lang-code" style="display: none;">Português &#9662;</div></a>
        </li>
        <li><a href="https://custhelpca.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','es_BO','ja_JP','pt_BR','en_US','zh_CN','ko_KR'],'fr_CA',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
          Français
          <div class="lang-code" style="display: none;">Français &#9662;</div></a>
        </li>
        <li><a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['es_MX','ja_JP','fr_CA','pt_BR','en_US','zh_CN','ko_KR'],'es_BO',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
          Español
          <div class="lang-code" style="display: none;">Español &#9662;</div></a>
        </li>
    </ul>
  </div>
</div>
</div>
</li>
</ul>
        </div>
             
      <?php } ?>
            
      <? /*---If the flight number starts with “AMX” or "BAW", the language toggle is provided in the Aircell site.  ---*/ ?>
      <?php  if($flgtNo=="AMX"||$flgtNo=="BAW" ) { ?>
      <a href="https://custhelpsp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['ja_JP','es_BO','fr_CA','pt_BR','en_US','zh_CN','ko_KR'],'es_MX',$CI->session->getSessionData('enc_str'))."/tog/1";?>">
      
      <div id="language_Navigation">
        
        <span style="display:inline-block;">Español</span> </div>
      </a>
      <?php } ?>      
    </div>
  </div>
  <div id="rn_Navigation" style="background:#FFFFFF;">
  <?php if($flgtNo=="CPA" && $clang=="ko_KR" && getUrlParm('ko')==1 ){?>
<div class="powered">
<ul>
<li>
<h2>고객지원센터</h2>
</li>
<li>
<a href="/app/home#rn:session#"><img src="/euf/assets/images/layout/powered_ko_KR.png" alt="Gogo Logo"/></a>
</li>
</ul>
</div>
<?php } ?>
<?php if($flgtNo=="CPA" && $clang=="de_DE" && getUrlParm('ge')==1 ){?>
<div class="powered">
<ul>
<li>
<h2>Kundenbetreuung</h2>
</li>
<li>
<a href="/app/home#rn:session#"><img src="/euf/assets/images/layout/powered.png" alt="Gogo Logo"/></a>
</li>
</ul>
</div>
<?php } ?>
<?php if($flgtNo=="CPA" && $clang=="en_US"){?>
<div class="powered">
<ul>
<li>
<h2>Customer Care</h2>
</li>
<li>
<a href="/app/home#rn:session#"><img src="/euf/assets/images/layout/powered.png" alt="Gogo Logo"/></a>
</li>
</ul>
</div>
<?php } ?>
    <rn:condition hide_on_pages="utils/help_search">
	
        <?php if($clang=="ko_KR" && $flgtNo=="DAL"){ ?>
		
	 <div id="rn_NavigationBar" role="navigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="자주 묻는 질문" link="/app/home/#rn:php:$ses#" pages="home"/>
          </li>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="저희와 채팅하기(영어만)" link="https://custhelp.gogoinflight.com/app/chat/chat_launch/#rn:php:$ses#" pages="chat/chat_launch,chat/chat_landing"/>
          </li>        
         <rn:condition config_check="COMMUNITY_ENABLED == true">
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:COMMUNITY_LBL#" link="#rn:config:COMMUNITY_HOME_URL:RNW##rn:community_token:?#" external="true"/>
            </li>
          </rn:condition>
		  
	
	  <?php } 
	  
elseif($flgtNo=="CPA" && $clang=="de_DE" && getUrlParm('ge')==1){ 
		?>
	 
	
	 <div id="rn_NavigationBar" role="navigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="FAQs" link="/app/home/#rn:php:$ses#/ge/1" pages="home"/>
          </li>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="Chatten Sie mit uns" link="https://custhelp.gogoinflight.com/app/chat/chat_launch/#rn:php:$ses#" pages="chat/chat_launch,chat/chat_landing,chat/chat_lang"/>
          </li>        
          <rn:condition config_check="COMMUNITY_ENABLED == true">
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:COMMUNITY_LBL#" link="#rn:config:COMMUNITY_HOME_URL:RNW##rn:community_token:?#" external="true"/>
            </li>
          </rn:condition>
	
	  <?php } 
		
	  elseif($flgtNo=="CPA" && $clang="ko_KR" && getUrlParm('ko')==1){ 
	?>
	  <div id="rn_NavigationBar" role="navigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="자주 묻는 질문" link="/app/home/ko/1/#rn:php:$ses#" pages="home"/>
          </li>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="저희와 채팅하기" link="https://custhelp.gogoinflight.com/app/chat/chat_launch/#rn:php:$ses#" pages="chat/chat_launch,chat/chat_landing,chat/chat_lang"/>
          </li>        
         
		  <?php } 
		  
 
	  
	  else
	  {	 
	  
	  ?>  
	 
      <div id="rn_NavigationBar" role="navigation">
        <ul>
          <li>
            <rn:widget path="navigation/NavigationTab" label_tab="FAQs" link="/app/home" pages="home"/>
          </li>
          <li>
		     <?php
			
			  
		 if($flgtNo=="CPA" && $clang="en_US" && getUrlParm('ge')!=1) { 
		
		 ?>  
		  
		   <rn:widget path="navigation/NavigationTab" label_tab="Chat with us" link="/app/chat/chat_launch/#rn:php:$ses#" pages="chat/chat_launch,chat/chat_landing"/>
		    <?php }
			else { 
		
		 ?>  
		  
		   <rn:widget path="navigation/NavigationTab" label_tab="Chat with us" link="/app/chat/chat_launch/#rn:php:$ses#" pages="chat/chat_launch,chat/chat_landing"/>
		    <?php }?> 
			
          </li>     
		  <?php } 
		    ?>    
          <rn:condition config_check="COMMUNITY_ENABLED == true">
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:COMMUNITY_LBL#" link="#rn:config:COMMUNITY_HOME_URL:RNW##rn:community_token:?#" external="true"/>
            </li>
          </rn:condition>
		   
          <? /*---If the flight or tail number exist in the session ,Email tab should be hidden otherwise it should appear along with other tabs  ---*/ ?>
          <? if($showContactLink){ ?>
          <li>
            
			<rn:widget path="navigation/NavigationTab" label_tab="Send email" link="mailto:customercare@gogoair.com?" pages=""/>
          </li>
          <li>
          	<rn:widget path="navigation/NavigationTab" label_tab="Call us" link="/app/home/kw/2983" pages="answers"/>
          </li>
          <?php } ?>
        </ul>
      </div>
    </rn:condition>
  </div>
  <div id="rn_Body" style="background:#E6F3F9; margin-top:-4px;">
    <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
      <rn:page_content/>
    </div>
  </div>
  <div id="rn_Footer" role="contentinfo">
    <div id="rn_RightNowCredit">
      <p>
	  
	  <?php  
	   
       if($clang=="ko_KR" && $flgtNo=="DAL") { ?>
      <div id="gogo_credit" style="margin-top:3px;">&copy;<?php echo date("Y") ?> INTELSAT INFLIGHT LLC. 모든 상표는 해당 소유주의 자산입니다.</br>
	  <?php }
	  elseif($flgtNo=="CPA" && $clang="ko_KR" && getUrlParm('ko')==1){ ?>
	  <div id="gogo_credit" style="margin-top:3px;">&copy;<?php echo date("Y") ?> INTELSAT INFLIGHT LLC. 모든 상표는 해당 소유주의 자산입니다.</br>
	  <?php }
	  elseif($flgtNo=="CPA" && $clang="de_DE" && getUrlParm('ge')==1){ ?>
	  <div id="gogo_credit" style="margin-top:3px;">&copy;<?php echo date("Y") ?> INTELSAT INFLIGHT LLC. Alle eingetragenen Warenzeichen sind das Eigentum ihrer jeweiligen Besitzer.</br>
	  <?php }
		else { ?> 
	 <div id="gogo_credit" style="margin-top:3px;">&copy;<?php echo date("Y") ?> INTELSAT INFLIGHT LLC. All trademarks are the property of their respective owners.</br>
	 <?php } ?>
		
        <?php
			// determine if the user is coming from the ground site or airborne site.
			$CI = get_instance();
			$clang= $CI->session->getSessionData('clang');
			if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber'))
			{
			 
			if($flgtNo=="ACA" ||$flgtNo=="ROU")
			$Link='https://content.gogoair.com/terms/aca/?lang=en_US';
			elseif($flgtNo=="GLO")
			$Link='https://content.gogoair.com/terms/gol/?lang=en_US';
			elseif($flgtNo=="JAL"||$flgtNo=="JTA")
			$Link='https://content.gogoair.com/terms/jal/?lang=en_US';
			elseif($flgtNo=="AMX")
			$Link='https://content.gogoair.com/terms/amx/?lang=en_US';
			elseif($flgtNo=="BAW")
			$Link='https://content.gogoair.com/terms/baw/?lang=en_GB';
			elseif($flgtNo=="VOZ")
			$Link='https://content.gogoair.com/terms/voz/?lang=en_US';
			elseif($flgtNo=="VIR")
			$Link='https://content.gogoair.com/terms/vir/?lang=en_GB';
			elseif($flgtNo=="DAL" && getUrlParm('clang')=="ko_KR")
			$Link='https://content.gogoair.com/terms/index.html?lang=ko_KR';
			elseif($clang=="en_US" && $flgtNo=="DAL")
			$Link='https://content.gogoair.com/terms/index.html?lang=en_US';
			elseif($clang=="ja_JP" && $flgtNo=="DAL")
			$Link='https://content.gogoair.com/terms/index.html?lang=ja_JP';
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="en_US")
			$Link ='https://content.gogoair.com/terms/cpa/?lang=en_US';	
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="ko_KR" && (getUrlParm('ko')==1))
			$Link ='https://content.gogoair.com/terms/cpa/?lang=ko_KR';	
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="de_DE" && (getUrlParm('ge')==1))
			$Link ='https://content.gogoair.com/terms/cpa/?lang=de_DE';	
			
			else
			$Link ='https://content.gogoair.com/terms/?lang=en_US';
			
			
			}
			
			else
			{
				$Link = 'https://content.gogoair.com/terms/?lang=en_US';
			} 
			
			
			
			 if($clang=="ko_KR" && $flgtNo=="DAL")
			 { 
			   echo "<a target=_blank href=$Link>이용약관</a>";
			 }
			 elseif($clang=="ko_KR" && $flgtNo=="CPA" && (getUrlParm('ko')==1))
			 { 
			   echo "<a target=_blank href=$Link>이용약관</a>";
			 }
			 elseif($clang=="de_DE" && $flgtNo=="CPA" && (getUrlParm('ge')==1))
			 { 
			   echo "<a target=_blank href=$Link>Nutzungsbedingungen</a>";
			 }
			 else
			 {
			  echo "<a target=_blank href=$Link>Terms of Use</a>";
			  }
			?>
        &nbsp;
        <?php
			// determine if the user is coming from the ground site or airborne site.
			$CI = get_instance();
		    $clang= $CI->session->getSessionData('clang');
			if(getUrlParm('flightNumber') || $CI->session->getSessionData('flightNumber') || getUrlParm('tailNumber') || $CI->session->getSessionData('tailNumber'))
			{
			
			if($clang!="")
			{
			if (stripos($clang,'es_MX') !== false)
				$Link = 'http://content.gogoair.com/privacy/?lang=es_MX';
			elseif(stripos($clang,'es_BO') !== false)
				$Link = 'http://content.gogoair.com/privacy/?lang=es_BO';
			elseif(stripos($clang,'pt_BR') !== false)
				$Link = 'http://content.gogoair.com/privacy/?lang=pt_BR';
			elseif(stripos($clang,'fr_FR') !== false)
				$Link = 'http://content.gogoair.com/privacy/?lang=fr_FR';
			elseif(stripos($clang,'fr_CA') !== false)
				$Link = 'http://content.gogoair.com/privacy/?lang=fr_CA';
			elseif($flgtNo=="VOZ")
			$Link='http://content.gogoair.com/privacy/voz/?lang=en_US';
			elseif($flgtNo=="DAL" && getUrlParm('clang')=="ko_KR")
					$Link='https://content.gogoair.com/privacy/index.html?lang=ko_KR';
			
			elseif($clang=="en_US" && $flgtNo=="DAL")
					$Link='https://content.gogoair.com/privacy/index.html?lang=en_US';
			elseif($clang=="ja_JP" && $flgtNo=="DAL")
					$Link='https://content.gogoair.com/privacy/index.html?lang=ja_JP';
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="en_US")
				$Link='https://content.gogoair.com/privacy/cpa/index.html?lang=en_US';
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="ko_KR" && (getUrlParm('ko')==1))
				$Link='https://content.gogoair.com/privacy/cpa/index.html?lang=ko_KR';	
			elseif($flgtNo=="CPA" && getUrlParm('clang')=="de_DE" && (getUrlParm('ge')==1))
				$Link='https://content.gogoair.com/privacy/cpa/index.html?lang=de_DE';		
			else
			$Link = 'https://content.gogoair.com/privacy/index.html?lang=en_US';
			
			}
			
			}
			
			else
			{
			if($flgtNo=="VOZ")
			$Link='http://content.gogoair.com/privacy/voz/?lang=en_US';
			else
			$Link = 'https://content.gogoair.com/privacy/?lang=en_US';
			} 
			
			
			
			
			 
			 if($clang=="ko_KR" && $flgtNo=="DAL")
			 { 
			  echo "<a target=_blank href=$Link>개인 정보 보호 및 쿠키 정책</a>";
			 }
			 elseif($clang=="ko_KR" && $flgtNo=="CPA" && (getUrlParm('ko')==1) )
			 { 
			  echo "<a target=_blank href=$Link>개인 정보 보호 및 쿠키 정책</a>";
			 }
			 elseif($clang=="de_DE" && $flgtNo=="CPA" && (getUrlParm('ge')==1) )
			 { 
			  echo "<a target=_blank href=$Link>Datenschutz- und Cookie-Richtlinien</a>";
			 }
			 else
			 {
			 echo "<a target=_blank href=$Link>Privacy and Cookie Policy</a>";
			  }
			?>
      </div>
      </p>
      
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
$(".rn_commonTopics").click(function() {
	if ($("#rn_show_dropdown").hasClass("intro")){
	 $("#rn_show_dropdown").removeClass("intro");
	} else {
 $("#rn_show_dropdown").addClass("intro");
  }
});
</script>
<script type="text/javascript">

if ($('#language-selected').is(':empty')){
	  $( ".menu li" ).each(function() {
	    if($(this).attr('class') == 'selected'){
	    	var selected = $(this).find('.lang-code').html();
	        console.log($(this).find('.lang-code').html());
	        $("#language-selected").html(selected);
	    }
	  });
	}

	//The next following line displays and set selected language
	  $(".dropdownbox").click(function(){
		$(".menu").toggleClass("showMenu");
		  $(".menu > li").click(function(){
		    var selected = $(this).find('.lang-code').html();
		    console.log($(this).find('.lang-code').html());
		    $("#language-selected").html(selected);
		    $(".menu").removeClass("showMenu");	        
	      });
	  });
	
	  //Close language select box if nothing is selected
	  $("#dropdown-wrapper").mouseleave(function(){
		  $(".menu").removeClass("showMenu");
	  });
	 
	
	  </script>
</html>

