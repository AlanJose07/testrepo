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
        <rn:theme path="/euf/assets/themes/standardagent" css="amcc.css,
        {YUI}/widget-stack/assets/skins/sam/widget-stack.css,
        {YUI}/widget-modality/assets/skins/sam/widget-modality.css,
        {YUI}/overlay/assets/overlay-core.css,
        {YUI}/panel/assets/skins/sam/panel.css" />
        <rn:head_content/>
        <link rel="icon" href="images/favicon.png" type="image/png"/>
        <link href="/euf/assets/themes/standard/gogo.css" type="text/css" /> 
    </head>
	
	<style>
	label.text-select-all {
    user-select: all;
}
	</style>
	
	
    <?php 
        if(getUrlParm('tail')) {
            $tail=getUrlParm('tail');
			$CI = get_instance();
	$aline=$CI->model('custom/language_model')->getaline($tail);
	$aline=$aline[0];
	$s_date = date('Y-m-d',strtotime("-2 days"));
	$e_date = date('Y-m-d');
	   
	$tmoip=$CI->model('custom/language_model')->gettmoIP($tail);
	$tmoip=$tmoip[0];
	
		$resultsurl = $this->model('custom/fetch_url')->fetchUrl();		
		$techdata=$CI->model('custom/language_model')->getTech($tail);
		$tech = $techdata[0];		
		//print_r($tech);  
		
		if($tech=="2KU")
		$tech="2Ku"; 
		$optiondata = "";
		foreach($resultsurl as $data)
		{
			$url = $data['url'];
			$url = str_replace('{AirLine}',$aline,$url);
			$url = str_replace('{TailNo}',$tail,$url);
			$url = str_replace('{S_Date}',$s_date,$url);
			$url = str_replace('{E_Date}',$e_date,$url);
			$optiondata .="<option value='".$data['display']."####".$url."'>".$data['name']."</option>";						
		}
		

		$resultToasterurl = $this->model('custom/fetch_Toaster_url')->fetchUrl();
		$optionToaster = "";         
		foreach($resultToasterurl as $data)
		{
			$newurl = $data['url'];	
			$newurl = str_replace('{TailNo}',$tail,$newurl);
			$optionToaster .="<option value='".$data['display']."####".$newurl."'>".$data['name']."</option>";				
		}
				
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
	
 <input type="button" id="mnt_button" target="_blank" onClick="window.open('http://<?php echo $tail?>.<?php echo $aline?>.abs-ops.com:8084/maintenance/'); window.open('http://<?php echo $tail?>-gate.<?php echo $aline?>.abs-ops.com:8084/maintenance/'); window.open('http://<?php echo $tmoip?>:8084/maintenance/');" value="Maintenance Page" />&nbsp;
 <select style="width:100px;" id="Tabselect" width = "1%" height = "10%" onchange="Toaster(this)" width = "1%" height = "10%" >
<option value="1" disabled selected>Toaster</option>
<? echo $optionToaster; ?>
</select> 

<select style="width:100px;" id="mySelect" onchange="displayurl(this)" width = "1%" height = "10%">
 <option value="1" disabled selected>Tableau</option>
<? echo $optiondata; ?>
</select>
 <!------------------------------------------------------------------------------------
 <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/tail/<?php echo $tail?>');" value="One View" />&nbsp;
 <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/video/fig/<?php echo $tail?>');" value="Toast Radar" />&nbsp;
 <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/rfreport/<?php echo $tail?>');" value="RF Report" />&nbsp;
 <input type="button" id="toaster" target="_blank" onClick="window.open('http://internal-instancetoaster-842721045.us-east-1.elb.amazonaws.com/sig/smreport/<?php echo $tail?>');" value="WAP Report" />&nbsp;
 <input type="button" id="tableau" target="_blank" onClick="window.open('https://tableau.gogoair.com/views/MotorCurrentInspector/motorcurrentsallplatters?iframeSizedToWindow=true&:embed=y&tail_param=<?php echo $tail?>&start_date=<?php echo $s_date?>&end_date=<?php echo $e_date?>&:showAppBanner=false&:display_count=no&:showVizHome=no');" value="Motor Current" />&nbsp;
 <input type="button" id="tableau" target="_blank" onClick="window.open('https://tableau.gogoair.com/views/WAPFailures/BarChart?iframeSizedToWindow=true&:embed=y&tail=<?php echo $tail?>&:showAppBanner=false&:display_count=no&:showVizHome=no&:showAppBanner=false&:display_count=no&:showVizHome=no');" value="WAP Failure" />&nbsp;
 <input type="button" id="tableau" target="_blank" onClick="window.open('https://tableau.gogoair.com/views/ToasterVideo/ToasterVideo?iframeSizedToWindow=true&:embed=y&Airline=<?php echo $aline?>&Tail=<?php echo $tail?>&:display_count=no&:showAppBanner=false&:showVizHome=no');" value="Video Batch" />&nbsp;
<input type="button" id="tableau" target="_blank" onClick="window.open('https://tableau.gogoair.com/views/NAVTailSearch/NAV16?iframeSizedToWindow=true&:embed=y&Tail.Parameter=<?php echo $tail?>&:showAppBanner=false&:display_count=no&:showVizHome=no');" value="LRU Serial#" /> 
--------------------------------------------------------------------------------------->						
							<?php } ?>
							
							<rn:widget path="search/amccKeyword" label_text="Type Tail number or Nose number" initial_focus="true"/>
                                        <rn:widget path="custom/search/amccSearch"/>
							<?php
							if(getUrlParm('n'))
							{
							$nose=getUrlParm('n');
							?>
							<span id="nose" style="float: left;margin-left: 25px;margin-top: 16px;font-size: large;"><?php echo "Nose #: <label class='text-select-all'>". $nose; "</label>"?></span>
							
							<?php }
							else
							{?>
							<span id="nose" style="float: left;margin-left: 25px;margin-top: 16px;font-size: large;"></span>

							<?php
							if(getUrlParm('tail'))
							?>
							<span id="tail" style="float: left;margin-left: 25px;margin-top: 16px;font-size: large;">
								<?php echo "Tail: <label class='text-select-all'>". $tail; "</label>"?>
							</span>	

							<?php } 						
                            if(getUrlParm('a'))
							{?>
								<span id="aircraft" style="float: left;margin-left: 25px;margin-top: 16px;font-size:large;">
                               <?php echo "Aircraft Type: <label class='text-select-all'>". getUrlParm('a'); "</label>"?>
                                </span>	

								<span id="technology" style="float: left;margin-left: 19px;margin-top: 16px;font-size:large;">                        
							   <?php echo "Technology: <label class='text-select-all'>". $tech; "</label>"?>                              
                                </span>	
                            
							<?php
							if(getUrlParm('acstatus'))
							?>
							<span id="acstatus" style="float: left;margin-left: 25px;margin-top: 16px;font-size: large;">
								<?php echo "Status: <label class='text-select-all'>". getUrlParm('acstatus'); "</label>"?>
							</span>

							<?php
							if(getUrlParm('decomm'))
							?>
							<span id="decomm" style="float: left;margin-left: 25px;margin-top: 16px;font-size: large;">
								<?php echo "Decomm Date: <label class='text-select-all'>". getUrlParm('decomm'); "</label>"?>
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
	
	
	
	
	
	<script type="text/javascript">
             
		
		function displayurl(element)
        {
            //debugger;
            var url = document.getElementById("mySelect").value; 
			if(url)
			{
				document.getElementById("mySelect").value = 1;
                var data = url.split("####");        
				var display = data[0];
				var newUrll = data[1];
				if(display !== null)
				{
                    if (display == "New Tab")
                    {                             
                    openInNewTab(newUrll);
                    }              
                    else if (display == "New Window" )
                    {
                    window.open(newUrll, "_blank",'location=yes,height=490,width=1200,top=80,left=60,scrollbars=yes,status=yes');
                    }
				} 
			}
		}			
		function openInNewTab(url)
        {
         var win = window.open(url, '_blank');
         win.focus();
        }  

    
        function Toaster(element)
        {
          
            var UrlToaster = document.getElementById("Tabselect").value;           
			if(UrlToaster)
			{
				document.getElementById("Tabselect").value = 1;
				var data = UrlToaster.split("####");
				var display = data[0];
				var newUrll = data[1];
				if(display !== null)
				{
                    if (display == "New Tab")
                    {                             
                    openInNewTab(newUrll);
                    }              
                    else if (display == "New Window" )
                    {
                    window.open(newUrll, "_blank",'location=yes,height=490,width=1200,top=80,left=60,scrollbars=yes,status=yes');
                    }
				} 
			}
		}	
		
		
      </script>
</html>
