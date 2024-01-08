<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;
	

class testdatacontroller extends \RightNow\Controllers\Base
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
	  "pp_get_cust_ord_det_Input": {
	  "@xmlns": "http://xmlns.oracle.com/webservices/rest/PPGetCustOrderDetails/pp_get_cust_ord_det/",
	    "RESTHeader": {
	                "@xmlns": "http://xmlns.oracle.com/webservices/rest/PPGetCustOrderDetails/",
	                  "Responsibility": "ORDER_MGMT_SUPER_USER",
	      "RespApplication": "ONT",
	      "SecurityGroup": "STANDARD",
	      "NLSLanguage": "AMERICAN",
	      "Org_Id": "102"
	    },
	    "InputParameters": {
	      "P_GUID": "06F61FA8-F72F-40D8-A197-09B93C254E93",
	      "P_COUNTRY": "",
	      "P_ZIP": "",
	      "P_FIRST_NAME": "",
	      "P_LAST_NAME": "",
	      "P_EMAIL": "",
	      "P_PHONE": "",
	      "P_CUSTOMER_NO": "",
	      "P_ADDRESS1": "",
	      "P_ADDRESS2": "",
	      "P_CITY": "",
	      "P_STATE": "",
	      "P_COUNTY": "",
	      "P_COACH": "",
	      "P_BUS_UNIT": ""
		  }
	    }
	}';
	
	 $soapUser = "opadevuser";  //  username
     $soapPassword = "Passw0rd123"; // password
    // $url ="https://apimdev.beachbody.com:8443/api/v1/isg/getcustomerorders";
     $ch = curl_init("https://apimdev.beachbody.com:8443/api/v1/isg/getcustomerorders");
     
       
    //curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
     curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    // Disable SSL peer verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POST,           true );   
	curl_setopt($ch, CURLOPT_VERBOSE, TRUE); 
