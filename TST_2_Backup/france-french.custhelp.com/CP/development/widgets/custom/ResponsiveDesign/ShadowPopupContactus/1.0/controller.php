<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Config as Message;


class ShadowPopupContactus extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) { 
        parent::__construct($attrs);
    }

    function getData() {
	
	   	//$CI = get_instance();
		
		//$this->data['js']['shadow_popup'] = Message::getMessage(CUSTOM_MSG_COACH_ENROLLMENT_PROCESS);
		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		if($uriSegments[2] == "contactus")
			$url = "https://$_SERVER[HTTP_HOST]/app/contactus";
		if($uriSegments[2] == " " || $uriSegments[2] == "home" || empty($uriSegments[2]))
			$url = "https://$_SERVER[HTTP_HOST]/app/home";
			
		$url = str_replace("%26%23039%3B","''",urlencode($url));
		$url = urldecode($url);
		$enable = false;
		$results = $this->CI->model('custom/CustomObjectData')->fetchShadowpopup($url);
		
		if(!empty($results))
		$enable = true;
		//echo "<pre>";
		//print_r($results);
		$this->data['js']['enable'] = $enable;
		$this->data['js']['id'] = $results['cookie_id'];
		$this->data['js']['popupid'] = $results['ID'];
		if(empty($results['duration'])){
			$this->data['js']['duration'] = 30;
		}else{
		$this->data['js']['duration']  = $results['duration'];
		}
		$this->data['js']['configure_popup'] = $results['configure_popup'];
		$this->data['resultData'] = $results;
		
		if($results['configure_popup'] == 1){ //everyday
		
			$current_time = date('Y-m-d H:i:s'); //get current time in 24 hr format
			$timestamp = strtotime($current_time);
			$time = $timestamp - (9 * 60 * 60);
			$current_time = date("H:i", $time);
			$chat_time_limits = explode('-',$results['everyday_timerange']);//explode a range of hours using '-'

			$chat_start_time = $chat_time_limits[0]; //get start time
			$chat_end_time = $chat_time_limits[1]; //get end time
			if(strtotime($current_time)<= strtotime($chat_end_time) && strtotime($current_time)>= strtotime($chat_start_time)){
				$flag = true;
			}else{
				$flag = false;
			}
		
		}else if($results['configure_popup'] == 2){ //between a range of dates
		
			$current_time = date("Y-m-d H:i");  //get current date and time
			$start_date = $results['From_Date'];
			$end_date = $results['To_Date'];
			
			$timestamp = strtotime($current_time);
			$time = $timestamp - (9 * 60 * 60);
			$current_time = date("Y-m-d H:i", $time);
			
			$timestamp1 = strtotime($start_date);
			$time1 = $timestamp1 - (9 * 60 * 60);
			$start_date = date("Y-m-d H:i", $time1);
			
			$timestamp2 = strtotime($end_date);
			$time2 = $timestamp2 - (9 * 60 * 60);
			$end_date = date("Y-m-d H:i", $time2);
			
			if(strtotime($current_time)<= strtotime($end_date) && strtotime($current_time)>= strtotime($start_date)){
				$flag = true;
			}else{
				$flag = false;
			}
		
		}else if($results['configure_popup'] == 3){ // days of the week
		
		$monday = $results['mon_hours']; 
		$tuesday = $results['tue_hours']; 
		$wednesday = $results['wed_hours']; 
		$thursday = $results['thu_hours']; 
		$friday = $results['fri_hours']; 
		$saturday = $results['sat_hours']; 
		$sunday = $results['sun_hours']; 
		
		$hours=array("1"=>$monday,"2"=>$tuesday,"3"=>$wednesday,"4"=>$thursday,"5"=>$friday,"6"=>$saturday,"7"=>$sunday);
		
		$current_time = date('Y-m-d H:i:s');  //get current time in 24 hr format
		$timestamp = strtotime($current_time);
		$time = $timestamp - (9 * 60 * 60);
		$currentdate=getdate($time);
		$current_time = date("H:i", $time);

		 
		// print_r($current_time);
		 //$currentdate=getdate(date("U")); //get current date
		 
		 //print_r($currentdate);
		 
		 $current_day_number = $this->get_day_number($currentdate['weekday']);//get current day number example- 7 for sunday, 1 for monday
		 
		// print_r($current_day_number);
		 
		 $available_chat_hrs = $hours[$current_day_number];//get available chat hours of current day
		 
		// print_r($available_chat_hrs);
		 
		 $available_chat_hrs_exploded = array_filter(explode(',',$available_chat_hrs));//explode multiple chat hours using ','
		 
		//  print_r($available_chat_hrs_exploded);
		  
		  $chat_count =  count($available_chat_hrs_exploded);//get count of the exploded array
		  
		  if($chat_count > 0)//if array is not null
					{

						for($i=0;$i<sizeof($available_chat_hrs_exploded);$i++)
						{

						$chat_time_limits = explode('-',$available_chat_hrs_exploded[$i]); //explode a range of chat hours using '-'

						$chat_start_time = $chat_time_limits[0]; //get start time
						$chat_end_time = $chat_time_limits[1]; //get end time
						//if current time is in between the start or end time

							if(strtotime($current_time)<= strtotime($chat_end_time) && strtotime($current_time)>= strtotime($chat_start_time))
							{
								$flag = true;//set the flag
								break;
							}
							else
							{
								$flag = false;//unset the flag
							}

						}

					}
		   else//if array is null
					{
						$flag = false;//unset the flag
					}
		
		}else if($results['configure_popup'] == 32){ // all the time
		
			$flag = true;//set the flag
		
		}else if($results['configure_popup'] == 33){ //everyday
			$flag = true;//set the flag
			/*echo date('H:i'); 
			$start = strtotime(date('H:i')); //get current time in 24 hr format
  			$stop = strtotime("00:54");
			$diff = ($stop - $start);
			$duration = $diff/60;
			$this->data['js']['duration']  = $duration; */
		
		}else{
			$flag = false;
		}
		//echo $flag;
		$this->data['flag']= $flag; 
		
        return parent::getData();

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