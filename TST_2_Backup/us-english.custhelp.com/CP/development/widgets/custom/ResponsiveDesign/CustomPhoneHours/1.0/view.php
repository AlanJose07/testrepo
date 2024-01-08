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
				      <? if($this->data['js']['checkphone']==1): ?>      <!--If it is within the phone hours -->
						<? if($this->data['js']['timezone']=="PST"): ?>
							<?="4:00am - 10:00pm PST M-S" ?>
						
                        <? elseif($this->data['js']['timezone']=="PDT"): ?>
							<?="4:00am - 10:00pm PDT M-S" ?>
						<? else: ?>
                            <?="4:00am - 10:00pm PT M-S" ?>
						<?endif; ?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Sunday: Closed" ?>
				</span>		
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?>        <!--If it is not within the phone hours -->
						<? if($this->data['js']['timezone']=="PST"): ?>
							<?="Open: 4:00am - 10:00pm PST M-S" ?>
					
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
							<?="Open: 4:00am - 10:00pm PDT M-S" ?>
						<? else: ?>
							<?="Open: 4:00am - 10:00pm PT M-S" ?>
						<?endif;?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Sunday: Closed" ?>
				</span>			
					<? endif; ?>
					
		<!---------------------------------------------------------------------------------------------------------------------------
		   The above code is used for the view of BB Live Category in the call us tile
		 ----------------------------------------------------------------------------------------------------------------------------> 		
		 
		 
		<!---------------------------------------------------------------------------------------------------------------------------
		       The below code is used for the view of all other category except BB Live Category in the call us tile
		---------------------------------------------------------------------------------------------------------------------------->  
				<? else: ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
								<? if($this->data['js']['topcat']=="3784"): ?>
										<?="4:00am - 7:00pm PST M-F" ?>
								<? else: ?>
									<?="4:00am - 7:00pm PST M-F" ?>
								<?endif;?>
                        <? elseif($this->data['js']['timezone']=="PDT"): ?>
								<? if($this->data['js']['topcat']=="3784"): ?>
										<?="4:00am - 7:00pm PDT M-F" ?>
								<? else: ?>
									<?="4:00am - 7:00pm PDT M-F" ?>
								<?endif;?>
						<? else: ?>
                            <?="4:00am - 7:00pm PT M-F" ?>
						 <?endif; ?>
						<!--<? /*if($this->data['js']['topcat']=="3784"): ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Sat and Sun: Closed" ?>
						</span>	
						<?endif;*/?>	-->								
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="4:00am - 7:00pm PST M-F" ?>
									<? else: ?>
										<?="4:00am - 7:00pm PST M-F" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="4:00am - 7:00pm PDT M-F" ?>
									<? else: ?>
										<?="4:00am - 7:00pm PDT M-F" ?>
									<?endif;?>
						<? else: ?>
							<?="4:00am - 7:00pm PT M-F" ?>
						<?endif;?>
						<!--<? /*if($this->data['js']['topcat']=="3784"): ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Sat and Sun: Closed" ?>
						</span>	
						<?endif; */?>		-->
					<? endif; ?>
					
				<?endif; ?>		
				
		<!---------------------------------------------------------------------------------------------------------------------------
		       The above code is used for the view of all other category except BB Live Category in the call us tile
		 ----------------------------------------------------------------------------------------------------------------------------> 		
           
				</span>

				<div>
				 <span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">
				   <? if($this->data['js']['phonehourview']==1706): ?>
					<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sat & Sun: 6:00am - 3:00pm PT" ?>
						<?endif;?>
				   <? else: ?>
				   	<? if($this->data['js']['topcat']=="3784"): ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sat & Sun: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sat & Sun: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>
					
					<? else: ?>
					  <? if($this->data['js']['checkphone']==1): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sat & Sun: 6:00am - 3:00pm PT" ?>
						<?endif;?>					  
						<? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sat & Sun: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sat & Sun: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>
					<? endif; ?>

					<? endif; ?>  
					
						
           
				</span>
					  </div>
                <rn:block id="postChatHoursItemPrefix"/>
               
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
   
        <rn:block id="chatHoursBlockBottom"/>
    </div>
   
    
    <rn:block id="bottom"/>
</div>
