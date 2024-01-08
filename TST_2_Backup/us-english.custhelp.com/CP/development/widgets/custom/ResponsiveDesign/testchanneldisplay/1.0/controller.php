<?php
namespace Custom\Widgets\ResponsiveDesign;

class testchanneldisplay extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		
		$cat_id=trim(getUrlParm('catid'));
		
		if (!empty($cat_id))
		{
		  
		 //$query="select BB.categ_contac_hom_map from BB.categ_contac_hom_map where BB.categ_contac_hom_map.category.ID=".$cat_id." and BB.categ_contac_hom_map.interface.ID=1 and BB.categ_contac_hom_map.visible_on_page.ID=4";
		 $query="select BB.categ_contac_hom_map from BB.categ_contac_hom_map where BB.categ_contac_hom_map.category.ID=".$cat_id." and BB.categ_contac_hom_map.interface.ID=1 and BB.categ_contac_hom_map.visible_on_page.ID in(3,4)";  
		}
		$complete_channel_details = $this->CI->model('custom/bbresponsive')->channel_details_result($query);
		$channel_details=$complete_channel_details[1];
		$this->data['displayType']='Radio';
		
		$initial_channel_details_count=0;
		$recommend_one=0;
		$p=0;
		$x=0;
		//$temp=array("43"=>"Ask an expert","44"=>"Self-service form","45"=>"Chat with an agent","49"=>"Email us","50"=>"Call us","51"=>"Facebook messenger");
		foreach($this->data['menuItems'] as $key=>$value)  
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
						  $displaychannel[$key]= $value;
						  $disp_id[$x]=$key;
						  $x++;
						  $initial_channel_details_count++;
						}
						
						
					  }
			  else if(in_array($value,$channel_details))
			  {  
				$displaychannel[$key]= $value; 
				$initial_channel_details_count++;
			  }
			
		     
		  }//end of if when initial_channel_decision_count is less than or equal to channel details count		  
		}//end of foreach
		//$this->data['menuItems']=$channel_details;
		$this->data['recommendchannel']=$recommendchannel;
		$this->data['displaychannel']=$displaychannel;
		$this->data['js']['self_service_form_link_path']=$complete_channel_details[0];
		$this->data['js']['radioitems_count'] = count($channel_details);    
		$this->data['js']['recommendedchannel_id'] =  $rec_id;
		$this->data['js']['displaychannel_id'] = $disp_id;
		$this->data['no_channel_display_text'] = $complete_channel_details[2];  
		
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