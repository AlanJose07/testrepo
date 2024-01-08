<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Connect\v1_4 as RNCPHP,
	RightNow\Connect\v1_4\CO as RNCPHP_CO;
class CallMeNowChatHours extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

		 parent::getData();
		 
		 
		 /* the below code is to handle different HOO for bblive from custom object where as for all other categories 
		 	we are using general chat hours */
	      $nowtimezone = $hoursData['time_zone'] = strftime('%Z');
	
	 	 $rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 22")->next();     
		 $rma = $rmas->next();
	//echo "<pre>";
	//print_r($rma);
	logmessage("callme");
	logmessage($rma);
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

	$this->data['array3'] = $hours;
	$this->data['array4'] = $enabled;
		
					
		 $current_time_call = date('H:i'); //get current time in 24 hr format
		 
		//print_r($current_time_call);
		 $currentdate_call=getdate(date("U")); //get current date
		 
		// print_r($currentdate_call);
		 
		 $current_day_number_call = $this->get_day_number($currentdate_call['weekday']);//get current day number example- 7 for sunday, 1 for monday
		 
		//print_r($current_day_number_call); 2
		 
		 $available_chat_hrs_call = $hours[$current_day_number_call];//get available chat hours of current day 
		 
		//print_r($available_chat_hrs_call); 04:00-19:00
		 
		 $available_chat_hrs_exploded_call = array_filter(explode(',',$available_chat_hrs_call));//explode multiple chat hours using ','
		 
		//print_r($available_chat_hrs_exploded_call);
		  
		  $chat_count_call =  count($available_chat_hrs_exploded_call);//get count of the exploded array
		  
		  //print_r($chat_count_call);
		  
		  if($chat_count_call > 0)//if array is not null
					{
						//print_r('inside > 0');
						for($i=0;$i<sizeof($available_chat_hrs_exploded_call);$i++)
						{

						$chat_time_limits_call = explode('-',$available_chat_hrs_exploded_call[$i]);//explode a range of chat hours using '-'

						$chat_start_time_call = $chat_time_limits_call[0]; //get start time
						$chat_end_time_call = $chat_time_limits_call[1]; //get end time
						//if current time is in between the start or end time
						//print_r($chat_end_time_call);

							if(strtotime($current_time_call)<= strtotime($chat_end_time_call) && strtotime($current_time_call)>= strtotime($chat_start_time_call))
							{
								$flag = 1;//set the flag
								break;
							//	alert("inside 1");

							}
							else
							{
								$flag = 2;//unset the flag
								//print_r("inside 2");

							}

						}

					}
		   else//if array is null
					{
					//	print_r('inside<0');
						$flag = 2;//unset the flag
					}
					
				

				$this->data['js']['checkcallmenowday']= $flag; 
				
				$this->data['js']['available']= 'Available'; 
				
				$this->data['js']['closed']= 'Currently Closed'; 
				
				$this->data['js']['open']= 'Open'; 
				
				$this->data['js']['nowtimezone'] = $nowtimezone;
		 
		 
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
					//print_r('currentDay');
					//print_r($i);
					}
				}
	    }
		
	function day_order($num)
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
		}	

    
}