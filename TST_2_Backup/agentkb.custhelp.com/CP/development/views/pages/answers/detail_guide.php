<style>
/*css for guided assistance*/
#rn_SearchControls .rn_CustomSearchButton {
    padding-top: 5px;
}

.rn_AnswerDetail #rn_AnswerText, .rn_AnswerDetail #rn_AnswerText p, .rn_AnswerDetail #rn_AnswerText p span, .rn_AnswerDetail #rn_AnswerText span {
    font-size: 16px!important;
    font-family: calibri!important;
}

.rn_Node1.rn_Question1
    {
        clear: both;
        
    }
p {
    font-size: 18px;
    line-height: 1.3em;
    margin-bottom: 1em;
    margin-top: 1em;
}

#rn_MainColumn ul li,.rn_Guide ul li,.rn_Result ul li ,ol li {
    font-size: 16px;
    line-height: 26px;
}   
    #rn_Container{
    font-size: 14px;
    }    
    
    .rn_RadioQuestion1 input[type="radio"] {
    position: absolute;
    margin-right: -30px;
	
}
    .rn_RadioQuestion1 label {
    margin-left: 20px;
}
    .rn_RadioQuestion1 div{
        float: left;
		/*margin-left:50px;*/
    }
    .rn_RadioQuestion1 div:last-child {
    margin-left: 10px;
}

     /*.rn_Question1 {margin-left: 443px;}*/
	 /*.rn_RadioQuestion1{margin-left: 44px;}*/
	 .rn_QuestionText1{margin-left: 13px;}
	 /*.rn_Response .rn_ImageQuestion{float:left}*/
	 .imagealign{float:left;}
	 
/************************************************/

 .tab button {
    background: #fff;
    border-radius: 0;
     box-shadow: none;
    border: 1px solid #304764;
    color: #0076d6;
    cursor: pointer;
    font: bold 12px Helvetica,Arial,sans-serif;
    line-height: normal;
    margin-right: 6px;
    padding: 6px 8px;
    text-decoration: none;
    text-shadow: none;
}
    
   .tab-details {
    border: 1px solid #ddd;
    padding: 0 0 10px !important;
}
    
    .highlight{
	    /*width: 20%;*/
        background: #FFF9C4!important;
		     
    }
    
    .rn_ContactUsChatWidget {  
        background: #fff;
        float: left;
        width: 100%;
        padding: 5px;
        box-shadow: 3px 3px 3px #888;
        border-right: 1px solid #DDD;
        border-left: 1px solid #DDD;
    }
    	 
/*css for guided assistance*/
</style>
<!--script for guided assistance-->
<script>
    
	String.prototype.rtrim = function(s) { 
		return this.replace(new RegExp(s + "*$"),''); 
	};
	function evalJs(objName, functionName,params) {   
		var script = $("div#"+objName).find("script").text();
		eval(script);
		var functionCall = functionName + "(";
		if(params!='null'){
		var ab=params.split(",");
		for(var i=0;i<ab.length;i++){functionCall += "'"+ab[i]+ "'"+",";}   
		functionCall = functionCall.rtrim(",");
		}
		functionCall += ");";
		eval(functionCall);    
	}
</script>
<!--script for guided assistance-->


<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('answer', \RightNow\Utils\Url::getParameter('a_id'))#" template="standard_guide.php" answer_details="true" clickstream="answer_view"/>

<!--<div id="rn_PageTitle" class="rn_AnswerDetail">
    <h1 id="rn_Summary"><rn:field name="Answer.Summary" highlight="true"/></h1>
    <div id="rn_AnswerInfo">
        #rn:msg:PUBLISHED_LBL# <rn:field name="Answer.CreatedTime" />
        &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        #rn:msg:UPDATED_LBL# <rn:field name="Answer.UpdatedTime" />
    </div>
    <rn:field name="Answer.Question" highlight="true"/>
</div>-->
<div id="rn_PageContent" class="rn_AnswerDetail">
 <div class="ans_display"> <!--this div is used for user guide answers whenever guide assistance isused-->
    <div id="rn_AnswerText">
        <rn:field name="Answer.Solution" highlight="true"/>
    </div>
    <!--<rn:widget path="knowledgebase/GuidedAssistant"/>-->
	<rn:widget path="custom/lob/customguidedassistance"/>   
    <div id="rn_FileAttach">
        <rn:widget path="output/DataDisplay" name="Answer.FileAttachments" label="#rn:msg:ATTACHMENTS_LBL#"/>    
    </div>
	</div> <!--this div is used for user guide answers whenever guide assistance isused-->
	
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
  <rn:widget path="feedback/AnswerFeedback" dialog_threshold = 0/>
    <br/>
    <rn:widget path="knowledgebase/RelatedAnswers" />
    <rn:widget path="knowledgebase/PreviousAnswers" />
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
</style>

<script>
  $("body").on("change", "input[type=radio],select", function(){
	$(".rn_Question1").removeClass("highlight");
    $(this).closest(".rn_Question1" ).addClass("highlight");
	 
	 });       
</script>         

