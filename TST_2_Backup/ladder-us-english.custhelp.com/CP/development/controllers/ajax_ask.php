<?php
  
namespace Custom\Controllers;

use RightNow\Utils\Framework,
    RightNow\Libraries\AbuseDetection,
    RightNow\Utils\Config,
    RightNow\Utils\Okcs;

	

class ajax_ask extends \RightNow\Controllers\Base

{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Generic form submission handler for submitting contact and incident data. Returns details about the
     * form submission, including errors, IDs of records created, or SA results if an incident is being submitted.
     */
    public function sendForm()
    {
        AbuseDetection::check($this->input->post('f_tok'));
        $data = json_decode($this->input->post('form'));
        if(!$data)
        {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            // Pad the error message with spaces so IE will actually display it instead of a misleading, but pretty, error message.
            Framework::writeContentWithLengthAndExit(json_encode(Config::getMessage(END_REQS_BODY_REQUESTS_FORMATTED_MSG)) . str_repeat("\n", 512), 'application/json');
        }
        if($listOfUpdateRecordIDs = json_decode($this->input->post('updateIDs'), true)){
            $listOfUpdateRecordIDs = array_filter($listOfUpdateRecordIDs);
        }
        $smartAssistant = $this->input->post('smrt_asst');
        if($flashMessage = $this->input->post('flash_message')){
            $this->session->setFlashData('info', $flashMessage);
        }
		echo "<pre>";
		var_dump($data);
		die("------------------------");
        $this->_echoJSON($this->model('Field')->sendForm($data, $listOfUpdateRecordIDs ?: array(), ($smartAssistant === 'true'))->toJson());
    }
}

