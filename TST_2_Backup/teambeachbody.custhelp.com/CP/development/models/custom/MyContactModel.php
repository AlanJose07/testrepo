<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;

class MyContactModel extends \RightNow\Models\Base
{
    function __construct()
    { 
        parent::__construct();
		
		$this->CI = &get_instance(); 
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
         *                  $CI->model('custom/Sample')->sampleFunction();
         */
    }
	
	function preincidentcreate(&$preHookData)
    {	
	
		$iamcoach = $preHookData['data']->CustomFields->c->member_type->ID; // modified for migration
		if ($iamcoach <> null && $iamcoach == 49)
			$preHookData['data']->CustomFields->c->coachcustomernumber= "";		
			
	}	
	
	// called by pre_contact_update, 
	function update(&$preHookData)
    { 
	
		// set password to overwrite so that we can update it without adding in password_old
		if($email = $preHookData['data']->Emails[0]->Address){
			//$this->load->model('standard/Contact_model');
			
			if($c_id = $this->CI->model('Contact')->lookupContactByEmail($email))
			{
			
				//only want to do this when password is present
				if($preHookData['data']->NewPassword){
					//$preHookData['data']->password->overwrite = TRUE; this field is not available in new version
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
      $valid_ips = array( '76.167.154.9','122.183.199.6','99.48.209.169','98.151.55.58','69.144.38.49' );

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
      if('ask_confirm'== $CI->uri->segment(3)|| 'ask'== $CI->uri->segment(3))
	  { 
			//$this->CI->load->model('standard/Contact_model');
			
			// $this->model('Chat')->checkChatQueue
			  $results = $this->CI->model('Contact')->doLogout('');
      }
	  
	      
    }
	
	
}
