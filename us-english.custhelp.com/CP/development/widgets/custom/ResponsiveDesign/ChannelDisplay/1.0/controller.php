<?php
namespace Custom\Widgets\ResponsiveDesign;
Use RightNow\Utils\Connect, 
	RightNow\Utils\Config,
	RightNow\Connect\v1_4 as RNCPHP;
	
class ChannelDisplay extends \RightNow\Widgets\SelectionInput {
   function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData(); 
		
		$this->data['js']['isloggedin'] = "loggedout";
		if (\RightNow\Utils\Framework::isLoggedIn())
		{
		$this->data['js']['isloggedin']= "loggedin";
		}
		$cat_id=trim(getUrlParm('catid'));
		$cat1 = explode(".",trim(getUrlParm('catid')));
		//print_r($cat1);

		if (!empty($cat_id))
		{
		 // print_r("insidee");
		 //$query="select BB.categ_contac_hom_map from BB.categ_contac_hom_map where BB.categ_contac_hom_map.category.ID=".$cat_id." and BB.categ_contac_hom_map.interface.ID=1 and BB.categ_contac_hom_map.visible_on_page.ID=4";
		 $query="select BB.categ_contac_hom_map from BB.categ_contac_hom_map where BB.categ_contac_hom_map.category.ID=".$cat_id." and BB.categ_contac_hom_map.interface.ID=1 and BB.categ_contac_hom_map.visible_on_page.ID in(3,4) and BB.categ_contac_hom_map.enable=1";  
		}
	//	print_r($query);
		$complete_channel_details = $this->CI->model('custom/bbresponsive')->channel_details_result($query);
	//	echo "<pre>";print_r($complete_channel_details);
		$channel_details=$complete_channel_details[1];
		$this->data['displayType']='Radio';
		//print_r($channel_details);
		$initial_channel_details_count=0;
		$recommend_one=0;
		$p=0;
		$x=0;
		//$temp=array("43"=>"Ask an expert","44"=>"Self-service form","45"=>"Chat with an agent","49"=>"Email us","50"=>"Call us","51"=>"Facebook messenger");
	
	
		/* $obj= RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_3\\Incident.CustomFields.c.recommended_channel");
foreach($obj as $data)
{
echo $data->ID .'---'; 
echo $data->LookupName;
echo "<br>";
}*/

if(!empty($complete_channel_details[5]))
	{
				$new = $complete_channel_details[5];
				
				$keys = array_column($new, 'order');
				
				array_multisort($keys, SORT_ASC, $new);

				$newArray = [];
				$unavailablechannel = [];
				$count_new = count($new);

			for($i = 0 ; $i<$count_new; $i++){ 
				//if($new[$i]['available']){ 
					if($new[$i]['available'] == 2){
						$unavailablechannel[] = $new[$i];
						 unset($new[$i]);
					}
				//}	

			}
				
			$new1 = [];
			$new1 = array_merge($new,$unavailablechannel);
			//echo "<pre>";
			//print_r(array_merge($new,$unavailablechannel));
			foreach($new1 as $key => $value) {
			  foreach($value as $k => $v) {
				  if($k != 'order' && $k != 'available') {
					 $newArray[$k] = $v;     

				  }
				}
			}

			 
			$this->data['menuItems'] = $newArray;
		//	echo "<pre>";
		//	print_r($this->data['menuItems']);
			$display = 0;
				foreach($this->data['menuItems'] as $key=>$value){
				if($display ==0){
					$this->data['$recommendchannel_id']= $key;
		//			print_r($this->data['$recommendchannel_id']);
					$recommendchannel[$key]= $value;
					$rec_id[0]=$key;
		//			print_r($recommendchannel[$key]);
				//	print_r($rec_id[0]);
					$display++;
				}else{
					$displaychannel[$key]= $value;
					//print_r($displaychannel[$key]);

					$disp_id[$x]=$key;
				//	print_r($disp_id[$x]);
					$x++;
				}
				

			}
    }

	/*	 foreach($this->data['menuItems'] as $key=>$value)  
		{
		  if($initial_channel_details_count<count($channel_details))
		  { 
			  if(array_key_exists("recommend_0",$channel_details))
					  { 
						if($value==$channel_details["recommend_0"])
						{ 
						  $this->data['$recommendchannel_id']= $key;
						  $recommendchannel[$key]= $value;
						  $rec_id[$p]=$key;
						  $p++;
						  $initial_channel_details_count++; 
						}
						else if(in_array($value,$channel_details))
						{  
						//  echo "<pre>";
						  //print_r($channel_details);
						  //echo "<pre>";
						  //print_r($value);
						  $displaychannel[$key]= $value;
						  $disp_id[$x]=$key;
						  $x++;
						  $initial_channel_details_count++; 
						  //$displaychannel = ['1529' => 'Chat with an agent', '1532' => 'Facebook messenger', '1531' => 'Call us'];
						  
						}
						
					  }
			  else if(in_array($value,$channel_details))    
			  {  
				$displaychannel[$key]= $value; 
				$initial_channel_details_count++;
			  }
			
		     
		  }//end of if when initial_channel_decision_count is less than or equal to channel details count		  
		}//end of foreach */
		//$this->data['menuItems']=$channel_details;
		$this->data['recommendchannel']=$recommendchannel;
		//print_r($this->data['recommendchannel']);
		$this->data['displaychannel']=$displaychannel;
		$this->data['js']['self_service_form_link_path']=trim($complete_channel_details[0]);
		$this->data['js']['self_service_form_title']=trim($complete_channel_details[6]);
		$this->data['js']['self_service_form_icon']=trim($complete_channel_details[7]);
		$this->data['js']['self_service_form_description']=trim($complete_channel_details[8]);
		$this->data['js']['radioitems_count'] = count($channel_details);    
		$this->data['js']['recommendedchannel_id'] =  $rec_id;
		$this->data['js']['displaychannel_id'] = $disp_id;
		//print_r($this->data['displaychannel_id']);
		$this->data['no_channel_display_text'] = $complete_channel_details[2];
		$this->data['display_label_image'] = $complete_channel_details[4];  
		$this->data['js']['email_description'] = trim($complete_channel_details[9]);  
		$this->data['js']['email_sla'] = trim($complete_channel_details[10]); 
		$this->data['js']['email_title'] = trim($complete_channel_details[11]); 
		$this->data['js']['doc_description'] = trim($complete_channel_details[12]);  
		$this->data['js']['doc_sla'] = trim($complete_channel_details[13]); 		
		$this->data['js']['doc_title'] = trim($complete_channel_details[14]);
	
    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}