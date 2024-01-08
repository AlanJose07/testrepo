<?php
namespace Custom\Widgets\ccc_form;
use RightNow\Utils\Connect;
class SelectionInputLanguage extends \RightNow\Widgets\SelectionInput {
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
	if($this->fieldName === 'member_type_eng')
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
					if(($item->ID == 771)||($item->ID == 770))
					{
						//$menuItems[$item->ID] = $item->LookupName ?: $item->Name;
					
						if(($item->ID == 771))
						{
							$menuItems[$item->ID] = "OUI - J'ai un partner en tête";
						}
						if(($item->ID == 770))
						{
							$menuItems[$item->ID] = "NON - Veuillez sélectionner un partner pour moi";
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