<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class BbliveChatHour extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

   function getData() {      
	
	
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


	
	/*------------------------------------BB Live Chat Customization End-------------------------------------------------*/
	
	
	
	 	$this->data['chatHours'] = $this->CI->model('Chat')->getChatHours()->result; 
        $this->data['show_hours'] = !$this->data['chatHours']['inWorkHours'];

        //return parent::getData();
		
		
		//to hide and show of submit button...the code start here
		
		/*------------------------------------BB Live Chat Customization Start----------------------------------------------------------*/
	
	 $rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 3")->next();   
		 $rma = $rmas->next();
	
	
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

$this->data['array1'] = $hours;
$this->data['array2'] = $enabled;




$current_time = date('H:i'); //get current time in 24 hr format


$currentdate=getdate(date("U")); //get current date
$current_day_number = $this->get_day_number($currentdate['weekday']);//get current day number example- 7 for sunday, 1 for monday

$available_chat_hrs = $hours[$current_day_number];//get available chat hours of current day


$available_chat_hrs_exploded = array_filter(explode(',',$available_chat_hrs));//explode multiple chat hours using ','

$chat_count =  count($available_chat_hrs_exploded);//get count of the exploded array



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
$flag = 0;//unset the flag
}

}

}
else//if array is null
{
$flag = 0;//unset the flag

}

$this->data['js']['check_day_bbliveinstructor']= $flag; 
	
	//---------------------BB Live Chat Instructor----End---------------------------------------------------------- 
		
		
		
		
		

    }
	
	
	function time24to12($h24) {
    if ($h24 === 0) { $newhour = 12; }
    elseif ($h24 <= 12) { $newhour = $h24; }
    elseif ($h24 > 12) { $newhour = $h24 - 12; }
    return ($h24 < 12) ? $newhour : $newhour ;
}

	function number_day($num)
	 {
			$days = array(
			0 => 'Sunday',
			1 => 'Monday',
			2 => 'Tuesday',
			3 => 'Wednesday',
			4 => 'Thursday',
			5 => 'Friday',
			6 => 'Saturday'
			
		);
		return $days[$num];	
	}
	
	function day_order($num)
	 {
			$days = array(
			7 => 'Domingo',
			1 => 'Lunes',
			2 => 'Martes',
			3 => 'Miércoles',
			4 => 'Jueves',
			5 => 'Viernes',
			6 => 'Sábado'
			/*7 => 'Sunday',
			6 => 'Monday',
			5 => 'Tuesday',
			4 => 'Wednesday',
			3 => 'Thursday',
			2 => 'Friday',
			1 => 'Saturday'*/

		);
		return $days[$num];	
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