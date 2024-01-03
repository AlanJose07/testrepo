<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>

<?php
// EN
$CI = get_instance();
$cookieFlag =$CI->session->getSessionData('USER_SESSION_COOKIE_EXIPIRE');
// echo "<h1>Flag:$cookieFlag</h1>";
  // store flight info in a session to be passed in the chat
  if($CI->session->getSessionData('USER_SESSION_COOKIE_EXIPIRE') == "Disable"){
	if(getUrlParm('flightNumber') || getUrlParm('tailNumber'))
	{
	$CI->session->setSessionData(array('flightNumber' => getUrlParm('flightNumber'), flightOrigin => getUrlParm('flightOrigin'), flightDestination => getUrlParm('flightDestination'), tailNumber => getUrlParm('tailNumber'), macAddress => getUrlParm('macAddress'), deviceid => getUrlParm('deviceid'), uxdid => getUrlParm('uxdid')));
	
	}
  }
 
	
	
	
	
 	$ref=@$_SERVER[HTTP_REFERER];
	$CI->session->setSessionData(array('url' => $ref));
    $clang= $CI->session->getSessionData('clang');
	$flightNumber = "";
	//Getting parameters from session
	$all_param = $CI->session->getSessionData('urlParameters');
	$all_parameters= array();
	foreach($all_param as $array) {
 	foreach($array as $k=>$v) {
    $all_parameters[$k][] = $v;
 	   }
	   }
	
	if(array_key_exists('flightNumber',$all_parameters))
	{
	
			if(is_array($all_parameters['flightNumber']))
			{
				$flightNumber= end($all_parameters['flightNumber']);
				
			}
			else
			{
				$flightNumber = $all_parameters['flightNumber'];
				
			}
			
	}
	
	if(array_key_exists('tailNumber', $all_parameters))
	{
		if(is_array($all_parameters['tailNumber']))
		{
			$tailNumber = end($all_parameters['tailNumber']);
		}
		else
		{
		$tailNumber = $all_parameters['tailNumber'];
		}
	}
	//Storing first three parameters of flight number
	
	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];
	//mkt remove
	//$flgtNo = "AAL";
	
	
	if($clang=="ko_KR" && $flgtNo=="DAL")
		$flight = 115985;
	elseif($clang=="ko_KR" && $flgtNo=="CPA" && (getUrlParm('ko')==1))
		$flight = 111229;
	elseif($clang=="de_DE" && $flgtNo=="CPA" && (getUrlParm('ge')==1))
		$flight = 111228;
	elseif($clang=="en_US" && $flgtNo=="CPA")
		$flight = 111230;
    elseif($flgtNo=="ACA")
		$flight = 110237;
    elseif($flgtNo=="QTR")
		$flight = 111945;		
	elseif($flgtNo=="ASA")
		$flight = 110238;
	elseif($flgtNo=="AAL")
		//$flight = 100762;
		$flight = 111670;
	elseif($flgtNo=="AMX")
		$flight = 110299;	
	elseif($flgtNo=="AWE")
		$flight = 110240;
	elseif($flgtNo=="BAW")
		$flight = 110790;
	elseif($flgtNo=="DAL")
		$flight = 110241;
	elseif($flgtNo=="ROU")
		$flight = 110756;	
	elseif($flgtNo=="JAL")
		$flight = 110242;
	elseif($flgtNo=="JLJ")
		$flight = 116077;
	elseif($flgtNo=="JTA")
		$flight = 110827;
	elseif($flgtNo=="RXA")
		$flight = 111802;
	elseif($flgtNo=="TRS")
		$flight = 110243;
	elseif($flgtNo=="UAL")
		$flight = 110244;
	elseif($flgtNo=="VRD")
		$flight = 110245;
	elseif($flgtNo=="VOZ")
		$flight = 110826;
	elseif($flgtNo=="VIR")
		$flight = 110345;
	elseif($flgtNo=="GLO")
		$flight = 110678;
	elseif($flgtNo=="TAM")
		$flight = 111097;		
	elseif (strpos($flgtNo,'G3') !== false)
		$flight = 110741;							
	else
		$flight = 109984;
	$c=getUrlParm('c');
	if($c==NULL || $c=='' || $c==0)
	{
	
	if($clang=="ko_KR" && $flgtNo=="DAL")
	{
	$res_cat="공통 주제";
	}
	elseif($clang=="ko_KR" && $flgtNo=="CPA" && getUrlParm('ko')==="1" )
	{
	$res_cat="공통 주제";
	}
	elseif($clang=="de_DE" && $flgtNo=="CPA" && getUrlParm('ge')==="1")
	{
	$res_cat="Allgemeine Themen";
	}

	else
	
	{
	$res_cat="Common Topics";
	}
	}
	else { 
	
if($clang=="ko_KR" && $flgtNo=="DAL")
{

$res_cat=$CI->model('custom/language_model')->getCurrentCatKorean($c);

}
elseif($clang=="ko_KR" && $flgtNo=="CPA")
{

$res_cat=$CI->model('custom/language_model')->getCurrentCatKorean($c);

}
elseif($clang=="de_DE" && $flgtNo=="CPA" && getUrlParm('ge')==="1")
{

$res_cat=$CI->model('custom/language_model')->getCurrentCatGerman($c);

}
else
{
$res_cat=$CI->model('custom/language_model')->getCurrentCategory($c);

}
	
}
?>

