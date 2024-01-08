<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();
$CI->model('Incident');

use RightNow\Connect\v1_2 as RNCPHP,
    RightNow\Connect\Knowledge\v1 as KnowledgeFoundation,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Api,
    RightNow\Internal\Sql\Incident as Sql,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
    RightNow\ActionCapture,
    RightNow\Utils\Config,
    RightNow\Libraries\AbuseDetection;
	

class CreditCardInfo extends \RightNow\Models\Incident{
    function __construct()
    {
        parent::__construct();
    }
    
    //----------------------------------------checking whether the contact exists 
    function CreditCardUpdate1($data) {
	      $CI = get_instance();
		  $orgID = $CI->session->getProfileData("orgID");
		  $cID = $CI->session->getProfileData("contactID");
		  $array = json_decode(json_encode($data), True);
		  $dataArray = array(); 
	  		   
		  for($i=0; $i < count($array); $i++) 
	 		 {
			  	$fieldName = explode(".",$array[$i]["name"]);
			  	$dataArray[$fieldName[2]] = $array[$i]["value"];
	 		 }// end for 
	  		$return = array();
			try{
				
				$contact = RNCPHP\Contact::find("Emails.Address = '".$dataArray["email"]."'");
				
				$return["count"] = count($contact);
				

			}
			catch(Connect\ConnectAPIErrorBase $e) {
			
			}
		
    		return $this->getResponseObject($return, 'is_object');
    }
    
