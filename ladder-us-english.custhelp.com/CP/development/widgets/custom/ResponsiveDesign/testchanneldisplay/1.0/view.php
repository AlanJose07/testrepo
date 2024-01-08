<?php /* Originating Release: November 2017 */?>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- ***NOTE:- There are some part of codes which are not using for the current requirement. Since it is copied from the standard selection input view, these codes must be present. Unwanted editing or commenting of these codes may result in the error. Edit these codes if it is needed only. The codes that is requied for the current requirement listed below with proper comments starting with 'The below' and end with 'The above'. ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<? if ($this->data['readOnly']): ?>
    <rn:block id="preReadOnlyField"/>
    <rn:widget path="output/FieldDisplay" label="#rn:php:$this->data['attrs']['label_input']#" left_justify="true" sub_id="readOnlyField"/>
    <rn:block id="postReadOnlyField"/>
<? else: ?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
<? if ($this->data['displayType'] !== 'Radio'): ?>
    <div id="rn_<?= $this->instanceID ?>_LabelContainer">
        <rn:block id="preLabel"/>
        <label for="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" id="rn_<?= $this->instanceID ?>_Label" class="rn_Label"><?= $this->data['attrs']['label_input'] ?>
        <? if ($this->data['attrs']['label_input'] && $this->data['attrs']['required']): ?>
            <rn:block id="preRequired"/>
                <?= $this->render('Partials.Forms.RequiredLabel') ?>
            <rn:block id="postRequired"/>
        <? endif; ?>
        <? if ($this->data['attrs']['hint']): ?>
            <span class="rn_ScreenReaderOnly"><?= $this->data['attrs']['hint'] ?></span>
        <? endif; ?>
        </label>
        <rn:block id="postLabel"/>
    </div>
<? endif; ?>
<? if ($this->data['displayType'] === 'Select'): ?>
    <rn:block id="preInput"/>
    <select id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" name="<?= $this->data['inputName'] ?>">
        <rn:block id="inputTop"/>
    <? if (!$this->data['hideEmptyOption']): ?>
        <option value="">--</option>
    <? endif; ?>
    <? if (is_array($this->data['menuItems'])): ?>
        <? foreach ($this->data['menuItems'] as $key => $item): ?>
            <option value="<?= $key ?>" <?= $this->outputSelected($key) ?>><?=\RightNow\Utils\Text::escapeHtml($item, false);?></option>
        <? endforeach; ?>
    <? endif; ?>
        <rn:block id="inputBottom"/>
    </select>
    <rn:block id="postInput"/>
    <? if ($this->data['attrs']['hint'] && $this->data['attrs']['always_show_hint']): ?>
        <rn:block id="preHint"/>
        <span id="rn_<?= $this->instanceID ?>_Hint" class="rn_HintText"><?= $this->data['attrs']['hint'] ?></span>
        <rn:block id="postHint"/>
    <? endif; ?>
<? else: ?>
    <? if ($this->data['displayType'] === 'Checkbox'): ?>
        <rn:block id="preInput"/>
        <input type="checkbox" id="rn_<?= $this->instanceID ?>_<?= $this->data['js']['name'] ?>" name="<?= $this->data['inputName'] ?>" <?= $this->outputChecked(1) ?> value="1"/>
        <rn:block id="postInput"/>
        <? if ($this->data['attrs']['hint'] && $this->data['attrs']['always_show_hint']): ?>
            <rn:block id="preHint"/>
            <span id="rn_<?= $this->instanceID ?>_Hint" class="rn_HintText"><?= $this->data['attrs']['hint'] ?></span>
            <rn:block id="postHint"/>
        <? endif; ?>
    <? else: ?>
        <fieldset>
            <legend id="rn_<?= $this->instanceID ?>_Label" class="rn_Label">
                <rn:block id="preLabel"/>
				
												<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The below code will display the name of the recommended channel in the contactus_support page ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
						<?
						if($this->data['no_channel_display_text']=="null")
                        {
						?>
						<h3 class="recommend-title">Here's the best way to contact us:</h3>	   
						<?
						}
						?>						<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The above code will display the name of the recommended channel in the contactus_support page ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                
				
				<? if ($this->data['attrs']['label_input'] && $this->data['attrs']['required']): ?>
                    <rn:block id="preRequired"/>
                        <?= $this->render('Partials.Forms.RequiredLabel') ?>
                    <rn:block id="postRequired"/>
                <? endif; ?>
                <rn:block id="postLabel"/>
            </legend>
        <rn:block id="preInput"/>
            <rn:block id="preRadioInput"/>
			
			
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*The below codes shows both the recommended channel and display channel
*As per the current flow there must be one recommended channel and the display channel is optional.
*This code will change the radio buttons view into the clickable tile formats and one of the tile is default selected or checked for the selected category or subcategory from the contactus flow.

