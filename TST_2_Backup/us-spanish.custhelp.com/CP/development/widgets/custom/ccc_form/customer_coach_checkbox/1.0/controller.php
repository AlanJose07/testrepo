<?php
namespace Custom\Widgets\ccc_form;

class customer_coach_checkbox extends \RightNow\Widgets\TextInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }

    /**
     * Overridable methods from TextInput:
     */
    // public function outputConstraints()
    // public function existingContactCheck($constraints)
    // protected function determineDisplayType($fieldName, $dataType, $constraints)
}