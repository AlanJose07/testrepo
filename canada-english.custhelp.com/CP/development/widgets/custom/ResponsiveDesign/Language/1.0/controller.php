<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Connect,
RightNow\Connect\v1_2 as RNCPHP,
RightNow\Connect\v1_2\CO as RNCPHP_CO,
RightNow\Utils\Config;

class Language extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
		//---------------LANGUAGE FIELD SETTING BASED ON HOURS OF OPERATION---4/3/2018--
	 
	 $langDisplay = getConfig(CUSTOM_CFG_FRENCH_LANG); //ON/OFF
	 $prefResLangDisplay = getConfig(CUSTOM_CFG_PREF_RES_LANG_CANADA);// preferred response language--> enable or disable //by jithin
     $this->data['js']['prefResLangDisplay']= $prefResLangDisplay; //ON/OFF value based

	 $lang_display=0;//0--OFF 1-ON
	 $lang_display_spanish = 0;//0--not available  1-available  
	
		//*****************************Getting Hours of operation Language field
		$rmasLang = RNCPHP\ROQL::queryObject("SELECT CO.CustomChatHours FROM CO.CustomChatHours WHERE CO.CustomChatHours.ID = 9")->next();
		$rmaLang = $rmasLang->next();
	
	
	
	
	
	/*Hour for each day*/
	
		$monday = $rmaLang->Mon_Hours; 
		$tuesday = $rmaLang->Tue_Hours;
		$wednesday = $rmaLang->Wed_Hours;
		$thursday = $rmaLang->Thu_Hours;
		$friday = $rmaLang->Fri_Hours;
		$saturday = $rmaLang->Sat_Hours;
		$sunday = $rmaLang->Sun_Hours;



	
		/*enabled/disabled for each day*/
		$monday_enabled = $rmaLang->Mon_Enabled;
		$tuesday_enabled = $rmaLang->Tue_Enabled;
		$wednesday_enabled = $rmaLang->Wed_Enabled;
		$thursday_enabled = $rmaLang->Thu_Enabled;
		$friday_enabled = $rmaLang->Fri_Enabled;
		$saturday_enabled = $rmaLang->Sat_Enabled;
		$sunday_enabled = $rmaLang->Sun_Enabled;
		$title = $rmaLang->Title;
	
		
		
		/*creating a multidimentional array to store all the values	*/
		$keyLang = NULL;		
		$hoursLang=array("1"=>$monday,"2"=>$tuesday,"3"=>$wednesday,"4"=>$thursday,"5"=>$friday,"6"=>$saturday,"7"=>$sunday);
		$enabledLang=array("1"=>$monday_enabled,"2"=>$tuesday_enabled,"3"=>$wednesday_enabled,"4"=>$thursday_enabled,"5"=>$friday_enabled,"6"=>$saturday_enabled,"7"=>$sunday_enabled);

		$this->data['array1'] = $hoursLang;
		$this->data['array2'] = $enabledLang;




		$current_time_lang = date('H:i'); //get current time in 24 hr format


		$currentdatelang=getdate(date("U")); //get current date
		$current_day_number = $this->get_day_number($currentdatelang['weekday']);//get current day number example- 7 for sunday, 1 for monday

		$available_hrs_lang = $hoursLang[$current_day_number];//get available chat hours of current day
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
	
	

	$this->data['js']['check_lang_display']= $lang_display; //ON/OFF value based
	$this->data['js']['check_lang_display_spanish']= $lang_display_spanish;//available time based
		//*****************************
	
	
	 //---------------LANGUAGE FIELD SETTING BASED ON HOURS OF OPERATION--END ---
		
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

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
     protected function getMenuItems()
	 {
	    
		$interface = $this->data['attrs']['interface'];
		
	 
	   if($this->fieldName === 'language_shk')
		{
		       
		        
				$field = explode('.', $this->data['inputName']);
				$object = array_shift($field);
				$items = Connect::getNamedValues($object, implode('.', $field));
				  
				if($items)
				{
						$count = count($items);
						
						foreach ($items as $item)
						{
						       
								if($item->ID != 1183 and $interface==1)//US interface
								{
									$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								else if($item->ID != 1184 and $interface==2)//CANADA interface
								{
								    $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								else if($item->ID != 1183 and $item->ID != 1184 and $interface==3)//UK interface
								{
								    $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								
						}
				}
				return $menuItems;	   
		}
	 }
    // protected function isValidSla($slaInstance)
}