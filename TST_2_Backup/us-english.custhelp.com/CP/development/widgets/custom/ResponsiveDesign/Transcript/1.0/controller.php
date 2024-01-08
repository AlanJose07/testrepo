<?php
namespace Custom\Widgets\ResponsiveDesign;

class Transcript extends \RightNow\Widgets\ChatTranscript {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        $question_thread = $_POST['Incident_Threads'];
		if(empty($question_thread))
		$question_thread = "Blank chat";
		$this->data['js']['question_thread']=$question_thread;
		
		return parent::getData();

    }
}