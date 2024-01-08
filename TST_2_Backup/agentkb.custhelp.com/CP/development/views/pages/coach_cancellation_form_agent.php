<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>
<div id="rn_PageContent" class="">
	<?php 
			//$this->load->helper('opa');// Load OPA helper file rn_QuestionDetail
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance	
			
			$seedData = new \stdClass();
			$seedData->in_global_text_Country = "US";
			$seedData->in_global_text_locale = "en_US";
			
			$seedDataJson = json_encode($seedData);

			
	?>
	<rn:widget path="custom/opa/OPAWidget" policy_model = "Coach_Cancellation_Form_Agent"  web_determinations_url = "https://beachbodyopa.custhelp.com/web-determinations" init_id = "" locale="en-US"  seed_data=#rn:php:$seedDataJson#/>
</div>
