<?php
namespace Custom\Widgets\ResponsiveDesign;

class UpdateCreditCardSelection extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		$this->data['displayType'] = "Select";
		$this->data['menuItems'] = $this->getMenuItems();

    }

	 function getMenuItems() {
	 		$menuItems = array();
			$items = array();
			$projectItems = $this->CI->model('custom/UpdateModel')->getProjectItems()->result;
			$requestItems = $this->CI->model('custom/UpdateModel')->getRequestItems()->result;
			$creditcardtypeItems = $this->CI->model('custom/UpdateModel')->getCreditcardItems()->result;
			if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.exp_month'){
			foreach($projectItems as $projectItem){
				$items[] = (object)array('ID' => $pkey, 'LookupName' => $projectItem->Name);	
			}
			
			//print_r($items);
			
			if($items){
				foreach($items as $pid){
					$menuItems[] = $pid->ID ?: $pid->LookupName;
				}
			}
			// echo "<pre>"; print_r($menuItems); echo "</pre>";
			return $menuItems;
			}
			
			
			if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.exp_year'){
			foreach($requestItems as $requestItem){
				$items[] = (object)array('ID' => $pkey, 'LookupName' => $requestItem->Name);	
			}
			
			
			if($items){
				foreach($items as $pid){
					$menuItems[] = $pid->ID ?: $pid->LookupName;
				}
			}
			 // echo "<pre>"; print_r($menuItems); echo "</pre>";
			return $menuItems;
			}
			
			if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.credit_card_type'){
			foreach($creditcardtypeItems as $requestItem){
				$items[] = (object)array('ID' => $pkey, 'LookupName' => $requestItem->Name);	
			}
			
			
			if($items){
				foreach($items as $pid){
					$menuItems[] = $pid->ID ?: $pid->LookupName;
				}
			}
			 // echo "<pre>"; print_r($menuItems); echo "</pre>";
			return $menuItems;
			}
			
			
	 }
	 
}