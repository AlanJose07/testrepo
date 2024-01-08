<?php
namespace Custom\Widgets\chat;

class ChatHoursCustom extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData()
	 {
			$this->data['chatHours'] = $this->CI->model('Chat')->getChatHours()->result;
         	$this->data['show_hours'] = !$this->data['chatHours']['inWorkHours'];
	}
	 }