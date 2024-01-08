<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;
	

class bbapi extends \RightNow\Controllers\Base

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
	Function for calling getCustomerOrders
	*/
	function getCustomerOrders()

	{
						$http_origin = $_SERVER['HTTP_ORIGIN'];

				$allowed_domains = array(
					'https://beachbodyopa--tst2.custhelp.com','https://localhost'
				);

				if (in_array(strtolower($http_origin), $allowed_domains))
				{  
					// header("Access-Control-Allow-Origin: *");
					header("Access-Control-Allow-Origin: $http_origin");
					header('Access-Control-Allow-Credentials: true');
					header('Access-Control-Max-Age: 86400');
				}
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: api-key, Content-Type, Origin");
				exit(0);
				}


		if (\RightNow\Utils\Framework::isLoggedIn()) 		
		
		{	
		$CI = get_instance();//get codeIgniter instance
		$guid = $CI->session->getSessionData("guid");
		//$guid = "2CC4760E-0631-4BFE-80F9-741B6A32951A";
		$request_json=file_get_contents('php://input');
		//$request_json='{"InputParameters":{"P_COUNTRY":"US","P_CALLING_MODULE":"UAD","P_CALLING_EBS_USER":"ISGUSER1","P_EMAIL_ADDRESS":"","P_ATTRIBUTE1":"","P_ATTRIBUTE2":"12/9/2020","P_ATTRIBUTE3":"","P_ATTRIBUTE4":"","P_ATTRIBUTE5":"","P_GUID":"2CC4760E-0631-4BFE-80F9-741B6A32951A"}}';
		$reqjson = json_decode($request_json);
		logmessage("request guid:".$reqjson->InputParameters->P_GUID);
		$reqjson->InputParameters->P_CALLING_MODULE = "OPA";
		$reqjson->InputParameters->P_CALLING_EBS_USER = "ISGUSER";
		$request_json = json_encode($reqjson);
		//echo "<pre>";
		//print_r($request_json);
		if(($reqjson->InputParameters->P_GUID == $guid) and empty($reqjson->InputParameters->P_EMAIL_ADDRESS))
		{
		logmessage("session guid:".$guid);
				load_curl();
        
        $url = "https://ebs.stage.gateway.beachbody.com/getCustomerOrders";
        
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:'.$guid,
													'x-api-key: imjhZMCMJb6m6i0kw5rU1YwkocSmrvQ7oFtWI6j0',
													'Content-Type: application/json',
													'id_token: 1234',
													'access_token: 1234'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_json);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch); 
        $outresponse =array("OutputParameters" =>json_decode($response));
		logmessage(json_encode($outresponse));
        echo(json_encode($outresponse));
        curl_close($ch);
		}
		 }
	}
	
	
	/*
	Function for calling address verification
	*/
	function addressvalidation()

	{
						$http_origin = $_SERVER['HTTP_ORIGIN'];

				$allowed_domains = array(
					'https://beachbodyopa--tst2.custhelp.com','https://localhost'
				);

				if (in_array(strtolower($http_origin), $allowed_domains))
				{  
					// header("Access-Control-Allow-Origin: *");
					header("Access-Control-Allow-Origin: $http_origin");
					header('Access-Control-Allow-Credentials: true');
					header('Access-Control-Max-Age: 86400');
				}
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: api-key, Content-Type, Origin");
				exit(0);
				}


		if (\RightNow\Utils\Framework::isLoggedIn()) 		
		
		{	
		
				load_curl();
        logmessage($_SERVER['argv']);
     
		$url = "https://address.stage.gateway.beachbody.com/validation?".$_SERVER['argv'][0];
        
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:1234',
													'x-api-key: imjhZMCMJb6m6i0kw5rU1YwkocSmrvQ7oFtWI6j0',
													'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch); 
        echo($response);
        curl_close($ch);
		 }
	}
	
	/*
	Function for calling getAllItemsForCountry
	*/
	function getAllItemsForCountry()

	{
						$http_origin = $_SERVER['HTTP_ORIGIN'];

				$allowed_domains = array(
					'https://beachbodyopa--tst2.custhelp.com','https://localhost'
				);

				if (in_array(strtolower($http_origin), $allowed_domains))
				{  
					// header("Access-Control-Allow-Origin: *");
					header("Access-Control-Allow-Origin: $http_origin");
					header('Access-Control-Allow-Credentials: true');
					header('Access-Control-Max-Age: 86400');
				}
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: api-key, Content-Type, Origin");
				exit(0);
				}


		if (\RightNow\Utils\Framework::isLoggedIn()) 		
		
		{	
		$request_json=file_get_contents('php://input');
		$apiUser=\RightNow\Utils\Config::getConfig(1000042);
		$apiPassword=\RightNow\Utils\Config::getConfig(1000043);
				load_curl();
        
        $url = "https://apim.beachbody.com:8443/api/v1/atg/getAllItemsForCountry?";
        
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_USERPWD, $apiUser.":".$apiPassword);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_json);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch); 
        echo($response);
        curl_close($ch);
		 }
	}
	
	/*
	Function for calling GetDefaultCard
	*/
	function getDefaultCard()

	{
		$http_origin = $_SERVER['HTTP_ORIGIN'];

		$allowed_domains = array(
			'https://beachbodyopa--tst2.custhelp.com','https://localhost'
		);

		if (in_array(strtolower($http_origin), $allowed_domains))
		{  
			//header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Origin: $http_origin");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    		header("Access-Control-Allow-Methods: GET");
   			header("Access-Control-Allow-Headers: api-key, Content-Type, Origin");
			exit(0);
		}

		if (\RightNow\Utils\Framework::isLoggedIn()) 		
		{
			$CI = get_instance();
			$guid = $CI->session->getSessionData("guid");
			if($_GET["GUID"] === $guid){
				$request_json=file_get_contents('php://input');
				load_curl();
		
		        $url = "https://tbb.stage.gateway.beachbody.com/manageCards?GUID=".$_GET["GUID"];
		        
				$ch = curl_init($url);
				//post call
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:'.$guid,
													'x-api-key: imjhZMCMJb6m6i0kw5rU1YwkocSmrvQ7oFtWI6j0',
													'Content-Type: application/json',
													'id_token: 1234',
													'access_token: 1234',
													'GUID:'.$guid));
		        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		        $response = json_decode(curl_exec($ch));
		        echo($response->creditCardNumber);
		        curl_close($ch);
		    }
		 }
	}
	
	
}