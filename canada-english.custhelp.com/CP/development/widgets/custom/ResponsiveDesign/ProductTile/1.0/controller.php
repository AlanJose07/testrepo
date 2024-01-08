<?php
namespace Custom\Widgets\ResponsiveDesign;

class ProductTile extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        //return parent::getData();
		 parent::getData();
 $interface_id = $this->data['attrs']['interface']; // interface attribute  of the widget
	    $page_id = $this->data['attrs']['page'];//page attribute of the widget
			 
		//Query to get all products for self service tools
		
		$query="SELECT 
					BB.self_service_product 
				FROM 
					BB.self_service_product 
				WHERE 
					BB.self_service_product.visible_on_page=".$page_id."
				AND 
					BB.self_service_product.interface=".$interface_id." 
				AND 
					BB.self_service_product.enable=1

				ORDER BY BB.self_service_product.display_order";
		
		$product_details = $this->CI->model('custom/bbresponsive')->get_products($query);
		$this->data['attrs']['product_details']=$product_details;	
		
    }
}