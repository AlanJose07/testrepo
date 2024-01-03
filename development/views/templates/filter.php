<!DOCTYPE html>
<html lang="#rn:language_code#" >
    <rn:meta javascript_module="standard"/>
    <head>
        <meta charset="utf-8"/>
        <title>
            <rn:page_title/>
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
        <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
        <rn:theme path="/euf/assets/themes/standardagent" css="filter.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
        <rn:head_content/>
        <link rel="icon" href="images/favicon.png" type="image/png"/>
        <link href="/euf/assets/themes/standard/gogo.css" type="text/css" />
         
    </head>
    <?php 
        if(getUrlParm('tail')) {
            $tail=getUrlParm('tail');
			$CI = get_instance();
	$aline=$CI->model('custom/language_model')->getaline($tail);
	$aline=$aline[0];
			
        }
    ?>

    <body class="yui-skin-sam yui3-skin-sam">
        <div id="rn_Container" class="rn_Gogo_Container rn_Gogo_Container-loginU">
            <div class="login-container">
                <div id="rn_SkipNav"><a href="#rn_MainContent">#rn:msg:SKIP_NAVIGATION_CMD#</a></div>
                <div id="rn_Header" role="banner" class="rn_Gogo_Header">
                    <noscript>
                        <h1>#rn:msg:SCRIPTING_ENABLED_SITE_MSG#</h1>
                    </noscript>
                    <div class="header_logo">
					 <?php 
        if(getUrlParm('tail')) {
           
    ?>
	
 <input type="button" target="_blank" onClick="window.open('http://<?php echo $tail?>.<?php echo $aline?>.abs-ops.com:8084/maintenance/'); window.open('http://<?php echo $tail?>-gate.<?php echo $aline?>.abs-ops.com:8084/maintenance/');" value="Access to Maintenance Page" />&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/tail/<?php echo $tail?>');" value="One View" />&nbsp;&nbsp;
   <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/video/fig/<?php echo $tail?>');" value="Toast Radar" />&nbsp;&nbsp;
    <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/rfreport/<?php echo $tail?>');" value="RF Report" />&nbsp;&nbsp;
	 <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/smreport/<?php echo $tail?>');" value="WAP Report" />
	 
						
							<?php } ?>
							
							
							<?php
							if(getUrlParm('n'))
							{
							$nose=getUrlParm('n');
							?>
							<span id="nose" style="float: left;margin-left: 79px;margin-top: 16px;font-size: large;"><?php echo "Nose #:". $nose;?></span>
							
							<?php }
							else
							{?>
							<span id="nose" style="float: left;margin-left: 79px;margin-top: 16px;font-size: large;"></span>
							<?php } 
                            if(getUrlParm('a'))
							{?>
								<span id="aircraft" style="float: left;margin-left: 79px;margin-top: 16px;font-size:large;">
                               <?php echo "AircraftType :". getUrlParm('a');?>
                               
                                </span>		
                                <?php } 
                                else
                               	{?>
                                <span id="aircraft" style="float: left;margin-left: 79px;margin-top: 16px;font-size:medium;"></span>
							<?php } ?>				
                        <div id="rn_LoginStatus">
                            <rn:condition logged_in="true">
                                #rn:msg:WELCOME_BACK_LBL#
                                <strong>
                                    <rn:field name="Contact.LookupName"/>
                                    <rn:condition language_in="ja-JP">#rn:msg:NAME_SUFFIX_LBL#</rn:condition>
                                </strong>
                                <div>
                                    <rn:field name="Contact.Organization.LookupName"/>
                                </div>
                                <rn:widget path="login/LogoutLink" redirect_url="/app/utils/login_form"/>

                                <rn:condition_else />
                                <rn:condition config_check="PTA_ENABLED == true">
                                    <a href="/app/utils/login_form#rn:session#" id="rn_LoginLink">#rn:msg:LOG_IN_LBL#</a>&nbsp;|&nbsp;<a href="javascript:void(0);">#rn:msg:SIGN_UP_LBL#</a>
                                    <rn:condition_else>
                                </rn:condition>
                            </rn:condition>
                        </div>
                    </div>
                    
                  
							
                            <div class="rn_Header_Search_Block">
                                <div id="main" >
                                   
                               </div>
                            </div>
                    

<br>
                    <div id="rn_Body" style="margin-top:-4px;">
                        <div id="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
                            <rn:page_content/>
                        </div>
                    </div> 
                </div>
               
            </div>
        </div>
      
    </body>
</html>
