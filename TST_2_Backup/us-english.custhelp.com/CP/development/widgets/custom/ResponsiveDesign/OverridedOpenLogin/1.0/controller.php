<?php
namespace Custom\Widgets\ResponsiveDesign;

class OverridedOpenLogin extends \RightNow\Widgets\OpenLogin {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		$reurl = trim(str_replace("/app/","",$_SERVER['REQUEST_URI']));
		if(empty($_SERVER['REQUEST_URI']))
			$reurl = 'home';
		if($reurl == 'errorpage')
			$reurl = 'home';	
		$this->data['attrs']['controller_endpoint'] = '/cc/Openlogin/oauth/authorize/beachbody?returnurl='.$reurl;
        return parent::getData();

    }

    /**
     * Overridable methods from OpenLogin:
     */
    // protected function verifyOAuthConfigs()
    // protected function verifyOpenIDUrl()
}