<?php
namespace Custom\Models;
require_once(get_cfg_var("doc_root")."/include/ConnectPHP/Connect_init.phph");
initConnectAPI();
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;

class language_model extends \RightNow\Models\Base
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
         *                  //$CI->model('custom/Sample')->sampleFunction();EN
         */
    }
	
	//sss
	function getCurrentLanguage()
	{
		$overrideflag=0;
		if (strpos($_SERVER['REQUEST_URI'], "chat_launch") !== false || strpos($_SERVER['REQUEST_URI'], "chat_landing") !== false){
			$overrideflag=1;
			
			}
			
		$domains = array("care.inflightinternet.com", "carejp.inflightinternet.com", "carefr.inflightinternet.com", "caresp.inflightinternet.com", "carept.inflightinternet.com","careyue.inflightinternet.com","carecmn.inflightinternet.com");
		
		$CI = get_instance();
		// Cookie issue Config setting stored in session
		$cookieExpireOnUrl  = RNCPHP\Configuration::fetch("CUSTOM_CFG_URL_BASED_END_USER_SESSION_COOKIE_EXIPIRE")->Value; // 1:Enable 0:Disable
		$cookieExpireState = ["Disable","Enable"];
		$CI->session->setSessionData(array('USER_SESSION_COOKIE_EXIPIRE'=>array()));
		$CI->session->setSessionData(array('USER_SESSION_COOKIE_EXIPIRE'=>$cookieExpireState[$cookieExpireOnUrl]));
		$uri_string = $CI->uri->uri_string();
		$enc_str = "";
		//Getting url parameters from session
		if($CI->session->getSessionData('USER_SESSION_COOKIE_EXIPIRE') == "Enable"){
			if(getUrlParm('tailNumber')){
				//Getting url parameters from session
				$all_param= $CI->session->getSessionData('urlParameters');
			}
			else{
				$CI->session->setSessionData(array(flightNumber =>null,flightOrigin =>null,flightDestination=>null,tailNumber=>null,macAddress=>null,uxdId=>null,deviceId=>null,urlParameters=>array(),clang=>"", enc_str=>""));
				$CI->session->setSessionData(array('urlParameters'=>array()));	
				$all_param = array();
			}	
		}
		else{
			$all_param= $CI->session->getSessionData('urlParameters');
		}
		
		
		$all_parameters= array();
		foreach($all_param as $array) {
 			foreach($array as $k=>$v) {
    			$all_parameters[$k][] = $v;
 	    }
	    }
		if(array_key_exists('c', $all_parameters))
		{
			if(is_array($all_parameters['c']))
			{
			  
				$category = "/c/".end($all_parameters['c']);
				
			}
			else
			{
				$category = "/c/".$all_parameters['c'];
				
			}
			
		}		
		

		if(array_key_exists('flightNumber', $all_parameters))
		{
			if(is_array($all_parameters['flightNumber']))
			{
				$flightNumber = "/flightNumber/".end($all_parameters['flightNumber']);
				
			}
			else
			{
				$flightNumber = "/flightNumber/".$all_parameters['flightNumber'];
				
			}
		}
		if(array_key_exists('tailNumber', $all_parameters))
		{
			if(is_array($all_parameters['tailNumber']))
			{
				$tailNumber = end($all_parameters['tailNumber']);
			}
			else
			{
			$tailNumber = $all_parameters['tailNumber'];
			}
		}
		
		$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
		$flgtNo=$res_aline[0];
		$cururl=$_SERVER['REQUEST_URI'];
		if($flgtNo=="CPA")
		{
			if ((strpos($cururl,'agent')=== false) && (strpos($cururl,'answers') === false) && (strpos($cururl,'utils') === false) && (strpos($cururl,'account') === false))
			{
			$theme="/euf/assets/themes/cathay";
			$CI = get_instance();
			$CI->themes->setTheme($theme);
			}
			 
		}
		else
		{
			
			if ((strpos($cururl,'agent')=== false) && (strpos($cururl,'answers') === false) && (strpos($cururl,'utils') === false) && (strpos($cururl,'account') === false))
			{
			$theme="/euf/assets/themes/standard";
			$CI = get_instance();
			$CI->themes->setTheme($theme);
			}
			
			
		}
		
		if(array_key_exists('flightOrigin', $all_parameters))
		{
			if(is_array($all_parameters['flightOrigin']))
			{
				$flightOrigin = "/flightOrigin/".end($all_parameters['flightOrigin']);
			}
			else
			{
				$flightOrigin = "/flightOrigin/".$all_parameters['flightOrigin'];
			}
		}
		
		if(array_key_exists('flightDestination', $all_parameters))
		{
			if(is_array($all_parameters['flightDestination']))
			{
				$flightDestination = "/flightDestination/".end($all_parameters['flightDestination']);
			}
			else
			{
				$flightDestination = "/flightDestination/".$all_parameters['flightDestination'];
			}
		}
		if(array_key_exists('tailNumber', $all_parameters))
		{
			if(is_array($all_parameters['tailNumber']))
			{
				$tailNumber = "/tailNumber/".end($all_parameters['tailNumber']);
			}
			else
			{
				$tailNumber = "/tailNumber/".$all_parameters['tailNumber'];
			}
		}
		
		if(array_key_exists('macAddress', $all_parameters))
		{
			if(is_array($all_parameters['macAddress']))
			{
				$macAddress = "/macAddress/".end($all_parameters['macAddress']);
			}
			else
			{
				$macAddress = "/macAddress/".$all_parameters['macAddress'];
			}
		}

		
		
		 if(array_key_exists('clang', $all_parameters))
		{
		
			if(is_array($all_parameters['clang']))
			{
				$clang = "/clang/".end($all_parameters['clang']);
			}
			else
			{
				$clang = "/clang/".$all_parameters['clang'];
			}
		
		}
	
		/*Airline Template-Start*/
		if(array_key_exists('deviceId', $all_parameters))
		{
			if(is_array($all_parameters['deviceId']))
			{
				$deviceid = "/deviceId/".end($all_parameters['deviceId']);
			}
			else
			{
				$deviceid = "/deviceId/".$all_parameters['deviceId'];
			}
		}
		if(array_key_exists('uxdId', $all_parameters))
		{
			if(is_array($all_parameters['uxdId']))
			{
				$uxdid = "/uxdId/".end($all_parameters['uxdId']);
			}
			else
			{
				$uxdid = "/uxdId/".$all_parameters['uxdId'];
			}
		}
		/*Airline Template-End*/
		/*Airline Template-Start (including deviceid and uxdid parameters)*/
		$enc_str =  $category."".$flightNumber."".$flightOrigin."".$flightDestination."".$tailNumber."".$macAddress."".$deviceid."".$uxdid."".$clang;
		
		 //Include deviceid and uxdid parameters;
		/*Airline Template-End*/
//setting session with  category and all flight parameters
		$CI->session->setSessionData(array('enc_str' => $enc_str));

		
		
		$redirecturl = getUrlParm('redirect');
		
		
		if(getUrlParm('clang')||getUrlParm('lang'))   // Check the Country parameter
		{	
		$CI->session->setSessionData(array('clang' =>getUrlParm('clang')));
		 if(!getUrlParm('tog'))
		  {
			$CI->session->setSessionData(array('clang' =>getUrlParm('clang')));
			if(getUrlParm('clang'))
		    $country = getUrlParm('clang');
			
			else
			$country = getUrlParm('lang');
			 		    
			$check = strpos($country, 'ja');
			if (!($check === false ))
			{	
			
			$par=$_SERVER['REQUEST_URI'];
			$l=getUrlParm('l');
			
			if($l==="1"){	
			  $par=str_replace("/clang/ja_JP", "/clang/en_US", $par);
			  $par=str_replace("/l/1", "", $par);
			   // Change done
				header ("Location:  https://care.inflightinternet.com".$par);
				exit;
			
				}	
				else
				{
				if((!getUrlParm('je')) && $overrideflag!=1)
				{
 			    header ("Location: https://carejp.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
				exit;
			  }
				}
				
			}
			$check_fr = strpos($country, 'fr');
			if (!($check_fr === false))
			{
			 if(!getUrlParm('la'))
			 {
				header ("Location: https://carefr.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
				exit;
			 }
			}
			
			$check_pt = strpos($country, 'pt_BR');
			if (!($check_pt === false))
			{
			   $par=$_SERVER['REQUEST_URI'];
			   $pg=getUrlParm('pg');
			   if($pg==="1"){	
			   $par=str_replace("/clang/pt_BR", "", $par);
			   $par=str_replace("/pg/1", "", $par);
			   header ("Location:  https://care.inflightinternet.com/app/chat/chat_launch".$par);
			   exit;
				}
			    
				else
				{
				if(!getUrlParm('la'))
				{ 
				header ("Location: https://carept.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
				exit;
				} 
				}
				}
			$check_zh_cn = strpos($country, 'zh_CN');
			if (!($check_zh_cn === false))
			{	
//				if($flgtNo!="DAL" && $overrideflag!=1)
				if($overrideflag!=1)
				{	    
				header ("Location: https://carecmn.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
				exit;
				}
			}
			$check_zh_hk = strpos($country, 'zh_HK');
			if (!($check_zh_hk === false))
			{	
				if($overrideflag!=1)
				{
					header ("Location: https://careyue.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
					exit;
				}
				
			}
			$check_es = strpos($country, 'es');
			if (!($check_es === false))
			{	
			
			   $par=$_SERVER['REQUEST_URI'];
			   $sp=getUrlParm('sp');
			
			   if($sp==="1"){	
			  
			   $par=str_replace("/clang/es_MX", "", $par);
			   $par=str_replace("/sp/1", "", $par);
			   
				header ("Location:  https://care.inflightinternet.com/app/chat/chat_launch".$par);
				exit;
			
				}
			
				else 
				{ 
				if(!getUrlParm('la'))
				{  
				header ("Location: https://caresp.inflightinternet.com/app/home".$CI->session->getSessionData('enc_str')."/redirect/1");
				exit;
				}
				}
				
				
			 
			}
			
			$check_en = strpos($country, 'en');
			if (!($check_en === false))
			{
				$redirecturl = 1;
			}
		 }
		}
		
		$referer = parse_url($_SERVER['HTTP_REFERER']);	
					
		if(!empty($_SERVER['HTTP_REFERER']) && !in_array($referer['host'], $domains) && !$redirecturl)
		{	  
			
			//User is coming from outside the specified domains
			if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
			{
				$browser_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
				
				$pos_ja = strpos($browser_language, 'ja');
					if ($pos_ja === false) {
					  //$arr[ja]="NULL";
					}
					else
					{
						$arr[ja]=$pos_ja;
					}
					$pos_es = strpos($browser_language, 'es');
					if ($pos_es === false) {
					  //$arr[es]="NULL";
					}
					else
					{
						$arr[es]=$pos_es;
					}
					$pos_ca = strpos($browser_language, 'fr');
					if ($pos_ca === false) {
					 // $arr[ca]="NULL";
					}
					else
					{
						$arr[ca]=$pos_ca;
					}
					$pos_pt = strpos($browser_language, 'pt');
					if ($pos_pt === false) {
					 // $arr[pt]="NULL";
					}
					else
					{
						$arr[pt]=$pos_ca;
					}
					$pos_en = strpos($browser_language, 'en');
					if ($pos_en === false) {
					 // $arr[en]="NULL";
					}
					else
					{
						$arr[en]=$pos_en;
					}
					asort($arr);
					
					$cnt=0;
					foreach ($arr as $key => $value) {
						if($cnt==0)
						{
							if($key=='ja')
							{
							    header ('Location: https://carejp.inflightinternet.com/app/home'.$CI->session->getSessionData('enc_str'));
							    exit;
							}
							if($key=='ca')
							{
							   
								header ('Location: https://carefr.inflightinternet.com/app/home'.$CI->session->getSessionData('enc_str'));
							    exit;
							
							}
							if($key=='es')
							{
							    
								header ('Location: https://caresp.inflightinternet.com/app/home'.$CI->session->getSessionData('enc_str'));
							    exit;
															
							}
							if($key=='pt')
							{
							    
								header ('Location: https://carept.inflightinternet.com/app/home'.$CI->session->getSessionData('enc_str'));
							    exit;
															
							}
						}
						$cnt++;
					}					  
			}
		}
		//checking whether the session contains flightnumber and tail number 
		if($CI->session->getSessionData('USER_SESSION_COOKIE_EXIPIRE')=="Enable"){
			if (strpos($_SERVER['HTTP_REFERER'] , "chat_launch") !== false)
			{   
				$flightno2='null';
				if($CI->session->getSessionData('flightNumber'))
				{
					$flightno = explode("/", $flightNumber);
					$flightno2 = $flightno[2];
				}
				$tailno2 = 'Ground';
				if($CI->session->getSessionData('tailNumber'))
				{
					$tailno = explode("/", $tailNumber);
					$tailno2 = $tailno[2];
				}   
				//If the subject field is not null,append flightnumber and tailnumber to it  
				if($_POST['Incident_Subject']!='')
				{
				$_POST['Incident_Subject'] = $_POST['Incident_Subject']._____.FlightInfo.$flightno2.TailInfo.$tailno2;
				}
			}

		}
		else{
			if (strpos($_SERVER['HTTP_REFERER'] , "chat_launch") !== false)
			{			
				$flightno = explode("/", $flightNumber);
				$flightno2 = $flightno[2];
				if($flightno2=='')
				{
					$flightno2='null';
				}
				
				
				$tailno = explode("/", $tailNumber);
				$tailno2 = $tailno[2];
				if($tailno2 == '')
				{
					$tailno2 = 'Ground';
				}			
				//If the subject field is not null,append flightnumber and tailnumber to it  
				if($_POST['Incident_Subject']!='')
				{
				$_POST['Incident_Subject'] = $_POST['Incident_Subject']._____.FlightInfo.$flightno2.TailInfo.$tailno2;
				}
			}
		}
		
				   
		
	}
	
	function getCurrentCategory($c){

		$ServiceCategory = new RNCPHP\ServiceCategory();
		$ServiceCategory = RNCPHP\ServiceCategory::fetch($c);
		return $ServiceCategory->Name;


	}
	
	function tailexist($tailnum){
	 
		$roql_result = RNCPHP\ROQL::query("SELECT CO.Video_Availability.Tail FROM CO.Video_Availability WHERE CO.Video_Availability.Tail = '" . $tailnum . "'")->next();
		
		while($tail=$roql_result->next())
		{
		
			 $found = $tail['Tail'];
			
			
		}
		$arr = array($found);
		return $arr;

	}

	function gettmoIP($tail){
	 
	$qryIP = RNCPHP\ROQL::query("select StaticIP from CO.tmoSIM where TailNumber='".$tail."' ")->next();
    $result = $qryIP->next();
    if(!empty($result['StaticIP']))
    {
		$tmoip=$result['StaticIP'];
	}
	$ipnum = array($tmoip);
		return $ipnum;
	}
	
	function getTech($tail){
	 
	$qryTech = RNCPHP\ROQL::query("SELECT v.TECH FROM CO.Video_Availability v WHERE v.TAIL='".$tail."' ")->next();
    $result = $qryTech->next();
    if(!empty($result['Tech']))
    {
		$tech=$result['Tech'];
	}
	$tec = array($tech);
		return $tec;
	}
	
	function getpartnerowner($owner,$partner)
	{
	
		$url = "https://gogo.service-now.com/api/now/table/u_aircraft_tails?u_aircraft_status=Active&u_airline=".$partner."&u_operator=".$owner;
		
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
		$tails=array();
		$res=$response->result;
		$length=count($res);
		for($i=0;$i<$length;$i++)
		{
			$tail=$res[$i]->name;
			array_push($tails,$tail);
		}
		  // print_r($tails);
		return $tails;
	}
	 
	
	function getaline($tail){
	
		$roql_result = RNCPHP\ROQL::query("SELECT CO.Video_Availability.Airline FROM CO.Video_Availability WHERE CO.Video_Availability.Tail = '" . $tail . "'")->next();
		$Exclude_Tail = RNCPHP\ROQL::query("SELECT ID FROM CO.Exclude_Tail_List WHERE CO.Exclude_Tail_List.TailNumber='".$tail."'")->next();
		while($airline=$roql_result->next())
		{
		
			 $aline = $airline['Airline'];
			 
			
		}
		if($Exclude_Tail->count()>0){
			$aline='';
		}
		$arr = array($aline);
		return $arr;

	}
	function getCO($key)
	{
	$fault=array();
	$roql_result = RNCPHP\ROQL::query("SELECT CO.FIMRef.Fault,CO.FIMRef.URL,CO.FIMRef.FaultCode,CO.FIMRef.TaskNumber FROM CO.FIMRef WHERE CO.FIMRef.Fault LIKE '" ."%". $key ."%"."' OR CO.FIMRef.Keyword LIKE '" ."%". $key ."%"."'")->next();
	while($answer=$roql_result->next())
		{
		
			 $flt = $answer['Fault'];
			 $ur = $answer['URL'];
			 $code = $answer['FaultCode'];
			 $task = $answer['TaskNumber'];
			 array_push($fault,$flt,$ur,$code,$task);
		}
		$arr = array($fault);
		return $arr;
	}
	function getCurrentCat($c)
	{
	  
		$msg = RNCPHP\MessageBase::fetch(1000002);
		$links=$msg->Value;
		$links=explode(",",$links);
		foreach($links as $key=>$value)
		{
		$lnk=explode("-",$value);
		
		list($a,$b)=explode("-",$value,2);
	
		
			if(strcmp($b,$c)==0)
			{
			$ca=$a;
			
			}
		}	
		if($ca=="")
		{
		
		$ca="常见主题";
		
		}
		
		else
		{
		$ServiceCategory = new RNCPHP\ServiceCategory();
		$ServiceCategory = RNCPHP\ServiceCategory::fetch($ca);
		$ca= $ServiceCategory->Name;
		
		}
		return $ca;
		}
	
	 function getCurrentCatKorean($c)
	{
		$msg = RNCPHP\MessageBase::fetch(1000003);
		$links=$msg->Value;
		$links=explode(",",$links);
		
		foreach($links as $key=>$value)
		{
		$lnk=explode("-",$value);
	   
		list($a,$b)=explode("-",$value,2);
		
			if(strcmp($b,$c)==0)
			{
			$ca=$a;
			
			}
		}
		
		if($ca=="")
		{
		$ca="공통 주제";
		}
		else
		{
		$ServiceCategory = new RNCPHP\ServiceCategory();
		$ServiceCategory = RNCPHP\ServiceCategory::fetch($ca);
		$ca= $ServiceCategory->Name;
		
		}
		return $ca;
		}
	 function getCurrentCatGerman($c)
	{
	    
		$msg = RNCPHP\MessageBase::fetch(1000008);
		$links=$msg->Value;
		$links=explode(",",$links);
		
		foreach($links as $key=>$value)
		{
		$lnk=explode("-",$value);
		list($a,$b)=explode("-",$value,2);
		
			if(strcmp($b,$c)==0)
			{
			$ca=$a;
			
			}
		}
		
		if($ca=="")
		{
		$ca="Allgemeine Themen";
		}
		else
		{
		$ServiceCategory = new RNCPHP\ServiceCategory();
		$ServiceCategory = RNCPHP\ServiceCategory::fetch($ca);
		$ca= $ServiceCategory->Name;
		
		}
		return $ca;
		}
	
	function set_answer_viewbyprod($answerid,$prod,$sessionID)
	{
		try{
			$date=date("d-m-Y");
			$cur =date("Y-m-d\T00:00:00\Z");
			$cur_end =date("Y-m-d\T23:59:59\Z");
			$cur_date = strtotime($date);
			$answerid=(int)$answerid;
			$pr=RNCPHP\ServiceProduct::fetch($prod);
			$pr=$pr->ID;
			$roql_result = RNCPHP\ROQL::query("SELECT CO.AnswerbyProd.Hits,CO.AnswerbyProd.ID FROM CO.AnswerbyProd WHERE CO.AnswerbyProd.Created_Date>= '" . $cur. "' AND CO.AnswerbyProd.Created_Date<= '" . $cur_end. "' AND  CO.AnswerbyProd.AnswerId= '" . $answerid . "' AND CO.AnswerbyProd.Product= '" . $pr . "'AND CO.AnswerbyProd.sessionID='".$sessionID."'" )->next();
			$row=$roql_result->next();
			if (empty($row))
			{
				$hits = "1";
				$ansbyprod = new RNCPHP_CO\AnswerbyProd();	
				$ansbyprod->Hits=$hits;
				$ansbyprod->Product = RNCPHP\ServiceProduct::fetch($prod);
				$ansbyprod->AnswerId = RNCPHP\Answer::fetch($answerid);
				$ansbyprod->Created_Date=$cur_date;
				$ansbyprod->sessionID=$sessionID;
				$ansbyprod->save();
				
			}
			else
			{
				while($rw=$row)
				{
					
					$hits = $rw['Hits'];
					$hits = $hits+1;
					$id=$rw['ID'];
					$ansbyprod = RNCPHP\CO\AnswerbyProd::fetch($id); 
					$ansbyprod->Hits=$hits;
					
					$ansbyprod->save();
					return 1;
					
				}
			}

		}
		catch (Exception $err){
			print_r($err->getMessage());
		}
		
	}
	
	function setSession($cid,$session_id,$chatid)
	{
	
		$contact = RNCPHP\Contact::fetch($cid);
		$contact->CustomFields->c->session=trim($session_id);
		$contact->CustomFields->c->latestchat=trim($chatid);
		$contact->save();
		
	}
	function setguideusage($agent,$guide,$name)
	{
	    $guide=(int)$guide;
		$agent=(int)$agent;
		$name=$name;
		$roql_result = RNCPHP\ROQL::query("SELECT CO.Guide_Access.Hits,CO.Guide_Access.ID as id FROM CO.Guide_Access WHERE CO.Guide_Access.Contact = '" . $agent . "' AND CO.Guide_Access.guide='". $guide ."'" )->next();
		$row=$roql_result->next();
		/*if (empty($row))
		{*/
		
			$hits = "1";
			$guide_det = new RNCPHP_CO\Guide_Access();
	    	$guide_det->Guide =$guide;	
			$guide_det->Contact=$agent;
			$guide_det->Name=$name;
			$guide_det->Hits=$hits;
			$guide_det->save();
		/*}
		else
		{
			while($rw=$row)
			{
				print_r($rw);
				$hits = $rw['Hits'];
			 	$hits = $hits+1;
				$id=$rw['id'];
				$gid = RNCPHP\CO\Guide_Access::fetch($id); 
				$gid->Hits=$hits;
				$gid->save();
				return 1;
				
			}
		}*/
		
		
	}
	function qa_response($agent,$name,$questionID,$responseValue,$u_id,$ses,$st_time)
	{
	
	    $name=$name;
		$agent=(int)$agent;
		$questionID=$questionID;
		$ques = substr($questionID, 0, 6);
		$ques=$ques."%";
		$responseValue=$responseValue;
		$ses=$ses;
		$u_id=$u_id;
		$roql_result = RNCPHP\ROQL::query("SELECT CO.GuideAccessBySession.ID as id,CO.GuideAccessBySession.CreatedTime as time FROM CO.GuideAccessBySession WHERE CO.GuideAccessBySession.Contact = " . $agent . " AND  CO.GuideAccessBySession.Guide='".$name."' AND CO.GuideAccessBySession.UniqueID='".$u_id."' AND CO.GuideAccessBySession.Question LIKE '" . $ques . "'  AND CO.GuideAccessBySession.Response='Abandoned'")->next();
		
		$row=$roql_result->next();
		$id=$row['id'];
		$start=$row['time'];
		$start = date('h:i:s', strtotime($start));
		$start=explode(":",$start);
		if($st_time!="")
		{
			    $now1=date("h:i:s");
				$st_time=explode(":",$st_time);
				$now1=explode(":",$now1);
				$strt_hrs=(int)$st_time[0];
				$n_hrs1=(int)$now1[0];
				$strt_min=(int)$st_time[1];
				$n_min1=(int)$now1[1];
				$strt_sec=(int)$st_time[2];
				$n_sec1=(int)$now1[2];
				$hrs1=$n_hrs1-$strt_hrs;
				$min1=$n_min1-$strt_min;
				$sec1=$n_sec1-$strt_sec;
				$sec1=trim($sec1,'-');
				$min1=trim($min1,'-');
				$min1=$min1*60;
				$duration1=$min1+$sec1;
				$duration1 = trim($duration1,'-');
				
		}
		if (!empty($id))
		{
		        
				$now=date("h:i:s");
				$now=explode(":",$now);
				$st_hrs=(int)$start[0];
				$n_hrs=(int)$now[0];
				$st_min=(int)$start[1];
				$n_min=(int)$now[1];
				$st_sec=(int)$start[2];
				$n_sec=(int)$now[2];
				$hrs=$n_hrs-$st_hrs;
				$min=$n_min-$st_min;
				$sec=$n_sec-$st_sec;
				$sec=trim($sec,'-');
				$min=trim($min,'-');
				$min=$min*60;
				$duration=$min+$sec;
				$gid = RNCPHP\CO\GuideAccessBySession::fetch($id);
				$gid->Duration=$duration;
	    		$gid->Response =$responseValue;	
				$gid->save();
				return 1;
		
		}	
		else
		{
		
			$guide_det = new RNCPHP_CO\GuideAccessBySession();
	    	$guide_det->Guide =$name;	
			$guide_det->Question=$questionID;
			$guide_det->Response=$responseValue;
			$guide_det->Contact=$agent;
			$guide_det->UniqueID=$u_id;
			$guide_det->Session=$ses;
			if($duration1!=" ")
			$guide_det->Duration=$duration1;
			$guide_det->save();
			
		}
		
		/*else
		{
			while($rw=$row)
			{
				$id=$rw['id'];
				$gid = RNCPHP\CO\GuideAccessBySession::fetch($id);
				$gu = $rw['Guide'];
	    		$gid->Guide =$gu.",".$name;	
				$gid->save();
				return 1;
				
			}
		}	*/
	}
	
	function setDisconnect($session_id,$chatid,$cid)
	{
	   
		$roql_result = RNCPHP\ROQL::query("SELECT CO.Server_Disconnect.Hits,CO.Server_Disconnect.ID as id FROM CO.Server_Disconnect WHERE CO.Server_Disconnect.chatid = '" . $chatid . "'" )->next();
		$row=$roql_result->next();
		if (empty($row))
		{
			$hits = "1";
			$disconnect = new RNCPHP_CO\Server_Disconnect();
	    	$disconnect->Session = trim($session_id);	
			$disconnect->chatid=$chatid;
			$disconnect->Contact=$cid;
			$disconnect->Hits=$hits;
			$disconnect->save();
		}
		else
		{
			while($rw=$row)
			{
				print_r($rw);
				$hits = $rw['Hits'];
			 	$hits = $hits+1;
				$id=$rw['id'];
				$sid = RNCPHP\CO\Server_Disconnect::fetch($id); 
				$sid->Hits=$hits;
				$sid->save();
				return 1;
				
			}
		}
		
		
	}
	function stdTextSearch($key)
	{
		$result_array=array();
		$ar= RNCPHP\AnalyticsReport::fetch(101651);
        $arr= $ar->run();
		$nrows= $arr->count();
		$res_array=array();
 		for($ii=$nrows;$ii--;)
		{
			$row =$arr->next();
			$id=$row['Standard Text'];
			$content=$row['Value'];	
			$name=$row['Name'];	
			$hotkey=$row['Hotkey'];
			$folder=$row['Folder ID'];
			if(strpos($content,$key))
			{
			
                        
			$con[] = array( Title => $name, 
                      Content => $content,
                      Id => $id,
					  Hotkey=>$hotkey,
					  Folder=>$folder 
                    );
				
			
			}
				
		 }
	
		return $con;
	}
	
	
	/*Airline Template-Start*/
	function getAirline($tail){

		$roql_result = RNCPHP\ROQL::query( "SELECT CO.TailInfo_v2.airline,CO.TailInfo_v2.ACPU_Type FROM CO.TailInfo_v2 WHERE CO.TailInfo_v2.Tail = '" . $tail . "'" )->next();
		
		while($airline =  $roql_result->next())
		{
		
			 $aline = $airline['airline'];
			 $acpu_type = $airline['ACPU_Type'];
			
		}
		
		$arr = array($aline,$acpu_type);
		
		return $arr;

	}
	/*Airline Template-End*/
	
	//Storing the feedback into a custom object
    function setFeedback($answerID, $contactID, $rating, $message)
	{
      try
	  {
	  
		$answer = RNCPHP\Answer::fetch($answerID);
		$contact = RNCPHP\Contact::fetch($contactID);
		$answer_feedback = new RNCPHP_CO\Answer_Feedback();
		
		$answer_feedback->Answer_Id = $answer->ID;
		$answer_feedback->Contact_Id = $contact->ID;
		if($rating == 2)
		{
		
		$answer_feedback->Rating = "Yes";
		}
		
		else if($rating == 1)
		{
		$answer_feedback->Rating = "No";
		}
		
		$answer_feedback->Comments = $message;
		
		
		$answer_feedback->save();
		
		return $answer_feedback;
	
	  }
		catch (Exception $err )
	  {
		
		echo $err->getMessage();
	  }  
		
     }
	function setcustomkeywordfeedback($contact_id, $keyword, $message){
		
	try{
		if($contact_id)
		{
		$contact = RNCPHP\Contact::fetch($contact_id);
		$answer_feedback = new RNCPHP_CO\keyword_feedbacks();
		if($message)
		{
		$answer_feedback->feedback = $message;
		}
		if($contact)
		{
		$answer_feedback->contact_id = $contact;
		}
		if($keyword)
		{
		$answer_feedback->keyword = $keyword;
		}
		if($answer_feedback)
		{
			$answer_feedback->save();
			return true;
		}else {
			return false;
		}
		}
		
			
	}
	catch (Exception $err )
	{
		echo $err->getMessage();
	} 
		
		
	}
}
