<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Connect\v1_2 as RNCPHP,
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
	
		}
		$chatskillid = $this->model('custom/bbresponsive')->setchatskill($val);
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
	//  echo "<pre>";
	logmessage("data");
	  logmessage($data);
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
		$CI->model('custom/bbresponsive')->save_subject_email($a);
		echo json_encode($response);
		//echo $results->toJson();
		//echo $a;
		
  }
  
  function fb($val)
  {
//logmessage("inside fb");
	  try{
		//  logmessage("inside fb");
  $general_queue = \RightNow\Utils\Config::getConfig(1000047);  //CUSTOM_CFG_GENERAL_MESSENGER_QUEUE
  
  $star_diamond_messenger_queue = \RightNow\Utils\Config::getConfig(1000048);  //CUSTOM_CFG_STAR_DIAMOND_MESSENGER_QUEUE
  
  $facebook_app_id = \RightNow\Utils\Config::getConfig(1000049);  //CUSTOM_CFG_FACEBOOK_APP_ID
  
  $coach_messenger_queue = \RightNow\Utils\Config::getConfig(1000050); //CUSTOM_CFG_COACH_MESSENGER_QUEUE
  
  $pc_queue  = \RightNow\Utils\Config::getConfig(1000070);  //CUSTOM_CFG_PC_MESSENGER_QUEUE
  
  $data = json_decode($this->input->post('form'));
//echo "<pre>";
//var_dump($data);
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
	  }
	   elseif($membertypenew == 1725){
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
        
        //$url = "https://apim.beachbody.com:8443/api/v1/quiq/messaging/stored-context";
		$url = "https://beachbody-uat.goquiq.com/api/v1/messaging/stored-context";
		$USERPWD = \RightNow\Utils\Config::getConfig(1000059); //CUSTOM_CFG_QUIQ_SMS_USERPWD
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //    curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		//curl_setopt($ch, CURLOPT_USERPWD, $USERPWD);
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
    //echo "123";exit;
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
   	if($CI->session->getSessionData('service_alert_sessions_fr'))
	{
		$CI->session->setSessionData(array('service_alert_sessions_fr' => 2));
		$CI->session->setSessionData(array('LAST_ACTIVITY_SERVICE_ALERT_FR' => time()));
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
		if($channel == 'email')
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
			//$CI = get_instance();		
			//$chat = array("chat"=>"email","url"=>$text);		
			//$CI->session->setSessionData($chat);		
			echo json_encode($result);		
	    }		
	  }
	  //Doc Submit start
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
		  //Doc Submit end

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
			$start = date('Y-m-d H:i:s');
			$timestamp = strtotime($start);
			$time = $timestamp - (9 * 60 * 60);
			$start = strtotime(date("H:i", $time));
		
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

	  
	  function test()
	  {
	  /*$query="select BB.categ_contac_hom_fr from BB.categ_contac_hom_fr order by BB.categ_contac_hom_fr.ID";
	  
	  $res = RNCPHP\ROQL::queryObject($query)->next();
	  
			$i=0;
		
				 while($products = $res->next())
				 {
				 $error_log = new RNCPHP\BB\categ_contac_hom_fra();
				    echo "<pre>";
					if(!empty($products->category->ID) && $products->ID!=468 && $products->ID!=833)
					{
					$error_log->Agent_Chat = $products->Agent_Chat->ID;
					$error_log->Directly_RTM = $products->Directly_RTM->ID;
					$error_log->Email = $products->Email->ID;
					$error_log->Phone = $products->Phone->ID;
					$error_log->Self_Service_Form = $products->Self_Service_Form->ID;
					$error_log->facebook = $products->facebook->ID;
					$error_log->Display_Order_Agent_Chat = $products->Display_Order_Agent_Chat;
					$error_log->Display_Order_Directly_RTM = $products->Display_Order_Directly_RTM;
					$error_log->Display_Order_Email = $products->Display_Order_Email;
					$error_log->Display_Order_Phone = $products->Display_Order_Phone;
					$error_log->Display_Order_Self_Service_for = $products->Display_Order_Self_Service_for;
					$error_log->Display_Order_facebook = $products->Display_Order_facebook;
					$error_log->answer_report_id = $products->answer_report_id;
					$error_log->category = $products->category->ID;
					$error_log->display_order = $products->display_order;
					$error_log->interface = 31;
					$error_log->self_service_form_link = $products->self_service_form_link;
					$error_log->text_field = $products->text_field;
					$error_log->visible_on_page = $products->visible_on_page->ID;
					if($products->sub_category == 1)
					$error_log->sub_category = 1;
					else
					$error_log->sub_category = 0;
					if($products->enable == 1)
					$error_log->enable = 1;
					else
					$error_log->enable = 0;
					//echo "i am here ".$i." ".$products->ID." ";		
				 	//print_r($products->category->ID);
					echo "<hr>";
					print_r($error_log);
					echo "i am here ".$i." ".$products->ID." ";
					$error_log->save();
					//echo $products->category->ID;
					//echo $products->Agent_Chat->ID;
					//echo $products->Display_Order_Agent_Chat;
					//echo $products->Self_Service_Form->ID;
					//echo $products->self_service_form_link;
					//echo $products->interface->ID;
					//echo $products->visible_on_page->ID;
					//echo $products->sub_category;
					//echo $products->ID;
					//echo $products->enable; // 1 for true and null for false so do the logic
					
					$i = $i+1;
				 }
		    
		    }	
			echo $i;	 
	  */
	  }
	  
	  function product_tileexport()
	  {
	  /*
	  $query="select BB.self_service_product from BB.self_service_product where BB.self_service_product.interface = 30 order by BB.self_service_product.ID";
	  
	  $res = RNCPHP\ROQL::queryObject($query)->next();
	  
			$i=0;
		
				 while($products = $res->next())
				 {
				 	$error_log = new RNCPHP\BB\self_service_product();
				    echo "<pre>";
					
					$error_log->content = $products->content;
					$error_log->content_type = $products->content_type->ID;
					$error_log->display_order = $products->display_order;
					$error_log->image_name = $products->image_name;
					$error_log->title = $products->title;
					$error_log->tool_tip_message = $products->tool_tip_message;
					$error_log->interface = 31;
					$error_log->products = $products->products->ID;
					$error_log->visible_on_page = $products->visible_on_page->ID;
					
					if($products->enable == 1)
					$error_log->enable = 1;
					else
					$error_log->enable = 0;  
					//echo "i am here ".$i." ".$products->ID." ";		
				 	//print_r($products->category->ID);
					echo "<hr>";
					print_r($products);
					echo "i am here ".$i." ".$products->ID." "." ".$products->products->ID;
					$error_log->save();
					//echo $products->category->ID;
					//echo $products->Agent_Chat->ID;
					//echo $products->Display_Order_Agent_Chat;
					//echo $products->Self_Service_Form->ID;
					//echo $products->self_service_form_link;
					//echo $products->interface->ID;
					//echo $products->visible_on_page->ID;
					//echo $products->sub_category;
					//echo $products->ID;
					//echo $products->enable; // 1 for true and null for false so do the logic
					
					$i = $i+1;
				 
		    
		    }	
			echo $i;	 
	  */
	  
	  }
	  
	  
  

}

