<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;
	

class awstest extends \RightNow\Controllers\Base

{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
	 
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }

    /*
	Function for calling getAllItemsForCountry
	*/
	function validateaccess()

	{
		$request_json=file_get_contents('php://input');
		$apiUser=\RightNow\Utils\Config::getConfig(1000042);
		$apiPassword=\RightNow\Utils\Config::getConfig(1000043);
				load_curl();
        
        $url = "https://identity.prod.gateway.beachbody.com/search?email=kanantharaman@beachbody.com";
            
			
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG"));
        //curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $request_json);
		curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
      
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch); 
        echo($response);
        curl_close($ch);
		 
	}
}