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
		
		
					<? if($this->data['js']['checkphone']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?> 
						<span class="ChatClosed"> <?= $this->data['js']['closed'] ?> </span>
					<? endif; ?>
					
				
       
            <rn:block id="preChatHoursItem"/>
            <div>
                <rn:block id="chatHoursItemTop"/>
                <rn:block id="preChatHoursItemPrefix"/>
				
				<!-- The below code is used to view the corresponding phone hours in the call us tile
				     The below two <span> is used to display the phone hours in UK in two line because the
                     standard style is in such a way. The first span below display the first line and second span
					 display the 2nd line------------------------------------------------------------------------
					 -------------------------Lijo George-------------------------------------------------------->
                <span id="rn_<?=$this->instanceID;?>_HoursPrefix_0" class="rn_HoursPrefix">
				
				<!--The If is used for the view in BB Live Instructor category and else part is for the view of
					all the other categories except BB live because BB live is having different Phone hour operation
				   ------------------------------------------------------------------------------------------------>
				
				 <? if($this->data['js']['phonehourview']==1706): ?>
				       <? if($this->data['js']['checkphone']==1): ?> 
					    <?="Monday: 11:00am-11:00pm GMT" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="Open: Monday: 11:00am-11:00pm GMT" ?>
					  <? endif; ?>
				 <? else: ?>	
				 	<? if($this->data['js']['topcat']=="3784"): ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
					    <?="7:00am-4:00pm GMT" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="Open: 7:00am-4:00pm GMT" ?>
					  <? endif; ?>
					
					<? else: ?>
						<? if($this->data['js']['checkphone']==1): ?> 
						    <?="8:00am-8:00pm GMT M-F" ?>
						  <? endif; ?>	
						
						  <? if($this->data['js']['checkphone']==2): ?> 
							<?="Open: 8:00am-8:00pm GMT M-F" ?>
						<? endif; ?>
					<? endif; ?> 
				 <? endif; ?>	  
					
						
           
				</span>
			 </div>
			 <div>
				 <span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">
				   <? if($this->data['js']['phonehourview']==1706): ?>
				      <? if($this->data['js']['checkphone']==1): ?> 
					    <?="11:00pm-5:00am, 11:00am-11:00pm GMT T-S" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="11:00pm-5:00am, 11:00am-11:00pm GMT T-S" ?>
					  <? endif; ?>
				   <? else: ?>
				   	<? if($this->data['js']['topcat']=="3784"): ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
					    <?="Saturday & Sunday: Closed" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="Saturday & Sunday: Closed" ?>
					  <? endif; ?>
					
					<? else: ?>
					  <? if($this->data['js']['checkphone']==1): ?> 
					    <?="Sat&Sun: Closed" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="Sat&Sun: Closed" ?>
					  <? endif; ?>
					<? endif; ?>

					<? endif; ?>  
					
						
           
				</span>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_2" class="rn_HoursPrefix">
				   <? if($this->data['js']['phonehourview']==1706): ?>
				      <? if($this->data['js']['checkphone']==1): ?> 
					    <?="Sunday: 11:00pm-5:00am GMT" ?>
					  <? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<?="Sunday: 11:00pm-5:00am GMT" ?>
					  <? endif; ?>
				    <? endif; ?>  
					
						
           
				</span>
                <rn:block id="postChatHoursItemPrefix"/>
               
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
   
        <rn:block id="chatHoursBlockBottom"/>
    </div>
   
    
    <rn:block id="bottom"/>
</div>
