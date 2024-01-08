<?php

namespace Custom\Controllers;

use RightNow\Libraries\AbuseDetection,
RightNow\Utils\Config,
RightNow\Utils\Framework,
RightNow\Libraries\SEO,
RightNow\Connect\v1_4\ConnectAPI;


class bbAgentAPI extends \RightNow\Controllers\Base
{
	//This is the constructor for the custom controller. Do not modify anything within
	//this function.
	function __construct()
	{
		parent::__construct();
	}

	function validatetoken($token, $agentId)
	{

		try {
			load_curl();
			$url = "https://us-english.custhelp.com/cgi-bin/us_english.cfg/php/custom/validatetoken.php?token=" . $token;
			logmessage($url);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$response = curl_exec($ch);
			logmessage($response);
			if ($response == $agentId)
				return true;
			else {
				return false;
			}

		} catch (Exception $err) {
			echo $err->getMessage();
			echo "error";
		}
		curl_close($ch);

	}

	/*
					   Function for Creating Incident
				   */

	function createIncident()
	{

		header('Access-Control-Allow-Origin: *');

		$Body = file_get_contents('php://input');

		if ($Body) {
			$threadText = json_decode($Body)->InputParameters->threadText;
			$subject = json_decode($Body)->InputParameters->subject;
			$routing = json_decode($Body)->InputParameters->routing;
			$createdDay = json_decode($Body)->InputParameters->incidentCreatedDate;
			$token = json_decode($Body)->InputParameters->token;
			$agentID = json_decode($Body)->InputParameters->agentID;
			$iid = json_decode($Body)->InputParameters->IncidentID;
			if (empty($token) || !$this->validatetoken($token, $agentID)) {
				echo "Invalid access";
				exit();
			}

		} else {
			exit();
		}

		if (empty($threadText) && empty($subject) && empty($routing) && empty($createdDay)) {

			$missingparams = array('error' => 'missing params');
			echo json_encode($missingparams);
			exit();

		}

		//$threadText = "Test Data!!";
		//$subject = "Coach Cancellation Form";
		//$queue = "(T2F: US) Coach Cancel Process";
		//$routing = "Coach Cancellation Form";
		//$createdDay = "Wednesday";

		$response = $this->model('custom/bbmodal')->save_incident($threadText, $iid, $subject, $routing, $createdDay);

		echo ($response);

	}

