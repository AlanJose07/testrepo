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
    <h1><b>PAGE DE CONFIRMATION</b></h1>
</div>

<div id="rn_PageContent" class="rn_AskQuestion" style="width: 85%">
    <div style="padding-left: 15px;"class="rn_Padding">
	
    <!--<p> #rn:msg:SUBMITTING_QUEST_REFERENCE_FOLLOW_LBL# <b> ##rn:url_param_value:refno# </b> </p>-->
    
   <!-- <p>Thank you for starting your data request.<br/> You will receive an email associated to your account with a confirmation link to complete your request. The confirmation link will expire in 24 hours.<br/>You may use this reference number for follow up: <b> ##rn:url_param_value:refno# </b></p>-->
   <!-- <p> #rn:msg:SUPPORT_TEAM_SOON_MSG# </p>-->
	<br/>
	<rn:condition logged_in="false">
	<p>Merci de votre demande. <br/><br/> <b>Important:</b> Pour votre propre sécurité, vous recevrez un e-mail à l’adresse e-mail que vous avez enregistrée auprès de BODi. Veuillez cliquer sur le lien afin de vérifier votre identité et de nous autoriser à traiter votre demande. <br/><br/>Veuillez compter de 2 à 4 semaines pour le traitement de votre demande. <br/><br/>Vous pouvez utiliser ce numéro de référence à des fins de suivi: <b> ##rn:url_param_value:refno# </b></p>
	<rn:condition_else/>
	<p>Thank you for your request. <br/><br/> <b>Important:</b> Pour votre propre sécurité, vous recevrez un e-mail à l’adresse e-mail que vous avez enregistrée auprès de BODi. Veuillez cliquer sur le lien afin de vérifier votre identité et de nous autoriser à traiter votre demande. <br/><br/>Veuillez compter de 2 à 4 semaines pour le traitement de votre demande. <br/><br/>Vous pouvez utiliser ce numéro de référence à des fins de suivi: <b> #<?php echo $refno; ?> </b></p>
	</rn:condition>
</div></div>