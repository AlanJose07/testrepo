<?php
namespace Custom\Widgets\input;

class SelectionInputHidden extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

         parent::getData();
		 
		 if($this->fieldName=="flavor1")
		 {
		   $this->data['hideEmptyOption'] = true; // hide empty Option
		 }

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}