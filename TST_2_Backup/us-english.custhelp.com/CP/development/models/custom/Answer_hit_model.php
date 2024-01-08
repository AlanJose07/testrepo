<?php
namespace Custom\Models;
$CI = get_instance();


use RightNow\Connect\v1_4 as RNCPHP,
	RightNow\Connect\v1_4\CO as RNCPHP_CO;

class answer_hit_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	
	/*To track answer hits*/
	
	function AnswerHitSave($answerId,$lob,$related_ans)
	{
	
	
	try
	
		{
	
		$answerhit = new RNCPHP_CO\answer_hits();
		
		$answerhit->context1 = (int)$answerId;
		
		if($lob == "shake")
		{
		
			$answerhit->shake = 1;
		}
		
		else if($lob == "beach")
		{
			$answerhit->beach = 1;
		}
		
		else if($lob == "coach")
		{
			$answerhit->coach = 1;
		}
		
		else if($lob == "beachbodylive")
		{
			$answerhit->certification = 1;
		}
		
		else
		{
			$answerhit->team = 1;
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
	catch (Exception $err )
	{
	
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
			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
		

		
	/*To track Vitamin Form Clicks*/
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
			
			
			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
		
		/*To track Shakeology Form Clicks*/
	
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
				$var = "Shakeology Form Mobile";
				$answerhit->clicked_link = (string)$var; 
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
			else if($mob == 3)
			{
				$var = "Shakeology Modification Request";
				$answerhit->clicked_link = (string)$var;
			}
			else
			{
				$answerhit->clicked_link = "Shakeology Form";
			}
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		
		
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					    
						$answerhit->line_of_business = $items;
						
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			$answerhit->answer_view_action = "Contact Us Form";
			if($mob == 5)
			{
				$var = "Contact Us Form";
				$answerhit->clicked_link = (string)$var;
				
			}
			$answerhit->hits = "1";
			$answerhit->save();
			
		}
		
		
		/*To track shk form pop up*/
		
		function track_shk_pop_up_clicks($home_link,$mob,$prevlink)
		{
		   
			
			$answerhit = new RNCPHP_CO\answer_hits();
			$answerhit->curr_address = $home_link;
			$answerhit->prev_address = $prevlink;
			$path = explode("/", $home_link);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					    
						$answerhit->line_of_business = $items;
						
					}
				} 
			$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);	
			 
			if($mob == 1)
			{
			    $answerhit->answer_view_action = "Shkpopup web";
				$var = "Shkpopup web";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 2 )
			{                                  
			    $answerhit->answer_view_action = "Shkpopup close web";
				$var = "Shkpopup close web";
				$answerhit->clicked_link = (string)$var;
				
			}
			/*****************US,CANADA,UK LOGIN AND FRENCH,SPANISH LOGIN[web][below code]***************************************/
			if($mob == 3)//US[order_alt.php{web}]
			{
			    $answerhit->answer_view_action = "Shkpoploginweb US";
				$var = "Shkpoploginweb US";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 7)//CA[order_alt.php{web}]
			{
			    $answerhit->answer_view_action = "Shkpoploginweb CA";
				$var = "Shkpoploginweb CA";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 8)//UK[order_alt.php{web}]
			{
			    $answerhit->answer_view_action = "Shkpoploginweb UK";
				$var = "Shkpoploginweb UK";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 9)//FRENCH[order_alt_french.php{web}]
			{
			    $answerhit->answer_view_action = "Shkpoploginweb FR";
				$var = "Shkpoploginweb FR";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 10)//SPANISH[order_alt_spanish.php{web}]
			{
			    $answerhit->answer_view_action = "Shkpoploginweb SP";
				$var = "Shkpoploginweb SP";
				$answerhit->clicked_link = (string)$var;
				
			}
			/*****************US,CANADA,UK LOGIN AND FRENCH,SPANISH LOGIN[web][above code]***************************************/
			if($mob == 4)
			{
			    $answerhit->answer_view_action = "Shkpopup mob";
				$var = "Shkpopup mob";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 5 )
			{
			    $answerhit->answer_view_action = "Shkpopup close mob";
				$var = "Shkpopup close mob";
				$answerhit->clicked_link = (string)$var;
				
			}
			/*****************US,CANADA,UK LOGIN AND FRENCH,SPANISH LOGIN[mobile][below code]***************************************/
			if($mob == 6)//US[order_alt.php{mob}]
			{
			    $answerhit->answer_view_action = "Shkpoploginmob US";
				$var = "Shkpoploginmob US";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 11)//CA[order_alt.php{mob}]
			{
			    $answerhit->answer_view_action = "Shkpoploginmob CA";
				$var = "Shkpoploginmob CA";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 12)//UK[order_alt.php{mob}]
			{
			    $answerhit->answer_view_action = "Shkpoploginmob UK";
				$var = "Shkpoploginmob UK";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 13)//FRENCH[order_alt_french.php{mob}]
			{
			    $answerhit->answer_view_action = "Shkpoploginmob FR";
				$var = "Shkpoploginmob FR";
				$answerhit->clicked_link = (string)$var;
				
			}
			if($mob == 14)//SPANISH[order_alt_spanish.php{mob}]
			{
			    $answerhit->answer_view_action = "Shkpoploginmob SP";
				$var = "Shkpoploginmob SP";
				$answerhit->clicked_link = (string)$var;
				
			}
			/*****************US,CANADA,UK LOGIN AND FRENCH,SPANISH LOGIN[mobile][above code]***************************************/
			$answerhit->hits = "1";
			$answerhit->save();
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*To track Order status  Clicks*/
	
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
		
		/*=================Order Status successfull search track==========================*/
		
		function track_order_status_successfull_attempts($home_link,$mob)
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
				$var = "Order Status Success Mob";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{			
					$var = "Order Status - Success";
					
				}
				else
				{
					$var = "Order Status Success - Without Answers";
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
				$answerhit->clicked_link = "Order Status Success";
			}
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		}
		
		/*=================Order Status search attempts==========================*/
		
		function track_order_status_attempts($home_link,$mob)
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
				$var = "Order Status Attempts Mob";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 0)
			{
				$CI = get_instance();
				
				$old_temp =  $CI->session->getSessionData('old_template_ratio');
				$temp_counter =  $CI->session->getSessionData('temp_counter');//get the current counter value from session
				if($temp_counter<= $old_temp) // old template
				{	
				
					
					$var = "Order Status - Attempts";
					
				}
				else
				{
				
					$var = "Order Status Attempts - Without Answers";
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
				$answerhit->clicked_link = "Order Status Attempts";
			}
			$answerhit->hits = "1";
			
			$answerhit->save();
			
			
		
		}
		
		
		
			/*To track Customer Coach Change Form Clicks*/
	function track_customer_coach_clicks($home_link,$mob)
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
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/customer_coach_change_form/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			$answerhit->answer_view_action = "Customer Form View";
			if($mob == 1)
			{
				$var = "Customer Coach Change Form - Mobile";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 3)
			{
			$var = "Customer Coach Change Request";
			$answerhit->clicked_link = (string)$var; 
			}
			else //if($mob == 0)
			{
				$var = "Customer Coach Change Form - New Design";
	
				$answerhit->clicked_link = (string)$var;
			}
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		
		
		}	
		
		function track_genealogy_clicks($home_link,$mob)
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
			
			$answerhit->curr_address = "https://fs6.formsite.com/beachbody/Genealogy/index.html";
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			$answerhit->answer_view_action = "Genealogy Form View";
			if($mob == 1)
			{
				$var = "Genealogy Change Request Form - Mobile";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 3)
			{
			$var = "Genealogy Change Request Form";
			$answerhit->clicked_link = (string)$var; 
			}
			else //if($mob == 0)
			{
				$var = "Genealogy Change Request Form - New Design";
	
				$answerhit->clicked_link = (string)$var;
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
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/answers/detail/a_id/9909/~/beachbody-support-contact-information/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
				$var = "Request not Listed - Call Support Mobile";
				$answerhit->clicked_link = (string)$var; 
			}
			else if($mob == 3)
			{
			$var = "Request not Listed - Call Support";
			$answerhit->clicked_link = (string)$var; 
			}
			else //if($mob == 0)
			{
				$var = "Request not Listed - Call Support New Design";
	
				$answerhit->clicked_link = (string)$var;
			}
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		
		
		}	
		
		
			function track_bb_cust_options($home_link, $id, $url, $page_set)
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
			if($id==744)
			{
				$answerhit->curr_address = $url;
			}
			else
			{
				$answerhit->curr_address = "https://faq.beachbody.com".$url;
			}
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			//$answerhit->line_of_business = RNCPHP_CO\line_of_business ::fetch($path[$line_of_business+1]);
			
			//$answerhit->page_details = RNCPHP_CO\page_details::fetch($path[$page+1]);
			$page_set=(string)$page_set;
			$answerhit->answer_view_action = "BB Request Email";
			if($id == 744)
			{
				if($page_set=="mobile")
				{
					$var="ActiVit Changes Email Mob";
				}
				else
				{
					$var = "ActiVit Changes Email";
				}
			}
			else if($id == 745)
			{
				if($page_set=="mobile")
				{
					$var="Shakeology Customization Email Mob";
				}
				else
				{
					$var = "Shakeology Customization Email";
				}
			}
			else //if($id == 746)
			{
				if($page_set=="mobile")
				{
					$var="Request Not Listed Email Mob";
				}
				else
				{
					$var = "Request Not Listed Email";
				}
			}
			$answerhit->clicked_link = (string)$var; 
			/*else //if($mob == 0)
			{
				$var = "Request US Email";
	
				$answerhit->clicked_link = (string)$var;
			}*/
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
			return $answerhit->ID;
		
		
		}	
		
		
		function track_bb_cust($home_link, $page_set, $lob)
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
			
			$answerhit->curr_address = $home_link;			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $lob)//$path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			//$answerhit->line_of_business = RNCPHP_CO\line_of_business ::fetch($path[$line_of_business+1]);
			
			//$answerhit->page_details = RNCPHP_CO\page_details::fetch($path[$page+1]);
			$page_set=(string)$page_set;
			$answerhit->answer_view_action = "BB Customer Email";
			
			if($page_set=="mobile")
			{
				$var="BB Customer Email Mob";
			}
			else
			{
				$var = "BB Customer Email Web";
			}
			
			$answerhit->clicked_link = (string)$var; 
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
			return $answerhit->ID;
		
		
		}	
		
		function track_tbb_cust_options($home_link, $id, $url, $page_set)
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
			if($id==744)
			{
				$answerhit->curr_address = $url;
			}
			else
			{
				$answerhit->curr_address = "https://faq.beachbody.com".$url;
			}
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			//$answerhit->line_of_business = RNCPHP_CO\line_of_business ::fetch($path[$line_of_business+1]);
			
			//$answerhit->page_details = RNCPHP_CO\page_details::fetch($path[$page+1]);
			$page_set=(string)$page_set;
			$answerhit->answer_view_action = "TBB Request Email";
			if($id == 747) 
			{
				if($page_set=="mobile")
				{
					$var="ActiVit Changes TBB Mob";
				}
				else
				{
					$var = "ActiVit Changes TBB";
				}
			}
			else if($id == 748)
			{
				if($page_set=="mobile")
				{
					$var="Shakeology Customization TBB Mob";
				}
				else
				{
					$var = "Shakeology Customization TBB";
				}
			}
			else if($id == 750)
			{
				if($page_set=="mobile")
				{
					$var="Customer Coach Change TBB Mob";
				}
				else
				{
					$var = "Customer Coach Change TBB";
				}
			}
			else //if($id == 749)
			{
				if($page_set=="mobile")
				{
					$var="Request Not Listed TBB Mob";
				}
				else
				{
					$var = "Request Not Listed TBB";
				}
			}
			$answerhit->clicked_link = (string)$var; 
			/*else //if($mob == 0)
			{
				$var = "Request US Email";
	
				$answerhit->clicked_link = (string)$var;
			}*/
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
			return $answerhit->ID;
		
		
		}	
		
		
		function track_tbb_cust($home_link, $page_set, $lob)
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
			
			$answerhit->curr_address = $home_link;			
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $lob)//$path[$line_of_business+1])
					{
					$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
					$answerhit->page_details = $items;
					}
				} 
				
			
			//$answerhit->line_of_business = RNCPHP_CO\line_of_business ::fetch($path[$line_of_business+1]);
			
			//$answerhit->page_details = RNCPHP_CO\page_details::fetch($path[$page+1]);
			$page_set=(string)$page_set;
			$answerhit->answer_view_action = "BB Customer Email";
			
			if($page_set=="mobile")
			{
				$var="TBB Customer Email Mob";
			}
			else
			{
				$var = "TBB Customer Email Web";
			}
			
			$answerhit->clicked_link = (string)$var; 
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
			return $answerhit->ID;
		
		
		}	
		
		
		
			/*To track Contact Us Button Clicks*/
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
			
			$answerhit->curr_address = "https://faq.beachbody.com/app/answers/detail/a_id/9909/~/customer-service-%26-coach-relations-contact-information/lob/".$path[$line_of_business+1];
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
			else if($mob == 0)//web interface
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
				else //if the button appears in chat launch or email page
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
		function recommended_channel_click_tracking($request_id, $member_id,$channel_id,$current_url)
		{
			$channel_tracking = new RNCPHP_CO\channel_tracking();
			$channel_tracking->member_type = $member_id;
			$channel_tracking->request = $request_id;			
			$path = explode("/", $current_url);
			$page = array_search('app', $path);
			$line_of_business = array_search('lob', $path);
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business"); 
			foreach($lobs as $items) 
			{
				if($items->LookupName == $path[$line_of_business+1])
				{
					$channel_tracking->line_of_business = $items;
				}
			} 
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
			{
				if($items->LookupName == $path[$page+1])
				{
					$channel_tracking->page_details = $items;
				}
			} 
			$recommended_channel = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\rec_channels");
			if(($member_id == 388)&&($request_id == 190))//Coach and Coach Cancel Account
			{
				foreach($recommended_channel as $items) 
				{
					if($items->ID == 11)
					{
						$channel_tracking->recommended_channel = $items;
						/*if($channel_id == 4)
						{*/
							$channel_tracking->selected_channel = $items;
						//}
					}
				} 
			}
			else
			{
				foreach($recommended_channel as $items) 
				{
					if($items->ID == $channel_id)
					{
						$channel_tracking->recommended_channel = $items;
						/*if($channel_id == 4)
						{*/
							$channel_tracking->selected_channel = $items;
						//}
					}
				} 
			}
			$channel_tracking->save();
			//echo "channel  ".$channel_tracking->recommended_channel." channel id is ".$channel_tracking->ID;
			//die("-----");
			return $channel_tracking->ID;			
		}
		
		function recommended_channel_click_tracking_update($record_id,$channel_id)
		{
			$channel_tracking = RNCPHP_CO\channel_tracking::fetch($record_id);
			
			$recommended_channel = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\rec_channels");
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
		
		/*To track Chat/Email Contact Us Button Clicks*/
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
		$CI = get_instance();
		$old_temp =  $CI->session->getSessionData('old_template_ratio');
		$template = new RNCPHP_CO\template_tracking();
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
				$var=($mob=="Y")? "Credit Card Update Click-Mob" : "Credit Card Update Click-Web";
			}
			if($clickType=='next')//click from next button in the popup
			{
				$var=($mob=="Y")? "Credit Card Update Open-Mob" : "Credit Card Update Open-Web";
			}
			if($clickType=='submit')//click from submit button in the popup
			{
				$var=($mob=="Y")? "Credit Card Update Submit-Mob" : "Credit Card Update Submit-Web";
			}
			
			
			$answerhit->clicked_link = (string)$var;  
			
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
		
		
		
	//=====NEW CHANGE IN ORDER STATUS.DATA FETCH USING WEB SERVICE CALL=== changed on 5/1/2018 	
		
	function getOrderStatusWS($data,$home_link,$mob)
	{
	
	if (function_exists('hash_hmac')) {
    echo "Available";
} else {
    echo "Not available";
}
	
	exit;
	
	
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
			$url="https://ow9hw5rtpk.execute-api.us-west-2.amazonaws.com/dev/getOrderStatus?order_id=$order_num&zip=$zip_code";
		}
		else if($order_num!="" && $zip_code!="")
		{
			$url="https://ow9hw5rtpk.execute-api.us-west-2.amazonaws.com/dev/getOrderStatus?order_id=$order_num&zip=$zip_code";
		}
		else if($email!="" && $zip_code!="")
		{
			$url= "https://ow9hw5rtpk.execute-api.us-west-2.amazonaws.com/dev/getOrderStatus?email=$email&zip=$zip_code";		
		}
				
		//==================WEB SERVICE FOR ORDER STATUS DATA FETCH==============================
		
					
	
		load_curl();
		$date = gmdate("D, d M Y G:i:s T");
		$AWSAccessKeyID= 'AKIAIV4KH3BTCPT3E6FA';
		$AWSSecretAccessKey= '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';
		
		$ch = curl_init('https://ow9hw5rtpk.execute-api.us-west-2.amazonaws.com/dev/getOrderStatus?order_id=1858337&zip=20783');
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . "AWS" + " " + $AWSAccessKeyID + ":" + Base64(HMAC-SHA1(UTF-8($date), UTF-8($AWSSecretAccessKey)))));
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: ' . 'AWS4-HMAC-SHA256 Credential=AKIAIV4KH3BTCPT3E6FA/20180105/us-west-2/execute-api/aws4_request, SignedHeaders=content-type;host;x-amz-date, Signature=9333ebefdc4e81424cb9ff65d6fa2036b2fed7348da5238ad9a1910cc2d81b10'));
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Amz-Date:' . $date));
		
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host:' . 'cloudfront.amazonaws.com'));
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:' . 'application/x-www-form-urlencoded'));
		$result=curl_exec($ch);
		curl_close($ch);
		print_r($result);
		
		exit;
		
		
		
		
		/// AWS API keys
		$aws_access_key_id = 'AKIAIV4KH3BTCPT3E6FA';
		$aws_secret_access_key = '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';
		
		// AWS region 
		$aws_region = 'us-west-2';
		// AWS file permissions
		$content_acl = 'authenticated-read';

		// Service name for S3
		$aws_service_name = 's3';
		
		// Content type of file. 
		$content_type = 'application/x-www-form-urlencoded';	
				
		
		// UTC timestamp and date
		$timestamp = gmdate('Ymd\THis\Z');
		$date = gmdate('Ymd');

		// HTTP request headers as key & value
		$request_headers = array();
		$request_headers['Content-Type'] = $content_type;
		$request_headers['Date'] = $timestamp;
		$request_headers['Host'] = $host_name;
		$request_headers['x-amz-acl'] = $content_acl;
		
		// Sort it in ascending order
		ksort($request_headers);

		// Canonical headers
		$canonical_headers = array();
		foreach($request_headers as $key => $value) {
			$canonical_headers[] = strtolower($key) . ":" . $value;
		}
		$canonical_headers = implode("\n", $canonical_headers);
				
		// Signed headers
		$signed_headers = array();
		foreach($request_headers as $key => $value) {
			$signed_headers[] = strtolower($key);
		}
		$signed_headers = implode(";", $signed_headers);
		
		// Cannonical request 
		$canonical_request = array();
		$canonical_request[] = "GET";
		$canonical_request[] = "";
		$canonical_request[] = $canonical_headers;
		$canonical_request[] = "";
		$canonical_request[] = $signed_headers;
		//$canonical_request[] = hash('sha256', $content);
		$canonical_request = implode("\n", $canonical_request);
		//$hashed_canonical_request = hash('sha256', $canonical_request);

		// AWS Scope
		$scope = array();
		$scope[] = $date;
		$scope[] = $aws_region;
		$scope[] = $aws_service_name;
		$scope[] = "aws4_request";
		
		// String to sign
		$string_to_sign = array();
		$string_to_sign[] = "AWS4-HMAC-SHA256"; 
		$string_to_sign[] = $timestamp; 
		$string_to_sign[] = implode('/', $scope);
		//$string_to_sign[] = $hashed_canonical_request;
		$string_to_sign = implode("\n", $string_to_sign);

		// Signing key
		/*$kSecret = 'AWS4' . $aws_secret_access_key;
		$kDate = hash_hmac('sha256', $date, $kSecret, true);
		$kRegion = hash_hmac('sha256', $aws_region, $kDate, true);
		$kService = hash_hmac('sha256', $aws_service_name, $kRegion, true);
		$kSigning = hash_hmac('sha256', 'aws4_request', $kService, true);

		// Signature
		$signature = hash_hmac('sha256', $string_to_sign, $kSigning);
		*/
		// Authorization
		
		$authorization ="AWS4-HMAC-SHA256 Credential=AKIAIV4KH3BTCPT3E6FA/20171023/us-web2.amazonaws.com";		
		
		
				
		// Curl headers
		$curl_headers =array();
		$curl_headers['Authorization']=$authorization;
		//$curl_headers = [ 'Authorization: ' . $authorization ];
		foreach($request_headers as $key => $value) {
			$curl_headers[] = $key . ": " . $value;
		}
		
		
		load_curl();
		//$dat = $request[0]; 
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dat);
		$output = curl_exec($ch);

	
		/*
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		$output=curl_exec($ch);
			*/
		var_dump($output);
		
		
		

