<? /* Overriding KeywordText's view */ ?>
<?php /* Originating Release: November 2017 */?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <label for="rn_<?=$this->instanceID;?>_Text"><?=$this->data['attrs']['label_text'];?></label>
    <rn:block id="preInput"/>
    <input placeholder="<?=$this->data['attrs']['label_placeholder'];?>" id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" data-hj-whitelist maxlength="255" value="<?=$this->data['js']['initialValue'];?>"/>
    <rn:block id="postInput"/>
    <rn:block id="bottom"/>
</div>
