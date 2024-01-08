<?php /* Originating Release: August 2017 */?>
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
       
        <rn:block id="topResultList"/>
		<div id="num_comment"> 
		<h3>Most Popular Answers</h3>
		<?php
	/*	echo "<pre>";
		print_r($this->data['reportData']['data']);
		die("qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq");*/
		?>
        <? $reportColumns = count($this->data['reportData']['headers']);
		  
           foreach ($this->data['reportData']['data'] as $value): ?>
            <rn:block id="resultListItem">
            <li>
                <? for ($i = 0; $i < 4; $i++): ?>
                    <? $header = $this->data['reportData']['headers'][$i]; ?>
                    <? if ($this->showColumn($value[$i], $header)):
                        if ($i < 5):
                            if ($i === 0): ?>
                                <div class="rn_Element<?=$i + 1?>"><?=$value[$i];?></div>
							<? elseif($i === 1): ?>
								<div class="rn_Element<?=$i + 1?>"><?=$value[$i];?></div>
							<? elseif($i === 2): ?>
								<div class="rn_Element<?=$i + 1?>"><?=$value[$i];?></div>
                            <? else: ?>
                                <div class="rn_Element<?=$i + 1?>">FAQ:<?=$value[$i];?></div>
                            <? endif; ?>
                       
                        <? endif; ?>
                    <? endif; ?>
                <? endfor; ?>
            </li>
            </rn:block>
        <? endforeach; ?>
		
		</div>
        <rn:block id="bottomResultList"/>
       
        <rn:block id="postResultList"/>
        <? else: ?>
        <rn:block id="noResultListItem"/>
        <? endif; ?>
        <rn:block id="bottomContent"/>
    </div>
    <rn:block id="bottom"/>
</div>
