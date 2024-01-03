<?php
namespace Custom\Widgets\search;
use RightNow\Connect\v1_2 as RNCPHP;
class CategoryListGerman extends \RightNow\Widgets\ProductCategoryList {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        //return parent::getData();
		
        $this->data['attrs']['data_type'] = strtolower($this->data['attrs']['data_type']);
        $this->data['results'] = $this->CI->model('Prodcat')->getHierarchy($this->data['attrs']['data_type'], $this->data['attrs']['levels'], $this->data['attrs']['maximum_top_levels'])->result;
		$msg = RNCPHP\MessageBase::fetch(1000008);
		$links=$msg->Value;
		$links=explode(",",$links);
		foreach($links as $key=>$value)
		{
		$lnk=explode("-",$value);
		list($a,$b)=explode("-",$value,2);
		
			$this->data['results'][$a]['id']=$b;
			
		
		}
		
		$res=$this->data['results'];
		//print_r($res);
		$this->data['results'] =$res;
		
        if($this->data['attrs']['add_params_to_url'])
            $this->data['appendedParameters'] = \RightNow\Utils\Url::getParametersFromList($this->data['attrs']['add_params_to_url']);

        if($this->data['attrs']['only_display'])
        {
            //filter out only_include values from the general results
            $selectedItems = explode(',', $this->data['attrs']['only_display']);
            $selectedResults = array();
            foreach($selectedItems as $itemID)
            {
                $itemID = trim($itemID);
                if(array_key_exists($itemID, $this->data['results']))
                    $selectedResults[$itemID] = $this->data['results'][$itemID];
            }
            $this->data['results'] = $selectedResults;
			
			
        }
        if(!count($this->data['results']))
            return false;
        $this->data['type'] = ($this->data['attrs']['data_type'] === 'products') ? 'p' : 'c';
    

    }
}