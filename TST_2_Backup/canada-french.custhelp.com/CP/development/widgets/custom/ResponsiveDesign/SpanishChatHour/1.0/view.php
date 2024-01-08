<?php /* Originating Release: May 2013 */?>



<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
  <rn:block id="top"/>
  <div id="rn_<?=$this->instanceID;?>_HoursLabel" class="rn_HoursLabel">
    <rn:block id="chatHoursLabelTop"/>
    <?=$this->data['attrs']['label_chat_hours'];?>
    <rn:block id="chatHoursLabelBottom"/>
  </div>
  <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
    <rn:block id="chatHoursBlockTop"/>
    <?for ($i = 0; $i < count($this->data['chatHours']['hours']); $i++): ?>
    <rn:block id="preChatHoursItem"/>
    <div>
      <rn:block id="chatHoursItemTop"/>
      <rn:block id="preChatHoursItemPrefix"/>
     	
	 <!--SPANISH CHAT HOURS-->
	
	<div id="spanish_chat_hours" style="display:block;">
	  <div id="spanish_chat" style="display:block;">
       
	<? 
		$keyy = NULL;			
		$hours = $this->data['spanish_hours'];
		$enabled = $this->data['spanish_enabled'];
		
		$arr_unique = array_unique($hours);
		$arr_duplicates = array_diff_assoc($hours, $arr_unique);


		foreach ($arr_unique as $key=>$value) {
			if(in_array($value,$arr_duplicates))
			{
			  $arr_duplicates[$key] = $value;
			  $keyy = $key;
			  unset($arr_unique[$keyy]);
			}
		}
		ksort($arr_duplicates);

		for($i=1;$i<=7;$i++)
		{
			$start = 0;
			$end = 0;
			$j=0;

				if(array_key_exists($i,$arr_duplicates)){
					if($enabled[$i]){
						$j = $i;
					}
					
					
					if($j){	
						 while((array_key_exists($j,$arr_duplicates))&&($arr_duplicates[$j]==$arr_duplicates[$i])){
						   $start = $i;
						   $j++;
						  }
						if($j != $i){
							$end = $j-1;
							$i = $j-1;
						}
					 }
						if($start != $end)
						{
						
							if(($enabled[$start])&& ($enabled[$end]))
							{
							
								//--------convert to 12 hour--

								$new = explode(",",$arr_duplicates[$end]);
								$string=NULL;
								foreach ($new as $value)
								{
									$new1 = explode("-",$value);
									$new2=(date('g:i A', strtotime($new1[0]))." - ". date('g:i A', strtotime($new1[1])));
									$string.=$new2.", ";
								}
								$string=rtrim($string,', ');

								//--------convert to 12 hour

								echo $this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>";
							}
							else
							{
								echo $this->day_order($start)." - ".$this->day_order($end).":  "."Pas disponible<br/>";
							}
							
						}
					   else if($start)
					   {
							if($enabled[$start])
							{
							
								//---------convert to 12 hour----

								$two = explode(",",$arr_duplicates[$start]);
								$string2=NULL;
								foreach ($two as $value1)
								{
									$two1 = explode("-",$value1);
									$two2=(date('g:i A', strtotime($two1[0]))." - ". date('g:i A', strtotime($two1[1])));
									$string2.=$two2.", ";
								}
								$string2=rtrim($string2,', ');
								
								//-----------------------------------convert to 12 hour--

								echo $this->day_order($start).": ".$string2."<br/>";
							}
							else
							{
								echo $this->day_order($start).": "."Pas disponible<br/>";
							}
					   }
					   else
					   {
						echo $this->day_order($i).": "."Pas disponible<br/>";
					   }
				 
				 
				}
				else if(array_key_exists($i,$arr_unique))
				{
					if($enabled[$i])
					{

						//-------convert to 12 hour----

						$three = explode(",",$arr_unique[$i]);
						$string3=NULL;
						foreach ($three as $value2)
						{
							$three1 = explode("-",$value2);
							$three2=(date('g:i A', strtotime($three1[0]))." - ". date('g:i A', strtotime($three1[1])));
							$string3.=$three2.", ";
						}
						$string3=rtrim($string3,', ');

						//------convert to 12 hour---

						echo $this->day_order($i).": ".$string3."<br/>";
					}
					else
					{
						echo $this->day_order($i).": "."Pas disponible<br/>";
					}
				}

}

?>
			<!--<br/>
			<br/>-->
      </div>
	  </div>
	 
	  <!--SPANISH LANGUAGE CHAT HOURS OF OPERATION-->
	  
	  	   
	
		  
	   <div id="derm_chat" style="display:none">
	  
      <div id="Derm_day" style="display:block"> <? echo $this->js['start_day']?> - <? echo $this->js['end_day']?>:</div>
      <rn:block id="postChatHoursItemPrefix"/>
      <rn:block id="preChatHoursItemHours"/>
      <div id="Derm_time" style="display:block"> <? echo $this->js['start_time']?> <? echo $this->js['meridian1']?> to <? echo $this->js['end_time']?> <? echo $this->js['meridian2']?>, Pacific Time </div>
      <?php /*?>		<div id="Diamond_time" style="display:none">
						<? echo $this->js['start_time_diamond']?> <? echo $this->js['meridian3']?> to <? echo $this->js['end_time_diamond']?> <? echo $this->js['meridian4']?>, Pacific Time
					</div><?php */?>
		</div>			
					
      <rn:block id="postChatHoursItemHours"/>
      <rn:block id="chatHoursItemBottom"/>
    </div>
    <rn:block id="postChatHoursItem"/>
    <? endfor;?>
    <rn:block id="chatHoursBlockBottom"/>
  </div>
  <?if($this->data['chatHours']['holiday']):?>
  <div id="rn_<?=$this->instanceID;?>_Holiday" class="rn_Holiday">
    <rn:block id="holidayTop"/>
    <?=$this->data['attrs']['label_holiday'];?>
    <rn:block id="holidayBottom"/>
  </div>
  <? endif;?>
  <div id="rn_<?=$this->instanceID;?>_CurrentTime" class="rn_CurrentTime">
    <rn:block id="currentTimeTop"/>
	
	
			<?=$this->data['chatHours']['current_time'];?>
			
    <rn:block id="currentTimeBottom"/>
  </div>
  <rn:block id="bottom"/>
</div>
