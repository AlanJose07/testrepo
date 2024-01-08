<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard" />
<head>
<meta name="google-site-verification" content="KHmgYb76Hy2a7H12NNQGA-oT9e_WaRa62-13e8DG5Vs" />
<meta charset="utf-8" />
<title>
<rn:page_title />
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="//www.beachbody.com/text/css/bbv6_stylesheet.css"
        title="style">
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="//www.beachbody.com/text/css/bbv6_ie.css" title="style" />
	<![endif]-->
<script type="text/javascript" src="//www.beachbody.com/text/js/menu.js"></script>
<script src="//www.beachbody.com/text/js/emailSignup.js" type="text/javascript" language="javascript"></script>
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:theme path="/euf/assets/themes/standard" css="site.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
<rn:head_content />
<link rel="icon" href="images/favicon.png" type="image/png" />
</head>
<!-- Redirection of old beachbody interface to new US interface beach lob-->
<?php ?><?php $actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	 $urlSplit =explode(".",$actual_link);
	
	if($urlSplit[1]="custhelp")
	{
	  header("Location: http://faq.beachbody.com".$_SERVER[REQUEST_URI]."/lob/beach", true, 301);
	
	}
?><?php ?>
<body id="rn_secondarystyle" class="yui-skin-sam yui3-skin-sam">
<!-- Start Menue -->
<style>
        #header
        {
            width: 960px;
            margin: 0 auto;
        }
    </style>
