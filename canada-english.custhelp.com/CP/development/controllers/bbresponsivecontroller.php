<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Utils\Text,
	RightNow\Libraries\ResponseObject,
	RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Libraries\SEO;
	

class bbresponsivecontroller extends \RightNow\Controllers\Base
{
   function coach_consent_remove()
  {
	$data = json_decode($this->input->post('form'));

	foreach($data as $item)
		{
			if($item->name == "Incident.CustomFields.c.free_text")
			{
				$contactid = $item->value;
				$item->value = "";
			}
		}
		
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
				$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
			}
		$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$a=$results->result['transaction']['incident']['value'];
		$CI = get_instance();
		$CI->model('custom/bbresponsive')->remove_coach_consent($contactid);
	$trans = array();
	$trans['coach_consent_remove'] = array("key" => "coach_consent_remove", "value" => "success");
	$trans['incident'] = array("key" => "i_id", "value" => $a);
	//$trans['incident'] = array("key" => "remove", "value" => "success");
	$formResult = new ResponseObject(null);
	$formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());
	$this->_echoJSON($formResult->toJson());
	
  }
  function coach_consent_submit()
  {
	  $data = json_decode($this->input->post('form'));
	  
	  
	  foreach($data as $item)
		{
			if($item->name == "signature")
			{
				$signature = $item->value;
			}
		}
		
		array_push($data,$item);
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
				$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
			}
		$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$a=$results->result['transaction']['incident']['value'];
		$CI = get_instance();
		$CI->model('custom/bbresponsive')->save_private_note_for_coach($a,$signature);
		$trans = array();
		$trans['incident'] = array("key" => "i_id", "value" => $a);
		
		$formResult = new ResponseObject(null);
		$formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());
		$this->_echoJSON($formResult->toJson());
	
	
  }
  
  function nice_chat($val){
   	  $incidentid = '';
	  $first_name = '';
	  $last_name = '';
	  $chatskillid = '';
	  $thread = '';
	  $CI = get_instance();	
	  $CI->session->setSessionData(array('ischatconnected' => 'true'));
	  $data = json_decode($this->input->post('form'));
		foreach($data as $item)
		{
			if($item->name == "Incident.CustomFields.c.free_text")
			{
				$item->name = "Incident.Category";
				$item->value =intval($item->value);
			}
			if($item->name == "Incident.CustomFields.c.coachcustomernumber")
			{
				$item->name = "Incident.Product";
				$item->value =intval($item->value);
			}
			if($item->name == "Contact.Name.First")
			{
				$first_name = $item->value;
			}
			if($item->name == "Contact.Name.Last")
			{
				$last_name = $item->value;
			}
			if($item->name == "Incident.Threads")
			{
				
				//$CI->session->setSessionData(array('initialchat' => $item->value));
				$thread = urlencode($item->value);
			}
					/* Added for SSE-3438 ticket */
			if($item->name == "Incident.CustomFields.c.member_type_new")
			{
				$membertypenew = $item->value;
          
			}/* Added for SSE-3438 ticket */
	
		}
		$chatskillid = $this->model('custom/bbresponsive')->setchatskill($val,$membertypenew);
		//$chatskill = array("chatskill".$val=>$chatskillid);		
		//$CI->session->setSessionData($chatskill);
		array_push($data,$item);
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
				$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
			}
			$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
			$a=$results->result['transaction']['incident']['value'];
			if(\RightNow\Utils\Framework::isLoggedIn()) 		
			{	
			$incidentid=$results->result['transaction']['incident']['value'];
			}
			else
			{
			$incidentid = $this->model('custom/bbresponsive')->FetchIncidentID($a);
			}
			$datalog = "----------------------------incidentid:".$incidentid."CatId:".$val."first_name:".$first_name."last_name:".$last_name."chatskillid:".$chatskillid."thread:".$thread;
			//error_log($datalog,3, '/cgi-bin/canada_english.cfg/scripts/cp/customer/development/views/pages/error_log/emptynccontroller.txt');
			$trans = array();
			//$trans['facebook'] = array("key" => "contextId", "value" => $contextId);
			//$trans['facebookpageid'] = array("key" => "facebookPageId", "value" => $facebookPageId);
			//$trans['incident'] = array("key" => "i_id", "value" => $incidentId);
			$trans['incident'] = array("key" => "incidentid", "value" => $incidentid);
			$trans['category'] = array("key" => "catid", "value" => $val);
			if(!empty($first_name))
			$trans['firstName'] = array("key" => "fname", "value" => $first_name);
			if(!empty($last_name))
			$trans['lastName'] = array("key" => "lname", "value" => $last_name);
			if(!empty($chatskillid))
			$trans['skillid'] = array("key" => "skillid", "value" => $chatskillid);
			if(!empty($thread))
			$trans['Initialquestion'] = array("key" => "incidentquery", "value" => $thread);
			$formResult = new ResponseObject(null);
			$formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());
			$this->_echoJSON($formResult->toJson());
  
  }

