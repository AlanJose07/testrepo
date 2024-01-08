<?php
namespace Custom\Widgets\input;

class AnswerFeedback extends \RightNow\Widgets\AnswerFeedback {
    function __construct($attrs) {
		
        parent::__construct($attrs);
    }

    function getData() {
		$this->getReasons();	
        return parent::getData();
		
	

    }

	 protected function getReasons() {
	 	
	 	$all_reasons=$this->CI->model('custom/answer_feedback')->getAllReasons();
		/*foreach($all_reasons as $items) 
		{
		
				print_r($items->LookupName);
		}*/
		$this->data['allReasons'] = $all_reasons;
	 
	 }
    /**
     * Overridable methods from AnswerFeedback:
     */
    // protected function getRateLabels()
}