<?php
namespace Custom\Widgets\input;  

class SelectionInputRadioButton extends \RightNow\Widgets\SelectionInput {
     function __construct($attrs) {
        parent::__construct($attrs);
		
		 //$this->data['radioitems_count'] = count($this->data['menuItems']);
    }
	

    function getData() {

        parent::getData();
		 $this->data['displayType']='Radio';
	  $i=0;
	  foreach ($this->data['menuItems'] as $value)
	  {
	 
	   $this->data['radioLabel'][$i] = $value;
	   
	   $i++;
	  }
	  $this->data['radioitems_count'] = count($this->data['menuItems']);
	 $this->data['js']['radioitems_count'] = count($this->data['menuItems']);

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}