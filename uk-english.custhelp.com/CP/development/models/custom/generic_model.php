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
