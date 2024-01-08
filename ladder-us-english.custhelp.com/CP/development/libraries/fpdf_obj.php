<?php
namespace Custom\Libraries;

$CI = get_instance();
$CI->load->library('fpdf_ds');


define('FPDF_VERSION','1.81');

class fpdf_obj
{
	function fpdf_obj_create()
	{
		$fpdfObj =new fpdf_ds;
		return $fpdfObj;
	}
}
?>