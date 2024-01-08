<?php 
//use RightNow\Connect\v1_2 as RNCPHP;
?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_Alert" role="alert" class="rn_ScreenReaderOnly"></div>
    <rn:block id="preLoadingIndicator"/>
    <div id="rn_<?=$this->instanceID;?>_Loading"></div>
    <rn:block id="postLoadingIndicator"/>
    <div id="rn_<?=$this->instanceID;?>_Content" class="rn_Content">
        <rn:block id="topContent"/>
        <? if (is_array($this->data['reportData']['data']) && count($this->data['reportData']['data']) > 0): ?>
        <rn:block id="preResultList"/>
        <? if ($this->data['reportData']['row_num']): ?>
            <ol start="<?=$this->data['reportData']['start_num'];?>">
        <? else: ?>
            <ul>
        <? endif; ?>
        <rn:block id="topResultList"/>
        <? $reportColumns = count($this->data['reportData']['headers']);
		   $ans_hide_id=explode(",",$msg->Value);
           foreach ($this->data['reportData']['data'] as $value): ?>
           <rn:block id="resultListItem">
		<?
		         $msg = RightNow\Connect\v1_2\MessageBase::fetch(1000041);
				 $ans_hide_id=explode(",",$msg->Value);
				 $userguide_id=strip_tags(trim(trim(trim($value[1],"(ID:"),")")));
		         if(!in_array($userguide_id, $ans_hide_id)):    
 
		?>  
		   
            <li>
                <span class="rn_Element1"><?=$value[0];?></span>
                <? if($value[1]): ?>
                <span class="rn_Element2"><?=$value[1];?></span>
                <? endif; ?>
                <span class="rn_Element3"><?=$value[2];?></span>
                <? for ($i = 3; $i < $reportColumns; $i++): ?>
                    <? $header = $this->data['reportData']['headers'][$i]; ?>
                    <? if (!array_key_exists('visible', $header) || $header['visible'] === true): ?>
                    <span class="rn_ElementsHeader"><?=(($this->data['reportData']['headers'][$i]['heading']) ? ($this->data['reportData']['headers'][$i]['heading'] . ': ') : '');?></span>
                    <span class="rn_ElementsData"><?=$value[$i];?></span>
                    <? endif; ?>
                <? endfor; ?>
            </li>
			<? endif; ?>
            </rn:block>
        <? endforeach; ?>
        <rn:block id="bottomResultList"/>
        <? if ($this->data['reportData']['row_num']): ?>
            </ol>
        <? else: ?>
            </ul>
        <? endif; ?>
        <rn:block id="postResultList"/>
        <? endif; ?>
        <rn:block id="bottomContent"/>
    </div>
    <rn:block id="bottom"/>
</div>
