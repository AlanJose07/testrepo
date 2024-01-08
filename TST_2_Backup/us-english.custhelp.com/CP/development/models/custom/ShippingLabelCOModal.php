<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils,
   RightNow\Connect\v1_4 as RNCPHP;
class ShippingLabelCOModal extends \RightNow\Models\Base {
    function __construct() {
		
        parent::__construct();
		
		
    }
	
	function insert($PARAMS,$vendor,$cid)		
	{
		
		if(empty($PARAMS['p_delivery_id']))
		{
			try
			{
				$data = RNCPHP\ROQL::query( "SELECT p_delivery_id FROM BB.Shipping_labels WHERE EBSRANumber='".$PARAMS['raNumber']."'and p_delivery_id is not NULL")->next();
				$delivery_id = trim($data->next()['p_delivery_id']);
				
			}
				catch(Exception $e)
			  {
				 return 0;
			  }
		}else
		{
			$delivery_id = $PARAMS['p_delivery_id'];
		}
		if(empty($delivery_id))
			$delivery_id = -1;
		//email,address1,city,state,country,phno,zipcode,p_delivery_id
	$Shipping_labels = new RNCPHP\BB\Shipping_labels();
	$Shipping_labels->email = $PARAMS['email'];
	$Shipping_labels->address1 = $PARAMS['address1'];
	$Shipping_labels->City = $PARAMS['city'];
	$Shipping_labels->State = $PARAMS['state'];
	$Shipping_labels->postcode = $PARAMS['zipcode'];
	$Shipping_labels->p_delivery_id =$delivery_id;
	$Shipping_labels->phone = $PARAMS['phno'];
	$Shipping_labels->Vendor = $vendor;
	$Shipping_labels->EBSRANumber= $PARAMS['raNumber'];
	$Shipping_labels->Contact= $cid;
	//$Shipping_labels->EBSRANumber= $PARAMS['orderNumber'];
	$Shipping_labels->save();
	return array('id'=>$Shipping_labels->ID,'delivery_id'=>$delivery_id);
	}
	
	function updateTracking($id,$tracking)
	{
		$Shipping_labels = RNCPHP\BB\Shipping_labels::fetch($id);
		$Shipping_labels->vendorTrackingNum = $tracking;
		$Shipping_labels->status = 'SENT';
		$Shipping_labels->save(RNCPHP\RNObject::SuppressAll);
	}
	
	function updateErrorStatus($id,$errorstatus)
	{
		$Shipping_labels = RNCPHP\BB\Shipping_labels::fetch($id);
		$Shipping_labels->error_message = $errorstatus;
		$Shipping_labels->status = 'ERROR';
		$Shipping_labels->save();
	}
	
}