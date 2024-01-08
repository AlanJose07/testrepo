<!--
<rn:block id='TextInput-top'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preLabel'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preRequired'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postRequired'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postLabel'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preInput'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postInput'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preHint'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postHint'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preInput'>

</rn:block>
-->

<!-- Anuj Feb 18, 2014 - Adding a loading icon and a hidden div for message required for Ajax request -->
<rn:block id='TextInput-postInput'>

	<? if($this->data['attrs']['loading_icon_path']):?>
		<img id="rn_<?=$this->instanceID;?>_LoadingIcon" class="rn_Hidden" alt="<?=\RightNow\Utils\Config::getMessage(LOADING_LBL)?>" src="<?=$this->data['attrs']['loading_icon_path'];?>" />
	<? endif;?>
	
	<div id="rn_<?=$this->instanceID;?>_HiddenBlock"></div>

</rn:block>

<!--
<rn:block id='TextInput-preHint'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postHint'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preValidateLabel'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postValidateLabel'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preValidateRequired'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postValidateRequired'>

</rn:block>
-->

<!--
<rn:block id='TextInput-preValidateInput'>

</rn:block>
-->

<!--
<rn:block id='TextInput-postValidateInput'>

</rn:block>
-->

<!--
<rn:block id='TextInput-bottom'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-top'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-label'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-value'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-bottom'>

</rn:block>
-->

