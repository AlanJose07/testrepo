<rn:meta title="Beachbody" template="standard_responsive_bb.php" clickstream="opa"  force_https="false" login_required="true"//>
<link href="/euf/assets/themes/responsive/css/opa.css" rel="stylesheet">
<div id="rn_PageContent" class="">
	<?php 
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance
			$guid = $CI->session->getSessionData("guid");
			logmessage("guid:" . $guid);
			
			$seedData = new \stdClass();
			$seedData->in_global_text_Country = "UK";
			$seedData->in_global_text_locale = "en_GB";
			$seedData->in_global_text_guid = $guid;
			
			$seedDataJson = json_encode($seedData);
	?>
	
	
	<rn:widget path="custom/opa/OPAWidget" policy_model ="Additional-CBC-Form" web_determinations_url =  "https://beachbodyopa.custhelp.com/web-determinations" init_id = "" locale="en-GB"  seed_data=#rn:php:$seedDataJson#/>


</div>