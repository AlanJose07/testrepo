<?php
namespace Custom\Widgets\input;
use RightNow\Utils\Url,
    RightNow\Utils\Text,
	RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Utils\Config;
	

class CategoryRadio extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

      
	
        //Add in the all values label
      
		
		//$msg = getConfig(CUSTOM_CFG_CATEGORIES);
		$CI = get_instance();
		 $all_param = $CI->session->getSessionData('urlParameters');
   $all_parameters= array();
	foreach($all_param as $array) {
 	foreach($array as $k=>$v) {
    $all_parameters[$k][] = $v;
 	   }
	   }	
		
	if(array_key_exists('tailNumber', $all_parameters))
	{
		if(is_array($all_parameters['tailNumber']))
		{
			$tailNumber = end($all_parameters['tailNumber']);
		}
		else
		{
		$tailNumber = $all_parameters['tailNumber'];
		}
	}
	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];

		if($flgtNo=="CPA")
		$msg = RNCPHP\MessageBase::fetch(1000009);
		else
	   $msg = RNCPHP\MessageBase::fetch(1000001);
		$catg=$msg->Value;
		$exclude_cat=explode(",",$catg);
		$cat_ids=$exclude_cat;
		$len=sizeof($cat_ids);
		$categories = array();
		for($i=0;$i< $len;$i++)
		{
		
		
			$roql_result = RNCPHP\ROQL::query( "SELECT ServiceCategory.LookupName from ServiceCategory where ServiceCategory.ID = '" . $cat_ids[$i] . "'" )->next();
			
			while($label =$roql_result->next())
			{
		 	
				$categories[$cat_ids[$i]] = $label['LookupName'];
			 	
			}
		
		
		}
		$this->data['cat']=$categories;
		
		$this->data['js']['radioitems_count'] = $len;
			
		/*foreach ($defaultHierMap[0] as $items)
		{
			if (!in_array($items[id], $cat_ids))
 			{
 				 unset($items);
  			}
  			else
  			{
 				array_push($cat,$items);
  			}
		}
		
		$defaultHierMap[0] = $cat;	
		 
	  $this->data['displayType']='Radio';
	  
	  $i=0;
	  foreach ($defaultHierMap[0] as $value)
	  {
	  	$this->data['radioLabel'][$i] = $value;
	    $i++;
	  }
	  
	 
	   $this->data['js']['radioitems_count']  = count($defaultHierMap[0]);
	  $this->data['js']['hierData'] = $defaultHierMap;
    */

    
    

      // parent::getData();

    

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}