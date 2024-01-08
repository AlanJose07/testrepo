<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<?if($this->data["attrs"]["name"] != "Update_Acnt.Update_Account_Info.security_code" && $this->data["attrs"]["name"] != "Update_Acnt.Update_Account_Info.apt_suite" && $this->data["attrs"]["name"] != "Update_Acnt.Update_Account_Info.credit_card_number"):?>
	<label><?= $this->data["attrs"]["label"]?><span style="color:red">*</span></label>
	<input type="text" id="rn_<?= $this->instanceID ?>_Text" name="<?= $this->data["attrs"]["name"]?>" value=""/>
<? elseif($this->data["attrs"]["name"] == "Update_Acnt.Update_Account_Info.security_code"): ?>
	<label><?= $this->data["attrs"]["label"]?><span style="color:red">*</span></label>
	<input type="text" id="rn_<?= $this->instanceID ?>_Text" maxlength="4" name="<?= $this->data["attrs"]["name"]?>" value=""/>
<? elseif($this->data["attrs"]["name"] == "Update_Acnt.Update_Account_Info.credit_card_number"): ?>
	<label><?= $this->data["attrs"]["label"]?><span style="color:red">*</span></label>
	<input type="text" id="rn_<?= $this->instanceID ?>_Text" maxlength="16" name="<?= $this->data["attrs"]["name"]?>" value=""/>
<? else: ?>
	<label><?= $this->data["attrs"]["label"]?></label>
	<input type="text" id="rn_<?= $this->instanceID ?>_Text" name="<?= $this->data["attrs"]["name"]?>" value=""/>
<? endif;?>

</div>