
<rn:meta title="Entraîneur Indépendant Formulaire D'annulation" template="standard_ccf.php" clickstream="incident_confirm"/>
<?php 

$lob = getUrlParm(lob);
if($lob!= coach && $lob!= beachbodylive )
{
?>
<!--<script src="/euf/assets/js/directly_generic.js"></script>-->

<?
}
?>
<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1><b>PAGE DE CONFIRMATION</b></h1>
</div>

<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <p>
          Votre demande a bien été reçue. Votre numéro de référence est :
            <b>
                    <?php echo '#'.$_GET['refno'];?>
       
            </b>
        </p>
        <p>
           Pour des raisons de sécurité, un second courriel de confirmation vous sera envoyé à l'adresse e-mail que vous nous avez fournie pour votre compte coach.
        </p>
		<p>
		Pour toute assistance additionnelle concernant le réseau de Coach produits et services Team Beachbody, veuillez consulter notre support en ligne via le lien <a href="http://www.CoachFAQ.com">www.CoachFAQ.com</a>.
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