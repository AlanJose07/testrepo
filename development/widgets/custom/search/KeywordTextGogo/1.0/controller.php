<?php
namespace Custom\Widgets\search;

class KeywordTextGogo extends \RightNow\Widgets\KeywordText {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() 
	{
    $CI = get_instance();
	$clang= $CI->session->getSessionData('clang');
	$all_param= $CI->session->getSessionData('urlParameters');
	$all_parameters= array();
	foreach($all_param as $array) {
 	foreach($array as $k=>$v) {
    $all_parameters[$k][] = $v;
 	   }
	   }
	  
	if(array_key_exists('tailNumber', $all_parameters))
	{
		if(is_array($all_parameters['tailNumber']))
		{
			$tailNumber = end($all_parameters['tailNumber']);
		}
		else
		{
		$tailNumber = $all_parameters['tailNumber'];
		}
	}
	
	//Storing first three parameters of flight number
	
	$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
	$flgtNo=$res_aline[0];
	$this->data['clang'] = $clang;
    $this->data['flgtNo'] = $flgtNo;
	$this->data['ge']=getUrlParm('ge');
	$this->data['ko']=getUrlParm('ko');

        return parent::getData();

    }
}