** The recommended channel flow :-
******The recommended channel will always selected one or checked one.
******Sometimes the recommended channel can be self service form. As per the requirement by clicking on the selfservice form tile will directly take to the self service form.

** The display channel flow :-
******As per the current requirement there should be a recommend channel so it will be the default checked one. But in future if they do not have any recommend channel only the display channel, then one of the display channel will be checked.
******Sometimes the display channel can be self service form. As per the requirement by clicking on the selfservice form tile will directly take to the self service form. ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->			
			
			

<?

function recommended_contact_us_channel($key,$value,$id,$selfservicedetails)
{
?>

<? if($key=="1527"):?>  <!-- ask an expert -->
		
				<a href="javascript:void(0);" class="ask-an-expert active-chat" id="<?= $id?>">
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/askexpert.jpg"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
		<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 


		<? if(($key=="1528") and ($selfservicedetails!="null")):?>  <!-- self service form -->
		
				<? $selfservicedetails=explode("->",$selfservicedetails);?>
				
				<a href="javascript:void(0);" class="self-service-form active-chat" id="<?= $id?>" >   
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_selfservice/<?=$selfservicedetails[3]?>"></div>
						<span><?= $selfservicedetails[0] ?></span>
						<p><?= $selfservicedetails[2] ?></p>
						</li>
				</a>
		        <div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>" /><label><?= $selfservicedetails[0] ?></label></div>
		
		<? endif;?>

		<? if($key=="1529"):?>  <!-- chat with an agent -->
		
				<a href="javascript:void(0);" class="chat-email active-chat" id="<?= $id?>" >
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/chat-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1530"):?>  <!-- email us-->
		
				<a href="javascript:void(0);" class="chat-email active-chat" id="<?= $id?>" >
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/mail.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1531"):?>  <!-- call us-->
		
				<a href="javascript:void(0);" class="call-us active-chat" id="<?= $id?>" >
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/call-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>

		<? if($key=="1532"):?>  <!--facebook-->
		
				<a href="javascript:void(0);" class="facebook active-chat" id="<?= $id?>" >
				<div id="recommended-title-div">Recommended</div>
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/messenger-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>
			
		


<?
}

?>






<?

