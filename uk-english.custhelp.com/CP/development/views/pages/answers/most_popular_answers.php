<style>
.rn_Results 
	{
	display: none;   
	}
	.rn_NoResults
	{
	margin-top: 20px;
	}
	.rn_ResultInfo .rn_NoResults 
	{
     background-color: #ffffff; 
     border: none; 
    }
</style>

<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="standard_responsive_bb.php" clickstream="answer_list" />
<?
  $catid= getUrlParm('catid');
  $ansid= getUrlParm('ans_id');
  //$ansid="101130";
  ?>
<div class="container">
      <div id="form" class="search_wrap inner-search">
        <form class="form-horizontal" onSubmit="return false;">
          <rn:container report_id="176">
            <div class="form-group form-group-md">
              <rn:widget path="search/KeywordText" label_text="" label_placeholder="Enter a question or FAQ#" initial_focus="false"/>
              <span class="input-group-btn">
              <rn:widget path="search/SearchButton" report_page_url="/app/answers/list"/>
              </span> </div>
          </rn:container>
        </form>
      </div>
</div>
<div id="answers" class="answer_list" style="min-height: 395px;">
  <div class="container" >
      <rn:container report_id='143278'> 
      <div class="rn_Padding">
        <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
        <rn:widget path="standard/knowledgebase/TopicWords" display_icon="true"/>
		<div id="mpa_title"> Most Popular Answers</div>
		
		 <!-- no result found section[below]-->
	   <rn:widget path="reports/ResultInfo" show_no_results_msg_without_search_term="true"/>
	  <!-- no result found section[above]-->
	  
	   <!--<rn:widget path="search/ProductCategorySearchFilter" filter_type = "categories" search_on_select ="true" static_filter="c=#rn:php:$catid#"/>     -->
        <rn:widget path="custom/ResponsiveDesign/CustomMultiline" per_page="10" static_filter="c=#rn:php:$catid#" truncate_size="200"/>
       <!-- <rn:widget path="custom/ResponsiveDesign/MostPopularAnswers" per_page="10" static_filter="c=#rn:php:$catid#"/>-->
    
<!--	<rn:widget path="reports/Paginator" per_page="10" />-->
	 <rn:widget path="custom/ResponsiveDesign/CustomPaginator" per_page="10"  report_id='143278' static_filter="c=#rn:php:$catid#"/>
	  
      </div>
    </rn:container>   
</div> 
</div>           
