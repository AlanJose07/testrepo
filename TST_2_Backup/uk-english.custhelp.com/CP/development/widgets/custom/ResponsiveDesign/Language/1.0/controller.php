<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Connect,
RightNow\Connect\v1_2 as RNCPHP,
RightNow\Connect\v1_2\CO as RNCPHP_CO,
RightNow\Utils\Config;

class Language extends \RightNow\Widgets\SelectionInput {
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
	    
		$interface = $this->data['attrs']['interface'];
		
	 
	   if($this->fieldName === 'language_shk')
		{
		       
		        
				$field = explode('.', $this->data['inputName']);
				$object = array_shift($field);
				$items = Connect::getNamedValues($object, implode('.', $field));
				  
				if($items)
				{
						$count = count($items);
						
						foreach ($items as $item)
						{
						       
								if($item->ID != 1183 and $interface==1)//US interface
								{
									$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								else if($item->ID != 1184 and $interface==2)//CANADA interface
								{
								    $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								else if($item->ID != 1183 and $item->ID != 1184 and $interface==3)//UK interface
								{
								    $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
								}
								
						}
				}
				return $menuItems;	   
		}
	 }
    // protected function isValidSla($slaInstance)
}