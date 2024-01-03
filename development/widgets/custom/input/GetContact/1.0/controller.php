<?php
namespace Custom\Widgets\input;

class GetContact extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
		$email=$_POST['Contact_Emails_PRIMARY_Address'];
		$CI = get_instance();
		$CI->session->setSessionData(array('email' => $email));
		
		
		
    }

    function getData() {

        return parent::getData();

    }
}