exit;


		
		
		$i=0;
		$chk_order_no="";
		$j=0;//new logic
		while($row = $order->next())
		{ 
			if($j!=3)//new logic
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
						$j++;//new logic
					}
			}
				
		}
		 
		 
		
	 //==========================TRACK ORDER STATUS SEARCH (SUCCESS/ FAILURE COUNT)=====================
	
		
	
	 
	//===========================================================================================================
 
   //$orderA=json_encode($orderA);
 
	//print_r($orderA);
	
		return $orderA;
	
	}
	catch (Exception $err )
	{
		echo $err->getMessage();
		return false;
	}
	
	}	
		
		
	//Function to get order status using Custom object

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
			
			// $order = RNCPHP\ROQL::queryObject("SELECT CO.order_tracking_new FROM CO.order_tracking_new WHERE CO.order_tracking_new.order_number = //'$order_num' AND CO.order_tracking_new.zip_code='$zip_code' ORDER BY CO.order_tracking_new.CreatedTime DESC LIMIT 3")->next();
			
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
		$j=0;//new logic
		while($row = $order->next())
		{ 
			if($j!=3)//new logic
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
						$j++;//new logic
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
			
			/*$line_of_business = array_search('lob', $path);
			
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
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
	//-----------------------
		function recommended_channel_clicks($home_link,$channel)
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
			
			//$answerhit->curr_address = "https://fs6.formsite.com/beachbody/Genealogy/index.html";
			
			$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\line_of_business");
			foreach($lobs as $items) 
				{
					if($items->LookupName == $path[$line_of_business+1])
					{
						$answerhit->line_of_business = $items;
					}
				} 
			
			$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_4\\CO\\page_details");
			foreach($pages as $items) 
				{
					if($items->LookupName == $path[$page+1])
					{
						$answerhit->page_details = $items;
					}
				} 
				
			
			$answerhit->answer_view_action = "Recommended Channels";
			
			//$var = "Genealogy Change Request Form - Mobile";
			
			$answerhit->clicked_link = (string)$channel; 
			
			$answerhit->hits = "1";
			
			$answerhit->save();
			
		
		
		
		}
	
	
}