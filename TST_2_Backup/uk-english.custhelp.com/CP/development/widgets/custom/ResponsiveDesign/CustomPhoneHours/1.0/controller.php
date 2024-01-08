<?php
namespace Custom\Widgets\ResponsiveDesign;

class CustomPhoneHours extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
			 /* The below code is used since we need to make the call us in contact us page dynamically showing available and currently
				closed when it is within the phones hours and outside phone hours
			-------------------------Developed by Lijo George-----------------------------------------------------
		 
		 */
		 
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
			
		 $timezone = $this->data['chatHours']['hours_data']['time_zone'];  // whether it is gmt or bst
		 $nowtimezone = trim($hoursData['time_zone'] = strftime('%Z'));
		// echo $timezone;
		 
		 
	if($top[0]=="1706")  //for BB Live Instructor category
	{
		$phonehourview = 1706; //to control the view for bblive and other category
		/* if($nowtimezone=="BST")
		{		*/
		 $hours	= Array(
						'1' => '12:00-24:00',
						'2' => '00:00-6:00,12:00-24:00',
						'3' => '00:00-6:00,12:00-24:00',
						'4' => '00:00-6:00,12:00-24:00',
						'5' => '00:00-6:00,12:00-24:00',
						'6' => '00:00-6:00,12:00-24:00',
						'7' => '00:00-06:00'	
					);	
        //}

		/* else
		{

		 $hours	= Array(
						'1' => '13:00-23:00',
						'2' => '13:00-23:00',
						'3' => '13:00-23:00',
						'4' => '13:00-23:00',
						'5' => '13:00-23:00'	
					);
		}	*/		
		 		
					//print_r($hours);  	 
	}
		 
	else   // for all other categories except BB Live Instructor because phone hours are similar in all other primary category
	{
		 
		 
		
		
        if($nowtimezone=="BST")
		{		
		 $hours	= Array(
						'1' => '09:00-21:00',
						'2' => '09:00-21:00',
						'3' => '09:00-21:00',
						'4' => '09:00-21:00',
						'5' => '09:00-21:00'	
					);	
        }

		else
		{

		 $hours	= Array(
						'1' => '08:00-20:00',
						'2' => '08:00-20:00',
						'3' => '08:00-20:00',
						'4' => '08:00-20:00',
						'5' => '08:00-20:00'	
					);
		}

    }		
		 		
					//print_r($hours);  
					
		
		
		
								
					
		 $current_time_phone = date('H:i'); //get current time in 24 hr format
		 
		// print_r($current_time_phone);
		 $currentdate_phone=getdate(date("U")); //get current date
		 
		 //print_r($currentdate_phone);
		 
		 $current_day_number_phone = $this->get_day_number($currentdate_phone['weekday']);//get current day number example- 7 for sunday, 1 for monday
		 
		// print_r($current_day_number_phone);
		 
		 $available_chat_hrs_phone = $hours[$current_day_number_phone];//get available chat hours of current day
		 
		 //print_r($available_chat_hrs_phone);
		 
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

							if(strtotime($current_time_phone)<= strtotime($chat_end_time_phone) && strtotime($current_time_phone)>= strtotime($chat_start_time_phone))
							{
								$flag_phone = 1;//set the flag_phone
								break;
							}
							else
							{
								$flag_phone = 2;//unset the flag_phone
							}

						}

					}
		   else//if array is null
					{
						$flag_phone = 2;//unset the flag_phone
					}
					
				

				$this->data['js']['checkphone']= $flag_phone; 
				
				$this->data['js']['available']= 'Available'; 
				
				$this->data['js']['closed']= 'Currently Closed'; 
				
				$this->data['js']['open']= 'Open'; 
				
				$this->data['js']['timezone']= $timezone; 
				
				$this->data['js']['phonehourview']= $phonehourview; 

				$this->data['js']['topcat'] = $top[0];

	
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


