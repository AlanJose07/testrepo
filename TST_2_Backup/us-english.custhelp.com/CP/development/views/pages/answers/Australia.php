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
  .full-wrapper{
    min-height : 0px !important;
  }
</style>
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="standard_responsive_bb.php" clickstream="answer_list" />
<?
  $catid= getUrlParm('catid');
  $ansid= getUrlParm('ans_id');
  //$ansid="101130";
  ?>

<div id="answers" class="answer_list" style="min-height: 395px;">
  <div class="container" >
      <rn:container report_id='199773'> 
      <div class="rn_Padding">

		<div id="mpa_title"> Beachbody On Demand Australia Support </div>
	   <!--<rn:widget path="search/ProductCategorySearchFilter" filter_type = "categories" search_on_select ="true" static_filter="c=#rn:php:$catid#"/>   -->
	   
	   <!-- no result found section[below]-->
	   <rn:widget path="reports/ResultInfo" show_no_results_msg_without_search_term="true"/>
	  <!-- no result found section[above]-->
	  
        <rn:widget path="custom/ResponsiveDesign/CustomMultiline" truncate_size="200"/>
     <!--    <rn:widget path="custom/ResponsiveDesign/CustomMultiline" per_page="10" truncate_size="200"/>
       <rn:widget path="custom/ResponsiveDesign/MostPopularAnswers" per_page="10" static_filter="c=#rn:php:$catid#"/>-->
    
<!--	<rn:widget path="reports/Paginator" per_page="10" />
	 <rn:widget path="custom/ResponsiveDesign/CustomPaginator" per_page="10"  report_id='199773'/>-->
	  
      </div>
    </rn:container>   
</div> 
</div>           
