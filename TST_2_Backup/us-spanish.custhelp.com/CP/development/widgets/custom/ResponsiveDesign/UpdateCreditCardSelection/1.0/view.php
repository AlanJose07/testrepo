<?php /* Originating Release: August 2015 */?>
<? if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.exp_month'): ?>
<!--<label>Expiration<span style="color:red">*</span></label>-->
<label>Vencimiento<span style="color:red">*</span></label>
    <rn:block id="preInput"/>
    <select id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" name="<?= $this->data['attrs']['name'] ?>">
			<rn:block id="inputTop"/>
		<? if (!$this->data['hideEmptyOption']): ?>
			<option value="">Month</option>
		<? endif; ?>
		<? if (is_array($this->data['menuItems'])): ?>
			<? foreach ($this->data['menuItems'] as $key => $item): ?>
				<option value="<?= $key ?>"><?= $item ?></option>
			<? endforeach; ?>
		<? endif; ?>
    </select>
	<? endif; ?>	
	
<? if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.exp_year'): ?>
<label></label>
    <rn:block id="preInput"/>
    <select id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" name="<?= $this->data['attrs']['name'] ?>">
			<rn:block id="inputTop"/>
		<? if (!$this->data['hideEmptyOption']): ?>
			<option value="">Year</option>
		<? endif; ?>
		<? if (is_array($this->data['menuItems'])): ?>
			<? foreach ($this->data['menuItems'] as $key => $item): ?>
				<option value="<?= $key ?>"><?= $item ?></option>
			<? endforeach; ?>
		<? endif; ?>
    </select>
	<? endif; ?>
	
	
	<? if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.credit_card_type'): ?>
<!--<label>Credit Card Type<span style="color:red">*</span></label>-->
<label>tipo de tarjeta de crédito<span style="color:red">*</span></label>

    <rn:block id="preInput"/>
    <select id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" name="<?= $this->data['attrs']['name'] ?>">
			<rn:block id="inputTop"/>
		<? if (!$this->data['hideEmptyOption']): ?>
			<option value="">--</option>
		<? endif; ?>
		<? if (is_array($this->data['menuItems'])): ?>
			<? foreach ($this->data['menuItems'] as $key => $item): ?>
				<option value="<?= $key ?>"><?= $item ?></option>
			<? endforeach; ?>
		<? endif; ?>
    </select>
	<? endif; ?>          	