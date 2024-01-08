<?php
namespace Custom\Models;
use RightNow\Connect\v1_4 as RNCPHP;
use RightNow\Connect\v1_4\Update_Acnt as RNCPHP_COM;
use RightNow\Connect\v1_4\CO as RNCPHP_CO;

require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
initConnectAPI();

class update_account_info_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		//this->load->model("standard/Customfield_model");
        //This model would be loaded by using $this->load->model('custom/Sample_model');
    }
	 
	 function getBlank($field)
    {	
	    try
		{
			$Organization = new RNCPHP_COM\Update_Account_Info();
			$cField = substr($field,3);
			$this->formatOrgs($Organization, $cField);
			if(substr($field, 0,3)=='cf_')// check whether field is custom or not ...if custom then get its maetadata.
			{
			  $cfField = substr($field,3);
			  $this->getBlankCF($Organization,$cfField);
			}
		}
		catch (Exception $err )
		{
			return $err->getMessage();
		}
		
		return $Organization;
    }
	
	function getBlankCF($Orgs,$field)
    {
	    try
		{
		$Organization = RNCPHP_COM\Update_Account_Info::getMetadata();
		$custFieldsTypeName = $Organization->type_name;
		$custFieldsMetaData = $custFieldsTypeName::getMetadata();
		$customFields = array();
		foreach($custFieldsMetaData as $x){

				if($x->name ==  $field)
				{  
				
					$Orgs->$field->data_type = $x->COM_type;
					$Orgs->$field->value = NULL;
					$Orgs->$field->default_value = $x->default;
					$i=0;
					while($z = $x->constraints[$i++])
					{
						if($z->kind == 4)// max_length
						$Orgs->$field->field_size = $z->value;
					}
					$Orgs->$field->lang_name = $x->label;
					$Orgs->$field->required = $x->is_required_for_create;
					$Orgs->$field->readonly = $x->is_read_only_for_create;

				}
			}

		}
		catch (Exception $err )
		{
			return $err->getMessage();
		}	
    }
	
 function formatOrgs($Organization, $field)
    {		
		try
		{
		 $Organization_meta = RNCPHP_COM\Update_Account_Info::getMetadata();
		 $Organization->name->data_type = $Organization_meta->$field->COM_type;
		 $Organization->name->default_value = $Organization_meta->$field->default;
		 $i=0;
			while($x = $Organization_meta->$field->constraints[$i++])
			{
			 if($x->kind == 4)// max_length
			 $Organization->name->field_size = $x->value;
			}
		 $Organization->name->lang_name = $Organization_meta->$field->label;
		 $Organization->name->required = $Organization_meta->$field->is_required_for_create;
		 $Organization->name->readonly = $Organization_meta->$field->is_read_only_for_create;
		 $Organization->name->value = NULL;
		 }
		catch (Exception $err )
		{
			return $err->getMessage();
		}
				 
    }
	
	function createComplaint($results, $CBO_Array,$data)
	{
	try{
		
	        $ref_no = $results->result['transaction']['incident']['value'];
	        $complaint = new RNCPHP\Update_Acnt\Update_Account_Info();
			$plastic_texture = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_plastic_texture");
			foreach($plastic_texture as $items) 
			{
				if($items->ID == $CBO_Array['cf_plastic_texture'])
				{
				$complaint->plastic_texture = $items;
				}
			} 
			$plastic_color = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_plastic_color");
			foreach($plastic_color as $items) 
			{
				if($items->ID == $CBO_Array['cf_plastic_color'])
				{
				$complaint->plastic_color = $items;
				}
			} 
			$plastic_size = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_plastic_size");
			foreach($plastic_size as $items) 
			{
				if($items->ID == $CBO_Array['cf_plastic_size'])
				{
				$complaint->plastic_size = $items;
				}
			} 
			$unknown_filth_color = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_filth_color");
			foreach($unknown_filth_color as $items) 
			{
				if($items->ID == $CBO_Array['cf_unknown_filth_color'])
				{
				$complaint->unknown_filth_color = $items;
				}
			} 
			$unknown_filth_appearance = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_filth_appearance");
			foreach($unknown_filth_appearance as $items) 
			{
				if($items->ID == $CBO_Array['cf_unknown_filth_appearance'])
				{
				$complaint->unknown_filth_appearance = $items;
				}
			}  
			//$insect_box_or_prod = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\pcf_insect_box_prod");
			$insect_box_or_prod = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_pest_box_product");
			
			foreach($insect_box_or_prod as $items) 
			{
				if($items->ID == $CBO_Array['cf_insect_box_or_prod'])
				{
				$complaint->insect_box_or_prod = $items;
				}
			} 
			$pest_size = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_pest_size");
			foreach($pest_size as $items) 
			{
				if($items->ID == $CBO_Array['cf_pest_size'])
				{
				$complaint->pest_size = $items;
				}
			} 
			$product_damage = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\pcf_product_damage");
			foreach($product_damage as $items) 
			{
				if($items->ID == $CBO_Array['cf_product_damage'])
				{
				$complaint->product_damage = $items;
				}
			} 
			
			
			
            $incident = RNCPHP\ROQL::queryObject( "SELECT Incident FROM Incident I WHERE I.ReferenceNumber = '".$ref_no."'" )->next();
            $complaint->incident = $incident->next();
            $contact = RNCPHP\ROQL::queryObject( "SELECT I.PrimaryContact.ParentContact FROM Incident I WHERE I.ReferenceNumber = '".$ref_no."'" )->next();
            $complaint->contact = $contact->next();
            $complaint->initiator = $CBO_Array['cf_initiator'];
            $complaint->department = $CBO_Array['cf_department'];
            $complaint->order_num = $CBO_Array['cf_order_num'];
            $complaint->is_return = $this->getRadioCode($CBO_Array['cf_is_return']);
            $complaint->expired_date = ($CBO_Array['cf_expired_date']) ? mktime(0,0,0,substr($CBO_Array['cf_expired_date'],0,2),substr($CBO_Array['cf_expired_date'],3,2),substr($CBO_Array['cf_expired_date'],6,4)) : null;
			
            $complaint->date_used = ($CBO_Array['cf_date_used']) ? mktime(0,0,0,substr($CBO_Array['cf_date_used'],0,2),substr($CBO_Array['cf_date_used'],3,2),substr($CBO_Array['cf_date_used'],6,4)) : null;
			
			
            /* Start Validation for Lot# to make uppercase and remove space*/
			if($CBO_Array['cf_lot_num']!="")
			
			{
			
	
			
			$newvar= $CBO_Array['cf_lot_num'];
			//$upper=strtoupper($newvar);
			$nowhitespace = preg_replace('/\s+/', '', $newvar);
		
		    $CBO_Array['cf_lot_num']=$nowhitespace;
	
			
			}
		   
		   /*End*/
			
            $complaint->lot_num = $CBO_Array['cf_lot_num'];
            $complaint->reason_other = $CBO_Array['cf_other'];
            $complaint->other_hist = $this->getRadioCode($CBO_Array['cf_other_hist']);
            $complaint->other_desc = $CBO_Array['cf_other_desc'];
            $complaint->meds_hist = $this->getRadioCode($CBO_Array['cf_meds_hist']);
            $complaint->meds_desc = $CBO_Array['cf_meds_desc'];
            $complaint->allergies_hist = $this->getRadioCode($CBO_Array['cf_allergies_hist']);
            $complaint->allergies_desc = $CBO_Array['cf_allergies_desc'];
            $complaint->condition_hist = $this->getRadioCode($CBO_Array['cf_condition_hist']);
            $complaint->condition_desc = $CBO_Array['cf_condition_desc'];
            $complaint->attention_hist = $this->getRadioCode($CBO_Array['cf_attention_hist']);
            $complaint->attention_desc = $CBO_Array['cf_attention_desc'];
            $complaint->sku = $CBO_Array['cf_sku'];
            $complaint->type = $CBO_Array['cf_type']; 
            
			$complaint->duration_symptoms=$this->getRadioCode($CBO_Array['cf_duration_symptoms']); 
            $complaint->other_notes = $CBO_Array['cf_other_notes'];
			$complaint->injury_compensation=$this->getRadioCode($CBO_Array['cf_injury_compensation']); 
            $complaint->injury_comp_desc = $CBO_Array['cf_injury_comp_desc'];
			$complaint->cust_product=$this->getRadioCode($CBO_Array['cf_cust_product']);
			$complaint->send_return_label=$this->getRadioCode($CBO_Array['cf_send_return_label']);
			$complaint->comp_request=$this->getRadioCode($CBO_Array['cf_comp_request']);
			$complaint->comp_request_desc = $CBO_Array['cf_comp_request_desc'];
			$complaint->photo_evidence=$this->getRadioCode($CBO_Array['cf_photo_evidence']);
			$complaint->filth_easily_brk=$this->getRadioCode($CBO_Array['cf_filth_easily_brk']);
			
			
			
            $prod_id = $CBO_Array['Incident.Product'];
			$cat_id = $CBO_Array['Incident.Category'];

            $category = RNCPHP\ROQL::queryObject("SELECT ServiceCategory FROM ServiceCategory WHERE ServiceCategory.ID = $cat_id")->next(); //Using ROQL Query to get product by description
            $complaint->reason = $category->next(); // using the next method to navigate to first object of query
            $complaint->save();
			
             
            //save the contact fields.  The agent is filling out the forms and the contact will obvioulsy 
            //not not be logged in so no contact fields would be updated.
            $incident = RNCPHP\ROQL::queryObject( "SELECT Incident FROM Incident I WHERE I.ReferenceNumber = '".$ref_no."'" )->next();
            $inc = $incident->next();
            foreach ($data as $field) { 
			
			    
				
                if ($field->table == "Contact" || 
                    $field->table == "Incident" || 
                    $field->name == 'cf_initiator' ||
                    $field->name == 'cf_department'||
                    $field->name == 'cf_pc_customer_email'){

                    switch($field->name){
                        case "Contact.Address.Country":
						    
							//print_r($inc->CustomFields->c->pc_country);
							
                            $country_id = $field->value;
							if ($country_id != "")
							{
								$country = RNCPHP\Country::fetch($country_id);
								$field->value = $country->Names[0]->LabelText;
								
							}
                            else
							{
                                $field->value = "International";
						    }
                            $inc->CustomFields->c->pc_country = $field->value;
                            break;
                        case "Contact.Address.StateOrProvince":
						    if ($country_id != "")
							{
								$state_id = $field->value;
								$states = $country->Provinces;
								$field->value = $this->getStateName($states,$state_id);
								$inc->CustomFields->c->pc_state = $field->value;
							}
							
                            break;
                        case "Incident.CustomFields.c.pc_coach_id":
                            if($field->value == 0)
                               $field->value = "No";
                            else
                               $field->value = "Yes";
                            break;
                        
                        case "Incident.CustomFields.c.initiator_type":
                            if($field->value == 319)
                               $field->value = "Agent";
                            else
                               $field->value = "Team Lead";
                            break;
                        case "cf_pc_customer_email":
                            $inc->CustomFields->c->pc_customer_email = $field->value;
                            break;
                    }
					
                    $field_name = str_replace("cf_","", $field->name);
                    $field_name = str_replace("_", " ",  $field_name);
                    $field_name = str_replace("pc ", "", $field_name);
					$field_name = str_replace("Incident.CustomFields.c.", "", $field_name);

                    if ($field->name == 'pc_account_num')
					{
                                $field_name = "customer num";
                    }
                    if ($field->name == 'cf_department')
					{
                                $field_name = "agent id";
                    }
					if ($field->name == 'Contact.Address.Country')
					{
                                $field_name = "country id";
                    }
					if ($field->name == 'Contact.Address.StateOrProvince')
					{
                                $field_name = "prov id";
                    }
                    
                    if ($field->name != "Prod" && 
					    $field->name != "Incident.Product" && 
					    $field->name != "Contact.Emails.PRIMARY.Address" &&
                        $field->name != "Incident.FileAttachments" && 
                        $field->name != "Incident.Threads" &&
                        $field->name != "cf_initiator" &&
                        $field->name != "cf_department" &&
                        $field->name != "Incident.CustomFields.c.initiator_type" &&
                        $field->name != "Incident.CustomFields.c.complaint_routing" )
                            $contacts_table_string .= $field_name.": ".$field->value."\n";
                    
                    if ($field->name == 'cf_initiator' ||
                        $field->name == "cf_department" ||
                        $field->name == "Incident.CustomFields.c.initiator_type"){
                            $agent_table_string .= $field_name.": ".$field->value."\n";
                        }
                    
                    
                }
            }
            $t = count($inc->Threads);
		    
	    if ($contacts_table_string){
		    $inc->Threads[$t] = new RNCPHP\Thread();
		    $inc->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
		    $inc->Threads[$t]->EntryType->ID = 3;
		    $inc->Threads[$t]->Text = "CUSTOMER INFORMATION\n".$contacts_table_string;
	    }
	    if ($agent_table_string){
		    $inc->Threads[$t+1] = new RNCPHP\Thread();
		    $inc->Threads[$t+1]->EntryType = new RNCPHP\NamedIDOptList();
		    $inc->Threads[$t+1]->EntryType->ID = 3;
		    $inc->Threads[$t+1]->Text = "TEAM LEAD/AGENT INFORMATION\n".$agent_table_string;
	    }
            
          // $inc->Product = RNCPHP\ServiceProduct::fetch($prod_id);
		//$inc->Category = RNCPHP\ServiceCategory::fetch($cat_id);
			 
		    
           
	 
$inc->save(RNCPHP\RNObject::SuppressAll);
	
}
		catch (Exception $err ){
    echo $err->getMessage();
}
	
		}
	
		
	
	function getRadioCode($input){
        
        switch($input){
                case 1:
                    $code = 0;
                    break;
                case 2:
                    $code = 1;
                    break;
                default:
                    $code = null;
                    break;
            }
        return $code;
    }
	
	/*function getProvLabel($prov_id){
    	$this->load->model('standard/Contact');
        $results = $this->Contact->getCountryDetails(1);   
    	logMessage($results);
        foreach($results['states'] as $result){
        	logMessage("prov id ".$prov_id." result".$result['id']);
		if($result['id'] == $prov_id){
			$label = $result['val'];
		}
    	}
    	    
    	return $label;	    
    }*/
	
	function getStateName($states,$state_ID)
	{
			foreach ($states as $state)
			  {
			  
			  if($state->ID==$state_ID)
			  {
			  return $state->Name;
			  }
			  
			  }
			  
			  return null;
	
	}
	
	function getValues($parent) {

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
    }

}
