<rn:meta title="Coach Cancellation Form" template="standard_ccf.php" clickstream="incident_confirm"/>
<?php 

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

<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <p>
          Your request has been received. Your reference # is
            <b>
                    <?php echo $_GET['refno'];?>
       
            </b>
        </p>
        <p> 
           For security purposes, a separate confirmation email will be sent to the address on file for your Coach account.
        </p>
		<p>
		If you need further information regarding the Coach Network, Team Beachbody products and/or services, please visit our online support site at <a href="http://www.CoachFAQ.com">  www.CoachFAQ.com</a>.
		</p>   
		<img src="/euf/assets/images/teambeachbody_logo.png"/>
    </div>
</div>
<!--team_beachbody_logo.jpg-->
<style>
#rn_Body
{
	border-top:none;
}

</style>