    //---------------------------------------------------------------
	function CreditCardUpdate($data) {
	  $CI = get_instance();
	  $orgID = $CI->session->getProfileData("orgID");
	  $cID = $CI->session->getProfileData("contactID");
	  $array = json_decode(json_encode($data), True);
	  
	  $dataArray = array(); 
	  // convert the json object to an array    
	  for($i=0; $i < count($array); $i++) 
	  {
	  	$fieldName = explode(".",$array[$i]["name"]);
	  	$dataArray[$fieldName[2]] = $array[$i]["value"];
	  }// end for 
	  
	  //print_r($dataArray["email"]);
	  try
	  {
	  
		  $msg = array();
		  $ref_num = 0;
		  //-------------if contact dos not exist----------------------------------------------
		  if($dataArray["First"] != "" && $dataArray["Last"] != "" ){
			
			$contact = new RNCPHP\Contact();
			$contact->Name->First = $dataArray["First"];
			$contact->Name->Last =$dataArray["Last"];
			$contact->Emails = new RNCPHP\EmailArray();
			$contact->Emails[0] = new RNCPHP\Email();
			$contact->Emails[0]->AddressType=new RNCPHP\NamedIDOptList();
			$contact->Emails[0]->AddressType->LookupName = "Email - Primary";
			$contact->Emails[0]->Address = $dataArray["email"];
			/*contact country [jithin]*/
			$contact->Address = new RNCPHP\Address();
			$contact->Address->Country = RNCPHP\Country::fetch($dataArray["Country"]); 
			/*contact country [jithin]*/
			$contact->save();
			$updateAccountObj = new RNCPHP\Update_Acnt\Update_Account_Info();
			$updateAccountObj->full_name = $dataArray["full_name"];
			$updateAccountObj->credit_card_number = $dataArray["credit_card_number"];
			//$updateAccountObj->security_code = $dataArray["security_code"];
			$updateAccountObj->zip_code = $dataArray["zip_code"];
			$updateAccountObj->exp_month = null;
			$updateAccountObj->exp_year = null;
			if (strlen($dataArray["exp_month"]) > 0) {
				$updateAccountObj->exp_month = RNCPHP\Update_Acnt\exp_month::fetch(intval($dataArray["exp_month"]) + 1);
			}
			if (strlen($dataArray["exp_year"]) > 0) {
				$updateAccountObj->exp_year = RNCPHP\Update_Acnt\exp_year::fetch(intval($dataArray["exp_year"]) + 1);
			}
			$updateAccountObj->bill_to_address = $dataArray["bill_to_address"];
		    //$updateAccountObj->reference_number = $ref_num;
		  
		    if(strlen($dataArray["apt_suite"]) > 0 ){
			 $updateAccountObj->apt_suite = $dataArray["apt_suite"];
		    }
		    $updateAccountObj->bill_to_city = $dataArray["bill_to_city"];
		    $updateAccountObj->bill_to_postal_code = $dataArray["bill_to_postal_code"];
		    $countries = RNCPHP\Country::fetch(intval($dataArray["Country"]));
		    $states = $countries ->Provinces;
		   // $updateAccountObj->StateorProvince = "YU";
		    //print_r($states);
		    for($i = 0; $i < count($states); $i++) {
				if ($states[$i]->ID == intval($dataArray["StateOrProvince"])) {
					$updateAccountObj->StateorProvince = $states[$i]->Name;
			    }
		    }
		    $updateAccountObj->Country = $countries->LookupName;
			
			$card_type = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Update_Acnt\\credit_card_type");
				
				
				foreach($card_type as $items)
				{
					if($items->ID == intval($dataArray["credit_card_type"]))
					{
						$updateAccountObj->credit_card_type = $items->ID;
					}
				}
			
			$updateAccountObj->save();
				/*------------------------------------------------------------*/
			$incidentObj = new RNCPHP\incident();
			$incidentObj->subject = "Update Credit Card";
			//$incidentObj-> = RNCPHP\Contact::fetch($contact->ID);
			$incidentObj->PrimaryContact = RNCPHP\Contact::fetch($contact->ID);
			//$incidentObj->Update_Account_Info = $updateAccountObj->ID;
			//$incidentObj->Update_Account_Info = RNCPHP\Update_Acnt\updateAccountObj::fetch($updateAccountObj->ID);
			$incidentObj->CustomFields->Update_Acnt->Update_Account_Info = RNCPHP\Update_Acnt\Update_Account_Info::fetch($updateAccountObj->ID);
			
			//=================for setting value in custom field form routing====12-7-2017
			
			$formRoute = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.form_routing"); 
				
				
				foreach($formRoute as $items)
				{
					if($items->LookupName == "Update Credit Card")
					{
						$incidentObj->CustomFields->c->form_routing->ID = $items->ID;
					}
				}  
			//============================================================================
			
			
			$incidentObj->save();
			//$ref_num = $incidentObj->ID;
			//$msg["msg"] = "Your request has been recieved. For future reference please use the following reference #".$incidentObj->ReferenceNumber;
			
		/*	$msg["msg"] ="<b>Your Credit Card Update Request has been submitted for processing</b><br/><br/>Please allow 24 hours for these changes to be applied to your account<br/><br/>The reference number for this request is :#".$incidentObj->ReferenceNumber."<br/><br/>For further assistance, please use the links below to chat with an agent<br/><br/><a href=''>United States</a>   ".'    '."<a href=''>Canada</a> <br/>";
			
		*/
		
		$msg["msg"] ="<b>Your credit card update Request has been submitted for processing</b><br/><br/>Please allow 24 hours for these changes to be applied to your account<br/><br/>The reference number for this request is :<span>#".$incidentObj->ReferenceNumber."</span>";
		

		
			
			
		  } 
		  else{
			$updateAccountObj = new RNCPHP\Update_Acnt\Update_Account_Info();
			$updateAccountObj->full_name = $dataArray["full_name"];
			$updateAccountObj->credit_card_number = $dataArray["credit_card_number"];
			//$updateAccountObj->security_code = $dataArray["security_code"];
			$updateAccountObj->zip_code = $dataArray["zip_code"];
			$updateAccountObj->exp_month = null;
			$updateAccountObj->exp_year = null;
			if (strlen($dataArray["exp_month"]) > 0) {
				$updateAccountObj->exp_month = RNCPHP\Update_Acnt\exp_month::fetch(intval($dataArray["exp_month"]) + 1);
			}
			if (strlen($dataArray["exp_year"]) > 0) {
				$updateAccountObj->exp_year = RNCPHP\Update_Acnt\exp_year::fetch(intval($dataArray["exp_year"]) + 1);
			}
			$updateAccountObj->bill_to_address = $dataArray["bill_to_address"];
		    //$updateAccountObj->reference_number = $ref_num;
		  
		    if(strlen($dataArray["apt_suite"]) > 0 ){
			 $updateAccountObj->apt_suite = $dataArray["apt_suite"];
		    }
		    $updateAccountObj->bill_to_city = $dataArray["bill_to_city"];
		    $updateAccountObj->bill_to_postal_code = $dataArray["bill_to_postal_code"];
		    $countries = RNCPHP\Country::fetch(intval($dataArray["Country"]));
		    $states = $countries ->Provinces;
		   // $updateAccountObj->StateorProvince = "YU";
		    //print_r($states);
		    for($i = 0; $i < count($states); $i++) {
				if ($states[$i]->ID == intval($dataArray["StateOrProvince"])) {
					$updateAccountObj->StateorProvince = $states[$i]->Name;
			    }
		    }
		    $updateAccountObj->Country = $countries->LookupName;
			$card_type = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Update_Acnt\\credit_card_type");
				
				
				foreach($card_type as $items)
				{
					if($items->ID == intval($dataArray["credit_card_type"]))
					{
						$updateAccountObj->credit_card_type = $items->ID;
					}
				}
			$updateAccountObj->save();  
			$incidentObj = new RNCPHP\incident();
			$incidentObj->subject = "Update Credit Card";
			//$incidentObj-> = RNCPHP\Contact::fetch($contact->ID);
			$contact = RNCPHP\Contact::find("Emails.Address = '".$dataArray["email"]."'");
			$incidentObj->PrimaryContact = RNCPHP\Contact::fetch($contact[0]->ID);
			//$incidentObj->Update_Account_Info = $updateAccountObj->ID;
			//$incidentObj->Update_Account_Info = RNCPHP\Update_Acnt\Update_Account_Info::fetch($updateAccountObj->ID);
			$incidentObj->CustomFields->Update_Acnt->Update_Account_Info = RNCPHP\Update_Acnt\Update_Account_Info::fetch($updateAccountObj->ID);
			
			//updating below code contact country[by jithin]
			 
			 $res = RNCPHP\ROQL::queryObject("select Contact from Contact where Contact.Emails.Address='".$dataArray["email"]."'")->next();
			 if($res->count()>0) 
			 {
			    try{
					  $updatecontact = $res->next();
					  $updatecontact->Address->Country = RNCPHP\Country::fetch($dataArray["Country"]);  
					  $updatecontact->save();
					}//end of try
					catch(Exception $err){
					   
					}//end of catch
			 }
			//updating above code contact country[by jithin]

			//=================for setting value in custom field form routing====12-7-2017
			
			$formRoute = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.form_routing"); 
				
				
				foreach($formRoute as $items)
				{
					if($items->LookupName == "Update Credit Card")
					{
						$incidentObj->CustomFields->c->form_routing->ID = $items->ID;
					}
				}  
			//============================================================================
			
			$incidentObj->save();
			//$ref_num = $incidentObj->ID;
			//$incidentObj->Update_Account_Info = RNCPHP\Update_Acnt\updateAccountObj::fetch($updateAccountObj->ID);
			
			//$msg["msg"] = "Your request has been recieved. For future reference please use the following reference <b>#".$incidentObj->ReferenceNumber."</b>";
			
			/*
		  	$msg["msg"] ="<b>Your Credit Card Update Request has been submitted for processing</b><br/><br/>Please allow 24 hours for these changes to be applied to your account<br/><br/>The reference number for this request is :#".$incidentObj->ReferenceNumber."<br/><br/>For further assistance, please use the links below to chat with an agent<br/><br/><a href=''>United States</a>   ".'    '."<a href=''>Canada</a> <br/>";	
*/

$msg["msg"] ="<b>Your credit card update Request has been submitted for processing</b><br/><br/>Please allow 24 hours for these changes to be applied to your account<br/><br/>The reference number for this request is :<span>#".$incidentObj->ReferenceNumber."</span>";
		
			
	  }
	  
	
	 }
	  catch(Connect\ConnectAPIErrorBase $e)
	  {
	         return $this->getResponseObject(null, null, $e->getMessage());
	  }
	  return $this->getResponseObject($msg, 'is_object');
	}
	
  }
