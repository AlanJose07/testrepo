<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_2 as RNCPHP;
class CustomObjectData extends \RightNow\Models\Base {
    function __construct() {
        parent::__construct();
		 if(function_exists('curl_init') === false){
									load_curl();
								}
    }
	function fetchSpecialFeatureData() {
		//initConnectAPI('OSC_NICE', 'Yatebr2H'); 
		$rows = RNCPHP\ROQL::query( "SELECT * FROM BB.special_feature s WHERE s.enable = 1 and s.interface = 30 order by display_order_spc" )->next();
		$i=0;
		while($row = $rows->next())
		{
			//echo "type:".$row['Type'];// All the time - 32 and Between a range of dates - 2
			$flag = true;
			
			if($row['Type'] == 2){
				$current_time = date("Y-m-d H:i");  //get current date and time
				$start_date = $row['from_date'];
				$end_date = $row['to_date'];
				
				if(strtotime($current_time)<= strtotime($end_date) && strtotime($current_time)>= strtotime($start_date)){
					$flag = true;
				}else{
					$flag = false;
				}
			
			}
			
			if($flag){
			if($row['Section'] == 2){ // Trending
				$rows_url = RNCPHP\ROQL::query( "select * from BB.sp_feature_trending where BB.sp_feature_trending.special_feature = ".$row['ID']." order by display_order")->next();
				$constructed_string = $row['spf_description'];
				$rows_url->count();
				while($row_url = $rows_url->next()){
					//echo "<pre>";
					//print_r($row_url);
					$constructed_string = $constructed_string.'<br><a href="'.$row_url['URL'].'" target="_blank">'.$row_url['title'].'</a>';
				}
			$result[$i]['Desc'] = $constructed_string;
			}else{
				$result[$i]['Desc'] = $row['description'];
			
			}
			$result[$i]['Title'] = $row['title'];
			$result[$i]['Link_Label'] = $row['link_label'];
			$result[$i]['Link_Url'] = $row['link_url'];
			$result[$i]['image_name'] = $row['image_name'];
			if($row['position'] == "1")
			{
				$result[$i]['Position'] = "left";
			}
			else if($row['position'] == "2")
			{
				$result[$i]['Position'] = "right";
			}
			else if($row['position'] == "3")
			{
				$result[$i]['Position'] = "middle";
			}
			else
			{
				$result[$i]['Position'] = "left";
			}
			/*$Entity = RNCPHP\BB\special_feature::fetch($row['ID']);
			for($j = 0; $j <= (count($Entity->FileAttachments) - 1); $j++)
			{
				
				$url = $Entity->FileAttachments[$j]->getAdminURL();
				if(!empty($url))
				{
					$result[$i]['Url'] = $url;
				}
			}*/
			$Entity = RNCPHP\BB\special_feature::fetch($row['ID']); 
			for($j = 0; $j <= (count($Entity->FileAttachments)-1); $j++)
			{
				$url='';
				$type = $Entity->FileAttachments[$j]->ContentType;		
				$fileattachment_id = $Entity->FileAttachments[$j]->ID;
				
				$key = 'OSC_NICE';
        		$secret = 'Yatebr2H'; 
				$url = "https://".$_SERVER['HTTP_HOST']."/services/rest/connect/v1.3/BB.special_feature/".$row['ID']."/FileAttachments/".			$fileattachment_id."/data";
				//echo $url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$content = (curl_exec($ch));
		
        if (curl_error($ch)) {
		$error_msg = curl_error($ch);
		}
		//print_r($error_msg);
		//echo "<pre>";
		//echo $content;exit;
		$content = explode('"data": ',$content);
	    $content = rtrim($content[1]);
		$content = substr($content, 1, -3);		
		curl_close($ch);			
				
				if(!empty($url))
				{
					$result[$i]['Url'] = $content;
					$result[$i]['Image_type'] = $type;
				}
				
				
			} 	
			$i++;
		}
	}	
		return $result;
	}
	
