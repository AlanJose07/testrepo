<?php
namespace Custom\Models;



use RightNow\Connect\v1_4 as RNCPHP,
 RightNow\Connect\v1_4\CO as RNCPHP_CO;



class custom_meta_description_model  extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
 
  
  
 
 function getAnswerMetaDescription($ans)
 {
 	
 
  try
 {	$answer =RNCPHP\Answer::fetch($ans);
 	
	
	$description=$answer->Solution;
		
	$stripped=strip_tags($description);
	
	$truncated=substr($stripped,0,170);
	
	
	
	return $truncated;
	
	
	
	
 }
  catch (Exception $err )
  {
  echo $err->getMessage();
   }
 }
 
 
 
 
 
 
}

