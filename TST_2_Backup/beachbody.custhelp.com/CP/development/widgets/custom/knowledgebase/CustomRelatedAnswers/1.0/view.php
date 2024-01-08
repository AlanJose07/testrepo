<?php /* Originating Release: May 2013 */?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
<rn:block id="top"/>
<?if($this->data['attrs']['label_title']):?>
    <rn:block id="title">
    <h2><?=$this->data['attrs']['label_title'];?></h2>
    </rn:block>
<?endif;?>
    <rn:block id="preList"/>
    <ul>
    <? foreach($this->data['relatedAnswers'] as $answer):
	   $url_string =  urlencode($answer->Title);
        $url_string = str_replace("+","-",$url_string);
        $url_string = strtolower($url_string);
        $url_string = "/~/".$url_string;
	?>
        <rn:block id="listItem">
        <li><a href="<?=$this->data['attrs']['url'].'/a_id/'.$answer->ID.$url_string.$this->data['appendedParameters'];?>" target="<?=$this->data['attrs']['target'];?>"> <?=$answer->Title;?></a></li>
        </rn:block>
    <? endforeach;?>
    </ul>
    <rn:block id="postList"/>
<rn:block id="bottom"/>
</div>
