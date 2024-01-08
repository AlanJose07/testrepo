<?php /* Originating Release: May 2013 */

namespace Custom\Widgets\input;

use RightNow\Utils\Connect,
    RightNow\Utils\Config;
use RightNow\Connect\v1_2\CO as RNCPHP_COM1;
use RightNow\Connect\v1_2 as RNCPHP_COM2;



class SelectionInputCOTest extends \RightNow\Libraries\Widget\Input {
    function __construct($attrs) {
        parent::__construct($attrs);
    }
	

     function getData() {
        //if (parent::getData() === false) return false;
		
		$validAttributes = explode('.',$this->data['attrs']['name']);
		$cacheKey = 'Input_' . $this->data['attrs']['name'];
        $cacheResults = checkCache($cacheKey);
        if(is_array($cacheResults))
		{
            list($this->field, $this->table, $this->fieldName, $this->data) = $cacheResults;
			$this->field = unserialize($this->field);

            return;
		}
       $this->table = $validAttributes[0];
       $this->fieldName = $validAttributes[1];
	   
	   $this->CI->load->model('custom/generic_model');
	   $this->data['field'] = $this->CI->generic_model->getBusinessObjectField( $this->table,$this->fieldName );
	  
	   $this->dataType = $this->data['field']->data_type;
	
	  	
	    $this->data['js']['type'] = 'NamedIDLabel';
		 $this->data['js']['table'] = $this->table;
        $this->data['js']['name'] = $this->fieldName;
		$this->data['constraints'] = array();
		$this->data['js']['constraints'] = $this->data['constraints'];	
		 if($this->fieldName === 'cf_first_noticed_symptoms')
		 {
	   
	   if($this->data['field']->data_type == 'CO\pcf_first_noticed')
	   {
	
	//data_type === "Products\rating")
  $this->data['inputType']='Select';
   $this->data['displayType']='Select';
   $this->CI->load->model('custom/generic_model');
   $pack = 'CO';
    $result = $this->CI->generic_model->getExistingType($pack);
     $this->data['menuItems']=$result;

	   }
	   	 if($this->data['field']->value)
		{
	
		$this->data['value'] = $this->data['field']->value;
		$this->data['attrs']['default_value']=$this->data['field']->value;
		}
		else
		{
		
		$this->data['value'] = $this->data['field']->default_value;
		}
		
	
	   
	   }

        
  }
   public function outputSelected($key) {
 
        if ($key == $this->data['value']) {
		
            return 'selected="selected"';
        }
    }
}
