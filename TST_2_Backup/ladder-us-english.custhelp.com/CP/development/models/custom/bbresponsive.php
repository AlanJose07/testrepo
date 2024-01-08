<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class bbresponsive extends \RightNow\Models\Base {
    function __construct() {
        parent::__construct();
    }

    function get_answer_details($answer_list_id) {
	      
    try{
    $res = RNCPHP\ROQL::query( "SELECT Answer.Summary,Answer.Solution FROM Answer WHERE Answer.ID in(".$answer_list_id.")" )->next();
    $i=0;   
    $b=array();
    $c=array();
	if($res->count()>0){
    while($answer = $res->next()) {
     $a=array();
     array_push($a,$answer['Summary'],$answer['Solution']);
     $c[$i]=$a;
     $i++;
         } //while  
	 return $c;	 
     }//if
     else{
     return "null";
     }//else
	}//try 
	catch(Exception $e) {
  echo $e->getMessage();   
}   
    }
	
	//function to fetch category details
	function category_details_result($query)         
	{
	
	  try
	  {
	     
	   $res = RNCPHP\ROQL::queryObject($query)->next();
	   $i=0;
	   if($res->count()>0)
	   {
	       while($category = $res->next()) 
		   {
			 $cat[$i]['category_id']= $category->category->ID;
			 $cat[$i]['category_name']= addslashes(str_replace(" ","-",str_replace("/","_",trim($category->category->LookupName)))); 
			 $cat[$i]['category_name_with_hyphen']= addslashes(trim($category->category->LookupName)); //added due to CC-4412(Hyphen deffect)
			 $cat[$i]['visible_on_page_id']= $category->visible_on_page->ID; 
			 $cat[$i]['visible_on_page']= $category->visible_on_page->LookupName;
			 $cat[$i]['URL']= $category->URL;   
			 $cat[$i]['url_recommended']= $category->url_recommended->ID; 
			 //$cat[$i]['selfservice_form_path']= $category->self_service_form_link;
			 
			 if((empty($category->Directly_RTM->ID)) || ($category->Directly_RTM->ID=="2"))
			 {
			    $cat[$i]['DirectlyRTM']= "null";
			 }
			 else
			 {
			    $cat[$i]['DirectlyRTM']= $category->Directly_RTM->ID;	
			 }
			 
			 if((empty($category->Agent_Chat->ID)) || ($category->Agent_Chat->ID=="2"))
			 {
			    $cat[$i]['AgentChat']= "null";
			 }
			 else
			 {
			    $cat[$i]['AgentChat']= $category->Agent_Chat->ID;	
			 }
			 
			 if((empty($category->Email->ID)) || ($category->Email->ID=="2"))
			 {
			    $cat[$i]['Email']= "null";
			 }
			 else
			 {
			    $cat[$i]['Email']= $category->Email->ID;	
			 }
			 
			 if((empty($category->Self_Service_Form->ID)) || ($category->Self_Service_Form->ID=="2"))
			 {
			   $cat[$i]['SelfServiceForm']= "null";
			 }
			 else
			 {
			   $cat[$i]['SelfServiceForm']= $category->Self_Service_Form->ID;	
			 }
			 
			 if((empty($category->Phone->ID)) || ($category->Phone->ID=="2"))
			 {
			   $cat[$i]['Phone']= "null";
			 }
			 else
			 {
			   $cat[$i]['Phone']= $category->Phone->ID;	
			 }
			 
			 if((empty($category->facebook->ID)) || ($category->facebook->ID=="2"))
			 {
			   $cat[$i]['Facebook']= "null";
			 }
			 else
			 {
			    $cat[$i]['Facebook']= $category->facebook->ID;	
			 }
			 
			
			 if(empty(trim($category->answer_report_id)))   
			 {
			    $cat[$i]['answer_report']="0";
			 }  
			 else
			 {
			    $cat[$i]['answer_report']= trim($category->answer_report_id);
			 }
			 
			 if(empty(trim($category->text_field)))   
			 {
			    $cat[$i]['text']="null";
			 }  
			 else
			 {
			    $cat[$i]['text']= trim($category->text_field);
			 }
			 
			 $cat[$i]['enable']= $category->enable; 
			 $cat[$i]['sub_category']=$category->sub_category;
			 
			 $i++; 
		   } //while 
		   return $cat;
	   }
	   else
	   {
	       return 0;
	   }
	  
	  }
	  catch(Exception $e)
	  {
	    echo $e->getMessage();
	  }
	     
	}
	
	function channel_details_result($query)
	{
	  
	  try
	  {
	  	  $contact = get_instance()->model('Contact')->get()->result;
		  $contacttype = $contact->ContactType->ID; // 2 - customer  1 - Coach
		  $parentcategory = getUrlParm('TLP');
		  $parentcategory = explode(".",$parentcategory);
		  $parentcategory = trim($parentcategory[0]); 
		  
		  $res = RNCPHP\ROQL::queryObject($query)->next();
		  $i=0;
		  $self_service_form_link_path="null";
		  $self_service_form_title="null";
		  $self_service_form_icon="null";
		  $self_service_form_description="null";
		  $email_description="null";
		  $email_sla="null";
		 /* The below code is to make the contact channel label and image configurable through message base
		 	CUSTOM_MSG_CALL_US

			CUSTOM_MSG_CHAT_WITH_AGENT

			CUSTOM_MSG_ASK_AN_EXPERT

			CUSTOM_MSG_EMAIL_US

			CUSTOM_MSG_FACEBOOK_MESSENGER
          ------------------------------Lijo George ----------------------------------------------------*/

		  $data = RNCPHP\ROQL::query( "SELECT ID, Value FROM MessageBase WHERE ID in(1000060,1000061,1000062,1000063,1000064,1000069)")->next();
		   
		   if($data->count()>0)
	   {
		   while($ContactChannelLabelImage = $data->next()) 
		   {

		   	if($ContactChannelLabelImage['ID']=='1000061')
		   	 {
                 $messagebase['ChatWithAnAgent']=$ContactChannelLabelImage['Value'];
		   	 }
			  
 		    if($ContactChannelLabelImage['ID']=='1000060')
		   	 {
                 $messagebase['CallUs']=$ContactChannelLabelImage['Value'];
		   	 }

		   	 if($ContactChannelLabelImage['ID']=='1000062')
		   	 {
                 $messagebase['AskAnExpert']=$ContactChannelLabelImage['Value'];
		   	 }
		   	  if($ContactChannelLabelImage['ID']=='1000063')
		   	 {
                 $messagebase['EmailUs']=$ContactChannelLabelImage['Value'];
		   	 }
		   	 if($ContactChannelLabelImage['ID']=='1000064')
		   	 {
                 $messagebase['FacebookMessenger']=$ContactChannelLabelImage['Value'];
		   	 }
			 if($ContactChannelLabelImage['ID']=='1000069')
		   	 {
                 $messagebase['SMS']=$ContactChannelLabelImage['Value'];
		   	 }	
 				
 				
		   	
		   }

	   }

	   /* The above code is to make the contact channel label and image configurable through message base
           ------------------------------Lijo George ----------------------------------------------------*/
		  if($res->count()>0)
	   {
		   while($channel = $res->next()) 
		   {
		     if($channel->Directly_RTM->ID==3 || $channel->Agent_Chat->ID==3 || $channel->Email->ID==3 || $channel->Phone->ID==3 || $channel->Self_Service_Form->ID==3 || $channel->facebook->ID==3 ||$channel->SMS->ID==3)
			 {
				  if($channel->Directly_RTM->ID==3)
				  {
					$showchannels["recommend_".$i]="Ask an expert"; 
					//$display_label_image["r-1527"]=$channel->ask_image_label;
					$display_label_image["1527"]=$messagebase['AskAnExpert'];
					$display['7']['1527'] = 'Ask an expert';
					$display['7']['order'] = ""; 
					$i++;
				  }
				 
				  if($channel->Agent_Chat->ID==3)
				  {
					$showchannels["recommend_".$i]="Chat with an agent";
					//$display_label_image["r-1529"]=$channel->chat_image_label;
                    $display_label_image["1529"]=$messagebase['ChatWithAnAgent'];
					$display['7']['1529'] = 'Chat with an agent';
					$display['7']['order'] = "";
					$chathours = $this->CI->model('custom/chathours')->getChatHours("chat");
					$display['7']['available'] = $chathours; 
					$i++;
				  }
				  
				  if($channel->Email->ID==3)
				  {
					$showchannels["recommend_".$i]="Email us";
					//$display_label_image["r-1530"]=$channel->email_image_label;
					$display_label_image["1530"]=$messagebase['EmailUs'];
					$display['7']['1530'] = 'Email us';
					$display['7']['order'] = ""; 
					$email_description = $channel->Email_Description;
					$email_sla = $channel->EmailSLA;
					$i++;
				  }
				  
				  if($channel->Phone->ID==3)
				  {
					$showchannels["recommend_".$i]="Call us";
					//$display_label_image["r-1531"]=$channel->call_image_label;
					$display_label_image["1531"]=$messagebase['CallUs'];
					$display['7']['1531'] = 'Call us';
					$display['7']['order'] = ""; 
					$chathours = $this->CI->model('custom/chathours')->getChatHours("phone");
					$display['7']['available'] = $chathours;
					$i++;
				  }
				 
				   if($channel->Self_Service_Form->ID==3)  
				  {
					$showchannels["recommend_".$i]="Self-service form";
					$self_service_form_link_path=$channel->self_service_url;
					$self_service_form_title = $channel->self_service_title;
					$self_service_form_icon = $channel->self_service_icon;
					$self_service_form_description = $channel->self_service_description;
					$display['7']['1528'] = 'Self-service form';
					$display['7']['order'] = ""; 
					$i++;
				  }
				  
				  if($channel->facebook->ID==3)  
				  {
					$showchannels["recommend_".$i]="Facebook messenger";
					$display_label_image["1532"]=$messagebase['FacebookMessenger'];
					$display['7']['1532'] = 'Facebook messenger';
					$display['7']['order'] = "";
					$chathours = $this->CI->model('custom/chathours')->getChatHours("facebook");
					$display['7']['available'] = $chathours; 
					//$display_label_image["r-1532"]=$channel->fb_image_label;
					$i++;
				  }
				  
				  if($channel->SMS->ID==3)  
				  {
					$showchannels["recommend_".$i]="SMS";
					$display_label_image["1621"]=$messagebase['SMS'];
					$display['7']['1621'] = 'SMS';
					$display['7']['order'] = "";
					$chathours = $this->CI->model('custom/chathours')->getChatHours("sms");
					$display['7']['available'] = $chathours; 
					$i++;
				  }
				  
			 }//end if...when any of the channel is recommended
			 
			    if($channel->Directly_RTM->ID==1)
				  {
					$showchannels["display_".$i]="Ask an expert";
					//$display_label_image["d-1527"]=$channel->ask_image_label;
					$display_label_image["1527"]=$messagebase['AskAnExpert'];
					$display['1']['1527'] = 'Ask an expert';
					if(!empty($channel->Display_Order_Directly_RTM))
					$display['1']['order'] = $channel->Display_Order_Directly_RTM; 
					else
					$display['1']['order'] = 7;
					$i++;
				  }
				  if($channel->Agent_Chat->ID==1)
				  {
					$showchannels["display_".$i]="Chat with an agent";
					//$display_label_image["d-1529"]=$channel->chat_image_label;
					$display_label_image["1529"]=$messagebase['ChatWithAnAgent'];
					$display['0']['1529'] = 'Chat with an agent';
					if(!empty($channel->Display_Order_Agent_Chat))
					$display['0']['order'] = $channel->Display_Order_Agent_Chat; 
					else
					$display['0']['order'] = 4;
					$chathours = $this->CI->model('custom/chathours')->getChatHours("chat");
					$display['0']['available'] = $chathours;
					$i++;
				  }
				  if($channel->Email->ID==1)
				  {
					$showchannels["display_".$i]="Email us";
					//$display_label_image["d-1530"]=$channel->email_image_label;
					$display_label_image["1530"]=$messagebase['EmailUs'];
					$display['2']['1530'] = 'Email us';
					if(!empty($channel->Display_Order_Email))
					$display['2']['order'] = $channel->Display_Order_Email; 
					else
					$display['2']['order'] = 6;
					$email_description = $channel->Email_Description;
					$email_sla = $channel->EmailSLA;
					$i++;
				  }
				   if($channel->Phone->ID==1)
				  {    
					$showchannels["display_".$i]="Call us";
					//$display_label_image["d-1531"]=$channel->call_image_label;
					$display_label_image["1531"]=$messagebase['CallUs'];
					$display['3']['1531'] = 'Call us';
					if(!empty($channel->Display_Order_Phone))
					$display['3']['order'] = $channel->Display_Order_Phone;
					else
					$display['3']['order'] = 5;
					$chathours = $this->CI->model('custom/chathours')->getChatHours("phone");
					$display['3']['available'] = $chathours;
					$i++;
				  }
				  if($channel->Self_Service_Form->ID==1)
				  {
					$showchannels["display_".$i]="Self-service form";
					$self_service_form_link_path=$channel->self_service_url;
					$self_service_form_title = $channel->self_service_title;
					$self_service_form_icon = $channel->self_service_icon;
					$self_service_form_description = $channel->self_service_description;
					$display['4']['1528'] = 'Self-service form';
					if(!empty($channel->Display_Order_Self_Service_for))
					$display['4']['order'] = $channel->Display_Order_Self_Service_for; 
					else
					$display['4']['order'] = 1;
					$i++;
				  }
			      if($channel->facebook->ID==1)  
				  {
					$showchannels["display_".$i]="Facebook messenger";
					//$display_label_image["d-1532"]=$channel->fb_image_label;
					$display_label_image["1532"]=$messagebase['FacebookMessenger'];
					$display['5']['1532'] = 'Facebook messenger';
					if(!empty($channel->Display_Order_facebook))
					$display['5']['order'] = $channel->Display_Order_facebook; 
					else{
					 	if(empty($contacttype)){ // not signed in 
							if($parentcategory == '1704') // coach business tile
								$display['5']['order'] = 2;
							else
								$display['5']['order'] = 3; 	
						}else{ // signed in
							if($contacttype == 1)
								$display['5']['order'] = 2;
							else
								$display['5']['order'] = 3;	
						}
					}
					$chathours = $this->CI->model('custom/chathours')->getChatHours("facebook");
					$display['5']['available'] = $chathours;
					$i++;
				  }
				  if($channel->SMS->ID==1)  
				  {
					$showchannels["display_".$i]="SMS";
					//$display_label_image["d-1532"]=$channel->fb_image_label;
					$display_label_image["1621"]=$messagebase['SMS'];
					$display['8']['1621'] = 'SMS';
					if(!empty($channel->Display_Order_SMS))
					$display['8']['order'] = $channel->Display_Order_SMS; 
					else{
					 	if(empty($contacttype)){ // not signed in 
							if($parentcategory == '1704') // coach business tile
								$display['8']['order'] = 3;
							else
								$display['8']['order'] = 2; 	
						}else{ // signed in
							if($contacttype == 1)
								$display['8']['order'] = 3;
							else
								$display['8']['order'] = 2;	
						}
					}
					$chathours = $this->CI->model('custom/chathours')->getChatHours("sms");
					$display['8']['available'] = $chathours;	
					$i++;
				  }
				  
				  if(empty(trim($channel->text_field)))   
				  {
					$no_channel_display_text="null";
				  }  
				  else
				  {
					$no_channel_display_text= trim($channel->text_field);
				  }
			  
			                       
		   }//end while
		   //echo "<pre>";
		   //$showchannels = ['recommend_0' => 'Self-service form',   'display_1' => 'Chat with an agent','display_2' => 'Facebook messenger','display_3' => 'Call us'];
		   //print_r($showchannels);
		   $complete_channel_details[0]=$self_service_form_link_path;
		   $complete_channel_details[1]=$showchannels;
		   $complete_channel_details[2]=$no_channel_display_text;
		   $complete_channel_details[3]=$ch_id;
		   $complete_channel_details[4]=$display_label_image;
		   $complete_channel_details[5]=$display;
		   $complete_channel_details[6]=$self_service_form_title;
		   $complete_channel_details[7]=$self_service_form_icon;
		   $complete_channel_details[8]=$self_service_form_description;
		   $complete_channel_details[9]=$email_description;
		   $complete_channel_details[10]=$email_sla;
		   return $complete_channel_details;
		   
	   }//end if...count >0
	   else
	   {
	       return 0; 
	   }//ens else...count not greater than 0
	  }//end try
	  catch(Exception $e)
	  {
	     echo $e->getMessage();
	  }//end catch
	}//end channel_details_result()
	
	//function to fetch product details
	function get_products($query)
	{
		
	//initConnectAPI('OSC_NICE', 'Yatebr2H'); 
	
		try
		{
			$res = RNCPHP\ROQL::queryObject($query)->next();
			$i=0;
			if($res->count()>0)
			{
				 while($products=$res->next())
				 {
					
					$id_selfservice= $products->ID;
					$product[$i]['product_id']= $products->products->ID;
					$product[$i]['product_name']= $products->products->LookupName;
					$product[$i]['visible_on_page_id']= $products->visible_on_page->ID;
					$product[$i]['content_type_id']= $products->content_type->ID;
					$product[$i]['content_type_name']= $products->content_type->LookupName;
					$product[$i]['content']= $products->content;
					$product[$i]['visible_on_page_name']= $products->visible_on_page->LookupName;
					$product[$i]['image_name']= $products->image_name;
					if(empty(trim($products->tool_tip_message))) 
					{
					  $product[$i]['tool_tip']= "null";
					}
					else
					{
					  $product[$i]['tool_tip']= $products->tool_tip_message;
					} 
					
						
					/*$Entity = RNCPHP\BB\self_service_product::fetch($id_selfservice);
					for($j = 0; $j <= (count($Entity->FileAttachments) - 1); $j++)
					{
						
						$url = $Entity->FileAttachments[$j]->getAdminURL();
						if(!empty($url))
						{
							$product[$i]['icon_image']=$url;
						}
					} */
					
					$i++;
				 }
				 return $product;
			}
			else
			{
				return false;
			}  
		}
		catch(Exception $e)
		{
			echo "ERROR->".$e->getMessage();
		}
	}
	function click_tracking($url, $mobile, $clicked_link,$cat_id,$ans_view)
	{
	    //die("---------");
		$category_id = intval($cat_id);
		$answerhit = new RNCPHP_CO\answer_hits();
		
		if($cat_id != 0)
		{
			$answerhit->Category = RNCPHP\ServiceCategory::fetch($cat_id);
		}
		
		//$answerhit->curr_address = $home_link;
		//$answerhit->curr_address = (string)$url;
		//====================ORDER STATUS/CREDIT CARD UPDATE added on 4/19/2018================================
		
		$url_home_pos= strpos( $url, "home" );
		$url_ansdetail_pos=strpos( $url, "detail" );//for answer detail page [by jithin]
		$category_details="From Home Page";
		
		$order_status_pos=strpos( $clicked_link, "Check Order Status" );
		
		$update_credit_card_pos=strpos( $clicked_link, "Update Credit Card" );
		
		
		
		if($url_home_pos=="")//not from home page.so need to save category details
		{
			
			function get_string_between($string, $start, $end)
			{
				$string = " ".$string;
				$ini = strpos($string,$start);
				if ($ini == 0) return "";
				$ini += strlen($start);   
				$len = strpos($string,$end,$ini) - $ini;
				return substr($string,$ini,$len);
			}
	
				$fullurl = $url;
				$child_category = get_string_between($fullurl, "catname/", "/a_id");
				$parent_position=strpos($fullurl,"TLP/");
				$parent_category= substr($fullurl,$parent_position);
				$parent_category=explode(".",$parent_category);
				$parent_category=str_replace("-"," ",$parent_category[1]);
				$child_category=str_replace("-"," ",$child_category);
				
				$category_details=$parent_category."/".$child_category;// constructing category details variable 
				
				//click tracking for answer[by jithin]
				/*if($url_ansdetail_pos!=="")
				{
				   $answerhit->context1=intval($clicked_link);
				}*/
				
				//click tracking for answer[by jithin]
			
				
		
		}
		
		//====================ORDER STATUS/CREDIT CARD UPDATE added on 4/19/2018================================	
		
		
		
		
		
		$answerhit->prev_address = (string)$url;
		$path = explode("/", $url);
		
		$page = array_search('app', $path);
		
		/*if($path[$page+1] == "home")
		{
			//$answerhit->context3 =  new RNCPHP\NamedIDLabel();
    		$answerhit->context3->ID = RNCPHP_CO\page_details ::fetch(1);
		}
		else if($path[$page+1] == "contactus" || $path[$page+1] == "contactus_sub_level")
		{
			//$answerhit->context3 =  new RNCPHP\NamedIDLabel();
    		$answerhit->context3->ID = RNCPHP_CO\page_details ::fetch(0);
		}*/
		
		if($path[$page+1] == "answers")
		{ 
			$page_name = $path[$page+1]."/".$path[$page+2];
			
			//enter into this condition in the answer detail page[by jithin]
			
			if($url_ansdetail_pos!=="")
			{
			  $answerhit->page_details = RNCPHP_CO\page_details ::fetch($page_name);
			}
			//enter into this condition in the answer detail page[by jithin]
			
		}
		else
		{ 
			$page_name = $path[$page+1];
		}
		if($url_ansdetail_pos!=="")
		{
			$a_id_pos = array_search('a_id', $path);
			$a_id = intval($path[$a_id_pos+1]);
			if($a_id)
			{
				$answerhit->context1=intval($a_id);
			}
		}
		/*die("--------".$ans_view); */
		$answerhit->context5=intval($ans_view);
		
		//------------Added by Vimal to fix path error--app/
			if($url_ansdetail_pos=="")
			{
				if($path[4]!="")
				{
				
				$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);
				}
				else
				{
				$answerhit->page_details = RNCPHP_CO\page_details ::fetch('home');
				}
			}
			
		//--------------------------------------------------------------
		
		//$answerhit->page_details = RNCPHP_CO\page_details ::fetch($path[$page+1]);//Old line --Commennted By Vimal on 5/13/2018	
		
		//die("$url-----$mobile---$clicked_link");
		/*if($mobile == 1)
		{*/
			$answerhit->answer_view_action = $clicked_link;
			$answerhit->clicked_link = (string)$clicked_link;
			//enter into this condition when the contact us button is in the answer detail page[by jithin]
			if($url_ansdetail_pos!=="" and $clicked_link=="Contact Us")
			{
			   
			   $answerhit->clicked_link = $clicked_link;/*"Contact Us - ".*/
			   $answerhit->context4 = 1;
			}
			else
			{
				//$answerhit->context4 = 0;
			}
			//enter into this(above) condition when the contact us button is in the answer detail page[by jithin]
		/*}
		else
		{
			$answerhit->answer_view_action = $clicked_link;
			$answerhit->clicked_link = (string)$clicked_link;   
			
			//enter into this condition when the contact us button is in the answer detail page[by jithin]
			if($url_ansdetail_pos!=="" and $clicked_link=="Contact Us")
			{
			   $answerhit->clicked_link = "Contact Us - ".$clicked_link;
			}
			//enter into this(above) condition when the contact us button is in the answer detail page[by jithin]
		}*/
		
		//save category details only for Order status and Credit Card Update
		if( ($order_status_pos!="") || ($update_credit_card_pos!="") )
		{
			$answerhit->category_details = (string)$category_details;
		}
	
		
		//if($mobile)
		$answerhit->user_agent = RNCPHP_CO\user_agent ::fetch($mobile);	
		$answerhit->hits = "1";
		$answerhit->save();
		//echo $answerhit->ID;
	}
	
	function save_seleted_category_for_email($a,$category_id)
	{
	  try{
			$incident = RNCPHP\Incident::fetch($a);
			$incident->Category = RNCPHP\ServiceCategory::fetch($category_id);
			$incident->save();
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();   
		}
		
		return 0;
		 
	}
	
	function save_seleted_category_for_fb($a,$category_id,$action)
	{
	  try{
	  		if($action == 'id')
			{
			$incident = RNCPHP\Incident::fetch($a);
			$incident->Category = RNCPHP\ServiceCategory::fetch($category_id);
			//$incident->CustomFields->c->form_routing = 1562;
			$incident->StatusWithType->Status = 3;
			$incident->save();
			return $incident->ID;
			}
			if($action == 'refno')
			{ 
			$incident = RNCPHP\Incident::fetch($a);
			return $incident->ReferenceNumber;
			}
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();  
			logmessage($e->getMessage()); 
		}
		
		return 0;
		 
	}
	
	function sms($a,$category_id,$action,$phone,$contactid)
	{
	  try{
	  		if($action == 'id')
			{
			$incident = RNCPHP\Incident::fetch($a);
			//$incident->Category = RNCPHP\ServiceCategory::fetch($category_id);
			//$incident->CustomFields->c->form_routing = 1562;
			//$incident->save();
			
			$contact = RNCPHP\Contact::fetch($contactid);	 //18300386  //18300378
			$contact->Phones = new RNCPHP\PhoneArray();
			$flag = 2;
	 for($i=0;$i<sizeof($contact->Phones);$i++)
	  {
	  
	  		if($contact->Phones[$i]->PhoneType->LookupName == 'Mobile Phone')
			{
				$flag = 1;
				$contact->Phones[$i] = new RNCPHP\Phone();
				$contact->Phones[$i]->PhoneType = new RNCPHP\NamedIDOptList();
				$contact->Phones[$i]->PhoneType->LookupName = 'Mobile Phone';
				$contact->Phones[$i]->Number = $phone;
				$contact->save();
				
			}	
	   
	  }
	  if($flag == 2)
	  {
	  			$contact->Phones[0] = new RNCPHP\Phone();
				$contact->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
				$contact->Phones[0]->PhoneType->LookupName = 'Mobile Phone';
				$contact->Phones[0]->Number = $phone;
				$contact->save();
	  }
			
			return $incident->ID;
			}
			if($action == 'refno')
			{ 
			$incident = RNCPHP\Incident::fetch($a);
			return $incident->ReferenceNumber;
			}
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();  
			logmessage($e->getMessage()); 
		}
		
		return 0;
		 
	}
	
	function fetchauthorizeduser($a)
	{
	  
			$Contact = RNCPHP\Contact::fetch($a);
			return $Contact;
			 
	}
	
	function save_private_note_for_coach($a,$signature)
	{
	  try{
			$incident = RNCPHP\Incident::fetch($a);
			$incident->Threads = new RNCPHP\ThreadArray();
            $incident->Threads[0] = new RNCPHP\Thread();
            $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
            $incident->Threads[0]->EntryType->ID = 1; // See Thread object for definition
            $incident->Threads[0]->ContentType = new RNCPHP\NamedIDOptList();
            $incident->Threads[0]->ContentType->ID = 2; //HTML
            $incident->Threads[0]->Text = $signature;
            $incident->save(RNCPHP\RNObject::SuppressAll);
			
			
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();   
		}
		
		return 0;
		 
	}
	
	function FetchRefNo($a)
	{
	  try{
	  		
			$incident = RNCPHP\Incident::fetch($a);
			return $incident->ReferenceNumber;
			
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();  
			logmessage($e->getMessage()); 
		}
		
		return 0;
		 
	}
	
	function get_enabled_category($category_id,$contactus_support)
	{
	$flag = 1;
	//echo "--- ".$category_id."----- ";
	  try
	  {
		  if(is_numeric($category_id))
			{
					$baseQuery="SELECT SC.ID,SC.LookupName, SC.Parent 
								FROM ServiceCategory SC 
								WHERE SC.ID =".$category_id;
					
					$cat =  RNCPHP\ROQL::query($baseQuery)->next();
					$category = $cat->next();
					$catParentIdFirst=$category["Parent"];	
					
					//echo " ".$catParentIdFirst." ";	
					if($catParentIdFirst!="")
					{
					
						
							
											if($contactus_support == "contactus_support" || $contactus_support == "contactus_sub_level"){
												$visible_on_page_parent = "contactus_sub_level";
											}
											if($contactus_support == "gethelp" || $contactus_support == "answersdetaila_idcatidcatnmeTLP"){
												$visible_on_page_parent = "gethelp";
											}
											$enable = "SELECT bbb.enable 
												   FROM BB.categ_contact_ladder bbb 
												   WHERE bbb.category.ID=".$category_id." 
												   and bbb.visible_on_page.LookupName='".$visible_on_page_parent."'";
										//echo $enable;
								
										$enable1 =  RNCPHP\ROQL::query($enable)->next();
										$enable2 = $enable1->next();
										//echo $enable2['enable'];
										if($enable2['enable'] != 1)
										{
										   // echo $category_id;
											//echo "--in12--";
											 
											$flag = 2;
											 
											return $flag;
										}
										else
										{
										 //echo "--else--";
										   $flag = 1;
										   $result = $this->get_enabled_category($catParentIdFirst,$contactus_support);
										   
										   if($result == 2)
											  return $result ;
											
											
										}	
									
									
								
									
									
					}
					
					
					
					else
					{
					// If No sublevel categories. appear in contactus page and directly clicked to contactus_support page.
					
					if($contactus_support == "contactus_support" || $contactus_support == "contactus_sub_level"){
						$visible_on_page_primary = "contactus";
					}elseif($contactus_support == "gethelp" || $contactus_support == "answersdetaila_idcatidcatnmeTLP"){
						$visible_on_page_primary = "home";
					}else{
						$visible_on_page_primary = "contactus";
					}
					
					$enable = "SELECT bbb.enable 
												   FROM BB.categ_contact_ladder bbb 
												   WHERE bbb.category.ID=".$category_id." 
												   and bbb.visible_on_page.LookupName='".$visible_on_page_primary."'";
					$enable1 =  RNCPHP\ROQL::query($enable)->next();
					$enable2 = $enable1->next();				
								   
									if($enable2['enable'] == 1)
										{
											$flag = 1;
											
										}
										else
										{
											$flag = 2;
										}						   
					
					}
					
					return $flag;
			}
			else
			{
				$url = "/app/pagenotfound";
				header('Location: ' . $url);
			}
	  }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();   
		}
		

		 
	}
  function update_contact_with_value_from_IDM($a,$data,$field_name)		
	{		
	  		
			$Contact = RNCPHP\Contact::fetch($a);		
			if($field_name == "role"){		
			$Contact->CustomFields->c->member_type = $data;		
			}		
			if($field_name == "rank"){		
			$Contact->CustomFields->c->lifetime_rank = $data;		
			}		
			$Contact->save();		
			 		
	}
	
	function bblivecategory($category_id)
	{
	$flag = 1;
	//echo "--- ".$category_id."----- ";
	  try
	  {
	    $baseQuery="SELECT SC.ID,SC.LookupName, SC.Parent 
					FROM ServiceCategory SC 
					WHERE SC.ID =".$category_id;
		
		$cat =  RNCPHP\ROQL::query($baseQuery)->next();
		$category = $cat->next();
		$catParentIdFirst=$category["Parent"];
		
		//echo " ".$catParentIdFirst." ";	
		if($catParentIdFirst!="")
		{
			if($catParentIdFirst == 1706)
			{
				$flag = 2;
				return $flag;
			}
			
			else
			{
			   $flag = 1;
			   $result = $this->bblivecategory($catParentIdFirst);
			   
			   if($result == 2)
				  return $result ;
				
				
			}
		}
		
		
		return $flag;
	  }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();   
		}
		

		 
	}
	
	function UADMappingProduct($category_id)
	{
	  try
	  {
	    $baseQuery="Select Product from UAD.UAD_Action_Mapping where UAD.UAD_Action_Mapping.Category.ID =".$category_id;
		
		$pro =  RNCPHP\ROQL::query($baseQuery)->next();
		$product = $pro->next();
		
		return $product; 
	  }
	  catch(Exception $e)  
	  {  
		echo "ERROR->".$e->getMessage();   
	  }
		

		 
	}
	
	function remove_bookmarked_url($category_id,$page)
	{
	  try
	  {
	  	if($page == "contactus_support" || $page == "answers"){
		
		if($page == "answers"){
	    $baseQuery="Select answer_report_id from BB.categ_contact_ladder where BB.categ_contact_ladder.category.ID =".$category_id." and BB.categ_contact_ladder.visible_on_page.ID != 3 and BB.categ_contact_ladder.visible_on_page.ID != 4";
		}
		
	  	if($page == "contactus_support"){
	    $baseQuery="Select answer_report_id from BB.categ_contact_ladder where BB.categ_contact_ladder.category.ID =".$category_id." and BB.categ_contact_ladder.visible_on_page.ID != 1 and BB.categ_contact_ladder.visible_on_page.ID != 2";
		}
		if(is_numeric($category_id))
		{
			$pro =  RNCPHP\ROQL::query($baseQuery)->next();
			$product = $pro->next();
			return $product; 
		}
		else
		{
					$url = "/app/pagenotfound";
					header('Location: ' . $url);
		}
	  }
	 }
	  
	  catch(Exception $e)  
	  {  
		echo "ERROR->".$e->getMessage();   
	  }
		

		 
	}
	
	function fb_status_update($ref_no)
	{
	  try{
			$incident = RNCPHP\Incident::fetch($ref_no);
			$incident->StatusWithType->Status = 1;
			$incident->save();
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();  
			logmessage($e->getMessage()); 
		}	 
	}
	
	function setchatskill($catid)
	{
	  
	  try
	  {
	  	$query="select BB.categ_contact_ladder from BB.categ_contact_ladder where BB.categ_contact_ladder.category.ID=".$catid." and BB.categ_contact_ladder.interface.ID=34 and BB.categ_contact_ladder.visible_on_page.ID in(3,4)"; 
	  	$res = RNCPHP\ROQL::queryObject($query)->next();
		if($res->count()>0)
	   	{
		   while($channel = $res->next()) 
		   {
		   	 if(!empty($channel->chat_skill_id)){
			 	$chatskill = $channel->chat_skill_id;
			 }
			}
		}	 
		return $chatskill;
	  }
	  catch(Exception $e)
	  {
	     echo $e->getMessage();
	  }
	  
	  
	}
	
	function FetchIncidentID($a)
	{
	  try{
	  		
			$incident = RNCPHP\Incident::fetch($a);
			return $incident->ID;
			
			
	     }
	  catch(Exception $e)  
		{  
			echo "ERROR->".$e->getMessage();  
			logmessage($e->getMessage()); 
		}
		
		return 0;
		 
	}
	
	function ip_check($ip)
	{
	  
	  try
	  {
		  $country_code = '';
		  logmessage($ip);

	  	$query="select BB.ip_country_mapping from BB.ip_country_mapping where ".$ip." between BB.ip_country_mapping.ip_start and BB.ip_country_mapping.ip_end"; 
	  	$res = RNCPHP\ROQL::queryObject($query)->next();
		if($res->count()>0)
	   	{
		   while($channel = $res->next()) 
		   {
			   logmessage($channel);
		   	//echo $channel->ID." ip_start:".$channel->ip_start." ip_end:".$channel->ip_end." Country:".$channel->country_code;
			//echo " ";
				$country_code = $channel->country_code;
				$CI = &get_instance();
				$CI->session->setSessionData(array('ip_check' => $country_code));
			
			}
		}	 
		logmessage($country_code);
		return $country_code;
	  }
	  catch(Exception $e)
	  {
	     echo $e->getMessage();
	  }
	  
	  
	}
	
	/*function getsessiondata()
	  {
	   $CI = get_instance();
		
	return $CI->session->getSessionData('formdata');
	
		
	  } */
	
  
	
}