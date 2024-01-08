<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Utils\Text,
	RightNow\Libraries\ResponseObject,
	RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Libraries\SEO;
	

class Nice extends \RightNow\Controllers\Base
{

	function CustomerLookupinEBS()
	{
		$allowed_ip = array(
				'52.43.225.203','52.89.35.204','207.166.82.200','207.166.82.201','52.43.225.203','52.89.35.204','35.162.209.56','52.36.162.79','207.166.82.128',
'207.166.82.129','207.166.82.130','207.166.82.131','207.166.82.132','207.166.82.133','207.166.82.134','207.166.82.135','207.166.82.136','207.166.82.137','207.166.82.138','207.166.82.139','207.166.82.140','207.166.82.141','207.166.82.142','207.166.82.143','207.166.82.144',
'207.166.82.145','207.166.82.146','207.166.82.147','207.166.82.148','207.166.82.149','207.166.82.150','207.166.82.151','207.166.82.152','207.166.82.153','207.166.82.154','207.166.82.155','207.166.82.156','207.166.82.157','207.166.82.158','207.166.82.159','207.166.82.160',
'207.166.82.161','207.166.82.162','207.166.82.163','207.166.82.164','207.166.82.165','207.166.82.166','207.166.82.167','207.166.82.168','207.166.82.169','207.166.82.170','207.166.82.171','207.166.82.172','207.166.82.173','207.166.82.174','207.166.82.175','207.166.82.176',
'207.166.82.177','207.166.82.178','207.166.82.179','207.166.82.180','207.166.82.181','207.166.82.182','207.166.82.183','207.166.82.184','207.166.82.185','207.166.82.186','207.166.82.187','207.166.82.188','207.166.82.189','207.166.82.190','207.166.82.191');
		
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $clientip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $clientip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $clientip=$_SERVER['REMOTE_ADDR'];
			}
		
			/*if(!in_array($clientip,$allowed_ip))
				{
						try
							{

								
								
										$log= new RNCPHP\ORN_NiceLog\Nice_Error_Log();
										$log->Incident           = 1;
										$log->ReportName         = "NiceController";
										$log->Remarks            = date("Y-m-d H:i:s") . " " . $clientip  . " " . $_REQUEST['query'];			
										$log->save();
								   RNCPHP\ConnectAPI::commit();
							}
							catch(Exception $e)
							{
							$tmp=0;
							}
					$NiceContact['items'][0]['tableName'] = 'contacts';
					$NiceContact['items'][0]['count'] = 0;
					$NiceContact['items'][0]['columnNames'][0] = 'id';
					$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
					$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
					$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
					$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
					$NiceContact['items'][0]['columnNames'][5] = 'contactType';
					$NiceContact['items'][0]['columnNames'][6] = 'guid';
					$NiceContact['items'][0]['columnNames'][7] = 'lookupName';
					$NiceContact['links'][0]['rel'] = 'self';
					$NiceContact['links'][0]['href'] = $url;
					
					$NiceContact['links'][1]['rel'] = 'canonical';
					$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
					$NiceContact['links'][2]['rel'] = 'describedby';
					$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
					$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
					
					$NiceContact['items'][0]['rows'] = [];
					
					header("Content-type:application/json");
					echo json_encode($NiceContact);
					exit();
				}*/


