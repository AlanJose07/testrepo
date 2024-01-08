<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class CustomChatHours extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

		 parent::getData();
		 
		 
		 /* the below code is to handle different HOO for bblive from custom object where as for all other categories 
		 	we are using general chat hours */
	      $nowtimezone = $hoursData['time_zone'] = strftime('%Z');
		  
	
	 	  $TLP=trim(getUrlParm('TLP'));
		 
		  $top = explode('.',trim($TLP));
		  
		  $cat_id=trim(getUrlParm('catid'));
		
			if (!empty($cat_id))
			{
			$bblivecategory = $this->CI->model('custom/bbresponsive')->bblivecategory($cat_id);
				if($bblivecategory == 2)
				{
				$top[0] = "1706";
				}
			}	
		 
		 /* The following code is to check whether the current date and time is within the date and time specified 
		    for chat with an agent in US Interface
			
			If it is within the chat hours flag is set to 1 and
			If it is not within the chat hours flag is set to 0 
			
			-------------------------Developed by Lijo George-----------------------------------------------------
		 
		 */
		 
		if($top[0]=="1706")  //for BB Live Instructor category
		{
		$bbliveview = 1706; //to control the view for bblive and other category
		
		
	/*------------------------------------BB Live Chat Customization Start-------------------------------------------------*/
	
	 	 $rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 3")->next();     
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

	$this->data['array3'] = $hours;
	$this->data['array4'] = $enabled;
		
		}
		
	  else // all other categories except bblive
		{	
        
         $this->data['js']=$this->data;
		 
		 $days_of_week = $this->data['chatHours']['hours_data']['workday_definitions'];
		 
		 $timezone = $this->data['chatHours']['hours_data']['time_zone'];
		 
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
					
					
				//	print_r($hours);  
					
					$keys = array_values($hours);

						for($i=0; $i < count($keys); ++$i) {
							//echo $keys[$i] . ' ' . $array[$keys[$i]] . "\n";
							
							if($i>0)
							{
							
							if(strtotime($keys[$i])!=strtotime($keys[$i-1]))
							{
								$this->data['js']['checktime']= 1; 
									
								
							}
							
							}
						}
						
				for ($i = 0; $i < count($this->data['chatHours']['hours']); $i++)
				{
							
					if($this->data['chatHours']['hours'][$i][1]!='24 Hours' && $this->data['chatHours']['hours'][$i][1]!='Closed')
						{
							  $time_start=explode("-",trim($this->data['chatHours']['hours'][$i][1]));	
							  $time_end=explode(" ",trim($time_start[1]));
							  $time_end[0]=$time_end[0]." ".$time_end[1];
								
				 		      $time_start_et=explode(" ",trim($time_start[0]));
							  $time_end_et=explode(" ",trim($time_end[0]));
							  $time_start_et_minute=explode(":",trim($time_start_et[0]));
							  
							  $time_end_et_minute=explode(":",trim($time_end_et[0]));
							  $time_start_et[0] = $time_start_et[0]+0;
							  $time_end_et[0]=$time_end_et[0]+0;
							  
							  $end_result = $time_start_et[0].":".$time_start_et_minute[1].strtolower($time_start_et[1])." - ".$time_end_et[0].":".$time_end_et_minute[1].strtolower($time_end_et[1])." ".$timezone;
							   
						      $this->data['chatHours']['hours'][$i][1] = $end_result;
						}
						
						
				}
				
					
		} // end of else			
					
					
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
								$this->data['js']['bbliveopen']= ''; 
								break;
							}
							else
							{
								$flag = 2;//unset the flag
								$this->data['js']['bbliveopen']= 'Open: '; 
							}

						}

					}
		   else//if array is null
					{
						$flag = 2;//unset the flag
						$this->data['js']['bbliveopen']= 'Open: '; 
					}
					
				

				$this->data['js']['checkday']= $flag; 
				
				$this->data['js']['available']= 'Available'; 
				
				$this->data['js']['closed']= 'Currently Closed'; 
				
				$this->data['js']['open']= 'Open'; 
				
				$this->data['js']['bbliveview']= $bbliveview;
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