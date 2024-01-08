<?php

namespace Custom\Controllers;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
use RightNow\Connect\v1_2 as RNCPHP;
	

class OPAController extends \RightNow\Controllers\Base
{

   function GetOrderList()
  {
    $ip_dbreq = true;		
		
		 try
		{
			if(!extension_loaded('curl')) {
				//print_r("\nwhy are you loading it again - function?\n");
				load_curl();
			}
		}
		catch(exception $e)
		{
			//print_r("Error Error\n");
		}
		
			$body = '{
	"InputParameters": {
	      "P_GUID": "06F61FA8-F72F-40D8-A197-09B93C254E93",
	      "P_COUNTRY": "US"      
	   }}';

	
	 $soapUser = "opauser";  //  username
     $soapPassword = "Passw0rd123"; // password
    // $url ="https://apimdev.beachbody.com:8443/api/v1/isg/getcustomerorders";
     $ch = curl_init("https://apimdev.beachbody.com:8443/api/v1/isg/getcustomerorders");
     
       
    //curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);    
   
    // Disable SSL peer verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POST,           true );            
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($body))                                                                       
);

	curl_setopt($ch, CURLOPT_VERBOSE, TRUE); 
// Indicate that the message should be returned to a variable        
               
        
         $response = curl_exec($ch); 
         print_r($response);
           
           if (curl_errno($ch)) { 
          //  print "Error: " . curl_error($ch); 
        } else { 
            // Show me the result 
            var_dump($data); 
            curl_close($ch); 
        }         
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request

  }



  function GetTestBeachBody()
	{
	
    	echo 'sssssss' ;
	 $ip_dbreq = true;		
		
		 try
		{
			if(!extension_loaded('curl')) {
				//print_r("\nwhy are you loading it again - function?\n");
				load_curl();
			}
		}
		catch(exception $e)
		{
			//print_r("Error Error\n");
		}
		
   	 
	      
	      // $soapUser="ininprod";
           //$soapPassword="IninPro@!";


          $soapUser="opatest";
           $soapPassword="Opatest123";



  // echo $URL ;
            // PHP cURL  for https connection with auth
             //$ch = curl_init('https://transportpsqa.beachbody.com/api/v1/searchidentity');
              $ch = curl_init('https://apimdev.beachbody.com:8443/api/v1/isg/getcustomerorders');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
           // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
          
            // converting
   
           $response = curl_exec($ch); print_r($response);
           
           if (curl_errno($ch)) { 
            print "Error: " . curl_error($ch); 
        } else { 
            // Show me the result 
            var_dump($data); 
            curl_close($ch); 
        }
        
        print_r($response);  
	
	
    }
    
    function SocialAPI()
   {
    $ip_dbreq = true;	
    
     try
		{
			if(!extension_loaded('curl')) {
				//print_r("\nwhy are you loading it again - function?\n");
				load_curl();
			}
		}
		catch(exception $e)
		{
			//print_r("Error Error\n");
		}


   
    set_time_limit(0);
	$soap_do = curl_init();
	curl_setopt($soap_do, CURLOPT_URL, "https://api.fullcontact.com/v2/person.json?email=%22abdul.mohammed@speridian.com%22&apiKey=b9ff6201ca8c7205");
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
	curl_setopt($soap_do, CURLOPT_GET,1 );   
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);//implemented to perform a TRUST on the server certificate
	curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);		
	curl_setopt($soap_do, CURLOPT_FRESH_CONNECT, true);				
	curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);    
		
   
  echo 'ssss' ;
  
	$result = curl_exec($soap_do);
	print_r($result);
	
	    
           if (curl_errno($soap_do)) { 
            print "Error: " . curl_error($soap_do); 
        } else { 
            // Show me the result 
            var_dump($result); 
            curl_close($soap_do); 
        }         	
	$decode=json_decode($result);
	
	
    
   }
   
    
	
}

