<?php
namespace Custom\Widgets\ResponsiveDesign;

class PhoneHourDetails extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
		$TLP=explode(".",trim(getUrlParm('TLP')));
		
		$interface= $this->data['attrs']['interface'];
		$call_hours=array(
		 "1-1700"=>"US-My-Shakeology",
		 "1-1701"=>"US-My-Beachbody-On-Demand",
		 "1-1702"=>"US-All-Orders",
		 "1-1703"=>"US-My-Account",
		 "1-1704"=>"US-My-Coach-Business",
		 "1-1705"=>"US-Product-and-General-Information",
		 "1-1706"=>"US-BB-LIVE!-Instructor",
		 "1-2067"=>"US-Make-a-Purchase",
		 "1-2069"=>"US-Technical-Support",
		 "1-2594"=>"US-Apparel",
		 "1-2660"=>"US-BODgroups",
		 "1-3785"=>"US-BODi",
		 "1-3784"=>"US-MYX",
		 "1-4137"=>"GrowthDay",
		 "1-4138"=>"BODi (Beachbody on Demand)"

		);
		
	
		$cat_id=trim(getUrlParm('catid'));
		
		if (!empty($cat_id))
		{
			$bblivecategory = $this->CI->model('custom/bbresponsive')->bblivecategory($cat_id);
			
				if($bblivecategory == 2)
				{
				 $TLP[0] = "1706";
				}	
		}
		
		$this->data['js']['display']=$call_hours[$interface."-".$TLP[0]];
		$i=0;
		foreach($call_hours as $key=>$value)
		{
		   if($key!=$interface."-".$TLP[0])  
		   {
		     $this->data['js']['notdisplay'][$i]=$call_hours[$key]; 
			 $i++;
		   }
		}
		
    }
}