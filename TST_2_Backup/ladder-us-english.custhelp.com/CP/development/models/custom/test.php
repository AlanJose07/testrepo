<?php
namespace Custom\Models;
$CI = get_instance();
//$CI->load->library('hash');  
$CI->load->library('crypt_Hash'); 

class test extends \RightNow\Models\Base
{
    function __construct()
    {
	   
        parent::__construct();
    }
	
	function testmodel()
	{
	
	  $ci=& get_instance();
	  //$ci->load->library("hash");
	  $ci->load->library("crypt_Hash");
	  $x = $ci->crypt_hash->jithin();
	  die("-----------".$x);
	}
	
	
}