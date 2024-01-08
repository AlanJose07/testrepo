<?php
namespace Custom\Widgets\input;

class SelectionInputCountry_CCF extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

         parent::getData();
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
			    if($item->ID=="1" || $item->ID=="2")
					$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
                 }
              }
			  
			  return $menuItems;
	 }
    // protected function isValidSla($slaInstance)
}