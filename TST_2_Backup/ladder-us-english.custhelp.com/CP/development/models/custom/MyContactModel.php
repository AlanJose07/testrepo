<?php
namespace Custom\Models;

class MyContactModel extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		$this->CI = &get_instance();
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
}
