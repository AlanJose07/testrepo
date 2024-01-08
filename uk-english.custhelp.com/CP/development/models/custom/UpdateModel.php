<?php
namespace Custom\Models;
use RightNow\Utils\Framework as Framework, RightNow\Utils;
use RightNow\Connect\v1_2 as Connect;
   
class UpdateModel extends \RightNow\Models\Base {
	function __construct() {
		parent::__construct();
	}
	function getProjectItems() {
		$projectItemsArray = array(); 
		try{
		$projectItems = Connect\ROQL::queryObject("select Update_Acnt.exp_month from Update_Acnt.exp_month")->next();
		
		while($projectItem = $projectItems->next()){
				array_push($projectItemsArray,$projectItem);
		}
		}
		catch(Connect\ConnectAPIErrorBase $e){
            return $this->getResponseObject(null, null, $e->getMessage());
        }
		return $this->getResponseObject($projectItemsArray, 'is_array');		
	}
	
	function getRequestItems() {
		$requestItemsArray = array();
		try{
		$requestItems = Connect\ROQL::queryObject("select Update_Acnt.exp_year from Update_Acnt.exp_year")->next();
		
		while($requestItem = $requestItems->next()){
				array_push($requestItemsArray,$requestItem);
		}
		}
		catch(Connect\ConnectAPIErrorBase $e){
            return $this->getResponseObject(null, null, $e->getMessage());
        }
		return $this->getResponseObject($requestItemsArray, 'is_array');		
	}
	
	function getCreditCardType() {
		$requestItemsArray = array();
		try{
		$requestItems = Connect\ROQL::queryObject("select Update_Acnt.credit_card_type from Update_Acnt.credit_card_type")->next();
		
		while($requestItem = $requestItems->next()){
				array_push($requestItemsArray,$requestItem);
		}
		}
		catch(Connect\ConnectAPIErrorBase $e){
            return $this->getResponseObject(null, null, $e->getMessage());
        }
		return $this->getResponseObject($requestItemsArray, 'is_array');		
	}
	
	function getCreditcardItems() {
		$requestItemsArray = array();
		try{
		$requestItems = Connect\ROQL::queryObject("select Update_Acnt.credit_card_type from Update_Acnt.credit_card_type")->next();
		
		while($requestItem = $requestItems->next()){
				array_push($requestItemsArray,$requestItem);
		}
		}
		catch(Connect\ConnectAPIErrorBase $e){
            return $this->getResponseObject(null, null, $e->getMessage());
        }
		return $this->getResponseObject($requestItemsArray, 'is_array');		
	}
	
}
?>