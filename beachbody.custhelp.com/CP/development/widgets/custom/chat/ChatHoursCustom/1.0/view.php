<?php /* Originating Release: May 2013 */?>
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
                
                
                
                Monday - Friday:
                <rn:block id="postChatHoursItemPrefix"/>
                <rn:block id="preChatHoursItemHours"/>
                6 AM to 6 PM, Pacific Time
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
        <?=$this->data['chatHours']['current_time'];?>
        <rn:block id="currentTimeBottom"/>
    </div>
    <rn:block id="bottom"/>
</div>
