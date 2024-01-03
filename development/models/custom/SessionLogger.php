<?php
namespace Custom\Models;

require_once(get_cfg_var("doc_root")."/include/ConnectPHP/Connect_init.phph");
initConnectAPI();
use RightNow\Connect\v1_2 as RNCPHP,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;

/**
 * This is an example of a custom search model that extends a standard search model, specifically the SocialSearch model. To
 * automatically have this model be used in place of calls to the standard model, open the
 * cp/customer/development/config/search_sources.yml file via WebDAV and add an entry for 'SocialSearch' key so it contains:
 *
 *    SocialSearch:
 *        model: MySocialSearch
 *
 * You can also reference the standard mapping file (framework/Config/search_sources.yml) to get an idea about the file format.
 */
class SessionLogger extends \RightNow\Models\Base{
    function __construct()
    {
        parent::__construct();
    }
    
    function customAgentSessionLog($paramsValue)
    {
        try{
            $params = $paramsValue;
            if($params ==null || $params ==""){
                return "Empty Request";
            }
            $params = json_decode($params);
            if($params->contactID == null || $params->contactID == ""){
                return "ContactID Empty";
            }
            if($params->sessionID == null || $params->sessionID ==""){
                return "Session Empty:".$parameters->sessionID;
            }
            try{
                $roql_result    =   RNCPHP\ROQL::query("SELECT * FROM CO.sessionmaster 
                                    WHERE CO.sessionmaster.contact_ID=$params->contactID AND 
                                    CO.sessionmaster.sessionID = '$params->sessionID'
                                    AND CO.sessionmaster.startDate='".date("Y-m-d")."'")->next();

                if($roql_result ->count() == 0){
                    $sessionMasterData              =   new RNCPHP\CO\sessionmaster();
                    $sessionMasterData->contact_ID  =   RNCPHP\Contact::fetch((int)$params->contactID);
                    $sessionMasterData->sessionID   =   $params->sessionID;
                    $sessionMasterData->startDate   =   date("Y-m-d");
                    $sessionMasterData->startTime   =   date("H:i:s");
                    $sessionMasterData->totalhours  =   "00:00:00";
                    try{
                        $sessionMasterData->save();
                    }
                    catch(Exception $err){
                        return "Master Data Entry Error ::".$err->getMessage();
                    }
                    
                    $sessionMasterID = $sessionMasterData->ID;

                }            
                if($roql_result ->count()>0){
                    $sessionMaster                  =   $roql_result->next();
                    $sessionMasterData              =   RNCPHP\CO\sessionmaster::fetch((int)$sessionMaster['ID']);
                    $startTime                      =   $sessionMaster['startTime'];
                    $sessionMasterData->totalhours  =   hourDifference($startTime); 
                    try{
                        $sessionMasterData->save();
                    }
                    catch (Exception $err){
                        return "Master Data Updation Error::".$err->getMessage();
                    }
                    
                    $sessionMasterID =  $sessionMasterData->ID;
                }
            }
            catch (Exception $err){
                print_r($err->getMessage());
            }
            if($sessionMasterID == null || $sessionMasterID ==""){
                return "Master Data Error";
            }
            try{
                $pageVisit  =   RNCPHP\ROQL::query("SELECT * FROM linguistnow.pageVisitBySession 
                WHERE linguistnow.pageVisitBySession.sessionMasterID = $sessionMasterID
                AND linguistnow.pageVisitBySession.pageLink ='".$params->pageURL."'  ")->next();

                if($pageVisit->count()>0){
                    $pageVisitData      =   $pageVisit->next();
                    $visitCount         =   (int)$pageVisitData['pageVIsitCount'];
                    $pageStartTime      =   $pageVisitData['startTime']; 
                    $pageVisitUpdate    =   RNCPHP\linguistnow\pageVisitBySession::fetch((int)$pageVisitData['ID']);
                    $pageVisitUpdate->lastVisitedTime   =   $timestamp = strtotime(date("Y-m-d H:i:s"));
                    $pageVisitUpdate->totalHour = hourDifference($pageStartTime);
                    if($params->pageVisited == "1"){
                        $pageVisitUpdate->pageVIsitCount    =   (string)++$visitCount;
                    }
                    try{
                        $pageVisitUpdate->save();
                    }
                    catch (Exception $err){
                        return "Page Visit Entry Error:".$err->getMessage();
                    }
                    
                    $pageVisitID =  $pageVisitUpdate->ID; 
                }
                if($pageVisit->count() == 0){
                    $sessionVisit  = new RNCPHP\linguistnow\pageVisitBySession();
                    $sessionVisit->sessionMasterID  =   RNCPHP\CO\sessionmaster::fetch($sessionMasterID);
                    $sessionVisit->lastVisitedTime  =   $timestamp = strtotime(date("Y-m-d H:i:s"));
                    $sessionVisit->pageLink         =   $params->pageURL;
                    $sessionVisit->pageVIsitCount   =   "1";
                    $sessionVisit->startTime        =   date("H:i:s");
                    $sessionVisit->totalHour        =   "00:00:00";
                    try{
                        $sessionVisit->save();
                    }
                    catch (Exception $err){
                        return "Page Visit Update Error::".$err->getMessage();
                    }
                    
                    $pageVisitID    =   $sessionVisit->ID;
                }
            }
            catch (Exception $err){
                print_r($err->getMessage());
            }
            if($pageVisitID == null || $pageVisitID ==""){
                return "Page Visit Data Error";
            }
            $respose = [$sessionMasterData->ID,$pageVisitID];
            if($sessionMasterID !=null && $pageVisitID !=null)
                return $respose;
            else
                return $respose;

        }
        catch (Exception $err){
            return $err->getMessage();
	    }  


    }
    
}
function hourDifference($startTime)
{
    $timeDiffFormatted = gmdate("H:i:s", strtotime(date("H:i:s")) - strtotime($startTime));
    return $timeDiffFormatted;
}
