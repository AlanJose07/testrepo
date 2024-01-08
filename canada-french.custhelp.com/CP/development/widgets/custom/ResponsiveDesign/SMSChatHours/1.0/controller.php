<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class SMSChatHours extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

         parent::getData();
		 
		 /* The below code is used since we need to make the facebook tile in contact us page only clickable when it is within the chat hours
			-------------------------Developed by Lijo George-----------------------------------------------------
		 
		 */
		 
         $nowtimezone = $hoursData['time_zone'] = strftime('%Z');
		 
		 /* The below code is used since we need to make the facebook tile in contact us page only clickable when it is within the chat hours
			-------------------------Developed by Lijo George-----------------------------------------------------
		 
		 */
		 
      
	/*------------------------------------Facebook Chat Customization Start-------------------------------------------------*/
	
	 	 $rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 21")->next();     
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
				
		 		
			
		 $current_time_phone = date('H:i'); //get current time in 24 hr format
		 
		// print_r($current_time_phone);
		 $currentdate_phone=getdate(date("U")); //get current date
		 
		 //print_r($currentdate_phone);
		 
		 $current_day_number_phone = $this->get_day_number($currentdate_phone['weekday']);//get current day number example- 7 for sunday, 1 for monday
		 
		// print_r($current_day_number_phone);
		 
		 $available_chat_hrs_phone = $hours[$current_day_number_phone];//get available chat hours of current day
		 
		// print_r($available_chat_hrs_phone);
		 
		 $available_chat_hrs_phone_exploded = array_filter(explode(',',$available_chat_hrs_phone));//explode multiple chat hours using ','
		 
		//  print_r($available_chat_hrs_phone_exploded);
		  
		  $chat_count_phone =  count($available_chat_hrs_phone_exploded);//get count of the exploded array
		  
		//  print_r($chat_count_phone);
		  
		  if($chat_count_phone > 0)//if array is not null
					{

						for($i=0;$i<sizeof($available_chat_hrs_phone_exploded);$i++)
						{

						$chat_time_limits_phone = explode('-',$available_chat_hrs_phone_exploded[$i]);//explode a range of chat hours using '-'

						$chat_start_time_phone = $chat_time_limits_phone[0]; //get start time
						$chat_end_time_phone = $chat_time_limits_phone[1]; //get end time
						//if current time is in between the start or end time

							if(strtotime($current_time_phone)<= strtotime($chat_end_time_phone) && strtotime($current_time_phone)>= strtotime(
							$chat_start_time_phone))
							{
								$flag_phone = 1;//set the flag_phone
								$this->data['js']['bbliveopen']= ''; 
								break;
							}
							else
							{
								$flag_phone = 2;//unset the flag_phone
								$this->data['js']['bbliveopen']= 'Ouvrir: ';
							}

						}

					}
		  else//if array is null
					{
						$flag_phone = 2;//unset the flag_phone
						$this->data['js']['bbliveopen']= 'Ouvrir: ';
					}
					
				

				$this->data['js']['checkfbhours']= $flag_phone; 
				
				$this->data['js']['available']= 'Disponible'; 
				
				$this->data['js']['closed']= 'Actuellement fermé'; 
				
				$this->data['js']['open']= 'Ouvrir'; 
				
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
				7 => 'Dimanche',
				1 => 'Lundi',
				2 => 'Mardi',
				3 => 'Mercredi',
				4 => 'Jeudi',
				5 => 'Vendredi',
				6 => 'Samedi'
				
			);
			return $days[$num];	
		}
}