<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Connect,
	RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO,
	RightNow\Utils\Config;

class SelectionInput extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
      // $this->data['hideEmptyOption'] = true; // null option in select is not needed in life time rank dropdown menu 
        parent::getData();
		$this->data['js']['isloggedin'] = "loggedout";
		if (\RightNow\Utils\Framework::isLoggedIn())
		{
		$this->data['js']['isloggedin']= "loggedin";
		}
		 
	/*------------------------------------Diamond Line New Customization----------------------------------------------------------*/
	
		$rmas = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 1")->next();
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

	$this->data['js']['check_day']= $flag; 
	

	//--Diamond line chat Hours end--
	
	$this->spanishchathour();
	
    }

    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
	
	
	function spanishchathour()
	{
	  $langDisplay = getConfig(CUSTOM_CFG_LANG_DISPLAY); //ON/OFF

	 $lang_display=0;//0--OFF 1-ON
	 $lang_display_spanish = 0;//0--not available  1-available
	 //*****************************Getting Hours of operation Language field
		$chatdetails = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 6")->next();
		$chatdetail = $chatdetails->next();  
	
	/*Hour for each day*/
	
		$monday_chat = $chatdetail->Mon_Hours; 
		$tuesday_chat = $chatdetail->Tue_Hours;
		$wednesday_chat = $chatdetail->Wed_Hours;
		$thursday_chat = $chatdetail->Thu_Hours;
		$friday_chat = $chatdetail->Fri_Hours;
		$saturday_chat = $chatdetail->Sat_Hours;
		$sunday_chat = $chatdetail->Sun_Hours;

		/*enabled/disabled for each day*/
		$monday_enabled_chat = $chatdetail->Mon_Enabled;
		$tuesday_enabled_chat = $chatdetail->Tue_Enabled;
		$wednesday_enabled_chat = $chatdetail->Wed_Enabled;
		$thursday_enabled_chat = $chatdetail->Thu_Enabled;
		$friday_enabled_chat = $chatdetail->Fri_Enabled;
		$saturday_enabled_chat = $chatdetail->Sat_Enabled;
		$sunday_enabled_chat = $chatdetail->Sun_Enabled;
		$title_chat = $chatdetail->Title;
		
		/*creating a multidimentional array to store all the values	*/
		$keyLang = NULL;		
		$hoursLang=array("1"=>$monday_chat,"2"=>$tuesday_chat,"3"=>$wednesday_chat,"4"=>$thursday_chat,"5"=>$friday_chat,"6"=>$saturday_chat,"7"=>$sunday_chat);
		$enabledLang=array("1"=>$monday_enabled_chat,"2"=>$tuesday_enabled_chat,"3"=>$wednesday_enabled_chat,"4"=>$thursday_enabled_chat,"5"=>$friday_enabled_chat,"6"=>$saturday_enabled_chat,"7"=>$sunday_enabled_chat);

		$current_time_lang = date('H:i'); //get current time in 24 hr format  
		
		$currentdatelang=getdate(date("U")); //get current date
		$current_day_number_chat = $this->get_day_number($currentdatelang['weekday']);//get current day number example- 7 for sunday, 1 for monday

		$available_hrs_lang = $hoursLang[$current_day_number_chat];//get available chat hours of current day
		$this->data["js"]["availablehours"] = $available_hrs_lang;

		$available_hrs_exploded = array_filter(explode(',',$available_hrs_lang));//explode multiple chat hours using ','

		$hours_count =  count($available_hrs_exploded);//get count of the exploded array
		
		if(  ($hours_count > 0) && ($langDisplay=="ON")  )
	{

		for($i=0;$i<sizeof($available_hrs_exploded);$i++)
		{

		$hours_time_limits = explode('-',$available_hrs_exploded[$i]);//explode a range of chat hours using '-'

		$hours_start_time = $hours_time_limits[0]; //get start time
		$hours_end_time = $hours_time_limits[1]; //get end time
		//if current time is in between the start or end time

			if(strtotime($current_time_lang)<= strtotime($hours_end_time) && strtotime($current_time_lang)>= strtotime($hours_start_time))
			{
				$lang_display_spanish = 1;//set the flag
				break;
			}
			

		}

	}
	if($langDisplay=="ON")
	{
		$lang_display = 1;
	}
	
	$this->data['js']['check_lang_display_chat']= $lang_display; //ON/OFF value based
	$this->data['js']['check_lang_display_spanish_chat']= $lang_display_spanish;//available time based
	
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