<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;


class bbShippingAPI extends \RightNow\Controllers\Base

{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }
	
	/*
	Function for calling Create Pending Shipment (EmailLabel)
	*/
	 function TestEmailLabel()
    {
		
		
		if(!empty($_GET['id']))
		{
			
			try{
				$validtoken = $this->model('custom/oauthjwkCOModal')->validateToken($_GET['id']);
				logmessage($validtoken['validity']);
					if($validtoken['validity'] != "valid")
					{
							$missingparams = array('error'=>'Token invalid');
							echo json_encode($missingparams);
							exit();
					}else{
						echo json_encode($validtoken);
					}
			}catch(Exception $e){
				logmessage($e->getMessage());
							echo json_encode(array('error'=>'Token invalid'));
							exit();
			}
			
		}else{
			exit();
		}
	
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
	  /**
     * Sample function for JWT signatuer verification controller. This function can be called by sending
     * a request to /cc/ShippingAPI/verifyJWT.
     */
	 
    function verifyJWT($idtoken)
    {
         logmessage($idtoken);
		$pieces = explode(".", $idtoken);
		$data = $pieces[0].".".$pieces[1];
		$signature = base64_decode(str_replace(['-','_'], ['+','/'], $pieces[2]));
		$n = 'yhsULILZpLWsPG4KOxJ40b9KF32cjDVSb7ZYByQ-V0HRc5_GDCyj2x91qFzDkGdeJqm2aQ6aI0gYUmGFySjnZY07ehZ0-HE5lGnXr0Jnbc1Q-xkGUHB5UrN7AKCxc79bCCqO67mcCuI5hPnLxZPD4_B61UNMInvc3McA_cm9uBtI-iwljSQVxfZBRf9izRrZTUi2O6Izb-wqDgR_ww3P2HgV_KZpA5xzddXGJom6G_bqy2Oj0Izm9sllmg19qmikJBaQ1sFr2Ljp8n4cd8fG_jUg9Ug1C2DDoxlEW1RJqwnruxQBt2BJPEN1iyapLb1a_7-mv605X_QgrimctsQVVQ';
		//$n = '16VGO6QbBiDOpBaToPtg_7hRC_0p5QyWi6_XEJEP2eWQlcA9ybYn78w1i4SmC0htLVVIQTbhUEFgBrMFOU-fJG7SyzhOAAhGuxmi0K_YNeLntCv8pZbTNeqH3fNKMHi0eCyEKCEK1SyDYCxdAWVFXHVsuGy9uLzH_Prk_OpiBB6KhK5n6d3iPy56Iq9gufJLdOs3pwVISK4bwMJ4pu2zca3PktgBHJgrK9oGu3XFT0RWkK-pboz4prBaYHcrQ0u6B7GQ4vG2jquDqFfCYn9NGsqVEQGuM4NeoZM4mgzLHm8_ns_Q9rTg61x-UEbfAn8tfGxSRDvsGKNodg5XPgcm3w';
		$n = str_replace(['-','_'], ['+','/'], $n);
		$n = base64_decode($n);

		$e = 'AQAB';
		$e = base64_decode($e);
		$this->load->library('math_biginteger');
		$this->load->library('Crypt_Hash');
		$this->load->library('crypt_rsa');
		$rsa = new $this->crypt_rsa();
		 $rsa->loadKey([
			'n' => new $this->math_biginteger($n, 256),
			'e' => new $this->math_biginteger($e, 256)
		]);
 
		$rsa->setHash('sha256');
		$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
		return  $rsa->verify($data, $signature) ?
			'valid' :
			'invalid';
    }
	
	/*
	Function for calling Create Pending Shipment (EmailLabel)
	*/
	 function CreateEmailLabel()
    {
		if  (empty($_GET) or empty($_GET['email']) or empty($_GET['address1']) or empty($_GET['name']) or empty($_GET['zipcode'])
			or empty($_GET['state']) or empty($_GET['country']) or empty($_GET['phno']) or empty($_GET['raNumber']) or empty($_GET['orderNumber']))
				{
					
					$missingparams = array('error'=>'missing params');
					echo json_encode($missingparams);
					exit();
					
				}
		$Body = file_get_contents('php://input');
		/*if($Body)
		{
			$idtokens = json_decode($Body)->InputParameters->idToken;
			try{
				$validtoken = $this->model('custom/oauthjwkCOModal')->validateToken($idtokens);
					logmessage($validtoken);
					if($validtoken['validity'] != "valid")
					{
							$missingparams = array('error'=>'Token invalid');
							echo json_encode($missingparams);
							exit();
					}
			}catch(Exception $e){
				logmessage($e->getMessage());
							echo json_encode(array('error'=>'Token invalid'));
							exit();
			}
			
		}else{
			exit();
		}*/
		
		$shiplabel = $this->model('custom/ShippingLabelCOModal')->insert($_GET,'FEDEX',$validtoken['cid']);
		$id= $shiplabel['id'];
		$delivery_id= $shiplabel['delivery_id'];
		logmessage($id);
		logmessage($delivery_id);
				header('Access-Control-Allow-Origin: http://localhost:4000');
				header('Access-Control-Allow-Credentials: true');
		$this->load->library('nusoap_client');
		
		$client = new $this->nusoap_client();//"https://apimdev.beachbody.com:8443/web-services/openship?wsdl", 'wsdl');
		$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
				echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
				exit();
			}
			$client->setUseCurl(true);
		$request['WebAuthenticationDetail'] = array(
					'UserCredential' => array(
						'Key' => $this->getProperty('key'), 
						'Password' => $this->getProperty('password')
					)
				); 

				$request['ClientDetail'] = array(
					'AccountNumber' => $this->getProperty('shipaccount'), 
					'MeterNumber' => $this->getProperty('meter')
				);

				$request['TransactionDetail'] = array('CustomerTransactionId' => $_GET['raNumber']);
				$request['Version'] = array(
					'ServiceId' => 'ship', 
					'Major' => '17', 
					'Intermediate' => '0', 
					'Minor' => '0'
				);

				$request['RequestedShipment']['ServiceType'] = 'FEDEX_GROUND'; 
				$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING';
				$request['RequestedShipment']['Recipient'] = $this->getProperty('recipient');	
				$request['RequestedShipment']['Shipper'] = $this->getProperty('shipper');
				$request['RequestedShipment']['PackageCount'] = '1';


				$request['Actions']=array('TRANSFER');
				$request['RequestedShipment']['DropoffType'] = 'BUSINESS_SERVICE_CENTER'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
				$request['RequestedShipment']['ShipTimestamp'] = date('c');


													   
				$request['RequestedShipment']['ShippingChargesPayment'] = $this->getProperty('shippingchargespayment');
				$request['RequestedShipment']['SpecialServicesRequested'] = array(
					'SpecialServiceTypes' => array ('RETURN_SHIPMENT', 'PENDING_SHIPMENT'),
					'ReturnShipmentDetail' => array(
						'ReturnType' => 'PENDING',
						'ReturnEMailDetail' => array(
							'MerchantPhoneNumber' => '8662048865', 
						)
					),
					'PendingShipmentDetail' => array(
						'Type' => 'EMAIL', 
						'ExpirationDate' => $this->getProperty('expirationdate'),
						'EmailLabelDetail' => array(
							'Message' => "",
							'Recipients' => array(array(
								'EmailAddress' => $_GET['email'],
								'Role' => 'SHIPMENT_COMPLETOR'
							)),
						)
					)
				);           

																															   
				$request['RequestedShipment']['LabelSpecification'] = array(
					'LabelFormatType' => 'COMMON2D',
					'ImageType' => 'PDF'
				);

				$request['RequestedShipment']['RequestedPackageLineItems'] = array(
					'1' => array(
						'SequenceNumber' => '1',
						'Weight' => array(
							'Value' => 5.0,
							'Units' => 'LB'
						),
						'ItemDescription' => 'Sporting Goods',
						'CustomerReferences' => array(
							'CustomerReferenceType' => 'CUSTOMER_REFERENCE',
							'Value' => $delivery_id
						)
					)
				);


				try {
					/*if(setEndpoint('changeEndpoint')){
						$newLocation = $client->__setLocation(setEndpoint('endpoint'));
					}*/
					
					$response = $client ->call('createPendingShipment',array('CreatePendingShipmentRequest' => $request),'http://fedex.com/ws/openship/v17','http://fedex.com/ws/openship/v17');
					if ($client->fault) {
									echo '<h2>Fault (Expect - The request contains an invalid SOAP body)</h2><pre>'; print_r($result); echo '</pre>';
								} else {
									$err = $client->getError();
									if ($err) {
										echo '<h2>Error</h2><pre>' . $err . '</pre>';
									} 
								}
					
					if ($response['HighestSeverity'] != 'FAILURE' && $response['HighestSeverity'] != 'ERROR'){
						$service_response = array('Index' => $response['Index']);
						$this->model('custom/ShippingLabelCOModal')->updateTracking($id,$response['Index']);
						echo json_encode($service_response);
						
					}else{
						$this->model('custom/ShippingLabelCOModal')->updateErrorStatus(json_encode($response['Notifications']));
						echo json_encode($response);
					} 
					
					logmessage($response);    // Write to log file   
				} catch (SoapFault $exception) {
					printFault($exception, $client);
				}
	}
