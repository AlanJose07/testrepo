<?php /* Originating Release: May 2013 */

namespace Custom\Widgets\input;

use RightNow\Utils\Connect,
    RightNow\Utils\Config;

class SelectionInputCO extends \RightNow\Libraries\Widget\Input {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        //if (parent::getData() === false) return false;
		$validAttributes = explode('.',$this->data['attrs']['name']);
		$cacheKey = 'Input_' . $this->data['attrs']['name'];
        $cacheResults = checkCache($cacheKey);
        if(is_array($cacheResults))
		{
            list($this->field, $this->table, $this->fieldName, $this->data) = $cacheResults;
			$this->field = unserialize($this->field);

            return;
		}
       $this->table = $validAttributes[0];
       $this->fieldName = $validAttributes[1];
	   $this->CI->load->model('custom/generic_model');
	   $this->data['field'] = $this->CI->generic_model->getBusinessObjectField( $this->table,$this->fieldName );
	   $this->dataType = $this->data['field']->data_type;
	
	  	$this->dataType = $this->data['field']->data_type;
	    $this->data['js']['type'] = $this->data['field']->data_type;

        $this->data['js']['table'] = $this->table;
        $this->data['js']['name'] = $this->fieldName;
		$this->data['constraints'] = array();
		$this->data['js']['constraints'] = $this->data['constraints'];	
	   if($this->data['field']->data_type === "String")
		 $this->data['inputType']="text";
		 
		 if($this->data['field']->value)
		{
		$this->data['value'] = $this->data['field']->value;
		$this->data['attrs']['default_value']=$this->data['field']->value;
		}
		else
		{
		$this->data['value'] = $this->data['field']->default_value;
		}
		
        $this->data['checkreadonly'] = false;
       if($this->data['field']->readonly==1)
        {
		 
             $this->data['checkreadonly'] = true;
        }

        if(!in_array($this->dataType, array('Boolean', 'Country', 'NamedIDLabel', 'NamedIDOptList', 'AssignedSLAInstance'))) {
            echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(PCT_S_MENU_YES_SLASH_FIELD_MSG), $this->fieldName));
            return false;
        }
        if($this->fieldName === 'SLAInstance' && !\RightNow\Utils\Framework::isLoggedIn()){
            return false;
        }
     /*   if(!Connect::isCustomField($this->fieldMetaData)) {
            //standard field
            if($this->fieldName === 'Status' && !\RightNow\Utils\Url::getParameter('i_id')) {
                //Status field shouldn't be shown if there is not an incident ID on the page
                echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(PCT_S_FLD_DISPLAYED_PG_I_ID_PARAM_MSG), $this->data['attrs']['name']));
                return false;
            }
            if($this->fieldName === 'Status') {
                $this->data['menuItems'] = array(\RightNow\Utils\Config::getMessage(YES_PLEASE_RESPOND_TO_MY_QUESTION_MSG), \RightNow\Utils\Config::getMessage(I_DONT_QUESTION_ANSWERED_LBL));
                $this->data['hideEmptyOption'] = true;
                $this->data['displayType'] = 'Select';
            }
        }*/
		if($this->data['attrs']['require_validation']) {
            $this->data['constraints']['requireValidation'] = true;
        }

        if($this->dataType === 'Boolean') {
            if($this->data['attrs']['display_as_checkbox']) {
                $this->data['displayType'] = 'Checkbox';
                $this->data['constraints']['isCheckbox'] = true;
            }
            else {
                $this->data['displayType'] = 'Radio';
				 $this->data['constraints']['isCheckbox'] = false;
                $this->classList->add('rn_Radio');
            }
            //$this->data['radioLabel'] = array(\RightNow\Utils\Config::getMessage(NO_LBL), \RightNow\Utils\Config::getMessage(YES_LBL));
			$this->data['radioLabel'] = array("N/A", \RightNow\Utils\Config::getMessage(NO_LBL), \RightNow\Utils\Config::getMessage(YES_LBL));
			if($this->fieldName === 'cf_duration_symptoms')
			{
			$this->data['radioLabel'] = array("N/A", ">12 Hrs", "<12 Hrs");
			}
			if($this->fieldName === 'cf_cust_product' || $this->fieldName === 'cf_send_return_label' || $this->fieldName === 'cf_comp_request' || $this->fieldName === 'cf_photo_evidence'|| $this->fieldName === 'cf_injury_compensation'){
				$this->data['radioLabel'] = array("N/A", \RightNow\Utils\Config::getMessage(NO_LBL), \RightNow\Utils\Config::getMessage(YES_LBL));
			}
            //find the index of the checked value
            if(in_array($this->data['value'], array(true, 'true', '1'), true))
                $this->data['checkedIndex'] = 1;
            else if(in_array($this->data['value'], array(false, 'false', '0'), true))
                $this->data['checkedIndex'] = 0;
            else
                $this->data['checkedIndex'] = -1;
        }
        else if (!$this->data['menuItems']) {
            $this->data['displayType'] = 'Select';
            $this->data['menuItems'] = $this->getMenuItems();
        }
        
    /*//Framework commented//    $this->data['showAriaHint'] = $this->CI->clientLoader->getCanUseAria() && $this->data['js']['hint'];*/
    }

    /**
    * Used by the view to output an option's selected attribute.
    * @param $key Int key of the item
    * @return Mixed String selected string or null
    */
    public function outputSelected($key) {
        if ($key == $this->data['value']) {
            return 'selected="selected"';
        }
    }

    /**
    * Used by the view to output a checkbox / radio input's checked attribute.
    * @param $currentIndex Int Index of the loop
    * @return
    */
    public function outputChecked($currentIndex) {
        if ($this->data['checkedIndex'] === $currentIndex) {
            return 'checked="checked"';
        }
    }

    /**
     * Populate the list of options in the select box. Attempts to get the list from the metadata
     * if available and if not, falls back to getting the named ID list from Connect. Also handles
     * the special case of filtering StateOrProvince values based on what Country has been selected
     */
    protected function getMenuItems(){
        $menuItems = array();
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
            else{
                // meta data isn't populated w/ named values for certain fields
                echo "welcome";
                $field = explode('.', $this->data['inputName']);
                $object = array_shift($field);
                $items = Connect::getNamedValues($object, implode('.', $field));
            }
        }
        if($items){
            foreach ($items as $item) {
                $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
            }
        }
        return $menuItems;
    }

    /**
     * Determines if the passed in SLA instance is valid. Checks if the SLA is active, within
     * supported dates, and has remaining web incidents left.
     * @param object $slaInstance Instance of SLA to check
     * @return bool True if the SLA instance is valid; False if it is not.
     */
    protected function isValidSla($slaInstance){
        $currentTime = time();
        return ($slaInstance->StateOfSLA->ID === SLAI_ACTIVE &&
                $slaInstance->ActiveDate <= $currentTime &&
               ($slaInstance->ExpireDate === null || $slaInstance->ExpireDate > $currentTime) &&
               ($slaInstance->RemainingFromWeb === null || $slaInstance->RemainingFromWeb > 0) &&
               ($slaInstance->RemainingTotal === null || $slaInstance->RemainingTotal > 0));
    }
}
