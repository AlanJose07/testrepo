<?php

namespace Custom\Controllers;

class AjaxCustom extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }
	
	function getAltData()
	{
	
		$data = json_decode($this->input->post('passedvalues'));
		
		foreach($data->data as &$record){
	
			$record = str_replace("&lt;","<",$record);
			$record = str_replace("&gt;",">",$record);

			$url = $this->get_string_between($record[0],"<a href='", "'>" );

			$string_param = strip_tags($this->get_string_between($record[0],"'>","</a>"));
			$string_param = urlencode($string_param);
			$string_param = str_replace("+","-",$string_param);
			$string_param = strtolower($string_param);
			
			$new_url = $url."/~/".$string_param;
			$record[0] = str_replace($url, $new_url, $record[0]);
		}
		echo json_encode($data);
	}
    
    function get_string_between($string, $start, $end)
	{
        $string = " ".$string;	
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
}