function printSuccess($client, $response) {
    $this->printReply($client, $response);
}

function printReply($client, $response){
	$highestSeverity=$response->HighestSeverity;
	if($highestSeverity=="SUCCESS"){echo '<h2>The transaction was successful.</h2>';}
	if($highestSeverity=="WARNING"){echo '<h2>The transaction returned a warning.</h2>';}
	if($highestSeverity=="ERROR"){echo '<h2>The transaction returned an Error.</h2>';}
	if($highestSeverity=="FAILURE"){echo '<h2>The transaction returned a Failure.</h2>';}
	echo "\n";
	//$this->printNotifications($response -> Notifications);
	$this->printRequestResponse($client, $response);
}

function printRequestResponse($client){
	echo '<h2>Request</h2>' . "\n";
	echo '<pre>' . htmlspecialchars($client->request). '</pre>';  
	echo "\n";
   
	echo '<h2>Response</h2>'. "\n";
	echo '<pre>' . htmlspecialchars($client->response). '</pre>';
	echo "\n";
}

/**
 *  Print SOAP Fault
 */  
function printFault($exception, $client) {
   echo '<h2>Fault</h2>' . "<br>\n";                        
   echo "<b>Code:</b>{$exception->faultcode}<br>\n";
   echo "<b>String:</b>{$exception->faultstring}<br>\n";
   writeToLog($client);
   writeToLog($exception);
    
  echo '<h2>Request</h2>' . "\n";
	echo '<pre>' . htmlspecialchars($client->request()). '</pre>';  
	echo "\n";
}

