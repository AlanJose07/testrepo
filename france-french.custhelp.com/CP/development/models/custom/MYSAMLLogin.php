<?php
namespace Custom\Models;
use RightNow\Utils\Framework;
use RightNow\Connect\v1_3 as RNCPHP;

class MYSAMLLogin extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		$this->CI = &get_instance();
    }	
	
	function checkContact(&$preHookData)
	{
		//logmessage(base64_decode($_POST['SAMLResponse']));
		$p = xml_parser_create();
		
		
		xml_parse_into_struct($p, base64_decode($_POST['SAMLResponse']), $vals, $index);
			xml_parser_free($p);
			$CI = get_instance();
			//logmessage($index);
			//logmessage($vals);
			$email  = $vals[28]['value'];
			$fname = $vals[54]['value'];
			$lname = $vals[51]['value'];
			$guid =  $vals[45]['value'];
			$sessionguid = array("guid"=>$guid );
			logmessage("email:" . $email);
			logmessage("fname:" . $fname);
			logmessage("lname:" . $lname);
			logmessage("guid:" . $guid);
			$CI->session->setSessionData($sessionguid);
			$c_id = $this->CI->model('Contact')->lookupContactByEmail($email)->result;
			logmessage($c_id);
			if($c_id){
				logmessage($email . 'contact found');
				$contact = RNCPHP\Contact::fetch($c_id);
				if(is_null($contact->Name->Fist) or is_null($contact->login))
				{
					$contact->login = $email;
					
					/*$url = "https://apimdev.beachbody.com:8443/api/v1/idm/account/searchIdentityCached";
				 load_curl();
				 $payload= '<?xml version="1.0" encoding="UTF-8"?>
				 <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:prox="http://proxy.beachbody.com/">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <prox:searchOIMIdentity>
						<search_identity_request><searchFilterName>email</searchFilterName>
						<searchFilterValue>'.$email.'</searchFilterValue>
						</search_identity_request>
					  </prox:searchOIMIdentity>
				   </soapenv:Body>
				</soapenv:Envelope>';
				 $ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
				//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$resp = curl_exec($ch);
				 curl_close($ch);
				 logmessage($resp);
				 $p1 = xml_parser_create();
		
				xml_parse_into_struct($p1,$resp , $vals1, $index1);
				xml_parser_free($p1);
				foreach($vals1 as $val) {
					
					
					if($val['tag'] == "STATUS")
					{
						$oimstatus = $val['value'];
					}elseif($val['tag'] == "GUID")
					{
						$guid =  $val['value'];
					}elseif($val['tag'] == "FIRSTNAME")
					{
						$fname =  $val['value'];
					}elseif($val['tag'] == "LASTNAME")
					{
						$lname =  $val['value'];
					}
					
				}
				*/
				
				$contact->Name = new RNCPHP\PersonName();
				$contact->Name->First = $fname;
				$contact->Name->Last = $lname;
				$contact->save();
				
				}
				
				
			}
			else
			{
				logmessage($email . 'contact not found');
				$formData['Contact.Emails.PRIMARY.Address'] = (object) array('value' => $email);
                //$contact = $this->CI->model('Contact')->create($formData, true);
				/*$url = "https://apimdev.beachbody.com:8443/api/v1/idm/account/searchIdentityCached";
				 load_curl();
				 $payload= '<?xml version="1.0" encoding="UTF-8"?>
				 <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:prox="http://proxy.beachbody.com/">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <prox:searchOIMIdentity>
						<search_identity_request><searchFilterName>email</searchFilterName>
						<searchFilterValue>'.$email.'</searchFilterValue>
						</search_identity_request>
					  </prox:searchOIMIdentity>
				   </soapenv:Body>
				</soapenv:Envelope>';
				 $ch = curl_init($url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
				//curl_setopt($ch, CURLOPT_USERPWD, $key . ":" . $secret);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$resp = curl_exec($ch);
				 curl_close($ch);
				 logmessage($resp);
				 $p1 = xml_parser_create();
		
				xml_parse_into_struct($p1,$resp , $vals1, $index1);
				xml_parser_free($p1);
				foreach($vals1 as $val) {
					
					
					if($val['tag'] == "STATUS")
					{
						$oimstatus = $val['value'];
					}elseif($val['tag'] == "GUID")
					{
						$guid =  $val['value'];
					}elseif($val['tag'] == "FIRSTNAME")
					{
						$fname =  $val['value'];
					}elseif($val['tag'] == "LASTNAME")
					{
						$lname =  $val['value'];
					}
					
				}*/
				$formData['Contact.Name.First'] = (object) array('value' => $fname);
				$formData['Contact.Name.Last'] = (object) array('value' => $lname);
				$contact = $this->CI->model('Contact')->create($formData, false);
				//$ContactGuid = new Connect\ContactGuid\GUID();
                ////$ContactGuid->contact = $contact->result;
                //$ContactGuid->guid = $guid;
                //$ContactGuid->save();
			}
			
	}
	
	// called by pre_contact_update, 
	function update(&$preHookData)
    {
	  
	   
		// set password to overwrite so that we can update it without adding in password_old
		if($email = $preHookData['data']->Emails[0]->Address){
			//$this->load->model('standard/Contact_model');
			//echo $c_id = $this->CI->model('Contact')->lookupContactByEmail($email);die('jjkk');
			if($c_id = $this->CI->model('Contact')->lookupContactByEmail($email)){
				//only want to do this when password is present
				if($preHookData['data']->NewPassword){
					$preHookData['data']->password->overwrite = TRUE;
				}
			}
			
		}
	}
	// called by pre_contact_create
    function create(&$preHookData)
    {
	    
		// copy email value to login so that we can be logged in by Contact_Model->contact_create
		if($email = $preHookData['data']->Emails[0]->Address){
			$preHookData['data']->Login = $email;
		}
		
	}

    // called by pre_page_render to log user out if on the ask_confirm page
    function logout()
    {
      // do a splash page check
      $CI =& get_instance();
      $home = getConfig(CP_HOME_URL);
      $ip_address = $_SERVER['REMOTE_ADDR'];
      $valid_ips = array('76.167.154.9','122.183.199.6','99.48.209.169','98.151.55.58','69.144.38.49','172.30.10..*','172.30.26..*','172.30.30..*','172.30.34..*','172.30.38..*','172.30.100..*','172.20.150..*' );

      // is CP_HOME_URL config set to splash?
      if($home === "splash" && $CI->page != "splash" )
      {
	// do we have a valid ip, if no redirect to splash
	if( !in_array($ip_address ,$valid_ips) )
	{
	  header("Location: /app/splash");
	  exit;
	}
      }
      // end splash page check

      // if we are on the ask_confirm page, or ask page
    if('ask_confirm'==  $this->CI->uri->segment(3)|| 'ask'==  $this->CI->uri->segment(3)){ 
	//$this->CI->load->model('standard/Contact');
	$results = $this->CI->model('Contact')->doLogout('');
	//$results = $this->CI->Contact->doLogout('');
	
      }
    }
    
    function checkURL(&$var1){
        
     $uri_string = $this->CI->uri->uri_string();
	      //  $uri_string = $this->uri->uri_string();
        $answer_parm = getUrlParm('~');
        if($answer_parm && strpos($uri_string,'page/render/answers/detail') === false){
            $search = "/~/".$answer_parm;
            $redirect_to = str_replace($search, "", $uri_string);
            $redirect_to = str_replace("page/render", "/app", $redirect_to);
            header("Location: $redirect_to");
        }
        
    }
	
	
	function redirect(&$preHookData)
	{
		//logmessage($_SERVER['HTTP_REFERER']);
		
		if(array_key_exists('RelayState', $_POST))
		{
		$CI = get_instance();

		logmessage("redirect");
		//logmessage($CI->session->getSessionData("ssoredirect"));
		
		$CI->session->createProfileCookie($preHookData['returnValue']);
		//Framework::setLocationHeader("https://us-english--tst.custhelp.com/app/".$CI->session->getSessionData("ssoredirect"));
		if($CI->session->getSessionData("chat") == "chat")
		{
		$chat_redirect = $CI->session->getSessionData("url");
		$chat = array("chat"=>" ","url"=>" "); // destroying the session data
		$CI->session->setSessionData($chat);
		Framework::setLocationHeader("https://".$_SERVER['HTTP_HOST']."/app/chat/prechatsurvey/".$chat_redirect);
		exit;
		}
		elseif($CI->session->getSessionData("chat") == "facebook")
		{
		$facebook_redirect = $CI->session->getSessionData("url");
		$facebook = array("chat"=>" ","url"=>" "); // destroying the session data
		$CI->session->setSessionData($facebook);
		Framework::setLocationHeader("https://".$_SERVER['HTTP_HOST']."/app/chat/facebooksurvey/".$facebook_redirect);
		exit;
		}
		elseif($_POST['RelayState'])
		{
				if (strpos($_POST['RelayState'],'/app/') === 0)
				{
					Framework::setLocationHeader("https://".$_SERVER['HTTP_HOST'].$_POST['RelayState']);
			}
			else
			{
				Framework::setLocationHeader("https://".$_SERVER['HTTP_HOST']."/app/".$_POST['RelayState']);
				
			}
			
		}
		else
		{
		Framework::setLocationHeader("https://".$_SERVER['HTTP_HOST']);
		}
		exit;
	  }	
	}
}
