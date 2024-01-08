<style>
	#num_comment li {
		    list-style-type: none;
    margin-bottom: 30px;
    background: none;
    padding: 0;
	}
	#num_comment li .rn_Element1{
		width: 100%;
		font-weight:bold;
		color:#000;
	}
	#num_comment li .rn_Element4{
		display:block;
		width:100%;
	}
	#num_comment li .rn_Element3{
		display:block;
		text-decoration:underline;
		color:#337ab7;
		width:100%;
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
              <rn:widget path="search/KeywordText" label_text="" label_placeholder="Enter your question or an FAQ#" initial_focus="false"/>
              <span class="input-group-btn">
              <rn:widget path="search/SearchButton" report_page_url="" force_page_flip="true"/>
              </span> </div>
          </rn:container>
        </form>
      </div>
</div>
	<!-- Breadcrumb
	<div class="primary_icons">
      <rn:widget path="custom/responsive/CustomBreadCrumb" />
    </div>-->
	<!-- Breadcrumb-->


<div id="answers" class="answer_list">
  <div class="container" >
      <rn:container report_id='143145'> <!--130168--> 
      <div class="rn_Padding">
        <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
        <rn:widget path="standard/knowledgebase/TopicWords" display_icon="true"/>
	   <rn:widget path="custom/ResponsiveDesign/CategorySearchFilterTreeView" filter_type = "categories" search_on_select ="true" static_filter="c=#rn:php:$catid#"/>
	   <rn:widget path="custom/ResponsiveDesign/MultilineDisplay" per_page="10"  static_filter="c=#rn:php:$catid#" truncate_size="200" label_screen_reader_search_no_results_alert="Your search returned no results"/>
<rn:widget path="custom/ResponsiveDesign/PaginatorGeneric" per_page="10" report_id="143145"  static_filter="c=#rn:php:$catid#"/>  
 <!-- <rn:widget path="reports/Paginator" per_page="10" />  --> 
      </div>
    </rn:container>   
</div> 
</div>           
