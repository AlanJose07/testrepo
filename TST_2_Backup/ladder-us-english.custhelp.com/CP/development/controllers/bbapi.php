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
					'https://beachbodyopa.custhelp.com','https://localhost'
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
        
        $url = "https://ebs.prod.gateway.beachbody.com/getCustomerOrders";
        
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:'.$guid,
													'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG',
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
					'https://beachbodyopa.custhelp.com','https://localhost'
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
        $url = "https://address.prod.gateway.beachbody.com/validation?".$_SERVER['argv'][0];
        
        
		$ch = curl_init($url);
		//post call
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:1234',
													'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG',
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
					'https://beachbodyopa.custhelp.com','https://localhost'
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
	
	
	/*Function get customer and coach BYD ID's 
	*/
	function getBydesignIDS($inguid)
	{
		load_curl(); 
			    $url = \RightNow\Utils\Config::getConfig(1000069);  //CUSTOM_CFG_GET_AWS_IDM_DETAILS
				$key = \RightNow\Utils\Config::getConfig(1000068);	//CUSTOM_CFG_AWS_API_KEY  
				$payload= '{"searchFilterName": "email","searchFilterValue": "'. $this->session->getProfile()->email->value .'"}';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
								'api-key: AGENT:US:1234',
								'x-api-key: '.$key,
								'Content-Type: application/json'));
				//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$resp = json_decode(curl_exec($ch));
				if(curl_errno($ch)){
				throw new Exception(curl_error($ch));
				}
				 curl_close($ch);
				logmessage($resp);
				logmessage($url);
					$guid = $resp->searchUser->guid;
					$coachId=$resp->searchUser->gncCoachID; 
					$role = $resp->searchUser->customerType;	
					$gncCustomerID =$resp->searchUser->gncCustomerID;
					$sponsorID  = $resp->searchUser->sponsorREPID;		
		if($inguid <> $guid )
		{
			exit;
		}
		if(!empty($coachId))
		{
			$ret_xml = '<GNCID><GNCCoachID>'. $coachId .'</GNCCoachID></GNCID><GNCSponsorID>'. $sponsorID .'</GNCSponsorID>';
		}
		else{
		$ret_xml = '<GNCID><GNCCustomerID>'. $gncCustomerID .'</GNCCustomerID></GNCID><GNCSponsorID>'. $sponsorID .'</GNCSponsorID>';
		}
				  
	    return $ret_xml;
	}
	
	
	/*Function for calling callRTOI
	*/
	function callRTOI()

	{
			if (\RightNow\Utils\Framework::isLoggedIn()) 		
		
		{		
				$session_count = $this->session->getSessionData('bbsession_count');	
				logmessage($session_count);
				if(empty($session_count) || is_null($session_count) || !isset($session_count))
				{
					$session_count =1;
				}else{
					$session_count = $session_count+1;
				}
				if($session_count > 3)
				{
					exit;
				}else{
					$this->session->setSessionData(array('bbsession_count' => $session_count));
				}
				logmessage($session_count);
				$soapUser="uadproduser";
				$soapPassword="R3sh1p5U@9";	
				
				$request_xml=file_get_contents('php://input');
				$arr = array();
				$xml_parser = xml_parser_create();
				xml_parse_into_struct($xml_parser, $request_xml, $arr);
				xml_parser_free($xml_parser);
				$guid = $arr[8]['value'];
				$ordtype = $arr[1]['value'];
				$emailarr = $arr[23]['attributes'];
				
				try
				{
					$byIDxml= $this->getBydesignIDS($guid);
					if(strtoupper($emailarr["VALUE"]) <> strtoupper($this->session->getProfile()->email->value)){
					
								exit;
						}
				if($ordtype == "SSE STARTHD")
				{
				$inspos = strpos($request_xml,'</CustomerType>')+15;
				$part1 = substr($request_xml,0,$inspos);
				$part2 = substr($request_xml,$inspos);
				$request_xml1 = $part1. $byIDxml . $part2;
				logmessage($request_xml1);
				try
				{
					
				//load_curl(); 
				$url = 'https://transport.beachbody.com/api/soap/orderimport';
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
				curl_setopt($ch, CURLOPT_URL,$url); 
				// Set header supression
				//curl_setopt($ch, CURLOPT_HEADER,0); 
				// Disable SSL peer verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_POST,           true );            
				curl_setopt($ch, CURLOPT_POSTFIELDS,     $request_xml1); 
				curl_setopt($ch, CURLOPT_VERBOSE, TRUE); 
				// Indicate that the message should be returned to a variable
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// Make request
				$response = curl_exec($ch); 
				//$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				// print_r("response is ".$response);
				logmessage($response);
				
			
				$arr = array();
				$xml_parser = xml_parser_create();
				xml_parse_into_struct($xml_parser, $response, $arr);
				xml_parser_free($xml_parser);

				//echo "-----<pre>";
				//var_dump($arr[10]["value"]);


				 if (curl_errno($ch)) 
				{ 
					
					logmessage( "Error: " . curl_error($ch)); 
					echo "Error: " . curl_error($ch);
					exit;
				} 
				else 
				{   echo $response;
					curl_close($ch); 
				}
				}
				catch (Exception $e)
				{
					logmessage("exception is ".$e->getMessage());
					echo "exception is ".$e->getMessage();
				}
				}
				}catch (Exception $e)
				{
					logmessage("exception is ".$e->getMessage());
					echo "exception is ".$e->getMessage();
				}
		}
				
	}
	
	/*
	Function for calling GetDefaultCard
	*/
	function getDefaultCard()

	{
		$http_origin = $_SERVER['HTTP_ORIGIN'];

		$allowed_domains = array(
			'https://beachbodyopa.custhelp.com','https://localhost'
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
			//$guid = "CFADA451-FEC3-4BCF-89C1-1D70F6EE4515";$_GET["GUID"]="CFADA451-FEC3-4BCF-89C1-1D70F6EE4515";
			if($_GET["GUID"] === $guid){
				$request_json=file_get_contents('php://input');
				load_curl();
		
				$url = "https://tbb.prod.gateway.beachbody.com/manageCards?GUID=".$_GET["GUID"];
		        
				$ch = curl_init($url);
				//post call
		        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
													'api-key: AGENT:US:'.$guid,
													'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG',
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