function display_contact_us_channel($key,$value,$id,$selfservicedetails)
{
?>

<? if($key=="1527"):?>  <!-- ask an expert -->
		
				
				<a href="javascript:void(0);" class="ask-an-expert" id="<?= $id?>" >
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/askexpert.jpg"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 


		<? if(($key=="1528") and ($selfservicedetails!="null")):?>  <!-- self service form -->
		
				<? $selfservicedetails=explode("->",$selfservicedetails);?>
				
				<a href="javascript:void(0);" class="self-service-form" id="<?= $id?>">
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_selfservice/<?=$selfservicedetails[3]?>"></div>
						<span><?= $selfservicedetails[0] ?></span>
						<p><?= $selfservicedetails[2] ?></p>
						</li>
				</a>
		
		        <div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>" /><label><?= $selfservicedetails[0] ?></label></div>
		
		<? endif;?>

		<? if($key=="1529"):?>  <!-- chat with an agent -->
		
				
				<a href="javascript:void(0);" class="chat-email" id="<?= $id?>" >
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/chat-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1530"):?>  <!-- email us-->
		
				
				<a href="javascript:void(0);" class="chat-email" id="<?= $id?>" >
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/mail.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1531"):?>  <!-- call us-->
		
				
				<a href="javascript:void(0);" class="call-us" id="<?= $id?>" >
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/call-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>

		<? if($key=="1532"):?>  <!--facebook-->
		
				
				<a href="javascript:void(0);" class="facebook" id="<?= $id?>" >
						<li>
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/messenger-new.png"></div>
						<span><?= $value ?></span>
						</li>
				</a>
				
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>
			
		


<?
}

?>





			
<? $j=0;?>
<? $k=0;?>

<section>
<div class="container">
<div class="row">
<div class="contact-us">
<div class="chat-reccomend">
<div class="col-md-12">
<ul class="boxes-3 rec-boxes">


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                   The below code will display the recommended channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<? if($this->data['js']['self_service_form_link_path']!="null" ):?>
<? $selfservicedetails=$this->data['js']['self_service_form_link_path'];?>
<? else:?>
<? $selfservicedetails="null";?>
<? endif;?>

<? if(count($this->data['recommendchannel'])>0):?>

<? foreach($this->data['recommendchannel'] as $key=>$value){?>
		
<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_0";?>

<? recommended_contact_us_channel($key,$value,$id,$selfservicedetails); ?>
				      
<? $k=$k+1;?>
						
<? }?>

<? endif;?><!--end of if when recommended channel count is greater than 0-->
			 
			 
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                 The above code will display the recommended channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->			
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                 The below code will display the display channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<? if(count($this->data['displaychannel'])>0):?>

<? foreach($this->data['displaychannel'] as $key=>$value){?> 

<? if(count($this->data['recommendchannel'])==0 and $j==0):?> 

<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_0";?>

<? recommended_contact_us_channel($key,$value,$id,$selfservicedetails); ?>

<? $j++;?>
<? $k=$k+1;?>

<? endif;?><!-- end of if when recommendchannel count equal to 0 and $j==0-->
				
<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_$k";?>

<? display_contact_us_channel($key,$value,$id,$selfservicedetails); ?>

<? $k=$k+1;?>
				
<? }?><!-- end of foreach-->

<? endif;?><!--end of if when display channel count is greater than 0-->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                 The above code will display the display channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
</ul>
</div>
</div>
</div>
</div>
</div>
</section>

<div id="no-channel-display-text">
<? 
if($this->data['no_channel_display_text']!="null")
{
print_r($this->data['no_channel_display_text']);
}
?>
</div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The above codes information completely explained at the top that is starting of these codes.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->






<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                                     by jithin jose  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


            <rn:block id="postRadioInput"/>
            <rn:block id="preRadioLabel"/>
            <label for="<?= $id ?>">
            <?= $this->data['radioLabel'][$i] ?>
            <? if ($this->data['attrs']['hint'] && $i === 1): ?>
                <span class="rn_ScreenReaderOnly"><?= $this->data['attrs']['hint'] ?></span>
            <? endif; ?>
            </label>
            <rn:block id="postRadioLabel"/>
        
        <rn:block id="postInput"/>
        <? if ($this->data['attrs']['hint'] && $this->data['attrs']['always_show_hint']): ?>
            <rn:block id="preHint"/>
            <span id="rn_<?= $this->instanceID ?>_Hint"  class="rn_HintText"><?= $this->data['attrs']['hint'] ?></span>
            <rn:block id="postHint"/>
        <? endif; ?>
        </fieldset>
    <?endif; ?>
<? endif; ?>
<rn:block id="bottom"/>
</div>
<? endif; ?>
