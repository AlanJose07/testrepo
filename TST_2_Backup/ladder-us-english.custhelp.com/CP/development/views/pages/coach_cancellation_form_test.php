
<!-- <rn:meta title="Coach Cancellation Form" template="standard_responsive_bb.php" clickstream="opa"  force_https="false"/> -->
<rn:meta title="Coach Cancellation Form" template="standard_responsive_bb.php" clickstream="opa" force_https="false" login_required="true"/>
<div id="rn_PageContent" class="">
	<?php 
			//$this->load->helper('opa');// Load OPA helper file rn_QuestionDetail
			/*
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance
			*/
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance
			$guid = $CI->session->getSessionData("guid");
			logmessage("guid:" . $guid);
			
			$seedData = new \stdClass();
			$seedData->in_global_text_Country = "US";
			$seedData->in_global_text_locale = "en_US";
			$seedData->in_global_text_GUID = $guid;
			
			$seedDataJson = json_encode($seedData);
			
	?>
	<!-- <rn:widget path="custom/opa/OPAWidget" policy_model = "Coach_Cancellation_Form"  web_determinations_url =  "https://beachbodyopa--upgrade.custhelp.com/web-determinations" init_id = "" locale="en-US" seed_data="{in_global_text_Country%3dUS,in_global_text_locale%3den_US}"> -->
	<rn:widget path="custom/opa/OPAWidget" policy_model = "Coach_Cancellation_Form_Test"  web_determinations_url = "https://beachbodyopa--upgrade.custhelp.com/web-determinations" init_id = "" locale="en-US"  seed_data=#rn:php:$seedDataJson#/>
</div>
