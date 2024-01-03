<?php
namespace Custom\Widgets\input;
class Getlogin extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
	 $CI = get_instance();
    $CI->load->model('standard/Contact_model');
    $contactID=$CI->session->getProfileData('c_id');
		
    }

    function getData() {

        return parent::getData();

    }
}