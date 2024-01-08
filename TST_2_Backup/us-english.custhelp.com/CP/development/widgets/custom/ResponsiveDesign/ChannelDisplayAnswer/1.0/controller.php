<?php
namespace Custom\Widgets\ResponsiveDesign;

class ChannelDisplayAnswer extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
if(!empty(getUrlParm('catname')))
		{
			$this->data['category_name']=str_replace("-"," ",str_replace("_","/",trim(getUrlParm('catname'))));
		}
		
		if (!empty(trim(getUrlParm('a_id'))))
		{
		   $answer_list_id=getUrlParm('a_id');
		   $answer_details = $this->CI->model('custom/bbresponsive')->get_answer_details($answer_list_id);
		   $this->data['answer_details']=$answer_details;
		   $this->data['js']['answer_details_count']=count($answer_details);
		   
		}

    }
}