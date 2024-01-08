<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;


class ShippingAPI extends \RightNow\Controllers\Base

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
		/*if  (empty($_GET) or empty($_GET['email']) or empty($_GET['address1']) or empty($_GET['name']) or empty($_GET['zipcode'])
			or empty($_GET['state']) or empty($_GET['country']) or empty($_GET['phno']) or empty($_GET['raNumber']) or empty($_GET['orderNumber']))
				{
					
					$missingparams = array('error'=>'missing params');
					echo json_encode($missingparams);
					exit();
					
				}
				*/
		$Body = file_get_contents('php://input');
		$req = (array)json_decode($Body)->InputParameters->LabelRequest;
		logmessage($req);

		if  (empty($req) or empty($req['email']) or empty($req['address1']) or empty($req['name']) or empty($req['zipcode'])
			or empty($req['state']) or empty($req['country']) or empty($req['phno']) or empty($req['raNumber']) or empty($req['orderNumber']) or  empty($req['returnwh']))
				{
					logmessage($req);
					
					$missingparams = array('error'=>'missing params');
					echo json_encode($missingparams);
					exit();
					
				}
		
		if($Body)
		{
			$idtokens = json_decode($Body)->InputParameters->AUTHTOKEN->idToken;
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
		}
		
		$shiplabel = $this->model('custom/ShippingLabelCOModal')->insert($req,'FEDEX',$validtoken['cid']);
		$id= $shiplabel['id'];
		$delivery_id= $shiplabel['delivery_id'];
				header('Access-Control-Allow-Origin: *');
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
						'Key' => $this->getPropertyfromConfig('key',$req['returnwh']), 
						'Password' => $this->getPropertyfromConfig('password',$req['returnwh'])
					)
				); 

				$request['ClientDetail'] = array(
					'AccountNumber' => $this->getPropertyfromConfig('shipaccount',$req['returnwh']),
					'MeterNumber' => $this->getPropertyfromConfig('meter',$req['returnwh'])
				);

				$request['TransactionDetail'] = array('CustomerTransactionId' => $req['raNumber']);
				$request['Version'] = array(
					'ServiceId' => 'ship', 
					'Major' => '17', 
					'Intermediate' => '0', 
					'Minor' => '0'
				);

				$request['RequestedShipment']['ServiceType'] = 'SMART_POST'; 
				$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING';
				$request['RequestedShipment']['Recipient'] = $this->getRecipient($req['returnwh']);		
				$request['RequestedShipment']['Shipper'] = array(
					'Contact' => array(
						'PersonName' => $req['name'],
						'PhoneNumber' => $req['phno']
					),
					'Address' => array(
						'StreetLines' => array($req['address1']),
						'City' => $req['city'],
						'StateOrProvinceCode' => $req['state'],
						'PostalCode' => $req['zipcode'],
						'CountryCode' => $req['country'],
						'Residential' => 1
					)
				);
				$request['RequestedShipment']['PackageCount'] = '1';


				$request['Actions']=array('TRANSFER');
				$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
				$request['RequestedShipment']['ShipTimestamp'] = date('c');


													   
				$request['RequestedShipment']['ShippingChargesPayment'] = $this->getPropertyfromConfig('shippingchargespayment',$req['returnwh']);
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
								'EmailAddress' => $req['email'],
								'Role' => 'SHIPMENT_COMPLETOR'
							)),
						)
					)
				);           
				$request['RequestedShipment']['SmartPostDetail'] = array(
					'Indicia' => 'PARCEL_RETURN',
					'HubId'  => '5431'
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
							'CustomerReferenceType' => 'RMA_ASSOCIATION',
							'Value' => $req['raNumber']
						)
					)
				);
				logmessage(request);

				try {
					/*if(setEndpoint('changeEndpoint')){
						$newLocation = $client->__setLocation(setEndpoint('endpoint'));
					}*/
					$count = 0;
					while($count < 3){
					$response = $client ->call('createPendingShipment',array('CreatePendingShipmentRequest' => $request),'http://fedex.com/ws/openship/v17','http://fedex.com/ws/openship/v17');
						$count++;
						if ($client->fault)
							{
								sleep(5);
								$client->setLocation('https://apimdev.beachbody.com:8443/web-services/openship');
								
							}
							else
							{
								$count = 3;
							}
					
					
					}
					if ($client->fault) {
										$missingparams = array('error'=>'Error in calling Fedex.');
										echo json_encode($missingparams);
										$this->model('custom/ShippingLabelCOModal')->updateErrorStatus($id,'Error in calling Fedex.');
										exit();
										
								} else {
									
										$err = $client->getError();
											if ($err) {
												$missingparams = array('error'=>'Error in calling Fedex.');
												echo json_encode($missingparams);
												$this->model('custom/ShippingLabelCOModal')->updateErrorStatus($id,$err);
												exit();
												
												
											} 
									
									
								}
					
					
					if ($response['HighestSeverity'] != 'FAILURE' && $response['HighestSeverity'] != 'ERROR'){
						$service_response = array('Index' => $response['Index']);
						$this->model('custom/ShippingLabelCOModal')->updateTracking($id,$response['Index']);
						echo json_encode($service_response);
						
					}else{
						$this->model('custom/ShippingLabelCOModal')->updateErrorStatus($id,substr(json_encode($response['Notifications']),0,254));
						echo json_encode($response);
					} 
					logmessage($client->request);
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
 * This section provides the receipient info based on return arehouse from the order
 */

function getRecipient($var){

	if($var == 'WH2') {
		Return array(
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
		}
	elseif ($var == 'OC1') {
		Return array(
		'Contact' => array(
			'PersonName' => 'BEACHBODY LLC - SMARTPOST RETURN',
			'CompanyName' => 'BEACHBODY LLC - SMARTPOST RETURN',
			'PhoneNumber' => '8662048865'
		),
		'Address' => array(
			'StreetLines' => array('6390 Commerce Ct'),
			'City' => 'Groveport',
			'StateOrProvinceCode' => 'OH',
			'PostalCode' => '43125',
			'CountryCode' => 'US',
			'Residential' => 0
		)
	);	
		}
		elseif ($var == 'G01') {
			Return array(
			'Contact' => array(
				'PersonName' => 'BEACHBODY LLC - SMARTPOST RETURN',
				'CompanyName' => 'BEACHBODY LLC - SMARTPOST RETURN',
				'PhoneNumber' => '8662048865'
			),
			'Address' => array(
				'StreetLines' => array('5650 E Santa Ana St'),
				'City' => 'Ontario',
				'StateOrProvinceCode' => 'CA',
				'PostalCode' => '91761',
				'CountryCode' => 'US',
				'Residential' => 0
			)
		);	
			}
			elseif ($var == 'G02') {
				Return array(
				'Contact' => array(
					'PersonName' => 'BEACHBODY LLC - SMARTPOST RETURN',
					'CompanyName' => 'BEACHBODY LLC - SMARTPOST RETURN',
					'PhoneNumber' => '8662048865'
				),
				'Address' => array(
					'StreetLines' => array('833 Thornton Road South'),
					'City' => 'Oshawa',
					'StateOrProvinceCode' => 'Ontario',
					'PostalCode' => 'L1J7E2',
					'CountryCode' => 'CA',
					'Residential' => 0
				)
			);	
				}
				elseif ($var == 'NL1') {
					Return array(
					'Contact' => array(
						'PersonName' => 'BEACHBODY LLC - SMARTPOST RETURN',
						'CompanyName' => 'BEACHBODY LLC - SMARTPOST RETURN',
						'PhoneNumber' => '8662048865'
					),
					'Address' => array(
						'StreetLines' => array('Drayton Fields,Nasmyth Road'),
						'City' => 'Daventry',
						'StateOrProvinceCode' => 'Northamptonshire',
						'PostalCode' => 'NN118NF',
						'CountryCode' => 'GB',
						'Residential' => 0
					)
				);	
					}
 }


 /**
 * This section provides a convenient place to setup many commonly used variables
 * needed for the php sample code to function.
 */
function getPropertyfromConfig($var,$wh){

	$allcnfg = json_decode(Config::getConfig(CUSTOM_CFG_SHIP_LABEL_CONFIG));
	logmessage($allcnfg );
	foreach ($allcnfg as $k=>$v){
			logmessage ($k);
			if($k === $wh)
				$cnfg = $v;
		}

	if($var == 'key') Return $cnfg->key; 
	if($var == 'password') Return $cnfg->password ; 

	if($var == 'shipaccount') Return $cnfg->account;
	if($var == 'billaccount') Return $cnfg->account;
	
	if($var == 'meter') Return $cnfg->meter;

	if($var == 'shippingchargespayment') Return array(
		'PaymentType' => 'SENDER',
		'Payor' => array(
			'ResponsibleParty' => array(
				'AccountNumber' => $cnfg->account,
				'Contact' => null,
				'Address' => array('CountryCode' => 'US')
			)
		)
	);
}



/**
 * This section provides a convenient place to setup many commonly used variables
 * needed for the php sample code to function.
 */
function getProperty($var){

  
	if($var == 'locationid') Return 'PLBA';
	if($var == 'printlabels') Return true;
	if($var == 'printdocuments') Return true;
	if($var == 'packagecount') Return '4';
	if($var == 'validateaccount') Return 'XXX';
		
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
			'PersonName' => $req['name'],
			'PhoneNumber' => $req['phno']
		),
		'Address' => array(
			'StreetLines' => array($req['address1']),
			'City' => $req['city'],
			'StateOrProvinceCode' => $req['state'],
			'PostalCode' => $req['zipcode'],
			'CountryCode' => $req['country'],
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