<div id="bbv6_wrap">
  <div id="header" align="center">
    <!--TopNav Start-->
    <script>
                function checkKeyword(keyword, defaultText) {
                    var minKeywordLength = 0;
                    var maxKeywordLength = 0;
                    minKeywordLength += 3;
                    maxKeywordLength += 256;
                    var errMsg = '';
                    var searchTerms = '';
                    keyword.value = jQuery.trim(keyword.value);
                    searchTerms = keyword.value;
                    defaultText = "Search";
                    var noSearchTerm = "Please enter a keyword or item number";
                    var shortSearchTerm = "Your keyword or item number must be at least 3 characters long";
                    if (searchTerms == defaultText) {
                        alert(noSearchTerm);
                        return false;
                    }
                    if (searchTerms == '') {
                        alert(noSearchTerm);
                        return false;
                    } else if (searchTerms.length < minKeywordLength) {
                        alert(shortSearchTerm);
                        return false;
                    } else {
                        return true;
                    }
                }
                function checkIfDefault(keyword) {
                    var defaultSearchTerm = "Search";
                    if (keyword == defaultSearchTerm) {
                        return '';
                    }
                    else {
                        return keyword;
                    }
                }
                function changeUrl(frm, thisurl) {
                    var optionurl = thisurl.options[thisurl.selectedIndex].value;
                    if (optionurl == "0") {
                        return;
                    }
                    location.href = optionurl
                }
                function logLink(linkname) {
                    var s = window.s; s.linkTrackVars = 'eVar11,eVar30,prop11,prop30'; s.eVar11 = linkname; s.eVar30 = linkname; s.prop30 = linkname; s.tl(this, 'o', linkname);
                }  
            </script>
    <a href="//www.beachbody.com/" class="logo" title="Beachbody&#174;" onClick="logLink('global:logo:home');"> Beachbody&#174;</a>
    <div id="phone"> Call now <strong>1 (800) 998-1681</strong> or order online. <span>Mon&ndash;Fri 9 AM&ndash;7
      PM, Sat&ndash;Sun 10 AM&ndash;6 PM ET</span> <a href="javascript:NewWindow=window.open('//www.beachbody.com/text/pops/international.html','myWindow','width=550,height=600,left=100,top=100,toolbar=No,location=No,scrollbars=Yes,status=Yes ,resizable=Yes,fullscreen=No'); NewWindow.focus(); void(0);"
                        class="intl" onClick="logLink('global:international');">We Ship Worldwide.</a></div>
    <div id="dropdown">
      <select onChange="changeUrl(this.form,this)" name="cs_popup_name_1" class="drop_down_menu">
        <option value="#" selected>Choose A Product . . .</option>
        <option value="http://www.beachbody.com/" onClick="logLink('global:dd:home');">Beachbody
        Home Page</option>
        <option value="#" class="sb">------------------------------</option>
        <option value="http://www.beachbody.com/category/fitness_programs/best_sellers.do"
                        class="hdr" onClick="logLink('global:dd:fit:seenontv');">FITNESS PRODUCTS AS SEEN
        ON TV</option>
        <option value="#" class="sb">------------------------------</option>
        <option value="http://www.beachbody.com/product/fitness_programs/p90x.do" onClick="logLink('global:dd:fit:p90x');"> P90X&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/insanity.do" onClick="logLink('global:dd:fit:san');"> INSANITY&reg;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbofire.do" onClick="logLink('global:dd:fit:tr');"> TurboFire&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/brazil_butt_lift.do"
                        onclick="logLink('global:dd:fit:bl');">Brazil Butt Lift&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/slim_in_6.do" onClick="logLink('global:dd:fit:sl6');"> Slim in 6&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/10_minute_trainer.do"
                        onclick="logLink('global:dd:fit:tm');">10-Minute Trainer&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbo-jam.do" onClick="logLink('global:dd:fit:tj');"> Turbo Jam&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/hip_hop_abs.do"
                        onclick="logLink('global:dd:fit:hha');">Hip Hop Abs&#174;</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/category/fitness_programs/best_sellers.do"
                        class="hdr" onClick="logLink('global:dd:fit:more');">MORE FITNESS PROGRAMS</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/product/fitness_programs/10_minute_trainer_deluxe.do"
                        onclick="logLink('global:dd:fit:tmdlx');">10-Minute Trainer&#174; Deluxe</option>
        <option value="http://www.beachbody.com/product/club/10_minute_trainer_club.do" onClick="logLink('global:dd:fit:tmclub');"> 10-Minute Trainer&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/body-gospel.do"
                        onclick="logLink('global:dd:fit:bg');">Body Gospel&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/bodygospel-sweat-and-sculpt.do"
                        onclick="logLink('global:dd:fit:bgss');">Body Gospel&#174; Sweat &amp; Sculpt</option>
        <option value="http://www.beachbody.com/product/fitness_programs/brazil-butt-lift-deluxe-workout.do"
                        onclick="logLink('global:dd:fit:bldlx');">Brazil Butt Lift&#174; Deluxe Upgrade</option>
        <option value="http://www.beachbody.com/product/fitness_programs/brazilbuttlift-secret-weapon.do"
                        onclick="logLink('global:dd:fit:bllsw');">Brazil Butt Lift&#174; Leandro's Secret
        Weapon Workout</option>
        <option value="http://www.beachbody.com/product/fitness_programs/chalean_extreme.do"
                        onclick="logLink('global:dd:fit:ce');">ChaLEAN Extreme&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/chalean_extreme_deluxe.do"
                        onclick="logLink('global:dd:fit:cedlx');">ChaLEAN Extreme&#174; Deluxe Upgrade</option>
        <option value="http://www.beachbody.com/product/club/chalean_extreme_club.do" onClick="logLink('global:dd:fit:ceclub');"> ChaLEAN Extreme&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbo_jam_get_on_the_ball.do"
                        onclick="logLink('global:dd:fit:gotb');">Chalene Johnson's Get On the Ball!</option>
        <option value="http://www.beachbody.com/product/fitness_programs/get_real.do" onClick="logLink('global:dd:fit:gr');"> Get Real with Shaun T&#153;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/great_body_guaranteed.do"
                        onclick="logLink('global:dd:fit:gbg');">Great Body Guaranteed!&#153;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/hip_hop_abs_extreme.do"
                        onclick="logLink('global:dd:fit:hhae');">Hip Hop Abs&#174; Extreme</option>
        <option value="http://www.beachbody.com/product/fitness_programs/hip_hop_abs_ultimate_results.do"
                        onclick="logLink('global:dd:fit:hhaur');">Hip Hop Abs&#174; Ultimate Results!</option>
        <option value="http://www.beachbody.com/product/club/hip_hop_abs_club.do" onClick="logLink('global:dd:fit:hhaclub');"> Hip Hop Abs&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/specialty_programs/ho_ala_ke_kino.do"
                        onclick="logLink('global:dd:fit:hoa');">Ho'Ala ke Kino</option>
        <option value="http://www.beachbody.com/product/fitness_programs/advanced/insanity_deluxe.do"
                        onclick="logLink('global:dd:fit:sandlx');">INSANITY&#174; Deluxe</option>
        <option value="http://www.beachbody.com/product/fitness_programs/extreme/insanity-fast-furious.do"
                        onclick="logLink('global:dd:fit:sanff');">INSANITY&#174; Fast and Furious</option>
        <option value="http://www.beachbody.com/product/fitness_programs/kathy_smiths_project_you.do"
                        onclick="logLink('global:dd:fit:ks');">Kathy Smith's Project:YOU! Type 2&#153;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/p90x-mc2-workout-the-next-p90x.do"
                        onclick="logLink('global:dd:fit:p90xmc2');">P90X:MC2&#153;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/p90x-one-on-one-workout.do"
                        onclick="logLink('global:dd:fit:th');">P90X ONE on ONE&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/p90x_plus.do" onClick="logLink('global:dd:fit:p90xp');"> P90X Plus&#151;The Next Level</option>
        <option value="http://www.beachbody.com/category/p90x-online/shop.do" onClick="logLink('global:dd:fit:p90xclub');"> P90X&#174&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/power90.do" onClick="logLink('global:dd:fit:p90');"> Power 90&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/power_90_master_series.do"
                        onclick="logLink('global:dd:fit:p90ms');">Power 90&#174; Master Series</option>
        <option value="http://www.beachbody.com/product/club/power90_club.do" onClick="logLink('global:dd:fit:p90club');"> Power 90&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/power_half_hour.do"
                        onclick="logLink('global:dd:fit:phh');">Power Half Hour&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/revabs.do" onClick="logLink('global:dd:fit:ra');"> RevAbs&#174;</option>
        <option value="http://www.beachbody.com/product/club/revabs_club.do" onClick="logLink('global:dd:fit:raclub');"> RevAbs&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/rockin_body.do"
                        onclick="logLink('global:dd:fit:rb');">Rockin' Body&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/hip_hop_abs_dance_party_series.do"
                        onclick="logLink('global:dd:fit:dps');">Shaun T's Dance Party Series</option>
        <option value="http://www.beachbody.com/product/fitness_programs/fit_kids_club.do"
                        onclick="logLink('global:dd:fit:fk');">Shaun T's Fit Kids&#153; Club</option>
        <option value="http://www.beachbody.com/product/fitness_programs/slim_series.do"
                        onclick="logLink('global:dd:fit:ss');">Slim Series&#174;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/slim_series_express.do"
                        onclick="logLink('global:dd:fit:sse');">Slim Series&#174; Express</option>
        <option value="http://www.beachbody.com/product/club/slim_in_6_club.do" onClick="logLink('global:dd:fit:sl6club');"> Slim in 6&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/fitness_programs/total_body_solution.do"
                        onclick="logLink('global:dd:fit:tb');">Total Body Solution&#153;</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbofire.do" onClick="logLink('global:dd:fit:tr');"> TurboFire&#174;</option>
        <option value="http://www.beachbody.com/product/turbofire-club.do" onClick="logLink('global:dd:fit:trac');"> TurboFire&#174; Advanced Classes</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbofire-greatest-hiits.do"
                        onclick="logLink('global:dd:fit:trgh');">TurboFire&#174; Greatest HIITs</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbo_jam_fat_burning_elite.do"
                        onclick="logLink('global:dd:fit:tjfbe');">Turbo Jam&#174; Fat Burning Elite</option>
        <option value="http://www.beachbody.com/product/fitness_programs/turbo_jam_live.do"
                        onclick="logLink('global:dd:fit:tjlive');">Turbo Jam&#174; LIVE!</option>
        <option value="http://www.beachbody.com/product/club/turbo_jam_club.do" onClick="logLink('global:dd:fit:tjclub');"> Turbo Jam&#174;&#151;More exciting products</option>
        <option value="http://www.beachbody.com/product/club/yoga_booty_ballet.do" onClick="logLink('global:dd:fit:ybb');"> Yoga Booty Ballet&#174; Ab &amp; Butt Makeover</option>
        <option value="http://www.beachbody.com/product/fitness_programs/yoga_booty_ballet_baby.do"
                        onclick="logLink('global:dd:fit:ybbbw');">Yoga Booty Ballet&#174; Baby On the Way</option>
        <option value="http://www.beachbody.com/product/fitness_programs/yoga_booty_ballet_master_series.do"
                        onclick="logLink('global:dd:fit:ybbms');">Yoga Booty Ballet&#174; Master Series</option>
        <option value="http://www.beachbody.com/product/fitness_programs/yoga_booty_ballet_pure.do"
                        onclick="logLink('global:dd:fit:ybbps');">Yoga Booty Ballet&#174; Pure &amp; Simple
        Yoga</option>
        <option value="http://www.beachbody.com/product/club/yoga_booty_ballet_club.do" onClick="logLink('global:dd:fit:ybbclub');"> Yoga Booty Ballet&#174;&#151;More exciting products</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/category/supplements/best_sellers.do" class="hdr"
                        onclick="logLink('global:dd:sups');">NUTRITION &amp; SUPPLEMENTS</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/product/supplements/nutrition-health-shake/shakeology.do?code=DD_SK"
                        onclick="logLink('global:dd:sups:sk');">Shakeology&#174;</option>
        <option value="http://www.beachbody.com/product/supplements/best_sellers/2day_fast_formula.do"
                        onclick="logLink('global:dd:sups:2dff');">2-Day Fast Formula&#174; shake</option>
        <option value="http://www.beachbody.com/product/supplements/best_sellers/activit_multivitamins.do"
                        onclick="logLink('global:dd:sups:actv');">ActiVit&#174; Multivitamins</option>
        <option value="http://www.beachbody.com/product/supplements/best_sellers/cal_mag.do"
                        onclick="logLink('global:dd:sups:cmag');">Core Cal-Mag&#153;</option>
        <option value="http://www.beachbody.com/product/supplements/best_sellers/omega3.do"
                        onclick="logLink('global:dd:sups:omega');">Core Omega-3&#153;</option>
        <option value="http://www.beachbody.com/product/supplements/best_sellers/core_nutrition_pack_metabolism.do"
                        onclick="logLink('global:dd:sups:cnp');">Core Nutrition Pack</option>
        <option value="http://www.beachbody.com/product/supplements//herbal_immune_boost.do"
                        onclick="logLink('global:dd:sups:hib');">Herbal Immune Boost</option>
        <option value="http://www.beachbody.com/product/supplements/wellness/joint_support_super_formula.do"
                        onclick="logLink('global:dd:sups:jssf');">Joint Support Super Formula</option>
        <option value="http://www.beachbody.com/product/supplements/meal_replacement/meal_replacement_shake.do"
                        onclick="logLink('global:dd:sups:mrs');">Meal Replacement Shake</option>
        <option value="http://www.beachbody.com/product/supplements/p90x_peak_performance/p90x_peak_health_formula.do"
                        onclick="logLink('global:dd:sups:phf');">P90X&#174; Peak Health Formula</option>
        <option value="http://www.beachbody.com/product/supplements/p90x_peak_performance/p90x_peak_performance_protein_bars_new.do"
                        onclick="logLink('global:dd:sups:ppb');">P90X&#174; Peak Performance Protein Bars</option>
        <option value="http://www.beachbody.com/product/supplements/p90x_peak_performance/p90x_peak_recovery_formula.do"
                        onclick="logLink('global:dd:sups:rrf');">P90X&#174; Results and Recovery Formula</option>
        <option value="http://www.beachbody.com/product/supplements/muscle_enhancement/performance_formula.do"
                        onclick="logLink('global:dd:sups:pf');">Performance Formula</option>
        <option value="http://www.beachbody.com/product/supplements/muscle_enhancement/pure_creatine.do"
                        onclick="logLink('global:dd:sups:pc');">Pure Creatine</option>
        <option value="http://www.beachbody.com/product/supplements/weight_loss/slimming_formula.do"
                        onclick="logLink('global:dd:sups:sf');">Slimming Formula</option>
        <option value="http://www.beachbody.com/product/supplements/muscle_enhancement/strength_and_muscle_mens_formula.do"
                        onclick="logLink('global:dd:sups:smmf');">Strength &amp; Muscle Men's Formula</option>
        <option value="http://www.beachbody.com/product/supplements/wellness/total_health_womens_formula.do"
                        onclick="logLink('global:dd:sups:thwf');">Total Health Women's Formula</option>
        <option value="http://www.beachbody.com/product/supplements/meal_replacement/whey_protein_powder.do"
                        onclick="logLink('global:dd:sups:wpp');">Whey Protein Powder</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/category/fitness_gear/best_sellers.do" class="hdr"
                        onclick="logLink('global:dd:gear');">FITNESS GEAR</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/ankle_weights.do"
                        onclick="logLink('global:dd:gear:aw');">Ankle Weights</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/balance_ball.do"
                        onclick="logLink('global:dd:gear:bb');">Balance Ball</option>
        <option value="http://www.beachbody.com/product/fitness_gear/beachbody_logo_wear/beachbody_backpack.do"
                        onclick="logLink('global:dd:gear:bbb');">Beachbody Backpack</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/squishy_ball.do"
                        onclick="logLink('global:dd:gear:bbsb');">Beachbody Squishy Ball</option>
        <option value="http://www.beachbody.com/product/fitness_gear/beachbody_logo_wear/men_beachbody_shirts.do"
                        onclick="logLink('global:dd:gear:btm');">Beachbody T-Shirts Men's</option>
        <option value="http://www.beachbody.com/product/fitness_gear/beachbody_logo_wear/women_beachbody_shirts.do"
                        onclick="logLink('global:dd:gear:btw');">Beachbody T-Shirts Women's</option>
        <option value="http://www.beachbody.com/category/fitness_gear/bands_balls_weights.do"
                        onclick="logLink('global:dd:gear:bbw');">Bands, Balls &amp; Weights</option>
        <option value="http://www.beachbody.com/product/fitness_gear/progress_tools/body_fat_tester.do"
                        onclick="logLink('global:dd:gear:bft');">Body Fat Tester</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/booty_bands.do"
                        onclick="logLink('global:dd:gear:booty');">Booty Bands</option>
        <option value="http://www.beachbody.com/category/fitness_gear/core_yoga_gear.do"
                        onclick="logLink('global:dd:gear:cyg');">Core/Yoga Gear</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/dumbbell_set.do"
                        onclick="logLink('global:dd:gear:ds');">Dumbbell Set</option>
        <option value="http://www.beachbody.com/product/fitness_gear/progress_tools/bowflex_heart_rate_monitor.do"
                        onclick="logLink('global:dd:gear:hrmft');">Heart Rate Monitor &ndash; Bowflex&reg;
        Fit Trainer</option>
        <option value="http://www.beachbody.com/product/fitness_gear/progress_tools/bowflex_heart_rate_monitor_strapless.do"
                        onclick="logLink('global:dd:gear:hrmsl');">Heart Rate Monitor &ndash; Bowflex&reg;
        Strapless</option>
        <option value="http://www.beachbody.com/product/fitness_gear/progress_tools/bowflex_heart_rate_monitor_strap.do"
                        onclick="logLink('global:dd:gear:hrmcs');">Heart Rate Monitor &ndash; Bowflex&reg;
        with Chest Strap</option>
        <option value="http://www.beachbody.com/category/fitness_gear/p90x_gear.do" onClick="logLink('global:dd:gear:pg');"> P90X&#174; Gear </option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/p90x_chin_up_bar.do"
                        onclick="logLink('global:dd:gear:pcb');">P90X&#174; Chin-Up Bar</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/p90x_posters.do"
                        onclick="logLink('global:dd:gear:pp');">P90X&#174; Posters</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/p90x_tank.do"
                        onclick="logLink('global:dd:gear:pt');">P90X&#174; Tanks</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/p90x_men_tees.do"
                        onclick="logLink('global:dd:gear:ptm');">P90X&#174; T-Shirts Men's</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/p90x_tees_women.do"
                        onclick="logLink('global:dd:gear:ptw');">P90X&#174; T-Shirts Women's</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/plyometrics_mat.do"
                        onclick="logLink('global:dd:gear:pm');">Plyometrics Mat</option>
        <option value="http://www.beachbody.com/product/fitness_gear/p90x_gear/pushup_stands.do"
                        onclick="logLink('global:dd:gear:ps');">Push-Up Stands</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/blines_comfort_grip_handles.do"
                        onclick="logLink('global:dd:gear:rbhdl');">Resistance Bands&#151;Handles</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/resistance_band_pink.do"
                        onclick="logLink('global:dd:gear:rbi');">Resistance Bands&#151;Individual </option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/standard_kit.do"
                        onclick="logLink('global:dd:gear:rbstk');">Resistance Bands&#151;Standard Kit </option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/super_kit.do"
                        onclick="logLink('global:dd:gear:rbsuk');">Resistance Bands&#151;Super Kit </option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/extreme_kit.do"
                        onclick="logLink('global:dd:gear:rbek');">Resistance Bands&#151;Extreme Kit </option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/complete_kit.do"
                        onclick="logLink('global:dd:gear:rbck');">Resistance Bands&#151;Complete Kit </option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/blines_upgrade_kit.do"
                        onclick="logLink('global:dd:gear:rbuk');">Resistance Bands&#151;Upgrade Kit</option>
        <option value="http://www.beachbody.com/product/fitness_gear/core_yoga_gear/sculpting_bands.do"
                        onclick="logLink('global:dd:gear:sc');">Sculpting Bands</option>
        <option value="http://www.beachbody.com/product/fitness_gear/powerstands.do" onClick="logLink('global:dd:gear:thps');"> Tony Horton's PowerStands&#174;</option>
        <option value="http://www.beachbody.com/category/fitness_gear/turbo_jam_gear.do"
                        onclick="logLink('global:dd:gear:tjg');">Turbo Jam&#174; Gear </option>
        <option value="http://www.beachbody.com/product/fitness_gear/beachbody_logo_wear/turbo_jam_tanks.do"
                        onclick="logLink('global:dd:gear:tjt');">Turbo Jam&#174; Tanks </option>
        <option value="http://www.beachbody.com/product/fitness_gear/walking-bands.do" onClick="logLink('global:dd:gear:wb');"> Walking Bands</option>
        <option value="http://www.beachbody.com/product/fitness_gear/bands_balls_weights/weighted_gloves.do"
                        onclick="logLink('global:dd:gear:wg');">Weighted Gloves </option>
        <option value="http://www.beachbody.com/product/fitness_gear/core_yoga_gear/yoga_blocks.do"
                        onclick="logLink('global:dd:gear:yb');">Yoga Blocks</option>
        <option value="http://www.beachbody.com/product/fitness_gear/core_yoga_gear/yoga_monster_mat.do"
                        onclick="logLink('global:dd:gear:ymm');">Yoga Monster Mat</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="#" class="hdr">DIET AND SUPPORT TOOLS</option>
        <option value="#" class="sb">---------------------------</option>
        <option value="http://www.beachbody.com/product/fitness_gear/progress_tools/6day_express_diet_plan.do"
                        onclick="logLink('global:dd:gear:6ddp');">6-Day Express&#153; Diet Plan</option>
        <option value="http://click.websitegear.com/track.asp?id=24047" onClick="logLink('global:dd:club:chat');"> Chatrooms</option>
        <option value="http://click.websitegear.com/track.asp?id=24048" onClick="logLink('global:dd:club:mb');"> Message Boards</option>
        <option value="http://teambeachbody.com/eat-smart/michis-ladder" onClick="logLink('global:dd:club:michi');"> Michi's Ladder</option>
        <option value="http://click.websitegear.com/track.asp?id=24049" onClick="logLink('global:dd:club:home');"> Team Beachbody&#174; Club</option>
        <option value="http://click.websitegear.com/track.asp?id=24050" onClick="logLink('global:dd:club:wowy');"> WOWY&#174; Online gym</option>
      </select>
    </div>
    <ul>
      <li><a href="/" onClick="logLink('global:gn:home');">Home</a></li>
      <li class="submenu"> <a href="http://www.beachbody.com/category/fitness_programs/best_sellers.do" onClick="logLink('global:gn:fit');"
                        onmouseover="cssdropdown.dropit(this,event,'dropmenu1')">Fitness Programs</a></li>
      <li
                            class="submenu"><a href="http://www.beachbody.com/category/supplements/best_sellers.do"
                                onclick="logLink('global:gn:sups');" onMouseOver="cssdropdown.dropit(this,event,'dropmenu2')"> Supplements</a></li>
      <li class="submenu"><a href="http://www.beachbody.com/category/fitness_gear/best_sellers.do"
                                    onclick="logLink('global:gn:gear');" onMouseOver="cssdropdown.dropit(this,event,'dropmenu3')"> Gear</a></li>
      <li><a href="http://www.beachbody.com/category/success_stories.do" onClick="logLink('global:gn:ss');"> Success Stories</a></li>
      <li class="submenu"><a href="http://www.beachbody.com/category/video.do?bclid=6615764001"
                                            onclick="logLink('global:gn:vid');" onMouseOver="cssdropdown.dropit(this,event,'dropmenu4')"> Videos</a></li>
      <li class="submenu"><a href="http://www.teambeachbody.com/" onClick="logLink('global:gn:com');"
                                                target="_blank" onMouseOver="cssdropdown.dropit(this,event,'dropmenu5')">Community
        &amp; Support</a></li>
      <li><a href="http://www.beachbody.com/basket.do" onClick="logLink('global:gn:cart');"> Shopping Cart</a></li>
      <li class="search" style="display: block;">
        <form name="searchForm" method="post" action="http://www.beachbody.com/search.do"
                                                        onsubmit="document.searchForm.pageName.value=getVariableValue('pageName');return checkKeyword(this.keyword);">
          <input type="text" name="keyword" value="Search" size="18" maxlength="256" class="navsearchbox"
                                                            id="navsearchbox" onFocus="this.value='';return false;" />
          <!--<button value="Search" class="searchbtn">Search</button>-->
          <input
                                                                type="image" class="searchbtn" name="Search" src="//www.beachbody.com/images/beachbody/en_us/global/bbv6/search_btn.png"
                                                                border="0" alt="Search" />
          <input type="hidden" name="pageName" value="" />
        </form>
      </li>
    </ul>
    <!--1st drop down menu / fitness programs -->
    <div id="dropmenu1" class="dropmenu">
      <ul>
        <li><a href="http://www.beachbody.com/category/fitness_programs/best_sellers.do"
                        onclick="logLink('global:gn:fit:bs');">Best Sellers</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/weight_loss.do"
                            onclick="logLink('global:gn:fit:wl');">Weight Loss</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/advanced.do"
                                onclick="logLink('global:gn:fit:adv');">Advanced</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/express.do"
                                    onclick="logLink('global:gn:fit:exp');">Express</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/abs_core.do"
                                        onclick="logLink('global:gn:fit:core');">Abs/Core</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/dance.do"
                                            onclick="logLink('global:gn:fit:dance');">Dance</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/extreme.do"
                                                onclick="logLink('global:gn:fit:er');">Extreme Results</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/cardio.do"
                                                    onclick="logLink('global:gn:fit:cardio');">Cardio/Fat Burning</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/getting_started.do"
                                                        onclick="logLink('global:gn:fit:gs');">Getting Started</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/specialty_programs.do"
                                                            onclick="logLink('global:gn:fit:sp');">Specialty Programs</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_programs/compare_fitness_programs.do"
                                                                onclick="logLink('global:gn:fit:chart');">Compare Fitness Programs</a></li>
      </ul>
    </div>
    <!--2nd drop down menu / supplements -->
    <div id="dropmenu2" class="dropmenu">
      <ul>
        <li><a href="http://www.beachbody.com/category/supplements/best_sellers.do" onClick="logLink('global:gn:sups:bs');"> Best Sellers</a></li>
        <li><a href="http://www.beachbody.com/category/supplements/meal_replacement.do"
                            onclick="logLink('global:gn:sups:mr');">Meal Replacement</a></li>
        <li><a href="http://www.beachbody.com/category/supplements/muscle_enhancement.do"
                                onclick="logLink('global:gn:sups:me');">Muscle Enhancement</a></li>
        <li><a href="http://www.beachbody.com/category/supplements/p90x_peak_performance.do"
                                    onclick="logLink('global:gn:sups:p90xpp');">P90X&#174; Peak Performance</a></li>
        <li> <a href="http://www.beachbody.com/category/supplements/weight_loss.do" onClick="logLink('global:gn:sups:wl');"> Weight Loss</a></li>
        <li><a href="http://www.beachbody.com/category/supplements/wellness.do"
                                                onclick="logLink('global:gn:sups:well');">Wellness</a></li>
      </ul>
    </div>
    <!--3rd anchor link and menu / fitness gear -->
    <div id="dropmenu3" class="dropmenu">
      <ul>
        <li><a href="http://www.beachbody.com/category/fitness_gear/best_sellers.do" onClick="logLink('global:gn:gear:bs');"> Best Sellers</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_gear/bands_balls_weights.do"
                            onclick="logLink('global:gn:gear:bbw');">Bands, Balls &amp; Weights</a></li>
        <li><a
                                href="http://www.beachbody.com/category/fitness_gear/p90x_gear.do" onClick="logLink('global:gn:gear:pg');"> P90X&#174; Gear</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_gear/turbo_jam_gear.do"
                                    onclick="logLink('global:gn:gear:tjg');">Turbo Jam&#174; Gear</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_gear/core_yoga_gear.do"
                                        onclick="logLink('global:gn:gear:cyg');">Core/Yoga Gear</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_gear/progress_tools.do"
                                            onclick="logLink('global:gn:gear:ft');">Fitness Trackers</a></li>
        <li><a href="http://www.beachbody.com/category/fitness_gear/beachbody_logo_wear.do"
                                                onclick="logLink('global:gn:gear:wear');">Beachbody Logo Wear</a></li>
      </ul>
    </div>
    <!--4th anchor link and menu / video -->
    <div id="dropmenu4" class="dropmenu">
      <ul>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6615764001" onClick="logLink('global:gn:vid');"> Beachbody Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6614435001"
                            onclick="logLink('global:gn:vid:p90x');">P90X&#174; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6622707001"
                                onclick="logLink('global:gn:vid:tj');">Turbo Jam&#174; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=67394813001"
                                    onclick="logLink('global:gn:vid:tr');">TurboFire&#174; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6622713001"
                                        onclick="logLink('global:gn:vid:tm');">10 Minute Trainer&#174; Videos</a></li>
        <li><a
                                            href="http://www.beachbody.com/category/video.do?bclid=6614438001" onClick="logLink('global:gn:vid:th');"> P90X ONE on ONE&trade; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6615759001"
                                                onclick="logLink('global:gn:vid:ce');">ChaLEAN Extreme&#174; Videos</a></li>
        <li><a
                                                    href="http://www.beachbody.com/category/video.do?bclid=6614439001" onClick="logLink('global:gn:vid:sl6');"> Slim in 6&#174; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6614436001"
                                                        onclick="logLink('global:gn:vid:hha');">Hip Hop Abs&#174; Videos</a></li>
        <li><a href="http://www.beachbody.com/category/video.do?bclid=6615761001"
                                                            onclick="logLink('global:gn:vid:rb');">Rockin' Body&#174; Videos</a></li>
      </ul>
    </div>
    <!--5th anchor link and menu / team beachbody -->
    <div id="dropmenu5" class="dropmenu">
      <ul>
        <li><a href="http://www.beachbody.com/category/newsletters.do" onClick="logLink('global:gn:nl');"> Beachbody&#174; Newsletter</a></li>
        <li><a href="http://www.beachbody.com/category/p90x-online.do"
                            onclick="logLink('global:gn:p90xo:nl');">P90X&#174; Extreme Newsletter</a></li>
        <li><a
                                href="http://teambeachbody.com/c/portal/login" target="_blank" onClick="logLink('global:gn:club:login');"> Team Beachbody&#174; Login</a></li>
        <li><a href="http://teambeachbody.com/signup"
                                    target="_blank" onClick="logLink('global:gn:club:signup');">Join Team Beachbody&#174;
          Club</a></li>
        <li><a href="http://coachdestinations.com/" target="_blank" onClick="logLink('global:gn:coachopportunity');"> Coach Destinations</a></li>
        <li><a href="http://teambeachbody.com/connect/message-boards"
                                            target="_blank" onClick="logLink('global:gn:club:mb');">Message Boards</a></li>
        <li><a
                                                href="http://teambeachbody.com/connect/chat-rooms" target="_blank" onClick="logLink('global:gn:club:chat');"> Chat Rooms</a></li>
        <li><a href="http://www.wowy.com/" target="_blank" onClick="logLink('global:gn:club:wowy');"> WOWY&#174; SuperGym</a></li>
        <li><a href="http://beachbody.custhelp.com/" onClick="logLink('global:gn:custserv');"> Customer Support</a></li>
        <li><a href="http://beachbody.custhelp.com/" onClick="logLink('global:gn:contact');"> Contact Us</a></li>
      </ul>
    </div>
    <div class="clear"> </div>
  </div>
  <div id="rn_Container">
    <div id="rn_SkipNav"> <a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
    <div id="rn_Header" role="banner">
      <rn:widget path="utils/CapabilityDetector" />
      <div id="rn_Logo"> <a href="/app/#rn:config:CP_HOME_URL##rn:session#"><span class="rn_LogoTitle">#rn:msg:SUPPORT_CENTER_LBL#</span></a></div>
      <div id="rn_LoginStatus">
        <rn:condition logged_in="true"> #rn:msg:WELCOME_BACK_LBL# <strong>
          <rn:field name="Contact.LookupName"/>
          <rn:condition language_in="ja-JP">#rn:msg:NAME_SUFFIX_LBL#</rn:condition>
          </strong>
          <div>
            <rn:field name="Contact.Organization.LookupName"/>
          </div>
          <rn:widget path="login/LogoutLink"/>
          <rn:condition_else />
          <rn:condition config_check="PTA_ENABLED == true"> <a href="javascript:void(0);" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="javascript:void(0);">#rn:msg:SIGN_UP_LBL#</a>
            <rn:condition_else />
            <a href="javascript:void(0);" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="/app/utils/create_account#rn:session#">#rn:msg:SIGN_UP_LBL#</a>
            <rn:condition hide_on_pages="utils/create_account, utils/login_form, utils/account_assistance">
              <rn:widget path="login/LoginDialog" trigger_element="rn_LoginLink"/>
            </rn:condition>
            <rn:condition show_on_pages="utils/create_account, utils/login_form, utils/account_assistance">
              <rn:widget path="login/LoginDialog" trigger_element="rn_LoginLink" redirect_url="/app/account/overview"/>
            </rn:condition>
          </rn:condition>
        </rn:condition>
      </div>
    </div>
    <div id="rn_Navigation">
      <rn:condition hide_on_pages="utils/help_search">
        <div id="rn_NavigationBar" role="navigation">
          <ul>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/#rn:config:CP_HOME_URL#" pages="home, "/>
            </li>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ANSWERS_HDG#" link="/app/answers/list" pages="answers/list, answers/detail, answers/intent"/>
            </li>
            <rn:condition config_check="COMMUNITY_ENABLED == true">
              <li>
                <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:COMMUNITY_LBL#" link="#rn:config:COMMUNITY_HOME_URL:RNW##rn:community_token:?#" external="true"/>
              </li>
            </rn:condition>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/ask" pages="ask, ask_confirm"/>
            </li>
            <li>
              <rn:widget path="navigation/NavigationTab" label_tab="Live Chat" link="/app/chat/chat_launch" pages="chat/chat_launch"/>
            </li>
            <!--li><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:YOUR_ACCOUNT_LBL#" link="/app/account/overview" pages="utils/account_assistance, account/overview, account/profile, account/notif, account/change_password, account/questions/list, account/questions/detail, account/notif/list, utils/login_form, utils/create_account, utils/submit/password_changed, utils/submit/profile_updated"
                subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > /app/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > /app/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > /app/account/profile, #rn:msg:NOTIFICATIONS_LBL# > /app/account/notif/list"/></li-->
          </ul>
        </div>
      </rn:condition>
    </div>
    <div id="rn_Body">
      <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
        <rn:page_content />
      </div>
      <div id="rn_SideBar" role="navigation">
        <div class="rn_Padding">
          <rn:condition hide_on_pages="account/questions/list">
            <div class="rn_Module" role="search">
              <!--h2>#rn:msg:FIND_ANS_HDG#</h2>
                    <rn:widget path="search/SimpleSearch"/-->
              <rn:widget path="utils/AnnouncementText" file_path="/euf/assets/announcements/announcement.html" />
            </div>
          </rn:condition>
          <div class="rn_Module">
            <rn:widget path="custom/scratch/CustomVitaminForm" />
          </div>
          <!--div class="rn_Module">
                    <h2>#rn:msg:CONTACT_US_LBL#</h2>
                    <div class="rn_HelpResources">
                        <div class="rn_Questions">
                            <a href="/app/ask#rn:session#">#rn:msg:ASK_QUESTION_LBL#</a>
                            <span>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</span>
                        </div>
                    <rn:condition config_check="COMMUNITY_ENABLED == true">
                        <div class="rn_Community">
                            <a href="javascript:void(0);">#rn:msg:ASK_THE_COMMUNITY_LBL#</a>
                            <span>#rn:msg:SUBMIT_QUESTION_OUR_COMMUNITY_CMD#</span>
                        </div>
                    </rn:condition>
                    <rn:condition config_check="MOD_CHAT_ENABLED == true">
                        <rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1"/>
                    </rn:condition>
                        <div class="rn_Contact">
                            <a href="javascript:void(0);">#rn:msg:CONTACT_US_LBL#</a>
                            <span>#rn:msg:CANT_YOURE_LOOKING_SITE_CALL_MSG#</span>
                        </div>
						<rn:condition config_check="CP_CONTACT_LOGIN_REQUIRED == false" logged_in="true">
                        <div class="rn_Feedback">
                            <rn:widget path="feedback/SiteFeedback" />
                            <span>#rn:msg:SITE_USEFUL_MSG#</span>
                        </div>
                    </rn:condition>
                    </div-->
        </div>
      </div>
    </div>
  </div>
  <div id="rn_Footer" role="contentinfo">
    <div id="rn_RightNowCredit">
      <rn:condition hide_on_pages="utils/guided_assistant">
        <div class="rn_FloatLeft">
          <rn:widget path="utils/PageSetSelector"/>
        </div>
      </rn:condition>
      <div class="rn_FloatRight">
      <!-- Removed for version upgrade  <rn:widget path="utils/RightNowLogo" />-->
      </div>
    </div>
  </div>
  <div id="footer">
    <div id="footer_bar">
      <div id="mbg"> <a href="javascript:NewWindow=window.open('//www.beachbody.com/text/pops/mbg.html','myWindow','width=550,height=600,left=100,top=100,toolbar=No,location=No,scrollbars=Yes,status=Yes,resizable=Yes,fullscreen=No'); NewWindow.focus(); void(0);"
                        title="100% Satisfaction 30-Day Money-Back Guaranteed" onClick="logLink('global:gf:mbg');"> <img src="//www.beachbody.com/images/beachbody/en_us/global/globalgraphics/icon_mbg.png"
                            alt="100% Satisfaction 30-Day Money-Back Guaranteed" width="70" height="70" border="0" /></a>
        <ul>
          <li>Secure online ordering</li>
          <li>Fast 'n' easy checkout</li>
          <li>No-hassle returns</li>
          <li>Friendly customer service</li>
        </ul>
      </div>
      <div id="badges">
        <div> <br>
          <a href="http://www.la.bbb.org/business-reviews/General-Merchandise-Retail-By-Internet/Beachbody-LLC-in-Santa-Monica-CA-13147181"
                            target="_blank" onClick="logLink('global:gf:bbb');"> <img src="//www.beachbody.com/images/beachbody/en_us/global/globalgraphics/bbb.png"
                                alt="BBB Accredited Business" border="0" /></a> </div>
        <!-- <div id="bbb"><a href="http://www.bbbonline.org/cks.asp?id=102032218151521802" target="_blank" onClick="logLink('global:gf:bbb');"><img src="//www.beachbody.com/images/beachbody/en_us//global/globalgraphics/bbb-aplus.png" alt="BBB Rating A+" border="0" /></a> </div>
