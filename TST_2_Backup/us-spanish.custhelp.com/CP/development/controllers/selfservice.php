<?php

namespace Custom\Controllers;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_4 as RNCPHP,
	RightNow\Connect\v1_4\CO as RNCPHP_CO;

	

class selfservice extends \RightNow\Controllers\Base
{
 function self_service(){
	  	/*echo "hi";
	  	$rows = RNCPHP\ROQL::query( "SELECT * FROM BB.categ_contac_hom_sp" )->next();
		$i=0;
		
		while($row = $rows->next())
		{
		
		//if($row['Self_Service_Form'] == 1 || $row['Self_Service_Form'] == 3){
			if(!empty($row['category'])){
		if(!empty($row['self_service_form_link'])){
		echo $row['ID']; echo " ";
		$selfservicedetails=explode("->",$row['self_service_form_link']);
		$id = RNCPHP\BB\categ_contac_hom_sp ::fetch($row['ID']);
		if(empty($selfservicedetails[0])) echo "Lijo";
		if(empty($selfservicedetails[1])) echo "Lijo1";
		if(empty($selfservicedetails[2])) echo "Lijo2";
		if(empty($selfservicedetails[3])) echo "Lijo3";
		if(!empty($selfservicedetails[0]))
		$id->self_service_title = $selfservicedetails[0];
		if(!empty($selfservicedetails[2]))
		$id->self_service_description = $selfservicedetails[2];
		if(!empty($selfservicedetails[3]))
		$id->self_service_icon = $selfservicedetails[3];
		if(!empty($selfservicedetails[1]))
		$id->self_service_url = $selfservicedetails[1];
		$id->save(RNCPHP\RNObject::SuppressAll);
		$i++;
		}
		//}
		}
			//$result[$i]['Title'] = $row['title'];
		}	
		echo "final".$i;
	  }

 
}

