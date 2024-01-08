<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('answer', \RightNow\Utils\Url::getParameter('a_id'))#" template="standard.php" answer_details="true" clickstream="answer_view"/>

<div id="rn_PageTitle" class="rn_AnswerDetail">
<div id="rn_SearchControls">
        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
        <form onsubmit="return false;">
            <div class="rn_SearchInput">
                <rn:widget path="search/AdvancedSearchDialog" report_page_url="/app/answers/list"/><!--Modified to show search results on NO 05-19-2014-->
                <rn:widget path="search/KeywordText" label_text="" initial_focus="true"/>
                <!--<rn:widget path="search/KeywordText" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus="true"/>-->
            </div>
            <rn:widget path="search/SearchButton" report_page_url="/app/answers/list"/>
            <p>#rn:msg:FIND_ANS_MSG#</p>
        </form>
        <rn:widget path="search/DisplaySearchFilters"/>
    </div>
    <h1 id="rn_Summary" class="Blue_H1"><rn:field name="Answer.Summary" highlight="true"/></h1>
   
    <rn:field name="Answer.Question" highlight="true"/>
</div>
<div id="rn_PageContent" class="rn_AnswerDetail">
    <div id="rn_AnswerText">
        <rn:field name="Answer.Solution" highlight="true"/>
    </div>
    <rn:widget path="knowledgebase/GuidedAssistant"/>
    <div id="rn_FileAttach">
        <rn:widget path="output/DataDisplay" name="Answer.FileAttachments" label="#rn:msg:ATTACHMENTS_LBL#"/>
    </div>
    <rn:widget path="feedback/AnswerFeedback" dialog_threshold="0"/> <!--Modified to hide popup on NO 05-19-2014-->
    <br/>
    <rn:widget path="knowledgebase/RelatedAnswers" />
    <!-- Removed for Version upgrade <rn:widget path="knowledgebase/PreviousAnswers" /> -->
    <div id="rn_DetailTools">
	<table class="rn_DetailTools_Table" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td align="left">

    <div class="rn_back"> 
	   <?php
		if(strpos($_SERVER['HTTP_REFERER'], "/app/answers/list"))
		{
			$back_link = $_SERVER['HTTP_REFERER'];
		}
		else
		{
			$back_link = "/app/answers/list/";
			
		}
		?>
        <?php
        if(strpos($back_link, "/kw/"))
		{
		?>
            <a href="<?php echo $back_link; ?>#rn:session#">&#171;
            <!-- <a href="/app/answers/list#rn:session#">&#171; -->
             #rn:msg:GO_BACK_TO_SEARCH_RESULTS_CMD#</a>
         <?php
		}
		 else
		 {
		 ?>
            <a href="<?php echo $back_link; ?>#rn:url_param:kw##rn:session#">&#171;
            <!-- <a href="/app/answers/list#rn:session#">&#171; -->
             #rn:msg:GO_BACK_TO_SEARCH_RESULTS_CMD#</a>             
         <?php
		 }
		 ?>
		 </div>
	</td>
	<td>
	<!-- <rn:widget path="utils/SocialBookmarkLink" /> -->
	
	<rn:widget path="utils/SocialBookmarkLink" />
        <rn:widget path="utils/PrintPageLink" />
        <rn:widget path="utils/EmailAnswerLink" />
        <rn:condition logged_in="true">
            <rn:widget path="notifications/AnswerNotificationIcon" />
        </rn:condition>
	</td>
	</tr>
	</table>
       
    </div>
</div>
