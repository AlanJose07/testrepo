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
		 "29-1700"=>"SPANISH-My-Shakeology",
		 "29-1701"=>"SPANISH-My-Beachbody-On-Demand",
		 "29-1702"=>"SPANISH-All-Orders",
		 "29-1703"=>"SPANISH-My-Account",
		 "29-1704"=>"SPANISH-My-Coach-Business",
		 "29-1705"=>"SPANISH-Product-and-General-Information",
		 "29-1706"=>"SPANISH-BB-LIVE!-Instructor",
		 "29-2067"=>"SPANISH-Make-a-Purchase",
		 "29-2069"=>"SPANISH-Technical-Support",
		 "29-2594"=>"SPANISH-Apparel",
		 "29-2660"=>"SPANISH-BODgroups",
		 "29-3785"=>"SPANISH-BODi",
		 "29-3784"=>"SPANISH-MYX",
		 "29-4137"=>"SPANISH-GrowthDay",
		 "29-4138"=>"SPANISH-BODi (Beachbody on Demand)"


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