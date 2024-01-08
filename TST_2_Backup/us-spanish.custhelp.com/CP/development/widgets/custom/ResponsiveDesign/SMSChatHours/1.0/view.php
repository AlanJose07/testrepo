<? /* Overriding ChatHours's view */ ?>
<?php /* Originating Release: November 2017 */?>
<? if($this->data['attrs']['page']==1): ?>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_HoursLabel" class="rn_HoursLabel">
        <rn:block id="chatHoursLabelTop"/>
        <?=$this->data['attrs']['label_chat_hours'];?>
        <rn:block id="chatHoursLabelBottom"/>
    </div>
    <div id="rn_<?=$this->instanceID;?>_HoursBlock" class="rn_HoursBlock">
        <rn:block id="chatHoursBlockTop"/>
		
		
					<? if($this->data['js']['checkfbhours']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkfbhours']==2): ?> 
						<span class="ChatAvailable"> #rn:msg:CUSTOM_MSG_SMS_LABEL# </span>
					<? endif; ?>
					
				
       
            <rn:block id="preChatHoursItem"/>
            <div>
                <rn:block id="chatHoursItemTop"/>
                <rn:block id="preChatHoursItemPrefix"/>
				
				<!--------------------------------------------------------------------------------------------------
				     The below code is used to view the corresponding fb chat hours in the facebook tile
				     The below two <span> is used to display the hours in two line because the
                     standard style is in such a way. The first span below display the first line and second span
					 display the 2nd line------------------------------------------------------------------------
					 -------------------------Lijo George-------------------------------------------------------->
					 
				 <span class="rn_HoursPrefix">       
<? if($this->data['js']['checkfbhours']==1): ?> 				 
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

		if($this->data['js']['checkfbhours']==2)
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
			$new1 = explode("-",$value);
			$new2=(date('g:i A', strtotime($new1[0]))." - ". date('g:i A', strtotime($new1[1])));
			$string.=$new2.", ";
			} //echo $string;
			$string=rtrim($string,', ');
			$string = str_replace($hourswithspace, $hourswithoutspace, $string);
				
		    
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
			
				//echo $this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>";
				if($this->day_order($start)." - ".$this->day_order($end) == "Sábado - Domingo")
				{
				  
				  echo "Sáb y Dom: ".$string." ".$this->data['js']['nowtimezone']."<br/>"; 
				}
				elseif($this->day_order($start)." - ".$this->day_order($end) == "Lunes - Sábado")
				{
				  
				  echo $string." ".$this->data['js']['nowtimezone']." ".$this->day_order($start)[0]."-".$this->day_order($end)[0]."<br/>"; 
				}
				elseif($this->day_order($start)." - ".$this->day_order($end) == "Lunes - Viernes")
				{
				  echo $string." ".$this->data['js']['nowtimezone']." ".$this->day_order($start)[0]."-".$this->day_order($end)[0]."<br/>";
				}
				elseif($this->day_order($start)." - ".$this->day_order($end) == "Lunes - Domingo")
				{
				 echo $string." ".$this->data['js']['nowtimezone']."<br/>";
				}
				else
				{
				echo $this->day_order($start)."-".$this->day_order($end).": ".$string." ".$this->data['js']['nowtimezone']."<br/>";
				}   
				 
				 // echo $this->data['js']['bbliveopen'].$this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>"; 
				
				}
				else
				{
					 if($this->day_order($start)." - ".$this->day_order($end) == "Sábado - Domingo")
						{
					  		echo "Sáb y Dom: Cerrado<br/>";
						}
					else
						{ 
							echo $this->day_order($start)." - ".$this->day_order($end).":  "."Cerrado<br/>";
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
			$two2=(date('g:i A', strtotime($two1[0]))." - ". date('g:i A', strtotime($two1[1])));
			$string2.=$two2.", "; 
			}
			$string2=rtrim($string2,', ');
			$string2 = str_replace($hourswithspace, $hourswithoutspace, $string2); 
				/*-----------------------------------convert to 12 hour---------------------------------------------*/
				
				echo $this->day_order($start).": ".$string2." ".$this->data['js']['nowtimezone']."<br/>";
				}
				else
				{
					if($this->day_order($start) == 'Domingo')
						echo "Dom: Cerrado<br/>";
					else
						echo $this->day_order($start).": "."Cerrado<br/>";
				}
		   }
		   else
		   {
				if($this->day_order($i) == 'Domingo')
					echo "Dom: Cerrado<br/>";
				else
					echo $this->day_order($i).": "."Cerrado<br/>";
		   
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
			$three2=(date('g:i A', strtotime($three1[0]))." - ". date('g:i A', strtotime($three1[1])));
			$string3.=$three2.", ";
			}
			$string3=rtrim($string3,', ');
			$string3 = str_replace($hourswithspace, $hourswithoutspace, $string3); 

				/*-----------------------------------convert to 12 hour---------------------------------------------*/
	 
	 
	 
	 
	
	 echo $this->day_order($i).": ".$string3." ".$this->data['js']['nowtimezone']."<br/>";
	 }
	 else
	 {
	 	if($this->day_order($i) == 'Domingo')
			echo "Dom: Cerrado<br/>";
		else	
	 		echo $this->day_order($i).": "."Cerrado<br/>";
	 }
	}

}

