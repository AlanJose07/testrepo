<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="mobile.php" clickstream="answer_list"/>
<?php
$flightNumber=($CI->session->getSessionData('flightNumber')!='') ? $CI->session->getSessionData('flightNumber') : '100769';
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
	
$flgtNo  = substr($flightNumber, 0, 3);
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
elseif($flgtNo=="DAL")
$flight = 100764;
elseif($flgtNo=="JAL")
$flight = 100765;
elseif($flgtNo=="TRS")
$flight = 100766;
elseif($flgtNo=="UAL")
$flight = 100767;
elseif($flgtNo=="VAL")
$flight = 100768;
elseif($flgtNo=="VIR")
$flight = 101228;
elseif($flgtNo=="null")
$flight = 100769;							
else
$flight = 100003;


?>
<rn:container report_id="#rn:php:$flight#">
<section id="rn_PageTitle" class="rn_AnswerList">
<rn:condition is_spider="false">
    <div id="rn_SearchControls">
        <h1>#rn:msg:SEARCH_RESULTS_CMD#</h1>
        <form method="post" action="" onsubmit="return false;">
            <rn:widget path="search/KeywordText" label_text="" report_id="#rn:php:$flight#"/>
            <rn:widget path="search/SearchButton" report_id="#rn:php:$flight#" icon_path="images/icons/search.png"/>
        </form>
     </div>
</rn:condition>
      
</section>
<section id="rn_PageContent" class="rn_AnswerList">
    <div class="rn_Padding">
        <rn:widget path="reports/MobileMultiline" truncate_size="2000" report_id="#rn:php:$flight#" />
        <rn:widget path="reports/Paginator" report_id="#rn:php:$flight#"/>
    </div>
</section>
