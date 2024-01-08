<?php
namespace Custom\Widgets\Input;
use RightNow\Utils\Connect,
    RightNow\Utils\Config,
	RightNow\Connect\v1_2 as RNCPHP;


class SelectionInputCOMenu extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

	  $validAttributes = explode('.',$this->data['attrs']['name']);
		if(substr($validAttributes[1], 0,3)=='cf_')
		{
			$field_name = substr($validAttributes[1], 3);
		}
		$cacheKey = 'Input_' . $this->data['attrs']['name'];
        $cacheResults = checkCache($cacheKey);
        if(is_array($cacheResults))
		{
            list($this->field, $this->table, $this->fieldName, $this->data) = $cacheResults;
			$this->field = unserialize($this->field);

            return;
		}
		$pack = $validAttributes[0];
       $this->table = $validAttributes[0];
       $this->fieldName = $validAttributes[1];
	   $table=$this->table.$this->fieldName;
	   $this->CI->load->model('custom/generic_model');
	      
	    $this->data['field'] = $this->CI->generic_model->getBusinessObjectField($pack,$this->table,$this->fieldName );
	
		$this->dataType = $this->data['field']->data_type;
		if(empty($this->data['field']->default_value))
		{
			
			@$this->data['field']->default_value="Please select ".$this->data['field']->lang_name;
		}
		
	   $url_id=getUrlParm(ID);
	  
	   if($url_id)
	   {
	   $data_value = $this->CI->generic_model->getdatavalues($pack,$this->table,$this->fieldName,$url_id);
	  $this->data['field']->value=intval($data_value);
	   }
		
	    $this->data['js']['type'] = 'NamedIDLabel';
		$this->data['js']['table'] = $this->table;
        $this->data['js']['name'] = $this->fieldName;
		$this->data['constraints'] = array();
		$this->data['js']['constraints'] = $this->data['constraints'];	
		$this->data['inputType']='Select';
		$this->data['displayType']='Select';
		
		
	    if($this->fieldName === 'cf_plastic_texture')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "plastic_texture"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_plastic_color')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "plastic_color"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_plastic_size')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "plastic_size"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_unknown_filth_color')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "unknown_filth_color"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_unknown_filth_appearance')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "unknown_filth_appearance"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_insect_box_or_prod')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "insect_box_or_prod"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_pest_size')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "pest_size"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		if($this->fieldName === 'cf_product_damage')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "product_damage"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
	   // PCF Change
	   
	   			if($this->fieldName === 'cf_injury_type')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "injury_type"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
			if($this->fieldName === 'cf_injury_part')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "injury_part"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
			if($this->fieldName === 'cf_bike_parts')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "bike_parts"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
			if($this->fieldName === 'cf_requested_qca')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "requested_qca"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
		    if($this->fieldName === 'cf_sought_medical_attention')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "sought_medical_attention"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
			if($this->fieldName === 'cf_mark_pcf_urgent')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "mark_pcf_urgent"); 
			$this->data['menuItems'] = $items;
			return $items;	
		}
			if($this->fieldName === 'cf_medical_attention')
		{
			$field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$itemsList=array();
			$items = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\QA_Complain\\Complaint", "medical_attention"); 
	    	foreach ($items as $item)
			{
					$itemsList[] = array("ID" => $item->ID,"LookupName" => $item->LookupName);
		   }
		  for($i=0;$i<count($itemsList);$i++)
		  {
			  if($itemsList[$i]['ID']==1)
			  {
				  $itemsList[$i]['LookupName']= "Self administered";
			  }
			   if($itemsList[$i]['ID']==2)
			  {
				  $itemsList[$i]['LookupName']= "First aid provided by a non-medical person";
			  }
			   if($itemsList[$i]['ID']==3)
			  {
				  $itemsList[$i]['LookupName']= "Doctor visit or visit with another medical professional";
			  }
			   if($itemsList[$i]['ID']==4)
			  {
				  $itemsList[$i]['LookupName']= "Urgent care or Emergency Department (ER) visit received";
			  }
			  if($itemsList[$i]['ID']==5)
			  {
				  $itemsList[$i]['LookupName']= "Hospital admission";
			  }
		  }
			$this->data['menuItems'] = $itemsList;
			return $itemsList;	
			
		}

    }

  
   
	
}