/**
 * SOAP request/response logging to a file
 */                                  
function writeToLog($client){  

  /**
	 * __DIR__ refers to the directory path of the library file.
	 * This location is not relative based on Include/Require.
	 */
	if (!$logfile = fopen(__DIR__.'/fedextransactions.log', "a"))
	{
   		error_func("Cannot open " . __DIR__.'/fedextransactions.log' . " file.\n", 0);
   		exit(1);
	}

 	fwrite($logfile, sprintf("\r%s:- %s",date("D M j G:i:s T Y"), $client->__getLastRequest(). "\r\n" . $client->__getLastResponse()."\r\n\r\n"));
 
}

/**
 * This section provides a convenient place to setup many commonly used variables
 * needed for the php sample code to function.
 */
function getProperty($var){

  if($var == 'key') Return '7Pok78kusz5PIR5v'; 
	if($var == 'password') Return 'NQ2YMzTEshcr1MCNMt92zpRfv'; 
	if($var == 'parentkey') Return '7Pok78kusz5PIR5v'; 
	if($var == 'parentpassword') Return 'NQ2YMzTEshcr1MCNMt92zpRfv'; 
	if($var == 'shipaccount') Return '510087380';
	if($var == 'billaccount') Return '510087380';
	if($var == 'dutyaccount') Return '510087380'; 
	if($var == 'freightaccount') Return '510087380';  
	if($var == 'trackaccount') Return '510087380'; 
	if($var == 'dutiesaccount') Return '510087380';
	if($var == 'importeraccount') Return '510087380';
	if($var == 'brokeraccount') Return '510087380';
	if($var == 'distributionaccount') Return '510087380';
	if($var == 'locationid') Return 'PLBA';
	if($var == 'printlabels') Return true;
	if($var == 'printdocuments') Return true;
	if($var == 'packagecount') Return '4';
	if($var == 'validateaccount') Return 'XXX';
	if($var == 'meter') Return '114079163';
		
	if($var == 'shiptimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));

	if($var == 'spodshipdate') Return '2018-05-08';
	if($var == 'serviceshipdate') Return '2018-05-07';
  if($var == 'shipdate') Return '2018-05-08';

	if($var == 'readydate') Return '2014-12-15T08:44:07';
	//if($var == 'closedate') Return date("Y-m-d");
	if($var == 'closedate') Return '2016-04-18';
	if($var == 'pickupdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
	if($var == 'pickuptimestamp') Return mktime(8, 0, 0, date("m")  , date("d")+1, date("Y"));
	if($var == 'pickuplocationid') Return 'SQLA';
	if($var == 'pickupconfirmationnumber') Return '1';

	if($var == 'dispatchdate') Return date("Y-m-d", mktime(8, 0, 0, date("m")  , date("d")+1, date("Y")));
	if($var == 'dispatchlocationid') Return 'NQAA';
	if($var == 'dispatchconfirmationnumber') Return '4';		
	
	if($var == 'tag_readytimestamp') Return mktime(10, 0, 0, date("m"), date("d")+1, date("Y"));
	if($var == 'tag_latesttimestamp') Return mktime(20, 0, 0, date("m"), date("d")+1, date("Y"));	

	if($var == 'expirationdate') Return date("Y-m-d", mktime(8, 0, 0, date("m"), date("d")+30, date("Y")));
	if($var == 'begindate') Return '2014-10-16';
	if($var == 'enddate') Return '2014-10-16';	

	if($var == 'trackingnumber') Return 'XXX';

	if($var == 'hubid') Return '5531';
	
	if($var == 'jobid') Return 'XXX';

	if($var == 'searchlocationphonenumber') Return '5555555555';
	if($var == 'customerreference') Return '39589';

	if($var == 'shipper') Return array(
		'Contact' => array(
			'PersonName' => $_GET['name'],
			'PhoneNumber' => $_GET['phno']
		),
		'Address' => array(
			'StreetLines' => array($_GET['address1']),
			'City' => $_GET['city'],
			'StateOrProvinceCode' => $_GET['state'],
			'PostalCode' => $_GET['zipcode'],
			'CountryCode' => $_GET['country'],
			'Residential' => 1
		)
	);
	if($var == 'recipient') Return array(
		'Contact' => array(
			'PersonName' => 'BEACHBODY LLC - SMARTPOST RETURN',
			'CompanyName' => 'BEACHBODY LLC - SMARTPOST RETURN',
			'PhoneNumber' => '8662048865'
		),
		'Address' => array(
			'StreetLines' => array('6360 Port Rd'),
			'City' => 'Groveport',
			'StateOrProvinceCode' => 'OH',
			'PostalCode' => '43125',
			'CountryCode' => 'US',
			'Residential' => 0
		)
	);	

	if($var == 'address1') Return array(
		'StreetLines' => array('10 Fed Ex Pkwy'),
		'City' => 'Memphis',
		'StateOrProvinceCode' => 'TN',
		'PostalCode' => '38115',
		'CountryCode' => 'US'
    );
	if($var == 'address2') Return array(
		'StreetLines' => array('13450 Farmcrest Ct'),
		'City' => 'Herndon',
		'StateOrProvinceCode' => 'VA',
		'PostalCode' => '20171',
		'CountryCode' => 'US'
	);					  
	if($var == 'searchlocationsaddress') Return array(
		'StreetLines'=> array('240 Central Park S'),
		'City'=>'Austin',
		'StateOrProvinceCode'=>'TX',
		'PostalCode'=>'78701',
		'CountryCode'=>'US'
	);
									  
	if($var == 'shippingchargespayment') Return array(
		'PaymentType' => 'SENDER',
		'Payor' => array(
			'ResponsibleParty' => array(
				'AccountNumber' => $this->getProperty('billaccount'),
				'Contact' => null,
				'Address' => array('CountryCode' => 'US')
			)
		)
	);	
	if($var == 'freightbilling') Return array(
		'Contact'=>array(
			'ContactId' => 'freight1',
			'PersonName' => 'Big Shipper',
			'Title' => 'Manager',
			'CompanyName' => 'Freight Shipper Co',
			'PhoneNumber' => '1234567890'
		),
		'Address'=>array(
			'StreetLines'=>array(
				'1202 Chalet Ln', 
				'Do Not Delete - Test Account'
			),
			'City' =>'Harrison',
			'StateOrProvinceCode' => 'AR',
			'PostalCode' => '72601-6353',
			'CountryCode' => 'US'
			)
	);
}

function setEndpoint($var){
	if($var == 'changeEndpoint') Return true;
	if($var == 'endpoint') Return 'xxx';
}

function printNotifications($notes){
	foreach($notes as $noteKey => $note){
		if(is_string($note)){    
            echo $noteKey . ': ' . $note . Newline;
        }
        else{
        	printNotifications($note);
        }
	}
	echo Newline;
}

function printError($client, $response){
    $this->printReply($client, $response);
}

function trackDetails($details, $spacer){
	foreach($details as $key => $value){
		if(is_array($value) || is_object($value)){
        	$newSpacer = $spacer. '&nbsp;&nbsp;&nbsp;&nbsp;';
    		echo '<tr><td>'. $spacer . $key.'</td><td>&nbsp;</td></tr>';
    		trackDetails($value, $newSpacer);
    	}elseif(empty($value)){
    		echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
    	}else{
    		echo '<tr><td>'.$spacer. $key .'</td><td>'.$value.'</td></tr>';
    	}
    }
}	
	
}