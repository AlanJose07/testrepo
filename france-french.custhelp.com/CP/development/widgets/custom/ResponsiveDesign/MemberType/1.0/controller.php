<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Utils\Connect;
class MemberType extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

       // $this->data['hideEmptyOption'] = true; // null option is not needed in dropdown
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
		$this->data['js']['isloggedin'] = "loggedout";
		if (\RightNow\Utils\Framework::isLoggedIn())
		{
		$this->data['js']['isloggedin']= "loggedin";
		}
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
					
						if(($item->ID == 389))
						{
							$menuItems[$item->ID] = "Client";
						}
						if(($item->ID == 388))
						{
							$menuItems[$item->ID] = "Partenaire";
						}
						if(($item->ID == 1725))
						{
							$menuItems[$item->ID] = "Client Privilégié";
						}
						/*if(($item->ID == 398))
						{
							$menuItems[$item->ID] = "Instructeur Beachbody LIVE!";
						} */
					}	
				}
			}//$items
			return $menuItems;	
		}//fieldname
	}//getmenu
}