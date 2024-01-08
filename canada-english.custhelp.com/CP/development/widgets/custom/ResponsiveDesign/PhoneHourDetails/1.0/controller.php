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
		 "2-1700"=>"CANADA-My-Shakeology",
		 "2-1701"=>"CANADA-My-Beachbody-On-Demand",
		 "2-1702"=>"CANADA-All-Orders",
		 "2-1703"=>"CANADA-My-Account",
		 "2-1704"=>"CANADA-My-Coach-Business",
		 "2-1705"=>"CANADA-Product-and-General-Information",
		 "2-1706"=>"CANADA-BB-LIVE!-Instructor",
		 "2-2067"=>"CANADA-Make-a-Purchase",
		 "2-2069"=>"CANADA-Technical-Support",
		 "2-2594"=>"CANADA-Apparel",
		 "2-2660"=>"CANADA-BODgroups",
		 "2-3785"=>"CANADA-BODi",
		 "2-3784"=>"CANADA-MYX",
		 "2-4137"=>"CANADA-GrowthDay",
		 "2-4138"=>"CANADA-BODi (Beachbody on Demand)"

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