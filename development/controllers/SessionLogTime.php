<?php

namespace Custom\Controllers;
use RightNow\Connect\v1_2 as RNCPHP;
class SessionLogTime extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    
    function CustomAgentSessionLog()
    {
        try{
            $empty = 0;
            $errorMsg = "Errors:";
            $CI     =   get_instance();
            if(strlen($this->input->post('parameters'))<3){
                $errorMsg = $errorMsg ."<br>Empty Request Parameter in Custom\Controllers\SessionLogTime.php Line 23 ";
                $empty++;
            }
            $paramsValue = $this->input->post('parameters');
            $paramsValue    =   json_decode($paramsValue);
            if($paramsValue->contactID == null){
                $errorMsg = $errorMsg ."<br>". "Missing Parameter : Contact in Custom\Controllers\SessionLogTime.php Line 30";
                $empty++;
            }
            if($paramsValue->pageURL == null){
                $errorMsg = $errorMsg ."<br>" ."Missing Parameter : Page URL in Custom\Controllers\SessionLogTime.php Line 35";
                $empty++;
            }
            if($paramsValue->pageVisited == null ){
                $errorMsg = $errorMsg . "<br>"."Missing Parameter : Page Visited in Custom\Controllers\SessionLogTime.php Line 40";
                $empty++;
            }
            if($empty>0){
                echo json_encode($errorMsg);
                exit;
            }
            $paramsValue->sessionID =  $CI->session->getSessionData('sessionID');
            $paramsValue = json_encode($paramsValue);
            $response=$this->model('custom/SessionLogger')->customAgentSessionLog($paramsValue);
            echo json_encode($response);
        }
        catch (Exception $err){
            echo json_encode($err->getMessage()); 
        } 
    }
}