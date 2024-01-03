<?php
namespace Custom\Widgets\chat;

class CustomChatDisconnectButton extends \RightNow\Widgets\ChatDisconnectButton {
    function __construct($attrs) {
        parent::__construct($attrs);
        
    }

    function getData() {
        $CI = get_instance();
        $sessionExpireFlag1 = $CI->session->getSessionData("USER_SESSION_COOKIE_EXIPIRE");
        $this->data['js']['sessionExpireFlag1']  =   $sessionExpireFlag1;
        return parent::getData();

    }
}