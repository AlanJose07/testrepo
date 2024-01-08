<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
<meta name="google-site-verification" content="HwqLY7u-i4q_zW7Im3BQtwjOGKGiDVu8X_7xTVX6ISQ" />
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:theme path="/euf/assets/themes/standard" css="site.css,
		{YUI}/widget-stack/assets/skins/sam/widget-stack.css,
		{YUI}/widget-modality/assets/skins/sam/widget-modality.css,
		{YUI}/overlay/assets/overlay-core.css,
		{YUI}/panel/assets/skins/sam/panel.css" />
<rn:head_content/>
<link rel="icon" href="images/favicon.png" type="image/png"/>
</head>
<!--Redirection from old teambeachbody interface to new US interface team lob-->
<?php $actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	 $urlSplit =explode(".",$actual_link);
	
	if($urlSplit[1]="teambeachbody")
	{
	  header("Location: http://faq.beachbody.com".$_SERVER[REQUEST_URI]."/lob/team", true, 301);
	
	}
?>
<body class="yui-skin-sam yui3-skin-sam">
<div id="wrapper" >
  <!--   <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div> -->
  <div id="rn_Header" role="banner">
    <div id="banner">
      <h1 class="logo"> <a class="png" href="http://teambeachbody.com/home">Team Beachbody</a> <span class="current-community"> Guest </span> </h1>
      <!-- code commented by Abdul on 28Aug2014
				<div class="facebook-like-button">
				  <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fteambeachbody.com%2F&amp;layout=button_count&amp;show_faces=true&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
				  </div>
				  <div class="lfr-dock">
					<ul class="lfr-dock-list first">
					  <li class="not-a-member"> <a href="http://teambeachbody.com/signup">Not a Member?</a> </li>
					  <li class="sign-in"> <a href="http://teambeachbody.com/c/portal/login">Sign In</a> </li>
					  <li><a href="http://teambeachbody.com/tbb/help">Help</a></li>

					  <li><a href="http://teambeachbody.com/tbb/contact-us">Contact Us</a></li>
					  <li class="home">
						<div class="home column"><a href="http://teambeachbody.com/home">Home</a></div>
					  </li>
					</ul>
				  </div> -->
    </div>
    <!--  <div id="rn_LoginStatus">
            <rn:condition logged_in="true">
                 #rn:msg:WELCOME_BACK_LBL#
                <strong>
                    <rn:field name="Contact.LookupName"/><rn:condition language_in="ja-JP">#rn:msg:NAME_SUFFIX_LBL#</rn:condition>
                </strong>
                <div>
                    <rn:field name="Contact.Organization.LookupName"/>
                </div>
                <rn:widget path="login/LogoutLink"/>
            <rn:condition_else />
                <rn:condition config_check="PTA_ENABLED == true">
                    <a href="javascript:void(0);" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="javascript:void(0);">#rn:msg:SIGN_UP_LBL#</a>
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
        </div> -->
  </div>
  <!-- Added to have same menu -->
  <!-- code commented by Abdul on 28Aug2014
	<div id="navigation" class="sort-pages modify-pages">

    <ul>
      <li class=" first"> <a href="http://teambeachbody.com/home" ><span>Home</span></a>
        <ul class="child-menu">
          <li> <a href="http://teambeachbody.com/club-only" >Club Only</a> </li>
        </ul>
      </li>

      <li class=" second"> <a href="http://teambeachbody.com/get-fit" ><span>Get Fit</span></a> </li>
      <li class=""> <a href="http://teambeachbody.com/eat-smart" ><span>Eat Smart</span></a> </li>
      <li class=""> <a href="http://teambeachbody.com/connect" ><span>Connect</span></a> </li>
      <li class=""> <a href="http://teambeachbody.com/watch" ><span>Watch Videos</span></a> </li>

      <li class=""> <a href="http://teambeachbody.com/about" ><span>About</span></a> </li>
      <li class=""> <a href="http://teambeachbody.com/coach" ><span>Coach</span></a> </li>
      <li class=""> <a href="http://teambeachbody.com/shop/-/shopping" ><span>Shop</span></a> </li>
    </ul>

  </div> -->
  <!-- Added to have same menu -->
  <div id="rn_Body">
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
          </ul>
        </div>
      </rn:condition>
    </div>
    <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
      <rn:page_content/>
    </div>
    <!--   <div id="rn_SideBar" role="navigation">
            <div class="rn_Padding">
                <rn:condition hide_on_pages="answers/list, home, account/questions/list">
                <div class="rn_Module" role="search">
                    <h2>#rn:msg:FIND_ANS_HDG#</h2>
                    <rn:widget path="search/SimpleSearch"/>
                </div>
                </rn:condition>
                <div class="rn_Module">
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
                    </div>
                </div>
            </div>
        </div> -->
  </div>
  <!--  <div id="rn_Footer" role="contentinfo">
        <div id="rn_RightNowCredit">
            <rn:condition hide_on_pages="utils/guided_assistant">
            <div class="rn_FloatLeft">
                <rn:widget path="utils/PageSetSelector"/>
            </div>
            </rn:condition>
            <div class="rn_FloatRight">
                <rn:widget path="utils/RightNowLogo"/>
            </div>
        </div>
    </div> -->
  <div id="footer">
    <div class="clearfix">
      <!--<a href="http://teambeachbody.com/tbb/contact-us">Contact Us</a> <a href="http://teambeachbody.com/tbb/press">Press</a> <a href="http://teambeachbody.com/tbb/help">Help/FAQs</a> <a href="http://teambeachbody.com/connect/contests">Contest and Sweepstakes Rules</a> <a href="http://teambeachbody.com/tbb/terms-of-use">Terms of Use</a> <a href="http://teambeachbody.com/tbb/privacy">Privacy</a> <a href="http://teambeachbody.com/tbb/sitemap">Sitemap</a> <span> &copy;-->
      <SCRIPT Language="JavaScript">
  <!-- hide from old browsers
    var today = new Date()
    var year = today.getYear()
    if(year<1000) year+=1900
       
    document.write('©'+year)
  //-->
    </SCRIPT>
      Beachbody, LLC.<br />
      All rights reserved.</span><br />
      <br />
      <SCRIPT Language="JavaScript">
  <!-- hide from old browsers
    var today = new Date()
    var year = today.getYear()
    if(year<1000) year+=1900
       
    document.write('©'+year)
  //-->
    </SCRIPT>
      Beachbody, LLC.<br />
      Tousdroitsréservés.</span> </div>
    <div class="disclaimer">
      <!-- <img src="/euf/assets/images/ada_logo_TBB.png" />-->
      <p>Results may vary. Exercise and proper diet are necessary to achieve and maintain weight loss and muscle definition. Consult your physician and follow all safety instructions before beginning any exercise program or using any supplement or meal replacement product. The testimonials featured may have used more than one Beachbody product or extended the program to achieve their results. The information on our Web sites is not intended to diagnose any medical condition or to replace the advice of a healthcare professional. If you experience any pain or difficulty with exercises or diet, stop and consult your healthcare provider.</p>
      <br />
      <br />
      <p> The views and opinions of authors, trainers, experts and any other contributors expressed herein do not necessarily state or reflect the attitudes and opinions of Team Beachbody or Beachbody. These views and opinions shall not be attributed to or otherwise endorsed by Team Beachbody or Beachbody, and may not be used for advertising or product endorsement purposes without the express, written consent of Beachbody. </p>
      <p>Les résultats peuvent varier. L'exercice et une saine alimentation sont essentiels à l'atteinte et au maintien d'une perte de poids et de la tonification des muscles. Consultez un médecin et suivez toutes les consignes de sécurité avant d'entreprendre un programme d'exercice ou de prendre quelque supplément alimentaire ou substitut de repas que ce soit. Les personnes qui ont présenté leur témoignage pourraient avoir utilisé plus d'un produit Beachbody ou prolongé le programme pour atteindre leurs objectifs. L'information figurant sur nos sites Web ne saurait faire office de diagnostic médical ou remplacer l'avis d'un professionnel de la santé. Si vous ressentez de la douleur ou éprouvez de la difficulté lors de vos exercices ou pendant votre régime, cessez le programme et consultez votre professionnel de la santé. </p>
      <br />
      <br />
      <p> Les points de vue et opinions exprimés aux présentes sont ceux des auteurs, des entraîneurs, des experts et des autres intervenants, et ne traduisent pas nécessairement les points de vue et opinions de Team Beachbody ou de Beachbody. Ces points de vue et opinions ne seront ni attribués à Team Beachbody ou à Beachbody, ni endossés par ceux-ci, et ne pourront être utilisés à des fins de publicité ou d'endossement de produits sans le consentement écrit de Beachbody. </p>
    </div>
  </div>
</div>
</body>
</html>
