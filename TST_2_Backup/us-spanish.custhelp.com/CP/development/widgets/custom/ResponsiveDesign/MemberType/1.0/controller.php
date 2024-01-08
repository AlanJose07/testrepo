<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Utils\Connect;
class MemberType extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

		$this->data['js']['isloggedin'] = "loggedout";
		if (\RightNow\Utils\Framework::isLoggedIn())
		{
		$this->data['js']['isloggedin']= "loggedin";
		}
        //$this->data['hideEmptyOption'] = true; // null option is not needed in dropdown
        return parent::getData();

    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
	
	protected function getMenuItems()
	{
	if($this->fieldName === 'member_type_new')
		{
		  $field = explode('.', $this->data['inputName']);
			$object = array_shift($field);
			$items = Connect::getNamedValues($object, implode('.', $field));
			//To hide certification customer in member type custom field
			if($items)
			{
				$count = count($items);
				foreach ($items as $item)
				{
					if(($item->ID == 389)||($item->ID == 388)||($item->ID == 1725))
					{
						//$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
					
						if(($item->ID == 389))
						{
							$menuItems[$item->ID] = "Cliente";
						}
						if(($item->ID == 388))
						{
							$menuItems[$item->ID] = "Coach";
						}
						if(($item->ID == 1725))
						{
							$menuItems[$item->ID] = "Cliente Preferente";
						}
						/*if(($item->ID == 398))
						{
							$menuItems[$item->ID] = "Instructor de Beachbody LIVE!";
						} */
					}

					
				}
			}//$items
			return $menuItems;	
		}//fieldname
	}//getmenu
}