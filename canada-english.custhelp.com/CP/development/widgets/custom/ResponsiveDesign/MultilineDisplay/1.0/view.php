<?php /* Originating Release: August 2017 */?>
<?php
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$exploded_url = explode("/",$url);

$position = array_search("catid",$exploded_url);
$cat_id = $exploded_url[$position+1];

$position = array_search("TLP",$exploded_url);
$tlp = $exploded_url[$position+1];

$count_results = count($this->data['reportData']['data']);

for($i=0;$i<$count_results;$i++)
{
	$this->data['reportData']['data'][$i][2] = strip_tags($this->data['reportData']['data'][$i][2]);
	if($tlp && $tlp != "0")
	{
		//die("DIE HARD 1");
		$this->data['reportData']['data'][$i][2].="/TLP/".$tlp;
	}
	if($cat_id && $cat_id != "0")
	{
		// die("DIE HARD 2");
		$this->data['reportData']['data'][$i][2].="/catid/".$cat_id;
	}
	//$this->data['reportData']['data'][$i][2].="/catid/".$cat_id."/TLP/".$tlp;
	$this->data['reportData']['data'][$i][2] = "<a href='".$this->data['reportData']['data'][$i][2]."'>".$this->data['reportData']['data'][$i][2]."</a>";
}
?>		
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?> most_pop_answers">
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
		<div id="num_comment" class="most-pop"> 
		<rn:condition hide_on_pages="answers/list_generic">
		<h3>Most Popular Answers</h3>
		</rn:condition>
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
                                <div class="rn_Element<?=$i + 1?>"><a href="<?=strip_tags($value[2])?>"><?=$value[$i];?></a></div> 
							<? elseif($i === 1): ?>
								<div class="rn_Element<?=$i + 1?>"><a href="<?=strip_tags($value[2])?>"><?=$value[$i];?></a></div>
							<? elseif($i === 2): ?>
								<div class="rn_Element<?=$i + 1?>"><a href="<?=$value[$i];?>"><?=$value[$i];?></a></div>
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
