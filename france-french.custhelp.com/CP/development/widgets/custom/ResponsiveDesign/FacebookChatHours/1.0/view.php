<? /* Overriding ChatHours's view */ ?>
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
		
		
					<? if($this->data['js']['checkfbhours']==1): ?> 
						<span class="ChatAvailable"> <?= $this->data['js']['available'] ?> </span>
					<? endif; ?>	
					
					<? if($this->data['js']['checkfbhours']==2): ?> 
						<span class="ChatAvailable"> #rn:msg:CUSTOM_MSG_FACEBOOK_LABEL# </span>
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
$hourswithspace = array("0:00", "1:00", "2:00", "3:00", "4:00", "5:00", "6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00");
$hourswithoutspace = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24");

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
			if(date('G:i', strtotime($new1[1])) == "0:00")
			$new2=(date('G:i', strtotime($new1[0]))."h - 24h");
			else
			$new2=(date('G:i', strtotime($new1[0]))."h - ". date('G:i', strtotime($new1[1]))."h");
			$string.=$new2.", ";
			} //echo $string;
			$string=rtrim($string,', ');
			$string = str_replace($hourswithspace, $hourswithoutspace, $string);
				
		    
			/*-----------------------------------convert to 12 hour---------------------------------------------*/
			
				//echo $this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>";
				if($this->day_order($start)." - ".$this->day_order($end) == "Samedi - Dimanche")
				{
				  
				  echo "Samedi et Dimanche: ".$string." "."<br/>";
				}
				else
				{
				  echo $string." ".$this->day_order($start)." - ".$this->day_order($end)."<br/>";
				}   
				 
				 // echo $this->data['js']['bbliveopen'].$this->day_order($start)." - ".$this->day_order($end).": ".$string."<br/>"; 
				
				}
				else
				{
					 if($this->day_order($start)." - ".$this->day_order($end) == "Samedi - Dimanche")
						{
					  		echo "Samedi et Dimanche: fermé<br/>";
						}
					else
						{ 
							echo $this->day_order($start)." - ".$this->day_order($end).":  "."fermé<br/>";
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
			if(date('G:i', strtotime($two1[1])) == "0:00")
			$two2=(date('G:i', strtotime($two1[0]))."h - 24h");
			else
			$two2=(date('G:i', strtotime($two1[0]))."h - ". date('G:i', strtotime($two1[1]))."h");
			$string2.=$two2.", "; 
			}
			$string2=rtrim($string2,', ');
			$string2 = str_replace($hourswithspace, $hourswithoutspace, $string2); 
				/*-----------------------------------convert to 12 hour---------------------------------------------*/
				
				echo $string2." ".$this->day_order($start)." - ".$this->day_order($end)."<br/>";
				}
				else
				{
				echo $this->day_order($start).": "."fermé<br/>";
				}
		   }
		   else
		   {
		   echo $this->day_order($i).": "."fermé<br/>";
		   
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
			if(date('G:i', strtotime($three1[1])) == "0:00")
			$three2=(date('G:i', strtotime($three1[0]))."h - 24h");
			else
			$three2=(date('G:i', strtotime($three1[0]))."h - ". date('G:i', strtotime($three1[1]))."h");
			$string3.=$three2.", ";
			}
			$string3=rtrim($string3,', ');
			$string3 = str_replace($hourswithspace, $hourswithoutspace, $string3); 

				/*-----------------------------------convert to 12 hour---------------------------------------------*/
	 
	 
	 
	 
	
	 echo $string3." ".$this->day_order($start)." - ".$this->day_order($end)."<br/>";
	 }
	 else
	 {
	 echo $this->day_order($i).": "."fermé<br/>";
	 }
	}

}

?>	 

<? else: ?>
#rn:msg:CUSTOM_MSG_FACEBOOK_REPLY_TIME#
	<? //echo "Nous répondrons vers 7h du Pacifique du lundi au vendredi";?>
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
