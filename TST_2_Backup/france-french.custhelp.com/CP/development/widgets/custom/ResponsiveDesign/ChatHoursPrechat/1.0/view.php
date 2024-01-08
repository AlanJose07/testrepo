<?php /* Originating Release: February 2019 */?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_HoursLabel" class="rn_HoursLabel">
        <rn:block id="chatHoursLabelTop"/>
        <?=$this->data['attrs']['label_chat_hours'];?>
        <rn:block id="chatHoursLabelBottom"/>
    </div>
    <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
        <rn:block id="chatHoursBlockTop"/>
        <?for ($i = 0; $i < count($this->data['chatHours']['hours']); $i++): ?>
            <rn:block id="preChatHoursItem"/>
            <div>
                <rn:block id="chatHoursItemTop"/>
                <rn:block id="preChatHoursItemPrefix"/>
                <span id="rn_<?=$this->instanceID;?>_HoursPrefix_<?=$i?>" class="rn_HoursPrefix">
					<? if($i==0): ?>
					<?= "Ouvert: "; ?>
					<? endif; ?>
					
					<? if($this->data['chatHours']['hours'][$i][0] == 'Samedi et Dimanche'): ?>
						<?=$this->data['chatHours']['hours'][$i][0] ?><?= ((LANG_DIR == fr_FR) || (LANG_DIR == fr_CA) ? '&nbsp' : ''); ?>:&nbsp;
					<? else: ?>
						<?=$this->data['chatHours']['hours'][$i][1] ?>
					<? endif; ?>
                </span>
                <rn:block id="postChatHoursItemPrefix"/>
                <rn:block id="preChatHoursItemHours"/>
                <span id="rn_<?=$this->instanceID;?>_Hours_<?=$i?>" class="rn_Hours">
					<? if($this->data['chatHours']['hours'][$i][0] == 'Samedi et Dimanche'): ?>
						<?=$this->data['chatHours']['hours'][$i][1] ?>
					<? else: ?>
						<?=$this->data['chatHours']['hours'][$i][0] ?>
					<? endif; ?>
                </span>
                <rn:block id="postChatHoursItemHours"/>
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
        <? endfor;?>
        <rn:block id="chatHoursBlockBottom"/>
    </div>
    <?if($this->data['chatHours']['holiday']):?>
        <div id="rn_<?=$this->instanceID;?>_Holiday" class="rn_Holiday">
            <rn:block id="holidayTop"/>
            <?=$this->data['attrs']['label_holiday'];?>
            <rn:block id="holidayBottom"/>
        </div>
    <? endif;?>
    <div id="rn_<?=$this->instanceID;?>_CurrentTime" class="rn_CurrentTime">
        <rn:block id="currentTimeTop"/>
        <?
		$pieces = explode(' ', $this->data['chatHours']['current_time']);
		$pieces[5] = lcfirst($pieces[5]);
		echo $pieces[0]." ".$pieces[1]." ".$pieces[2]." : ".$pieces[3].", ".$pieces[4]." ".$pieces[5]." ".$pieces[6]." ".$pieces[7]; 
		?>
        <rn:block id="currentTimeBottom"/>
    </div>
    <rn:block id="bottom"/>
</div>
