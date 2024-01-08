<? /* Overriding FormSubmit's view */ ?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<button type="button" class="btn btn-primary" name="form3_submitMain" id="rn_<?=$this->instanceID?>_Button">Submit</button>
<img id="LoadingIconMain" class="rn_Hidden" alt="<?= \RightNow\Utils\Config::getMessage(LOADING_LBL) ?>" src="<?= $this->data['attrs']['loading_icon_path'] ?>"/>
</div>