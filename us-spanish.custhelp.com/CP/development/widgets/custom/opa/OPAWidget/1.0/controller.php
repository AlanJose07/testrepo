<?php
namespace Custom\Widgets\opa;
use RightNow\Utils\Text,
    RightNow\Utils\Config,
    RightNow\ActionCapture;
class OPAWidget extends \RightNow\Libraries\Widget\Base
{
    function __construct($attrs)
    {
        parent::__construct($attrs);
    }

    function getData()
    {
		$launcherScript = Config::getConfig(COBROWSE_PREMIUM_LAUNCHER_SCRIPT);
        if(Text::isValidUrl($launcherScript))
        {
           $this->data['opaURL'] = $launcherScript;
        }
        $this->CI->load->helper('opa');

        $this->data['url'] = getOPAURL($this->CI->session->getProfile(), $this->data['attrs']['web_determinations_url'], $this->data['attrs']['policy_model'], $this->data['attrs']['locale'], $this->data['attrs']['init_id']);
    }
}