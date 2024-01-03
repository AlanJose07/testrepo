<?php
namespace Custom\Models;
require_once(get_cfg_var("doc_root")."/include/ConnectPHP/Connect_init.phph");
initConnectAPI();
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;

class fetch_Toaster_url extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	
	function fetchUrl()
	{	   
		$roql_result = RNCPHP\ROQL::queryObject("SELECT CO.Custom_toaster_url FROM CO.Custom_toaster_url order By CO.Custom_toaster_url.DisplayPosition")->next();
		$urlDetails = [];
		$i=0;
		while($detals=$roql_result->next())
		{
			$urlDetails[$i]["url"]=$detals->Url;
			$urlDetails[$i]["display"]=$detals->Display->LookupName;
			$urlDetails[$i]["name"]=$detals->UrlName;	
			
			$i++;
			
		}
		
		return $urlDetails;
		
	}
	
		
		
		
	
	
	
	
	

}
