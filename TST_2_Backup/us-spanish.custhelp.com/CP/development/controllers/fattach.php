<?php
//ob_start();
namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;


class fattach extends \RightNow\Controllers\Base
{ 
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }
	 
    /**
     * Sample function for ajaxCustom controller. This function is used for Digital Signature.
	 * This function calls the custom model which saves the incident and
	 * redirecs to confirmation page.
     */ 
	 
    function digitalSubmit() 
    {  
	try {
       
		$CI = get_instance();
		
		
		$results = $CI->model('custom/pdf_model')->createIncident($_POST);
		
		if($results){
			header('Location:/app/coach_cancellation_form_confirm/lob/team?refno='.$results);
		exit;
		}
	}
	catch (Exception $err )
		{
			//print_r($err->getMessage());
		}
		echo json_encode($results);

    }
	 function pdfSubmitFrench() 
    {   
	
		$results = $this->model('custom/pdf_model')->createIncidentFrench($_POST);
		
		if($results){
		header('Location:/app/coach_cancellation_form_french_confirm/lob/team?refno='.$results);
		}

    }
	
	function pdfSubmitSpanish() 
    {   
	
		$results = $this->model('custom/pdf_model')->createIncidentSpanish($_POST);
		
		if($results){
		header('Location:/app/coach_cancellation_form_spanish_confirm/lob/team?refno='.$results);
		}

    }
	
	 function pdfSubmit() 
    {   
		$results = $this->model('custom/pdf_model_new')->createIncident($_POST);
		if($results){
		header('Location:/app/coach_cancellation_form_confirm/lob/team?refno='.$results);
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
	
	
		function ExistingContact() {
	
		// Copied from pre-migration version of code
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

		$email = $this->input->post('email');
		//$show_first_last_name = $this->input->post('show_first_last_name');
	   	// check if email exists, then get the contact fields
		$this->load->model('Contact');
		$results = $this->model('Contact')->lookupContactByEmail($email);
		
		// Our data comes enclosed in a ResponseObject instance, fetch the value from 'result' private member variable
		$result = $results->result;
		
        if($result){
		
			// Return first and last name only when we want to show it on the page, otherwise just return true
			//if($show_first_last_name && $show_first_last_name != "false") {
				$c_id = intval($result);	//Get the integer value of contact ID
				$contact = $this->model('Contact')->get($c_id);
	
				// Connect Contact record is enclosed in ResponseObject instance's 'result' member variable
				$return['first_name'] =  $contact->result->Name->First;
				$return['last_name'] =  $contact->result->Name->Last;
			//}
			//else {
//				$return = true;
//			}
			echo json_encode($return);
		}
		else{

			echo json_encode($result);
		}
	}
	
		function save_radio_field()
	{
	  $CI = get_instance();
	  $CI->model('custom/Answer_Radio')->save_radio_field($_POST);
	}
	
}

