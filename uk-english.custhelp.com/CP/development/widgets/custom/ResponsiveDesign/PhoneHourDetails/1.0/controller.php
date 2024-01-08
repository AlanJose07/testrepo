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
		 "3-1700"=>"UK-My-Shakeology",
		 "3-1701"=>"UK-My-Beachbody-On-Demand",
		 "3-1702"=>"UK-All-Orders",
		 "3-1703"=>"UK-My-Account",
		 "3-1704"=>"UK-My-Coach-Business",
		 "3-1705"=>"UK-Product-and-General-Information",
		 "3-1706"=>"UK-BB-LIVE!-Instructor",
		 "3-2067"=>"UK-Make-a-Purchase",
		 "3-2069"=>"UK-Technical-Support",
		 "3-2594"=>"UK-Apparel",
		 "3-2660"=>"UK-BODgroups",
		 "3-3785"=>"UK-BODi",
		 "3-3784"=>"UK-MYX",
		 "3-4137"=>"UK-GrowthDay",
		 "3-4138"=>"UK-BODi (Beachbody on Demand)"

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