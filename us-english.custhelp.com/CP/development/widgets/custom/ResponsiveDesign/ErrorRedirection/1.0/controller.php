<?php
namespace Custom\Widgets\ResponsiveDesign;
class ErrorRedirection extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }
    function getData() {
		   // return parent::getData();
			$actual_link = $_SERVER['REQUEST_URI'];
			$text = str_replace('/app/contactus_support/', ' ', $actual_link);
			$text = trim($text);
			$split = explode('/', rtrim($actual_link, '/'));
			$contactus_support=$split[2];
         
			 $cateory_id = getUrlParm('catid');
			 //checking cat ID is integer or not
		     if ((!is_numeric($cateory_id)) && ($contactus_support == "contactus_support" || $contactus_support == "gethelp" || $contactus_support == "contactus_sub_level" || $contactus_support == "answersdetaila_idcatidcatnmeTLP"))
			{
				$url = "/app/pagenotfound";
				 header('Location: ' . $url);
			}
		}
}