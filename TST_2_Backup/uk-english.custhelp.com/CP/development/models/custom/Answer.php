<?php /* Originating Release: February 2015 */

namespace Custom\Models;

use RightNow\Connect\v1_2 as RNCPHP;

class Answer extends \RightNow\Models\Base
{ 
	public function getAnswers($request,$member)
	{ 
		$req_id = intval($request);
		$mem_id = intval($member);
		$answers = RNCPHP\ROQL::query("SELECT channel.answer FROM CO.channel_decision channel WHERE channel.member_type=".$mem_id." AND channel.request_type=".$req_id.";")->next();
		$ans = $answers->next();
		$result=array();
		if(count($ans['answer'])!=0)
		{
			$answers = explode(",",$ans['answer']);
			$no = count($answers);
			if($no == 1)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0])->next(); 
				
				//echo "<pre>";
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
				}
			}
			else if ($no == 2)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0]." OR A.ID=".$answers[1])->next();
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
				}
			}
			else //if ($no == 3)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0]." OR A.ID=".$answers[1]." OR A.ID=".$answers[2])->next();
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
					
				}
				
			}
			//else
		//	{
				//$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE ID=2020 OR ID=2052;")->next();
		//	}
		}
		else
		{
			
		}

		return $result;
	}
	
	public function getNewAnswers($answer_ids)
	{ 
		$answers = explode(",",$answer_ids);
		$result=array();
		if(count($answers)!=0)
		{
			$no = count($answers);
			if($no == 1)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0])->next();
				
				//echo "<pre>";
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
				}
			}
			else if ($no == 2)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0]." OR A.ID=".$answers[1])->next();
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
				}
			}
			else //if ($no == 3)
			{
				$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE A.ID=".$answers[0]." OR A.ID=".$answers[1]." OR A.ID=".$answers[2])->next();
				while($item =  $res->next())
				{
					array_push($result,$item["Summary"],$item["Solution"]);
					
				}
				
			}
			//else
		//	{
				//$res = RNCPHP\ROQL::query("SELECT A.summary,A.solution FROM Answer A WHERE ID=2020 OR ID=2052;")->next();
		//	}
		}
		else
		{
			
		}
		return $result;
	}
	
	/*This function is calling from the controller of the widget custom/reports/CustomMultilineList for the normal and user guide answers*/
	/*This function will get the value for the custom field guide_user*/
	/*Type of the Mode is integer*/
	/*by jithin*/
	function userguideanswer($a_id,$mode)
	{   
	  
	    $sollist=array(); 
		foreach($a_id as $id)
		{
			$res = RNCPHP\ROQL::query("select Answer.CustomFields.c.guided_assistance_answer,Answer.Solution from Answer where Answer.ID=".$id."")->next();
			if($answerresult = $res->next())
			{
			   if($mode==1)
			   array_push($sollist,$answerresult['Solution']);
		       if($mode==2)
			   array_push($sollist,$answerresult['guided_assistance_answer']);	      
			}
		}//end of foreach
		    
		return $sollist; 			
	}
	/*by jithin*/
}
 