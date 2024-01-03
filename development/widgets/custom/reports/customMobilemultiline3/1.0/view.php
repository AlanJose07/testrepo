<div id="rn_<?=$this->instanceID;?>" class="rn_MobileMultiline">
  <div id="rn_<?=$this->instanceID;?>_Loading"></div>
  <div id="rn_<?=$this->instanceID;?>_Content">
    <? if(is_array($this->data['reportData']['data']) && count($this->data['reportData']['data'])):?>
    <?
        // first three entries have no headers.  All others do
        // changes to the html here should be repeated in the logic file
        $cols = count($this->data['reportData']['headers']);
        $count = 1;
		$md=0;
        foreach($this->data['reportData']['data'] as $value):?>
    <? /* Sanal -- To show/hide the answer details on clicking the question*/ ?>
    <h2 id="qst_<?=$md?>" style="margin-bottom:3px;" class="rn_Expanded" >
      <div class="rn_Expand">
        <p>
          <?=$value[0];?>
        </p>
      </div>
    </h2>
    <div id="ans_<?=$md?>" class="<?=(($count % 2 === 0) ? 'rn_Even' : 'rn_Odd')?>" style="display:none; padding:7px; margin-top: 10px;">
      <? if($value[1]):?>
      <div id="element2_item<?=$count ?>" class="rn_Element2 gogo_Hide_Show_Answer">
        <? /* =nl2br($value[1]); */ ?>
        <?=$value[1]; ?>
      </div>
      <? endif;?>
      <? if($value[2]):?>
      <div style="display:none;" id="element3_item<?=$count ?>" class="rn_Element3">
        <?=$value[2];?>
      </div>
      <? endif;?>
      <hr />
    </div>
    <input type="hidden" id="get_ans_<?=$md;?>" value="<?=$value[3];?>"/>
    <? /*
            <ol start="<?=$this->data['tableData']['start_num'];?>">
            <li id="rn_JQueryElement<?=$count?>" class="<?=(($count % 2 === 0) ? 'rn_Even' : 'rn_Odd')?>" style="display:none;padding:7px">
                <? if($value[1]):?>
                <span class="rn_Element2"><?=nl2br($value[1]);?></span>
                <? endif;?>
            </li>
            </ol>
			*/ ?>
    <?
        $count++;
		$md++;
        endforeach; ?>
    <? endif;?>
  </div>
</div>