<rn:container>
  <div id="rn_PageTitle" class="rn_Home">
    <div id="rn_SearchControls">
      <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
      <form onsubmit="return false;">




        <div class="rn_SearchInput">
          <?php
			 /*Report is shown according to the flight number*/
			 ?>
<!-- hiding cobrowse temporary  <rn:widget path="utils/CobrowsePremium" />  -->     
          <rn:widget path="search/KeywordTextGogo" label_text="" report_id="#rn:php:$flight#" initial_focus="false"/>
        </div>
        <?php if($flgtNo=="CPA"){?>
        <rn:widget path="search/SearchButton" report_id="#rn:php:$flight#" icon_path="images/search.png" />
		<?php } 
		else
		{ ?>
		<rn:widget path="search/SearchButton" report_id="#rn:php:$flight#" icon_path="images/icon_search.png" />
		<?php } ?>
      </form>
    </div>
  </div>
  
  <rn:condition hide_on_pages="chat/chat_landing">
    <div id="rn_SideBar" role="navigation">
      <!--  change classname rn_Padding  to rn_Padding_homepage-->
      <div class="rn_Padding_homepage">
        <div class="support_category">
          <!--  add Container for rn commonTopics-->
           <div class="rn_commonTopics_MainContainer">
				<?php  
					
					if($clang=="ko_KR" && $flgtNo=="DAL") { ?>
					<div class="rn_commonTopics" onclick="toggleText()"><span>자주 묻는 질문 카테고리</span>
					<?php }
					elseif($clang=="ko_KR" && $flgtNo=="CPA" && getUrlParm('ko')=="1") { ?>
					<div class="rn_commonTopics" onclick="toggleText()"><span>자주 묻는 질문 카테고리 &#9662</span>
					<?php }
					elseif($clang=="de_DE" && $flgtNo=="CPA" && getUrlParm('ge')==="1") { ?>
					<div class="rn_commonTopics" onclick="toggleText()"><span>FAQ-KATEGORIEN &#9662</span>
					<?php }
				else
				{
				?> 
				<div class="rn_commonTopics" onclick="toggleText()"><span> <?php if($flgtNo=="CPA") {?> FAQ <? } ?> Categories <?php if($flgtNo=="CPA") {?>&#9662<? } ?></span>
				<?php }   ?> 
              
            </div>
            <div id="rn_show_dropdown">
				<?php if($flgtNo!="CPA") { ?>
				<img class="dd-close-btn" src="/euf/assets/themes/standard/images/close-btn.png" alt="close">
				<? }  ?>
              	<?php
			  
			  
			
				if($clang=="ko_KR" && $flgtNo=="DAL"){ $new_ses=substr($ses , strpos($ses, 'flightNumber'));?>
				
				<rn:widget path="custom/search/CategorListCustomKorean" data_type="categories" label_title="" only_display="212,213,214,215,216,147,217" report_page_url="/app/home/#rn:php:$new_ses#/#rn:php:$ses#"/>
				<?php } 
				elseif($clang=="ko_KR" && $flgtNo=="CPA" && getUrlParm('ko')=="1"){ $new_ses=substr($ses,strpos($ses,'flightNumber'));?>
				
				<rn:widget path="custom/search/CategorListCustomKorean" data_type="categories" label_title="" only_display="212,213,214,215,217" report_page_url="/app/home/#rn:php:$new_ses#/#rn:php:$ses#"/>
				<?php } 
				elseif($clang=="en_US" && $flgtNo=="CPA"){ ?>
				<rn:widget path="custom/search/CategorListCustom" data_type="categories" label_title="" only_display="2,7,8,9,24" report_page_url="/app/home/#rn:php:$ses#"/> 
				<?php }
				elseif($clang=="de_DE" && $flgtNo=="CPA" && getUrlParm('ge')==="1")
				{
				$new_ses=substr($ses ,strpos($ses,'flightNumber'));?>
				
				<rn:widget path="custom/search/CategoryListGerman" data_type="categories" label_title="" only_display="238,239,240,241,242" report_page_url="/app/home/#rn:php:$new_ses#/#rn:php:$ses#"/>
				<?php } 
				elseif(strpos($flgtNo,'JAL')!== false||strpos($flgtNo,'AMX')!== false||strpos($flgtNo,'RXA')!== false||strpos($flgtNo,'GLO')!== false||strpos($flgtNo,'G3')!== false|| strpos($flgtNo,'VIR')!== false|| strpos($flgtNo,'VOZ')!== false|| strpos($flgtNo,'JTA')!== false)
				{?>
					<rn:widget path="search/ProductCategoryList" data_type="categories" label_title="" only_display="2,7,8,9,73,24" report_page_url="/app/home/#rn:php:$ses#"/>
					<?php } elseif(strpos($flgtNo,'AAL')!== false)
					{
						?>
						<rn:widget path="search/ProductCategoryList" data_type="categories" label_title="" only_display="251,252,253,254,256,9" report_page_url="/app/home/#rn:php:$ses#"/>  
						<?
					}
					else
					{?>
				<rn:widget path="search/ProductCategoryList" data_type="categories" label_title="" only_display="2,7,8,9,73,147,24" report_page_url="/app/home/#rn:php:$ses#"/>
				<?php }
				 ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </rn:condition>
  <div id="rn_PageContent" class="rn_Home">
    <div class="rn_ResCat">
      <h2>
        <?php echo $res_cat; ?>
      </h2>
    </div>
    <div class="rn_Module">

      <div id = "hide_show">
        <?php
		
/*Multiline widget customization*/
?>
       
<!--  
 <rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="#rn:php:$flight#" per_page="10" />  */
-->       
       
        <?php if($flgtNo=="AAL"){?>
        <rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="#rn:php:$flight#" per_page="15" /> 
		<?php } 
		else
		{ ?>
		<rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="#rn:php:$flight#" per_page="10" /> 
		<?php } ?>       
		
      </div>
    </div>
  </div>
</rn:container>


	<script>
	function toggleText(){
	 /* var x = document.getElementById("rn_show_dropdown");
 	 if (x.style.display === "none") {
 	   x.style.display = "block";
	  } else {
	    x.style.display = "none";
	  } */
	}
	</script>

