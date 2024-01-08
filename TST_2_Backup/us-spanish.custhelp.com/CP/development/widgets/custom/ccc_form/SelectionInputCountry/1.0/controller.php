<?php
namespace Custom\Widgets\ccc_form;

class SelectionInputCountry extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

         parent::getData();
		  
		//$this->data['value'] = ""; 
		//echo "<pre>"; 
		//print_r($this->data);
    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
     protected function getMenuItems()
	 {
	            if($this->fieldName === 'Country'){
                $items = array();
                $countryItems = $this->CI->model('Country')->getAll()->result;
                foreach ($countryItems as $countryItem)
                    $items[] = (object)array('ID' => $countryItem->ID, 'LookupName' => $countryItem->Name);
            }
			
			   if($items){
			   $menuItems = array();
               foreach ($items as $item) {
			  // if($item->ID=="1" || $item->ID=="2")//for 16th go live Cust coach change uk hided
			   if($item->ID=="1" || $item->ID=="2" || $item->ID=="7" || $item->ID=="23")
                $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
                 }
              }
			  
			  return $menuItems;
	 }
    // protected function isValidSla($slaInstance)
}