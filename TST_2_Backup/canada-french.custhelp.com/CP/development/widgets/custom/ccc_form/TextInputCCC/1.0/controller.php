<?php
namespace Custom\Widgets\ccc_form;

class TextInputCCC extends \RightNow\Widgets\TextInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
		$this->data['js']['isloggedin'] = "loggedout";
		if (\RightNow\Utils\Framework::isLoggedIn())
		{
		$this->data['js']['isloggedin']= "loggedin";
		}

    }

    /**
     * Overridable methods from TextInput:
     */
    // public function outputConstraints()
    // protected function determineDisplayType($fieldName, $dataType, $constraints)
}