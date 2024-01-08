<rn:meta title="Coach Cancellation Form" template="standard.php" clickstream="opa"  force_https="false"/>
<div id="rn_PageContent" class="">
	<?php 
			//$this->load->helper('opa');// Load OPA helper file rn_QuestionDetailstandard_responsive_bb.php
			$policyModel = getUrlParm('opa');
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance	
	?>
	<rn:widget path="custom/opa/OPAWidget" policy_model = "Coach_Cancellation_Form_Testing_Mobile"  web_determinations_url =  "https://beachbodyopa.custhelp.com/web-determinations" init_id = "" locale="en-US" seed_data="{in_global_text_Country%3dUS,in_global_text_locale%3den_US}">
</div>
