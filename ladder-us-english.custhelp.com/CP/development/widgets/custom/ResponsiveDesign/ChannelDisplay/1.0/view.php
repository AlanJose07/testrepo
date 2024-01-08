<?php /* Originating Release: November 2017 */?>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- ***NOTE:- There are some part of codes which are not using for the current requirement. Since it is copied from the standard selection input view, these codes must be present. Unwanted editing or commenting of these codes may result in the error. Edit these codes if it is needed only. The codes that is requied for the current requirement listed below with proper comments starting with 'The below' and end with 'The above'. ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<style>
a.disable-click{
  /* pointer-events: none; */
}

</style>

 			   <? $actual_link = $_SERVER['REQUEST_URI']; 
			      $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			      $text = trim($text);
			   ?>
			   
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
						<h3 class="recommend-title">Here's how to get help:</h3>	    
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

function recommended_contact_us_channel($key,$value,$id,$selfservicedetails,$display_label_image,$selfservicetitle,$selfserviceicon,$selfservicedes,$email_description,$email_sla)
{
$TLP=explode(".",trim(getUrlParm('TLP')));
$toplevelcategory = trim($TLP[0]);
?>
<? if($key=="1527"):?>  <!-- ask an expert -->
		       
			    <? $label_image=explode("->",$display_label_image['1527']);?>
				<li>
				<a href="javascript:void(0);" class="ask-an-expert active-chat" id="<?= $id?>" onclick="click_tracking('Contact Us - Ask an Expert')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						
				</a>
				</li>
		<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 


		<? if(($key=="1528") and ($selfservicedetails!="null")):?>  <!-- self service form -->
		
				<li>
				<a href="<?= $selfservicedetails?>" class="self-service-form active-chat" id="<?= $id?>" target="_blank" onclick="click_tracking('Contact Us - <?= $selfservicetitle ?>')">   
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_selfservice/<?=$selfserviceicon?>"></div>
						<span><?= $selfservicetitle ?></span>
						<p><?= $selfservicedes ?></p>
						<p class = "self-service-availability">#rn:msg:CUSTOM_MSG_CONTACT_CHANNEL_SS_AVAILABILITY# </p>
						
				</a>
				</li>
		        <div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>" /><label><?= $selfservicetitle ?></label></div>
		
		<? endif;?>

		<? if($key=="1529"):?>  <!-- chat with an agent -->
		
		       <? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			   
			    
			   ?>
		
		       <? $label_image=explode("->",$display_label_image['1529']);?>
			   <? $login_not_url = "/app/chat/prechatsurvey/".$text; ?>	 
			   <? if($toplevelcategory != '1704'): ?> 	 
			   <rn:condition logged_in="false">
				 
			   
			 <!--  <div style="display:inline; position:relative"> -->
			 <li class="chat-desktop">
				<a href="javascript:void(0);" class="chat-email active-chat disable-click" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
							
				</a>
				
				<div id="recommended-continue-as-guest">
				<a href= "javascript:void(0);" class= "continue disable-click prevent_loading_click">Continue as guest</a>
				</div>
				
			 </li>
				
			<!--	</div> -->
				
				<? $login_mobile_url_redirect = "/app/contactus_support_chat/".$text; ?>
				<li class="chat-mobile">
				<a href="<?= $login_mobile_url_redirect ?>" class="chat-email active-chat disable-click" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
								
				</a>
				</li>
				<rn:condition_else/>
				 
			  
			   <li>
			   <a href="<?= $login_not_url ?>" class="chat-email active-chat disable-click  
				" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
								
				</a>
				</li>
				</rn:condition>
				
				<? else: ?>
				
				<rn:condition logged_in="false">
				 
			   
			 <!--  <div style="display:inline; position:relative"> -->
			 <li>
				<a href="javascript:void(0);" class="chat-email active-chat disable-click" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
							
				</a>
				
			 </li>
				
				<rn:condition_else/>
			   <li>
			   <a href="<?= $login_not_url ?>" class="chat-email active-chat disable-click  
				" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
								
				</a>
				</li>
				</rn:condition>
				
				<? endif; ?>
				<div class="hide_radio"><input type="radio" name="channel" class="preventclick" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		        
		<? endif;?> 

		<? if($key=="1530"):?>  <!-- email us-->
		
		        <? $label_image=explode("->",$display_label_image['1530']);?>
				<li>
				<a href="javascript:void(0);" class="chat-email active-chat" id="<?= $id?>" onclick="click_tracking('Contact Us - Email')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<p class="self-service-availability"><?= $email_description ?></p>
						<p><?= $email_sla ?></p>
						
				</a>
				</li>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1531"):?>  <!-- call us-->
		
		        <? $label_image=explode("->",$display_label_image['1531']);?>
				<li>
				<a href="javascript:void(0);" class="call-us active-chat disable-call-us" id="<?= $id?>" onclick="click_tracking('Contact Us - Call Us')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/CustomPhoneHours" label_chat_hours =" "/>
						
				</a>
				</li>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>

		<? if($key=="1532"):?>  <!--facebook-->
		
		        <? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			   
			    
			   ?>
 <? $label_image=explode("->",$display_label_image['1532']);?>
				 
			   <? $login_not_url = "/app/chat/facebooksurvey/".$text;
			    
			   ?> 
			   <rn:condition logged_in="false">
				 
			   
			 <!--  <div style="display:inline; position:relative"> -->
			 <li>
				<a href="javascript:void(0);" class="facebook active-chat disable-click-fb" id="<?= $id?>" onclick="click_tracking('Contact Us - Facebook')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/FacebookChatHours" label_chat_hours =" "/>
							
				</a>
				
				
			 </li>
				
			<!--	</div> -->
				
				<rn:condition_else/>
				 
			   <? $contact = get_instance()->model('Contact')->get()->result;
				$contact_country = $contact->Address->Country->ID; 
				
				if($contact_country != '23' && $contact_country !='7'):
				?>
			   <li>
				<a href="<?= $login_not_url ?>" class="facebook active-chat disable-click-fb" id="<?= $id?>" onclick="click_tracking('Contact Us - Facebook')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/FacebookChatHours" label_chat_hours =" "/>
							
				</a>
				</li>
				<? endif; ?>
				</rn:condition>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		
		<? endif;?>
		
		<? if($key=="1621"):?>  <!--SMS-->
		
		        <? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			   
			    
			   ?>
 <? $label_image=explode("->",$display_label_image['1621']);?>
				 
				 
			   <rn:condition logged_in="false">
				 
			   
			 <!--  <div style="display:inline; position:relative"> -->
			 <li>
				<a href="javascript:void(0);" class="sms active-chat disable-click-sms" id="<?= $id?>" onclick="click_tracking('Contact Us - SMS')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/SMSChatHours" label_chat_hours =" " page=1/>
							
				</a>
				
			 </li>
				
			<!--	</div> -->
				<rn:condition_else/>
				 
			   <? $login_not_url = "/app/smssurvey/".$text;
			    
			   ?>
			   <li>
				<a href="<?= $login_not_url ?>" class="sms active-chat disable-click-sms" id="<?= $id?>" onclick="click_tracking('Contact Us - SMS')">
				<div id="recommended-title-div">Recommended</div>
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/SMSChatHours" label_chat_hours =" " page=1/>
							
				</a>
				</li>
				</rn:condition>
				<div class="hide_radio"><input type="radio" name="channel" class="preventclick" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		
		<? endif;?>	
			
		


<?
}

