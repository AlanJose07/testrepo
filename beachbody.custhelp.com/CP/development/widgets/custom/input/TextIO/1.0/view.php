<?php /* Originating Release: May 2013 */?>
<? if ($this->data['readOnly']): ?>
    <rn:widget path="output/FieldDisplay" left_justify="true"/>
<? else: ?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<rn:block id="top"/>
<? if ($this->data['attrs']['label_input']): ?>
    <rn:block id="preLabel"/>
    <label for="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" id="rn_<?= $this->instanceID ?>_Label" class="rn_Label">
    <?= $this->data['attrs']['label_input'] ?>
	<?php // Anuj Feb 21, 2014 - CP3 Migration - add additional condition for field to be required ?>
    <? if (($this->data['attrs']['required']) && !($this->data['attrs']['hidden']) && ($this->data['attrs']['editable'])): ?>
        <rn:block id="preRequired"/>
		<rn:block id="required">
        <span class="rn_Required"> <?= \RightNow\Utils\Config::getMessage(FIELD_REQUIRED_MARK_LBL) ?></span><span class="rn_ScreenReaderOnly"> <?= \RightNow\Utils\Config::getMessage(REQUIRED_LBL) ?></span>
		</rn:block>
        <rn:block id="postRequired"/>
    <? endif; ?>
    <? if ($this->data['attrs']['hint']): ?>
        <span class="rn_ScreenReaderOnly"><?= $this->data['attrs']['hint'] ?></span>
    <? endif; ?>
    </label>
    <rn:block id="postLabel"/>
<? endif; ?>
<? if ($this->data['displayType'] === 'Textarea'): ?>
	<?php // Anuj Feb 21, 2014 - CP3 Migration - Display value as text if don't want it to be editable ?>
	<? if (!$this->data['attrs']['editable']): ?>
		<span class="rn_FieldValue"><?= $this->data['value'] ?></span>
	<? endif; ?>
	
	<rn:block id="preInput"/>
	<rn:block id="input">
		<textarea id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" class="rn_TextArea <?= $this->data['js']['inputClass'] ?>" rows="7" cols="60" name="<?= $this->data['inputName'] ?>" <?= $this->outputConstraints(); ?> ><?= $this->data['value'] ?></textarea>
	</rn:block>
	<rn:block id="postInput"/>
	<? if ($this->data['attrs']['hint'] && $this->data['attrs']['always_show_hint']): ?>
		<rn:block id="preHint"/>
		<span class="rn_HintText"><?= $this->data['attrs']['hint'] ?></span>
		<rn:block id="postHint"/>
	<? endif; ?>
<? else: ?>
	<?php // Anuj Feb 21, 2014 - CP3 Migration - Display value as text if don't want it to be editable ?>
	<? if (!$this->data['attrs']['editable']): ?>
		<span class="rn_FieldValue"><?= $this->data['value'] ?></span>
	<? endif; ?>
	
	<rn:block id="preInput"/>
	<rn:block id="input">
		<input type="<?=$this->data['inputType']?>" id="rn_<?=$this->instanceID?>_<?=$this->data['js']['name']?>" name="<?= $this->data['inputName'] ?>" class="rn_<?=$this->data['displayType']?> <?= $this->data['js']['inputClass'] ?>" <?=$this->outputConstraints();?> <?if($this->data['value'] !== null && $this->data['value'] !== '') echo "value='{$this->data['value']}'";?> />
	</rn:block>
	<rn:block id="postInput"/>
	<? if ($this->data['attrs']['hint'] && $this->data['attrs']['always_show_hint']): ?>
		<rn:block id="preHint"/>
		<span class="rn_HintText"><?= $this->data['attrs']['hint'] ?></span>
		<rn:block id="postHint"/>
	<? endif; ?>
	<? if ($this->data['attrs']['require_validation']): ?>
	<div class="rn_TextInputValidate">
		<rn:block id="preValidateLabel"/>
		<label for="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>_Validate" id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>_LabelValidate" class="rn_Label"><?printf($this->data['attrs']['label_validation'], $this->data['attrs']['label_input']) ?>
		<rn:block id="postValidateLabel"/>
		<? if ($this->data['attrs']['required']): ?>
			<rn:block id="preValidateRequired"/>
			<span class="rn_Required"><?= \RightNow\Utils\Config::getMessage(FIELD_REQUIRED_MARK_LBL) ?></span><span class="rn_ScreenReaderOnly"> <?= \RightNow\Utils\Config::getMessage(REQUIRED_LBL) ?></span>
			<rn:block id="postValidateRequired"/>
		<? endif; ?>
		</label>
		<rn:block id="preValidateInput"/>
		<input type="<?= $this->data['inputType'] ?>" id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>_Validate" name="<?= $this->data['inputName'] ?>_Validation" class="rn_<?=$this->data['displayType']?> rn_Validation" <?= $this->outputConstraints(); ?> value="<?= $this->data['value'] ?>"/>
		<rn:block id="postValidateInput"/>
	</div>
	<? endif; ?>
<? endif; ?>
<rn:block id="bottom"/>
</div>
<? endif; ?>