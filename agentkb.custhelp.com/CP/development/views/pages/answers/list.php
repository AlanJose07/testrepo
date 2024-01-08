<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="standard.php" clickstream="answer_list"/>

<rn:widget path="knowledgebase/RssIcon"/>
<div id="rn_PageTitle" class="rn_AnswerList">
    <div id="rn_SearchControls">
        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
        <form method="post" name="SearchForm" onsubmit="return false; " class="answer_new">
            <div class="rn_SearchInput">
                <rn:widget path="search/KeywordText" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus="true" report_id="111499"/>
            </div>
            <rn:widget path="custom/search/SearchButton_custom" report_id="111499"/>
			   <rn:widget path="custom/search/AskTheCatSearchFilters" report_id="111499" />
       
        <!--<table width=100%> <tr> <td>
<rn:widget path="custom/search/ProductCategorySearchFilter_custom" selection="exclude" p_id="890,947" label_nothing_selected="Limit by Product" report_id="111499" /> 
</td> <td>
 <rn:widget path="search/ProductCategorySearchFilter" filter_type="categories"  
label_nothing_selected="Select a Category " label_input=""
report_id="111499"/>
</td></tr>
</table>-->
      </form>
    </div>
	 
</div>
<div id="rn_PageContent" class="rn_AnswerList">
     <div id="pageResults"class="rn_Padding rn_Hidden">
        <h2 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_RESULTS_CMD#</h2>
        <rn:widget path="reports/ResultInfo" report_id="111499" add_params_to_url="p,c"/>
        <!--<rn:widget path="knowledgebase/TopicWords"/>-->
        <rn:widget path="reports/Multiline" report_id="111499"/>
        <rn:widget path="reports/Paginator" report_id="111499"/>
    </div>
	   <div id="selectFilter" class="rn_Padding">
        <div class=" SelectFilter">
            *Please select one search filter to display your results.
        </div>
    </div>
</div>