	function fetchShadowpopup($url) {
		//initConnectAPI('OSC_NICE', 'Yatebr2H');
		$shadow_url = RNCPHP\ROQL::query( "select shadow_popup, ID from BB.url_mapping where BB.url_mapping.URL ='".$url."' and shadow_popup.interface = 30 and shadow_popup.enable = 1 LIMIT 1" )->next()->next();
		if(!empty($shadow_url['shadow_popup'])){
		$rows = RNCPHP\ROQL::query( "SELECT * FROM BB.shadow_popup s WHERE ID =".$shadow_url['shadow_popup'])->next();
		$i=0;
		while($row = $rows->next())
		{
		
		//print_r($row);
		$result = $row; 
		$result['cookie_id'] = $shadow_url['ID'];	
			$Entity = RNCPHP\BB\shadow_popup::fetch($row['ID']); 
			for($j = 0; $j <= (count($Entity->FileAttachments)-1); $j++)
			{
				$url='';
				$type = $Entity->FileAttachments[$j]->ContentType;		
				$fileattachment_id = $Entity->FileAttachments[$j]->ID;
				
				$key = 'OSC_NICE';
        		$secret = 'Yatebr2H'; 
				$url = "https://".$_SERVER['HTTP_HOST']."/services/rest/connect/v1.3/BB.shadow_popup/".$row['ID']."/FileAttachments/".$fileattachment_id."/data";
				//echo $url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$content = (curl_exec($ch));
		
        if (curl_error($ch)) {
		$error_msg = curl_error($ch);
		}
		//print_r($error_msg);
		//echo "<pre>";
		//echo $content;exit;
		$content = explode('"data": ',$content);
	    $content = rtrim($content[1]);
		$content = substr($content, 1, -3);		
		curl_close($ch);			
				
				if(!empty($url))
				{
					$result['Url'] = $content;
					$result['Image_type'] = $type;
				}
				
				
			}
			  
		}
		
		return $result;
	}
}	
	
