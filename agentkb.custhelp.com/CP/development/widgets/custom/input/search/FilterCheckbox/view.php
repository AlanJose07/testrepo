<?php /* Originating Release: May 2013 */?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <label for="rn_<?=$this->instanceID;?>_Options"><?=$this->data['js']['name'];?></label>
    <rn:block id="preSelect"/>
 <input id="rn_<?=$this->instanceID;?>_Checkbox" class="SearchFilterChecked" type="checkbox" <?=($this->data['js']['defaultValue'] == '1' ? 'checked="checked"' : '');?> value="1" <?=tabIndex($this->data['attrs']['tabindex'], 1);?> />
    <rn:block id="postSelect"/>
    <rn:block id="bottom"/>
</div>
