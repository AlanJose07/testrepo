<?php
namespace Custom\Widgets\input;

class ShippingDateSelectionInput_Cust extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

          //return parent::getData();
		
		$this->field->data_type = EUF_DT_SELECT;


        $this->data['attrs']['name'] = strtolower($this->data['attrs']['name']);

        $validAttributes = explode(".",$this->data['attrs']['name']);
		
		
        /*  if(!is_array($validAttributes))
        {
            echo $this->reportError($validAttributes);
            return false;
        }*/
        $this->table = $validAttributes[0];
        $this->fieldName = $validAttributes[1];
		
		$this->data['inputName'] = $validAttributes[1];
        

        $this->data['js']['type'] = $this->field->data_type;
        $this->data['js']['table'] = $this->table;
        $this->data['js']['name'] = $this->fieldName;
		$this->data['js']['constraints'] = "";

        $this->data['menuItems'] = array(
            0 => "No changes",
            1 => "Change Shipping Date",
        );

        $this->data['hideEmptyOption'] = true;
		$this->data['displayType']='Select';
		
		

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}