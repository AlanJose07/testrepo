<? /* Overriding ChatHours's view */ ?>
<?php /* Originating Release: November 2017 */?>
<!---------------------------------------------------------------------------------------------------------------------------
		   The below code is used for the view of BB Live Category in the contact tile
----------------------------------------------------------------------------------------------------------------------------> 
<? if($this->data['js']['phonehourview']==1706): ?> 

<?php /* Originating Release: May 2013 */?>

<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">

  <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
  
	                <? if($this->data['js']['checkday']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkday']==2): ?> 
						<span class="ChatClosed"> <?= $this->data['js']['closed'] ?> </span>
					<? endif; ?>
					
<span class="rn_HoursPrefix">       
	<? 
		$keyy = NULL;			
		$hours = $this->data['array3'];
		$enabled = $this->data['array4'];
		
		
$arr_unique = array_unique($hours);

$arr_duplicates = array_diff_assoc($hours, $arr_unique);

//print_r($arr_unique);
$hourswithspace = array(" AM", " PM");
$hourswithoutspace = array("am", "pm");

foreach ($arr_unique as $key=>$value) {
	
	if(in_array($value,$arr_duplicates))
	{
      
	  $arr_duplicates[$key] = $value;
	  $keyy = $key;
	unset($arr_unique[$keyy]);
	  
	}
}
ksort($arr_duplicates);

		if($this->data['js']['checkday']==2)
		{
		  echo $this->data['js']['bbliveopen'];
		}	
		
for($i=1;$i<=7;$i++)
{ 
$start = 0;
$end = 0;
$j=0;

	if(array_key_exists($i,$arr_duplicates))
	{
	
		if($enabled[$i])
		{
			$j = $i;
			
		}
		
		
		if($j)
		{	
			 while((array_key_exists($j,$arr_duplicates))&&($arr_duplicates[$j]==$arr_duplicates[$i]))
			 {
			   $start = $i;
			   
			   $j++;
			  
			 }
			if($j != $i)
			 {
			 $end = $j-1;
			 $i = $j-1;
			 
			 }
		 }
		 if(!$enabled[$i])
		 {
		 	 $j = $i;
			 while((array_key_exists($j,$arr_duplicates))&&($arr_duplicates[$j]==$arr_duplicates[$i]))
			 {
			   $start = $i;
			   
			   $j++;
			  
			 }
			if($j != $i)
			 {
			 $end = $j-1;
			 $i = $j-1;
			 
			 }
		 
		 }
		 
		
			if($start != $end)
			{
				if(($enabled[$start])&& ($enabled[$end]))
				{
				
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
		
			$new = explode(",",$arr_duplicates[$end]);
			$string=NULL;
			foreach ($new as $value)
			{
			$new1 = explode("-",$value); //$new1[0] = date('g:i', strtotime($new1[0]-1));
 			if($this->data['js']['nowtimezone'] == "GMT")
			$new2=(date('g:i A', strtotime($new1[0]))."-". date('g:i A', strtotime($new1[1])));
			if($this->data['js']['nowtimezone'] == "BST")
			$new2=(date('g:i A', strtotime($new1[0])- (60 * 60))."-". date('g:i A', strtotime($new1[1])- (60 * 60)));
			$string.=$new2.", "; 
			} //echo $string;
			$string=rtrim($string,', ');
			$string = str_replace($hourswithspace, $hourswithoutspace, $string);
				
		    
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
			
				//echo $this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>";
				if($this->day_order($start)." - ".$this->day_order($end) == "Saturday - Sunday")
				{
				  
				  echo "Sat&Sun: ".$string." GMT"."<br/>";
				}
				else
				{ 
				  echo $string." GMT ".$this->day_order($start)[0]."-".$this->day_order($end)[0]."<br/>";
				 // echo $this->data['js']['bbliveopen'].$this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>"; 
				}
				}
				else
				{
					 if($this->day_order($start)." - ".$this->day_order($end) == "Saturday - Sunday")
						{
					  		echo "Sat&Sun: Closed<br/>";
						}
					else
						{ 
							echo $this->day_order($start)."-".$this->day_order($end).":  "."Closed<br/>";
						}
				}
				
			}
		   else if($start)
		   { 
				if($enabled[$start])

				{
				
				/*-----------------------------------convert to 12 hour---------------------------------------------*/

				
			$two = explode(",",$arr_duplicates[$start]);
			$string2=NULL;
			foreach ($two as $value1)
			{
			$two1 = explode("-",$value1);
			if($this->data['js']['nowtimezone'] == "GMT")
			$two2=(date('g:i A', strtotime($two1[0]))."-". date('g:i A', strtotime($two1[1])));
			if($this->data['js']['nowtimezone'] == "BST")
			$two2=(date('g:i A', strtotime($two1[0])- (60 * 60))."-". date('g:i A', strtotime($two1[1])- (60 * 60)));
			$string2.=$two2.", "; 
			}
			$string2=rtrim($string2,', ');
			$string2 = str_replace($hourswithspace, $hourswithoutspace, $string2); 
				/*-----------------------------------convert to 12 hour---------------------------------------------*/
				
				echo $this->day_order($start).": ".$string2." GMT"."<br/>";
				}
				else
				{
				echo $this->day_order($start).": "."Closed<br/>";
				}
		   }
		   else
		   {
		   echo $this->day_order($i).": "."Closed<br/>";
		   
		   }
	 
	 
	}
	else if(array_key_exists($i,$arr_unique))
	{
	 if($enabled[$i])
	 {
	 
	 /*-----------------------------------convert to 12 hour---------------------------------------------*/

				
			$three = explode(",",$arr_unique[$i]);
			$string3=NULL;
			foreach ($three as $value2)
			{
			$three1 = explode("-",$value2);
			if($this->data['js']['nowtimezone'] == "GMT")
			$three2=(date('g:i A', strtotime($three1[0]))."-". date('g:i A', strtotime($three1[1])));
			if($this->data['js']['nowtimezone'] == "BST")
			$three2=(date('g:i A', strtotime($three1[0])- (60 * 60))."-". date('g:i A', strtotime($three1[1])- (60 * 60)));
			$string3.=$three2.", ";
			}
			$string3=rtrim($string3,', ');
			$string3 = str_replace($hourswithspace, $hourswithoutspace, $string3); 

				/*-----------------------------------convert to 12 hour---------------------------------------------*/
	 
	 
	 
	 
	
	 echo $this->day_order($i).": ".$string3." GMT"."<br/>";
	 }
	 else
	 {
	 echo $this->day_order($i).": "."Closed<br/>";
	 }
	}

}

?>
       
      
</span>	  
    
  </div>
  
</div>


			
<!---------------------------------------------------------------------------------------------------------------------------
		   The above code is used for the view of BB Live Category in the call us tile
----------------------------------------------------------------------------------------------------------------------------> 		
		 
		 
<!---------------------------------------------------------------------------------------------------------------------------
		       The below code is used for the view of all other category except BB Live Category in the contact us tile
---------------------------------------------------------------------------------------------------------------------------->  
<? else: ?>

<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_HoursLabel" class="rn_HoursLabel">
        <rn:block id="chatHoursLabelTop"/>
        <?=$this->data['attrs']['label_chat_hours'];?>
        <rn:block id="chatHoursLabelBottom"/>
    </div>
    <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
        <rn:block id="chatHoursBlockTop"/>		
		<? if($this->data['js']['checktime']==1):?>
					<? if($this->data['js']['checkday']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkday']==2): ?> 
						<span class="ChatClosed"> <?= $this->data['js']['closed'] ?> </span>
					<? endif; ?>
					
		<? endif; ?>
		<span class="rn_HoursPrefix">
        <? if($this->data['js']['checktime']==1):?>
			<? if($this->data['js']['checkday']!=1):?>
		        <? if($this->data['chatHours']['hours'][$i][0]!='Sat&Sun'): ?>
					<? if($this->data['js']['checktimewithoutsatsun']==1):?>
						 
							<?= $this->data['js']['open']?>
					
				    <? endif; ?>
                <? endif; ?>	
            <? endif; ?>
		<? endif; ?>
		</span>		
        <? for ($i = 0; $i < count($this->data['chatHours']['hours']); $i++): ?>
            <rn:block id="preChatHoursItem"/>
            <div>
                <rn:block id="chatHoursItemTop"/>
                <rn:block id="preChatHoursItemPrefix"/>
                <span id="rn_<?=$this->instanceID;?>_HoursPrefix_<?=$i?>" class="rn_HoursPrefix">
				<? if($this->data['js']['checktime']==1):?>
				   <? if($this->data['js']['checkday']==1):?>
				   
				         
						<?=$this->data['chatHours']['hours'][$i][1] ?> <?=$this->data['chatHours']['hours'][$i][0] ?>
						
				   
				   <? else: ?> 
				   
				        
								<? if($this->data['js']['checktimewithoutsatsun']==1):?>
								<?=$this->data['chatHours']['hours'][$i][1] ?> <?=$this->data['chatHours']['hours'][$i][0] ?>
								<? else: ?>
									<? if($i==0): ?>
									<?=$this->data['js']['open'].":"?>
                                    <?endif;?>								
								<?=$this->data['chatHours']['hours'][$i][1]?> <?=$this->data['chatHours']['hours'][$i][0] ?>
				                <? endif; ?>
						
				   <? endif; ?>
				
				<? else: ?>
				
					<? if($this->data['js']['checkday']==1): ?> 
					    <? if($i==0): ?>
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
						<? endif; ?>
						 <?=$this->data['chatHours']['hours'][$i][1] ?>
					<? endif; ?>	
				
					<? if($this->data['js']['checkday']==2): ?> 
						<span class="ChatClosed"> <?= $this->data['js']['closed'] ?> </span>
						 <?= $this->data['js']['available'].": ".$this->data['chatHours']['hours'][$i][1] ?>
					<? endif; ?>
					
                   
					
                <? endif;?>
				</span>
                <rn:block id="postChatHoursItemPrefix"/>
               
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
        <? endfor;?>
		
        <rn:block id="chatHoursBlockBottom"/>
    </div>
    <? if($this->data['chatHours']['holiday']):?>
        <div id="rn_<?=$this->instanceID;?>_Holiday" class="rn_Holiday">
            <rn:block id="holidayTop"/>
            <?=$this->data['attrs']['label_holiday'];?>
            <rn:block id="holidayBottom"/>
        </div>
    <? endif;?>
    
    <rn:block id="bottom"/>
</div>
<? endif; ?>

<!---------------------------------------------------------------------------------------------------------------------------
		       The above code is used for the view of all other category except BB Live Category in the contact us tile
----------------------------------------------------------------------------------------------------------------------------> 