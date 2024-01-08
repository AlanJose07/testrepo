<?php

namespace Custom\Controllers;
use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO,
	RightNow\Connect\v1_3 as RNCPHP;

class AjaxCustom extends \RightNow\Controllers\Base
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
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }

    public function submitAnswerFeedback()
		{
		    
		    
			AbuseDetection::check();
			$fbId= $this->input->post('fb_id');  
			$answerID = $this->input->post('a_id');
			$reason = $this->input->post('reason');
			if($this->input->post('addition_feedback')=="")
			$additionalfeedback='No Value';
			else
			$additionalfeedback=$this->input->post('addition_feedback');
			if($answerID === 'null')
				$answerID = null;
			$rate = $this->input->post('rate');
			
			
			$lob = $this->input->post('lob');   
			if(intval($rate)==2)  //when Yes button is clicked
			{
			
				$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReasonYes($rate,$answerID,$lob,$reason);
				if($fbupdate){
					print_r($fbupdate);
					die;
					// $this->_renderJSON(array('Feedback Tracking ID' => $fbupdate));
					// return;
				}
				if(!$fbupdate){
					print_r("Couldn't send the feedback");
					die;
					// $this->_renderJSON(array('error' => "Couldn't send the feedback"));
					// return;
				}
			}
			$message = $this->input->post('message');
			$givenEmail = $this->input->post('email');
			$givenEmail ="anonymous@anoymous.invalid";
			$threshold = $this->input->post('threshold');
			$optionsCount = $this->input->post('options_count');
			
			
			
			
			
			$formToken = $this->input->post('f_tok');
			if (!count($_POST) || !$formToken || !Framework::isValidSecurityToken($formToken, 0)){
				print_r(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
				// $this->_renderJSON(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
				// return;
			}
		   // $incidentResult = $this->model('Incident')->submitFeedback($answerID, $rate, $threshold, null, $message, $givenEmail, $optionsCount);
			//var_dump($fbId);
			$fbId=intval($fbId);  
			//$inc_id=$incidentResult->result->ID;
			if(!$fbId)
			{
				     
				$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReason($reason,$answerID,$lob,$rate,$additionalfeedback); // click no button then click submit or cancel 
			}
			else
			{
				//var_dump($fbId);
				
			$fbupdate = $this->model('custom/answer_feedback')->submitFeedbackReasonUpdate($fbId,$reason,$answerID,$lob,$rate,$additionalfeedback); 
			}
			if($fbupdate){
				print_r($fbupdate);
				// $this->_renderJSON(array('Feedback Tracking ID' => $fbupdate));
				// return $fbupdate;
			}
			if(!$fbupdate){
				print_r("Couldn't send the feedback");
				// $this->_renderJSON(array('error' => "Couldn't send the feedback"));
				// return;
			}
			//$this->_renderJSON(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
		}
	
	
	function getAutoFillFields()
	{
        // Find our position in the file tree
        require_once(get_cfg_var('doc_root'). '/include/ConnectPHP/Connect_init.phph' );
        initConnectAPI();
        
        $p_id = $this->input->post('prodID');
        try{
            $products = RNCPHP\ROQL::queryObject("SELECT ServiceProduct FROM ServiceProduct WHERE ServiceProduct.ID = $p_id")->next(); //Using ROQL Query to get product by description
        }catch( Exception $e ){
            logMessage("in error = ".$e); 
        }
        
        $product = $products->next();
        $desc = $product->Descriptions[0]->LabelText;
        $results = explode(":", $desc);
        //log_message($products);
        echo json_encode($results);
    }
    
    /*function getProvLabel($prov_id){
    	$this->load->model('standard/Contact_model');
        $results = $this->Contact_model->getCountryDetails(1);   
    	logMessage($results);
        foreach($results['states'] as $result){
        	logMessage("prov id ".$prov_id." result".$result['id']);
		if($result['id'] == $prov_id){
			$label = $result['val'];
		}
    	}
    	    
    	return $label;	    
    }*/
	
    /*function getValues($parent) {

        // $parent is a non-associative (numerically-indexed) array
        if (is_array($parent)) {

            foreach($parent as $val) {
                $this->getValues($val);
            }
        }

        // $parent is an associative array or an object
        elseif (is_object($parent)) {

            while (list($key, $val) = each($parent)) {

                $tmp = $parent->$key;

                if ( (is_object($parent->$key)) || (is_array($parent->$key)) ) {
                    $this->getValues($parent->$key);
                }

            }
        }
    }*/
	
	function sendForm()
    {

	try{
       // AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
		
        
        logMessage($data);
        if(!$data)
        {
            writeContentWithLengthAndExit(json_encode(getMessage(JAVASCRIPT_ENABLED_FEATURE_MSG)));
        }
      
        //create an array of CBO fields with name as key and value as value
        $counter = 0;
		
       /* foreach($data as $key => $value)
		{
		  
            //the custom field names
            if(substr($data[$key]->name,0,3) == "cf_" || $data[$key]->name == "Incident.Product" )
			{
               
			  if(!$data[$key]->value || $data[$key]->value == "N/A")
                    $CBO_Array[$data[$key]->name] = null;   
                else
                    $CBO_Array[$data[$key]->name] = $data[$key]->value; 
			}
	
	               $counter++;
        }*/
		
		$ProductCount=0;
		$CategoryCount=0;
		
		foreach($data as $key => $value)
		{
		
		    if($data[$key]->name== "Incident.Product")
			{
			  if($ProductCount==1)
			  {
			    $data[$key]->name = "Prod";
			  }
			    $ProductCount++;
			}
			else if($data[$key]->name== "Incident.Category")
			{
			if($CategoryCount==1)
			  {
			    $data[$key]->name = "Cat";
			  }
			    $CategoryCount++;
			}
			
		
		
			$tempArray = explode(".",$data[$key]->name);
			
			
		  
            //the custom field names
            if(count($tempArray)==1 || $data[$key]->name == "Incident.Product"|| $data[$key]->name == "Incident.Category")
			{
               
			  if(!$data[$key]->value || $data[$key]->value == "N/A")
                    $CBO_Array[$data[$key]->name] = null;   
                else
                    $CBO_Array[$data[$key]->name] = $data[$key]->value; 
			}
			$counter++;
        }
		//$data = new stdClass();
		//echo $counter."counter";
		//echo "<pre>";
		//print_r($data); exit;
        //setting the contact 
		@$data[$counter]->name ="Contact.Emails.PRIMARY.Address";
		$data[$counter]->value = "corpesc@service.beachbody.com";
		$data[$counter]->required =1 ;
		
		foreach($data as $key => $value)
		{
			$keyName = explode(".",$data[$key]->name);
			@$CO_Array[$key]->table =  $keyName[0];
			$CO_Array[$key]->name= $data[$key]->name;
			$CO_Array[$key]->value = $data[$key]->value;
		}
			
		
        if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }
        $smartAssistant = $this->input->post('smrt_asst');
		//$datalog = json_encode($data);
	//error_log($datalog,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_logdata_'.date('d-m-Y-H-i-s').'_log.txt');
        $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'true'));
		
        //$results =  $this->model('Field')->sendForm($data, $incidentID, $smartAssistant);
        //$results = $this->Field->sendForm($data, $incidentID, $smartAssistant);
		
		$results_new = 0;

        if($results->result['transaction']['incident']['value'])
		{
		
	
			$this->load->model('custom/complaint_model');
			$results_new = $this->complaint_model->createComplaint($results, $CBO_Array, $CO_Array );
			
			/*if(empty($results_new))
			{  
			$message="\n no custom object entry Reference no: #".$results->result['transaction']['incident']['value'];
	error_log($message,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_log_'.date('d-m-Y-H-i-s').'_log.txt');
			} */
			
        }
		
		/*else
		{
		
		$message="\n Else part of transaction Reference no: #".$results->result['transaction']['incident']['value'];
	error_log($message,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_log_'.date('d-m-Y-H-i-s').'_log.txt');
	
		}*/
		
		//$message="\n new log #".$results->result['transaction']['incident']['value']."result CO ".$results_new;
	//error_log($message,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_log1_'.date('d-m-Y-H-i-s').'_log.txt');
	
		echo $results->toJson();
		
	}	
		
	catch (Exception $err ){
   
    echo $err->getMessage();
	
	//$message=$err->getMessage()."\n Catch section of controller Reference no: #".$results->result['transaction']['incident']['value'];
	//error_log($message,3, '/cgi-bin/agentkb.cfg/scripts/cp/customer/development/views/pages/error_log/agentkb_error_log_'.date('d-m-Y-H-i-s').'_log.txt');
	}
	
	
    }
	
	    /*Below function to get the solution of the answer<for user guide answers>*/
		/*Below function uses a model Answer. Mode 1->showing answer content and mode*/
		/*by jithin*/
		function getanswer() 
	    {
		 	
	 	 $ans_id = $this->input->post('ans_id');		 
		 $CI = get_instance();
         $result = $CI->model('custom/complaint_model')->userguideanswer($ans_id,1);   
		 echo json_encode($result);
	    }
		/*by jithin*/
		
		function get_hide_report_id()
		{	
		    $CI = get_instance();
		    $get_id= $CI->model('custom/complaint_model')->get_hide_id_model(); 
			echo json_encode($get_id);
		}
}