<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="gogoHome"/>
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
	elseif($flgtNo=="DAL")
		$flight = 100764;
	elseif($flgtNo=="JAL")
		$flight = 100765;
	elseif($flgtNo=="TRS")
		$flight = 100766;
	elseif($flgtNo=="UAL")
		$flight = 100767;
	elseif($flgtNo=="VRD")
		$flight = 100768;
	elseif($flgtNo=="VIR")
		$flight = 101228;
	elseif($flgtNo=="null")
		$flight = 100769;							
	else
		$flight = 100003;
    /*Airline Template-Start
	}
	Airline Template-End*/
	$c=getUrlParm('c');
	if($c==NULL || $c=='' || $c==0) {$res_cat="Common Topics";}
	else { $res_cat=$CI->model('custom/language_model')->getCurrentCategory($c); }
	
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
          <rn:widget path="search/KeywordTextGogo" label_text="" report_id="#rn:php:$flight#" initial_focus="false"/>
        </div>
        <rn:widget path="search/SearchButton" report_id="#rn:php:$flight#" icon_path="images/icon_search.png" />
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
            <div class="rn_commonTopics"><span style="float:left;">FAQ CATEGORIES</span>
              <div class="rn_downarrow"></div>
            </div>
            <div id="rn_show_dropdown">
              <rn:widget path="search/ProductCategoryList" data_type="categories" label_title="" report_page_url="/app/home"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </rn:condition>
  <div id="rn_PageContent" class="rn_Home">
    <div class="rn_ResCat">
      <h2 style="color:#999999;">
        <?php echo $res_cat; ?>
      </h2>
    </div>
    <div class="rn_Module">
      <div id = "hide_show">
        <?php
/*Multiline widget customization*/
?>
        <rn:widget path="reports/MultilineAnswersCustom" truncate_size="10000" report_id="#rn:php:$flight#" per_page="10" />
      </div>
    </div>
  </div>
</rn:container>
