<?php

namespace Custom\Controllers;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
use RightNow\Connect\v1_2 as RNCPHP;

class AjaxOrder extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
	
        parent::__construct();
    }

    /** 
     * Sample function for AjaxOrder controller. This function can be called by sending
     * a request to /ci/AjaxOrder/ajaxFunctionHandler.
     */
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }
	
	 function sendOrderForm_cust()
    {
       // AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
		
		
        if(!$data)
        {
            writeContentWithLengthAndExit(json_encode(getMessage(JAVASCRIPT_ENABLED_FEATURE_MSG)));
        }
        
        ////////////////////////////////////
        //        return $this->errorMsg('data - ' . print_r($data, true));
        ////////////////////////////////////

        //$incidentID = null;         // Create a new incident. 
        //$smartAssistant = false;    // No smart assistant here
		$dataobj = null;
		$i=0;
		
		foreach($data as $field)
		{
		   $dataobj[$i]->name =  $field->name;
		   $dataobj[$i]->value =  $field->value;
		   $dataobj[$i]->required =  $field->required;
		   
		   $i++;

		}
		
        if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }

        $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
        // Use the standard field model to create the contact and incident with known fields
        //$this->load->model('standard/Field_model');
		
		
        //$results = $this->Field_model->sendForm($data, $incidentID, $smartAssistant);
			
		
		
        ////////////////////////////////////
        //        return $this->errorMsg('results - ' . print_r($results, true));
        ////////////////////////////////////

        // Use CPHP to add the threads to the newly created incident
        if ($results->result['transaction']['incident']['value'] != "") 
		{
            
            try {
                $task = "initConnectAPI()";     // Used with error message to specify which caused the exception
                initConnectAPI();

                if (isset($results->result['transaction']['incident']['value'])) 
				{
                    $inc = $results->result['transaction']['incident']['value'];
                } else {
                   // $inc = $results['i_id'];
                }

                $task = "fetch Incident (". $inc .")";
				$subject = "Shakeology Customization Form";
			
				$this->model('custom/CustomOrder')->SaveOrderForm_cust($inc,$dataobj,$subject);
				
		

            } 
			catch (RNCPHP\ConnectAPIError $err) 
			 {
			 
			
               // $results['status'] = 0;
                //$results["message"] = "Update threads failed at " . $task . ", <br/>ConnectAPIError: (" . $err->getCode() . ") " . $err->getMessage();
            } catch(Exception $err) {
			
               // $results['status'] = 0;
               // $results["message"] = "Update threads failed at " . $task . ", <br/>Exception: (" . $err->getCode() . ") " . $err->getMessage();
            }
        }
		
		 echo $results->toJson();
	
       
    }
	
	function sendOrderForm()
    {
	   
       // AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
		 
		
        if(!$data)
        {
            writeContentWithLengthAndExit(json_encode(getMessage(JAVASCRIPT_ENABLED_FEATURE_MSG)));
        }
        
        ////////////////////////////////////
        //        return $this->errorMsg('data - ' . print_r($data, true));
        ////////////////////////////////////

       // $incidentID = null;         // Create a new incident. 
        //$smartAssistant = false;    // No smart assistant here
		$dataobj = null;
		$i=0;
		
		foreach($data as $field)
		{
		   $dataobj[$i]->name =  $field->name;
		   $dataobj[$i]->value =  $field->value;
		   $dataobj[$i]->required =  $field->required;
		   
		   if($field->value==49)
		   {
		   $subject = "Shakeology Customization Form";
		   }
		   if($field->value==50)
		   {
		   $subject = "Shakeology Home Direct Customization";
		   }
		   
		   $i++;

		}
		
         
		 if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }

        $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
        // Use the standard field model to create the contact and incident with known fields
        //$this->load->model('standard/Field_model');
		
		
        //$results = $this->Field_model->sendForm($data, $incidentID, $smartAssistant);
			
		
		
        ////////////////////////////////////
        //        return $this->errorMsg('results - ' . print_r($results, true));
        ////////////////////////////////////

        // Use CPHP to add the threads to the newly created incident
        if ($results->result['transaction']['incident']['value'] != "") 
		{
            
            try {
                $task = "initConnectAPI()";     // Used with error message to specify which caused the exception
                initConnectAPI();

                if (isset($results->result['transaction']['incident']['value'])) 
				{
                    $inc = $results->result['transaction']['incident']['value'];
                } else {
                   // $inc = $results['i_id'];
                }

                $task = "fetch Incident (". $inc .")";
			
				
				
				$this->model('custom/CustomOrder')->SaveOrderForm_cust($inc,$dataobj,$subject);
				
		

            } 
			catch (RNCPHP\ConnectAPIError $err) 
			 {
			 
			
               // $results['status'] = 0;
                //$results["message"] = "Update threads failed at " . $task . ", <br/>ConnectAPIError: (" . $err->getCode() . ") " . $err->getMessage();
            } catch(Exception $err) {
			
               // $results['status'] = 0;
               // $results["message"] = "Update threads failed at " . $task . ", <br/>Exception: (" . $err->getCode() . ") " . $err->getMessage();
            }
        }
		
		 echo $results->toJson();
	
       
    }
	function sendorderform_customer_coach()
	{
		$country = '';
	 	$contactemail = '';
		$ccc_transfer_coach_email = '';
		$ccc_transfer_coach_name = '';
		$membertype = '';
		$data = json_decode($this->input->post('form'));
		foreach($data as $item)
		{
		if($item->name == "Contact.Address.Country")
			{
			    if($item->value)
				$country=$item->value;
			}
		if($item->name == "Contact.Emails.PRIMARY.Address")
		{
			if($item->value)
			$contactemail=$item->value;
		}
		if($item->name == "Incident.CustomFields.c.member_type_eng")
		{
			$membertype = $item->value;
		}
		if($item->name == "Incident.CustomFields.c.ccc_transfer_coach_email")
		{
			$ccc_transfer_coach_email = $item->value;
		}
		if($item->name == "Incident.CustomFields.c.ccc_transfer_coach_name")
		{
			$ccc_transfer_coach_name = $item->value;
		}
		}
		
		if($membertype == '771' && (empty($ccc_transfer_coach_email)||empty($ccc_transfer_coach_name))){
	
			/*$datalog = "-------------------------------".$this->input->post('form')."--------------------------------------";
			error_log($datalog,3, '/cgi-bin/us_english.cfg/scripts/cp/customer/development/views/pages/error_log/emptycoachlog.txt');*/
			$response['result']['transaction']['incident']['key']="response";
			$response['result']['transaction']['incident']['value']="error";
			$response['result']['sessionParam']=\RightNow\Utils\Url::sessionParameter();
			echo json_encode($response);
			
		}else{
		if(($membertype == 770 && !empty($ccc_transfer_coach_email)) || ($membertype == 770 && !empty($ccc_transfer_coach_name))){
			foreach($data as $item){
				if($item->name == "Incident.CustomFields.c.ccc_transfer_coach_email"){
					$item->value = '';
				}
				if($item->name == "Incident.CustomFields.c.ccc_transfer_coach_name"){
					$item->value = '';
				}
				
			}
		
		}
		
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		//$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		$results = $this->model('custom/fb')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		
		//print_r($results);
		if(\RightNow\Utils\Framework::isLoggedIn()) 		
		{	
			$a=$results->result['transaction']['incident']['value'];
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
		/*if ($results->result['transaction']['incident']['value'] != "") 
		{
			if(!empty($country)){
			$countrysave = $this->model('custom/CustomOrder')->contact_country_save($results->result['transaction']['incident']['value'],$country,$contactemail);
			}
		}*/
		echo json_encode($response);
		}
	}	
}

