<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class chathours extends \RightNow\Models\Base {
    function __construct() {
        parent::__construct();
    }

   function getChatHours($chat)
	{ 
	  
		try{
			
			if($chat == "chat"){
				$chatresult = $this->CI->model('Chat')->getChatHours()->result;
				
				$days_of_week = $chatresult['hours_data']['workday_definitions'];
				
				$timezone = $chatresult['hours_data']['time_zone'];
				
				$hours = array();
				
				for($i=0;$i<count($days_of_week);$i++)
				{   
					
					for($j=0;$j<count($days_of_week[$i]['days_of_week']);$j++)
					{ 
					
						$start = $days_of_week[$i]['work_intervals'][0]['start'];
						$end = $days_of_week[$i]['work_intervals'][0]['end'];
						$start_end = $start."-".$end;
						$hours[$days_of_week[$i]['days_of_week'][$j]] = $start_end ;
					}
					
					
					
				}
		}elseif($chat == "facebook"){
			$rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 19")->next();     
			$rma = $rmas->next();
			//echo "<pre>";
			//print_r($rma);
			
			/*Hour for each day*/
			
			
			$monday = $rma->Mon_Hours; 
			$tuesday = $rma->Tue_Hours;
			$wednesday = $rma->Wed_Hours;
			$thursday = $rma->Thu_Hours;
			$friday = $rma->Fri_Hours;
			$saturday = $rma->Sat_Hours;
			$sunday = $rma->Sun_Hours;
			
			
			
			/*enabled/disabled for each day*/
			$monday_enabled = $rma->Mon_Enabled;
			$tuesday_enabled = $rma->Tue_Enabled;
			$wednesday_enabled = $rma->Wed_Enabled;
			$thursday_enabled = $rma->Thu_Enabled;
			$friday_enabled = $rma->Fri_Enabled;
			$saturday_enabled = $rma->Sat_Enabled;
			$sunday_enabled = $rma->Sun_Enabled;
			$title = $rma->Title;
			
			
			
			/*creating a multidimentional array to store all the values	*/
			$keyy = NULL;		
			$hours=array("1"=>$monday,"2"=>$tuesday,"3"=>$wednesday,"4"=>$thursday,"5"=>$friday,"6"=>$saturday,"7"=>$sunday);
			$enabled=array("1"=>$monday_enabled,"2"=>$tuesday_enabled,"3"=>$wednesday_enabled,"4"=>$thursday_enabled,"5"=>$friday_enabled,"6"=>$saturday_enabled,"7"=>$sunday_enabled);
		
		}elseif($chat == "sms"){
			// No SMS channel for FR FR as of today July 7, 2020
		}elseif($chat == "phone"){  // phone
			$hours	= Array(
						'1' => '09:00-17:00',
						'2' => '09:00-17:00',
						'3' => '09:00-17:00',
						'4' => '09:00-17:00',
						'5' => '09:00-17:00'
					);
		}else{
			
		}		
							
		 $current_time = date('H:i'); //get current time in 24 hr format
		 
		// print_r($current_time);
		 $currentdate=getdate(date("U")); //get current date
		 
		 //print_r($currentdate);
		 
		 $current_day_number = $this->get_day_number($currentdate['weekday']);//get current day number example- 7 for sunday, 1 for monday
		 
		// print_r($current_day_number);
		 
		 $available_chat_hrs = $hours[$current_day_number];//get available chat hours of current day
		 
		// print_r($available_chat_hrs);
		 
		 $available_chat_hrs_exploded = array_filter(explode(',',$available_chat_hrs));//explode multiple chat hours using ','
		 
		//  print_r($available_chat_hrs_exploded);
		  
		  $chat_count =  count($available_chat_hrs_exploded);//get count of the exploded array
		  
		//  print_r($chat_count);
		  
		  if($chat_count > 0)//if array is not null
					{

						for($i=0;$i<sizeof($available_chat_hrs_exploded);$i++)
						{

						$chat_time_limits = explode('-',$available_chat_hrs_exploded[$i]);//explode a range of chat hours using '-'

						$chat_start_time = $chat_time_limits[0]; //get start time
						$chat_end_time = $chat_time_limits[1]; //get end time
						//if current time is in between the start or end time

							if(strtotime($current_time)<= strtotime($chat_end_time) && strtotime($current_time)>= strtotime($chat_start_time))
							{
								$flag = 1;//set the flag
								break;
							}
							else
							{
								$flag = 2;//unset the flag 
							}

						}

					}
		   else//if array is null
					{
						$flag = 2;//unset the flag 
					}		
		return $flag;
			
		}catch(Exception $e){
			echo $e->getMessage();
		}
		
	} 
	
	function get_day_number($current_day)//This function returns the number of the current day
	{

		$week_days = array(
				7 => 'Sunday',
				1 => 'Monday',
				2 => 'Tuesday',
				3 => 'Wednesday',
				4 => 'Thursday',
				5 => 'Friday',
				6 => 'Saturday'
				
			);
			$current_day =(string)$current_day;
			for($i=0;$i< sizeof($week_days)+1;$i++)
			{
				if(trim($week_days[$i],"") === trim($current_day,""))
				{
				return $i;
				}
			}
	}  

}