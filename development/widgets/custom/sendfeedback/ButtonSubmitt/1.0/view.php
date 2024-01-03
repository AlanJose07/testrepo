
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<div align ="center" id="box" class ="pop"> 
<rn:widget path="custom/sendfeedback/AnswerFeedbackCustom" submit_feedback_ajax="/ci/AjaxCustom/set_feedback" submit_rating_ajax="/ci/AjaxCustom/submitRating"/>

</div> 

<div align ="center">
<button type="button" align="center" onClick="popup()">Send FeedBack For the Keyword</button>
</div>
</div>
