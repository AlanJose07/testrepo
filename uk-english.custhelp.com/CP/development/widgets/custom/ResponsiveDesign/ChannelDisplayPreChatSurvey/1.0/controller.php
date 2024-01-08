<?php
namespace Custom\Widgets\ResponsiveDesign;

class ChannelDisplayPreChatSurvey extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
		$cat_id=trim(getUrlParm('catid'));
		
		if (!empty($cat_id))
		{
			$bblivecategory = $this->CI->model('custom/bbresponsive')->bblivecategory($cat_id);
			
				if($bblivecategory == 2)
				{
					$this->data['js']['bblive']= 2;
				}
				else
				{
					$this->data['js']['bblive']= 1;
				}
		}

    }
}