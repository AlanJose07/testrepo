<?php
namespace Custom\Widgets\ResponsiveDesign;
Use RightNow\Connect\v1_2 as RNCPHP;
class CategoryTile extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        	parent::getData();
		
		$cat_id=$this->data['categ_id']=trim(getUrlParm('catid')); //this parameter is obtained from the current url
		$cat_nme=$this->data['cat_nme']=trim(getUrlParm('catnme'));//this parameter is obtained from the current url
		$interface_id = $this->data['attrs']['interface']; //this is a required attribute of the widget
		$page_id = $this->data['attrs']['page'];//this is a required attribute of the widget
		
		$text = RNCPHP\ROQL::query( "SELECT ID, Value FROM MessageBase WHERE ID in(1000072,1000073)")->next();
		
		if($text->count()>0)
	   {
		   while($ContactChannelLabelImage = $text->next()) 
		   {

		   	if($ContactChannelLabelImage['ID']=='1000072')
		   	 {
                 $this->data['attrs']['contactus_topic']=$ContactChannelLabelImage['Value'];
		   	 }
			  
 		    if($ContactChannelLabelImage['ID']=='1000073')
		   	 {
                 $this->data['attrs']['contactus_text']=$ContactChannelLabelImage['Value'];
		   	 }
			 
			}
		}	
		
		
		//print_r($messagebase);
		
		/*******************************************************************************************************************/
		// The below code is used in the gethelp page. This will get the name of the clicked tile from the home page and 
		// display the name of the clicked tile in the gethelp page.
		/*******************************************************************************************************************/
		$clicked_cat_name=str_replace("-"," ",str_replace("_","/",trim(getUrlParm(catnme))));
		if(!empty($clicked_cat_name))
		{
		   $this->data['clicked_cat_name']=$clicked_cat_name;
		}
		/*******************************************************************************************************************/
		// The above code explanation is given at the starting of the code
		/*******************************************************************************************************************/
			          
		if (empty($cat_id))  // if condition for the home flow
		{
		 $query="select BB.categ_contact_ladder from BB.categ_contact_ladder where BB.categ_contact_ladder.visible_on_page.ID=".$page_id." and BB.categ_contact_ladder.enable=1 and BB.categ_contact_ladder.interface.ID=".$interface_id." ORDER BY BB.categ_contact_ladder.display_order";  
		}
		else                // else condition for the contact us flow
		{
		 
		 $query="select BB.categ_contact_ladder from BB.categ_contact_ladder where BB.categ_contact_ladder.visible_on_page.ID=".$page_id." and BB.categ_contact_ladder.category.Parent.ID=".$cat_id." and BB.categ_contact_ladder.enable=1 and BB.categ_contact_ladder.interface.ID=".$interface_id." ORDER BY BB.categ_contact_ladder.display_order";
		}
	
		$category_details = $this->CI->model('custom/bbresponsive')->category_details_result($query);
		$display_category_tiles=array();
		$display_more_category_tiles=array();
		
		if($page_id=="1"||$page_id=="3")   // page id==1---home and page id==3--contact us
		{
				if(count($category_details)>=9)
				{
						for($i=0;$i<=count($category_details);$i++)
						{
								if($i<9)
								array_push($display_category_tiles,$category_details[$i]);
								else
								array_push($display_more_category_tiles,$category_details[$i]);
						}
				}
				else
				{
				
						for($i=0;$i<=count($category_details);$i++)
						{
								if($i<9)
								array_push($display_category_tiles,$category_details[$i]);
								else
								array_push($display_more_category_tiles,$category_details[$i]);
						
				        }
				
				}
				
		$this->data['attrs']['category_details']=$display_category_tiles;
		$this->data['attrs']['more_category_details']=$display_more_category_tiles;
		$this->data['attrs']['more_category_details'] = array_filter($this->data['attrs']['more_category_details']);
		
		}// $page_id=="1" $page_id=="3"
		
		else if($page_id=="2" ||$page_id=="4")  //  page id==2---gethelp and page id==4--contact us sub
		{
		  
			/*if(count($category_details)>=6)
			{    
					for($i=0;$i<=count($category_details);$i++)
					{
							if($i<6)
							array_push($display_category_tiles,$category_details[$i]);
							else
							array_push($display_more_category_tiles,$category_details[$i]);
					}
			}
			else
			{
			
					for($i=0;$i<=count($category_details);$i++)
					{
							if($i<6)
							array_push($display_category_tiles,$category_details[$i]);
							else
							array_push($display_more_category_tiles,$category_details[$i]);
					
					}
			
			}*/
		//$this->data['attrs']['category_details']=$display_category_tiles;  
		$this->data['attrs']['category_details']=$category_details;
		//$this->data['attrs']['more_category_details']=$display_more_category_tiles;
		//$this->data['attrs']['more_category_details'] = array_filter($this->data['attrs']['more_category_details']);
		
		} // $page_id=="2" $page_id=="4"                                  
    }
}