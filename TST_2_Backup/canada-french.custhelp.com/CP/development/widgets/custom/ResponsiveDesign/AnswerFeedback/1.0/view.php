<?php /* Originating Release: February 2015 */?>
<div id="rn_<?=$this->instanceID?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <? /* Define the rating feedback control. */ ?>
    <div id="rn_<?=$this->instanceID?>_AnswerFeedbackControl" class="rn_AnswerFeedbackControl">
        <? if ($this->data['attrs']['label_title']): ?>
            <div class="rn_Title"><?=$this->data['attrs']['label_title']?></div>
        <? endif;?>
        <? if ($this->data['js']['buttonView']): ?>
            <div id="rn_<?=$this->instanceID?>_RatingButtons">
                <button id="rn_<?=$this->instanceID?>_RatingYesButton" type="button"><?=$this->data['attrs']['label_yes_button']?></button>
                <button id="rn_<?=$this->instanceID?>_RatingNoButton" type="button"><?=$this->data['attrs']['label_no_button']?></button>
                <span id="rn_<?=$this->instanceID?>_ThanksLabel" class="rn_ThanksLabel">&nbsp;</span>
            </div>
        <? elseif ($this->data['attrs']['use_rank_labels']):?>
            <div id="rn_<?=$this->instanceID?>_RatingButtons">
            <? if ($this->data['attrs']['options_descending']): ?>
                <rn:block id="preRatingButtonsLoop"/>
                <? for($i=$this->data['attrs']['options_count'];$i>0;$i--): ?>
                    <rn:block id="topRatingButtonsLoop"/>
                    <button id="rn_<?=$this->instanceID?>_RatingButton_<?=$i?>" type="button"><?=\RightNow\Utils\Config::getMessage($this->data['rateLabels'][$i])?></button>
                    <rn:block id="bottomRatingButtonsLoop"/>
                <? endfor; ?>
                <rn:block id="postRatingButtonsLoop"/>
            <? else: ?>
                <rn:block id="preRatingButtonsLoop"/>
                <? for($i=1;$i<=$this->data['attrs']['options_count'];$i++): ?>
                    <rn:block id="topRatingButtonsLoop"/>
                    <button id="rn_<?=$this->instanceID?>_RatingButton_<?=$i?>" type="button"><?=\RightNow\Utils\Config::getMessage($this->data['rateLabels'][$i])?></button>
                    <rn:block id="bottomRatingButtonsLoop"/>
                <? endfor; ?>
                <rn:block id="postRatingButtonsLoop"/>
            <? endif; ?>
            <span id="rn_<?=$this->instanceID?>_ThanksLabel" class="rn_ThanksLabel">&nbsp;</span>   
			
			<!--test-->
        </div>
        <? else:?>
            <div id="rn_<?=$this->instanceID?>_RatingMeter" class="rn_RatingMeter <?=$this->data['RatingMeterHidden']?>">
            <? if ($this->data['attrs']['options_descending']): ?>
                <rn:block id="preRatingMeterLoop"/>
                <? for($i=$this->data['attrs']['options_count'];$i>0;$i--): ?>
                     <rn:block id="topRatingMeterLoop"/>
                     <? echo "<a id='rn_".$this->instanceID.'_RatingCell_'.$i."' href='javascript:void(0)' class='rn_RatingCell' title='".\RightNow\Utils\Config::getMessage($this->data['rateLabels'][$i])."' ".sprintf('><span class="rn_ScreenReaderOnly">'.$this->data['attrs']['label_accessible_option_description'], $i, $this->data['attrs']['options_count']).'</span>&nbsp;</a>'; ?>
                     <rn:block id="bottomRatingMeterLoop"/>
                <? endfor; ?>
                <rn:block id="postRatingMeterLoop"/>
                <? else: ?>
                    <rn:block id="preRatingMeterLoop"/>
                    <? for($i=1;$i<=$this->data['attrs']['options_count'];$i++): ?>
                        <rn:block id="topRatingMeterLoop"/>
                        <? echo "<a id='rn_".$this->instanceID.'_RatingCell_'.$i."' href='javascript:void(0)' class='rn_RatingCell' title='".\RightNow\Utils\Config::getMessage($this->data['rateLabels'][$i])."' ".sprintf('><span class="rn_ScreenReaderOnly">'.$this->data['attrs']['label_accessible_option_description'], $i, $this->data['attrs']['options_count']).'</span>&nbsp;</a>'; ?>
                        <rn:block id="bottomRatingMeterLoop"/>
                    <? endfor; ?>
                    <rn:block id="postRatingMeterLoop"/>
            <? endif; ?>
            <span id="rn_<?=$this->instanceID?>_ThanksLabel" class="rn_ThanksLabel">&nbsp;</span>
            </div>
        <? endif;?>
    </div>
    <? /* Container for feedback form.  It's hidden on the page. */ ?>
    <div id="rn_<?=$this->instanceID?>_AnswerFeedbackForm" class="rn_AnswerFeedbackForm rn_Hidden">
        <div id="rn_<?=$this->instanceID?>_DialogDescription" class="rn_DialogSubtitle"><?=$this->data['attrs']['label_dialog_description'];?></div>
        <div id="rn_<?=$this->instanceID;?>_ErrorMessage"></div>
        <rn:block id="preForm"/>
        <form>
        <rn:block id="topForm"/>
        
        <rn:block id="preFeedbackInput"/>
   
  <br />

		<?php 
		$reasons=$this->data['allReasons'];
		?>

	  <!--
	  	<input type="hidden" id="OptionsCount" value=3/> -->
		<div  id="rn_<?=$this->instanceID?>_FeedbackOptions">
		<?php
		
       foreach($reasons as $items) 
		{
		if($items->ID!=9)
		{
		?>
		<input type="radio" id="rn_<?=$this->instanceID?>_FeedbackOptions" name="reason" onclick="document.getElementById('add_feedback').style.display='block';" value="<?=$items->ID?>"/><?php echo "  ";?><?=$items->LookupName?> <br />
		<?php
		}
		} 
		?>
		<div id="add_feedback" style="display:none;">
		<br />
<!--	<label for="Additional Feedback" style="font-weight:bold"> Commentaires supplémentaires </label>   -->
		<label for="Additional Feedback" style="font-weight:bold"> Merci pour vos commentaires et nous aider à améliorer notre FAQ. </br> Veuillez noter que vous ne recevrez pas de réponse. </label>
		<br />
		<textarea rows="4" cols="50" id="add_feedback" name="add_feedback" style="border:solid" placeholder="Optionnel"></textarea>
		</div>
		</div>
		
        <rn:block id="postFeedbackInput"/>
        <rn:block id="bottomForm"/>
        </form>
        <rn:block id="postForm"/>
    </div>
    <? /* End form */ ?>
    <rn:block id="bottom"/>
</div>
