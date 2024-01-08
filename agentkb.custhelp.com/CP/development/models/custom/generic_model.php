<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
initConnectAPI();

class generic_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		//$this->load->model("standard/Customfield_model");
        //This model would be loaded by using $this->load->model('custom/Sample_model');
    }
	
function getBusinessObjectInstance($table,$field)
{ 
      if($table == "Complaint")
	  {
	        $this->CI->load->model("custom/complaint_model");
			if(getUrlParm('cp_id') === null)
			{
			    
				return $this->CI->complaint_model->getBlank($field);
			}
			else
			{
				$opportunityInstance = $this->CI->complaint_model->get($field);
				if($opportunityInstance === null)
					return $this->CI->complaint_model->getBlank($field);
				return $opportunityInstance;
			}
		}
     

       return null;
}
	
	function getBusinessObjectField($table,$field)
{
   // echo $table; echo $field; 
    $middleLayerObject = $this->getBusinessObjectInstance($table,$field);
	
    if($middleLayerObject === null)
        return null;
		
	if(substr($field, 0,3)=='cf_')
	{
		$cfField = substr($field,3);
		return $middleLayerObject->$cfField;
	}

    return $middleLayerObject->$field;
}

function getExistingType($package)
 {
  require_once( get_cfg_var("doc_root")."/ConnectPHP/Connect_init.php" ); 
  try
     { 
         initConnectAPI( "amohammed", "abdul#123" );
   
   $qry = "RightNow\\Connect\\v1_2\\".$package."\\pcf_first_noticed";
  
   $items = RNCPHP\ConnectAPI::getNamedValues($qry);
  
      if($items){
            foreach ($items as $item) {
                $menuItems[$item->ID] = $item->LookupName ?: $item->Name;
            }
        }
		
   
   /*foreach($query as $key=>$value)
   {
    $data[] = $value->LookupName;
   }*/
     } 
  catch ( RNCPHP_CO\ConnectAPIError $err )
     {
  
         $data['exception'] = $err->getMessage();
     }
     return $menuItems;
 }


}