    function get_answer_details($catid) {
	      
    try{
    $res = RNCPHP\ROQL::query( "SELECT Answer.Summary,Answer.ID,Answer.Solution,Answer.UpdatedTime FROM Answer WHERE Answer.ID in(393,394,395,396,397,398,399,400,401,402,403,404,405,406,407)" )->next();
          
    $i=0;   
    $b=array();
    $c=array();
	if($res->count()>0){
    while($answer = $res->next()) {
     $a=array();
     array_push($a,$answer['Summary'],$answer['ID'],"null","null");
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
			 $cat[$i]['category_name']= $category->category->LookupName;
			 $cat[$i]['visible_on_page_id']= $category->visible_on_page->ID; 
			 $cat[$i]['visible_on_page']= $category->visible_on_page->LookupName;   
			 $cat[$i]['selfservice_form_path']= $category->self_service_form_link;
			 if($category->Directly_RTM->ID==null || $category->Directly_RTM->ID=="" || $category->Directly_RTM->ID=="null")
			 {$cat[$i]['DirectlyRTM']= "null";}
			 else{$cat[$i]['DirectlyRTM']= $category->Directly_RTM->ID;}
			 if($category->Agent_Chat->ID==null || $category->Agent_Chat->ID=="" || $category->Agent_Chat->ID=="null")
			 {$cat[$i]['AgentChat']= "null";}
			 else{$cat[$i]['AgentChat']= $category->Agent_Chat->ID;}
			 if($category->Email->ID==null || $category->Email->ID=="" || $category->Email->ID=="null")
			 {$cat[$i]['Email']= "null";}
			 else{$cat[$i]['Email']= $category->Email->ID;}
			 if($category->Self_Service_Form->ID==null || $category->Self_Service_Form->ID=="" || $category->Self_Service_Form->ID=="null")
			 {$cat[$i]['SelfServiceForm']= "null";}
			 else{$cat[$i]['SelfServiceForm']= $category->Self_Service_Form->ID;}
			 if($category->Phone->ID==null || $category->Phone->ID=="" || $category->Phone->ID=="null")
			 {$cat[$i]['Phone']= "null";}
			 else{$cat[$i]['Phone']= $category->Phone->ID;}
			 $cat[$i]['answer_report']= $category->answer_report_id;     
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
		  $res = RNCPHP\ROQL::queryObject($query)->next();
		  $i=0;
		  if($res->count()>0)
	   {
		   while($channel = $res->next()) 
		   {
		     if($channel->Directly_RTM->ID==3 || $channel->Agent_Chat->ID==3 || $channel->Email->ID==3 || $channel->Phone->ID==3 || $channel->Self_Service_Form->ID==3)
			 {
				  if($channel->Directly_RTM->ID==3)
				  {
					$showchannels["recommend_".$i]="Ask an expert";
					$i++;
				  }
				 
				  if($channel->Agent_Chat->ID==3)
				  {
					$showchannels["recommend_".$i]="Chat with an agent";
					$i++;
				  }
				  
				  if($channel->Email->ID==3)
				  {
					$showchannels["recommend_".$i]="Email us";
					$i++;
				  }
				  
				  if($channel->Phone->ID==3)
				  {
					$showchannels["recommend_".$i]="Call us";
					$i++;
				  }
				 
				   if($channel->Self_Service_Form->ID==3)  
				  {
					$showchannels["recommend_".$i]="Self-service form";
					$i++;
				  }
				  
				  if($channel->facebook_messenger->ID==3)  
				  {
					$showchannels["recommend_".$i]="Facebook messenger";
					$i++;
				  }
				  
			 }//end if...when any of the channel is recommended
			 
			    if($channel->Directly_RTM->ID==1)
				  {
					$showchannels["display_".$i]="Ask an expert";
					$i++;
				  }
				  if($channel->Agent_Chat->ID==1)
				  {
					$showchannels["display_".$i]="Chat with an agent";
					$i++;
				  }
				  if($channel->Email->ID==1)
				  {
					$showchannels["display_".$i]="Email us";
					$i++;
				  }
				   if($channel->Phone->ID==1)
				  {    
					$showchannels["display_".$i]="Call us";
					$i++;
				  }
				  if($channel->Self_Service_Form->ID==1)
				  {
					$showchannels["display_".$i]="Self-service form";
					$i++;
				  }
			      if($channel->facebook_messenger->ID==1)  
				  {
					$showchannels["recommend_".$i]="Facebook messenger";
					$i++;
				  }
			  
			                       
		   }//end while
		   return $showchannels;
		   
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
	
	function answer_details_result($query)
	{
	  try{
	  $res = RNCPHP\ROQL::query($query)->next();
	  if($res->count()>0)
	  {
	     while($answer=$res->next())
		 {
		    return $answer['LookupName'];
		 }
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
	}//end of answer_details_result()   
	
	
	//function to fetch product details
	function get_products($query)
	{
		
	initConnectAPI('testbb', 'rightnow@123');
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
						
					$Entity = RNCPHP\BB\self_service_product::fetch($id_selfservice);
					for($j = 0; $j <= (count($Entity->FileAttachments) - 1); $j++)
					{
						
						$url = $Entity->FileAttachments[$j]->getAdminURL();
						if(!empty($url))
						{
							$product[$i]['icon_image']=$url;
						}
					} 
					
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
	
	function chat_error_log()		
	{
	$error_log = new RNCPHP\ORN_NiceLog\Nice_Error_Log();
	$error_log->ReportName = "Blank chat";
	$error_log->LogTime = "FR Canada Interface";
	$error_log->Remarks = json_encode($_POST);
	$contact = get_instance()->model('Contact')->get()->result;
	$error_log->Incident = $contact->Emails[0]->Address;
	$error_log->save(RNCPHP\RNObject::SuppressAll);
	}
	
}