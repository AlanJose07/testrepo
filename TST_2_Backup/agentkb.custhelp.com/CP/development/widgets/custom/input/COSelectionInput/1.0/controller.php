<?php
namespace Custom\Widgets\input;

class COSelectionInput extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
	
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
	
	  	
	    $this->data['js']['type'] = 'Boolean';
		 if($this->fieldName === 'cf_first_noticed_symptoms')
		 {
		  if($this->data['field']->data_type == 'CO\pcf_first_noticed')
	   {
	    $this->data['inputType']='Select';
   $this->data['displayType']='Select';
   $this->CI->load->model('custom/generic_model');
   $pack = 'CO';
    $result = $this->CI->generic_model->getExistingType($pack);
     $this->data['menuItems']=$result;
	   
	}
	   
	   }

        //return parent::getData();

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}