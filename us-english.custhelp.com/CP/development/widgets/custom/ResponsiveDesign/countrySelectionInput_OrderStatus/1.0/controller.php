<?php
namespace Custom\Widgets\ResponsiveDesign;

class countrySelectionInput_OrderStatus extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

       if (parent::getData() === false) return false; 
           
      
       
      // if(!Connect::isCustomField($this->fieldMetaData)) {
            
			 if($this->fieldName === 'Country') {
			
			
			   $this->data['menuItems'] = $this->getMenuItems();
			  
			
                
                $this->data['hideEmptyOption'] = true;
                $this->data['displayType'] = 'Select';
            }
			
			
			
       // }

        if($this->dataType === 'Boolean') {
            if($this->data['attrs']['display_as_checkbox']) {
                $this->data['displayType'] = 'Checkbox';
                $this->data['constraints']['isCheckbox'] = true;
            }
            else {
                $this->data['displayType'] = 'Radio';
                $this->classList->add('rn_Radio');
            }
            $this->data['radioLabel'] = array(\RightNow\Utils\Config::getMessage(NO_LBL), \RightNow\Utils\Config::getMessage(YES_LBL));
            //find the index of the checked value
            if(in_array($this->data['value'], array(true, 'true', '1'), true))
                $this->data['checkedIndex'] = 1;
            else if(in_array($this->data['value'], array(false, 'false', '0'), true))
                $this->data['checkedIndex'] = 0;
            else
                $this->data['checkedIndex'] = -1;
        }
       
       /* $this->data['showAriaHint'] = $this->CI->clientLoader->getCanUseAria() && $this->data['js']['hint'];*/
    

    }
	
	
	protected function getMenuItems()
	 {
	

	   $menuItems = array();
	    
	 
	   $tempItems = array();
	   $hideItems = array();
	   if($this->fieldName === 'Country'){
	   
	   
                // meta data isn't populated for Country
                $items = array();
                $countryItems = $this->CI->model('Country')->getAll()->result;
                // we want the full names and not the ISO codes for countries
                foreach ($countryItems as $countryItem)
                    $items[] = (object)array('ID' => $countryItem->ID, 'LookupName' => $countryItem->Name);
            }
			  if($items){
			  
			  $i=0;
                    foreach ($items as $item) {
					
                       //$tempItems[$item->ID] = $item->LookupName ?: $item->Name;
				
				
				               if($item->ID== 1 || $item->ID ==  2 || $item->ID ==  7)
				                   {
								         $menuItems[$i]=$tempItems[$item->ID];
		                                   $i++;
										  
				                   }
							
                                 }
                               }
							   //$menuItems=array("0"=>"--","1"=>"US","2"=>"Canada","7"=>"UK");
							   $menuItems=array("1"=>"US","2"=>"Canada","7"=>"UK");
			
			return $menuItems;
	 
		
	  }
	 
	 
		 
		 
}

	
    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
//}