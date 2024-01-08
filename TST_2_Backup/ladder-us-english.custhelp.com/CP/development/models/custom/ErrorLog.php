<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_2 as RNCPHP;
class ErrorLog extends \RightNow\Models\Base {
    function __construct() {
		
        parent::__construct();
    }
	
	
	function login_error_log($remarks)		
	{
	$error_log = new RNCPHP\ORN_NiceLog\Nice_Error_Log();
	$error_log->ReportName = "Login Error";
	$error_log->Remarks = $remarks;
	$error_log->save(RNCPHP\RNObject::SuppressAll);
	}
	
}