//Call Me Now start

function nice_call($val){
	try{
  logmessage('inside call Me now');
  $incidentid = '';
$first_name = '';
$last_name = '';
$voiceskillid = '';
$thread = '';
$country_code = \RightNow\Utils\Config::getConfig(1000055);  //CUSTOM_CFG_PHONE_COUNTRY_CODE

$CI = get_instance();	

	// To update contact type start		
	$contact = get_instance()->model('Contact')->get()->result;		
	$contact_type = $contact->ContactType->ID;		
	$contact_id = $contact->ID;		
			
	$contact_country = isset($contact->Address->Country)?$contact->Address->Country->ID:0;		
	$contact_country_name = isset($contact->Address->Country)?		
	$contact->Address->Country->LookupName:0;		
			
	$contact_full = $this->model('custom/bbresponsive')->fetchauthorizeduser($contact_id);		
	$contact_email = $contact_full->Emails[0]->Address;		
	$member_typ = $contact_full->CustomFields->c->member_type;		
	$coach_id = $contact_full->CustomFields->c->coach_id;	
	
	$guid = $contact_full->CustomFields->c->customer_guid;	

		if ($guid){	
//			echo ("guid");	
			$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("guid",$contact_country_name,null,null,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,$guid);	
		} else {	
//			echo ("email");	
		$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,null);	
		}	


	//$customerupdate = $this->model('custom/bbresponsive')->CustomerLookup("email",$contact_country_name,null,$contact_email,null,null,null,"CUST",$member_typ,$contact_type,$coach_id,$guid);		
	// To update contact type end	

//$CI->session->setSessionData(array('ischatconnected' => 'true'));
$data = json_decode($this->input->post('form'));
if($data->name == "Incident.CustomFields.c.billing_zip_postal_code")
{
	$phnumber = $data->value;
}
logmessage($phnumber);

  foreach($data as $item)
  {
	  if($item->name == "Incident.CustomFields.c.free_text")
	  {
		  $item->name = "Incident.Category";
		  $item->value =intval($item->value);
	  }
	  if($item->name == "Incident.CustomFields.c.coachcustomernumber")
	  {
		$item->name = "Incident.CustomFields.c.free_text";
		$top_cat =intval($item->value);
		logmessage($top_cat);
		logmessage("top_cat");
	  }
	  if($item->name == "Incident.CustomFields.c.form_routing")
		{
			//$item->name = "Incident.CustomFields.c.form_routing";
			$item->value = 1960;
		}
	  if($item->name == "Incident.CustomFields.c.account_verified")
		{
			$item->value = 1;
		}
	  if($item->name == "Incident.CustomFields.c.contact_channel")
		{
			//$item->name = "Incident.CustomFields.c.form_routing";
			$item->value = 1474;
		} 
	  if($item->name == "Incident.CustomFields.c.billing_zip_postal_code")
		{
			logmessage("inside bill");
			$item->name = "Incident.CustomFields.c.free_text";
			$phnumber = $item->value;
			logmessage($phnumber);
			logmessage("phnumber");
		}
	  if($item->name == "Incident.Queue")
	  {
		  $queue = intval($item->value);
	
	  }
  }
  


  //$chatskill = array("chatskill".$val=>$chatskillid);		
  //$CI->session->setSessionData($chatskill);
  array_push($data,$item);

			   if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
	  //  $CI = get_instance();
		$a=$results->result['transaction']['incident']['value'];
		$contactid = $this->session->getProfile()->c_id->value;
		$id = $CI->model('custom/bbresponsive')->callmenow($a,$cat,"id",$phnumber,$contactid);
		$CI->session->setSessionData(array('id' => $a));
		$chathours = $CI->model('custom/chathours')->getChatHours("callmenow");
		$CI->session->setSessionData(array('iscallmenowavailable' => 'true'));
	//	$incidentId = $id;
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
		$incidentid=$results->result['transaction']['incident']['value'];
		}
		else
		{
		$incidentid = $this->model('custom/bbresponsive')->FetchIncidentID($a);
		}
		$number = $country_code.$phnumber;   // contry code should be taken from configuration
  
  $voiceskillid = $this->model('custom/bbresponsive')->setvoiceskill($val,$membertypenew);
 // $contactdate = "Select Contact.CustomFields.c.mostrecentcoachdate from Contact where ID = $contactid";
 $contQuery="Select Contact.CustomFields.c.mostrecentcoachdate from Contact where ID = $contactid" ;
 $primarycontact = RNCPHP\ROQL::query($contQuery)->next()->next();
 $contactdate = $primarycontact['mostrecentcoachdate'];
