<?php
namespace Custom\Widgets\input;

use RightNow\Utils\Connect,
    RightNow\Utils\Config;


class SelectGDPR extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)

    /**
     * Populate the list of options in the select box. Attempts to get the list from the metadata
     * if available and if not, falls back to getting the named ID list from Connect. Also handles
     * the special case of filtering StateOrProvince values based on what Country has been selected
     */
    protected function getMenuItems(){
        $menuItems = array();
		if($this->fieldName === 'member_type_new')
		 {
                $field = explode('.', $this->data['inputName']);
                $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
				/*To hide certification customer in member type custom field*/	
				if($items)
				{
					$count = count($items);
					foreach ($items as $item)
					{
						if(($item->ID != 390)&&($item->ID != 398)&&($item->ID != 1725))
						{
							$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
						}
					}
				}
					return $menuItems;	
		  
		  }
		  
		  //added for country dropdown starts
		  if($this->fieldName === 'Country')
		 {
                $field = explode('.', $this->data['inputName']);
                $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
				/*To hide certification customer in member type custom field*/	
				if($items)
				{
					$count = count($items);
					foreach ($items as $item)
					{
						if(($item->ID == 1)||($item->ID == 2)||($item->ID == 7))
						{
							//$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
							$menuItems[$item->ID] =  $item->Name;

						}
					}
				}
					return $menuItems;	
		  
		  }

		  
		  //added for country dropdown ends
        // Select box
        if (!($items = $this->fieldMetaData->named_values)) {
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
                // meta data isn't populated for Country
                $items = array();
                $countryItems = $this->CI->model('Country')->getAll()->result;
                // we want the full names and not the ISO codes for countries
                foreach ($countryItems as $countryItem)
                    $items[] = (object)array('ID' => $countryItem->ID, 'LookupName' => $countryItem->Name);
            }
            else if($this->fieldName === 'SLAInstance'){
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
                $items = $this->CI->model('Asset')->getAssetStatuses()->result;
            }
            else if($this->table === 'Incident' && $this->fieldName === 'Asset'){
                $items = $this->CI->model('Asset')->getAssets()->result;
            }
            else{
                // meta data isn't populated w/ named values for certain fields
                $field = explode('.', $this->data['inputName']);
                $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
            }
        }
        if($items){
            foreach ($items as $item) {
			
				if($item->ID == 1505)
				$menuItems[$item->ID] = 'Right of Access/Portability / Right to Know';
				else
                $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
            }
        }
        return $menuItems;
    }
}