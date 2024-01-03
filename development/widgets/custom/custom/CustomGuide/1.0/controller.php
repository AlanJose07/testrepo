<?php

namespace Custom\Widgets\custom;
use RightNow\Utils\Url;
class CustomGuide extends \RightNow\Widgets\GuidedAssistant {

    function __construct($attrs) {
        parent::__construct($attrs);
    }

    /*function getData() {
		$tail=getUrlParm('tail');
		$this->data['attrs']['tail']=$tail;
		$CI = get_instance();
		$c_id = $CI->session->getProfile()->c_id->value;
	    $this->data['attrs']['cid']=$c_id;
		return parent::getData();

    }
	*/
	function getData() {
	$guide='';
        if ($this->data['attrs']['static_guide_id']) {
            $guideID = $this->data['attrs']['static_guide_id'];
        }
        else if ($guideID = Url::getParameter('g_id')) {
            $guideID = intval($guideID);
        }
        else if (($answerID = Url::getParameter('a_id')) && ($answer = $this->CI->model('Answer')->get($answerID)->result)) {
            $guideID = $answer->GuidedAssistance ? $answer->GuidedAssistance->ID : null;
        }

        if($guideID) {
            if($this->data['attrs']['popup_window_url']) {
                $this->data['attrs']['popup_window_url'] = \RightNow\Utils\Url::addParameter($this->data['attrs']['popup_window_url'], 'g_id', $guideID);
                return;
            }
            $langID = Url::getParameter('lang');
			$CI = get_instance();
			$guidedAssistant = $this->CI->model('Guidedassistance')->get($guideID, $langID)->result;
			$guide=$guidedAssistant->name;
			
           }
	    $this->data['attrs']['guide']=$guide;
		$CI = get_instance();
 		$this->data['attrs']['ses']=$this->CI->session->getSessionData('sessionID');
        $tail=getUrlParm('tail');
		$this->data['attrs']['tail']=$tail;
		$c_id = $CI->session->getProfile()->c_id->value;
	    $this->data['attrs']['cid']=$c_id;
		return parent::getData();
    }

    /**
     * Overridable methods from GuidedAssistant:
     */
    // function getGuideAsArray($params)
    // protected function processAgentMode()
}