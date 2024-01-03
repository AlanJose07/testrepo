<?php

namespace Custom\Controllers;
use RightNow\Connect\v1_2 as RNCPHP;
class AjaxCustomKeyword extends \RightNow\Controllers\Base
{
    function __construct()
    {
        parent::__construct();
    }
    function set_feedback()
	{			
		 $CI = &get_instance(); 		
		 $message = $this->input->post('message');		 
		 $contactID = $CI->session->getProfileData('c_id');
		 $key =  $this->input->post('keyword');

		 if($message != null && $contactID!= null && $key!= null  ){
			$results = $this->model('custom/CustomModel')->setFeedback($contactID, $message,$key);
			print_r($results);

		 }

		 else
		 {

			echo "Can't submmit please give the feedback" ;


		 }
	}	
}
