<?php

namespace Custom\Controllers;
use RightNow\Connect\v1_2 as RNCPHP;
class AjaxCustom extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }
	
	/**
     * Perform a search action on a report. Expects the report ID to execute, as well as filters and formatting options
     * to apply to the report.
     * @return string Results from running report
     */
    public function getReportData()
    {
        $filters = $this->input->post('filters');
        $filters = json_decode($filters);
        $filters = (is_object($filters))
            ? get_object_vars($filters)
            : array();
        if($filters['search'] == 1)
            $this->model('Report')->updateSessionforSearch();
        $format = $this->input->post('format');
        $format = json_decode($format);
        $format = is_object($format)
            ? get_object_vars($format)
            : array();

        $reportID = $this->input->post('report_id');
        $reportToken = $this->input->post('r_tok');
	 	$results = $this->model('custom/custom_report_model')->getDataHTML($reportID, $reportToken, $filters, $format)->result;
       
		/*
         * This request cannot be cached because not all rules that define how the page is rendered are in the POST data:
         * User search preferences, such as the number of results per page, are stored in the contacts table.
         * The Ask a Question tab may be hidden if the user has not searched enough times.
         * The user's profile is updated when they do a search.
         */
        echo json_encode($results);
    }
	
	   
	public function Agent_getReportData()
    {
        $filters = $this->input->post('filters');
        $filters = json_decode($filters);
        $filters = (is_object($filters))
            ? get_object_vars($filters)
            : array();
        if($filters['search'] == 1)
            $this->model('Report')->updateSessionforSearch();
        $format = $this->input->post('format');
        $format = json_decode($format);
        $format = is_object($format)
            ? get_object_vars($format)
            : array();

        $reportID = $this->input->post('report_id');
        $reportToken = $this->input->post('r_tok');
		$this->load->model('custom/Agent');
	 	$results = $this->model('custom/Agent')->getDataHTML($reportID, $reportToken, $filters, $format)->result;
       
		
        echo json_encode($results);
    }
	