<div id="verisign"><script src=https://seal.verisign.com/getseal?host_name=search.beachbody.com&size=S&use_flash=YES&use_transparent=YES></script></div>
-->
      </div>
      <? /* Anuj - March 13, 2014 - CP3 migration - Add stellaService section */ ?>
      <div id="stellaService">
        <script type="text/javascript">
						var seal_host = (("https:" == document.location.protocol) ? "https://" : "http://");
						document.write(unescape("%3Ca target='_blank' href='http://www.stellaservice.com/profile/503'%3E%3Cimg src='" + seal_host + "seal.stellaservice.com/seals/stellaservice_excellent.png?c=503' height='73' width='115' border='0' title='BeachBody.com is top rated for customer service' /%3E%3C/a%3E"));
					</script>
      </div>
      <div id="newsletter"> <a href="https://www.beachbody.com/category/newsletters.do" onClick="logLink('global:gf:nl');"> <img src="//www.beachbody.com/images/beachbody/en_us/global/globalgraphics/icon_newsletter.png"
                            alt="Beachbody Newsletter" width="50" height="65" border="0" /></a>
        <h2 style="color: #C60;"> Newsletters</h2>
        <p> Special offers, tips, and tools!</p>
        <? /* Anuj - March 13, 2014 - CP3 migration - Fix email subscribe */ ?>
        <form class="email" onSubmit="return subscribeEmail(this)" name="myForm-footer" id="footer-form"
                    target="_parent" action="">
          <input type="hidden" name="QS" class="txt">
          <input type="hidden" name="GenerateNewPassword" value="0" />
          <input maxlength="50" name="subscriberkey" value="Enter email address" onFocus="this.value='';return false;"
							size="30" tabindex="1" class="txt" type="text" />
          <input type="submit" id="bb-nl-Submit" value="" style="background-image:url('//www.beachbody.com/images/beachbody/en_us/global/globalgraphics/btn_sb_arrow.png');width:23px;height:19px;border:0;cursor:pointer;" class="btn" />
        </form>
        <? /* //--commnent out old code--
                    <form class="email" onSubmit="return submitIt(this)" name="myForm-footer" id="footer-form"
                    target="_parent">
                    <input type="hidden" name="GenerateNewPassword" value="0" />
                    <input maxlength="50" name="emailAddr" value="Enter email address" onFocus="this.value='';return false;"
                        size="30" tabindex="1" class="txt" type="text" />
                    <input type="image" name="Submit" id="footer-Submit" value="Submit" src="//www.beachbody.com/images/beachbody/en_us/global/globalgraphics/btn_go.png"
                        class="btn" />
                    </form>
					*/ ?>
      </div>
      <div id="custservice">
        <div id="csrOn"> <a href="https://beachbody.custhelp.com/app/chat/chat_launch" onClick="logLink('global:gf:questions');">
          <h2> Questions?</h2>
          </a>
          <p> <a href="https://beachbody.custhelp.com/app/chat/chat_launch" onClick="logLink('global:gf:questions');"> Click here</a> to chat live with a customer service representative.</p>
        </div>
      </div>
    </div>
    <p class="links"> <a href="http://www.beachbody.com/" onClick="logLink('global:gf:home');">Home</a> | <a href="http://www.beachbody.com/product/about_us/company_overview.do" onClick="logLink('global:gf:about');"> About Us</a> | <a href="http://www.beachbody.com/product/about_us/press.do" onClick="logLink('global:gf:pr');"> Press</a> | <a href="http://www.beachbody.com/category/newsletters.do" onClick="logLink('global:gf:nl');"> Newsletters</a> | <a href="http://teambeachbody.com/connect/message-boards" onClick="logLink('global:gf:club:mb');"> Message Boards</a> | <a href="http://beachbody.custhelp.com/" onClick="logLink('global:gf:custserv');"> Customer Service</a> | <a href="https://beachbody.custhelp.com/app/chat/chat_launch" onClick="logLink('global:gf:livechat');"> Live Chat</a> | <a href="http://www.beachbody.com/account.do?method=start" onClick="logLink('global:gf:myaccount');"> My Account</a> | <a href="http://www.beachbody.com/product/about_us/terms_of_use.do"
                                                onclick="logLink('global:gf:terms');">Terms of Use</a> | <a href="http://www.beachbody.com/product/about_us/privacy_policy.do" onClick="logLink('global:gf:privacy');"> Privacy Policy</a> | <a href="http://www.beachbody.com/product/about_us/site_map.do"
                        onclick="logLink('global:gf:sitemap');">Site Map</a> | <a href="http://beachbody.custhelp.com/"
                            onclick="logLink('global:gf:contact');">Contact Us</a> | <a href="http://www.beachbody.com/basket.do"
                                onclick="logLink('global:gf:cart');">Shopping Cart</a></p>
    <p class="legal"> Results may vary. Exercise and proper diet are necessary to achieve and maintain
      weight loss and muscle definition.<br />
      &copy;
      <script language="JavaScript">
                    <!-- hide from old browsers
                      var today = new Date()
                      var year = today.getYear()
                      if(year<1000) year+=1900
     
                      document.write(year)
                    //-->
                </script>
      Beachbody, LLC. All rights reserved.</p>
  </div>
