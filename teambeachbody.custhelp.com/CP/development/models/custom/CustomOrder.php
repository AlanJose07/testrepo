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
	
	
	
}
