<?php
namespace Custom\Widgets\input;
class CustomFormInput extends \RightNow\Widgets\TextInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }
    function getData() {
        return parent::getData();
    }    /**
     * Overridable methods from TextInput:
     */    // public function outputConstraints()    // public function existingContactCheck($constraints)    // protected function determineDisplayType($fieldName, $dataType, $constraints)
}