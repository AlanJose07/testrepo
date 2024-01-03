<?php $c_id = $this->session->getProfile()->c_id->value;
	   $c1 = RightNow\Connect\v1_2\Contact::fetch($c_id);
	   $count=(count($c1->ServiceSettings->SLAInstances));
	   $sla=$c1->ServiceSettings->SLAInstances[$count-1]->NameOfSLA->LookupName;  
?>
<style>
	table{ margin-top:20px; margin-bottom:20px;width:100%;border: 2px solid grey; border-collapse:collapse; empty-cells:show;
    border-spacing: 0;}
 th, td {
    border: 2px solid grey;
    padding: 5px;
	width: 50%;
}
#rnDialog2 button {
	margin-bottom:0px;
}
</style>
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="standard_agent.php" clickstream="answer_list" login_required="true"/>
<rn:widget path="custom/AdditionalServices/sessionTracker" usertype="AMCC_Agent"/>
<rn:widget path="custom/input/Getlogin" />
<rn:widget path="knowledgebase/RssIcon"/>
<!-- mkt changes for AMCC Service Now -->
 <?php if($sla=="AMCC") {?> 
 <div id="rn_PageContent" class="rn_AnswerList">
    <div class="rn_Padding">
	<p style="text-align:center;font-weight:bold;font-size:16px;margin:10px;">Knowledgebase articles are now transitioned to ServiceNow.  Click <a href="https://gogo.service-now.com/nav_to.do?uri=%2F$knowledge.do%3Fbrowse_type%3Dcategories%26sysparm_kb%3Dd9de81d12fa4d5d09db457ab2799b6cb" target="_blank">here</a> or screenshot to open.</p>

	<a href="https://gogo.service-now.com/nav_to.do?uri=%2F$knowledge.do%3Fbrowse_type%3Dcategories%26sysparm_kb%3Dd9de81d12fa4d5d09db457ab2799b6cb" target="_blank" class="all-page-logo"><img src="/euf/assets/themes/standardagent/images/SNOW_KB.png" alt="Gogo Logo"/> </a>

	</div>
</div>
<?php }else { ?>
<!-- mkt changes for AMCC Service Now Ends -->
 <?php if($sla=="AMCC") {?>
	  <rn:container report_id="105760" per_page="20">
	  <?php } 
	  else { ?>
		 <rn:container report_id="110327" per_page="20">
		
		<?php } ?>
	 

<!--<rn:container report_id="101195" per_page="20">-->
<div id="rn_PageTitle" class="rn_AnswerList">
    <div id="rn_SearchControls">
        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
        <form onsubmit="return false;">
            <div class="rn_SearchInput">
                
                <rn:widget path="search/KeywordTextPrivate" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus="true"/>
			
            </div>
            <rn:widget path="standard/search/SearchButton"/>
        </form>
       
    </div>
</div>
<div id="rn_PageContent" class="rn_AnswerList">
	
    <div class="rn_Padding">

        <h2> Answers</h2>
        <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
        <rn:widget path="reports/ResultInfoPrivate" />
		<div id="noresults" style="display:none;">
		<br>
		<rn:widget path="custom/feedback/customFeedback" label_no_button="Send Feedback on Search Keyword" submit_feedback_ajax="/cc/AjaxCustom/set_feedback_internal" submit_rating_ajax="" label_dialog_description="Please provide your feedback on the keyword" label_dialog_title="Keyword Feedback"/>
		</div>
	   <?php if($sla=="AMCC") {?>
      <div style="display:none;" id="snow">
		 <rn:widget path="reports/MultilineSNow"/>
         </div>
         <?php } ?>    

     

         <div id="res" class="search-result">
       
	  <?php if($sla=="AMCC") {?>      
	  <rn:widget path="reports/MultilineGoogle"/>
      <!--To block the checktoken function-->
        <rn:widget path="custom/reports/AgentMultiline"/>
		<?php } else { ?>
		 
		<rn:widget path="custom/reports/AgentMultiline"/>
		<?php } ?>
		 <rn:widget path="standard/reports/Paginator" />
        </div>
       
    </div>
</div>
</rn:container>
 <?php if($sla!=="AMCC") {?>
<div id="rn_PageContentGoogle" class="rn_AnswerList">
	
    <div class="rn_Padding">    
    <rn:widget path="reports/MultilineStandardText"/>
 </div></div>
<?php }
}
 ?>