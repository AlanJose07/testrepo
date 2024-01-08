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
		 "30-1700"=>"FRENCH-My-Shakeology",
		 "30-1701"=>"FRENCH-My-Beachbody-On-Demand",
		 "30-1702"=>"FRENCH-All-Orders",
		 "30-1703"=>"FRENCH-My-Account",
		 "30-1704"=>"FRENCH-My-Coach-Business",
		 "30-1705"=>"FRENCH-Product-and-General-Information",
		 "30-1706"=>"FRENCH-BB-LIVE!-Instructor",
		 "30-2067"=>"FRENCH-Make-a-Purchase",
		 "30-2069"=>"FRENCH-Technical-Support",
		 "30-2594"=>"FRENCH-Apparel",
		 "30-2660"=>"FRENCH-BODgroups",
		 "30-3785"=>"FRENCH-BODi",
		 "30-3784"=>"FRENCH-MYX",
		 "30-4137"=>"FRENCH-GrowthDay",
		 "30-4138"=>"FRENCH-BODi (Beachbody on Demand)"

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