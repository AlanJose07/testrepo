<? /* Overriding AnswerFeedback's view */ ?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
 <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID?>_AnswerFeedbackControl" class="rn_AnswerFeedbackControl">
<div id="rn_<?=$this->instanceID?>_RatingButtons" class="rn_RatingButtons">
 <rn:block id="preNoButton"/>
    <button id="rn_<?=$this->instanceID?>_RatingNoButton" type="button"><?=$this->data['attrs']['label_no_button']?></button>
    <rn:block id="postNoButton"/>
</div>
</div>
    <rn:block id="bottom"/>
</div>
<style>
.feedbacktextarea .rn_Textarea{
	width:99% !important;
}
</style>