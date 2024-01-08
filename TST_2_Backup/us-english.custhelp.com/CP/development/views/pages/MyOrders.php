<rn:meta title="Beachbody"   template="standard_responsive_bb.php" clickstream="opa"  force_https="false" login_required="true"/>
<?php 
			
			$profile = $this->session->getProfile();//Get session profile
			$CI = get_instance();//get codeIgniter instance	
			$guid = $CI->session->getSessionData("guid");
			logmessage("guid:" . $guid);
			$seed = $guid;//"{in_global_text_Country%3dUS,in_global_text_locale%3den_US,in_global_text_guid%3d".$guid ."}"

	?>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
	<link rel="stylesheet" href="//excalibur.merlinapi.com/3.53.1/css/global.css" />
		<link type="text/css" rel="stylesheet" href="//excalibur.merlinapi.com/3.53.1/css/modules.css"/>
		<link rel="stylesheet" href="//excalibur.merlinapi.com/3.53.1/css/themes.css" />
<link href='https://beachbodyopa.custhelp.com/web-determinations/resource/Beachbody_OrderManagement/en-US/fonts.css' rel="stylesheet" type="text/css"/>
<link href="https://beachbodyopa.custhelp.com/web-determinations/resource/Beachbody_OrderManagement/en-US/styles.css"rel="stylesheet" type="text/css"/>
<link href="https://beachbodyopa.custhelp.com/web-determinations/resource/Beachbody_OrderManagement/en-US/bootstrap.min"rel="stylesheet" type="text/css"/>


												<style>
													#interviewDiv form {
													    background-color: #e6f0f7 !important;
													}
													.opa-control-item{
												 			 display:none;
													}

													#divorder {
													    width: 70% !important;
													}
												</style>
<script type="text/javascript">
<!-- start ShakeMod-OPA -->
												
        var opa = {};
							              opa.webDeterminationsUrl = "https://beachbodyopa--tst2.custhelp.com/web-determinations";
							              opa.deploymentName = "Beachbody_OrderManagement";
							              opa.seedData = {
							                  "in_global_text_GUID": <?php echo "\"".$guid ."\""; ?>,
							                  "in_global_text_locale":  "en_US",
							                  "in_global_text_cust_role": "ATG"
							              };
    </script>
	<script src="https://faq.beachbody.com/euf/assets/js/jquery.min.js"></script>

	<script type="text/javascript" src="https://beachbodyopa--tst2.custhelp.com/web-determinations/staticresource/interviews.js"></script>
	
<body>
    <!--Mounting point for React VDOM-->
    <div style="display: inline-block; width:100%">
	<div id="interviewDiv" style="width: 100%; display: block; margin-left: auto; margin-right:auto; float: left"></div>
</div>
<script>
	opa.el = document.getElementById("interviewDiv");
	//OraclePolicyAutomationInterview.StartInterview(opa.el, opa.webDeterminationsUrl, opa.deploymentName, undefined, undefined, undefined, opa.seedData);
	var startConfig = [{ operation: "start", el: opa.el, deploymentName: opa.deploymentName, seedData : opa.seedData, disableEnforcedStyling : true , warnIfUnsaved : false}];
	OraclePolicyAutomationInterview.BatchStartOrResume(opa.webDeterminationsUrl, startConfig);
</script>
</body>

</head>