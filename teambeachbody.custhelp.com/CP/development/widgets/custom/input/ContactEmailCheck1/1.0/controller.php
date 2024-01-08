<?php
namespace Custom\Widgets\input;

class ContactEmailCheck1 extends \RightNow\Widgets\TextInput {
    function __construct($attrs) {

        parent::__construct($attrs);
		
		// Anuj Feb 20, 2014 - CP3 Migration - widget ajax handler mapping
		$this->setAjaxHandlers(array(
			'existing_contact_check_ajax' => 'checkForExistingContact'
		));
    }

    function getData() {

		// Anuj Feb 20, 2014 - CP3 Migration - this widget will ALWAYS be required
		$this->data['attrs']['required'] = true;
		
        return parent::getData();

    }
	
	/**
	 * Anuj Feb 18, 2014 - CP3 Migration
	 * Check for existing contact against email and return first-last name or false depending upon the result
	 */
	function checkForExistingContact($postData) {
	
		// Copied from pre-migration version of code
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

		$email = $postData['email'];
		$show_first_last_name = $postData['show_first_last_name'];
	   	// check if email exists, then get the contact fields
		$results = $this->CI->model('Contact')->lookupContactByEmail($email);
		
		// Our data comes enclosed in a ResponseObject instance, fetch the value from 'result' private member variable
		$result = $results->result;
		
        if($result){
		
			// Return first and last name only when we want to show it on the page, otherwise just return true
			if($show_first_last_name && $show_first_last_name != "false") {
				$c_id = intval($result);	//Get the integer value of contact ID
				$contact = $this->CI->model('Contact')->get($c_id);
	
				// Connect Contact record is enclosed in ResponseObject instance's 'result' member variable
				$return['first_name'] =  $contact->result->Name->First;
				$return['last_name'] =  $contact->result->Name->Last;
			}
			else {
				$return = true;
			}
			echo json_encode($return);
		}
		else{

			echo json_encode($result);
		}
	}

    /**
     * Overridable methods from TextInput:
     */
    // public function outputConstraints()
    // protected function determineDisplayType($fieldName, $dataType, $constraints)
}