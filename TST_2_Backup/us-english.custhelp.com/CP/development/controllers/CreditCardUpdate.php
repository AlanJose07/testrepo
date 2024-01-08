<?php

namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;
	

class CreditCardUpdate extends \RightNow\Controllers\Base

{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
	 
	function UpdateCard(){
	
		
		$postData = json_decode($this->input->post('form'));
		
		//echo "<pre>";
		//print_r($postData);
		
		//die("isfgdfjhfjhgfjhfbj");
		echo $this->model('custom/CreditCardInfo')->CreditCardUpdate($postData)->toJson();
		//print_r($postData);
		
	
	} 
	//-----------------checking whether the contact exists are not-------------------
	function UpdateCreditCard1(){
	
		
		$postData = json_decode($this->input->post('form'));
		echo $this->model('custom/CreditCardInfo')->CreditCardUpdate1($postData)->toJson();
		//print_r($postData);
		
	
	} 
	
	//------------------------------------------------------------------

    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }
	/**
	 * Anuj Feb 18, 2014 - CP3 Migration
	 * Check for existing contact against email and return first-last name or false depending upon the result
	 */
	function checkForExistingContact() {
	
		// Copied from pre-migration version of code
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

		$email = $this->input->post('email');
		$show_first_last_name = $this->input->post('show_first_last_name');
	   	// check if email exists, then get the contact fields
		$this->load->model('Contact');
		$results = $this->model('Contact')->lookupContactByEmail($email);
		
		// Our data comes enclosed in a ResponseObject instance, fetch the value from 'result' private member variable
		$result = $results->result;
		
        if($result){
		
			// Return first and last name only when we want to show it on the page, otherwise just return true
			if($show_first_last_name && $show_first_last_name != "false") {
				$c_id = intval($result);	//Get the integer value of contact ID
				$contact = $this->model('Contact')->get($c_id);
	
				// Connect Contact record is enclosed in ResponseObject instance's 'result' member variable
				$return['first_name'] =  $contact->result->Name->First;
				$return['last_name'] =  $contact->result->Name->Last;
			}
			else {
				$return = true;
			}
			echo json_encode($return);
		}
		else{

			echo json_encode($result);
		}
	}
	function getAltData()
	{
		 $data = base64_decode($this->input->post('passedvalues'));
		$data = json_decode($data);
		
		if($data!=null)
		{
			foreach($data->data as &$record){
		
				//$record = str_replace("&lt;","<",$record);
				//$record = str_replace("&gt;",">",$record);
	
				//$url = $this->get_string_between($record[2],"<a href='", "'>" );
	
				//$string_param = strip_tags($this->get_string_between($record[2],"'>","</a>"));
				//$string_param = urlencode($string_param);
				//$string_param = str_replace("+","-",$string_param);
				//$string_param = strtolower($string_param);
				
				$CI = get_instance();
				$tab = $CI->session->getSessionData('tabParam');
				//$new_url = $url."/~/".$string_param."/lob/".$tab;		
				//$record[2] = str_replace($url, $new_url, $record[2]);
				
				
				$record = str_replace("&lt;","<",$record);
				$record = str_replace("&gt;",">",$record);
				$a_id = $this->get_answer_id($record[2]);
				$new_url = SEO::getCanonicalAnswerURL($a_id)."/lob/".$tab;
				$url = $this->get_string_between($record[2],"<a href='", "'>" );
				$record[2] = str_replace($url, $new_url, $record[2]);
			}
		}
		echo json_encode($data);
	}
     function get_answer_id($record)
	 {
        $url = $this->get_string_between($record,"<a href='", "'>" );
        $params = explode("/", $url);
        $arr_num = 0;
        foreach($params as $key=>$val){
            if($val == 'a_id'){
                $arr_num = $key + 1;
            }
        }
        $a_id = $params[$arr_num];
        
        return $a_id;
    }
    function get_string_between($string, $start, $end)
	{
        $string = " ".$string;	
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
	/**
     * Generic form submission handler for submitting contact and incident data.
     * @return string Details about the form submission, including errors, IDs of records created, or SA results if an
     * incident is being submitted.
     */
    public function sendForm()
    {
	    AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
        if(!$data)
        {
            header("HTTP/1.1 400 Bad Request");
            // Pad the error message with spaces so IE will actually display it instead of a misleading, but pretty, error message.
            Framework::writeContentWithLengthAndExit(json_encode(Config::getMessage(END_REQS_BODY_REQUESTS_FORMATTED_MSG)) . str_repeat("\n", 512));
        }
        if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }
        $smartAssistant = $this->input->post('smrt_asst');
        echo $this->model('custom/FieldModel')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'true'))->toJson();
		
		
      }
	  
 public function sendChatForm()
    {
		$CI = get_instance();
	    AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
     
	  if(!$data)
        { 
            header("HTTP/1.1 400 Bad Request");
            // Pad the error message with spaces so IE will actually display it instead of a misleading, but pretty, error message.
            Framework::writeContentWithLengthAndExit(json_encode(Config::getMessage(END_REQS_BODY_REQUESTS_FORMATTED_MSG)) . str_repeat("\n", 512));
        }
		 
        if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
		
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }
		
        $smartAssistant = $this->input->post('smrt_asst');
		
        echo $this->model('custom/ChatFieldModel')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'true'))->toJson();
		
		 
      }	  
	  
	 function track_vitamin_form_clicks($url,$mob)
	{
	
	  $link = urldecode($url);
      $CI = get_instance();
	   
	  $CI->model('custom/Answer_hit_model')->track_vitamin_form_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	
	
	
	
	function track_shk_form_clicks($url,$mob)
	{
	    
	
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  $CI->model('custom/Answer_hit_model')->track_shk_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	  
	function track_order_status_popup_clicks($url,$mob)
	{
	    
	
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  $CI->model('custom/Answer_hit_model')->track_order_status_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	   
	}
	//============track successfull order status =============
	function track_order_status_successfull_search($url,$mob)
	{
	  
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  $CI->model('custom/Answer_hit_model')->track_order_status_successfull_attempts($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	//============track successfull order status =============
	function track_order_status_attempts($url,$mob)
	{
	    
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	   
	  $CI->model('custom/Answer_hit_model')->track_order_status_attempts($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	
	
	
	function track_bb_cust_options()
	{
		$id = $this->input->post('option_selected'); 
		$url = $this->input->post('url'); 
		$home_link = $this->input->post('home_link'); 
		$page_set = $this->input->post('page_set');
		
		$CI = get_instance();
		
		$result = $CI->model('custom/Answer_hit_model')->track_bb_cust_options($home_link, $id, $url, $page_set);	 
	}
	function track_bb_cust()
	{
		$lob = $this->input->post('lob'); 
		$home_link = $this->input->post('home_link'); 
		$page_set = $this->input->post('page_set');
		
		$CI = get_instance();
		
		$result = $CI->model('custom/Answer_hit_model')->track_bb_cust($home_link, $page_set, $lob);	 
	}
	function track_tbb_cust_options()
	{
		$id = $this->input->post('option_selected'); 
		$url = $this->input->post('url'); 
		$home_link = $this->input->post('home_link'); 
		$page_set = $this->input->post('page_set');
		
		$CI = get_instance();
		
		$result = $CI->model('custom/Answer_hit_model')->track_tbb_cust_options($home_link, $id, $url, $page_set);	 
	}
	function track_tbb_cust()
	{
		$lob = $this->input->post('lob'); 
		$home_link = $this->input->post('home_link'); 
		$page_set = $this->input->post('page_set');
		
		$CI = get_instance();
		
		$result = $CI->model('custom/Answer_hit_model')->track_tbb_cust($home_link, $page_set, $lob);	 
	}
	function track_customer_coach_clicks($url,$mob)
	{
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  
	  $CI->model('custom/Answer_hit_model')->track_customer_coach_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	function track_genealogy_clicks($url,$mob)
	{
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  
	  $CI->model('custom/Answer_hit_model')->track_genealogy_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}

	function track_call_support($url,$mob)
	{
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  
	  $CI->model('custom/Answer_hit_model')->track_call_support($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}

	function track_contactus_clicks($url,$mob)
	{

	
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  $CI->model('custom/Answer_hit_model')->track_contactus_clicks($link,$mob);
	 
	 // header('Location: '.$home_address);
	  
	}
	function track_contactus_chat_clicks($url,$mob)//Tracking clicks of Contact Us button in the hoem,list and detail page in new design.The button redirects to chat launch page
	{

	
	  $link = urldecode($url);
	  
      $CI = get_instance();
	  
	  $CI->model('custom/Answer_hit_model')->track_contactus_chat_clicks($link,$mob);
	 

	  
	}
	function track_smart_assistance_chat()
	{
	
   $flag = $this->input->post('click_id'); 
   $url = $this->input->post('url');
    $CI = get_instance();
	 
	  $result = $CI->model('custom/Answer_hit_model')->track_smart_assistance_chat($flag,$url);
	
echo json_encode($result);
	  
	}
		
	function submit_chat_ajax()
	{
	
	 
	  $result = "true";
	
		echo json_encode($result);
	  
	}
	
	//function submit_order_status()//old
	function submit_order_status($path,$mob)//parameters for click tracking
	{
	  $link = urldecode($path);
	   
	  // $order_created_past_days = $this->model('custom/Answer_hit_model')->getOrderCreatedPastdays();
	   
	    $data = json_decode($this->input->post('form'));
		
	    if(!$data)
        {
            writeContentWithLengthAndExit(json_encode(getMessage(JAVASCRIPT_ENABLED_FEATURE_MSG)));
        }
      
		$dataobj = null;
		$i=0;
		
		foreach($data as $field)
		{
		   $dataobj[$i]->name =  $field->name;
		   $dataobj[$i]->value =  $field->value;
		   $dataobj[$i]->required =  $field->required;
		   
		   $i++;

		}
		
		$curr_session_order = $this->session->getSessionData('sessionID');	//get user session
		$temp_session_order = $this->session->getSessionData('temp_session_order');//get temp_session value
		if($curr_session_order!=$temp_session_order)
		{
		$this->session->setSessionData(array('temp_session_order' => $curr_session_order));
		$this->session->setSessionData(array('counter_order' => 0));
	
		}
		  
    
 
    //$result = $this->model('custom/Answer_hit_model')->getOrderStatus($data);//old
    $result = $this->model('custom/Answer_hit_model')->getOrderStatus($data,$link,$mob);
 
 
  $data=array();
 //$shipped_date = gmdate("m-d-Y", $result[0]->shipped_date);
 //$order_date = gmdate("m-d-Y", $result[0]->order_create_date);
 if(count($result)>1)
 { 

 for($i=0;$i<count($result);$i++)
 {
	//Display sku description in popup---Vimal on 10/20/2016
	
     $sku_desc=$result[$i]['sku_descriptions'];

	if($sku_desc!="")
	{ 
		$sku_array = explode(",", $sku_desc);
		$sku_count=count($sku_array);
		
		if($sku_count==1)
		{
			$sku_desc=$sku_array[0];
		}
		if($sku_count==2)
		{
			$sku_desc=$sku_array[0].", ".$sku_array[1];
		}
		if($sku_count==3 || $sku_count > 3)
		{
			$sku_desc=$sku_array[0].", ".$sku_array[1].", ".$sku_array[2];
		}
	}
	else
	{
	$sku_desc = "Product";
	}
	//Display sku description in popup---End 
		
	/* $data[$i]= array('first_name' => $result[$i]->first_name,'last_name' => $result[$i]->last_name,'order_number' => $result[$i]->order_number,'order_status_id' => $result[$i]->order_status->ID,'order_status_lookup' => $result[$i]->order_status->LookupName,'shipped_date' => gmdate("m/d/Y", $result[$i]->shipped_date),'tracking_number' => $result[$i]->tracking_number,'order_create_date' => gmdate("m/d/Y", $result[$i]->order_create_date),'product'=>$sku_desc,'sms_enabled'=>$result[$i]->sms_subscription_enabled);*///commented on 11/12/2016
	 
	 
	 
	 
	 $data[$i]= array('first_name' => $result[$i]['first_name'],'last_name' => $result[$i]['last_name'],'order_number' => $result[$i]['order_number'],'order_status_id' => $result[$i]['order_status']->ID,'order_status_lookup' => $result[$i]['order_status']->LookupName,'shipped_date' => gmdate("m/d/Y", $result[$i]['shipped_date']),'tracking_number' => $result[$i]['tracking_number'],'order_create_date' => gmdate("m/d/Y", $result[$i]['order_create_date']),'product'=>$sku_desc,'sms_enabled'=>$result[$i]['sms_subscription_enabled']);
	
	


 } 
  $this->_renderJSON($data);
 //return $data;
 }
 
 else if(count($result)==1)
 {
  
   //Display sku description in popup---Vimal on 10/20/2016
	
	$sku_desc=$result[0]['sku_descriptions'];//commented on 11/12/2106
	
	if($sku_desc!="")
	{ 
		$sku_array = explode(",", $sku_desc);
		$sku_count=count($sku_array);
	
		if($sku_count==1)
		{
			$sku_desc=$sku_array[0];
		}
		if($sku_count==2)
		{
			$sku_desc=$sku_array[0].", ".$sku_array[1];
		}
		if($sku_count==3 || $sku_count > 3)
		{
			$sku_desc=$sku_array[0].", ".$sku_array[1].", ".$sku_array[2];
		}
	}
	else
	{
	$sku_desc = "Product";
	}
	//--------------sku desc--end----------------------------------------
 
  $data = array('first_name' => $result[0]['first_name'],'last_name' => $result[0]['last_name'],'order_number' => $result[0]['order_number'],'order_status_id' => $result[0]['order_status']->ID,'order_status_lookup' => $result[0]['order_status']->LookupName,'shipped_date' => gmdate("m/d/Y", $result[0]['shipped_date']),'tracking_number' => $result[0]['tracking_number'],'order_create_date' =>gmdate("m/d/Y", $result[0]['order_create_date']),'product'=>$sku_desc,'sms_enabled'=>$result[0]['sms_subscription_enabled']);//commented on 11/12/2106
 
 	$this->_renderJSON($data);
 }
 else
 {

  if($curr_session_order == $temp_session_order)
  {
 $counter_order = $this->session->getSessionData('counter_order');
 $counter_order1 = $counter_order+1;
 $this->session->setSessionData(array('counter_order' => $counter_order1));
 $counter_order_temp = $this->session->getSessionData('counter_order');
  
  }
  if($counter_order_temp > 0)
  {
  $display_chat = 1;
  }
  else
  {
   $display_chat = 0;
  }
  $session = $this->session->getSessionData('counter_order');

$this->_renderJSON(array('errors' =>'error','display_chat' => $display_chat));
 
 }

	
	}
	
	public function submitAnswerFeedback()
		{
			AbuseDetection::check();
			$fbId= $this->input->post('fb_id');
			$answerID = $this->input->post('a_id');
			$reason = $this->input->post('reason');
			if($answerID === 'null')
				$answerID = null;
			$rate = $this->input->post('rate');
			
			
			$lob = $this->input->post('lob');
			if(intval($rate)==2)
			{
				$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReasonYes($rate,$answerID,$lob,$reason);
				if($fbupdate){
					$this->_renderJSON(array('Feedback Tracking ID' => $fbupdate));
					return;
				}
				if(!$fbupdate){
					$this->_renderJSON(array('error' => "Couldn't send the feedback"));
					return;
				}
			}
			$message = $this->input->post('message');
			$givenEmail = $this->input->post('email');
			$givenEmail ="anonymous@anoymous.invalid";
			$threshold = $this->input->post('threshold');
			$optionsCount = $this->input->post('options_count');
			
			
			
			
			
			$formToken = $this->input->post('f_tok');
			if (!count($_POST) || !$formToken || !Framework::isValidSecurityToken($formToken, 0)){
				$this->_renderJSON(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
				return;
			}
		   // $incidentResult = $this->model('Incident')->submitFeedback($answerID, $rate, $threshold, null, $message, $givenEmail, $optionsCount);
			//var_dump($fbId);
			$fbId=intval($fbId);
			//$inc_id=$incidentResult->result->ID;
			if(!$fbId)
			{
				
				$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReason($reason,$answerID,$lob,$rate);
			}
			else
			{
				//var_dump($fbId);
				$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReasonUpdate($fbId,$reason,$answerID,$lob,$rate);
			}
			if($fbupdate){
				$this->_renderJSON(array('Feedback Tracking ID' => $fbupdate));
				return $fbupdate;
			}
			if(!$fbupdate){
				$this->_renderJSON(array('error' => "Couldn't send the feedback"));
				return;
			}
			$this->_renderJSON(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
		}
	
	//====added  for new form=====
		function get_recommended_channel()
		{
		$request_Id = $this->input->post('request_id'); 
		$member_Id = $this->input->post('member_id'); 
		$current_url = $this->input->post('current_url'); 
		
		 
		$CI = get_instance();
		
		$result = $CI->model('custom/IncidentModel')->get_recommended_channel($request_Id, $member_Id, $current_url);	 
		/* var_dump($result);
		var_dump(sizeof($result)); */
		$this->_renderJSON($result);
		}
		//====================================
		
		
		function get_recommended_answers()
		{
			$request_Id = $this->input->post('request_id'); 
			$member_Id = $this->input->post('member_id'); 
			
			 
			$CI = get_instance();
			
			$result = $CI->model('custom/Answer')->getAnswers($request_Id, $member_Id);	 
			/* var_dump($result);
			var_dump(sizeof($result)); */
			
			$this->_renderJSON($result);
		}
		function get_answers()
		{
			$answer_ids = $this->input->post('answer_ids');
			
			 
			$CI = get_instance();
			
			$result = $CI->model('custom/Answer')->getNewAnswers($answer_ids);	 
			/* var_dump($result);
			var_dump(sizeof($result)); */
			
			$this->_renderJSON($result);
		}
		function recommended_channel_click_tracking()
		{
		$request_id = $this->input->post('request_id'); 
		$member_id = $this->input->post('member_id'); 
		$channel_id = $this->input->post('recommended_channel');
		$current_url = $this->input->post('current_url');
		$CI = get_instance();
		
			
		$result = $CI->model('custom/Answer_hit_model')->recommended_channel_click_tracking($request_id, $member_id,$channel_id,$current_url);	
		/* var_dump($result);
		var_dump(sizeof($result)); */
		$this->_renderJSON($result);
		}
		
		function recommended_channel_click_tracking_update($record_id,$channel_id)
		{
		 
		$CI = get_instance();
		
			
		$result = $CI->model('custom/Answer_hit_model')->recommended_channel_click_tracking_update($record_id,$channel_id);	
		/* var_dump($result);
		var_dump(sizeof($result)); */
		$this->_renderJSON($result);
		}
		function recommended_channel_click_tracking_update2()
		{
		
		$record_id = $this->input->post('record_id');
		$channel_id = $this->input->post('channel');
		 
		$CI = get_instance();
		
			
		$result = $CI->model('custom/Answer_hit_model')->recommended_channel_click_tracking_update($record_id,$channel_id);	
		/* var_dump($result);
		var_dump(sizeof($result)); */
		$this->_renderJSON($result);
		}
		function recommended_channel_click_tracking_update3($record_id, $channel_id)
		{
		 
		$CI = get_instance();
		
			
		$result = $CI->model('custom/Answer_hit_model')->recommended_channel_click_tracking_update($record_id,$channel_id);	
		/* var_dump($result);
		var_dump(sizeof($result)); */
		$this->_renderJSON($result);
		}
		 
		//-------------------------
		function track_recommended_channel_clicks($url,$channel)
		{
		  $link = urldecode($url);
		  
		  $CI = get_instance();
		  $CI->model('custom/Answer_hit_model')->recommended_channel_clicks($link,$channel);
		 
		 // header('Location: '.$home_address);
		  
		}
	
}

