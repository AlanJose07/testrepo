<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Connect\v1_4 as RNCPHP;
class UpdateCreditCardFormInput extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
		
		 $this->setAjaxHandlers(array(
            'default_ajax_endpoint' => array(
                'method'      => 'handle_default_ajax_endpoint',
                'clickstream' => 'custom_action',
            ),
        ));
    }

     function getData() {
	
		$this->metada();
        return parent::getData();

    }
	function metada() {
		$obj_package = explode(".",$this->data["attrs"]["name"]);
		$metadat = RNCPHP\Update_Acnt\Update_Account_Info::getMetadata();
		//echo "<pre>";
		//print_r($metadat);
		
	/*if($this->data['attrs']['name'] === 'Update_Acnt.Update_Account_Info.credit_card_type')
		{
		   echo "<pre>";
		   print_r($metadat);
		}*/
		
		foreach($metadat as $key => $value) {
			if ($key == $obj_package[2]) {
			    //print_r($value->is_menu);
				if ($value->is_menu == 1) {
					$this->data["js"]["dataType"] = "Menu";
				} else {
					$this->data["js"]["dataType"] = $value->type_name;
				}
			}
		}
		//echo $this->data["js"]["dataType"];
		
			
	}

    /**
     * Handles the default_ajax_endpoint AJAX request
     * @param array $params Get / Post parameters
     */
    function handle_default_ajax_endpoint($params) {
        // Perform AJAX-handling here...
        // echo response
    }
}