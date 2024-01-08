<rn:meta title="GDPR FORM" template="standard_responsive_bb.php" clickstream="incident_confirm"/>

<?php 
$incidentid = \RightNow\Utils\Url::getParameter('i_id');

if($incidentid)
$refno = $this->model('custom/bbresponsive')->FetchRefNo($incidentid);
    
$lob = getUrlParm(lob);
if($lob!= coach && $lob!= beachbodylive )
{
?>

<script src="/euf/assets/js/directly_generic.js"></script>
<?
}
?>

<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1><b>CONFIRMATION PAGE</b></h1>
</div>

<div id="rn_PageContent" class="rn_AskQuestion" style="width: 85%">
    <div style="padding-left: 15px;"class="rn_Padding">
	
    <!--<p> #rn:msg:SUBMITTING_QUEST_REFERENCE_FOLLOW_LBL# <b> ##rn:url_param_value:refno# </b> </p>-->
    
   <!-- <p>Thank you for starting your data request.<br/> You will receive an email associated to your account with a confirmation link to complete your request. The confirmation link will expire in 24 hours.<br/>You may use this reference number for follow up: <b> ##rn:url_param_value:refno# </b></p>-->
   <!-- <p> #rn:msg:SUPPORT_TEAM_SOON_MSG# </p>-->
	<br/>
	<rn:condition logged_in="false">
	<p>Thank you for your request. <br/><br/> <b>Important:</b> For your security, you will receive an e-mail to the e-mail address you have on file with BODi. Please click the link in the e-mail which will verify your identify and authorise us to begin your request. <br/><br/>Please allow 2-4 weeks to complete your request. <br/><br/>You may use this reference number for follow up: <b> ##rn:url_param_value:refno# </b></p>
	<rn:condition_else/>
	<p>Thank you for your request. <br/><br/> <b>Important:</b> For your security, you will receive an e-mail to the e-mail address you have on file with BODi. Please click the link in the e-mail which will verify your identify and authorise us to begin your request. <br/><br/>Please allow 2-4 weeks to complete your request. <br/><br/>You may use this reference number for follow up: <b> #<?php echo $refno; ?> </b></p>
	</rn:condition>
</div></div>