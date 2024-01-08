<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Connect,
RightNow\Connect\v1_2 as RNCPHP,
RightNow\Connect\v1_2\CO as RNCPHP_CO,
RightNow\Utils\Config;

class SpanishChatHour extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
//---------------------SPANISH CHAT HOURS OF OPERATION-----------4/august/2017------------
	
	 $rmaSpanishChat = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 6")->next();
	 $rmaSpanish = $rmaSpanishChat->next();
	
	
	/*Hour for each day*/
	

		$monday = $rmaSpanish->Mon_Hours; 
		$tuesday = $rmaSpanish->Tue_Hours;
		$wednesday = $rmaSpanish->Wed_Hours;
		$thursday = $rmaSpanish->Thu_Hours;
		$friday = $rmaSpanish->Fri_Hours;
		$saturday = $rmaSpanish->Sat_Hours;
		$sunday = $rmaSpanish->Sun_Hours;



		/*enabled/disabled for each day*/
		$monday_enabled = $rmaSpanish->Mon_Enabled;
		$tuesday_enabled = $rmaSpanish->Tue_Enabled;
		$wednesday_enabled = $rmaSpanish->Wed_Enabled;
		$thursday_enabled = $rmaSpanish->Thu_Enabled;
		$friday_enabled = $rmaSpanish->Fri_Enabled;
		$saturday_enabled = $rmaSpanish->Sat_Enabled;
		$sunday_enabled = $rmaSpanish->Sun_Enabled;
		$title = $rmaSpanish->Title;
	
		
		
	/*creating a multidimentional array to store all the values	*/
$keyy = NULL;		
$hours=array("1"=>$monday,"2"=>$tuesday,"3"=>$wednesday,"4"=>$thursday,"5"=>$friday,"6"=>$saturday,"7"=>$sunday);
$enabled=array("1"=>$monday_enabled,"2"=>$tuesday_enabled,"3"=>$wednesday_enabled,"4"=>$thursday_enabled,"5"=>$friday_enabled,"6"=>$saturday_enabled,"7"=>$sunday_enabled);

$this->data['spanish_hours'] = $hours;
$this->data['spanish_enabled'] = $enabled;
	
	
	//---------------------SPANISH CHAT HOURS OF OPERATION-----------4/august/2017  end-------
	
	
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
	
	
	
}