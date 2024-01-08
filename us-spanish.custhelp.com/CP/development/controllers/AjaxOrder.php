<?php



namespace Custom\Controllers;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
use RightNow\Connect\v1_4 as RNCPHP;

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
	
	function saveOrderForm()
	{
		$postData =  json_decode($this->input->post('form'));
		//echo "<pre>";
		//print_r($postData);
	
		foreach ($postData as $pair)
		{
			$pairdata[$pair->name]=$pair->value;
		}
		 $this->load->model('custom/order');
		 $response = $this->order->saveOrderForm($pairdata);
	
         echo $response;
	
	}
	
	
	
	
	
	
	
	
	function sendOrderForm()
    {
	    
		// AbuseDetection::check($this->input->post('f_tok'));
		$data = json_decode($this->input->post('form'));
		/*print_r($data);
		exit;*/
		
		unset($firstname);
		unset($lastname);
		unset($conemail);
		unset($homephone);
		unset($country);
		foreach($data as $item)
		{
			if($item->name == "Incident.CustomFields.c.new_shipping_date")
			{
				if($item->value)
				{
					$obj->name="priv_note";
					//$time = $item->value ;
					
					
					//$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
					$shipping_date_list = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident.CustomFields.c.new_shipping_date");
					foreach($shipping_date_list as $items) 
					{
						if($items->ID == $item->value)
						{
							$time = $items->LookupName;
						}
					} 
					
					/*$formatted_time = strtotime($time);
					$final_time = date("m/d/Y",$formatted_time);*/
					//$obj->value = "Change Shipping Date: ".$final_time;
				}
			}
			
			/*Below code is to check whether the email id is exist,if it exist then first and last name of that contact will be updated*/
			if($item->name == "Contact.Name.First")
			{
			   if($item->value)
			   $firstname=$item->value;
			}
			
			if($item->name == "Contact.Name.Last")
			{
			   if($item->value)
			   $lastname=$item->value;
			}
			
			if($item->name == "Contact.Emails.PRIMARY.Address")
			{
			    if($item->value)
				$conemail=$item->value;
			}
			
			if($item->name == "Contact.Phones.HOME.Number")
			{
			    if($item->value)
				$homephone=$item->value;
			}
			
			if($item->name == "Contact.Address.Country")
			{
			    if($item->value)
				$country=$item->value;
			}
			
			
			
			if($item->name == "Incident.CustomFields.c.skip_order")
			{
				$obj5->name="priv_note";
				$obj5->value = $item->value;
			}
	/*		if($item->name == "Incident.CustomFields.c.current_alt_flavor_1")
			{
				$obj5->name="priv_note";
				$obj5->value = "**-----TESTING-----**";
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_address")
			{
				$obj1->name="priv_note";
				if($item->value==611)
				{
					$obj1->value = "**One Time Change in Change Shipping Address**";
				}
				else if($item->value==612)
				{
					$obj1->value = "Ongoing Change in Change Shipping Address";
				}
				else
				{
					$obj1->value = "No One Time or Ongoing Change Shipping Address";
				}
			}*/
			
			
			if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date")
			{
				$obj2->name="priv_note";
				if($item->value==613)
				{
					$obj2->value = "**One Time Change in New Shipping Date**";
				}
				else if($item->value==614)
				{
					$obj2->value = "Ongoing Change in New Shipping Date";
				}
				else
				{
					$obj2->value = "No One Time or Ongoing Change in New Shipping Date";
				}
			}
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_spa")
			{
				$obj2->name="priv_note";
				if($item->value=="1152")
				{
					$obj2->value = "**Cambio de una vez en la nueva fecha de envío**";
				}
				else if($item->value=="1153")
				{
					$obj2->value = "Cambio en curso en la nueva fecha de envío";
				}
				else
				{
					$obj2->value = "No hay cambio de una sola vez o en curso en la nueva fecha de envío";
				}
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_fre")
			{
				$obj2->name="priv_note";
				if($item->value==1150)
				{
					$obj2->value = "**Changement unique de la date d'expédition**";
				}
				else if($item->value==1151)
				{
					$obj2->value = "Modification en cours de la nouvelle date d'expédition";
				}
				else
				{
					$obj2->value = "Pas de changement d'heure ni de changement dans la nouvelle date d'expédition";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor-------------------------------------------------*/
			if($item->name == "Incident.CustomFields.c.flavor1")
			{
				if($item->value)
				{					
					$obj3->name="priv_note";
					$shake = $item->value ;
				}
			}
			if($item->name == "Incident.CustomFields.c.ordermodtype")
			{	
				$obj4->name="priv_note";
				if($item->value==290)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==291)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else
				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}
			/*if($item->name == "incidents.orderdelay")
			{	
				$obj4->name="priv_note";
				if($item->value==290)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==291)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else

				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor End-------------------------------------------------*/
		}
		
		$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident", "customFields.c.flavor1"); 
		foreach($flv as $item)
		{		
			if($item->ID==$shake)
			{
				$new_flavor = $item->LookupName;
			}
		}
		/*die('--------------------------------------------------------------------');*/
		if($obj3)
		{	
			$obj3->value = "New Shakeology Flavor: ".$new_flavor."\r\n".$obj4->value;
			array_push( $data,  $obj3);		
		}
		else
		{
			array_push( $data,  $obj4);
		}
		if($obj)
		{
			$obj->value = "Change Shipping Date: ".$time."\r\n".$obj2->value;
			array_push( $data,  $obj, $obj1);
			//$ship_date = $obj->value."\r\n".$obj2->value;				
		}
		else
		{	
			array_push( $data,  $obj2, $obj1);
			//$ship_date =$obj2->value;
		}
		//array_push( $data,  $obj, $obj1);
		//array_push( $data,  $obj1);
		//array_push( $data,  $obj2);
		
		array_push( $data,  $obj5);
		$limit=count($data);
		
		/*print_r($data);
		exit;*/
		$i=0;
		foreach($data as $val)
		{
			if(count($val)==2)
			{
				$value1=$val[0];
				$value2=$val[1];
				$data[$i]=$value1;
				$limit=$limit+1;
				$data[$limit]=$value2;
			}
			$i++;
		}
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
			
			$subject = "Customize Shakeology Home Direct";
			/* if($field->value==49)
			{
				$subject = "Shakeology Customization Form";
			}
			if($field->value==50)
			{
				$subject = "Shakeology Home Direct Customization";
			}*/
			$i++;
		}
		/*print_r($data);
		exit;*/
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		//print_r($results);
		//exit;
		//$results = $this->model('custom/checkcontactfieldmodel')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		//------------------------------------------------------------------------------------------------------------------
		//previous
		//  $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		//changed
		//$results = $this->model('custom/FieldNew')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false')); 
		
		//-------------------------------------------------------------------------------------------------------------------	
		
		// Use the standard field model to create the contact and incident with known fields
		//$this->load->model('standard/Field_model');
		
		
		//$results = $this->Field_model->sendForm($data, $incidentID, $smartAssistant);
		
		
		
		////////////////////////////////////
		//        return $this->errorMsg('results - ' . print_r($results, true));
		////////////////////////////////////
		
		// Use CPHP to add the threads to the newly created incident
		
		if ($results->result['transaction']['incident']['value'] != "") 
		{
		   /*the below model will check the existing contact if present,then its first name and last name updated*/
			//$this->model('custom/checkexistcontact')->checkcontact($results->result['transaction']['incident']['value'],$firstname,$lastname,$conemail);
			$existcon = $this->model('custom/CustomOrder')->checkcontact($results->result['transaction']['incident']['value'],$firstname,$lastname,$conemail,$homephone,$country);
			try 
			{
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
			} 
			catch(Exception $err) 
			{
				// $results['status'] = 0;
				// $results["message"] = "Update threads failed at " . $task . ", <br/>Exception: (" . $err->getCode() . ") " . $err->getMessage();
			}
		}
		echo $results->toJson();
    }
	function sendOrderFormFrench()
    {
	   
		// AbuseDetection::check($this->input->post('f_tok'));
		$data = json_decode($this->input->post('form'));
		unset($firstname);
		unset($lastname);
		unset($conemail);
		unset($homephone);
		unset($country);
		foreach($data as $item)
		{
			if($item->name == "Incident.CustomFields.c.new_shipping_date")
			{
				if($item->value)
				{
					$obj->name="priv_note";
					//$time = $item->value ;
					
					
					//$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
					$shipping_date_list = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident.CustomFields.c.new_shipping_date");
					foreach($shipping_date_list as $items) 
					{
						if($items->ID == $item->value)
						{
							$time = $items->LookupName;
						}
					} 
					
					/*$formatted_time = strtotime($time);
					$final_time = date("m/d/Y",$formatted_time);*/
					//$obj->value = "Change Shipping Date: ".$final_time;
				}
			}
			
			/*Below code is to check whether the email id is exist,if it exist then first and last name of that contact will be updated*/
			if($item->name == "Contact.Name.First")
			{
			   if($item->value)
			   $firstname=$item->value;
			}
			
			if($item->name == "Contact.Name.Last")
			{
			   if($item->value)
			   $lastname=$item->value;
			}
			
			if($item->name == "Contact.Emails.PRIMARY.Address")
			{
			    if($item->value)
				$conemail=$item->value;
			}
			
			if($item->name == "Contact.Phones.HOME.Number")
			{
			    if($item->value)
				$homephone=$item->value;
			}
			
			if($item->name == "Contact.Address.Country")
			{
			    if($item->value)
				$country=$item->value;
			}
			
			if($item->name == "Incident.CustomFields.c.skip_order")
			{
				$obj5->name="priv_note";
				if($item->value == "Retarder ma prochaine commande")
				{
					$obj5->value = "Skip My Next Order";
				}
				else
				{
					$obj5->value = "Do Not Skip My Next Order";
				}
				//$obj5->value = $item->value;
			}
	/*		if($item->name == "Incident.CustomFields.c.current_alt_flavor_1")
			{
				$obj5->name="priv_note";
				$obj5->value = "**-----TESTING-----**";
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_address")
			{
				$obj1->name="priv_note";
				if($item->value==611)
				{
					$obj1->value = "**One Time Change in Change Shipping Address**";
				}
				else if($item->value==612)
				{
					$obj1->value = "Ongoing Change in Change Shipping Address";
				}
				else
				{
					$obj1->value = "No One Time or Ongoing Change Shipping Address";
				}
			}*/
			
			
			if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_fre")
			{
				$obj2->name="priv_note";
				if($item->value==1150)
				{
					$obj2->value = "**One Time Change in New Shipping Date**";
				}
				else if($item->value==1151)
				{
					$obj2->value = "Ongoing Change in New Shipping Date";
				}
				else
				{
					$obj2->value = "No One Time or Ongoing Change in New Shipping Date";
				}
			}
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_spa")
			{
				$obj2->name="priv_note";
				if($item->value=="1152")
				{
					$obj2->value = "**Cambio de una vez en la nueva fecha de envío**";
				}
				else if($item->value=="1153")
				{
					$obj2->value = "Cambio en curso en la nueva fecha de envío";
				}
				else
				{
					$obj2->value = "No hay cambio de una sola vez o en curso en la nueva fecha de envío";
				}
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_fre")
			{
				$obj2->name="priv_note";
				if($item->value==1150)
				{
					$obj2->value = "**Changement unique de la date d'expédition**";
				}
				else if($item->value==1151)
				{
					$obj2->value = "Modification en cours de la nouvelle date d'expédition";
				}
				else
				{
					$obj2->value = "Pas de changement d'heure ni de changement dans la nouvelle date d'expédition";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor-------------------------------------------------*/
			if($item->name == "Incident.CustomFields.c.flavor1")
			{
				if($item->value)
				{					
					$obj3->name="priv_note";
					$shake = $item->value ;
				}
			}
			if($item->name == "Incident.CustomFields.c.ordermodtype_fre")
			{	
				$obj4->name="priv_note";
				if($item->value==854)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==855)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else
				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}
			/*if($item->name == "incidents.orderdelay")
			{	
				$obj4->name="priv_note";
				if($item->value==290)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==291)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else
				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor End-------------------------------------------------*/
		}
		
		$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident", "customFields.c.flavor1"); 
		foreach($flv as $item)
		{		
			if($item->ID==$shake)
			{
				$new_flavor = $item->LookupName;
			}
		}
		/*die('--------------------------------------------------------------------');*/
		if($obj3)
		{	
			$obj3->value = "New Shakeology Flavor: ".$new_flavor."\r\n".$obj4->value;
			array_push( $data,  $obj3);		
		}
		else
		{
			array_push( $data,  $obj4);
		}
		if($obj)
		{
			$obj->value = "Change Shipping Date: ".$time."\r\n".$obj2->value;
			array_push( $data,  $obj, $obj1);
			//$ship_date = $obj->value."\r\n".$obj2->value;				
		}
		else
		{	
			array_push( $data,  $obj2, $obj1);
			//$ship_date =$obj2->value;
		}
		//array_push( $data,  $obj, $obj1);
		//array_push( $data,  $obj1);
		//array_push( $data,  $obj2);
		
		array_push( $data,  $obj5);
		$limit=count($data);
		
		/*print_r($data);
		exit;*/
		$i=0;
		foreach($data as $val)
		{
			if(count($val)==2)
			{
				$value1=$val[0];
				$value2=$val[1];
				$data[$i]=$value1;
				$limit=$limit+1;
				$data[$limit]=$value2;
			}
			$i++;
		}
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
			
			/*if($field->value==49)
			{
				$subject = "Shakeology Customization Form";
			}
			if($field->value==50)
			{
				$subject = "Shakeology Home Direct Customization";
			}*/
			$i++;
		}
		/*print_r($dataobj);
		exit;*/
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		
		/*echo "---------------------------";
		var_dump($results->result['transaction']['incident']['value']);
		exit;*/
		//------------------------------------------------------------------------------------------------------------------
		//previous
		//  $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		//changed
		//$results = $this->model('custom/FieldNew')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false')); 
		
		//-------------------------------------------------------------------------------------------------------------------	
		
		// Use the standard field model to create the contact and incident with known fields
		//$this->load->model('standard/Field_model');
		
		
		//$results = $this->Field_model->sendForm($data, $incidentID, $smartAssistant);
		
		
		
		////////////////////////////////////
		//        return $this->errorMsg('results - ' . print_r($results, true));
		////////////////////////////////////
		
		// Use CPHP to add the threads to the newly created incident
		
		if ($results->result['transaction']['incident']['value'] != "") 
		{
			$existcon = $this->model('custom/CustomOrder')->checkcontact($results->result['transaction']['incident']['value'],$firstname,$lastname,$conemail,$homephone,$country);
			try 
			{
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
				/*var_dump($results->result['transaction']['incident']['value']);
				print_r($data);
				exit;*/
			} 
			catch (RNCPHP\ConnectAPIError $err) 
			{
				// $results['status'] = 0;
				//$results["message"] = "Update threads failed at " . $task . ", <br/>ConnectAPIError: (" . $err->getCode() . ") " . $err->getMessage();
			} 
			catch(Exception $err) 
			{
				// $results['status'] = 0;
				// $results["message"] = "Update threads failed at " . $task . ", <br/>Exception: (" . $err->getCode() . ") " . $err->getMessage();
			}
		}
		echo $results->toJson();
    }
	function sendOrderFormSpanish()
    {
	   
		// AbuseDetection::check($this->input->post('f_tok'));
		$data = json_decode($this->input->post('form'));
		/*print_r($data);
		exit;*/
		unset($firstname);
		unset($lastname);
		unset($conemail);
		unset($homephone);
		unset($country);
		foreach($data as $item)
		{
			if($item->name == "Incident.CustomFields.c.new_shipping_date")
			{
				if($item->value)
				{
					$obj->name="priv_note";
					//$time = $item->value ;
					
					
					//$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
					$shipping_date_list = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident.CustomFields.c.new_shipping_date");
					foreach($shipping_date_list as $items) 
					{
						if($items->ID == $item->value)
						{
							$time = $items->LookupName;
						}
					} 
					
					/*$formatted_time = strtotime($time);
					$final_time = date("m/d/Y",$formatted_time);*/
					//$obj->value = "Change Shipping Date: ".$final_time;
				}
			}
			
			/*Below code is to check whether the email id is exist,if it exist then first and last name of that contact will be updated*/
			if($item->name == "Contact.Name.First")
			{
			   if($item->value)
			   $firstname=$item->value;
			}
			
			if($item->name == "Contact.Name.Last")
			{
			   if($item->value)
			   $lastname=$item->value;
			}
			
			if($item->name == "Contact.Emails.PRIMARY.Address")
			{
			    if($item->value)
				$conemail=$item->value;
			}
			
			if($item->name == "Contact.Phones.HOME.Number")
			{
			    if($item->value)
				$homephone=$item->value;
			}
			
			if($item->name == "Contact.Address.Country")
			{
			    if($item->value)
				$country=$item->value;
			}

			if($item->name == "Incident.CustomFields.c.skip_order")
			{
				$obj5->name="priv_note";
				
				if($item->value == "Retrasar mi próximo pedido")
				{
					$obj5->value = "Skip My Next Order";
				}
				else
				{
					$obj5->value = "Do Not Skip My Next Order";
				}
				
			}
	/*		if($item->name == "Incident.CustomFields.c.current_alt_flavor_1")
			{
				$obj5->name="priv_note";
				$obj5->value = "**-----TESTING-----**";
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_address")
			{
				$obj1->name="priv_note";
				if($item->value==611)
				{
					$obj1->value = "**One Time Change in Change Shipping Address**";
				}
				else if($item->value==612)
				{
					$obj1->value = "Ongoing Change in Change Shipping Address";
				}
				else
				{
					$obj1->value = "No One Time or Ongoing Change Shipping Address";
				}
			}*/
			if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_spa")
			{
				$obj2->name="priv_note";
				if($item->value==1152)
				{
					$obj2->value = "**One Time Change in New Shipping Date**";
				}
				else if($item->value==1153)
				{
					$obj2->value = "Ongoing Change in New Shipping Date";
				}
				else
				{
					$obj2->value = "No One Time or Ongoing Change in New Shipping Date";
				}
			}
			
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date")
			{
				$obj2->name="priv_note";
				if($item->value==613)
				{
					$obj2->value = "**One Time Change in New Shipping Date**";
				}
				else if($item->value==614)
				{
					$obj2->value = "Ongoing Change in New Shipping Date";
				}
				else
				{
					$obj2->value = "No One Time or Ongoing Change in New Shipping Date";
				}
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_spa")
			{
				$obj2->name="priv_note";
				if($item->value=="1152")
				{
					$obj2->value = "**Cambio de una vez en la nueva fecha de envío**";
				}
				else if($item->value=="1153")
				{
					$obj2->value = "Cambio en curso en la nueva fecha de envío";
				}
				else
				{
					$obj2->value = "No hay cambio de una sola vez o en curso en la nueva fecha de envío";
				}
			}*/
			/*if($item->name == "Incident.CustomFields.c.ordermodtype_ship_date_fre")
			{
				$obj2->name="priv_note";
				if($item->value==1150)
				{
					$obj2->value = "**Changement unique de la date d'expédition**";
				}
				else if($item->value==1151)
				{
					$obj2->value = "Modification en cours de la nouvelle date d'expédition";
				}
				else
				{
					$obj2->value = "Pas de changement d'heure ni de changement dans la nouvelle date d'expédition";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor-------------------------------------------------*/
			if($item->name == "Incident.CustomFields.c.flavor1")
			{
				if($item->value)
				{					
					$obj3->name="priv_note";
					$shake = $item->value ;
				}
			}
			if($item->name == "Incident.CustomFields.c.ordermodtype_spa")
			{	
				$obj4->name="priv_note";
				if($item->value==856)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==857)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else
				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}
			/*if($item->name == "incidents.orderdelay")
			{	
				$obj4->name="priv_note";
				if($item->value==290)
				{
					$obj4->value = "**One Time Change in Shakeology Flavor**"; 
				}
				else if($item->value==291)
				{
					$obj4->value = "Ongoing Change in Shakeology Flavor";
				}
				else
				{
					$obj4->value = "No One Time or Ongoing Change in Shakeology Flavor";
				}
			}*/
			/*--------------------------------------New Shakeology Flavor End-------------------------------------------------*/
		}
		
		$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\Incident", "customFields.c.flavor1"); 
		foreach($flv as $item)
		{		
			if($item->ID==$shake)
			{
				$new_flavor = $item->LookupName;
			}
		}
		/*die('--------------------------------------------------------------------');*/
		if($obj3)
		{	
			$obj3->value = "New Shakeology Flavor: ".$new_flavor."\r\n".$obj4->value;
			array_push( $data,  $obj3);		
		}
		else
		{
			array_push( $data,  $obj4);
		}
		if($obj)
		{
			$obj->value = "Change Shipping Date: ".$time."\r\n".$obj2->value;
			array_push( $data,  $obj, $obj1);
			//$ship_date = $obj->value."\r\n".$obj2->value;				
		}
		else
		{	
			array_push( $data,  $obj2, $obj1);
			//$ship_date =$obj2->value;
		}
		//array_push( $data,  $obj, $obj1);
		//array_push( $data,  $obj1);
		//array_push( $data,  $obj2);
		
		array_push( $data,  $obj5);
		$limit=count($data);
		
		/*print_r($data);
		exit;*/
		$i=0;
		foreach($data as $val)
		{
			if(count($val)==2)
			{
				$value1=$val[0];
				$value2=$val[1];
				$data[$i]=$value1;
				$limit=$limit+1;
				$data[$limit]=$value2;
			}
			$i++;
		}
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
		/*print_r($data);
		exit;*/
		if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
			$listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
		}
		$results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		
		//------------------------------------------------------------------------------------------------------------------
		//previous
		//  $results = $this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false'));
		//changed
		//$results = $this->model('custom/FieldNew')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'false')); 
		
		//-------------------------------------------------------------------------------------------------------------------	
		
		// Use the standard field model to create the contact and incident with known fields
		//$this->load->model('standard/Field_model');
		
		
		//$results = $this->Field_model->sendForm($data, $incidentID, $smartAssistant);
		
		
		
		////////////////////////////////////
		//        return $this->errorMsg('results - ' . print_r($results, true));
		////////////////////////////////////
		
		// Use CPHP to add the threads to the newly created incident
		
		if ($results->result['transaction']['incident']['value'] != "") 
		{
			$existcon = $this->model('custom/CustomOrder')->checkcontact($results->result['transaction']['incident']['value'],$firstname,$lastname,$conemail,$homephone,$country);  
			try 
			{
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
			} 
			catch(Exception $err) 
			{
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