// $contacttype = RNCPHP\Contact::fetch($contactid);
 $contacttype = $this->model('custom/bbresponsive')->fetchauthorizeduser($contactid);
 //$coachdate = date('Y-d-m Z', strtotime($contactdate));
 if(!empty($contactdate)){
//	$coachdate = date('Y-d-m Z', strtotime($contactdate));
   $coachdate = date('Y-m-d', strtotime($contactdate. ' + 1 days'));
   } else {
	 $coachdate ="";
   }

  logmessage($coachdate);
  logmessage($voiceskillid);
  logmessage($number);
  logmessage('id');
  logmessage($incidentid);


	 $datalog = "----------------------------incidentid:".$incidentid."voiceskillid:".$voiceskillid."coachdate:".$coachdate."phnumber:".$number;

	  $trans = array();

	  //$trans['incident'] = array("key" => "incidentid", "value" => $incidentid);
	  if(!empty($incidentid))
	  $trans['incidentid'] = array("key" => "incidentid", "value" => $incidentid);
	//  $trans['category'] = array("key" => "catid", "value" => $val);
	 // if(!empty($first_name))
	 // $trans['firstName'] = array("key" => "fname", "value" => $first_name);
	 // if(!empty($last_name))
	 // $trans['lastName'] = array("key" => "lname", "value" => $last_name);
	  if(!empty($voiceskillid))
	  $trans['skillid'] = array("key" => "skillid", "value" => $voiceskillid);
	  $trans['phnumber'] = array("key" => "phnumber", "value" => $number);
	  if(!empty($coachdate))
	  $trans['coachdate'] = array("key" => "coachdate", "value" => $coachdate);		
	  $formResult = new ResponseObject(null);
	  $formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());
	  $this->_echoJSON($formResult->toJson());
}
			  catch (Exception $e) {
	logmessage( 'Caught exception: '.  $e->getMessage());
	  }

}


  //Call me now Ends


  function emailsubmit($val)
  {
  	$data = json_decode($this->input->post('form'));
	foreach($data as $item)
	{
		if($item->name == "Incident.CustomFields.c.free_text")
		{
			$item->name = "Incident.Category";
			$item->value =intval($val);
		}
	}
/*  $item = new stdClass;
	$item->name = "Incident.Category";
	$item->value = $val;*/
	array_push($data,$item);  
	if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$a=$results->result['transaction']['incident']['value'];
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
		$ref = $this->model('custom/bbresponsive')->FetchRefNo($a);
		$response['result']['transaction']['incident']['key']="refno";
        $response['result']['transaction']['incident']['value']=$ref;
        $response['result']['sessionParam']=\RightNow\Utils\Url::sessionParameter();
        
		}
		else
		{
		$a=$results->result['transaction']['incident']['value'];
		$response['result']['transaction']['incident']['key']="refno";
        $response['result']['transaction']['incident']['value']=$a;
        $response['result']['sessionParam']=\RightNow\Utils\Url::sessionParameter();
		}
	
		$CI = get_instance();
		//The below code will set the category
		//$CI->model('custom/bbresponsive')->save_seleted_category_for_email($a,$val);
		//The above code will set the category
        $CI->session->setSessionData(array('id' => $a));
		
		echo json_encode($response);
		
		
  }
  function docsubmit($val)
  {
  $data = json_decode($this->input->post('form'));
	foreach($data as $item)
	{
		if($item->name == "Incident.CustomFields.c.free_text")
		{
			$item->name = "Incident.Category";
			$item->value =intval($val);
		}
	}
/*  $item = new stdClass;
	$item->name = "Incident.Category";
	$item->value = $val;*/
	array_push($data,$item);  
	if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$a=$results->result['transaction']['incident']['value'];
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
		$ref = $this->model('custom/bbresponsive')->FetchRefNo($a);
		$response['result']['transaction']['incident']['key']="refno";
        $response['result']['transaction']['incident']['value']=$ref;
        $response['result']['sessionParam']=\RightNow\Utils\Url::sessionParameter();
        
		}
		else
		{
		$a=$results->result['transaction']['incident']['value'];
		$response['result']['transaction']['incident']['key']="refno";
        $response['result']['transaction']['incident']['value']=$a;
        $response['result']['sessionParam']=\RightNow\Utils\Url::sessionParameter();
		}
	
		$CI = get_instance();
		//The below code will set the category
		$CI->model('custom/bbresponsive')->save_seleted_category_for_doc($a,$val);
		//The above code will set the category
        $CI->session->setSessionData(array('id' => $a));
		
		echo json_encode($response);
		//echo $results->toJson();
		//echo $a;
		
  }
  function fb($val)
  {
  $general_queue = \RightNow\Utils\Config::getConfig(1000047);  //CUSTOM_CFG_GENERAL_MESSENGER_QUEUE
  
  $star_diamond_messenger_queue = \RightNow\Utils\Config::getConfig(1000048);  //CUSTOM_CFG_STAR_DIAMOND_MESSENGER_QUEUE
  
  $facebook_app_id = \RightNow\Utils\Config::getConfig(1000049);  //CUSTOM_CFG_FACEBOOK_APP_ID
  
  $coach_messenger_queue = \RightNow\Utils\Config::getConfig(1000050); //CUSTOM_CFG_COACH_MESSENGER_QUEUE
  
  $pc_queue  = \RightNow\Utils\Config::getConfig(1000070);  //CUSTOM_CFG_PC_MESSENGER_QUEUE
  
  $data = json_decode($this->input->post('form'));
	foreach($data as $item)
	{
		if($item->name == "Incident.CustomFields.c.free_text")
		{
			$item->name = "Incident.Category";
			$item->value =intval($val);
		}
		
		if($item->name == "Incident.CustomFields.c.form_routing")
		{
			//$item->name = "Incident.CustomFields.c.form_routing";
			$item->value = 1562;
		}
		
		if($item->name == "Incident.CustomFields.c.contact_channel")
		{
			
			$item->value = 1564;
		}
		
		if($item->name == "Incident.CustomFields.c.member_type_new")
		{
			$membertypenew = $item->value;
		}
		
		if($item->name == "Incident.CustomFields.c.life_time_rank")
		{
			$lifetimerank = $item->value;
		}
	}
	
	
	if(!empty($membertypenew))
	{
	  if($membertypenew == 389 || $membertypenew == 398)
	  {
	  	$facebookPageId = $general_queue;
	  }elseif($membertypenew == 1725){
        $facebookPageId = $pc_queue;
      }
	  
	  if($membertypenew == 388)
	  {
	  	if(!empty($lifetimerank))
		{
			if($lifetimerank == 478 || $lifetimerank == 1365)
			{
				$facebookPageId = $coach_messenger_queue;
			}
			if($lifetimerank == 492)
			{
				$facebookPageId = $star_diamond_messenger_queue;
			}
			
		}
	  }
	}
	
	array_push($data,$item);  
	
	    

       if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		
	
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$CI = get_instance();
		$a=$results->result['transaction']['incident']['value'];
		$id = $CI->model('custom/bbresponsive')->save_seleted_category_for_fb($a,$val,"id");
		//The above code will set the category
        $CI->session->setSessionData(array('id' => $a));
		$incidentId = $id;
		
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
		$incidentRefNo = $CI->model('custom/bbresponsive')->save_seleted_category_for_fb($a,$val,"refno");
		//print_r($incidentRefNo);
		}
		else
		{
		
		//The below code will set the category
		$incidentRefNo = $a;
		}
		
        //$key = '26534b34-ee56-4549-ab5c-79c4aa0862c5';
        //$secret = 'eyJhbGciOiJIUzI1NiIsImtpZCI6ImJhc2ljOjAifQ.eyJ0ZW5hbnQiOiJvc2M0LWRlbW8iLCJzdWIiOiIxMzkifQ.fZh1qx3x8Vk0ijrsWKg-0iZDPQH769eIXm2TSsWvwjo';
        //$facebookAppId = '110100299485445';
		$USERPWD = \RightNow\Utils\Config::getConfig(1000059); //CUSTOM_CFG_QUIQ_SMS_USERPWD
		$facebookAppId=$facebook_app_id;
        //$facebookPageId = '2102715376480453';
        $incidentIdRef = array(
            "provider" => "rightnow", 
            "name" => "incident",
            "id" => (string) $incidentId);
        $incidentRefNoRef = array(
            "provider" => "rightnow", 
            "name" => "refno",
            "id" => $incidentRefNo);
        $payload= json_encode(array("context" => array("integrations" => array($incidentIdRef, $incidentRefNoRef))));
        
        load_curl();
        
        
		$url = "https://beachbody-uat.goquiq.com/api/v1/messaging/stored-context";
		$USERPWD = \RightNow\Utils\Config::getConfig(1000059); //CUSTOM_CFG_QUIQ_SMS_USERPWD
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //    curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		curl_setopt($ch, CURLOPT_USERPWD, $USERPWD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contextId = json_decode(curl_exec($ch))->key;
        
        curl_close($ch);

        $trans = array();
        $trans['facebook'] = array("key" => "contextId", "value" => $contextId);
		$trans['facebookpageid'] = array("key" => "facebookPageId", "value" => $facebookPageId);
