<?php
namespace Custom\Models;
require_once(get_cfg_var("doc_root")."/include/ConnectPHP/Connect_init.phph");
initConnectAPI();
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;

class CustomModel extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	//Storing the feedback into a custom object
    function setFeedback($ContactID, $message, $key)
	{
    try
	  {
		$keyword_feedback = new RNCPHP_CO\ keyword_feedbacks();
		//$answer_feedback->Answer_Id = $answer->ID;
		$keyword_feedback->Contact_Id = RNCPHP\Contact::fetch($ContactID);
		$keyword_feedback->feedback = $message;
		$keyword_feedback->keyword = $key;
		$keyword_feedback->save();
		return $keyword_feedback;
	  }
	catch (Exception $err )
	  {
		echo $err->getMessage();
	  }  		
     }

}