// ajax call from MultiLineStandardText
	function getstdText()
	{
		$key=$this->input->post('stText');
		$this->load->model("custom/language_model"); 
		$results = $this->model('custom/language_model')->stdTextSearch($key);
		if(!empty($results))
		{
		 echo '<div id="result_data"  style="width: 100%;">';
            
          
                    foreach($results as $result)
                    {
                        $title=$result['Title'];
                        $content=$result['Content'];
						$id=$result['Id']; 
						$hotkey=$result['Hotkey'];
						$folder=$result['Folder'];
                            echo '<div id="loop">';
                            echo '<div id="title">';
                            echo $title;
							echo '   :   <font color="#00CFC5">'.$hotkey.'</font><br>';
							echo '</div><br>';
                            echo '<div id="content">';
                            echo $content.'<br>';
							echo 'Folder: '.$folder.'<br>';
							echo "Id: ".$id.'<br>';
                            echo '</div><br>';
                            echo '</div>';
                       
					}
		
		echo '</div>';
		
			//echo json_encode($results);
		
		}
		else
		{
			echo '<div id="result_data"  style="width: 100%;">';
            echo '</div>';
		}
		
	}
	
	function setcount()
	{
		$session_id = $this->input->post('s_id');
		$session_id=trim($session_id);
		$chatid=$this->input->post('chatid');
		$CI = get_instance();
		$email=$this->input->post('emailid');
		$email=trim($email);
		$CI->load->model("standard/Contact");
		$cid=$CI->Contact->lookupContactByEmail($email,NULL,NULL);
		set_time_limit(10000);  
		$this->load->model("custom/language_model"); 
		$results = $this->model('custom/language_model')->setDisconnect($session_id,$chatid,$cid->result);
		return $results;
	}
	function guidedetails()
	{
		$agent = $this->input->post('agent');
		$guide=$this->input->post('guide');
		$name=$this->input->post('name');
		$CI = get_instance();
		$this->load->model("custom/language_model"); 
		$results = $this->model('custom/language_model')->setguideusage($agent,$guide,$name);
		return $results;
	}
	function qa_selected()
	{
	
		$agent = $this->input->post('agent');
		$name=$this->input->post('name');
		$questionID=$this->input->post('questionID');
		$responseValue=$this->input->post('responseValue');
		$ses=$this->input->post('ses');
		$u_id=$this->input->post('u_id');
		$st_time=$this->input->post('st_time');
		if($st_time=="")
		$st_time="";
		$CI = get_instance();
		$this->load->model("custom/language_model"); 
		$results = $this->model('custom/language_model')->qa_response($agent,$name,$questionID,$responseValue,$u_id,$ses,$st_time);
		return $results;
	}
	
	function setsession()
	{
	    $session_id = $this->input->post('s_id');
		
		$email=$this->input->post('emailid');
		$chatid=$this->input->post('chatid');
		$email=trim($email);
		$chatid=trim($chatid);
		$CI = get_instance();
		$CI->load->model("standard/Contact");
		$cid=$CI->Contact->lookupContactByEmail($email,NULL,NULL);
		$cid = $this->model('custom/language_model')->setSession($cid->result,$session_id,$chatid);
		return $cid;
	}
	// ajax call from MultiLine 3 when answer has been expanded
    function set_answer_view()
	{
	    
    	$answerID = $this->input->post('a_id');
        $CI = &get_instance();
		$CI->load->model("standard/Answer");   
		$answer = RNCPHP\Answer::fetch($answerID);
	    $answerSummary = $answer->Summary; 
		$sessionID = $CI->session->getSessionData('sessionID');
        $contactID = $CI->session->getProfileData('c_id');
        $action = '/' . \RightNow\Hooks\ClickstreamActionMapping::getAction('answer_view');
		$CI->load->model("standard/Clickstream");
		$Array = [$sessionID, $contactID, CS_APP_EU, $action, $answerID, $answerSummary, NULL];
		$CI->Clickstream->insertAction($sessionID, $contactID, CS_APP_EU, $action, $answerID, $answerSummary, NULL);	
	
	}
	
	 function set_answer_viewbyprod()
	 {
	    $answerID = $this->input->post('a_id');
		$prod=$this->input->post('prodid'); 
		$CI=&get_instance();
		$sessionID = $CI->session->getSessionData('sessionID');
		$this->model('custom/language_model')->set_answer_viewbyprod($answerID,$prod,$sessionID);
        
	
	 }
	 
	  function getsnowissues()
	{
	
		$url = "https://gogo.service-now.com/api/now/table/kb_knowledge?number=KB0010162";
 	load_curl();
	
			$ch = curl_init();
			
        	curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Basic '. base64_encode("cloudapi:Welcome1!")));
			curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($ch);
			$response=json_decode($response);
			$res=$response->result;
			$fin_res=$res[0]->text;
			print_r($fin_res);
		   return $fin_res;
	}
	
	function gettails()
	{
	$owner=$_POST['owner'];
	$partner=$_POST['partner'];
	
	$CI = get_instance();
	$this->load->model("custom/language_model"); 
    $tail=$CI->model('custom/language_model')->getpartnerowner($owner,$partner);
	$cnt=count($tail);
	for($i=0;$i<$cnt;$i++)
	{
	echo $tail[$i];
	echo ",";
	}
	
	return $tail;
	}
	function gettailsnew()
	{
		$owner=$_POST['owner'];
		$partner=$_POST['partner'];
		
		$CI = get_instance();
		$this->load->model("custom/language_model"); 
		$tail=$CI->model('custom/language_model')->getpartnerowner($owner,$partner);
		$cnt=count($tail);
		
		$setdata = "";
		for($i=0;$i<$cnt;$i++)
		{
			$setdata .= $tail[$i]."#";
		}
		
		echo $setdata;exit;
	}
	  function SearchCO($key)
	{
		
		$this->load->model("custom/language_model"); 
		$ans = $this->model('custom/language_model')->getCO($key);
		$i=0;
		$cnt=count($ans[0]);
		for($i=0;$i<$cnt;$i++)
                    {
                       
                        $fault=$ans[0][$i];
						$i=$i+1;
                        $url=$ans[0][$i];
                        $i=$i+1;
                        $code=$ans[0][$i];
						$i=$i+1;
                        $task=$ans[0][$i];
                        if(!empty($fault))
                        {
                            
                            echo '<div id="title" id="title" >';
							$fault='<a class="underline" href="'.$url.'" target="_blank" style="color:#FF0000;font-size:18px;text-decoration: none;border-bottom: 1px solid blue;font-weight:bold;">'.$fault.'</a>';
                            echo $fault.'<br>';
                            echo '</div>';
                            echo '<div id="content" id="content" style="color:#5a5a5a;margin-top:4px;">';
							echo "Fault Code:".$code.'<br>';
							echo "Task Number:".$task.'<br>';
                            echo '</div><br>';
                            echo '</div>';
                           
                        }
                         }
		return $ans;
	}
	 
	function getsnowdetails()
	{
		$keyword = $this->input->post('keyword');
		
		//check if keyword is a tailnumber via API
		if($keyword!=null)
		{
			$url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?name=".$keyword;	
			$response = $this->getdatafromAPI($url);	
			$initialresponse = json_decode($response, true);
			//print_r($initialresponse);exit;
			if(!empty($initialresponse["result"]))
			{
				$tail_exists=1;
			}else {
				
				$url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?u_nose_number=".$keyword;
				$response = $this->getdatafromAPI($url);
				$initialresponse = json_decode($response, true);
				if(!empty($initialresponse))
				{	
					$tail_exists=0;
				}
				
			}
			if(empty($initialresponse["result"])){
				$url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?u_serial_no_=".$keyword;
				$response = $this->getdatafromAPI($url);
				$initialresponse = json_decode($response, true);
			}	
			
			if(!empty($initialresponse))
			{
				//$response=$initialresponse;
				$response=json_decode($response);
				$res=$response->result;
				$re=array();
			}
		}
		if(count($res)>1)
		{
			for($i=0;$i<count($res);$i++)
			{
				$owner=$res[$i]->u_owner;				
				$airline=$res[$i]->u_airline;
				$nose=$res[$i]->u_nose_number;
				$tail=$res[$i]->name;
				$aircraft=$res[$i]->u_aircraft_type;
				$aircraft=str_replace(' ','',$aircraft);
				$acstatus=$res[$i]->u_aircraft_status;
				$decomm=$res[$i]->u_decommission_date;
				//$aline = $res[$i]->u_operator;
				$tech = $res[$i]->u_access_technology_code;
				$serialNo =	$res[$i]->u_serial_no_;
				$videoCapability =	$res[$i]->u_video_capability;
				
				if($owner=="")
					$owner=" ";
				if($airline=="")
					$airline=" ";
				if($nose=="")
					$nose=" ";
				if($acstatus=="")
					$acstatus=" ";
				if($decomm=='0001-01-01')
					$decomm="NA1";
				if($serialNo == '')
					$serialNo = "NA";
				if($vedioCapability == ''){
					$vedioCapability = "NA";
				}
	//				array_push($re,$owner,"/",$airline,"/",$nose,"/",$tail,"/",$aircraft,"/");
				array_push($re,$owner,"/",$airline,"/",$nose,"/",$tail,"/",$aircraft,"/",$acstatus,"/",$decomm,"/",$tech,"/",$serialNo,"/",$videoCapability,"/");
			}
			
			foreach($re as $r)
			{
			
				echo $r;
				
			}
			
				
		}
		else
		{
				
			$owner=$res[0]->u_owner;
			$airline=$res[0]->u_airline;
			$nose=$res[0]->u_nose_number;
			$tail=$res[0]->name;
			$aircraft=$res[0]->u_aircraft_type;
			$aircraft=str_replace(' ','',$aircraft);
			$acstatus=$res[0]->u_aircraft_status;
			$decomm=$res[0]->u_decommission_date;				
			//$aline = $res[0]->u_operator;
			$tech = $res[0]->u_access_technology_code;
			$serialNo =	$res[0]->u_serial_no_;
			$videoCapability =	$res[0]->u_video_capability;
			if($decomm=='0001-01-01')
				$decomm='NA';
			if($serialNo == '')
				$serialNo = "NA";
			if($vedioCapability == '')
				$vedioCapability = "NA";
			
			//array_push($re,$owner,'-',$airline,'-',$nose,'-',$tail,'-');
	//				echo $owner."/".$airline."/".$nose."/".$tail."/".$tail_exists."/".$aircraft;
			echo $owner."/".$airline."/".$nose."/".$tail."/".$tail_exists."/".$aircraft."/".$acstatus."/".$decomm."/".$tech."/".$serialNo."/".$videoCapability;
		}
		
				
		return $re;
	}
	
	function getdatafromAPI($url)
	{
			if (!function_exists("curl_init"))
			{
			load_curl();
			}
			$ch = curl_init();
        	curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Basic '. base64_encode("cloudapi:Welcome1!")));
			curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($ch);
			curl_close($ch);
			return $response;
	}
	// Stores the feedback into a custom object ( when feedback is "No")
    function set_feedback()
	{	
	
    	$answerID = $this->input->post('a_id'); 
        $CI = &get_instance(); 
		$rating = $this->input->post('rate');
        $message = $this->input->post('message');
        $contactID = $CI->session->getProfileData('c_id');
		$results = $this->model('custom/language_model')->setFeedback($answerID, $contactID, $rating, $message);	
		if($results){
		    
            echo json_encode(array('ID' => $results->ID));
            return;
        }	
	    echo json_encode(Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
	}
	
	/**
     * Answer rating request. Takes the answer ID, rating and options count and rates the answer via the Answer model and stores the feedback into a custom object (when feedback is "yes" )
     */
    function submitRating()
    {
        echo json_encode(1); // No need to wait for API call before responding
		$CI = &get_instance(); 
		$contactID = $CI->session->getProfileData('c_id');
		$message = NULL;
        $answerID = $this->input->post('a_id');
        $rating = $this->input->post('rate');
        $scale = $this->input->post('options_count');
        if($answerID){
            $this->model('Answer')->rate($answerID, $rating, $scale);
			
			
        }
		
		if($rating == 2)
		{
		   $this->model('custom/language_model')->setFeedback($answerID, $contactID, $rating, $message);
		}
    }
	
	// Stores the feedback into a custom object ( When feedback is "No" and the message is null)
	
	function cancelButton()
    {
	     
        echo json_encode(1); // No need to wait for API call before responding
		$answerID = $this->input->post('a_id');
		$CI = &get_instance(); 
		$contactID = $CI->session->getProfileData('c_id');
		$message = NULL;
        $rating = 1;
		$this->model('custom/language_model')->setFeedback($answerID, $contactID, $rating, $message);
		
    }
	
	function getapidetails()
	{
		$regnumber = null;
		$regnumber = $_POST['regnumber'];
		$regnumber = 'N102HQ';
		if($regnumber)
		{

			/*$url = "https:ww.";
			
			\load_curl();
			$ch = curl_init();
        	curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			
            $response = curl_exec($ch);
			if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			echo $error_msg;exit;
			}

			$response=json_encode($response);
			echo $response;exit; */
		}
		
	}
	function set_feedback_internal(){
		
		$contact_id=$this->session->getProfileData('contactID');
		$keyword = $this->input->post('key');
		$message = $this->input->post('message');
		
		if($contact_id && $keyword!=null && $message!=null)
		{
			$data = $this->model('custom/language_model')->setcustomkeywordfeedback($contact_id, $keyword, $message);
			echo $data;exit;
		}
		
	}
	
	function getpartmovement()
	{
	$keyword = $this->input->post('keyword');
	$this->load->model("custom/language_model"); 
	$tail = $this->model('custom/language_model')->tailexist($keyword);
	if($tail[0]!== null)
	{
		$tail_exists=1;
        $url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?active=true&name=".$keyword;
	}
	else
		$url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?active=true&u_nose_number=".$keyword;
 	load_curl();
	
			$ch = curl_init();
			
        	curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Basic '. base64_encode("cloudapi:Welcome1!")));
			curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($ch);
			$response=json_decode($response);
			$res=$response->result;
			$re=array();
			if(count($res)>1)
			{
			/*for($i=0;$i<count($res);$i++)
			{
				$owner=$res[$i]->u_owner;
				
				$sysid=$res[$i]->sys_id;
				//if($sysid=="")
				//$sysid=" ";
				//$part_value=getpartmovementvalue($sysid);
				//array_push($re,$owner,"/",$airline,"/",$nose,"/",$tail,"/",$aircraft,"/");
				//array_push();
				
			}
			foreach($re as $r)
			{
			
			echo $r;
			}*/
			
			}
			else
			{
			
				$sysid=$res[0]->sys_id;
				if($sysid=="")
				$sysid=" ";
				//$sysid='7e58e3ef89819a405960f78b8ebc7568';
				//fetching the main partmovement
				$ch_p = curl_init();
				curl_setopt($ch_p,CURLOPT_URL, "https://gogo.service-now.com/api/now/table/u_parts_movements?sysparm_query=active=true^ORDERBYDESCsys_created_on");
				curl_setopt($ch_p,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Basic '. base64_encode("cloudapi:Welcome1!")));
				curl_setopt($ch_p,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch_p,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($ch_p,CURLOPT_USERAGENT ,'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
				curl_setopt($ch_p, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch_p, CURLOPT_SSL_VERIFYHOST, 0);
				$response_part = curl_exec($ch_p);
				$response_part=json_decode($response_part);
				$res_new=$response_part->result;
				//content array defined
				$content_values=array("u_part_off" => array("u_serial_no"),"u_part_on" => array("u_serial_no"),"u_incident" => array("number","u_tail_number"),"u_rma" => array("u_rma"));
				$links_required=array("u_part_off","u_part_on","u_incident");
				$link_array=array();
				$main_content_array=array();
				$final_data=array();
				$k=0;
				for($i=0;$i<count($res_new);$i++)
				{
					$link_array=array();
					$main_content_array=array();					
					$sysid_part=$res_new[$i]->u_configuration_item->value;
					if($sysid==$sysid_part)
					{	//adding main content to json
						$main_content_array["u_part_off_description"]=$res_new[$i]->u_part_off_description;
						$main_content_array["u_part_on_description"]=$res_new[$i]->u_part_on_description;
						$main_content_array["u_rma"]=$res_new[$i]->u_rma;
						$main_content_array["u_date"]=$res_new[$i]->u_date;	
						$main_content_array["sys_updated_on"]=$res_new[$i]->sys_updated_on;					
						for($j=0;$j<count($links_required);$j++)
						{
							//adding link based data
							$value_link=$res_new[$i]->$links_required[$j]->link;
							$link_array[$links_required[$j]]=$value_link;	
						}
						if (!empty($link_array)) 
						{
							//the link variables which we require
							foreach ($content_values as $key => $value)
							{
								//the link got from API
								foreach ($link_array as $links => $link_value)
								{
									$final_value=array();
									if($key==$links)
									{
										//calling function to pass link and get data
										$response=$this->get_value($value,$link_value);
										if (!empty($response)) {
										foreach($response as $response_key => $response_value)
										{
											//adding values of response of link to main content
											$final_value[$response_key]=$response_value;
									
										}
								
										}
										//add all the link values to main content
										$main_content_array[$key]=$final_value;
									}
						
								}
					
							}
						}
						$final_data[$k]=$main_content_array;
						$k++;
					}
				
				}
				
				if (!empty($final_data)) 
				{
					//passing final data to script
					echo json_encode($final_data);
				}	
			}
			
		    return $re;
	}
	
	function get_value($value,$link_value)
	{
			$link_values_array = array();
			$li = curl_init();
			curl_setopt($li,CURLOPT_URL, $link_value);
			curl_setopt($li,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Authorization: Basic '. base64_encode("cloudapi:Welcome1!")));
			curl_setopt($li,CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($li,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($li,CURLOPT_USERAGENT ,'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($li, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($li, CURLOPT_SSL_VERIFYHOST, 0);
			$response_link = curl_exec($li);
			$response_link=json_decode($response_link,true);
			$link_values_array=$response_link['result'];
			if(!empty($link_values_array))
			{
			foreach($link_values_array as $linked => $val)
			{
				if(array_search($linked,$value) === false)
				{
					unset($link_values_array[$linked]);
				}
			}
			}
			return $link_values_array;
	}
	
	
}
