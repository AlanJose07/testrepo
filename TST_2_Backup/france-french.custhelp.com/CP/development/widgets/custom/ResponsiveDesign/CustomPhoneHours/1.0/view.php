<?php /* Originating Release: November 2017 */?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_HoursLabel" class="rn_HoursLabel">
        <rn:block id="chatHoursLabelTop"/>
        <?=$this->data['attrs']['label_chat_hours'];?>
        <rn:block id="chatHoursLabelBottom"/>
    </div>
    <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
        <rn:block id="chatHoursBlockTop"/>
		
	<!---------------------------------------------------------------------------------------------------------------------------
		   The below code is used for the view of Available and currently closed text in call us tile depends on phone hours
    ---------------------------------------------------------------------------------------------------------------------------->  	
					<? if($this->data['js']['checkphone']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?> 
						<span class="ChatClosed"> <?= $this->data['js']['closed'] ?> </span>
					<? endif; ?>
	<!---------------------------------------------------------------------------------------------------------------------------
		   The above code is used for the view of Available and currently closed text in call us tile depends on phone hours
	----------------------------------------------------------------------------------------------------------------------------> 				
				
       
            <rn:block id="preChatHoursItem"/>
            <div>
                <rn:block id="chatHoursItemTop"/>
                <rn:block id="preChatHoursItemPrefix"/>
                <span id="rn_<?=$this->instanceID;?>_HoursPrefix_0" class="rn_HoursPrefix">
	<!---------------------------------------------------------------------------------------------------------------------------
		   The below code is used for the view of BB Live Category in the call us tile
	---------------------------------------------------------------------------------------------------------------------------->  
				<? if($this->data['js']['phonehourview']==1706): ?> 
				      <? if($this->data['js']['checkphone']==1): ?>    <!--if it is within the call hours -->
						<?="9h - 17h Lundi - Vendredi" ?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
				</span>		
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?>     <!--if it is not within the call hours -->
						<?="Ouvert: 9h - 17h Lundi - Vendredi" ?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
				</span>			
					<? endif; ?>
	<!---------------------------------------------------------------------------------------------------------------------------
		   The above code is used for the view of BB Live Category in the call us tile
	----------------------------------------------------------------------------------------------------------------------------> 


	<!---------------------------------------------------------------------------------------------------------------------------
		       The below code is used for the view of all other category except BB Live Category in the call us tile
	---------------------------------------------------------------------------------------------------------------------------->  			
				<? else: ?>	
					<? if($this->data['js']['topcat']=="3784"): ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
						<?="7h - 16h Lundi - Vendredi" ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
						</span>
													
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?> 
						<?="Ouvert: 7h - 16h Lundi - Vendredi" ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
						</span>
					<? endif; ?>
				<? else: ?>
					 <? if($this->data['js']['checkphone']==1): ?> 
						<?="9h - 17h Lundi - Vendredi" ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
						</span>
													
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?> 
						<?="Ouvert: 9h - 17h Lundi - Vendredi" ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Samedi et Dimanche: fermé" ?>
						</span>
					<? endif; ?>

				<?endif; ?>	
				<?endif; ?>		
				
	<!---------------------------------------------------------------------------------------------------------------------------
		       The above code is used for the view of all other category except BB Live Category in the call us tile
	----------------------------------------------------------------------------------------------------------------------------> 				
						
           
				</span>
                <rn:block id="postChatHoursItemPrefix"/>
               
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
   
        <rn:block id="chatHoursBlockBottom"/>
    </div>
   
    
    <rn:block id="bottom"/>
</div>
