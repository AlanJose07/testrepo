<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;
$CI = get_instance();

$CI->model('Incident');
//$CI->load->library('fpdf_obj');
//require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php");
//$ip_dbreq = true;

class CustomTest extends \RightNow\Models\Base
{
 
   
   function __construct()
    {
        parent::__construct();
    }

    function sampleFunction()
    { 
      echo "Hello";
    }
	
	
	
}
