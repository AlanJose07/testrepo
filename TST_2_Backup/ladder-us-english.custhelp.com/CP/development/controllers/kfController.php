<?php
    //Create an alias to the Connect Knowledge Foundation namespace
namespace Custom\Controllers;
Use RightNow\Libraries\AbuseDetection,
	RightNow\Utils\Config,
	RightNow\Utils\Framework,
	RightNow\Libraries\SEO;
	
    use RightNow\Connect\Knowledge\v1 as RNCPHPKF;
 
    //Load the Connect Knowledge Foundation library
    require_once (get_cfg_var ('doc_root') . '/include/ConnectPHP/Connect_kf_init.phph'); 
 
    class kfController extends \RightNow\Controllers\Base 
    {
        //This is the constructor for the custom controller. Do not modify anything within
        //this function.
        function __construct()
        {
            parent::__construct();
        }
     
        /**
        * Sample function for ajaxCustom controller. This function can be called by sending  
        * a request to /ci/ajaxCustom/ajaxFunctionHandler.
        */
        function displayAnswers()
        {
 
            //Enable the Connect Knowledge Foundation API
            $enabled = RNCPHPKF\Knowledge::Enabled();
     
            echo "Enabledc: {$enabled}<br/>";
     
            if($enabled == true)
            {
            $interactionID = RNCPHPKF\Knowledge::StartInteraction("Sample PHP APP", "10.20.20.1", "None", $_SERVER['HTTP_USER_AGENT']);
            echo "Interaction Id: {$interactionID}<br/>";
         
            //Because this is a getting started example we don't use any ContentSortOptions or ContentSearch parameters  
            $contentListResponse = RNCPHPKF\Knowledge::GetPopularContent($interactionID, null, null, 10);
            $contentStatus = $contentListResponse->Status;
            $summaryContents = $contentListResponse->SummaryContents;
            echo "<hr>";
            echo "Content Status Details:<br/>";
            echo "ElapsedTimeInMilliSeconds: {$contentStatus->ElapsedTimeInMilliSeconds}<br/>";
            echo "<hr>";
     
            echo "<h3>Most Popular Answers</h3>";
            foreach ($summaryContents as $sc)
            {
                echo "  <table border=\"0\">\n";
                echo "  <tr><td><b>ID</b></td><td>$sc->ID</td>\n";
                echo "  <tr><td><b>Title</b></td><td>$sc->Title</b></td>\n";
                echo "  <tr><td><b>Excerpt</b></td><td>" . htmlentities($sc->Excerpt) . "</td>\n";
                echo "  <tr><td><b>UpdatedTime</b></td><td>$sc->UpdatedTime</td>\n";
                echo "  <tr><td><b>URL</b></td><td>$sc->URL</td>\n";
                echo "  </table>\n";
                echo "  <hr/>";
     
            }
        }
    }
	
	
	
	
function getSmartAssistantSuggestions()
{
    $enabled = RNCPHPKF\Knowledge::Enabled();
 
    if($enabled == true)
    {
        $interactionID = RNCPHPKF\Knowledge::StartInteraction("Sample PHP APP", "10.20.20.1", "None", $_SERVER['HTTP_USER_AGENT']);
        echo "InteractionID: {$interactionID}<br/>";
 
        $contentSearch = new RNCPHPKF\SmartAssistantContentSearch();
        $contentSearch->Summary = "test";
        $contentSearch->DetailedDescription = "test";
 
        echo "Summary: {$contentSearch->Summary}";
 
        $kvList = array();
 
        $saSuggestionResponse = RNCPHPKF\Knowledge::GetSmartAssistantSuggestions($interactionID, $contentSearch, $kvList, 10);
 
 echo"<pre>";
 print_r($saSuggestionResponse->Token);
 print_r($saSuggestionResponse->Suggestions[0]->Title);
         
        $size = count( $rv->Suggestions );
 
        echo "<pre>
        <b>SUCCESS!</b>
 
        <b>Response:</b>
        Status.Status.ID = ".$rv->Status->Status->ID."
        Status.Status.LookupName = ".$rv->Status->Status->LookupName."
        Status.Descriptione = \"".$rv->Status->Description."\"
        Status.ElapsedTimeInMilliSeconds = \"".$rv->Status->ElapsedTimeInMilliSeconds."\"
        Token = ".$rv->Token."
        CanEscalate = ".(($rv->CanEscalate) ? "true" : "false")."
        RulesMatched = ".(($rv->RulesMatched) ? "true" : "false")."
        Suggestions size = ".$size."</pre>";
 
        for ( $i = 0; $i < $size; $i++ )
        {
            $suggestion = $rv->Suggestions[$i];
            //print_r($suggestion);
            processSuggestion( $i, $suggestion );
        }
     }
}
 
function processSuggestion( $i, $suggestion )
{
    echo "<pre>";
 
    if ( $suggestion instanceof RNCPHPKF\StandardContentContent )
    {
        echo "       <b>Suggestions[{$i}] is a StandardContentContent</b>
            ID = ".$suggestion->ID;
 
        for ( $j = 0; $j < count( $suggestion->ContentValues ); $j++ )
        {
            $content = $suggestion->ContentValues[$j];
 
            echo "
            ContentValues[{$j}].ContentType.ID = ".$content->ContentType->ID."
            ContentValues[{$j}].ContentType.LookupName = ".$content->ContentType->LookupName."
            ContentValues[{$j}].Value = ".$content->Value;
        }
    }
    elseif ( $suggestion instanceof RNCPHPKF\AnswerContent )
    {
        echo "        <b>Suggestions[{$i}] is an AnswerContent</b>
            ID = ".$suggestion->ID."
            LookupName = ".$suggestion->LookupName."
            Summary = ".$suggestion->Summary."
            Solution = ".$suggestion->Solution;
    }
    elseif ( $suggestion instanceof RNCPHPKF\AnswerSummaryContent )
    {
        echo "        <b>Suggestions[{$i}] is an AnswerSummaryContent</b>
            ID = ".$suggestion->ID."
            Excerpt = ".$suggestion->Excerpt."
            Title = ".$suggestion->Title."
            URL = ".$suggestion->URL."
            ContentOrigin.ID = ".$suggestion->ContentOrigin->ID."
            ContentOrigin.LookupName = ".$suggestion->ContentOrigin->LookupName;
    }
    else
    {
        //echo $err->getMessage();
        throw new Exception( __LINE__ ." Unknown type ".get_class( $suggestion ) );
    }
 
    echo "</pre>";
 
    return;
 
}
 

	
	
}
