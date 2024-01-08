<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
	
class DiamondChatHour extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
			/*Change chat time from console DERM EXCLUSIVE*/
	
		$time_date = getConfig(CUSTOM_CFG_CHAT_DERM);    
		
		$a = explode("/",$time_date);
		$b = explode("-",$a[0]);
		$c = explode("-",$a[1]);
		$start_time = $b[0]; 
		if($start_time
<12){
		$meridian1 = "AM";
		}else{
		$meridian1 = "PM";
		}
		$end_time = $b[1];
		if($end_time<12){
		$meridian2 = "AM";
		}else{
		$meridian2 = "PM";
		}
		$start_day = $c[0];
		$end_day = $c[1];  
		$new_start_time = $this->time24to12($start_time); 
		$new_end_time = $this->time24to12($end_time);
		$new_start_day = $this->number_day($start_day);
		$new_end_day = $this->number_day($end_day);
		
		
		
		
		
		
		

		$this->js['meridian1'] = $meridian1;
		$this->js['meridian2'] = $meridian2;
		$this->js['start_time'] = $new_start_time; 
		$this->js['end_time'] = $new_end_time;
		$this->js['start_day'] = $new_start_day;
		$this->js['end_day'] = $new_end_day;
		
		
	/*Change chat time from console DERM EXCLUSIVE_END*/
	
	





	
	/*------------------------------------Diamond Line New Customization----------------------------------------------------------*/
	
	 $rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 2")->next();
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


	
	/*------------------------------------Diamond Line New Customization End-------------------------------------------------*/
	
	
	
	/*Change chat time from console DIAMOND LINE*/
	
		$time_date_diamond = getConfig(CUSTOM_CFG_CHAT_HOURS_DIAMOND); 
		//$time_date_diamond = getConfig(CUSTOM_CFG_DIAMOND_LINE);   
		

		$x = explode("/",$time_date_diamond);
		$y = explode("-",$x[0]);
		$z = explode("-",$x[1]);
		$start_time_diamond = $y[0];
		if($start_time_diamond<12){
		$meridian3 = "AM";
		}else{
		$meridian3 = "PM";
		}
		$end_time_diamond = $y[1];
		if($end_time_diamond<12){
		$meridian4 = "AM";
		}
		/*else if($end_time_diamond=24){
		$meridian4 = "AM";
		}*/
		else{
			if($end_time_diamond==24)
				{
					$meridian4 = "AM";
				}
			else
				{
					$meridian4 = "PM"; 
				}
		}
		$start_day_diamond = $z[0];
		$end_day_diamond = $z[1]; 
		$new_start_time_diamond = $this->time24to12($start_time_diamond);
		$new_end_time_diamond = $this->time24to12($end_time_diamond);
		$new_start_day_diamond = $this->number_day($start_day_diamond);
		$new_end_day_diamond = $this->number_day($end_day_diamond);
		
		

		
		
		
		


		$this->js['meridian3'] = $meridian3;
		$this->js['meridian4'] = $meridian4;
		$this->js['start_time_diamond'] = $new_start_time_diamond;
		$this->js['end_time_diamond'] = $new_end_time_diamond;
		$this->js['start_day_diamond'] = $new_start_day_diamond;
		$this->js['end_day_diamond'] = $new_end_day_diamond;
		
		
	/*Change chat time from console DIAMOND LINE_END*/	
	
	
	
	
	
	 	$this->data['chatHours'] = $this->CI->model('Chat')->getChatHours()->result; 
        $this->data['show_hours'] = !$this->data['chatHours']['inWorkHours'];

        //return parent::getData();

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
		    0 => 'Dimanche',
			1 => 'Lundi',
			2 => 'Mardi',
			3 => 'Mercredi',
			4 => 'Jeudi',
			5 => 'Vendredi',
			6 => 'Samedi'
			
		);
		return $days[$num];	
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