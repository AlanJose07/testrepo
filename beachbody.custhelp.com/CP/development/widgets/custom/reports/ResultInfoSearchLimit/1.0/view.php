<!--
<rn:block id='ResultInfo-top'>

</rn:block>
-->

<!--
<rn:block id='ResultInfo-suggestions'>

</rn:block>
-->

<!-- CP3 Migration - Limiting search result functionality - Anuj - Mar 26, 14 -->
<rn:block id='ResultInfo-suggestionLink'>
	<?php
	if($this->data['attrs']['max_suggested_searches'] == $i)
		break;
	?>
	<a href="<?=$this->data['js']['linkUrl'].$this->data['suggestionData'][$i].'/suggested/1'.$this->data['appendedParameters'] . \RightNow\Utils\Url::sessionParameter();?>"><?=$this->data['suggestionData'][$i]?></a>&nbsp;
</rn:block>


<!--
<rn:block id='ResultInfo-spelling'>

</rn:block>
-->

<!--
<rn:block id='ResultInfo-noResults'>

</rn:block>
-->

<!--
<rn:block id='ResultInfo-topResults'>

</rn:block>
-->

<!--
<rn:block id='ResultInfo-bottomResults'>

</rn:block>
-->

<!--
<rn:block id='ResultInfo-bottom'>

</rn:block>
-->

