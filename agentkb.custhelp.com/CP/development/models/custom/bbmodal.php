<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,RightNow\Utils\Config,
   RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
class bbmodal extends \RightNow\Models\Base {
    function __construct() {
        parent::__construct();
    }
  
function getaccountemail($accountid)
{
  $account = RNCPHP\Account::fetch($accountid);
  return $account->Emails[0]->Address;
}

function sendemail($accountid,$vendor,$orderNum)
{
  logmessage($accountid);
  $account = RNCPHP\Account::fetch($accountid);
     

  $email_1 = \RightNow\Utils\Config::getConfig(1000076);
  logmessage($email_1);
  $email_arr = explode(';',$email_1);
  $email_2 = 	$account->Emails[0]->Address;
  $textarray = explode("-",$orderNum);
  $text_body = "This customer has requested to cancel their order with us. Could you please cancel their work order for delivery and confirm with us once completed? \n Delivery ID:".$textarray[1]."\nCustomer Name:".$textarray[2]." ".$textarray[3];
  try{
        $mm = new RNCPHP\MailMessage();
        $mm->To->EmailAddresses = $email_arr;
        $mm->CC->EmailAddresses = array($email_2);
        $mm->Subject = "Beachbody MYX Bike order cancellation ".$orderNum;
        $mm->Body->Text = $text_body;
        $mm->send();
        
  } 
  catch(Exception $e)  
  {
    return false;
  }
  return true;

}

function save_incident($threadText,$cid,$subject,$routing,$createdDay)
{
  try{
  
          $incident = new RNCPHP\Incident();
          $incident->Subject = $subject;
          $iid = RNCPHP\Incident::fetch($cid);
        $incident->PrimaryContact = $iid->PrimaryContact;
        // Incident day_of_week_created
        $incident->CustomFields->c->day_of_week_created = new RNCPHP\NamedIDLabel();
        $incident->CustomFields->c->day_of_week_created->LookupName = $createdDay;
                      
        // Incident Thread
        $incident->Threads = new RNCPHP\ThreadArray();
        $incident->Threads[0] = new RNCPHP\Thread();
        
        $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
        $incident->Threads[0]->EntryType->ID = 1;	// Customer
        
        $incident->Threads[0]->ContentType = new RNCPHP\NamedIDOptList();
        $incident->Threads[0]->ContentType->ID = 2;	// Text
        
        $incident->Threads[0]->Channel = new RNCPHP\NamedIDLabel();
        $incident->Threads[0]->Channel->ID = 5;	// POST

        $incident->Threads[0]->Text = $threadText;	// Thread information need to be updated
                    
        //$incident->save(RNCPHP\RNObject::SuppressAll);
        
        try{
              $incident->save();
              if(!empty($incident)){
                return $incident->ReferenceNumber;
            } else{
                return "Error";
            }		
         }
         catch(Exception $e)  
        {  
            echo "ERROR->".$e->getMessage();  
            logmessage($e->getMessage()); 
        }
     }
  catch(Exception $e)  
    {  
        echo "ERROR->".$e->getMessage();   
    }
    
    return 0;
     
}
	
}