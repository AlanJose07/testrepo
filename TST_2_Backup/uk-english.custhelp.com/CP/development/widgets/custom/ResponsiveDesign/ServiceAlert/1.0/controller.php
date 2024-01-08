<?php
namespace Custom\Widgets\ResponsiveDesign;


use RightNow\Utils\Config as Message;


class ServiceAlert extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		$CI = get_instance();
		
			$this->data['Message'] = Message::getMessage(CUSTOM_MSG_SERVICE_ALERT);
        return parent::getData();

    }
}