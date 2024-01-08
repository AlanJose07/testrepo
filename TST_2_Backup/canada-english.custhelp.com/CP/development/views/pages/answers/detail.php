<link href="/euf/assets/themes/responsive/css/answer_detail.css" rel="stylesheet">
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<script>
window.addEventListener('hashchange', function() {
//$(window).bind('hashchange', function(event){
//alert("hii123..");
var type = window.location.hash.substr(1);
//alert(type);
 $("#"+type).addClass("testjithin");
    window.scrollBy(0, -100);   
});

$('body').click(function(){
  if(document.getElementsByClassName("testjithin")[0])
  { //var id = window.location.hash.replace(/^#!/, '');
  
  }
  else
  {}
});

</script>


<rn:meta title="#rn:php:SEO::getDynamicTitle('answer', getUrlParm('a_id'))#" template="standard_responsive_bb.php" answer_details="true" clickstream="answer_view"/>

<?
$category_id = getUrlParm('catid');
$a_id = getUrlParm('a_id');
$uri_answers =  $this->uri->router->segments[3].$this->uri->router->segments[4].$this->uri->router->segments[5].$this->uri->router->segments[7].$this->uri->router->segments[9].$this->uri->router->segments[11]; 
if($uri_answers == "answersdetaila_idcatidcatnmeTLP"){
	$remove_bookmarked_url = $this->model('custom/bbresponsive')->remove_bookmarked_url($category_id,"answers");
  	if($a_id != $remove_bookmarked_url['answer_report_id'])
		{
		  $url = "/app/pagenotfound";
 		  header('Location: ' . $url);
		}
}
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
<div class="answer_detail" id="answercontent">
  <div class="container">
    <rn:widget path="knowledgebase/RssIcon2" icon_path="" />
    <div class="rn_AnswerDetail">
      <div class="rn_Padding">
        <h1 id="rn_Summary">
          <rn:field name="Answer.Summary" highlight="true"/>
        </h1>
		<div class="rn_AnswerInfo">
                FAQ:<rn:field name="Answer.ID" highlight="true"/>
            </div>
        <!--<div id="rn_AnswerInfo"> #rn:msg:PUBLISHED_LBL#
          <rn:field name="answers.created" />
          &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
          
          #rn:msg:UPDATED_LBL#
          <rn:field name="answers.updated" />
        </div>-->
		
		
		<div class="rn_AnswerQuestion">
                <rn:field name="Answer.Question" highlight="true"/>
            </div>
		
		
        <div id="rn_AnswerText">
          <rn:field name="answers.solution" highlight="true"/>
        </div>
		<div id="rn_FileAttach">
			<rn:widget path="output/DataDisplay" name="Answer.FileAttachments" label="#rn:msg:ATTACHMENTS_LBL#"/>
		</div>
       <!-- <rn:widget path="feedback/AnswerFeedback" />-->
	  <!-- <rn:widget path="custom/ResponsiveDesign/AnswerFeedbackReason" dialog_threshold="1" label_dialog_description  ="Please select what best describes the information: " submit_feedback_ajax="/cc/AjaxCustom/submitAnswerFeedback" label_dialog_title=""/>-->
	    <rn:widget path="custom/ResponsiveDesign/AnswerFeedback" dialog_threshold="1" label_dialog_description  ="Please select what best describes the information: " submit_feedback_ajax="/cc/AjaxCustom/submitAnswerFeedback" label_dialog_title=""/>
      </div>
    </div>
  </div>
</div>
<script>
/* Check if answer.question is null */
try
{
	var text = (document.getElementsByClassName('rn_AnswerQuestion')[0].innerText).trim();
	if(text === "")
	{
		document.getElementsByClassName('rn_AnswerQuestion')[0].style.display = "none";
	}
}
catch(err)
{

}

$(document).ready(function() {
var url=String(window.location);   
var exploded_url= url.split("/");
var index=exploded_url.indexOf("a_id");
var index_cat=exploded_url.indexOf("catid");

var aid= exploded_url[index+1]; 
var cid = exploded_url[index_cat+1]; 

click_tracking(aid,cid,1);
});
</script>