<?php

namespace Custom\Controllers;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
use RightNow\Connect\v1_2 as RNCPHP;

class AjaxCustom1 extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }
	
	function getFlavour() 
	{
		$id = $this->input->post('country_id'); 
	    $results = $this->model('custom/CustomOrder')->getFlavour($id); 
		echo json_encode($results);
	}
	
	function getCurrentFlavour() 
	{
		$id = $this->input->post('country_id'); 
	    $results = $this->model('custom/CustomOrder')->getCurrentFlavour($id); 
		echo json_encode($results);
	}

}