?>






<?

function display_contact_us_channel($key,$value,$id,$selfservicedetails,$display_label_image,$selfservicetitle,$selfserviceicon,$selfservicedes,$email_description,$email_sla)
{
$TLP=explode(".",trim(getUrlParm('TLP')));
$toplevelcategory = trim($TLP[0]);
?>

<? if($key=="1527"):?>  <!-- ask an expert -->
		
				<? $label_image=explode("->",$display_label_image['1527']);?>
				<li>
				<a href="javascript:void(0);" class="ask-an-expert" id="<?= $id?>" onclick="click_tracking('Contact Us - Ask an Expert')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						
				</a>
				</li>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 


		<? if(($key=="1528") and ($selfservicedetails!="null")):?>  <!-- self service form -->
		
				<li>
				<a href="<?= $selfservicedetails?>" class="self-service-form" id="<?= $id?>" target="_blank" onclick="click_tracking('Contact Us - <?= $selfservicetitle?>')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_selfservice/<?=$selfserviceicon?>"></div>
						<span><?= $selfservicetitle?></span>
						<p><?= $selfservicedes ?></p>
						<p class = "self-service-availability">#rn:msg:CUSTOM_MSG_CONTACT_CHANNEL_SS_AVAILABILITY# </p>
						
				</a>
		        </li>
		        <div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>" /><label><?= $selfservicetitle ?></label></div>
		
		<? endif;?>

		<? if($key=="1529"):?>  <!-- chat with an agent -->
		
		       <? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			    
			   ?>
		
				<? $label_image=explode("->",$display_label_image['1529']);?>
				<? $login_not_url = "/app/chat/prechatsurvey/".$text; ?>
				<? if($toplevelcategory != '1704'): ?> 
				<rn:condition logged_in="false">
				<!-- <div style="display:inline; position:relative"> -->
				<li class="chat-desktop">
					<a href="javascript:void(0)" class="chat-email disable-click disable-a-click-for-span" id="<?=
					 $id?>" onclick="click_tracking('Contact Us - Chat')">
							
							<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
			
							<span><?= $label_image[0] ?></span>
							
							<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
							
							
							
					</a>
					
					<div class="continue-as-guest-desktop disable-click">
					<a href= "javascript:void(0);" class= "continue prevent_loading_click">Continue as guest</a>
					</div>
					
				 </li>
							
				<!-- </div> -->
				   <? $login_mobile_url_redirect = "/app/contactus_support_chat/".$text; ?>
				    <li class="chat-mobile">
					<a href="<?= $login_mobile_url_redirect ?>" class="chat-email disable-click" id="
					 <?= $id?>" onclick="click_tracking('Contact Us - Chat')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
		
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
						<? //<div class="continue-as-guest-mobile disable-click">
						//<span  class="continue" >Continue as guest mobile</span> 
						 // </div> ?>
						
					</a>
			        </li>
			   
			   	
			   <rn:condition_else/>
			    <li>
				<a href="<?= $login_not_url ?>" class="chat-email disable-click" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
		
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
						
						
				</a>
				</li>
				</rn:condition>
				 
				
				<? else: ?>
				
				<rn:condition logged_in="false">
				<!-- <div style="display:inline; position:relative"> -->
				<li>
					<a href="javascript:void(0)" class="chat-email disable-click disable-a-click-for-span" id="<?=
					 $id?>" onclick="click_tracking('Contact Us - Chat')">
							
							<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
			
							<span><?= $label_image[0] ?></span>
							
							<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
							
							
							
					</a>
				 </li>
			   
			   	
			   <rn:condition_else/>
			    <li>
				<a href="<?= $login_not_url ?>" class="chat-email disable-click" id="<?= $id?>" onclick="click_tracking('Contact Us - Chat')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
		
						<span><?= $label_image[0] ?></span>
						
						<rn:widget path="custom/ResponsiveDesign/CustomChatHours" label_chat_hours =" "/>
						
						
				</a>
				</li>
				</rn:condition>
				
				<? endif; ?>
				
				<div class="hide_radio"><input type="radio" name="channel" class="preventclick" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1530"):?>  <!-- email us-->
		
				<? $label_image=explode("->",$display_label_image['1530']);?>
				<li>
				<a href="javascript:void(0);" class="chat-email" id="<?= $id?>" onclick="click_tracking('Contact Us - Email')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<p class="self-service-availability"><?= $email_description ?></p>
						<p><?= $email_sla ?></p>
						
				</a>
				</li>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?> 

		<? if($key=="1531"):?>  <!-- call us-->
		
				<? $label_image=explode("->",$display_label_image['1531']);?>
				<li>
				<a href="javascript:void(0);" class="call-us disable-call-us" id="<?= $id?>" onclick="click_tracking('Contact Us - Call Us')">
						
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/CustomPhoneHours" label_chat_hours =" "/>
						
				</a>
				</li>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>

		<? if($key=="1532"):?>  <!--facebook-->
		
				<? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			    
			   ?>
		
				<? $label_image=explode("->",$display_label_image['1532']);?>
				<? 
			//https://ohsqa3.beachbody.com/oamfed/idp/initiatesso?providerid=OCS-QA3 ?>
				<? 
			   
			     $login_not_url = "/app/chat/facebooksurvey/".$text;
			    
			    ?>
				<rn:condition logged_in="false">
				<!-- <div style="display:inline; position:relative"> -->
				<li>
					 <a href="javascript:void(0);" class="facebook disable-click-fb" id="<?= $id?>" onclick="click_tracking('Contact Us - Facebook')">     
							
							<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/FacebookChatHours" label_chat_hours =" "/>
					</a>
				 </li>
			   <rn:condition_else/>
			   
			   <? $contact = get_instance()->model('Contact')->get()->result;
				$contact_country = $contact->Address->Country->ID; 
				
				if($contact_country != '23' && $contact_country !='7'):
				?>
			    <li>
				<a href="<?= $login_not_url ?>" class="facebook disable-click-fb" id="<?= $id?>" onclick="click_tracking('Contact Us - Facebook')">  
				
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/FacebookChatHours" label_chat_hours =" "/>
						
						
				</a>
				</li>
				<? endif; ?>
				</rn:condition>
				<div class="hide_radio"><input type="radio" name="channel" value="<?=$key ?>"/><label><?= $value ?></label></div>
		
		<? endif;?>
		
		<? if($key=="1621"):?>  <!-- SMS-->
		
				<? $actual_link = $_SERVER['REQUEST_URI']; ?>
			   
			   <? $text = str_replace('/app/contactus_support/', ' ', $actual_link);
			   
			   $text = trim($text);
			    
			   ?>
		
				<? $label_image=explode("->",$display_label_image['1621']);?>
				<? 
			//https://ohsqa3.beachbody.com/oamfed/idp/initiatesso?providerid=OCS-QA3 ?>
			
				<rn:condition logged_in="false">
				<!-- <div style="display:inline; position:relative"> -->
				<li>
					 <a href="javascript:void(0);" class="sms disable-click-sms" id="<?= $id?>" onclick="click_tracking('Contact Us - SMS')">     
							
							<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/SMSChatHours" label_chat_hours =" " page=1/>
							
							
							
					</a>
					
					<!-- <div class="continue-as-guest-desktop disable-click-sms">
					<a href= "javascript:void(0);" class= "continue_sms">Continue as guest</a>
					</div> -->
					
				 </li>
							
				<!-- </div> -->
				  
				 
			   <rn:condition_else/>
			   
			   <? 
			   
			   $login_not_url = "/app/smssurvey/".$text;
			    
			   ?>
			    <li>
				<a href="<?= $login_not_url ?>" class="sms disable-click-sms" id="<?= $id?>" onclick="click_tracking('Contact Us - SMS')">  
				
						<div class="chtrec-icon"><img src="/euf/assets/themes/responsive/images/contactus_channel_image/<?=$label_image[1]?>"></div>
						<span><?= $label_image[0] ?></span>
						<rn:widget path="custom/ResponsiveDesign/SMSChatHours" label_chat_hours =" " page=1/>
						
						
				</a>
				</li>
				</rn:condition>
				
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
<!-- <ul class="boxes-3 rec-boxes"> -->
<ul class="recommend">


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                   The below code will display the recommended channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--SLA-->
<? $email_description="null"; ?>
<? if($this->data['js']['email_description']!="null" ):?>
<? $email_description=$this->data['js']['email_description'];?>
<? endif;?>

<? $email_sla="null"; ?>
<? if($this->data['js']['email_sla']!="null" ):?>
<? $email_sla=$this->data['js']['email_sla'];?>
<? endif;?>
<!--SLA-->
<? if($this->data['js']['self_service_form_link_path']!="null" ):?>
<? $selfservicedetails=$this->data['js']['self_service_form_link_path'];
   $selfservicetitle=$this->data['js']['self_service_form_title'];
   $selfserviceicon=$this->data['js']['self_service_form_icon'];
   $selfservicedes=$this->data['js']['self_service_form_description'];
?>
<? else:?>
<? $selfservicedetails="null";
   $selfservicetitle="null";
   $selfserviceicon="null";
   $selfservicedes="null";
?>
<? endif;?>

<? $display_label_image=$this->data['display_label_image'];?>

<? if(count($this->data['recommendchannel'])>0):?>

<? foreach($this->data['recommendchannel'] as $key=>$value){?>
		
<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_0";?>

<? recommended_contact_us_channel($key,$value,$id,$selfservicedetails,$display_label_image,$selfservicetitle,$selfserviceicon,$selfservicedes,$email_description,$email_sla); ?>
				      
<? $k=$k+1;?>
						
<? }?>

<? endif;?><!--end of if when recommended channel count is greater than 0-->
			 
			 
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                 The above code will display the recommended channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->			
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                 The below code will display the display channel flow.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<? if(count($this->data['displaychannel'])>0):?>

<? foreach($this->data['displaychannel'] as $key=>$value){?> 

<? if(count($this->data['recommendchannel'])==0 and $j==0):?> 

<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_0";?>

<? recommended_contact_us_channel($key,$value,$id,$selfservicedetails,$display_label_image,$selfservicetitle,$selfserviceicon,$selfservicedes,$email_description,$email_sla); ?>

<? $j++;?>
<? $k=$k+1;?>

<? endif;?><!-- end of if when recommendchannel count equal to 0 and $j==0-->
				
<? $id = "rn_{$this->instanceID}_{$this->data['js']['name']}_$k";?>

<? display_contact_us_channel($key,$value,$id,$selfservicedetails,$display_label_image,$selfservicetitle,$selfserviceicon,$selfservicedes,$email_description,$email_sla); ?>

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



<script>
/*
var list = document.getElementsByClassName("continue");
for (var i = 0; i < list.length; i++) {
    list[i].addEventListener("click", function(e) {
	

	e.preventDefault();
	
	var guest_url = "<?php echo $text; ?>";
	window.location = "/app/chat/prechatsurvey/" + guest_url;

	
  });
}*/

</script>



