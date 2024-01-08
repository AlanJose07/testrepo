<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Utils\Connect;
class coach_consent_selectioninput extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

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
	if($this->fieldName === 'consent_relationship')
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
					if(($item->ID == 1646)||($item->ID == 1647)||($item->ID == 1648))
					{
					
						if(($item->ID == 1646))
						{
							$menuItems[$item->ID] = "Cónyuge";
						}
						if(($item->ID == 1647))
						{
							$menuItems[$item->ID] = "madre/padre";
						}
						if(($item->ID == 1648))
						{
							$menuItems[$item->ID] = "hijo(a)";
						}
					}	
				}
			}//$items
			return $menuItems;	
		}//fieldname
	}//getmenu
}