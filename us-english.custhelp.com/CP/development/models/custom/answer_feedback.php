<?php /* Originating Release: February 2013 */

namespace Custom\Models; 

\RightNow\Models\Base::loadModel('Incident');

/*$CI = get_instance();
$CI->model('Incident');*/

require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php");

use RightNow\Connect\v1_4 as Connect,
    RightNow\Connect\Knowledge\v1 as KnowledgeFoundation,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Api,
    RightNow\Internal\Sql\Incident as Sql,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
	RightNow\Libraries\Hooks,
    RightNow\ActionCapture,
    RightNow\Utils\Config,
    RightNow\Libraries\AbuseDetection;
	


class answer_feedback extends \RightNow\Models\Incident{
    function __construct()
    {
           parent::__construct();
    }
	

	

    /**
     * Creates a new incident when a user submits either answer or site feedback
     * @param int $answerID Answer ID of which feedback was given
     * @param int $rate Rating of feedback ([1-2] for no/yes, [1-N] for rating)
     * @param int $threshold Threshold required for feedback to be submitted
     * @param string $name Name of user giving feedback
     * @param string $message Message given with feedback
     * @param string|null $givenEmail Email address given in feedback
     * @param int|null $numberOfOptions Number of options for the rating
     * @return Connect\Incident|null Created incident feedback or null if an error was encountered
     */
     public function submitFeedbackReason($reason, $ans_id, $lob, $rate, $additionalfeedback) {  
	
    	
	//	$inc_id = intval($inc_id);
		
		$feedback = new Connect\CO\feedback_tracking();
		$feedback->answer_id=Connect\Answer::fetch($ans_id);
		//$feedback->not_helpful_reason=Connect\CO\not_helpful_reason::fetch(1);
	    $feedback->Additional_Feedback=$additionalfeedback;
		
		$reason=intval($reason);
		$all_reasons = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\not_helpful_reason");
		foreach($all_reasons as $items) 
		{
			if($items->ID == $reason)
			{
			$feedback->not_helpful_reason = $items;
			}
		} 
			
		
		
		
		$lobs = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $lob)
					{
					$feedback->lob = $items;
					}
				} 
			
			
	//	$incident=Connect\Incident::fetch($inc_id);
	$feedback->rating="";	
		
		AbuseDetection::check();
		$ans_res=$feedback->save();
	//	$res=$incident->save();
			
		$ans_res_id=$feedback->ID;
       	
        return $ans_res_id;
    }
	
	    /**
     * Creates a new incident when a user submits either answer or site feedback
     * @param int $answerID Answer ID of which feedback was given
     * @param int $rate Rating of feedback ([1-2] for no/yes, [1-N] for rating)
     * @param int $threshold Threshold required for feedback to be submitted
     * @param string $name Name of user giving feedback
     * @param string $message Message given with feedback
     * @param string|null $givenEmail Email address given in feedback
     * @param int|null $numberOfOptions Number of options for the rating
     * @return Connect\Incident|null Created incident feedback or null if an error was encountered
     */
     public function submitFeedbackReasonYes($rate, $ans_id, $lob,$reason) {
	
	//	$inc_id = intval($inc_id);
		
		$feedback = new Connect\CO\feedback_tracking();
		$feedback->answer_id=Connect\Answer::fetch($ans_id);
		//$feedback->not_helpful_reason=Connect\CO\not_helpful_reason::fetch(1);
		//$feedback->not_helpful_reason = $reason;
		$feedback->rating="Yes";	
		
		$reason=intval($reason);
		
		$lobs = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $lob)
					{
					$feedback->lob = $items;
					}
				} 
				
				
			
		$all_reasons = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\not_helpful_reason");
		foreach($all_reasons as $items) 
		{
			if($items->ID == $reason)
			{
			$feedback->not_helpful_reason = $items;
			}
		} 
	//	$incident=Connect\Incident::fetch($inc_id);
		AbuseDetection::check();
		$ans_res=$feedback->save();
	//	$res=$incident->save();
			
		$ans_res_id=$feedback->ID;
       	
        return $ans_res_id;
    }

	 public function getAllReasons()
	 {
	 
	 	$all_reasons = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\not_helpful_reason");
		/*foreach($all_reasons as $items) 
		{
		
				print_r($items->LookupName);
		} */
		return $all_reasons;
	 }
	
    /**
     * Creates a new incident when a user submits either answer or site feedback
     * @param int $answerID Answer ID of which feedback was given
     * @param int $rate Rating of feedback ([1-2] for no/yes, [1-N] for rating)
     * @param int $threshold Threshold required for feedback to be submitted
     * @param string $name Name of user giving feedback
     * @param string $message Message given with feedback
     * @param string|null $givenEmail Email address given in feedback
     * @param int|null $numberOfOptions Number of options for the rating
     * @return Connect\Incident|null Created incident feedback or null if an error was encountered
     */
     public function submitFeedbackReasonUpdate($fb_id,$reason, $ans_id, $lob, $rate,$additionalfeedback) {
	
    	
	//	$inc_id = intval($inc_id);
		$reason=intval($reason);
		$feedback = Connect\CO\feedback_tracking::fetch($fb_id);
		$feedback->answer_id=Connect\Answer::fetch($ans_id);
		//$feedback->not_helpful_reason=Connect\CO\not_helpful_reason::fetch(1);
	    $feedback->Additional_Feedback=$additionalfeedback;
		
		
		$all_reasons = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\not_helpful_reason");
		foreach($all_reasons as $items) 
		{
			if($items->ID == $reason)
			{
			$feedback->not_helpful_reason = $items;
			}
		} 
			
		
		
		
		$lobs = Connect\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $lob)
					{
					$feedback->lob = $items;
					}
				} 
			
			
	//	$incident=Connect\Incident::fetch($inc_id);
	$feedback->rating="";	
		
		AbuseDetection::check();
		$ans_res=$feedback->save();
	//	$res=$incident->save();
			
		$ans_res_id=$feedback->ID;
       	
        return $ans_res_id;
    }
	
	
	
	   /**
     * Computes incident subject to create based on answer feedback rating value and number of options
     * @param int $answerID ID of the answer being rated
     * @param int $numberOfOptions Size of rating scale. Should be between 2-5
     * @param int $rating Value user rated answer
     * @return string Subject of incident
     */
    private function getAnswerFeedbackSubject($answerID, $numberOfOptions, $rating){
        if ($numberOfOptions === 2) {
            // Yes / No feedback
            $message = ($rating < 2) ? Config::getMessage(NOT_HELPFUL_LBL) : Config::getMessage(HELPFUL_LBL);
            return sprintf(Config::getMessage(FEEDBK_ANS_ID_PCT_D_RATED_PCT_S_LBL), $answerID, $message);
        }
        if($numberOfOptions <= 5){
            $ratingLabels = array();
            if ($numberOfOptions === 3) {
                $ratingLabels = array(RANK_0_LBL, RANK_50_LBL, RANK_100_LBL);
            }
            else if ($numberOfOptions === 4) {
                $ratingLabels = array(RANK_0_LBL, RANK_25_LBL, RANK_75_LBL, RANK_100_LBL);
            }
            else if ($numberOfOptions === 5) {
                $ratingLabels = array(RANK_0_LBL, RANK_25_LBL, RANK_50_LBL, RANK_75_LBL, RANK_100_LBL);
            }
            $rating = Config::getMessage($ratingLabels[$rating - 1]);
        }
        return sprintf(Config::getMessage(FEEDBK_ANS_ID_PCT_D_RATED_HELPFUL_LBL), $answerID, $rating);
    }

}