?>	 

<? else: ?>
#rn:msg:CUSTOM_MSG_SMS_REPLY_TIME#
<? //echo "Responderemos antes de las 7 a.m. PST L-V";?>
<? endif;?>  
  </span>             
			 </div>
			 <div>
				
                <rn:block id="postChatHoursItemPrefix"/>
               
                <rn:block id="chatHoursItemBottom"/>
            </div>
            <rn:block id="postChatHoursItem"/>
   
        <rn:block id="chatHoursBlockBottom"/>
    </div>
   
    
    <rn:block id="bottom"/>
</div>

<? endif; ?>

<? if($this->data['attrs']['page']==2): ?>

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
      <?	
	$keyy = NULL;			
	$hours = $this->data['array3'];
	$enabled = $this->data['array4'];
		
	?>
	
	
	
      <div id="Diamond_day" style="display:block">
	   <div id="Diamond_day_hours" style="display:block">
        <? 
 
/*echo $this->js['start_day_diamond']?> - <? echo $this->js['end_day_diamond']*/
/*echo"<pre>";*/
 
$arr_unique = array_unique($hours);
$arr_duplicates = array_diff_assoc($hours, $arr_unique);
//print_r($arr_unique);

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
		 
		
			if($start != $end)
			{
			
				if(($enabled[$start])&& ($enabled[$end]))
				{
				
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
		
			$new = explode(",",$arr_duplicates[$end]);
			$string=NULL;
			foreach ($new as $value)
			{
			$new1 = explode("-",$value);
			$new2=(date('g:i A', strtotime($new1[0]))." - ". date('g:i A', strtotime($new1[1])));
			$string.=$new2.", ";
			}
			$string=rtrim($string,', ');
			
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
			
				echo $this->day_order($start)." - ".$this->day_order($end).": ".$string." ".$this->data['js']['nowtimezone']."<br/>";
				}
				else
				{
				echo $this->day_order($start)." - ".$this->day_order($end).":  "."El texto no está disponible<br/>";
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
			$two2=(date('g:i A', strtotime($two1[0]))." - ". date('g:i A', strtotime($two1[1])));
			$string2.=$two2.", ";
			}
			$string2=rtrim($string2,', ');
				/*-----------------------------------convert to 12 hour---------------------------------------------*/
				
				echo $this->day_order($start).": ".$string2." ".$this->data['js']['nowtimezone']."<br/>";
				}
				else
				{
				echo $this->day_order($start).": "."El texto no está disponible<br/>";
				}
		   }
		   else
		   {
		   echo $this->day_order($i).": "."El texto no está disponible<br/>";
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
			$three2=(date('g:i A', strtotime($three1[0]))." - ". date('g:i A', strtotime($three1[1])));
			$string3.=$three2.", ";
			}
			$string3=rtrim($string3,', ');

				/*-----------------------------------convert to 12 hour---------------------------------------------*/
	 
	 
	 
	 
	 
	 echo $this->day_order($i).": ".$string3." ".$this->data['js']['nowtimezone']."<br/>";
	 }
	 else
	 {
	 echo $this->day_order($i).": "."El texto no está disponible<br/>";
	 }
	}

}



/*function day_order($num)
	 {
			$days = array(
			7 => 'Sunday',
			1 => 'Monday',
			2 => 'Tuesday',
			3 => 'Wednesday',
			4 => 'Thursday',
			5 => 'Friday',
			6 => 'Saturday'
			
		);
		return $days[$num];	
}*/


?>
       <!-- <br/>
        <br/>-->
      </div>
	  </div>
	   
	
		  
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
  <? if($this->data['chatHours']['holiday']):?>
  <div id="rn_<?=$this->instanceID;?>_Holiday" class="rn_Holiday">
    <rn:block id="holidayTop"/>
    <?=$this->data['attrs']['label_holiday'];?>
    <rn:block id="holidayBottom"/>
  </div>
  <? endif;?>
  <div id="rn_<?=$this->instanceID;?>_CurrentTime" class="rn_CurrentTime">
    <rn:block id="currentTimeTop"/>
	
	<?php 
	
	/**/
		//if (!preg_match('/contact_us/',$curr_url))//if the page is contact_us.php, then no need to show the current time label --diamond line chat
		//{
		?>
			<?=$this->data['chatHours']['current_time'];?>
		<?php
		//}
		
	?>
    <rn:block id="currentTimeBottom"/>
  </div>
  <rn:block id="bottom"/>
</div>


<? endif; ?>
