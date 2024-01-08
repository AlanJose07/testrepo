<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('answer', \RightNow\Utils\Url::getParameter('a_id'))#" template="standard_ans_detail.php" answer_details="true" clickstream="answer_view"/>

<div id="rn_PageTitle" class="rn_AnswerDetail">
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
        <rn:field name="Answer.Solution" highlight="true"/>
    </div>
    <rn:widget path="knowledgebase/GuidedAssistant"/>
    <div id="rn_FileAttach">
        <rn:widget path="output/DataDisplay" name="Answer.FileAttachments" label="#rn:msg:ATTACHMENTS_LBL#"/>
    </div>
	
    <div id="rn_AnswerInfo">
        #rn:msg:PUBLISHED_LBL# 
        <rn:field name="answers.created" />
        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        
        #rn:msg:UPDATED_LBL# 
        <rn:field name="answers.updated" />
        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
       #rn:msg:ID_LBL#        
       <rn:field name="answers.a_id"         />
    </div>
<br>
<!--  ************* DETAILS **************** -->

<script type="text/javascript">
<!--
    function toggle_visibility() {
       var e = document.getElementById("rn_metalist");
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>

<div id="rn_meta">
     <h2>#rn:msg:DETAILS_LBL#
    &nbsp; <a href="javascript:toggle_visibility();" 
      class="icon">

      <img src="/euf/assets/images/arrows_down.gif"
      alt="#rn:msg:EXPAND_DETAILS_SECTION_CMD#"
       id="opener_button" /></a>
    </h2>
 <div id="rn_metalist" style="display:none;">
  
	 <rn:widget path="output/FieldDisplay" 
          name="answers.c$agentkb" />
	<rn:widget path="output/FieldDisplay" 
          name="answers.c$beachbody" />
		  <rn:widget path="output/FieldDisplay" 
          name="answers.c$tbb" />
        <rn:widget path="output/FieldDisplay" 
          name="answers.c$coo" />
      <rn:widget path="output/FieldDisplay" 
          name="answers.c$shakeology" />
      <rn:widget path="output/FieldDisplay" 
          name="answers.c$ultimate_reset" />
      <rn:widget path="output/FieldDisplay" 
          name="answers.c$tbb_spanish" />
      <rn:widget path="output/FieldDisplay" 
          name="answers.c$shakeology_spanish" />
        <rn:widget path="output/FieldDisplay" 
          name="answers.c$p90x_certification" />
		 <rn:widget path="output/FieldDisplay" 
          name="answers.c$sme" />

     
     </div>  <!-- id="rn_metalist" -->
     </div>  <!-- id="rn_meta"> -->
<!--  ************* DETAILS **************** -->


<br>
<rn:widget path="custom/input/AnswerFeedback" dialog_threshold="1" label_dialog_description  ="Please select what best describes the information: " submit_feedback_ajax="/cc/AjaxCustom/submitAnswerFeedback" label_feedback_thanks="Thanks for your feedback" label_dialog_title=""/>
    <br/>
    <rn:widget path="knowledgebase/RelatedAnswers" />
   <!-- <rn:widget path="knowledgebase/PreviousAnswers" />-->
    <rn:widget path="custom/search/PreviousAnswers_custom" />

  <!--  <div id="rn_DetailTools">-->
<br><br> <br>
<div>
<table width=100%>
<tr>
<td align=LEFT>
<a href="javascript: history.go(-1)">&#171;
         #rn:msg:GO_BACK_TO_SEARCH_RESULTS_CMD#</a>
</td>
<td align=RIGHT>
		 
		 <!-- Anuj CP3 Migration - UAT#3 - Andrew: Don't want social share option -->
			<?php /*
			<rn:widget path="utils/SocialBookmarkLink" sites="Delicious > Post to Delicious > http://del.icio.us/post?url=|URL|&title=|TITLE|,Digg > Post to Digg > http://digg.com/submit?url=|URL|&title=|TITLE|,Facebook > Post to Facebook > http://facebook.com/sharer.php?u=|URL|,Reddit > Post to Reddit > http://reddit.com/submit?url=|URL|&title=|TITLE|,StumbleUpon > Post to StumbleUpon > http://stumbleupon.com/submit?url=|URL|&title=|TITLE|,Twitter > Tweet this > http://twitter.com/home?status=|TITLE| |URL|" />
			*/ ?>
            <rn:widget path="utils/PrintPageLink" />
            <rn:widget path="utils/EmailAnswerLink" />
</td>
</tr>
</table>
</div>
        <rn:condition logged_in="true">
            <rn:widget path="notifications/AnswerNotificationIcon" />
        </rn:condition>
<!--    </div>-->
</div>

<style>
table{
height:0px !important;
}
.rn_NavigationTab a.rn_SelectedTab {
    cursor: pointer !important;
    float: left !important;
    font-size: 1em !important;
    font-weight: bold !important;
    height: 20px !important;
    _height: 18px !important;
    margin-right: 4px !important;
    padding: 5px 20px !important;
    position: relative !important;
}
</style>
