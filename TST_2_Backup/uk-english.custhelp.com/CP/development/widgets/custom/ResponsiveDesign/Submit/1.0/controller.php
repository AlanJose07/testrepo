<?php
namespace Custom\Widgets\ResponsiveDesign;

class Submit extends \RightNow\Widgets\FormSubmit {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		$chat_platform = \RightNow\Utils\Config::getConfig(1000065); //CUSTOM_CFG_CHAT_PLATFORM 
   		$chat_platform = trim($chat_platform);
		if($chat_platform == 'Oracle' || $chat_platform == 'oracle' || $chat_platform == 'ORACLE'){
			$flag = 1;
		}elseif($chat_platform == 'Nice' || $chat_platform == 'nice' || $chat_platform == 'NICE'){
			$flag = 2;
		 }else{
			$flag = 3;
		}
		$this->data['js']['chat_platform']=$flag;


    }
}