<?php

$u_id=uniqid();
$now=date("h:i:s");
?>
<div style="display:none;">
<span id="u_id"><?php echo $u_id;?></span>

<span id="st_time"><?php echo $now;?></span>
</div>
<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('answer', \RightNow\Utils\Url::getParameter('a_id'))#" template="standard_agent.php" answer_details="true" clickstream="answer_view" login_required="true"/>

<div id="rn_PageTitle" class="rn_AnswerDetail">
   <div id="rn_SearchControls">
        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
        <form onsubmit="return false;">
            <div class="rn_SearchInput">
                <rn:widget path="search/KeywordText" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus="true"/>
            </div>
            <rn:widget path="search/SearchButton" report_page_url="/app/answers/list/">
        </form>
        
    </div>
    <h2>Question:</h2>
    
    <h1 id="rn_Summary"><rn:field name="Answer.Summary" highlight="true"/></h1>
    <div id="rn_AnswerInfo">
        #rn:msg:PUBLISHED_LBL# <rn:field name="Answer.CreatedTime" />
        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        #rn:msg:UPDATED_LBL# <rn:field name="Answer.UpdatedTime" />
    </div>
    <rn:field name="Answer.Question" highlight="true"/>
</div>
<div id="rn_PageContent" class="rn_AnswerDetail">
    <div id="rn_AnswerText">
    <h2>Answer:</h2>
        <rn:field name="Answer.Solution" highlight="true"/>
   
	<rn:widget path="custom/custom/CustomGuide"/>
	<br />
	<br />
	<br />
	<br />
	 </div>
	<br/>
	
    <div id="rn_FileAttach">
    <h2>Attachments:</h2>	
        <rn:widget path="output/DataDisplay" name="Answer.FileAttachments" label=""/>
    </div>
<div id="feed">
    <rn:widget path="feedback/AnswerFeedbackCustom" submit_feedback_ajax="/ci/AjaxCustom/set_feedback" submit_rating_ajax="/ci/AjaxCustom/submitRating"/>
    
</div>
    <br/>
    </div>
</div>
