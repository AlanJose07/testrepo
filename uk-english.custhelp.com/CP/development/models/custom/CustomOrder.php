<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;

class CustomOrder extends \RightNow\Models\Base
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
         *                  $CI->model('custom/Sample')->sampleFunction();
         */
    }
	
	function getCurrentFlavour($id) 
	{
	//echo $id;
		if(  $id == 2)
		{
			$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.current_flavor"); 
			$m=0;
			$narr=array(94,96,100);
			for($i=0;$i<count($flv);$i++)
			{
			   if (!in_array($flv[$i]->ID, $narr)) {
					$arr[$m]['ID']=$flv[$i]->ID;
					$arr[$m]['LookupName']=	$flv[$i]->LookupName;
					$m++;
				}
				
			}
			return $arr;
		}
		if(  $id == 1)
		{			
			$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.current_flavor");
			$m=0;
			for($i=0;$i<count($flv);$i++)
			{ 
				$arr[$m]['ID']=$flv[$i]->ID;
				$arr[$m]['LookupName']=	$flv[$i]->LookupName;
				$m++;
			}
			return $arr;
		}
	}
	
	
	function getFlavour($id) 
	{
		//echo $id;
		if(  $id == 2)
		{
			$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.flavor1"); 
			$m=0;
			$narr=array(55,57,61);
			for($i=0;$i<count($flv);$i++)
			{
			   if (!in_array($flv[$i]->ID, $narr)) {
					$arr[$m]['ID']=$flv[$i]->ID;
					$arr[$m]['LookupName']=	$flv[$i]->LookupName;
					$m++;
				}
				
			}
			return $arr;
		}
		
		if(  $id == 1)
		{			
			$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.flavor1");
			$m=0;
			for($i=0;$i<count($flv);$i++)
			{ 
			$arr[$m]['ID']=$flv[$i]->ID;
			$arr[$m]['LookupName']=	$flv[$i]->LookupName;
			$m++;
			}
			return $arr;
		}
	}
	
	function SaveOrderForm_cust($ref_no,$dataobj,$sub)
	{
	    $incidentObj = RNCPHP\ROQL::queryObject( "SELECT Incident FROM Incident I WHERE I.ReferenceNumber = '".$ref_no."'" )->next();
          $incident = $incidentObj->next();
		  
	   $cancelled = stripos($incident->Subject, "Cancel");
	   
	    // Not needed for "Cancel Order"
                if ($incident && ($cancelled === false))
				{
                    $t = count($incident->Threads);
					
					if( $t == 0)
					{
                       $incident->Threads= new RNCPHP\ThreadArray();
                    }
					
                    foreach ($dataobj as $field) 
					{      
					           // there should be 3 more notes
                        if ($field->name == "priv_note") 
						{
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            if ($field->value == 290)
							{
                            	    $incident->Threads[$t]->Text = "**One Time Change**";
                            }elseif($field->value == 291){
                            	    $incident->Threads[$t]->Text = "Ongoing Change";
                            }else
							{
                            	    $incident->Threads[$t]->Text = $field->value;
                            }
							
                            $t++;
							
                        }
						
						
						/* if ($field->name == "Incident.CustomFields.c.current_flavor") 
						{
						$currentflavor = $field->value;
				
						$menuitems = RNCPHP\ConnectAPI::getNamedValues('RightNow\Connect\v1_2\Incident','CustomFields.c.current_flavor');
						
						   foreach ($menuitems as $items)
						   {
						   
						if($items->ID == $currentflavor)
						{
						$currentshakeflavor = $items->LookupName;
						}
					
						   
						   }
						
                            $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Current Shakeology Flavor - ". $currentshakeflavor;
                            $t++;
							
                        }
						
						 if ($field->name == "Incident.CustomFields.c.current_ship_day") 
						{
						$date = $field->value;
							$datevalues = RNCPHP\ConnectAPI::getNamedValues('RightNow\Connect\v1_2\Incident','CustomFields.c.current_ship_day');
							
							 foreach ($datevalues as $temp)
						   {
						   
						if($temp->ID == $date)
						{
						$currentshipdate = $temp->LookupName;
						}
						
						   
						   }
							
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Current Ship Day - ". $currentshipdate;
                            $t++;
							
                        }
						
						 if ($field->name == "Incident.CustomFields.c.current_zip") 
						{
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Current Zip/Postal Code - ". $field->value;
                            $t++;
							
                        }
						
						
						 if ($field->name == "Contact.Name.First") 
						{
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "First Name - ". $field->value;
                            $t++;
							
                        }
						
						 if ($field->name == "Contact.Name.Last") 
						{
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Last Name - ". $field->value;
                            $t++;
							
                        }
						
						 if ($field->name == "Contact.Emails.PRIMARY.Address") 
						{
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Email - ". $field->value;
                            $t++;
							
                        }
						
						 if ($field->name == "Contact.Phones.HOME.Number") 
						{
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Home Phone - ". $field->value;
                            $t++;
							
                        }
						 if ($field->name == "Incident.CustomFields.c.member_type") 
						{
						$member = $field->value;
							$membertypes = RNCPHP\ConnectAPI::getNamedValues('RightNow\Connect\v1_2\Incident','CustomFields.c.member_type');
							foreach ($membertypes as $members)
						   {
						   
						if($members->ID == $member)
						{
						$member_type = $members->LookupName;
						}
					
						   
						   }
							
						
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
                            $incident->Threads[$t]->Text = "Member Type - ". $member_type;
                            $t++;
							
                        }
						 if ($field->name == "Contact.Address.Country") 
						{
						  
                           $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 3;
							 if($field->value == "1")
							 {
                            $incident->Threads[$t]->Text = "Country - US";
							}
							else if($field->value == "2")
							{
							 $incident->Threads[$t]->Text = "Country - Canada";
							}
                            $t++;
							
                        }*/
						
					
                    }
                  

                    ////////////////////////////////////
                    //return $this->errorMsg('incident - ' . print_r($incident, true));
                    ////////////////////////////////////
                    $incident->Subject = $sub;
               
                    $task = "save Incident (". $inc .")";
				
                    $incident->save(RNCPHP\RNObject::SuppressAll);
				
                    $task = "commit()";
                    RNCPHP\ConnectAPI::commit();
                }
	   
	   
	
	} 
	
	function screenCardTypesByCountry($id,$field_name) 
	{
		$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Update_Acnt\\Update_Account_Info", $field_name);
		//Update_Acnt.Update_Account_Info.credit_card_type
		$len = count($flv); 
		$m=0;
		if($id == 2) // if country is Canada
		{
			//$narr=array();
			for($i=0;$i<$len;$i++)
			{
			   //if (!in_array($flv[$i]->ID, $narr)) {
					$arr[$m]['ID']=$flv[$i]->ID;
					$arr[$m]['LookupName']=	$flv[$i]->LookupName;
					$m++;
				//}
				
			}
			return $arr;
		}
		if(  $id == 1)
		{		
			for($i=0;$i<$len;$i++)
			{ 
				$arr[$m]['ID']=$flv[$i]->ID;
				$arr[$m]['LookupName']=	$flv[$i]->LookupName;
				$m++;
			}
			
			return $arr;
		}
		
		if($id == 7)//country UK   
		{
			
			$narr=array(1,2);
			for($i=0;$i<$len;$i++)
			{
			   if (in_array($flv[$i]->ID, $narr)) {
					$arr[$m]['ID']=$flv[$i]->ID;   
					$arr[$m]['LookupName']=	$flv[$i]->LookupName;
					$m++;
				}
				
			}
			return $arr;
		
		}
	}
	function countrybasedstateorprovince($id)
	{
	 $state_province=array();
     $res = RNCPHP\ROQL::query( "select Country.Provinces.ID,Country.Provinces.Name from Country where Country.ID=".$id."" )->next();
	 $i=0;
	 while($split_details = $res->next()) 
	 {
        $state_province[$i]['ID']=$split_details['ID'];
		$state_province[$i]['Name']=$split_details['Name'];
		$i++;
     }
	
	 return $state_province; 
	 
	}
	
	
	
}
