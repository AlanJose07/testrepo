<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Utils\Text,
	RightNow\Libraries\ResponseObject,
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
		//echo $results->toJson();
		//echo $a;
		
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
		//$CI->model('custom/bbresponsive')->save_seleted_category_for_email($a,$val);
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
		
        $trans = array();
		$trans['facebookpageid'] = array("key" => "facebookPageId", "value" => $facebookPageId);
        $formResult = new ResponseObject(null);
        $formResult->result = array("transaction" => $trans, "sessionParam" => \RightNow\Utils\Url::sessionParameter());

        $this->_echoJSON($formResult->toJson());
	
		
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
  
  function update_session()
  {
  	$CI = get_instance();
   	if($CI->session->getSessionData('service_alert_sessions_uk'))
	{
		$CI->session->setSessionData(array('service_alert_sessions_uk' => 2));
		$CI->session->setSessionData(array('LAST_ACTIVITY_SERVICE_ALERT_UK' => time()));
	}
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
	  }
	  
	  function timezone(){
	  	$nowtimezone = trim($hoursData['time_zone'] = strftime('%Z'));
		echo $nowtimezone;
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
	  		$nowtimezone = $hoursData['time_zone'] = strftime('%Z');
			$start = date('Y-m-d H:i:s');
			if($nowtimezone == 'BST'){
				$timestamp = strtotime($start);
				$time = $timestamp - (8 * 60 * 60);
				$start = strtotime(date("H:i", $time));
			}else{
				$timestamp = strtotime($start);
				$time = $timestamp - (7 * 60 * 60);
				$start = strtotime(date("H:i", $time));
			}
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

}

