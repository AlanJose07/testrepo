<?php
namespace Custom\Models;
use RightNow\Connect\v1_2 as RNCPHP;
require_once( get_cfg_var( 'doc_root' ).'/include/ConnectPHP/Connect_init.phph' );
initConnectAPI();

class custom_object_model extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		//this->load->model("standard/Customfield_model");
        //This model would be loaded by using $this->load->model('custom/Sample_model'); 
    }
	
	 function getBlank($package,$table,$field)
    {	
	    try
		{
			$objIn = "RightNow\\Connect\\v1_2"."\\".$package."\\".$table;
			$custObj = new $objIn();
			if(substr($field, 0,3)=='cf_')
			{
			$cField = substr($field,3);
			}
			else
			{
			$cField = $field;
			}
			$this->formatOrgs($custObj,$package,$table,$cField);
			$this->getBlankCF($custObj,$package,$table,$cField);
		}
		catch (Exception $err )
		{
			return $err->getMessage();
		}
		
		return $custObj;
    }
	
	function getBlankCF($Obj,$package,$table,$field)
    {
	    try
		{
		$objIn = "RightNow\\Connect\\v1_2"."\\".$package."\\".$table;
		$cObj = $objIn::getMetadata();
		$custFieldsTypeName = $cObj->type_name;
		$custFieldsMetaData = $custFieldsTypeName::getMetadata();
		$customFields = array();
		foreach($custFieldsMetaData as $x){

				if($x->name ==  $field)
				{  
				
				//@ symbol added as part of Upgrade fix.We had warning after upgrade like 'creating default object from empty value'
		//as per on of the post from stack overflow recommended to add @ symbol before the line causing the warning

		// added by vimal on 5/12/2018
				
				
					@$Obj->$field->data_type = $x->COM_type;
					@$Obj->$field->value = NULL;
					$Obj->$field->default_value = $x->default;
					$i=0;
					while($z = $x->constraints[$i++])
					{
						if($z->kind == 4)// max_length
						$Obj->$field->field_size = $z->value;
					}
					$Obj->$field->lang_name = $x->label;
					$Obj->$field->required = $x->is_required_for_create;
					$Obj->$field->readonly = $x->is_read_only_for_create;

				}
			}

		}
		catch (Exception $err )
		{
			return $err->getMessage();
		}	
    }
	
 function formatOrgs($custObj,$package,$table,$field)
    {		
		try
		{
		 $objIn = "RightNow\\Connect\\v1_2"."\\".$package."\\".$table;
		 $custObj_meta = $objIn::getMetadata();
		 
		 //@ symbol added as part of Upgrade fix.We had warning after upgrade like 'creating default object from empty value'
		//as per on of the post from stack overflow recommended to add @ symbol before the line causing the warning

		// added by vimal on 5/12/2018
		 
		 
		 @$custObj->name->data_type = $custObj_meta->$field->COM_type;
		 @$custObj->name->default_value = $custObj_meta->$field->default;
		 $i=0;
			while($x = $custObj_meta->$field->constraints[$i++])
			{
			 if($x->kind == 4)// max_length
			 $custObj->name->field_size = $x->value;
			}
		 $custObj->name->lang_name = $custObj_meta->$field->label;
		 $custObj->name->required = $custObj_meta->$field->is_required_for_create;
		 $custObj->name->readonly = $custObj_meta->$field->is_read_only_for_create;
		 $custObj->name->value = NULL;
		 }
		catch (Exception $err )
		{
			return $err->getMessage();
		}
				 
    }

}
