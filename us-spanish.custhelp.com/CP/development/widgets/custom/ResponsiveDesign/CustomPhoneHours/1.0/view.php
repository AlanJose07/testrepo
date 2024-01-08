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
						<? if($this->data['js']['timezone']=="PST"): ?>
							<?="4:00am - 7:00pm PST L-S" ?>
						
                        <? elseif($this->data['js']['timezone']=="PDT"): ?>
							<?="4:00am - 7:00pm PDT L-S" ?>
						<? else: ?>
                            <?="4:00am - 7:00pm PT L-S" ?>
						<?endif; ?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Dom: Cerrado" ?>
				</span>		
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?>     <!--if it is not within the call hours -->
						<? if($this->data['js']['timezone']=="PST"): ?>
							<?="4:00am - 7:00pm PST L-V" ?>
					
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
							<?="4:00am - 7:00pm PDT L-V" ?>
						<? else: ?>
							<?="4:00am - 7:00pm PT L-V" ?>
						<? endif;?>
				<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
						<?="Dom: Cerrado" ?>
				</span>			
					<? endif; ?>
			<!---------------------------------------------------------------------------------------------------------------------------
		   The above code is used for the view of BB Live Category in the call us tile
		    ---------------------------------------------------------------------------------------------------------------------------->  	


            <!---------------------------------------------------------------------------------------------------------------------------
		       The below code is used for the view of all other category except BB Live Category in the call us tile
		    ---------------------------------------------------------------------------------------------------------------------------->  			
				<? else: ?>
			          <? if($this->data['js']['checkphone']==1): ?>    <!--if it is within the call hours -->
						<? if($this->data['js']['timezone']=="PST"): ?>
							<? if($this->data['js']['topcat']=="3784"): ?>
									<?="Lun - Vie: 7:00 AM a 4:00 PM PST" ?>
								<? else: ?>
									<?="4:00am - 7:00pm PST L-S" ?>
								 <?endif;?>
                        <? elseif($this->data['js']['timezone']=="PDT"): ?>
							<? if($this->data['js']['topcat']=="3784"): ?>
								<?="Lun - Vie: 7:00 AM a 4:00 PM PDT" ?>
							<? else: ?>
                            <!--	<="Lunes - Sábado: 4:00am - 7:00pm PDT" ?>-->
								<?="4:00am - 7:00pm PDT L-V" ?>

                            <?endif;?>
						<? else: ?>
                            <?="4:00am - 7:00pm PT L-S" ?>
						<?endif; ?>
						<? if($this->data['js']['topcat']=="3784"): ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Sáb y Dom: Cerrado" ?>
						</span>	
						<? else: ?>	
							<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Dom: Cerrado" ?>
						</span>
						<?endif;?>		
					<? endif; ?>	
					
					<? if($this->data['js']['checkphone']==2): ?>     <!--if it is not within the call hours -->
						<? if($this->data['js']['timezone']=="PST"): ?>
							<? if($this->data['js']['topcat']=="3784"): ?>
									<?="Lun - Vie: 7:00 AM a 4:00 PM PST" ?>
							<? else: ?>
								<?="4:00am - 7:00pm PST L-V" ?>
							   <?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
							<? if($this->data['js']['topcat']=="3784"): ?>
								<?="Lun - Vie: 7:00 AM a 4:00 PM PDT" ?>
							<? else: ?>
                           	<?="4:00am - 7:00pm PDT L-V" ?>
								 <!--<="Lunes - Sábado: 4:00am - 7:00pm PDT" ?>-->

                            <?endif;?>
						<? else: ?>
							<?="4:00am - 7:00pm PT L-V" ?>
						<?endif;?>

<!-- Sat hours start-->

<div>
				 <span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">
				   <? if($this->data['js']['phonehourview']==1706): ?>
					<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sábado: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sábado: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sábado: 6:00am - 3:00pm PT" ?>
						<?endif;?>
				   <? else: ?>
				   	<? if($this->data['js']['topcat']=="3784"): ?>
			          <? if($this->data['js']['checkphone']==1): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sábado: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sábado: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sábado: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sábado: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sábado: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sábado: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>
					
					<? else: ?>
					  <? if($this->data['js']['checkphone']==1): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sábado: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sábado: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sábado: 6:00am - 3:00pm PT" ?>
						<?endif;?>					  
						<? endif; ?>	
					
					  <? if($this->data['js']['checkphone']==2): ?> 
						<? if($this->data['js']['timezone']=="PST"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
									   <?="Sábado: 6:00am - 3:00pm PST" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PST" ?>
									<?endif;?>
						<? elseif($this->data['js']['timezone']=="PDT"): ?>
									<? if($this->data['js']['topcat']=="3784"): ?>
										   <?="Sábado: 6:00am - 3:00pm PDT" ?>
									<? else: ?>
										<?="Sábado: 6:00am - 3:00pm PDT" ?>
									<?endif;?>
						<? else: ?>
							<?="Sábado: 6:00am - 3:00pm PT" ?>
						<?endif;?>
						<? endif; ?>
					<? endif; ?>

					<? endif; ?>  
					
						
           
				</span>
					  </div>

<!-- Sat hours end-->


						<? if($this->data['js']['topcat']=="3784"): ?>
						<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Sáb y Dom: Cerrado" ?>
						</span>	
						<? else: ?>	
							<span id="rn_<?=$this->instanceID;?>_HoursPrefix_1" class="rn_HoursPrefix">		
								<?="Dom: Cerrado" ?>
						</span>
						<?endif;?>		
						<? endif; ?>
					
				<? endif; ?>		
				
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
