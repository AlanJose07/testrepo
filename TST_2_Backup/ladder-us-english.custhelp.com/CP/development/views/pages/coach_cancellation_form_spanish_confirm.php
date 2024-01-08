<rn:meta title="Formulario de Cancelación de Coach Independiente" template="standard_ccf.php" clickstream="incident_confirm"/>
<?php 

$lob = getUrlParm(lob);
if($lob!= coach && $lob!= beachbodylive )
{

?>

<!--<script>

    (function(d, i, r, e, c, t, l, y) {
        i[r] = i[r] || function() {
            (i[r].cq = i[r].cq || []).push(arguments)
        };
        l = d.createElement(c);
        l.id = "directlyRTMScript";
        l.src = e;
        l.async = 1;
        y = d.getElementsByTagName(c)[0];
        d.addEventListener(t, function() {
            y.parentNode.insertBefore(l, y);
        });
    })(document, window, "DirectlyRTM", "https://www.directly.com/widgets/rtm/embed.js", "script", "DOMContentLoaded");
    DirectlyRTM("config",{id: "8a2968fc58855a2401588e33b1a467f6" });

	DirectlyRTM("config", {
	    id: "8a2968fc58855a2401588e33b1a467f6",
	    questionCategory: "rtm",
	    metadata: {
	        "referrer": document.location.href,
	        "userAgent": navigator.userAgent
	    }
	});

</script>-->
<?

}
?>
<div id="rn_PageTitle" class="rn_AskQuestion">
    <h1><b>PÁGINA DE CONFIRMACIÓN</b></h1>
</div>

<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <p>
          Hemos recibido tu solicitud. Tu número de referencia es :
            <b>
                    <?php echo '#'.$_GET['refno'];?>
       
            </b>
        </p>
        <p>
          Por razones de seguridad, se te enviará un correo electrónico de confirmación por separado a la dirección registrada en tu cuenta de coach.
        </p>
		<p>
		PSi necesitas más información sobre la red de coaches, productos de Team Beachbody y/o servicios, consulta nuestra página en <a href="http://www.CoachFAQ.com">www.CoachFAQ.com</a>.
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