<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;


 use RightNow\Utils\Connect,
  RightNow\Utils\Text,
    RightNow\Utils\Framework,
    RightNow\Api;


class Order extends \RightNow\Models\Base 
{
    function __construct()
    {
        parent::__construct(); 
    }

    function phonesave($homephone,$first,$last,$email)
    {
	
$return = true;
	
echo($homephone);
die('--------------------------------------'); 
	
	  $p_count = count($contact->Phones);
    if($p_count > 0 ){
        for($p = ($p_count-1); $p >=0 ; $p--) {
            $phone_array[$phones->PhoneType->LookupName] = $phones->Number;
            $contact->Phones->offsetUnset($p);
        }
    }
	
	
	$i = 0;
	   $contact->Phones = new RNCPHP\PhoneArray();
    if(!empty($homephone)){
        try {
            $contact->Phones[$i] = new RNCPHP\Phone();
            $contact->Phones[$i]->PhoneType = new RNCPHP\NamedIDOptList();
            $contact->Phones[$i]->PhoneType->LookupName = 'Home Phone';
            $contact->Phones[$i]->Number = $homephone;
        } catch (Exception $a){
            //print_r($a->getMessage());
        }
        
    	}
	
	
    
	
	 

	return $return;
	
		
	
	
	
	
}
}	