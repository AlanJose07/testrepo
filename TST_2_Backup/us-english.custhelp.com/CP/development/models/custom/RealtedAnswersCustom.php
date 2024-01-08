<?php
namespace Custom\Models;

use RightNow\Connect\v1_4 as Connect;

class RealtedAnswersCustom extends \RightNow\Models\Answer
{
    function __construct()
    {
        parent::__construct();
    }

    function sampleFunction()
    {
        /**
         * This function can be executed a few different ways depending on where it's being called:
         *
         * From a widget or another model: $this->CI->model('custom/Sample')->sampleFunction();
         *
         * From a custom controller: $this->model('custom/Sample')->sampleFunction();
         * 
         * Everywhere else: $CI = get_instance();
         *                  $CI->model('custom/Sample')->sampleFunction();
         */
    }
	
	/**
    * Returns an Answer object from the database based on the given id.
    * @param int $answerID The ID for the answer
    * @return Connect\Answer|null The Answer object with the specified id or null if the answer could not be
    * found, is private, or is not enduser visible.
    */
    public function get($answerID){
        $answer =Connect\Answer::fetch($answerID,Connect\RNObject::VALIDATE_KEYS_OFF);

		 return $answer;
    }

}
