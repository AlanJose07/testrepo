<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="mobile.php" clickstream="answer_list"/>
<?php
$flightNumber=($CI->session->getSessionData('flightNumber')!='') ? $CI->session->getSessionData('flightNumber') : '100769';
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
<div class="rn_MobileLand">
  <div class="rn_SearchKey">Use keywords or ask a question to search our FAQs</div>
</div>
<section id="rn_PageTitle" class="rn_AnswerList" style="background:#E6F3F9; min-height:200px;">
  <div id="rn_SearchForm">
    <rn:widget path="search/SimpleSearch" report_page_url="/app/answers/list"/>
  </div>
</section>