</div>
</body>
<!-- </div> -->
<div class="hide">
  <!-- GOOGLE ANALYTICS -->
  <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-336852-1']);
        _gaq.push(['_setDomainName', '.beachbody.com']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
  <!-- Omniture Reporting Support -->
  <!-- SiteCatalyst code version: H.19.4. -->
  <script language="JavaScript">
        var siteReferrer = "";
        function getId() { return "mlbbodyprod" } 
    </script>
  <script language="JavaScript" type="text/javascript" src="//www.beachbody.com/omniture/s_code.js"></script>
  <script language="JavaScript" type="text/javascript"><!--
        var pn = window.location.pathname;
        if (pn.indexOf('answers') != -1) { s.pageName = 'Customer Service Answers'; } else s.pageName = 'Customer Service ' + document.title;
        s.channel = 'RightNow';
        s.prop1 = 'Customer Service';
        s.prop2 = 'Customer Service';
        /************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
        var s_code = s.t(); if (s_code) document.write(s_code)//--></script>
  <script language="JavaScript" type="text/javascript"><!--
        if (navigator.appVersion.indexOf('MSIE') >= 0) document.write(unescape('%3C') + '\!-' + '-')
//--></script>
  <noscript>
  <img src="https://marketlive.122.2o7.net/b/ss/mlbbodyprod/1/H.21.1--NS/0" height="1"
            width="1" border="0" alt="" />
  </noscript>
  <!--/DO NOT REMOVE/-->
  <!-- End SiteCatalyst code version: H.21.1. -->
  <!-- End, Omniture Reporting Support -->
</div>
</html>
