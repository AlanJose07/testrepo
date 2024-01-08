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
			/*$narr=array(94,96,100,636,637,638,639,640);*/
			//$narr=array(636,637,638,639,640);
			//$narr=array(638,639,640);
			$narr=array(638);
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
	
	function screenOptionsByCountry($id,$field_name) 
	{
		$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", $field_name);
		$len = count($flv); 
		$m=0;
		if($id == 2) // if country is Canada
		{
			$narr=array(1186,1187,1188,1189,1190,1191,1192,1193,1194,1195,1196,1197,1198,1199,1200,1201,1207,1208,1209,1210,1216,1217,1218,1219,1220,1214,1215,1211,1212,1213,1202,1203,1204,1205,1206,1221,1222,1223,1224,1225,1226,1227,1277,1278,1279,1280,1281,1282,1283,1284,1285,1286,1287,1288,1289,1290,1305,1306,1293,1294,1291,1292,1295,1296,1297,1298,1299,1300,1301,1302,1303,1304,1309,1310,1311,1308,1307,1270,1271,1272,1273,1274,1275,1276,1228,1235,1229,1236,1232,1233,1234,1230,1240,1231,1241,1237,1238,1239,1242,1243,1249,1250,1251,1252,1253,1254,1255,1256,1257,1258,1259,1260,1261,1262,1244,1245,1246,1247,1248,1263,1264,1265,1266,1267,1268,1269,802,870,896,833,843,967,979,1005,1013,803,834,844,871,968,980,897,1006,1014,805,836,846,873,970,982,899,1008,1016);
			for($i=0;$i<$len;$i++)
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
			  
			//$narr=array(915,907,909,911,1,934,926,928,930,1,97,297,355,93,1,796,792,793,794,1,821,817,818,819,1,828,824,825,826,1,1,943,944);//old
			
			//$narr=array(915,907,909,911,1,934,926,928,930,1,97,297,355,93,1,794,1,821,817,818,819,1,828,824,825,826,1,1,943,944);//old from 10/17/2017
			  $narr=array(97,297,355,93,354,796,792,793,794,807);
			
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
	function getFlavour($id) 
	{
		//echo $id;
		if(  $id == 2)
		{
			$flv = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.flavor1"); 
			$m=0;
			//$narr=array(55,57,61);
			//$narr=array(53,631,632,633,634,635);
			//$narr=array(53,633,634,635);
			$narr=array(53,633); 
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
			$narr=array(53);
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
	}
	function SaveOrderForm_cust($ref_no,$dataobj,$subject)
	{
	
	    $incidentObj = RNCPHP\ROQL::queryObject( "SELECT Incident FROM Incident I WHERE I.ReferenceNumber = '".$ref_no."'" )->next();
          $incident = $incidentObj->next();
	/*	  echo"<pre>";
		  print_r($incident->CustomFields->c->flavor1->LookupName);
		  die('-----------------------------------incident-----------------');*/
		  
	$x=0;
		  
		
	   $cancelled = stripos($incident->Subject, "Cancel");
	   
	    // Not needed for "Cancel Order"
                if ($incident && ($cancelled === false))
				{
                    $t = count($incident->Threads);
					
					//echo($t);
					
					
					//die('-------------------------------------------------------------------------');
					
					
					if( $t == 0)
					{
                       $incident->Threads= new RNCPHP\ThreadArray();
                    }
					
					/*echo "<pre>";
					print_r($dataobj);
					die("dhcfjkdfhsj");*/
					
					
                    foreach ($dataobj as $field) 
					{
					
					
					
			/*			  	  echo"<pre>";
							  print_r( $dataobj);
							  
							 die('------------incident------------------');*/
							
							
				//if($field->value)	{		
					
					
					           // there should be 3 more notes
                        if ($field->name == "priv_note") 
						{

/*echo"<pre>";
print_r($field->value);
die('--------------------------------------------');*/

							$x++;
                          $incident->Threads[$t] = new RNCPHP\Thread();
                            $incident->Threads[$t]->EntryType = new RNCPHP\NamedIDOptList();
                            $incident->Threads[$t]->EntryType->ID = 1;    
						
                          /*  if ($field->value == 290)
							{
                            	    $incident->Threads[$t]->Text = "**One Time Change in  Shakehology Flavor**";
                            }
							elseif($field->value == 291){
                            	    $incident->Threads[$t]->Text = "Ongoing Change in  Shakehology Flavor";
                            }
							
							
							else
							{*/
                            	$incident->Threads[$t]->Text = $field->value;
									
                          /* }*/
							
                            $t++;
						/*	echo "----------------====================================------------------";
							echo $t;
							var_dump($t);
							exit;*/
                        }
						
						//}
						
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
						
				//	die('------------incident------------------');
						
                    }
					
					
					
					
					
					
					
					$x++;
						
					/*$incident->Threads[$x] = new RNCPHP\Thread();
					$incident->Threads[$x]->EntryType = new RNCPHP\NamedIDOptList();
					$incident->Threads[$x]->EntryType->ID = 1;    
					$incident->Threads[$x]->Text = "Skip My Next Order";*/
					
					
					
					
                   /* die("entered");*/

                    ////////////////////////////////////
                    //return $this->errorMsg('incident - ' . print_r($incident, true));
                    ////////////////////////////////////
                    //$incident->Subject = $sub;
					
				/*	Code for saving flavor1 field*/
					
				/*	if($incident->Threads[2]->Text)
					{
				     $priv_flavor1 = $incident->Threads[2]->Text;
					 $new_flavor1_thread = explode(":",$priv_flavor1);
					
					 $flavor = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.flavor1");
						
					foreach ($flavor as $flavor_temp)	
					{
					
						$new_flavor = $flavor_temp->LookupName;
						
						
						if(trim($new_flavor1_thread[1]) == trim($new_flavor))
						{
						
						
						$incident->CustomFields->c->flavor1->ID = $flavor_temp->ID;
						}
					
					
					}
					
					
					}
					*/
					/*code for flavor1 ends here*/
		
				
             
                    $task = "save Incident (". $inc .")";
				
                    $incident->save(RNCPHP\RNObject::SuppressAll);
				
                    $task = "commit()";
                    RNCPHP\ConnectAPI::commit();
                }
	   
	   //die('------------incident------------------');	
	
	} 
	
	 function getBusinessObjectField($package,$table,$field)
	{ 

		$middleLayerObject = $this->getBusinessObjectInstance($package,$table,$field);
		
		if($middleLayerObject === null)
			return null;
			
		if(substr($field, 0,3)=='cf_')
		{
			$cfField = substr($field,3);
			return $middleLayerObject->$cfField;
		}

		return $middleLayerObject->$field;
	}
	
	function getOrderDetails($ref)
	{
	//$query = SELECT ID, Contact.Name.First, Login FROM Contact ORDER BY Contact.Name.First;
	 $incidentObj = RNCPHP\ROQL::queryObject( "SELECT Incident FROM Incident I WHERE I.ReferenceNumber = '".$ref."'" )->next();
          $incident = $incidentObj->next();
		  return $incident;
		  
	}
	
	
	/*this function is used to check whether the contact exist if exist then its first and last name get updated*/
	public function checkcontact($inc_id,$firstname,$lastname,$conemail,$homephone,$country)
	{        
             $res = RNCPHP\ROQL::queryObject("select Contact from Contact where Contact.Emails.Address='".$conemail."'")->next();
			 if($res->count()>0) {
			        try{
					$existcontact = $res->next();
					
					if($existcontact->Phones[0]->Number==null)
					{
					    $existcontact->Phones = new RNCPHP\PhoneArray();
					    $existcontact->Phones[0] = new RNCPHP\Phone();
						$existcontact->Phones[0]->PhoneType = new RNCPHP\NamedIDOptList();
						$existcontact->Phones[0]->PhoneType->ID = 4;// id corresponds to Home phone
						$existcontact->Phones[0]->Number =$homephone;
					}
					if($existcontact->Name->First==null)
					    $existcontact->Name->First = $firstname;
					
					if($existcontact->Name->Last==null)
                        $existcontact->Name->Last = $lastname;
					
					  $existcontact->Address->Country = RNCPHP\Country::fetch($country);
					  //exit;
					  $existcontact->save();
					  //exit;
					}//end of try
					catch(Exception $err){
					   
					}//end of catch
					return 0;
				
			}
	}
	
	function countrybasedlanguage($id){
	$language = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "customFields.c.ccc_language");
	$countrydetails=array();
	if($id=='1')                     // US  //options[1]--english[id--751]// options[2]--french[id--752]// options[3]--spanish[id--753]
	$countrylan_hide_id= array('752');
	if($id=='2')
	$countrylan_hide_id= array('753');
	if($id=='7')
	$countrylan_hide_id= array('752','753');
    if($id=='null')
	$countrylan_hide_id= array('null');

	$i=0;
	foreach($language as $eachlanguage)
	{
	  // array_push($country_id,$eachlanguage->ID);
	  if(!in_array($eachlanguage->ID,$countrylan_hide_id))
	  {
	     $countrydetails[$i]['ID']=$eachlanguage->ID;
		 $countrydetails[$i]['LookupName']=$eachlanguage->LookupName;
		 $i++;
	  }
	  
	}
		return $countrydetails; 
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
	
	
	function countrybasedlanguage_UK($id){
	$language = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "CustomFields.c.shk_orders");
	$countrydetails_UK=array();
	 
	if($id=='1')                     
	$countrylan_show_id= array('811','812','813');
	if($id=='2')
	$countrylan_show_id= array('811','812','813');
	if($id=='7')
	$countrylan_show_id= array('811','813');
  
	$i=0;
	foreach($language as $eachlanguage)
	{
	  
	  if(in_array($eachlanguage->ID,$countrylan_show_id))
	  {
	     $countrydetails_UK[$i]['ID']=$eachlanguage->ID;
		 $countrydetails_UK[$i]['LookupName']=$eachlanguage->LookupName;
		 $i++;
	  }
	  
	}
		return $countrydetails_UK; 
	}
	
	
	
	function shakecountrybasedlanguage($id){
	
	$language = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\Incident", "CustomFields.c.language_shk");  
	$countrydetails=array();
	
	if($id=='7')
	$countrylan_hide_id= array('1183','1184');
	else
	$countrylan_hide_id= array('null');
	
	$i=0;
	foreach($language as $eachlanguage)
	{
	  // array_push($country_id,$eachlanguage->ID);  
	  if(!in_array($eachlanguage->ID,$countrylan_hide_id))
	  {
	     $countrydetails[$i]['ID']=$eachlanguage->ID;
		 $countrydetails[$i]['LookupName']=$eachlanguage->LookupName;
		 $i++;
	  }
	  
	}
		return $countrydetails; 
	}
	
	public function contact_country_save($inc_id,$country,$contactemail) 
	{
		
	$res = RNCPHP\ROQL::queryObject("select Contact from Contact where Contact.Emails.Address='".$contactemail."'")->next();
	 if($res->count()>0) {
			        try{
					  $contact = $res->next();
					  $contact->Address->Country = RNCPHP\Country::fetch($country);
					  $contact->save();
					  //exit;
					}//end of try
					catch(Exception $err){
					   
					}//end of catch
					return 0;
				
			}
	}
	
	public function screenCardTypesByCountry($id,$field_name) 
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
	
	
	
	
}
