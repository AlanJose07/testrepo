<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>

<script src="/euf/assets/js/jquery.min.js"></script>

<?php
  // store flight info in a session to be passed in the chat
 if(getUrlParm('flightNumber') || getUrlParm('tailNumber'))
	{
	
	$CI->session->setSessionData(array('flightNumber' => getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress')));
	
	}
	
	
	$CI = get_instance();
 	$ref=@$_SERVER[HTTP_REFERER];
	$CI->session->setSessionData(array('url' => $ref));
 	
	$flightNumber = "";
	//Getting parameters from session
	$all_parameters = $CI->session->getSessionData('urlParameters');
	
	if(array_key_exists('flightNumber', $all_parameters))
	{
			if(is_array($all_parameters['flightNumber']))
			{
				$flightNumber = end($all_parameters['flightNumber']);
			}
			else
			{
				$flightNumber = $all_parameters['flightNumber'];
			}
	}
	
	//Storing first three parameters of flight number
	if(getUrlParm('tailNumber'))
	{
		$res_aline=$CI->model('custom/language_model')->getaline(getUrlParm('tailNumber'));
		$flgtNo=$res_aline[0];
		
		
	}
	else
	$flgtNo  = substr($flightNumber, 0, 3);
	
	/*Airline Template-Start
	$video = getUrlParm('video');
	
	
	if($aline=="AAL" && $acpu_type=="ATG" && $video=="yes")
	{
	
	$flight = 100762;
	}
	
	else if($aline=="AAL" && $acpu_type=="ATG" && $video=="")
	{
	
	$flight = 100760;
	}
	
	else
	{
	Airline Template-End*/
	
	if($flgtNo=="ACA")
		$flight = 100760;
	elseif($flgtNo=="ASA")
		$flight = 100761;
	elseif($flgtNo=="AAL")
		$flight = 100762;
	elseif($flgtNo=="AMX")
		$flight = 101147;	
	elseif($flgtNo=="AWE")
		$flight = 100763;
	elseif($flgtNo=="BAW")
		$flight = 102580;
	elseif($flgtNo=="DAL")
		$flight = 100764;
	elseif($flgtNo=="ROU")
		$flight = 102539;	
	elseif($flgtNo=="JAL")
		$flight = 100765;
	elseif($flgtNo=="JTA")
		$flight = 102630;
	elseif($flgtNo=="TRS")
		$flight = 100766;
	elseif($flgtNo=="UAL")
		$flight = 100767;
	elseif($flgtNo=="VRD")
		$flight = 100768;
	elseif($flgtNo=="VOZ")
		$flight = 102629;
	elseif($flgtNo=="VIR")
		$flight = 101228;
	elseif($flgtNo=="GLO")
		$flight = 102422;	
	elseif (strpos($flgtNo,'G3') !== false)
		$flight = 102523;
	elseif($flgtNo=="null")
		$flight = 100769;							
	else
		$flight = 100003;
    /*Airline Template-Start
	}
	Airline Template-End*/
	$c=getUrlParm('c');
	if($c==NULL || $c=='' || $c==0) { if($clang=="zh_CN")
	{$res_cat="常见主题";}
	else
	{$res_cat="Common Topics";}
	}
	else { $res_cat=$CI->model('custom/language_model')->getCurrentCategory($c); }
	
?>

<rn:container>
   <div class="rn_Module">
      <div id = "hide_show">
        <?php
/*Multiline widget customization*/
?>
		<div class="chat-survey-container">
			<span class="chat-survey-header">Did we answer your question?</span><br /><br />
			<p class="chat-survey-title">We want to hear your opinion about our customer care.  Can you participate in a 1~2 minute survey?  We guarantee it will be quick!</p><br />
			<span class="chat-survey-link">
			 <rn:widget path="custom/chat/ChatSurveyLink" />
			</span>		
			<br /><br />
			
		</div>
		<rn:widget path="custom/chat/chatsurveycustomload" />		
		<div id ="page_content" style="display:none">
		</div>
		<!--<div id ="page_content" style="display:none">
		  <rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="100003" per_page="10"/> 
		</div>-->
				
      </div>
    </div>

<script>
$(document).ready(function(){
$('#rn_NavigationTab_2').children('a').addClass('rn_SelectedTab');
});
</script>