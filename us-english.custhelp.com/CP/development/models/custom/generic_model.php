<?php
namespace Custom\Models;
use RightNow\Connect\v1_4 as RNCPHP;
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
	 
	
	function getBusinessObjectInstance_update_acc_info($table,$field)
{ 
      if($table == "Update_Account_Info")
	  {
	        $this->CI->load->model("custom/update_account_info_model");
			if(getUrlParm('cp_id') === null)
			{
			    
				return $this->CI->update_account_info_model->getBlank($field);
			}
			else
			{
				$opportunityInstance = $this->CI->update_account_info_model->get($field);
				if($opportunityInstance === null)
					return $this->CI->update_account_info_model->getBlank($field);
				return $opportunityInstance;
			}
		}
       

       return null;
}
	
	
	function getBusinessObjectInstance($package,$table,$field)
	{ 
		  
				$this->CI->load->model("custom/custom_object_model");
				if(getUrlParm('cp_id') === null)
				{
					
					return $this->CI->custom_object_model->getBlank($package,$table,$field);
				}
				else
				{
				
					$objectInstance = $this->CI->custom_object_model->get($package,$table,$field);
					
					if($objectInstance === null)
						return $this->CI->custom_object_model->getBlank($package,$table,$field);
					return $objectInstance;
				}
			

		   return null;
	}
	
	
		//====this function used for update account info--for reading menu from co in widget
		
		function getBusinessObjectField_update_acc_info($table,$field)
		{
			// echo $table; echo $field; 
			$middleLayerObject = $this->getBusinessObjectInstance_update_acc_info($table,$field);

			if($middleLayerObject === null)
			return null;

			if(substr($field, 0,3)=='cf_')
			{
			$cfField = substr($field,3);
			return $middleLayerObject->$cfField;
			}

			return $middleLayerObject->$field;
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


}
