<?php      
namespace Custom\Models;

use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
 
class answer_hit_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	
	
	function AnswerHitSave($answerId,$lob,$related_ans)
	{
	
	try
	{
	//$answer =   RNCPHP\Answer::fetch($answerId);
	$answerhit = new RNCPHP_CO\answer_hits();
	 
	$answerhit->
context1 = (int)$answerId;
	
	
	if($lob == "beachbodylive")
	{
	$answerhit->certification = 1;
	}
	else
	{
	$answerhit->beach = 1;
	}
	$answerhit->answer_view_action = "AnswerView";
	if($related_ans==1)
	{
	
	$answerhit->context3 = "1";
	}
	else
	{
	
	$answerhit->context3 = "0";
	}

	$answerhit->hits = "1";
	

	$answerhit->save();
	}
		catch (Exception $err ){
		echo $err->getMessage();
			}
	}
	
	
	function track_proactive_chat($referrer,$mob,$link_name)
	{     
		
			$answerhit = new RNCPHP_CO\answer_hits();
			//$answerhit->curr_address = "https://fs6.formsite.com/beachbody/form3/index.html";
			$answerhit->prev_address = $referrer;
			$path = explode("/", $referrer);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$link_name = (int)$link_name;
			/*if($link_name == 1)
			{
				$link = "Proactive Chat Ask";
			}
			else if($link_name == 2)
			{
				$link = "Proactive Chat Contact Us";
			}
			else
			{
				$link = "Proactive Chat Close";
			}*/
			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			
			$link_name = (string)$link_name;
			$answerhit->answer_view_action = "Contact Us Button";
			$CI = get_instance();
			if($mob == 1)
			{
				if($link_name == 1)
				{
					$var = "Proactive Chat Ask Here - Mobile";
				}
				else if($link_name == 2)
				{
					$var = "Proactive Chat Contact Us - Mobile";
				}
				else if($link_name == 3)
				{
					$var = "Proactive Chat Close - Mobile";
				}
				else
				{
					$var = "Proactive Chat Open - Mobile";
				}
			}
			else if($mob == 0)
			{
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{
					if($link_name == 1)
					{
						$var = "Proactive Chat Ask Here - New Design";
					}
					else if($link_name == 2)
					{
						$var = "Proactive Chat Contact Us - New Design";
					}
					else  if($link_name == 3)
					{
						$var = "Proactive Chat Close - New Design";
					}
					else
					{
						$var = "Proactive Chat Open - New Design";
					}
				
				}
				else //new template
				{
					if($link_name == 1)
					{
						$var = "Proactive Chat Ask Here - Without Answers";
					}
					else if($link_name == 2)
					{
						$var = "Proactive Chat Contact Us - Without Answers";
					}
					else if($link_name == 3)
					{
						$var = "Proactive Chat Close - Without Answers";
					}
					else
					{
						$var = "Proactive Chat Open - Without Answers";
					}
				}
			}
			$answerhit->clicked_link = $var;
			$answerhit->hits = "1";
			
		
			$answerhit->save();
			/*$answerhit->answer_view_action = $link;
			if($mob == 1)
			{
				$answerhit->clicked_link = $link."-Mob";
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$answerhit->clicked_link = $link."-New Design";
				}
				else
				{
					$answerhit->clicked_link = $link."-Old Design";
				}
			}
			else
			{
			$answerhit->clicked_link = (string)$link;
			
			}
			$answerhit->hits = "1";
		
			$answerhit->save();*/
			
		
		
		
		}
		
		
		
	function track_vitamin_form_clicks($home_link,$mob)
		{
		
			$answerhit = new RNCPHP_CO\answer_hits();
			$answerhit->curr_address = "https://fs6.formsite.com/beachbody/form3/index.html";
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
		$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
			$path[$page+1] ="answers/".$path[$page+2];
			}
			
			
			
			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			
			$answerhit->answer_view_action = "Vitamin Form View";
			if($mob == 1)
			{
			$answerhit->clicked_link = "Vitamin Form Mobile";
			}
			else if($mob == 0)
			{
			
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$answerhit->clicked_link = "Vitamin Form - New Design";
				}
				else
				{
					$answerhit->clicked_link = "Vitamin Form - Without Answers";
				}
			
			
			}
			else
			{
			$answerhit->clicked_link = "Vitamin Form";
			}
			$answerhit->hits = "1";
		
			$answerhit->save();
			
		
		
		
		}
		
		
		function track_order_status_clicks($home_link,$mob)
		{
		
	    
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			
			
			$answerhit->answer_view_action = "Order Status View";
			if($mob == 1)
			{
				$var = "Order Status Form Mobile";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$var = "Order Status Form - New Design";
					
				}
				else
				{
					$var = "Order Status Form - Without Answers";
				}
				$answerhit->clicked_link = (string)$var;
			}
			else if($mob == 3)
			{
				$var = "Order Status Request";
				$answerhit->clicked_link = (string)$var;
			}
			else
			{
				$answerhit->clicked_link = "Order Status Form";
			}
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		}

		
		function recommended_channel_click_tracking_update($record_id,$channel_id)
		{
			$channel_tracking = RNCPHP_CO\channel_tracking::fetch($record_id);
			
			$recommended_channel = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\rec_channels");
			foreach($recommended_channel as $items) 
			{
				if($items->ID == $channel_id)
				{
					$channel_tracking->selected_channel = $items;
				}
			} 
			$channel_tracking->save();
			return true;
		}
		
		function track_contact_clicks($home_link,$mob)
		{
		   
			
			$answerhit = new RNCPHP_CO\answer_hits();
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			/*if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}*/
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/contact_us/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					    
						$answerhit->line_of_business = $items;
						
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			$answerhit->answer_view_action = "Contact Us Form UK";
			if($mob == 5)
			{
				$var = "Contact Us Form UK";
				$answerhit->clicked_link = (string)$var;
				
			}
			$answerhit->hits = "1";
			$answerhit->save();
			
		}
		
		
		//Function to get order status for Credit Card Update
		function getOrderStatusCC($data,$home_link,$mob)
		{
		
		
		try	
		{
	
		foreach($data as $items)
		{
			$order[$items->name] = $items->value;
		}
	
		$email = trim($order['email']);
		$order_num = trim($order['order_number']);
		$zip_code = trim($order['zip_code']);
	
		
		if($order_num!="" && $zip_code!=""  && $email!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
			
			 $order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.order_number = '$order_num' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
			
		}
		else if($order_num!="" && $zip_code!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
			
			$order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.order_number = '$order_num' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
			
	
	
	
		}
		else if($email!="" && $zip_code!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("email='".$email."'AND zip_code='".$zip_code."'");
			
	$order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.email = '$email' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC,CO.order_tracking_new.ID DESC")->next();
			
		/*	$order = RNCPHP\ROQL::queryObject("SELECT MAX(CO.order_tracking_new.CreatedTime) as CreatedDate,CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.email = '$email' AND CO.order_tracking_new.zip_code='$zip_code' GROUP BY CO.order_tracking_new.order_number ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
		*/
		
		}
			
					
		
		$i=0;
		$chk_order_no="";
		$k=0;
		while($row = $order->next())
		{ 
			if($k!=3)
			{
				if($chk_order_no!=$row->order_number)
				{
					$orderA[$i]['order_number']=$row->order_number;
					
					$orderA[$i]['order_number']=$row->order_number;
					$orderA[$i]['ID'] = $row->ID;
					$orderA[$i]['last_name']=$row->last_name;
					$orderA[$i]['first_name']=$row->first_name;
					$orderA[$i]['email']=$row->email;
					$orderA[$i]['order_create_date']=$row->order_create_date;
					
					$orderA[$i]['order_status']=$row->order_status;
					$orderA[$i]['phone_number']=$row->phone_number;
					$orderA[$i]['shipped_date']=$row->shipped_date;
					
					$orderA[$i]['sku_descriptions']=$row->sku_descriptions;
					$orderA[$i]['tracking_number']=$row->tracking_number;
					$orderA[$i]['zip_code']=$row->zip_code;
					
					$chk_order_no=$row->order_number;
					$i++ ;
					$k++;
				}
			}
				
		}
		 
		 
		
		
	 //==========================TRACK CREDIT CARD STATUS SEARCH (SUCCESS/ FAILURE COUNT)=====================
	
	
	 $ip = $_SERVER['REMOTE_ADDR'];
	 
		 
	 	
	if(count($orderA)==0)//FAILURE
	{
	
		//*****************************************Click Track FAILURE  ********************* 
			
		$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			/*
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			*/
			
			//----------------new change---------
			if($path[4]!="")
			{
			
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);
			}
			else
			{
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch('home');
			}
			$answerhit->answer_view_action = "Credit Card Update Search Failure";
			
			$var = "Credit Card Update Search Failure";
			$answerhit->clicked_link = (string)$var;
			$answerhit->user_agent = RNCPHP_CO\user_agent ::fetch($mob);
			//------------------new change-------
			
			/*
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
							
			
			
			
			$answerhit->answer_view_action = "Credit Card View";
			if($mob=="Y")
			{
				$var = "Credit Card Update Search Failure-Mob";//2nd popup is not visible
			}
			else
			{
				$var = "Credit Card Update Search Failure-Web";
			}
			
			$answerhit->clicked_link = (string)$var;  
			 */
			$answerhit->hits = "1";
				
			$answerhit->save();
			 $click_track_failure_id=$answerhit->ID;

		//****************************************************Click Track Attempts  END***************************************
	
	
	
	
	
		$order_suc_fail_track = new RNCPHP_CO\OrderSearchTracking();
		
		$order_suc_fail_track->Result="Failure";//FAILURE
		if($order_num)
		{
		$order_suc_fail_track->OrderNumberSearch=$order_num;
		}
		if($email)
		{
		$order_suc_fail_track->EmailSearch=$email;
		}
		if($zip_code)
		{
		$order_suc_fail_track->ZipSearch=$zip_code;
		}
		
		$order_suc_fail_track->Status="No Value";
		$order_suc_fail_track->IP=$ip ;
		
		$order_suc_fail_track->SourceModule="Credit Card Update";
		
		$order_suc_fail_track->click_track_id=$click_track_failure_id;
		
		$res=$order_suc_fail_track->save();
		
		
	} 
	else//success search
	{
	
	//*******************************CLICK TRACK SUCCESS ********************************************
		
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			
			//----------------new change---------
			if($path[4]!="")
			{
			
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);
			}
			else
			{
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch('home');
			}
			$answerhit->answer_view_action = "Credit Card Update Search Success";
			
			$var = "Credit Card Update Search Success";
			$answerhit->clicked_link = (string)$var;
			$answerhit->user_agent = RNCPHP_CO\user_agent ::fetch($mob);
			//------------------new change-------
			
			/*
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			$answerhit->answer_view_action = "Credit Card View";
			
			if($mob=="Y")
			{
				$var = "Credit Card Update Search Success-Mob";//2nd popup visible
			}
			else
			{
				$var = "Credit Card Update Search Success-Web";
			}
			
				 
			$answerhit->clicked_link = (string)$var; 
			*/
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			$click_track_success_id=$answerhit->ID;
			
			
		//*******************************CLICK TRACK SUCCESS END*****************************************
		
		foreach ($orderA as $value)
		{
		
		$status = $value[order_status]->LookupName;
		  
		
		
		$order_number_result = $value[order_number];
		$email = $value[email];
		$id = $value[ID];
		
		
		$order_suc_fail_track = new RNCPHP_CO\OrderSearchTracking();
		if($id)
		{
		$order_suc_fail_track->order_tracking_new= $id;
		}
		$order_suc_fail_track->Result="Success";//SUCCESS
		if($order_num)
		{
		$order_suc_fail_track->OrderNumberSearch=$order_num;
		
		}
		if($email)
		{
		$order_suc_fail_track->EmailSearch=$email;
		}
		if($zip_code)
		{
		$order_suc_fail_track->ZipSearch=$zip_code;
		}
		if($order_number_result)
		{
		$order_suc_fail_track->OrderNumberResult=$order_number_result;
		}
		if($status)
		{
		$order_suc_fail_track->Status=$status;
		}
		
		
		$order_suc_fail_track->IP=$ip ;
		$order_suc_fail_track->click_track_id=$click_track_success_id;
		
		$order_suc_fail_track->SourceModule="Credit Card Update";
		
		$res=$order_suc_fail_track->save();
		
		
		
		}
	}
	
 //===========================================================================================================
 
	
		return $orderA;
	
	}
	catch (Exception $err )
	{
		echo $err->getMessage();
		return false;
	}
		
		}
		
		
		//Function to get order status

	function getOrderStatus($data,$home_link,$mob)
	{
	
	try	
	{
	
		foreach($data as $items)
		{
			$order[$items->name] = $items->value;
		}
	
		$email = trim($order['email']);
		$order_num = trim($order['order_number']);
		$zip_code = trim($order['zip_code']);
	
		
		if($order_num!="" && $zip_code!=""  && $email!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
			
			 $order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.order_number = '$order_num' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
			
		}
		else if($order_num!="" && $zip_code!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
			
			$order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.order_number = '$order_num' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
			
	
	
	
		}
		else if($email!="" && $zip_code!="")
		{
			//$order = RNCPHP_CO\order_tracking_new::find("email='".$email."'AND zip_code='".$zip_code."'");
			
			
			
	$order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.email = '$email' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC,CO.order_tracking_new.ID DESC")->next();
			
		/*	$order = RNCPHP\ROQL::queryObject("SELECT MAX(CO.order_tracking_new.CreatedTime) as CreatedDate,CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.email = '$email' AND CO.order_tracking_new.zip_code='$zip_code' GROUP BY CO.order_tracking_new.order_number ORDER BY CO.order_tracking_new.CreatedTime DESC")->next();
		*/
		
		}
		
					
		
		$i=0;
		$chk_order_no="";
		$j=0;
		while($row = $order->next())
		{ 
			if($j!=3)
			{
				if($chk_order_no!=$row->order_number)
				{
					$orderA[$i]['order_number']=$row->order_number;
					
					$orderA[$i]['order_number']=$row->order_number;
					$orderA[$i]['ID'] = $row->ID;
					$orderA[$i]['last_name']=$row->last_name;
					$orderA[$i]['first_name']=$row->first_name;
					$orderA[$i]['email']=$row->email;
					$orderA[$i]['order_create_date']=$row->order_create_date;
					
					$orderA[$i]['order_status']=$row->order_status;
					$orderA[$i]['phone_number']=$row->phone_number;
					$orderA[$i]['shipped_date']=$row->shipped_date;
					
					$orderA[$i]['sku_descriptions']=$row->sku_descriptions;
					$orderA[$i]['tracking_number']=$row->tracking_number;
					$orderA[$i]['zip_code']=$row->zip_code;
					
					$chk_order_no=$row->order_number;
					$i++ ;
					$j++;
				}
			}
				
		}
		 
		 
		 
		 
	
	
	
		/*if($order_num!="" && $zip_code!=""  && $email!="")
		{
			$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
		}
		else if($order_num!="" && $zip_code!="")
		{
			$order = RNCPHP_CO\order_tracking_new::find("order_number='".$order_num."'AND zip_code='".$zip_code."'");
		}
		else if($email!="" && $zip_code!="")
		{
			$order = RNCPHP_CO\order_tracking_new::find("email='".$email."'AND zip_code='".$zip_code."'");
		}*/
		
		
	 //==========================TRACK ORDER STATUS SEARCH (SUCCESS/ FAILURE COUNT)=====================
	
	
	 $ip = $_SERVER['REMOTE_ADDR'];
	 
	 	
	
	if(count($orderA)==0)//FAILURE
	{
	
		//*****************************************Click Track FAILURE  ********************* 
			
		$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			
			/*
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			*/
			
			//----------------new change---------
			if($path[4]!="")
			{
			
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);
			}
			else
			{
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch('home');
			}
			$answerhit->answer_view_action = "Order Status Search Failure";
			
			$var = "Order Status Search Failure";
			$answerhit->clicked_link = (string)$var;
			$answerhit->user_agent = RNCPHP_CO\user_agent ::fetch($mob);
			//------------------new change-------
			
			/*
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			
			
			
			$answerhit->answer_view_action = "Order Status View";
			if($mob == 1)
			{
				$var = "Order Status Search Failure-Mob";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{	
				
					
					$var = "Order Status Search Failure-Web";
					
					
				}
				else
				{
				
					$var = "Order Status Search Failure - Without Answers";
				}
				$answerhit->clicked_link = (string)$var;
			}
			else if($mob == 3)
			{
				$var = "Order Status Search Request";
				$answerhit->clicked_link = (string)$var;
			}
			
			else
			{
				$answerhit->clicked_link = "Order Status Search Failure";
			}
			
			*/
			$answerhit->hits = "1";
			$answerhit->save();
			$click_track_failure_id=$answerhit->ID;
 
		//****************************************************Click Track Attempts  END***************************************
	
	
	
	
	
		$order_suc_fail_track = new RNCPHP_CO\OrderSearchTracking();
		
		$order_suc_fail_track->Result="Failure";//FAILURE
		if($order_num)
		{
		$order_suc_fail_track->OrderNumberSearch=$order_num;
		}
		if($email)
		{
		$order_suc_fail_track->EmailSearch=$email;
		}
		if($zip_code)
		{
		$order_suc_fail_track->ZipSearch=$zip_code;
		}
		
		$order_suc_fail_track->Status="No Value";
		$order_suc_fail_track->IP=$ip ;
		
		$order_suc_fail_track->click_track_id=$click_track_failure_id;
		
		$res=$order_suc_fail_track->save();
		
		
	} 
	else//success search
	{
	
	//*******************************CLICK TRACK SUCCESS ********************************************
		
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			
			//----------------new change---------
						
			if($path[4]!="")
			{
			
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);
			}
			else
			{
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch('home');
			}
			
			$answerhit->answer_view_action = "Order Status Search Success";
			
			$var = "Order Status Search Success";
			$answerhit->clicked_link = (string)$var;
			$answerhit->user_agent = RNCPHP_CO\user_agent ::fetch($mob);
			//------------------new change-------
			
			/*
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			
			
			$answerhit->answer_view_action = "Order Status View";
			if($mob == 1)
			{
				$var = "Order Status Search Success-Mob";
				
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$var = "Order Status Search Success-Web";
					
					
				} 
				else
				{
					$var = "Order Status Search Success - Without Answers";
				}
				$answerhit->clicked_link = (string)$var;
			}
			else if($mob == 3)
			{
				$var = "Order Status Search Request";
				$answerhit->clicked_link = (string)$var;
			}
			else
			{
				$answerhit->clicked_link = "Order Status Search Success";
			}
			
			*/
			$answerhit->hits = "1";
			
			$answerhit->save();
			$click_track_success_id=$answerhit->ID;
			
			
		//*******************************CLICK TRACK SUCCESS END*****************************************
		
		foreach ($orderA as $value)
		{
		
		$status = $value[order_status]->LookupName;
		  
		
		
		$order_number_result = $value[order_number];
		$email = $value[email];
		$id = $value[ID];
		
		
		$order_suc_fail_track = new RNCPHP_CO\OrderSearchTracking();
		if($id)
		{
		$order_suc_fail_track->order_tracking_new= $id;
		}
		$order_suc_fail_track->Result="Success";//SUCCESS
		if($order_num)
		{
		$order_suc_fail_track->OrderNumberSearch=$order_num;
		
		}
		if($email)
		{
		$order_suc_fail_track->EmailSearch=$email;
		}
		if($zip_code)
		{
		$order_suc_fail_track->ZipSearch=$zip_code;
		}
		if($order_number_result)
		{
		$order_suc_fail_track->OrderNumberResult=$order_number_result;
		}
		if($status)
		{
		$order_suc_fail_track->Status=$status;
		}
		
		
		$order_suc_fail_track->IP=$ip ;
		$order_suc_fail_track->click_track_id=$click_track_success_id;
		
		$res=$order_suc_fail_track->save();
		
		
		
		}
	}
	
 //===========================================================================================================
 
	
		return $orderA;
	
	}
	catch (Exception $err )
	{
		echo $err->getMessage();
		return false;
	}
	
	}


	
		function track_shk_clicks($home_link,$mob)
		{
	    
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
			$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
			$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/order_alt/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			
			
			$answerhit->answer_view_action = "SHK Form View";
			if($mob == 1)
			{
			$answerhit->clicked_link = "SHK Form Mobile";
			}
			else if($mob == 0)
			{
			
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$var = "Shakeology Form - New Design";
					
				}
				else
				{
					$var = "Shakeology Form - Without Answers";
				}
				$answerhit->clicked_link = (string)$var;
			
			}
			else
			{
			$answerhit->clicked_link = "Shakeology Form";
			}
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		     
		
		}	
		
		function track_call_support($home_link,$mob)
		{
	    
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.co.uk/app/answers/detail/a_id/9909/~/beachbody-support-contact-information/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			$answerhit->answer_view_action = "Rqst Not Listed Call";
			if($mob == 1)
			{
				$var = "Call Support Link - Mobile";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 3)
			{
			$var = "Call Support Link";
			$answerhit->clicked_link = (string)$var; 
			}
			else //if($mob == 0)
			{
				$var = "Call Support Link - New Design";
	
				$answerhit->clicked_link = (string)$var;
			}
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		
		
		}	
		
		
		function track_contactus_clicks($home_link,$mob)
		{
		
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			if($path[$page+1] == "chat")
			{
			$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
			$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$line_of_business = array_search('lob', $path);
			
			$answerhit->curr_address = "https://faq.beachbody.co.uk/app/answers/detail/a_id/9909/~/customer-service-%26-coach-relations-contact-information/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 

				
	
			$answerhit->answer_view_action = "Contact Us Button";
			if($mob == 1)
			{
			$answerhit->clicked_link = "Contact Us Button Mobile";
			}
			else if($mob == 0)
			{
				$CI = get_instance();
			
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session   
				if($path[$page+1]=="home" ||$path[$page+2]=="list")//if the button appears in the support home page/answers list page
				{
				if($temp_counter<= $old_temp) // old template
				{
				
					$answerhit->clicked_link = "Support Home Contact Us Button - 2 - New Design";
				}
				else
				{
					$answerhit->clicked_link = "Support Home Contact Us Button - 2 - Without Answers";
				}
				}
				else
				{
				if($temp_counter<= $old_temp) // old template
				{
				
					$answerhit->clicked_link = "Contact Us Button - New Design";
				}
				else
				{
					$answerhit->clicked_link = "Contact Us Button - Without Answers";
				}
				}
			}
			else
			{
			$answerhit->clicked_link = "Contact Us Button";
			}
			$answerhit->hits = "1";
			
		
			$answerhit->save();
			
		
		
		
		}
			function track_contactus_chat_clicks($home_link,$mob)
		{
		
		
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			if($path[$page+1] == "chat")
			{
		$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
			$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$line_of_business = array_search('lob', $path);
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/chat/chat_launch/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			
			$answerhit->answer_view_action = "Contact Us Button";
			
			$CI = get_instance();
			
			$old_temp =  $CI->session->getSessionData('old_template_ratio');
			$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
			if($temp_counter<= $old_temp) // old template
			{
			
				$var = "Support Home Contact Us Button - New Design";
			
			}
			else //new template
			{
				$var = "Support Home Contact Us Button - Without Answers";
			}
			$answerhit->clicked_link = (string)$var;
			
			
			
			
			
			
			
			
			$answerhit->hits = "1";
			
		
			$answerhit->save();
			
		
		
		
		
		
		
		}
		/** To track the number of hits of each template(old or new)**/
		function template_tracking($temp_counter,$mob_session)
		{
		
		$template = new RNCPHP_CO\template_tracking();
		$CI = get_instance();
		$old_temp =  $CI->session->getSessionData('old_template_ratio');
		
		if($mob_session == 1)//if mobile template is to be tracked
		{
		$template->template_type = "Mobile Template";
		}
		else
		{
		
		if($temp_counter<=$old_temp)//if old web template is to be tracked
		{
		
			$template->template_type = "New Template";
		}
		else//if new web template is to be tracked
		{
	
			$template->template_type = "New Template Without Answers";
		}
	
		}
		
		$template->hits = 1;
		
		$template->save();
		
		}
		function track_smart_assistance_chat($flag,$url)
			
		{
		
			$chat = new RNCPHP_CO\chat_sa_tracking();
			
			///$answerhit->prev_address = $url;
			$path = explode("/", $url);
			
			
			$line_of_business = array_search('lob', $path);
			
			//$answerhit->curr_address = $url;
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$chat->lob = $items;
					}
				} 
			if($flag == 0)
			{
			
				$var = "Chats Intiated";
			
			}
			
			
			if($flag == 1)
			{
			
				$var = "Chats Completed";
			
			}
			 if($flag == 2)
			{
			
				$var = "Chat Questions Answered By SmartAssistant";
			
			}if($flag == 3)
			{
			
				$var = "Chat Question Edited";
			
			}
			
			$chat->activity = (string)$var;
			
			
			$chat->hits = "1";
			
		
			$response = $chat->save();
			return $response;
		
		}
		//=======================CLICK TRACKING CREDIT CARD UPDATE==============================================
		
		function track_credit_card_update_clicks($home_link,$mob,$clickType)
		{
		
		//$clickType==next---click from popup next button--for tracking how many times form has been opened
		//$clickType==tile---click from CCU tile 
		
		
		
			$answerhit = new RNCPHP_CO\answer_hits();
			
			$answerhit->prev_address = $home_link;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			if($path[$page+1] == "chat")
			{
				$path[$page+1] ="chat/".$path[$page+2];
			}
			else if($path[$page+1] == "answers")
			{
				$path[$page+1] ="answers/".$path[$page+2];
			}
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/home/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			 			
			
			$answerhit->answer_view_action = "Credit Card View";
			
			if($clickType=='tile')//click from tile
			{
				$var=($mob=="Y")? "Credit Card Update Click-MobUK" : "Credit Card Update Click-WebUK";
			}
			if($clickType=='next')//click from next button in the popup
			{
				$var=($mob=="Y")? "Credit Card Update Open-MobUK" : "Credit Card Update Open-WebUK";
			}
			if($clickType=='submit')//click from submit button in the popup
			{
				$var=($mob=="Y")? "Credit Card Update Submit-MobUK" : "Credit Card Update Submit-WebUK";
			}
			
			
			$answerhit->clicked_link = (string)$var;  
			
			$answerhit->hits = "1";
			
			$answerhit->save();
		
		}
		
		
	
} 