//        $trans['incident'] = array("key" => "i_id", "value" => $incidentId);
        $trans['incident'] = array("key" => "ref_no", "value" => $incidentRefNo);


        $formResult = new ResponseObject(null);
        $formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());

        $this->_echoJSON($formResult->toJson());
	
		
  }
  
    function sms($val)
  {
     list($cat, $top_parent) = explode(',', $val);
  
    $bb_messenger = \RightNow\Utils\Config::getConfig(1000056);  //CUSTOM_CFG_GENERAL_MESSENGER_SMS
  
  	$bb_messenger_premiere = \RightNow\Utils\Config::getConfig(1000057);  //CUSTOM_CFG_PREMIERE_MESSENGER_SMS
	
	$country_code = \RightNow\Utils\Config::getConfig(1000055);  //CUSTOM_CFG_PHONE_COUNTRY_CODE
	
	 $pc_queue  = \RightNow\Utils\Config::getConfig(1000071);  //CUSTOM_CFG_PC_SMS
	 
	 $myx_sms=\RightNow\Utils\Config::getConfig(1000073); //CUSTOM_CFG_MYX_SMS
	 
	 $coach_sms=\RightNow\Utils\Config::getConfig(1000074); //CUSTOM_CFG_COACH_SMS
	 
	logmessage('inside sms');
	
	  try{
	
  	$data = json_decode($this->input->post('form'));
	
	foreach($data as $item)
	{
		if($item->name == "Incident.CustomFields.c.free_text")
		{
			$item->name = "Incident.Category";
			$item->value =intval($cat);
		}
		
		if($item->name == "Incident.CustomFields.c.form_routing")
		{
			//$item->name = "Incident.CustomFields.c.form_routing";
			$item->value = 1563;
		}
		
		if($item->name == "Incident.CustomFields.c.contact_channel")
		{
			//$item->name = "Incident.CustomFields.c.form_routing";
			$item->value = 1565;
		}
		
		if($item->name == "Incident.CustomFields.c.member_type_new")
		{
			$membertypenew = $item->value;
		}
		
		if($item->name == "Incident.CustomFields.c.life_time_rank")
		{
			$lifetimerank = $item->value;
		}
		if($item->name == "Contact.Phones.MOBILE.Number")
		{
			$phnumber = $item->value;
		}
		if($item->name == "Incident.Threads")
		{
			$custinqiry = $item->value;
		}
		logmessage($item->name . ':' . $item->value);
	}
	
	if(!empty($membertypenew) && $top_parent!="3784")
	{
	  if($membertypenew == 389 || $membertypenew == 398)
	  {
	  	$contact_point = $bb_messenger;
	  }
	  elseif($membertypenew == 1725){
	  	$contact_point = $pc_queue;
	  }
	  if($membertypenew == 388)
	  {
	  	if(!empty($lifetimerank))
		{
			if($lifetimerank == 478 || $lifetimerank == 1365)
			{
				$contact_point = $coach_sms;
			}
			if($lifetimerank == 492)
			{
				$contact_point = $bb_messenger_premiere;
			}
			
		}
	  }
	}
	else if($top_parent=="3784")
	{
		$contact_point = $myx_sms;
	}
	
	array_push($data,$item);  

       if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
	
		$CI = get_instance();
		$a=$results->result['transaction']['incident']['value'];
		$contactid = $this->session->getProfile()->c_id->value;
		$id = $CI->model('custom/bbresponsive')->sms($a,$cat,"id",$phnumber,$contactid);
        $CI->session->setSessionData(array('id' => $a));
		$chathours = $CI->model('custom/chathours')->getChatHours("sms");
		$CI->session->setSessionData(array('issmsavailable' => $chathours));
		$incidentId = $id;
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
		$incidentRefNo = $CI->model('custom/bbresponsive')->save_seleted_category_for_fb($a,$cat,"refno");
		
		}
		else
		{
		//$incidentRefNo = $a;
		}
		$number = $country_code.$phnumber;   // contry code should be taken from configuration
		
		
		//$incidentId = "35621455";
		//$incidentRefNo = "191106-000000";
		
		$payload = json_encode($postData = [
  'handle' => $number,
  'contactPoint' => $contact_point,
  'messages' => [[ 'text' => $custinqiry, 'authorType' => 'Customer', 'imported' => true ]],
  'integrations' => [ [ 'provider' => 'rightnow', 'name'=> 'incident', 'id'=> (string) $incidentId], [ 'provider' => 'rightnow', 'name'=> 'refno', 'id'=> $incidentRefNo]],
	'autoResponsesEnabled' => true
  ]);
  		 
        load_curl();
        
        //$url = "https://apimdev.beachbody.com:8443/api/v1/quiq_uat/sms/startSMSConversation";
        //$url = "https://beachbody-uat.goquiq.com/api/v1/messaging/platforms/SMS/start-conversation";
		$url = \RightNow\Utils\Config::getConfig(1000058);  //CUSTOM_CFG_QUIQ_SMS_URL
		$USERPWD = \RightNow\Utils\Config::getConfig(1000059); //CUSTOM_CFG_QUIQ_SMS_USERPWD
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($ch, CURLOPT_USERPWD, '0fca4e7a-d4ea-4aea-863d-c9f1c3e334cd' . ":" . 'eyJhbGciOiJIUzI1NiIsImtpZCI6ImJhc2ljOjAifQ.eyJ0ZW5hbnQiOiJiZWFjaGJvZHktdWF0Iiwic3ViIjoiNDQwMzMifQ.-IC-WoGD19VWziy_8422djWAC7zhwlCw43MuXg2BLNU');
		curl_setopt($ch, CURLOPT_USERPWD, $USERPWD);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contextId = json_decode(curl_exec($ch));
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		//print_r($contextId);
		if (curl_errno($ch)) {
    	$error_msg = curl_error($ch);
}
        curl_close($ch); 
		logmessage($contextId);
	
        //$this->_echoJSON($formResult->toJson());
		
		$trans = array();
        $trans['incident'] = array("key" => "ref_no", "value" => $incidentRefNo);
		$error = array("errormessage"=>$contextId->messages[0],"httpcode"=>$httpcode);
		$CI->session->setSessionData($error);


        $formResult = new ResponseObject(null);
        $formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());
		//logmessage($formResult->toJson());
        $this->_echoJSON($formResult->toJson());
		
	  }
	  catch (Exception $e) {
    logmessage( 'Caught exception: '.  $e->getMessage());
	  }
		
  }
  
  function submit_chat_ajax()
  {
     echo '{"result":{"sessionParam":"","transaction":{"incident":{"key":"","value":""}}}}';  
  }
  
   function submit_facebook_ajax()
  {
     echo '{"result":{"sessionParam":"","transaction":{"incident":{"key":"","value":""}}}}';
	 //This code commented for the future implementation
     //$data = json_decode($this->input->post('form'));
	 //print_r($data);
	 //$a=1;
     //echo '{"result":{"sessionParam":"","transaction":{"incident":{"key":"","value":'.$a.'}}}}'; 
	 //This code commented for the future implementation
  }
  
  function click_tracking()
  {
   	$url = $this->input->post('url');
   	$mobile = $this->input->post('mob');
   	$clicked_link = $this->input->post('click_text');
	$cat_id = $this->input->post('cat_id');
	$ans_view = $this->input->post('ans_view');
	//die("reached the controller");
	$CI = get_instance();
	$CI->model('custom/bbresponsive')->click_tracking($url, $mobile, $clicked_link,$cat_id,$ans_view);
  }
  
  function loginsession()
	  {
	    if (\RightNow\Utils\Framework::isLoggedIn()) 
		{
			$result['loggedin'] =  "yes";
		}
		else
		{
		    $result['loggedin'] =  "no";
		}
	    $text = $this->input->post('text');
		$result['text'] = $text;
		$CI = get_instance();
		$chat = array("chat"=>"chat","url"=>$text);
		$CI->session->setSessionData($chat);
		echo json_encode($result);
	  }
	  
  function update_session()
  {
  	$CI = get_instance();
   	if($CI->session->getSessionData('service_alert_sessions_ca'))
	{
		$CI->session->setSessionData(array('service_alert_sessions_ca' => 2));
		$CI->session->setSessionData(array('LAST_ACTIVITY_SERVICE_ALERT_CA' => time()));
	}
  }
  
  function ghostchatsubmitlog()
	  {
	   
	    $text = $this->input->post('text');
		$this->session->setSessionData(array('reload' => 'false'));
		$this->session->setSessionData(array('blank' => urlencode($text)));
		echo $text;
		
	  } 
  
  function bblivecategory()
  {
   
	$text = $this->input->post('text');
	$CI = get_instance();
	$a = $CI->model('custom/bbresponsive')->bblivecategory($text);
	echo $a;
	
  }
  
  function loginsession_fb($channel)		
	  {		
		if($channel == 'facebook')
		{
			if (\RightNow\Utils\Framework::isLoggedIn()) 		
			 {		
				$result['loggedin'] =  "yes";		
			 }		
			else		
			 {		
				$result['loggedin'] =  "no";		
			 }	
					
			$text = $this->input->post('text');		
			$result['text'] = $text;		
			$CI = get_instance();		
			$chat = array("chat"=>"facebook","url"=>$text);		
			$CI->session->setSessionData($chat);		
			echo json_encode($result);		
		}	
		
		if($channel == 'sms')
	    {
			if (\RightNow\Utils\Framework::isLoggedIn()) 		
			 {		
				$result['loggedin'] =  "yes";		
			 }		
			else		
			 {		
				$result['loggedin'] =  "no";		
			 }	
					
			$text = $this->input->post('text');		
			$result['text'] = $text;		
			$CI = get_instance();		
			$chat = array("chat"=>"sms","url"=>$text);		
			$CI->session->setSessionData($chat);		
			echo json_encode($result);		
	    }	
		if($channel == 'callmenow')
	    {
			if (\RightNow\Utils\Framework::isLoggedIn()) 		
			 {		
				$result['loggedin'] =  "yes";		
			 }		
			else		
			 {		
				$result['loggedin'] =  "no";		
			 }	
					
			$text = $this->input->post('text');		
			$result['text'] = $text;		
			$CI = get_instance();		
			$chat = array("chat"=>"callmenow","url"=>$text);		
			$CI->session->setSessionData($chat);		
			echo json_encode($result);		
	    }

	  }
	  
	  function tokenstorage()		
	  {	
		//print_r($_POST);
		$response = json_encode($_POST,true);
		//$response = json_decode(json_encode($_POST),true);
		//echo $response; exit;
		//var_dump($response); exit;
		$response = base64_encode($response);
		$this->session->setSessionData(array('tokens_akamai' => $response));
		echo "success";
	  }
	  
	  function popup_duration()		
	  {		
			$start = strtotime(date('H:i')); //get current time in 24 hr format
  			$stop = strtotime("24:00");
			$diff = ($stop - $start);
			$duration = $diff/60;
			$result['duration'] = $duration;	
			echo json_encode($result);			
	  }
	  
	 function fb_status_update()
	 {
		$ref_no = $this->input->post('ref_no');
		$CI = get_instance();
		$CI->model('custom/bbresponsive')->fb_status_update($ref_no);
	 }	
  
  	 function iframe_log()
	  {
	   
	    $text = $this->input->post('iframeUrl');
		$text = "\n".$text;
		error_log($text,3, '/cgi-bin/canada_english.cfg/scripts/cp/customer/development/views/pages/error_log/iframe_nice.txt');
	  } 
 
  

}

