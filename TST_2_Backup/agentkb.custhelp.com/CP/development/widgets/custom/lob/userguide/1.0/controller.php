<?php
namespace Custom\Widgets\lob;

class userguide extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

         parent::getData();
		 $a_id[] = getUrlParm(a_id);
		 $this->CI->load->model('custom/complaint_model');   
	     $yes_no_decisionanswer = $this->CI->complaint_model->userguideanswer($a_id,2);
		 if(in_array("1", $yes_no_decisionanswer)){
		 header("Location: https://agentkb.custhelp.com/app/answers/detail_guide/a_id/".$a_id[0]); 
		 } 

    }
}