		try
		{
	
			$query =  $_REQUEST['query'];
			$url = "https://faq.beachbody.com/services/rest/connect/v1.3/queryResults?query=".$query.";"; 
			//echo substr($phone, strrpos($phone, 'LIKE' )+4)."\n";
			$phone = explode("LIKE", $query);
			$phone = trim($phone[1]);
			$phone = str_replace(";","",$phone);
			$firstCharacterPhone = substr($phone, 0, 1);
			$secondCharacterPhone = substr($phone, 0, 2);
			
			//echo $P_PHONE_COUNTRY_CODE. " ". $P_PHONE_AREA_CODE. " ".$P_PHONE_NUMBER ;
			
			$queryResult = RNCPHP\ROQL::query("SELECT Contact.CustomFields.c.last_four_cc,Contact.CustomFields.c.coach_id,Contact.CustomFields.c.customer_guid,Contact.Address.PostalCode,Contact.Address.Country.LookupName as Country,* FROM Contact where Contact.Phones.Number = '".$phone."' and Contact.Phones.PhoneType.ID in ( 4, 0) and Contact.CustomFields.c.customer_guid != 'No Value' order by Contact.CustomFields.c.coach_id desc")->next();
			$active = 0;
			$coach = 1; 
			while($contact=$queryResult->next()){
			$count++;
			if($contact['Customer'] == 1){ // if it is a coach
				$coach = 2;
				if(!empty($contact['last_four_cc']) && $active == 0){
					$active = 1;
				}
			}else{
				if($coach != 2)
					$active = 1;	
			}	
			$contactarray[] = $contact;	
			}
			if($count>0 && $active == 1)
			{
			
				foreach ($contactarray as $key => $row) {
					$ID[$key]  = $row['ID'];
					$coach_id[$key] = $row['coach_id'];
				}
			$ID  = array_column($contactarray, 'ID');
			$coach_id = array_column($contactarray, 'coach_id');
			array_multisort($coach_id, SORT_DESC, $ID, SORT_DESC, $contactarray);
			$contactarray = array_map("unserialize", array_unique(array_map("serialize", $contactarray)));
			//echo "<pre>";
			//print_r($contactarray);
			$row = 0;
			//print_r($contactarray);
				foreach($contactarray as $key=>$value)
				{
				
						$NiceContact['items'][0]['tableName'] = 'contacts';
						$NiceContact['items'][0]['count'] = count($contactarray);
						$NiceContact['items'][0]['columnNames'][0] = 'id';
						$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
						$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
						$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
						$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
						$NiceContact['items'][0]['columnNames'][5] = 'guid';
						$NiceContact['items'][0]['columnNames'][6] = 'lookupName';
						$NiceContact['items'][0]['columnNames'][7] = 'contactType';
						$NiceContact['links'][0]['rel'] = 'self';
						$NiceContact['links'][0]['href'] = $url;
						
						$NiceContact['links'][1]['rel'] = 'canonical';
						$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
						$NiceContact['links'][2]['rel'] = 'describedby';
						$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
						$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
						
						$NiceContact['items'][0]['rows'][$row][0] = (int) $value['ID'];
						$NiceContact['items'][0]['rows'][$row][1] = $value['LookupName'];
						$NiceContact['items'][0]['rows'][$row][2] = $value['last_four_cc'];
						$NiceContact['items'][0]['rows'][$row][3] = $value['coach_id'];
						$NiceContact['items'][0]['rows'][$row][4] = $value['PostalCode'];
						$NiceContact['items'][0]['rows'][$row][5] = $value['customer_guid'];
						$NiceContact['items'][0]['rows'][$row][6] = $value['Country'];
						$NiceContact['items'][0]['rows'][$row][7] = (int) $value['ContactType'];
						$row++;
					}	
			}else{
			
			if($firstCharacterPhone == 1)
				$countrycode = $firstCharacterPhone;
			else
			{	
				$countrycode = $secondCharacterPhone;
			}	
			
			switch($countrycode){
			
			case 1:
				$country = 'US';
				$P_PHONE_COUNTRY_CODE = substr($phone, 0, 1);
			$P_PHONE_AREA_CODE =  substr($phone, 1, 3);
			$P_PHONE_NUMBER = substr($phone, 4, 10);
				break;
			case 44:
				$country = 'GB';
				$P_PHONE_COUNTRY_CODE = substr($phone, 0, 2);
			$P_PHONE_AREA_CODE =  substr($phone, 2, 3);
			$P_PHONE_NUMBER = substr($phone, 5, 10);
				break;
			case 33:
				$country = 'FR';
				$P_PHONE_COUNTRY_CODE = substr($phone, 0, 2);
				$P_PHONE_AREA_CODE =  substr($phone, 2, 3);
				$P_PHONE_NUMBER = substr($phone, 5, 10);
				break;
			default:
				$country = '';
				break;			
			
			}
			
			
			load_curl();
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://ebs.prod.gateway.beachbody.com/customerSearch",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_SSL_VERIFYHOST =>0,
			CURLOPT_SSL_VERIFYPEER =>0,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>"{\"InputParameters\":{\n \"P_COUNTRY\":\"$country\",\n \"P_CALLING_MODULE\":\"UAD\",\n \"P_CALLING_EBS_USER\":\"ISGUSER\",\n \"P_PARTY_ID\":\"\",\n \"P_PARTY_NUMBER\":\"\",\n \"P_CUST_ACCOUNT_ID\":\"\",\n \"P_CUST_ACCOUNT_NUMBER\":\"\",\n \"P_OLD_CUST_NUMBER\":\"\",\n \"P_FIRST_NAME\":\"\",\n \"P_LAST_NAME\":\"\",\n \"P_SHIP_TO_INCLUDE\":\"\",\n \"P_ADDRESS1\":\"\",\n \"P_ADDRESS2\":\"\",\n \"P_CITY\":\"\",\n \"P_COUNTY\":\"\",\n \"P_STATE\":\"\",\n \"P_ZIP_CODE\":\"\",\n \"P_PHONE_COUNTRY_CODE\":\"$P_PHONE_COUNTRY_CODE\",\n \"P_PHONE_AREA_CODE\":\"$P_PHONE_AREA_CODE\",\n \"P_PHONE_NUMBER\":\"$P_PHONE_NUMBER\",\n \"P_EMAIL_ADDRESS\":\"\",\n \"P_CREDIT_CARD_TYPE\":\"\",\n \"P_CREDIT_CARD_NUMBER\":\"\",\n \"P_ORDER_ID\":\"\",\n \"P_ORDER_NUMBER\":\"\",\n \"P_DELIVERY_NUMBER\":\"\",\n \"P_TRACKING_NUMBER\":\"\",\n \"P_ECHECK_NUMBER\":\"\",\n \"P_ORD_CREDIT_CARD_TYPE\":\"\",\n \"P_ORD_CREDIT_CARD_NUMBER\":\"\",\n \"P_LEGACY_ORDER_NUMBER\":\"\",\n \"P_ORDER_REF_NUMBER\":\"\",\n \"P_RMA_NUMBER\":\"\",\n \"P_AMAZON_ORDER_NUMBER\":\"\",\n \"P_COACH_ID\":\"\",\n \"P_ORD_ADDR1\":\"\",\n \"P_ORD_CITY\":\"\",\n \"P_ORD_STATE\":\"\",\n \"P_ORD_ZIP\":\"\",\n \"P_NO_OF_DAYS\":\"\",\n \"P_ORD_SHIP_TO\":\"\",\n \"P_ORD_BILL_TO\":\"\",\n \"P_SEARCH_TYPE\":\"CUST\",\n \"P_GUID\":\"\",\n \"P_BUSINESS_UNIT\":\"\",\n \"P_ATTRIBUTE1\":\"\",\n \"P_ATTRIBUTE2\":\"\",\n \"P_ATTRIBUTE3\":\"\",\n \"P_ATTRIBUTE4\":\"\",\n \"P_ATTRIBUTE5\":\"\",\n \"P_ATTRIBUTE6\":\"\",\n \"P_ATTRIBUTE7\":\"\",\n \"P_ATTRIBUTE8\":\"\",\n \"P_ATTRIBUTE9\":\"\",\n \"P_ATTRIBUTE10\":\"\"}}",
			CURLOPT_HTTPHEADER => array(
			'api-key: AGENT:US:1234',
			'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG',
			'id_token: 1234',
			'access_token: 1234',
			'Content-Type: application/json'
			),
			));
			
			
			$response = json_decode(curl_exec($curl),true);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				echo "\ncURL Error #:" . $err;
				
			}
			$ResultCount = $response['OutputParameters']['X_RESULT_COUNT'];
			
			if($countrycode ==1 && $ResultCount==0){
			$country = 'CA';
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://ebs.prod.gateway.beachbody.com/customerSearch",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_SSL_VERIFYHOST =>0,
			CURLOPT_SSL_VERIFYPEER =>0,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS =>"{\"InputParameters\":{\n \"P_COUNTRY\":\"$country\",\n \"P_CALLING_MODULE\":\"UAD\",\n \"P_CALLING_EBS_USER\":\"ISGUSER\",\n \"P_PARTY_ID\":\"\",\n \"P_PARTY_NUMBER\":\"\",\n \"P_CUST_ACCOUNT_ID\":\"\",\n \"P_CUST_ACCOUNT_NUMBER\":\"\",\n \"P_OLD_CUST_NUMBER\":\"\",\n \"P_FIRST_NAME\":\"\",\n \"P_LAST_NAME\":\"\",\n \"P_SHIP_TO_INCLUDE\":\"\",\n \"P_ADDRESS1\":\"\",\n \"P_ADDRESS2\":\"\",\n \"P_CITY\":\"\",\n \"P_COUNTY\":\"\",\n \"P_STATE\":\"\",\n \"P_ZIP_CODE\":\"\",\n \"P_PHONE_COUNTRY_CODE\":\"$P_PHONE_COUNTRY_CODE\",\n \"P_PHONE_AREA_CODE\":\"$P_PHONE_AREA_CODE\",\n \"P_PHONE_NUMBER\":\"$P_PHONE_NUMBER\",\n \"P_EMAIL_ADDRESS\":\"\",\n \"P_CREDIT_CARD_TYPE\":\"\",\n \"P_CREDIT_CARD_NUMBER\":\"\",\n \"P_ORDER_ID\":\"\",\n \"P_ORDER_NUMBER\":\"\",\n \"P_DELIVERY_NUMBER\":\"\",\n \"P_TRACKING_NUMBER\":\"\",\n \"P_ECHECK_NUMBER\":\"\",\n \"P_ORD_CREDIT_CARD_TYPE\":\"\",\n \"P_ORD_CREDIT_CARD_NUMBER\":\"\",\n \"P_LEGACY_ORDER_NUMBER\":\"\",\n \"P_ORDER_REF_NUMBER\":\"\",\n \"P_RMA_NUMBER\":\"\",\n \"P_AMAZON_ORDER_NUMBER\":\"\",\n \"P_COACH_ID\":\"\",\n \"P_ORD_ADDR1\":\"\",\n \"P_ORD_CITY\":\"\",\n \"P_ORD_STATE\":\"\",\n \"P_ORD_ZIP\":\"\",\n \"P_NO_OF_DAYS\":\"\",\n \"P_ORD_SHIP_TO\":\"\",\n \"P_ORD_BILL_TO\":\"\",\n \"P_SEARCH_TYPE\":\"CUST\",\n \"P_GUID\":\"\",\n \"P_BUSINESS_UNIT\":\"\",\n \"P_ATTRIBUTE1\":\"\",\n \"P_ATTRIBUTE2\":\"\",\n \"P_ATTRIBUTE3\":\"\",\n \"P_ATTRIBUTE4\":\"\",\n \"P_ATTRIBUTE5\":\"\",\n \"P_ATTRIBUTE6\":\"\",\n \"P_ATTRIBUTE7\":\"\",\n \"P_ATTRIBUTE8\":\"\",\n \"P_ATTRIBUTE9\":\"\",\n \"P_ATTRIBUTE10\":\"\"}}",
			CURLOPT_HTTPHEADER => array(
			'api-key: AGENT:US:1234',
			'x-api-key: 4JS1NWuyYgaNZNDjrJAI97dSFWyL8aoS9UrTA0yG',
			'id_token: 1234',
			'access_token: 1234',
			'Content-Type: application/json'
			),
			));
			
			
			$response = json_decode(curl_exec($curl),true);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				echo "\ncURL Error #:" . $err;
				
			}
			$ResultCount = $response['OutputParameters']['X_RESULT_COUNT'];
			
			}
			$selectedcustomer = [];
			$arraysByGroup = array();
			$loop = $response['OutputParameters']['X_CSP_SEARCH_RESULTS_TAB']['X_CSP_SEARCH_RESULTS_TAB_ITEM'];
			
			//$ResultCount = 0;
			if($ResultCount == 1)
			{ 
				$selectedcustomer['Single'] = $response['OutputParameters']['X_CSP_SEARCH_RESULTS_TAB']['X_CSP_SEARCH_RESULTS_TAB_ITEM'];
				//$selectedcustomer['Single']['EMAIL_ADDRESS']= "Iamanewcontact@gmail.com"; 
				$CustomerGUID = $selectedcustomer['Single']['GUID'];
				$up_country = $selectedcustomer['Single']['COUNTRY'];
				$email = $selectedcustomer['Single']['EMAIL_ADDRESS'];
				
				if(!empty($selectedcustomer['Single']['COACH_NUMBER'])) //It's a coach
				{
					//Need to call the API to get the last 4 digit of CC
					/*$curl = curl_init();
					curl_setopt_array($curl, array(
					CURLOPT_URL => "https://apimqa.beachbody.com:8443/api/v1/isg/getCoachVerificationDetails",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_SSL_VERIFYHOST =>0,
					CURLOPT_SSL_VERIFYPEER =>0,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS =>"{\"InputParameters\": {\"P_GUID\": \"$CustomerGUID\",\"P_COUNTRY\": \"$up_country\",\"P_EMAIL_ADDRESS\": \"\",\"P_CALLING_MODULE\":\"UAD\",\"P_CALLING_EBS_USER\":\"ISGUSER\",\"P_ATTRIBUTE1\": \"\",\"P_ATTRIBUTE2\": \"\",\"P_ATTRIBUTE3\": \"BSF,ENTERED\",\"P_ATTRIBUTE4\": \"\",\"P_ATTRIBUTE5\": \"\"}}",
					CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json",
					"Authorization: Basic b3BhdXNlcjpJMTB2ZTNoQGswbG9neQ=="
					),
					));
					
					$ccdetails = json_decode(curl_exec($curl),true);
					$err1 = curl_error($curl);
					curl_close($curl);
					if ($err1) {
						echo "\ncURL Error #:" . $err1;
					}
					
					//echo "<pre>";
					//print_r($ccdetails);
					
					$cc_fulldigits = $ccdetails['OutputParameters']['P_CUST_ORDER_DETAILS_TAB']['P_CUST_ORDER_DETAILS_TAB_ITEM']['ORD_DETAIL_TAB']['ORD_DETAIL_TAB_ITEM']['PAYMENT_INFO']['CC_TOKEN_NO'];	
					*/
					$cc_digits = $selectedcustomer['Single']['CUST_ATTR3_FU'];//substr($cc_fulldigits, -4);
					$c_type = 1;
					$coach_id = $selectedcustomer['Single']['COACH_NUMBER'];
				
				}
				else
				{
				    $c_type = 2;
					$cc_digits = '';
					$coach_id = '';
				}
			
			if(!empty($email))
			{
				$contact = RNCPHP\ROQL::query("select ID from Contact C where Contact.Emails.Address = '".$email."'")->next()->next();
				
				$ContactID = trim($contact['ID']);
				
				if(!empty($ContactID))	{ //Exsiting Contact.
					$ContactDetails = RNCPHP\Contact::fetch($ContactID);
				}else{
					$ContactDetails =  new RNCPHP\Contact();
					$ContactDetails->Emails = new RNCPHP\EmailArray();
					$ContactDetails->Emails[0] = new RNCPHP\Email();
					$ContactDetails->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
					$ContactDetails->Emails[0]->AddressType->LookupName = "Email - Primary";
					$ContactDetails->Emails[0]->Address = $email;
				}		
			
					$ContactDetails->Phones = new RNCPHP\PhoneArray();
					if(isset($phone) && !empty($phone))
					{
						$flag = 2;
						for($i=0;$i<sizeof($ContactDetails->Phones);$i++)
						{
						
							if($ContactDetails->Phones[$i]->PhoneType->ID == 4)
								{
								$flag = 1;
								$ContactDetails->Phones[$i] = new RNCPHP\Phone();
								$ContactDetails->Phones[$i]->PhoneType = new RNCPHP\NamedIDOptList();
								$ContactDetails->Phones[$i]->Number = $phone;
								$ContactDetails->save();
								}	
						
						}
		  
						if($flag == 2)
						{
							$ContactDetails->Phones[0] = new RNCPHP\Phone();
							$ContactDetails->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
							$ContactDetails->Phones[0]->PhoneType->ID = 4;
							$ContactDetails->Phones[0]->Number = $phone;//$phone;
							$ContactDetails->save();
						}
					}
	  				if(isset($c_type) && !empty($c_type)){
						$ContactDetails->ContactType = $c_type;
					}
					if(isset($selectedcustomer['Single']['PERSON_FIRST_NAME']) && !empty($selectedcustomer['Single']['PERSON_FIRST_NAME'])){	
						$ContactDetails->Name->First = $selectedcustomer['Single']['PERSON_FIRST_NAME'];
					}
					if(isset($selectedcustomer['Single']['PERSON_LAST_NAME']) && !empty($selectedcustomer['Single']['PERSON_LAST_NAME'])){
						$ContactDetails->Name->Last = $selectedcustomer['Single']['PERSON_LAST_NAME'];
					}
					if(isset($selectedcustomer['Single']['CUST_ATTR2_FU']) && !empty($selectedcustomer['Single']['CUST_ATTR2_FU'])){	
						if($selectedcustomer['Single']['CUST_ATTR2_FU'] == 166634)
							$ContactDetails->CustomFields->c->fraud_flag = 1;
						else
							$ContactDetails->CustomFields->c->fraud_flag = 0;	
					}
					if(isset($coach_id) && !empty($coach_id)){
						$ContactDetails->CustomFields->c->coach_id = $coach_id;
					}
					if(isset($cc_digits) && !empty($cc_digits)){
						$ContactDetails->CustomFields->c->last_four_cc = $cc_digits;
					}
					if(isset($CustomerGUID) && !empty($CustomerGUID)){
						$ContactDetails->CustomFields->c->customer_guid = $CustomerGUID;
					}					
					if(isset($selectedcustomer['Single']['CITY']) && !empty($selectedcustomer['Single']['CITY'])){
						$ContactDetails->Address->City = $selectedcustomer['Single']['CITY'];
					}
					if(isset($selectedcustomer['Single']['POSTAL_CODE']) && !empty($selectedcustomer['Single']['POSTAL_CODE'])){
						$ContactDetails->Address->PostalCode = $selectedcustomer['Single']['POSTAL_CODE'];
					}
					if(isset($selectedcustomer['Single']['ADDRESS1']) && !empty($selectedcustomer['Single']['ADDRESS1'])){
						$ContactDetails->Address->Street = $selectedcustomer['Single']['ADDRESS1'];
					}
					if(isset($selectedcustomer['Single']['COUNTRY']) && !empty($selectedcustomer['Single']['COUNTRY'])){
						$CountryID = RNCPHP\ROQL::query("select ID from Country where Country.LookupName = '".$selectedcustomer['Single']['COUNTRY']."'")->next()->next();
							if(!empty($CountryID)){
								$ContactDetails->Address->Country = (int)$CountryID['ID'];
							}	
							if(isset($selectedcustomer['Single']['STATE']) && !empty($selectedcustomer['Single']['STATE'])){
								$stateID = RNCPHP\ROQL::query("SELECT Country.Provinces.ID as ID FROM Country WHERE Country.Provinces.Name ='".$selectedcustomer['Single']['STATE']."'")->next()->next();
							}		
							if(!empty($stateID)){	
								$ContactDetails->Address->StateOrProvince->ID = (int)$stateID['ID'];
							}	
						}
					
					$ContactDetails->save();
					$NiceContact['items'][0]['tableName'] = 'contacts';
					$NiceContact['items'][0]['count'] = 1;
					$NiceContact['items'][0]['columnNames'][0] = 'id';
					$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
					$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
					$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
					$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
					$NiceContact['items'][0]['columnNames'][5] = 'guid';
					$NiceContact['items'][0]['columnNames'][6] = 'lookupName';
					$NiceContact['items'][0]['columnNames'][7] = 'contactType';
					$NiceContact['links'][0]['rel'] = 'self';
					$NiceContact['links'][0]['href'] = $url;
					
					$NiceContact['links'][1]['rel'] = 'canonical';
					$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
					$NiceContact['links'][2]['rel'] = 'describedby';
					$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
					$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
					
					$NiceContact['items'][0]['rows'][0][0] = $ContactDetails->ID;
					$NiceContact['items'][0]['rows'][0][1] = $ContactDetails->LookupName;
					$NiceContact['items'][0]['rows'][0][2] = $ContactDetails->CustomFields->c->last_four_cc;
					$NiceContact['items'][0]['rows'][0][3] = $ContactDetails->CustomFields->c->coach_id;
					$NiceContact['items'][0]['rows'][0][4] = $ContactDetails->Address->PostalCode;
					$NiceContact['items'][0]['rows'][0][5] = $ContactDetails->CustomFields->c->customer_guid;
					$NiceContact['items'][0]['rows'][0][6] = $ContactDetails->Address->Country->LookupName;
					$NiceContact['items'][0]['rows'][0][7] = $ContactDetails->ContactType->ID;
				
			}else{
				echo "Email is Empty ";
			}	
				
				
			}
			elseif($ResultCount> 1)
			{ 
			
			$multiplerecords = $response['OutputParameters']['X_CSP_SEARCH_RESULTS_TAB']['X_CSP_SEARCH_RESULTS_TAB_ITEM']; 
			
			//$multiplerecords[0]['EMAIL_ADDRESS'] = 'test@test98.invalid.com';
			//$multiplerecords[0]['GUID'] = '123';
			//$multiplerecords[3]['GUID'] = '321';
			//$multiplerecords[3]['EMAIL_ADDRESS'] = 'test@test98.invalid.com';
			//$multiplerecords[5]['EMAIL_ADDRESS'] = 'test@test98.invalid.com';
			//$multiplerecords[5]['COACH_NUMBER'] = 1747589;
			//$multiplerecords[2]['COACH_NUMBER'] = ''; */
			//$multiplerecords[1]['COACH_NUMBER'] = 4321;
			//$sortbycoachnumber = array_column($multiplerecords, 'COACH_NUMBER');
			//array_multisort($sortbycoachnumber, SORT_DESC, $multiplerecords);
		
				
				// group by group key
				foreach($multiplerecords as $element) {
				$arraysByGroup[$element['EMAIL_ADDRESS']][] = $element;
				}
				
				foreach($arraysByGroup as &$group) {
				
				
				
				$Email = $Coach = array();
				
				foreach($group as $key => $value) {
				$Email[$key] = $value['EMAIL_ADDRESS'];
				$Coach[$key] = $value['COACH_NUMBER'];
				}
				
				if(!empty($value['COACH_NUMBER'])){
					array_multisort($Email, SORT_DESC, $Coach, SORT_DESC, $group);
				}	
					/*if(!empty($value['COACH_NUMBER'])){
						array_multisort($Email, SORT_DESC, $Coach, SORT_DESC, $group);
					}else{ echo "in else";
						array_multisort($group);
					}	*/
				}
				
				
				foreach($arraysByGroup as $key=>$value)
				{
						
					
					if(!empty($key)){	
						$selectedcustomer['Multiple'][] = $value[0];		
					}		
					
				
				}
				
			$count = count($selectedcustomer['Multiple']);
			$row = 0;
			foreach($selectedcustomer['Multiple'] as $key=>$value)
			{
					 
					$CustomerGUID = $value['GUID'];
					$up_country = $value['COUNTRY'];
					$email = $value['EMAIL_ADDRESS'];
					
					if(!empty($value['COACH_NUMBER'])) //It's a coach
					{
						//Need to call the API to get the last 4 digit of CC
						/*$curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_URL => "https://apimqa.beachbody.com:8443/api/v1/isg/getCoachVerificationDetails",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_SSL_VERIFYHOST =>0,
						CURLOPT_SSL_VERIFYPEER =>0,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS =>"{\"InputParameters\": {\"P_GUID\": \"$CustomerGUID\",\"P_COUNTRY\": \"$up_country\",\"P_EMAIL_ADDRESS\": \"\",\"P_CALLING_MODULE\":\"UAD\",\"P_CALLING_EBS_USER\":\"ISGUSER\",\"P_ATTRIBUTE1\": \"\",\"P_ATTRIBUTE2\": \"\",\"P_ATTRIBUTE3\": \"BSF,ENTERED\",\"P_ATTRIBUTE4\": \"\",\"P_ATTRIBUTE5\": \"\"}}",
						CURLOPT_HTTPHEADER => array(
						"Content-Type: application/json",
						"Authorization: Basic b3BhdXNlcjpJMTB2ZTNoQGswbG9neQ=="
						),
						));
						
						$ccdetails = json_decode(curl_exec($curl),true);
						$err1 = curl_error($curl);
						curl_close($curl);
						if($err) {
							echo "\ncURL Error #:" . $err1;
						}
						
						$cc_fulldigits = $ccdetails['OutputParameters']['P_CUST_ORDER_DETAILS_TAB']['P_CUST_ORDER_DETAILS_TAB_ITEM']['ORD_DETAIL_TAB']['ORD_DETAIL_TAB_ITEM']['PAYMENT_INFO']['CC_TOKEN_NO'];	
						*/
						$cc_digits = $value['CUST_ATTR3_FU'];//substr($cc_fulldigits, -4);
						$c_type = 1;
						$coach_id = $value['COACH_NUMBER'];
					
					}
					else
					{
						$c_type = 2;
						$cc_digits = '';
						$coach_id = '';
					}
					
					$contact = RNCPHP\ROQL::query("select ID from Contact C where Contact.Emails.Address = '".$value['EMAIL_ADDRESS']."'")->next()->next();
					
					$ContactID = trim($contact['ID']);
					
					if(!empty($ContactID))	{ //Exsiting Contact.
						$ContactDetails = RNCPHP\Contact::fetch($ContactID);
					}else{
						$ContactDetails =  new RNCPHP\Contact();
						$ContactDetails->Emails = new RNCPHP\EmailArray();
						$ContactDetails->Emails[0] = new RNCPHP\Email();
						$ContactDetails->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
						$ContactDetails->Emails[0]->AddressType->LookupName = "Email - Primary";
						$ContactDetails->Emails[0]->Address = $value['EMAIL_ADDRESS'];
					}		
				
						$ContactDetails->Phones = new RNCPHP\PhoneArray();
						if(isset($phone) && !empty($phone))
						{
							$flag = 2;
							for($i=0;$i<sizeof($ContactDetails->Phones);$i++)
							{
							
								if($ContactDetails->Phones[$i]->PhoneType->ID == 4)
									{
									$flag = 1;
									$ContactDetails->Phones[$i] = new RNCPHP\Phone();
									$ContactDetails->Phones[$i]->PhoneType = new RNCPHP\NamedIDOptList();
									$ContactDetails->Phones[$i]->Number = $phone;
									}	
							
							}
			  
							if($flag == 2)
							{
								$ContactDetails->Phones[0] = new RNCPHP\Phone();
								$ContactDetails->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
								$ContactDetails->Phones[0]->PhoneType->ID = 4;
								$ContactDetails->Phones[0]->Number = $phone;//$phone;
							}
						}
						if(isset($c_type) && !empty($c_type)){
							$ContactDetails->ContactType = $c_type;
						}
						if(isset($value['PERSON_FIRST_NAME']) && !empty($value['PERSON_FIRST_NAME'])){	
							$ContactDetails->Name->First = $value['PERSON_FIRST_NAME'];
						}
						if(isset($value['PERSON_LAST_NAME']) && !empty($value['PERSON_LAST_NAME'])){
							$ContactDetails->Name->Last = $value['PERSON_LAST_NAME'];
						}
						if(isset($value['CUST_ATTR2_FU']) && !empty($value['CUST_ATTR2_FU'])){
							if($value['CUST_ATTR2_FU'] == 166634)
								$ContactDetails->CustomFields->c->fraud_flag = 1;
							else
								$ContactDetails->CustomFields->c->fraud_flag = 0;	
						}
						if(isset($coach_id) && !empty($coach_id)){
							$ContactDetails->CustomFields->c->coach_id = $coach_id;
						}
						if(isset($cc_digits) && !empty($cc_digits)){
							$ContactDetails->CustomFields->c->last_four_cc = $cc_digits;
						}
						if(isset($CustomerGUID) && !empty($CustomerGUID)){
						$ContactDetails->CustomFields->c->customer_guid = $CustomerGUID;
					}	
						if(isset($value['CITY']) && !empty($value['CITY'])){
							$ContactDetails->Address->City = $value['CITY'];
						}
						if(isset($value['POSTAL_CODE']) && !empty($value['POSTAL_CODE'])){
							$ContactDetails->Address->PostalCode = $value['POSTAL_CODE'];
						}
						if(isset($value['ADDRESS1']) && !empty($value['ADDRESS1'])){
							$ContactDetails->Address->Street = $value['ADDRESS1'];
						}
						if(isset($value['COUNTRY']) && !empty($value['COUNTRY'])){
							$CountryID = RNCPHP\ROQL::query("select ID from Country where Country.LookupName = '".$value['COUNTRY']."'")->next()->next();
								if(!empty($CountryID)){
									$ContactDetails->Address->Country = (int)$CountryID['ID'];
								}	
								if(isset($value['STATE']) && !empty($value['STATE'])){
									$stateID = RNCPHP\ROQL::query("SELECT Country.Provinces.ID as ID FROM Country WHERE Country.Provinces.Name ='".$value['STATE']."'")->next()->next();
								}		
								if(!empty($stateID)){	
									$ContactDetails->Address->StateOrProvince->ID = (int)$stateID['ID'];
								}	
							}
						
						$ContactDetails->save();
						$NiceContact['items'][0]['tableName'] = 'contacts';
						$NiceContact['items'][0]['count'] = $count;
						$NiceContact['items'][0]['columnNames'][0] = 'id';
						$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
						$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
						$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
						$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
						$NiceContact['items'][0]['columnNames'][5] = 'guid';
						$NiceContact['items'][0]['columnNames'][6] = 'lookupName';
						$NiceContact['items'][0]['columnNames'][7] = 'contactType';
						$NiceContact['links'][0]['rel'] = 'self';
						$NiceContact['links'][0]['href'] = $url;
						
						$NiceContact['links'][1]['rel'] = 'canonical';
						$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
						$NiceContact['links'][2]['rel'] = 'describedby';
						$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
						$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
						
						$NiceContact['items'][0]['rows'][$row][0] = $ContactDetails->ID;
						$NiceContact['items'][0]['rows'][$row][1] = $ContactDetails->LookupName;
						$NiceContact['items'][0]['rows'][$row][2] = $ContactDetails->CustomFields->c->last_four_cc;
						$NiceContact['items'][0]['rows'][$row][3] = $ContactDetails->CustomFields->c->coach_id;
						$NiceContact['items'][0]['rows'][$row][4] = $ContactDetails->Address->PostalCode;
						$NiceContact['items'][0]['rows'][$row][5] = $ContactDetails->CustomFields->c->customer_guid;
						$NiceContact['items'][0]['rows'][$row][6] = $ContactDetails->Address->Country->LookupName;
						$NiceContact['items'][0]['rows'][$row][7] = $ContactDetails->ContactType->ID;
						$row++;
						
				}	
			
			}
			
			elseif($ResultCount ==0)
			{
				$NiceContact['items'][0]['tableName'] = 'contacts';
				$NiceContact['items'][0]['count'] = 0;
				$NiceContact['items'][0]['columnNames'][0] = 'id';
				$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
				$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
				$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
				$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
				$NiceContact['items'][0]['columnNames'][5] = 'guid';
				$NiceContact['items'][0]['columnNames'][6] = 'lookupName';
				$NiceContact['items'][0]['columnNames'][7] = 'contactType';
				$NiceContact['links'][0]['rel'] = 'self';
				$NiceContact['links'][0]['href'] = $url;
				
				$NiceContact['links'][1]['rel'] = 'canonical';
				$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
				$NiceContact['links'][2]['rel'] = 'describedby';
				$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
				$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
				
				$NiceContact['items'][0]['rows'] = [];
				
			}
		
		}	
			if(empty($NiceContact)){
				$NiceContact['items'][0]['tableName'] = 'contacts';
				$NiceContact['items'][0]['count'] = 0;
				$NiceContact['items'][0]['columnNames'][0] = 'id';
				$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
				$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
				$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
				$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
				$NiceContact['items'][0]['columnNames'][5] = 'guid';
				$NiceContact['items'][0]['columnNames'][6] = 'lookupName';
				$NiceContact['items'][0]['columnNames'][7] = 'contactType';
				$NiceContact['links'][0]['rel'] = 'self';
				$NiceContact['links'][0]['href'] = $url;
				
				$NiceContact['links'][1]['rel'] = 'canonical';
				$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
				$NiceContact['links'][2]['rel'] = 'describedby';
				$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
				$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
				
				$NiceContact['items'][0]['rows'] = [];
				
			
			}
			header("Content-type:application/json");
			echo json_encode($NiceContact);
			
	  }
	  
	  
		catch (Exception $e) {
		
				$NiceContact['items'][0]['tableName'] = 'contacts';
				$NiceContact['items'][0]['count'] = 0;
				$NiceContact['items'][0]['columnNames'][0] = 'id';
				$NiceContact['items'][0]['columnNames'][1] = 'lookupName';
				$NiceContact['items'][0]['columnNames'][2] = 'last_four_cc';
				$NiceContact['items'][0]['columnNames'][3] = 'coach_id';
				$NiceContact['items'][0]['columnNames'][4] = 'postalCode';
				$NiceContact['items'][0]['columnNames'][5] = 'contactType';
				$NiceContact['items'][0]['columnNames'][6] = 'guid';
				$NiceContact['items'][0]['columnNames'][7] = 'lookupName';
				$NiceContact['links'][0]['rel'] = 'self';
				$NiceContact['links'][0]['href'] = $url;
				
				$NiceContact['links'][1]['rel'] = 'canonical';
				$NiceContact['links'][1]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/queryResults';
				$NiceContact['links'][2]['rel'] = 'describedby';
				$NiceContact['links'][2]['href'] = 'https://faq.beachbody.com/services/rest/connect/v1.3/metadata-catalog/queryResults';
				$NiceContact['links'][2]['mediaType'] = 'application/schema+json';
				
				$NiceContact['items'][0]['rows'] = [];
				
				header("Content-type:application/json");
				echo json_encode($NiceContact);
				
			
		}
	
	}


}

