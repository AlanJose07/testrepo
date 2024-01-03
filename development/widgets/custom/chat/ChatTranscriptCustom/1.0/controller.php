<?php
namespace Custom\Widgets\chat;

class ChatTranscriptCustom extends \RightNow\Widgets\ChatTranscript {
    function __construct($attrs){
        parent::__construct($attrs);
    }

    function getData(){
        $CI = get_instance();
        $sessionExpire = $CI->session->getSessionData("USER_SESSION_COOKIE_EXIPIRE");
        $this->data['js']['sessionExpire'] = $sessionExpire; 
        return parent::getData();
    }
}
?>