	/*
				   Function for calling skuInfo
				   */
	function skuInfo()
	{
		$http_origin = $_SERVER['HTTP_ORIGIN'];

		$allowed_domains = array(
			'https://beachbodyopa--tst2.custhelp.com',
			'https://localhost:3000'
		);

		if (in_array(strtolower($http_origin), $allowed_domains)) {
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

		$Body = file_get_contents('php://input');
		if ($Body) {
			$locale = json_decode($Body)->InputParameters->locale;
			$skuId = json_decode($Body)->InputParameters->skuId;

		} else {
			exit();
		}
		load_curl();

		$url = "https://teambeachbody.com/rest/model/atg/commerce/catalog/ProductCatalogActor/skuInfo?locale=" . $locale . "&skuId=" . $skuId;
		logmessage($url);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$response = curl_exec($ch);
		logmessage($response);
		echo ($response);
		curl_close($ch);

	}

	//function for get order details api

	function getorder($orderid)
	{
		//$orderid = "STORE_463293531";


		// $http_origin = $_SERVER["HTTP_ORIGIN"];

		// $allowed_domains = [
		//     "https://beachbodyopa--tst2.custhelp.com",
		//     "http://localhost:8080",
		// 	'https://localhost:3000'
		// ];

		// if (in_array(strtolower($http_origin), $allowed_domains)) {
		//     //header("Access-Control-Allow-Origin: *");
		//     header("Access-Control-Allow-Origin: $http_origin");
		//     header("Access-Control-Allow-Credentials: true");
		//     header("Access-Control-Max-Age: 86400");
		//     header("Content-Type: application/json");
		// }
		// if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
		//     header("Access-Control-Allow-Methods: GET");
		//     header("Access-Control-Allow-Headers: api-key, Origin");
		//     header("Content-Type: application/json");
		//     exit(0);
		// }

		$http_origin = $_SERVER['HTTP_ORIGIN'];
		header("Access-Control-Allow-Origin: $http_origin");
		header("Access-Control-Allow-Methods: GET,POST");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');
		header('Content-Type: application/json');


		/*
			  $allowed_domains = array(
				  'https://beachbodyopa--tst1.custhelp.com','http://localhost:8080'
			  );

			  if (in_array(strtolower($http_origin), $allowed_domains))
			  {  
				  //header("Access-Control-Allow-Origin: *");
				  header("Access-Control-Allow-Origin: $http_origin");
				  header('Access-Control-Allow-Credentials: true');
				  header('Access-Control-Max-Age: 86400');
				  header('Content-Type: application/json');

			  }
			  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
				  header("Access-Control-Allow-Methods: GET");
					  header("Access-Control-Allow-Headers: api-key, Origin");
				  header('Content-Type: application/json');
				  header("Access-Control-Allow-Origin: *");
						  exit(0);
					  }
				  */
		load_curl();

		$curl = curl_init();
		$url = "https://stage.esi.beachbody.com/worklist/order/".$orderid;
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_VERBOSE => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'x-api-key: vhJQpB3TgK788BQRap14q8VQ7mEogmzj7MRixLb7'
				),
			)
		);

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
		logmessage($response);

	}


	function sendVendorEmail()
	{
		header('Access-Control-Allow-Origin: *');
		$Body = file_get_contents('php://input');
		if ($Body) {
			$vendor = json_decode($Body)->InputParameters->vendor;
			$orderNum = json_decode($Body)->InputParameters->orderNum;
			$token = json_decode($Body)->InputParameters->token;
			$agentID = json_decode($Body)->InputParameters->agentID;
			if (empty($token)) //|| !$this->validatetoken($token,$agentID))
			{
				echo "Invalid access";
				exit();
			}

		} else {
			exit();
		}

		if (empty($vendor) && empty($orderNum)) {

			$missingparams = array('error' => 'missing params');
			echo json_encode($missingparams);
			exit();

		}
		$sent = $this->model('custom/bbmodal')->sendemail($agentID, $vendor, $orderNum);
		if ($sent) {
			$response = array('status' => 'Success');
			echo json_encode($response);
		} else {
			$response = array('status' => 'failed');
			echo json_encode($response);
		}
		//$response = $this->sendemail($token,$agentID,$orderNum);//$this->model('custom/bbmodal')->sendemail($agentID,$vendor,$orderNum);

	}

	//function for get order details api

	function getorderstatus($orderNum)
	{
		//$orderid = "STORE_463293531";

		// $http_origin = $_SERVER["HTTP_ORIGIN"];

		// $allowed_domains = [
		//     "https://beachbodyopa--tst2.custhelp.com",
		//     "http://localhost:8080",
		// 	'https://localhost:3000'
		// ];

		// if (in_array(strtolower($http_origin), $allowed_domains)) {
		//     //header("Access-Control-Allow-Origin: *");
		//     header("Access-Control-Allow-Origin: $http_origin");
		//     header("Access-Control-Allow-Credentials: true");
		//     header("Access-Control-Max-Age: 86400");
		//     header("Content-Type: application/json");
		// }
		// if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
		//     header("Access-Control-Allow-Methods: GET");
		//     header("Access-Control-Allow-Headers: api-key, Origin");
		//     header("Content-Type: application/json");
		//     exit(0);
		// }

		$http_origin = $_SERVER['HTTP_ORIGIN'];
		header("Access-Control-Allow-Origin: $http_origin");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');
		header('Content-Type: application/json');

		if (!function_exists("\curl_init")) {
			\load_curl();
		}


		$curl = curl_init();
		$url_org = 'https://us-english--tst2.custhelp.com/services/rest/connect/v1.4/queryResults/?query=Select%20Tasks.ID%2CTasks.StatusWithType.Status.LookupName%20from%20Tasks%20where%20Tasks.CustomFields.c.order_number%20%3D%27STORE_454223%27';

		$space = "%20";
		$comma = "%2C";
		$equals = "%3D";
		$apostrophe = "%27";

		$url = 'https://us-english--tst2.custhelp.com/services/rest/connect/v1.4/queryResults/?query=Select' . $space . 'Tasks.ID' . $comma . 'Tasks.StatusWithType.Status.LookupName' . $space . 'from' . $space . 'Tasks' . $space . 'where' . $space . 'Tasks.CustomFields.c.order_number' . $space . $equals . $apostrophe . $orderNum . $apostrophe;
		//echo $url;
		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'OSvC-CREST-Application-Context: task',
					'Authorization: Basic QWxhbi1leHQ6UGFzc3dvcmQxMjM='
				),
			)
		);

		$response = curl_exec($curl);

		if ($errno = curl_errno($curl)) {
			$error_message = curl_strerror($errno);
			echo "cURL error ({$errno}):\n {$error_message}";

			echo "inside error";
			echo $error_message;

		}

		curl_close($curl);
		echo $response;
		logmessage($response);

	}


}