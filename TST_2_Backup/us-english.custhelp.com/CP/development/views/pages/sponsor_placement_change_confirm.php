<rn:meta title="Customer Coach Change Confirmation" template="standard_responsive_bb.php" clickstream="incident_create"/>
<style>
    body{
        width:100% !important;
    }
</style> 
<div class="confirm confirm_container container">
	<div style="padding:0;text-align: center;">
		<!--<img height="60" width="300" alt="" src="https://faq.beachbody.com/euf/assets/images/team_beachbody_coach_packages.png">-->
	</div>
	<?php
		$incidentid= getUrlParm('i_id');
		if($incidentid)
		{
			$referencenumber = $this->model('custom/bbresponsive')->FetchRefNo($incidentid); 
		}
		else
		{
			$referencenumber =  getUrlParm('refno');
		}
		$change= getUrlParm('change');
	?>
	<div id="rn_IFrameContent" class="rn_OrderPage">
  		<div id="rn_content" class="rn_questionform">
    		<div class="rn_wrap">   
					
					<div id="confirm_eng">
						<rn:condition url_parameter_check="refno == null">
							
						</rn:condition>
						<strong style="font-weight:bold!important;margin-left:170px!important;"></strong>
						<div style="font-size:15px;">
							<ul>
								<li>We will review your request and email you within two business days.</br> </br> </li>
								<li>Your incident number is <b><?= $referencenumber ?></b> </li>
							</ul>
						</div>
					</div>
      
    		</div>
		  </div>
		</div>
</div>