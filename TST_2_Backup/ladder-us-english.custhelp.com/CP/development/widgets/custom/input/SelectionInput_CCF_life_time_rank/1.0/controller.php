<?php
namespace Custom\Widgets\input;

use RightNow\Utils\Connect,
    RightNow\Utils\Config;

class SelectionInput_CCF_life_time_rank extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }
	
	/**
     * Populate the list of options in the select box. Attempts to get the list from the metadata
     * if available and if not, falls back to getting the named ID list from Connect. Also handles
     * the special case of filtering StateOrProvince values based on what Country has been selected
     */
    protected function getMenuItems(){
        $menuItems = array();
	 	//echo $this->data['inputName'];
	 	//echo $this->fieldName;
		if($this->fieldName === 'language_shk')
		{
		//echo "11111111111111111111";
				$field = explode('.', $this->data['inputName']);
		        $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
			 	
				if($items)
				{
					$count = count($items);
					foreach ($items as $item)
					{
						if($item->ID != 1183)
						{
							$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
						}
					}
				}
					return $menuItems;	
		}
		if($this->fieldName === 'coach_enrollments')
		{
			//echo "2222222222";
				$field = explode('.', $this->data['inputName']);
		        $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
			 	
				if($items)
				{
					$count = count($items);
					foreach ($items as $item)
					{
						if($item->ID != 1178)// hide w8
						{
							$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
						}
					}
				}
					return $menuItems;	
		}
		
		if($this->fieldName === 'life_time_rank')
		{
			
				$field = explode('.', $this->data['inputName']);
		        $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
			 	
				$current_url=$_SERVER['REQUEST_URI'];
				
							
				if($items)
				{
					$count = count($items);
					foreach ($items as $item)
					{
					
					
					//$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
					
					
					
						if($item->ID == 478)
						{
							if (strpos($current_url, 'spanish') !== false)
							{
								$menuItems[$item->ID] = "Entrenador(a) - Diamante ";
							}
							else if (strpos($current_url, 'french') !== false)
							{
								$menuItems[$item->ID] = "Coach – Diamant ";
							}
							else
							{
								$menuItems[$item->ID] = "Coach - Diamond";
							}
						}
						if($item->ID == 1365)
						{
							if (strpos($current_url, 'spanish') !== false)
							{
								$menuItems[$item->ID] = "1 - 4 Estrellas de Diamante ";
							}
							else if (strpos($current_url, 'french') !== false)
							{
								$menuItems[$item->ID] = "1 - 4 étoiles Diamant ";
							}
							else
							{
								$menuItems[$item->ID] = "1 - 4 Star Diamond ";
							}
						}
						if($item->ID == 492)
						{
							if (strpos($current_url, 'spanish') !== false)
							{
								$menuItems[$item->ID] = "5 Estrellas de Diamante y superior";
							}
							else if (strpos($current_url, 'french') !== false)
							{
								$menuItems[$item->ID] = "5 étoiles Diamant et au-dessus ";
							}
							else
							{
								$menuItems[$item->ID] = "5 Star Diamond and Above";
							}
						}
						
					}
				}
					return $menuItems;	
		}
		
		
		
		
        // Select box
        if (!($items = $this->fieldMetaData->named_values)) {
        //echo "33333333333333333333";
            if($this->fieldName === 'StateOrProvince'){
                //CPHP doesn't appear to have a way to get all of the state/province values
                //given it's parent country (e.g. the getNamedValues function will return all
                //possible state/province values, not just ones off the selected country). Therefore
                //we need to get the country value so we can get the trimmed down list.
                if($this->data['value'] !== null){
                    list($countryValue) = Connect::getObjectField(array('Contact', 'Address', 'Country', 'ID'));
                    // If the value was sent in POST data, use that. Otherwise, use the value from Connect. If neither of those exist look for a URL param.
                    $countryValue = $this->CI->input->post('Contact_Address_Country') ?: $countryValue ?: \RightNow\Utils\Url::getParameter('Contact.Address.Country');
                    if($countryValue && ($stateProvinceList = $this->CI->model('Country')->get($countryValue)->result)){
                        $items = $stateProvinceList->Provinces;
                    }
                }
            }
            else if($this->fieldName === 'Country'){
            	//echo "67676767";
                // meta data isn't populated for Country
                $items = array();
                $countryItems = $this->CI->model('Country')->getAll()->result;
                // we want the full names and not the ISO codes for countries
                foreach ($countryItems as $countryItem)
                    $items[] = (object)array('ID' => $countryItem->ID, 'LookupName' => $countryItem->Name);
            }
            else if($this->fieldName === 'SLAInstance'){
            	//echo "345673653";
                //Populate the SLA instances from the Contact record
                $contact = $this->CI->model('Contact')->get()->result;
                //The contact can either have their own SLAs or their org can, but not both
                $contactSlas = ($contact->Organization && $contact->Organization->ID) ? $contact->Organization->ServiceSettings->SLAInstances : $contact->ServiceSettings->SLAInstances;
                $items = array();
                if(Connect::isArray($contactSlas)){
                    foreach($contactSlas as $slaInstance){
                        if($this->isValidSla($slaInstance)){
                            $items[] = $slaInstance->NameOfSLA;
                        }
                    }
                }
            }
            else if($this->table === 'Asset' && $this->fieldName === 'Status'){
            	//echo "4444444444444444";
                $items = $this->CI->model('Asset')->getAssetStatuses()->result;
            }
            else if($this->table === 'Incident' && $this->fieldName === 'Asset'){
            //echo "5555555555555555";
                $items = $this->CI->model('Asset')->getAssets()->result;
            }
            else{
            	//echo "66666666666666666666";

                // meta data isn't populated w/ named values for certain fields
                $field = explode('.', $this->data['inputName']);
                $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
            }
        }
        if($items){
        	//echo "0000000000000000";
            foreach ($items as $item) {
                $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
            }
        }
        return $menuItems;
    }
	
	

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}