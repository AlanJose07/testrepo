<rn:meta title="Beachbody"  clickstream="opa" force_https="false" />
<head>
<body class="yui-skin-sam yui3-skin-sam">
<div id="rn_PageContent" class="">
	<?php 
			$policyModel = getUrlParm('opa');
			$CI = get_instance();	
			if (\RightNow\Utils\Framework::isLoggedIn()) 		
			{
				if  (!empty($_GET) and empty($_GET['pagecount']) )
				{
					$seedData = new \stdClass();
					$seedData->GUID = $_GET['GUID'];
					$seedData->loc = $_GET['loc'];
					$seedData->role = $_GET['role'];
					$seedData->aid = $_GET['aid'];
					$seedData->ord = $_GET['ord'];
					$seedData->opt = $_GET['opt'];
					$seedData->nsi = $_GET['nsi'];
					$seedData->ip = $_GET['ip'];
					$seedData->smf = $_GET['smf'];
					$seedData->ugl = $_GET['ugl'];
					$seedData->upc = $_GET['upc'];
					$seedData->sln = $_GET['sln'];
					$seedData->slp = $_GET['slp'];
					//logmessage($seedData);
					$seedDataJson = json_encode($seedData);
					
					
				}
				else
				{
					//logmessage($CI->session->getSessionData("ssegetparams"));
					$seedDataJson = json_encode($CI->session->getSessionData("ssegetparams"));
					
				}
			}	 
				
						
				 		
				else		
				 {		
					if( empty($_GET['pagecount']))
					{
						$agent = $_SERVER["HTTP_USER_AGENT"];

							if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
							  $safari = false;
							} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
							  $safari = false;
							} else if (preg_match('/Edge\/\d+/', $agent) ) {
							  $safari = false;
							} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
							  $safari = false;
							} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
							  $safari = false;
							} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
							  $safari = true;
							}
						
						if ($safari and empty($_GET['screen']))
							{
								$loc = "https://us-english--tst2.custhelp.com/app/SSEOrder". http_build_query($_GET) ."&screen=new";
								echo 'Your browser setting is preventing to contiue.Please click <a target="_blank" href="'.$loc.'">here to continue </a>;';
								exit;
								
							}
						if(empty($_GET['screen']))
						{
						$ssegetparams = array("ssegetparams"=>$_GET);
						}
						else{
							unset($_GET['screen']);
						$ssegetparams = array("ssegetparams"=>$_GET);	
						}
					$ssegetparams = array("ssegetparams"=>$_GET);
					$CI->session->setSessionData($ssegetparams);
					$ptaurl = \RightNow\Utils\Config::getConfig(PTA_EXTERNAL_LOGIN_URL);
					//$url=str_replace("%next_page%","/app/SSEOrder?pagecount=1$".str_replace('&','$',http_build_query($_GET)),$ptaurl);
					$url=str_replace("%next_page%","app/SSEOrder",$ptaurl);
					//$url=str_replace("%next_page%","/app/SSEOrder?pagecount=".json_encode($ssegetparams),$ptaurl);
					//$url=str_replace("%next_page%","/app/SSEOrder?pagecount=1",$ptaurl);
					//logmessage($url);
					header("Location:".$url);
					//logmessage($url);
					}
					else{
							
						 $loc = "https://us-english--tst2.custhelp.com/app/SSEOrder?". str_replace('$','&',substr($_GET['pagecount'],2));
								echo 'Please click <a target="_blank" href="'.$loc.'">here </a>;';
						exit;
															
							
						
						
					}
				 }
				 logmessage(json_decode($seedDataJson)->loc);

	?>
	
	<?php if((json_decode($seedDataJson)->loc == "en_US") || (json_decode($seedDataJson)->loc == "en_CA") || (json_decode($seedDataJson)->loc == "en_GB")) : ?>
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Beachbody_OrderManagement_1XHD" web_determinations_url = "https://beachbodyopa--tst2.custhelp.com/web-determinations" init_id = "" locale="en-US"  seed_data=#rn:php:$seedDataJson#/>
	<?php elseif(json_decode($seedDataJson)->loc == "es_US") : ?>
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Beachbody_OrderManagement_1XHD" web_determinations_url = "https://beachbodyopa--tst2.custhelp.com/web-determinations" init_id = "" locale="es-US"  seed_data=#rn:php:$seedDataJson#/>
	<?php elseif(json_decode($seedDataJson)->loc == "fr_CA") : ?>
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Beachbody_OrderManagement_1XHD" web_determinations_url = "https://beachbodyopa--tst2.custhelp.com/web-determinations" init_id = "" locale="fr-CA"  seed_data=#rn:php:$seedDataJson#/>
	<?php elseif(json_decode($seedDataJson)->loc == "fr_FR") : ?>	
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Beachbody_OrderManagement_1XHD" web_determinations_url = "https://beachbodyopa--tst2.custhelp.com/web-determinations" init_id = "" locale="fr-CA"  seed_data=#rn:php:$seedDataJson#/>
	<?php else : ?>
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Beachbody_OrderManagement_1XHD" web_determinations_url = "https://beachbodyopa--tst2.custhelp.com/web-determinations" init_id = "" locale="en-US"  seed_data=#rn:php:$seedDataJson#/>
	<?php endif; ?>
</div>
</body>
</head>