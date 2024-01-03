<?php
namespace Custom\Models;
require_once(get_cfg_var("doc_root")."/include/ConnectPHP/Connect_init.phph");
initConnectAPI();
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;

class fetch_misc_url extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	
	function fetchUrl()
	{	
		try{
			$result = RNCPHP\ROQL::queryObject("SELECT linguistnow.Custom_misc_url FROM linguistnow.Custom_misc_url ORDER BY linguistnow.Custom_misc_url.DisplayPosition")->next();
			$miscUrlDetails = [];
			$i=0;
			if($result->count() == 0){
				return false;
			}
			while($details=$result->next())
			{
				$miscUrlDetails[$i]["url"]=$details->Url;
				$miscUrlDetails[$i]["display"]=$details->Display->LookupName;
				$miscUrlDetails[$i]["name"]=$details->UrlName;		
				$i++;	
			}
			return $miscUrlDetails;
			

		}
		catch (Exception $err){
			echo $err->getMessage();
		}   
		
		
		
	}
	
		
		
		
	
	
	
	
	

}