// Indicate that the message should be returned to a variable        
               
        
         $response = curl_exec($ch); 
         print_r($response);
           
           if (curl_errno($ch)) { 
            print "Error: " . curl_error($ch); 
        } else { 
            // Show me the result 
            var_dump($data); 
            curl_close($ch); 
        }         
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request

  }

  function GetTestBeachBody()
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
		

	   $URL = "https://apimdev.beachbody.com:8443/api/v1/oparestapi"; // asmx URL of WSDL
	  //$URL ="https://transportpsqa.beachbody.com/api/v1/searchidentity";
	  
        $soapUser = "opatest";  //  username
        $soapPassword = "Opatest123"; // password
        
     
    // $soapUser="ininprod";
     //$soapPassword="IninPro@!";


            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);         
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);           
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_CAINFO, "/cgi-bin/beachbody.db/certs/ca.pem");
          
            // converting
   
           $response = curl_exec($ch); 
           print_r($response);
           
           if (curl_errno($ch))
            { 
            print "Error: " . curl_error($ch); 
        } else { 
            // Show me the result 
          
            //var_dump($response); 
            //curl_close($ch); 
        }
    
	}
	
    
	function ExtractJason()
    {
    
    //$opa-id = isset($_POST['opa-id'])?$_POST['opa-id']:'';	// gets opa field id
    //$opa-value = isset($_POST['value'])?$_POST['value']:'';	// gets opa field value
   // $opa_name= isset($_POST['name'])?$_POST['name']:'';	

    
    
     $jsondata = '{"OutputParameters": {
   "@xmlns:xsi": "http://www.w3.org/2001/XMLSchema-instance",
   "@xmlns": "http://xmlns.oracle.com/apps/ont/rest/PPGetCustOrderDetails/pp_get_cust_ord_det/",
   "P_ERR_MESSAGE": "Sucesss",
   "P_CUST_ORDER_DETAILS_TAB": {"P_CUST_ORDER_DETAILS_TAB_ITEM":    {
      "CUSTOMER_NUMBER": "0000070367",
      "CUSTOMER_FNAME": "JUDY B",
      "CUSTOMER_LNAME": "CHAPMAN",
      "CUSTOMER_MNAME": {"@xsi:nil": "true"},
      "CUSTOMER_TYPE": {"@xsi:nil": "true"},
      "CUSTOMER_STATUS": {"@xsi:nil": "true"},
      "GENDER": {"@xsi:nil": "true"},
      "GUID": {"@xsi:nil": "true"},
      "CUSTOMER_SINCE": {"@xsi:nil": "true"},
      "CUSTOMER_CATEGORY": {"@xsi:nil": "true"},
      "OFFER_CODE": "SLHAP",
      "BSF_EXEMPT": {"@xsi:nil": "true"},
      "CUSTOMER_CLASS": {"@xsi:nil": "true"},
      "MEMBERSHIP_TYPE": {"@xsi:nil": "true"},
      "DO_NOT_MAIL": {"@xsi:nil": "true"},
      "DO_NOT_CALL": {"@xsi:nil": "true"},
      "DO_NOT_EMAIL": {"@xsi:nil": "true"},
      "DO_NOT_RENT": {"@xsi:nil": "true"},
      "CUSTOMER_ADDRESS1": {"@xsi:nil": "true"},
      "CUSTOMER_ADDRESS2": {"@xsi:nil": "true"},
      "CITY": {"@xsi:nil": "true"},
      "STATE": {"@xsi:nil": "true"},
      "ZIP": {"@xsi:nil": "true"},
      "COUNTRY": {"@xsi:nil": "true"},
      "CUSTOMER_EMAIL": {"@xsi:nil": "true"},
      "CUSTOMER_PHONE": {"@xsi:nil": "true"},
      "CPC_ATT1_FU": {"@xsi:nil": "true"},
      "CPC_ATT2_FU": {"@xsi:nil": "true"},
      "CPC_ATTR3_FU": {"@xsi:nil": "true"},
      "CPC_ATTR4_FU": {"@xsi:nil": "true"},
      "CPC_ATTR5_FU": {"@xsi:nil": "true"},
      "ORD_DETAIL_TAB": {"ORD_DETAIL_TAB_ITEM":[
                  {
            "ORDER_NUMBER": "21467204",
            "BUSINESS_UNIT": "BEACHBODY",
            "ORDER_TYPE": "STANDARD_BB",
            "OFFER_CODE": "TMTC9",
            "PAYMENT_TERM": "2 Pay",
            "SHIP_METHOD": "000001_UPS_P_BASIC",
            "ORDER_STATUS": "CLOSED",
            "ORDERED_DATE": "2009-01-18T10:04:03.000-08:00",
            "REQUEST_DATE": "2009-01-18T09:10:43.000-08:00",
            "BILL_TO_LOC": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS1": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS2": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS3": {"@xsi:nil": "true"},
            "BILL_TO_CITY": {"@xsi:nil": "true"},
            "BILL_TO_COUNTY": {"@xsi:nil": "true"},
            "BILL_TO_STATE": {"@xsi:nil": "true"},
            "BILL_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "BILL_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_LOC": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS1": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS2": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS3": {"@xsi:nil": "true"},
            "SHIP_TO_CITY": {"@xsi:nil": "true"},
            "SHIP_TO_STATE": {"@xsi:nil": "true"},
            "SHIP_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SUB_TOTAL": {"@xsi:nil": "true"},
            "SHIPPING_HANDLING_CHARGE": {"@xsi:nil": "true"},
            "TAX": {"@xsi:nil": "true"},
            "ORDER_TOTAL": {"@xsi:nil": "true"},
            "CONT_PROGRAM": {"@xsi:nil": "true"},
            "PROGRAM_LEVEL": {"@xsi:nil": "true"},
            "INITIAL_ORDER": {"@xsi:nil": "true"},
            "PRIVIOUS_ORDER": {"@xsi:nil": "true"},
            "PAYMENT_TYPE": {"@xsi:nil": "true"},
            "CARD_TYPE": {"@xsi:nil": "true"},
            "CREDIT_CARD_NO": {"@xsi:nil": "true"},
            "EXPIRAY_DATE": {"@xsi:nil": "true"},
            "CC_HOLDER_NAME": {"@xsi:nil": "true"},
            "RECEIPT_METHOD": {"@xsi:nil": "true"},
            "PC_ATT1_FU": {"@xsi:nil": "true"},
            "PC_ATT2_FU": {"@xsi:nil": "true"},
            "PC_ATTR3_FU": {"@xsi:nil": "true"},
            "PC_ATTR4_FU": {"@xsi:nil": "true"},
            "PC_ATTR5_FU": {"@xsi:nil": "true"},
            "LINE_DETAIL_TAB": {"LINE_DETAIL_TAB_ITEM":             [
                              {
                  "LINE_NUMBER": "1",
                  "ORDERED_ITEM": "TMDVD2106",
                  "ITEM_DESC": "10-MINUTE TRAINER DVD PKG + BONUS WORKOUT - MEDIUM",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "79.9",
                  "SHIPPED_QUANTITY": "1",
                  "SCHEDULE_SHIP_DATE": "2009-01-18T23:59:00.000-08:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               },
                              {
                  "LINE_NUMBER": "2",
                  "ORDERED_ITEM": "TMDVD2127",
                  "ITEM_DESC": "10-MINUTE TRAINER DELUXE DVD PKG-MEDIUM RESISTANCE",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "79.9",
                  "SHIPPED_QUANTITY": "1",
                  "SCHEDULE_SHIP_DATE": "2009-01-18T23:59:00.000-08:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               },
                              {
                  "LINE_NUMBER": "3",
                  "ORDERED_ITEM": "MISCUEXPSHP",
                  "ITEM_DESC": "UPGRADE TO EXPRESS SHIPPING - NO EXTRA CHARGE",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "0",
                  "SHIPPED_QUANTITY": {"@xsi:nil": "true"},
                  "SCHEDULE_SHIP_DATE": "2009-01-18T23:59:00.000-08:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               }
            ]},
            "ORDER_MOD_HIST_REC_TAB": null
         },
                  {
            "ORDER_NUMBER": "47171376",
            "BUSINESS_UNIT": "BEACHBODY",
            "ORDER_TYPE": "WEB ORDER_BB",
            "OFFER_CODE": "WEBBB",
            "PAYMENT_TERM": "1 Pay",
            "SHIP_METHOD": "000001_FEDEX_P_GND",
            "ORDER_STATUS": "CLOSED",
            "ORDERED_DATE": "2014-02-03T11:24:07.000-08:00",
            "REQUEST_DATE": "2014-02-03T11:45:05.000-08:00",
            "BILL_TO_LOC": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS1": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS2": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS3": {"@xsi:nil": "true"},
            "BILL_TO_CITY": {"@xsi:nil": "true"},
            "BILL_TO_COUNTY": {"@xsi:nil": "true"},
            "BILL_TO_STATE": {"@xsi:nil": "true"},
            "BILL_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "BILL_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_LOC": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS1": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS2": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS3": {"@xsi:nil": "true"},
            "SHIP_TO_CITY": {"@xsi:nil": "true"},
            "SHIP_TO_STATE": {"@xsi:nil": "true"},
            "SHIP_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SUB_TOTAL": {"@xsi:nil": "true"},
            "SHIPPING_HANDLING_CHARGE": {"@xsi:nil": "true"},
            "TAX": {"@xsi:nil": "true"},
            "ORDER_TOTAL": {"@xsi:nil": "true"},
            "CONT_PROGRAM": {"@xsi:nil": "true"},
            "PROGRAM_LEVEL": {"@xsi:nil": "true"},
            "INITIAL_ORDER": {"@xsi:nil": "true"},
            "PRIVIOUS_ORDER": {"@xsi:nil": "true"},
            "PAYMENT_TYPE": {"@xsi:nil": "true"},
            "CARD_TYPE": {"@xsi:nil": "true"},
            "CREDIT_CARD_NO": {"@xsi:nil": "true"},
            "EXPIRAY_DATE": {"@xsi:nil": "true"},
            "CC_HOLDER_NAME": {"@xsi:nil": "true"},
            "RECEIPT_METHOD": {"@xsi:nil": "true"},
            "PC_ATT1_FU": {"@xsi:nil": "true"},
            "PC_ATT2_FU": {"@xsi:nil": "true"},
            "PC_ATTR3_FU": {"@xsi:nil": "true"},
            "PC_ATTR4_FU": {"@xsi:nil": "true"},
            "PC_ATTR5_FU": {"@xsi:nil": "true"},
            "LINE_DETAIL_TAB": {"LINE_DETAIL_TAB_ITEM":             {
               "LINE_NUMBER": "1",
               "ORDERED_ITEM": "RBDVD2122US",
               "ITEM_DESC": "Rockin Body DVD Package 119 7SH",
               "ORDERED_QUANTITY": "1",
               "LINE_AMOUNT": "19.95",
               "SHIPPED_QUANTITY": "1",
               "SCHEDULE_SHIP_DATE": "2014-02-03T23:59:00.000-08:00",
               "DATE_SHIPPED": {"@xsi:nil": "true"},
               "LINE_STATUS": {"@xsi:nil": "true"},
               "ITEM_TYPE": {"@xsi:nil": "true"},
               "LPC_ATT1_FU": {"@xsi:nil": "true"},
               "LPC_ATT2_FU": {"@xsi:nil": "true"},
               "LPC_ATTR3_FU": {"@xsi:nil": "true"},
               "LPC_ATTR4_FU": {"@xsi:nil": "true"},
               "LPC_ATTR5_FU": {"@xsi:nil": "true"}
            }},
            "ORDER_MOD_HIST_REC_TAB": null
         },
                  {
            "ORDER_NUMBER": "65726495",
            "BUSINESS_UNIT": "BEACHBODY",
            "ORDER_TYPE": "STANDARD_BB",
            "OFFER_CODE": "CZUS005",
            "PAYMENT_TERM": "1 Pay",
            "SHIP_METHOD": "000001_FEDEX_P_SMARTPOST",
            "ORDER_STATUS": "CLOSED",
            "ORDERED_DATE": "2016-05-16T20:03:20.000-07:00",
            "REQUEST_DATE": "2016-05-16T18:20:49.000-07:00",
            "BILL_TO_LOC": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS1": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS2": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS3": {"@xsi:nil": "true"},
            "BILL_TO_CITY": {"@xsi:nil": "true"},
            "BILL_TO_COUNTY": {"@xsi:nil": "true"},
            "BILL_TO_STATE": {"@xsi:nil": "true"},
            "BILL_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "BILL_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_LOC": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS1": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS2": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS3": {"@xsi:nil": "true"},
            "SHIP_TO_CITY": {"@xsi:nil": "true"},
            "SHIP_TO_STATE": {"@xsi:nil": "true"},
            "SHIP_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SUB_TOTAL": {"@xsi:nil": "true"},
            "SHIPPING_HANDLING_CHARGE": {"@xsi:nil": "true"},
            "TAX": {"@xsi:nil": "true"},
            "ORDER_TOTAL": {"@xsi:nil": "true"},
            "CONT_PROGRAM": {"@xsi:nil": "true"},
            "PROGRAM_LEVEL": {"@xsi:nil": "true"},
            "INITIAL_ORDER": {"@xsi:nil": "true"},
            "PRIVIOUS_ORDER": {"@xsi:nil": "true"},
            "PAYMENT_TYPE": {"@xsi:nil": "true"},
            "CARD_TYPE": {"@xsi:nil": "true"},
            "CREDIT_CARD_NO": {"@xsi:nil": "true"},
            "EXPIRAY_DATE": {"@xsi:nil": "true"},
            "CC_HOLDER_NAME": {"@xsi:nil": "true"},
            "RECEIPT_METHOD": {"@xsi:nil": "true"},
            "PC_ATT1_FU": {"@xsi:nil": "true"},
            "PC_ATT2_FU": {"@xsi:nil": "true"},
            "PC_ATTR3_FU": {"@xsi:nil": "true"},
            "PC_ATTR4_FU": {"@xsi:nil": "true"},
            "PC_ATTR5_FU": {"@xsi:nil": "true"},
            "LINE_DETAIL_TAB": {"LINE_DETAIL_TAB_ITEM":             [
                              {
                  "LINE_NUMBER": "1",
                  "ORDERED_ITEM": "CZDVD2101NF",
                  "ITEM_DESC": "CIZE DVD Package NF",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "59.85",
                  "SHIPPED_QUANTITY": "1",
                  "SCHEDULE_SHIP_DATE": "2016-05-16T23:59:00.000-07:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               },
                {
                  "LINE_NUMBER": "2",
                  "ORDERED_ITEM": "MISCUEXPSHP",
                  "ITEM_DESC": "UPGRADE TO EXPRESS SHIPPING - NO EXTRA CHARGE",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "0",
                  "SHIPPED_QUANTITY": {"@xsi:nil": "true"},
                  "SCHEDULE_SHIP_DATE": "2016-05-16T23:59:00.000-07:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               }
            ]},
            "ORDER_MOD_HIST_REC_TAB": null
         },
                  {
            "ORDER_NUMBER": "50590138",
            "BUSINESS_UNIT": "BEACHBODY",
            "ORDER_TYPE": "STANDARD_BB",
            "OFFER_CODE": "YFUS003",
            "PAYMENT_TERM": "3 Pay",
            "SHIP_METHOD": "000001_FEDEX_P_SMARTPOST",
            "ORDER_STATUS": "CLOSED",
            "ORDERED_DATE": "2014-07-07T08:56:19.000-07:00",
            "REQUEST_DATE": "2014-07-07T08:11:09.000-07:00",
            "BILL_TO_LOC": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS1": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS2": {"@xsi:nil": "true"},
            "BILL_TO_ADDRESS3": {"@xsi:nil": "true"},
            "BILL_TO_CITY": {"@xsi:nil": "true"},
            "BILL_TO_COUNTY": {"@xsi:nil": "true"},
            "BILL_TO_STATE": {"@xsi:nil": "true"},
            "BILL_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "BILL_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_LOC": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS1": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS2": {"@xsi:nil": "true"},
            "SHIP_TO_ADDRESS3": {"@xsi:nil": "true"},
            "SHIP_TO_CITY": {"@xsi:nil": "true"},
            "SHIP_TO_STATE": {"@xsi:nil": "true"},
            "SHIP_TO_POSTAL_CODE": {"@xsi:nil": "true"},
            "SHIP_TO_COUNTRY_CODE": {"@xsi:nil": "true"},
            "SUB_TOTAL": {"@xsi:nil": "true"},
            "SHIPPING_HANDLING_CHARGE": {"@xsi:nil": "true"},
            "TAX": {"@xsi:nil": "true"},
            "ORDER_TOTAL": {"@xsi:nil": "true"},
            "CONT_PROGRAM": {"@xsi:nil": "true"},
            "PROGRAM_LEVEL": {"@xsi:nil": "true"},
            "INITIAL_ORDER": {"@xsi:nil": "true"},
            "PRIVIOUS_ORDER": {"@xsi:nil": "true"},
            "PAYMENT_TYPE": {"@xsi:nil": "true"},
            "CARD_TYPE": {"@xsi:nil": "true"},
            "CREDIT_CARD_NO": {"@xsi:nil": "true"},
            "EXPIRAY_DATE": {"@xsi:nil": "true"},
            "CC_HOLDER_NAME": {"@xsi:nil": "true"},
            "RECEIPT_METHOD": {"@xsi:nil": "true"},
            "PC_ATT1_FU": {"@xsi:nil": "true"},
            "PC_ATT2_FU": {"@xsi:nil": "true"},
            "PC_ATTR3_FU": {"@xsi:nil": "true"},
            "PC_ATTR4_FU": {"@xsi:nil": "true"},
            "PC_ATTR5_FU": {"@xsi:nil": "true"},
            "LINE_DETAIL_TAB": {"LINE_DETAIL_TAB_ITEM":             [
                              {
                  "LINE_NUMBER": "1",
                  "ORDERED_ITEM": "21DDVD2101NF",
                  "ITEM_DESC": "21 Day Fix Essential Package  NF",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "59.85",
                  "SHIPPED_QUANTITY": "1",
                  "SCHEDULE_SHIP_DATE": "2014-07-07T23:59:00.000-07:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               },
                              {
                  "LINE_NUMBER": "2",
                  "ORDERED_ITEM": "MISCUEXPSHP",
                  "ITEM_DESC": "UPGRADE TO EXPRESS SHIPPING - NO EXTRA CHARGE",
                  "ORDERED_QUANTITY": "1",
                  "LINE_AMOUNT": "0",
                  "SHIPPED_QUANTITY": {"@xsi:nil": "true"},
                  "SCHEDULE_SHIP_DATE": "2014-07-07T23:59:00.000-07:00",
                  "DATE_SHIPPED": {"@xsi:nil": "true"},
                  "LINE_STATUS": {"@xsi:nil": "true"},
                  "ITEM_TYPE": {"@xsi:nil": "true"},
                  "LPC_ATT1_FU": {"@xsi:nil": "true"},
                  "LPC_ATT2_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR3_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR4_FU": {"@xsi:nil": "true"},
                  "LPC_ATTR5_FU": {"@xsi:nil": "true"}
               }
            ]},
            "ORDER_MOD_HIST_REC_TAB": null
         }
      ]}
   }}
}}' ;    
	
	
	$obj = json_decode($jsondata,true);
	 // echo  $obj [0][0]['CUSTOMER_FNAME'];
	echo "<pre>";
	print_r($obj);
	//$result = $obj['OutputParameters']['P_CUST_ORDER_DETAILS_TAB'];
	//print_r($result['P_CUST_ORDER_DETAILS_TAB_ITEM']['CUSTOMER_FNAME']);
	
	
	 
		
   }
	
}

