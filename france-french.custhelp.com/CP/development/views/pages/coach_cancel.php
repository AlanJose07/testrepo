<rn:meta title="Coach Cancellation Form" template="standard_responsive_bb.php" clickstream="opa"  force_https="false" login_required="true"/>
<link href="/euf/assets/themes/responsive/css/opa.css" rel="stylesheet">
<div id="rn_PageContent" class="">
	<?php 
			//$this->load->helper('opa');// Load OPA helper file rn_QuestionDetail
			/*
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance
			*/
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance
			$guid = $CI->session->getSessionData("guid");
			logmessage("guid:" . $guid);
			
			$seedData = new \stdClass();
			$seedData->in_global_text_Country = "FR";
			$seedData->in_global_text_locale = "fr_FR";
			$seedData->in_global_text_GUID = $guid;
			
			$seedDataJson = json_encode($seedData);
			
	?>
	
	<rn:widget path="custom/opa/OPAWidget" policy_model = "Coach_Cancellation_Form"  web_determinations_url = "https://beachbodyopa.custhelp.com/web-determinations" init_id = "" locale="fr-FR"  seed_data=#rn:php:$seedDataJson#/>
	
</div>
