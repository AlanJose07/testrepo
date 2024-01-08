<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Config as Message;


class ServiceAlert_Method extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		$CI = get_instance();
		var_dump($CI->session->getSessionData('service_alert_session'));
		if(!$CI->session->getSessionData('service_alert_session'))
		{
			
			//die("----------123");
			$CI->session->setSessionData(array('service_alert_session' => 1));
			$this->data['Message'] = Message::getMessage(CUSTOM_MSG_SERVICE_ALERT_US);//"Android BOD Users: A small number of App users are getting the error 1002. We know about the issue and are actively working on a fix. In the meantime, please stream via web browser on your phone or computer";
		}
		else
		{
			//echo("123");
			/*if($CI->session->getSessionData('service_alert_session') == 2)
			{
				$this->data['Message'] = "";
			}
			else
			{*/
				$this->data['Message'] = Message::getMessage(CUSTOM_MSG_SERVICE_ALERT_US);
			/*}*/
		}
		//var_dump($this->data['Message']);
		
		
        return parent::getData();

    }
}