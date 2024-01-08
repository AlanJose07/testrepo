<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();
$CI->model('Incident');

use RightNow\Connect\v1_2 as Connect,
    RightNow\Connect\Knowledge\v1 as KnowledgeFoundation,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Api,
    RightNow\Internal\Sql\Incident as Sql,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
    RightNow\ActionCapture,
    RightNow\Utils\Config,
    RightNow\Libraries\AbuseDetection;
	

class SmartAsstChatModelSmart extends \RightNow\Models\Incident{
    function __construct()
    {
        parent::__construct();
    }
	
	
    /**
     * Creates an incident. In order to create an incident, a contact must be logged-in or there must be sufficient
     * contact information in the supplied form data. Form data is expected to look like
     *
     *      -Keys are Field names (e.g. Incident.Subject)
     *      -Values are objects with the following members:
     *          -value: (string) value to save for the field
     *          -required: (boolean) Whether the field is required
     *
     * @param array $formData Form fields to update the incident with In order to be created successfully, either a contact
     * must be logged in or this array must contain a 'Incident.PrimaryContact' key which must be either the ID of the
     * contact, or a instance of a Connect Contact class.
     * @param boolean $smartAssist Denotes whether smart assistant should be run
     * @return Connect\Incident|null Created incident object or null if there are error messages and the incident wasn't created
     */
    public function create(array $formData, $smartAssist = false) {

        $incident = $this->getBlank()->result;

        if ($contact = $this->getContact()) {
            $incident->PrimaryContact = $contact;
        }
        else if($formData['Incident.PrimaryContact']){
            if($formData['Incident.PrimaryContact'] instanceof Connect\Contact){
                $incident->PrimaryContact = $formData['Incident.PrimaryContact'];
            }
            else if((is_int($formData['Incident.PrimaryContact']) || ctype_digit($formData['Incident.PrimaryContact']))
                && ($contactAssociatedToIncident = $this->getContact($formData['Incident.PrimaryContact']))) {
                    $incident->PrimaryContact = $contactAssociatedToIncident;
            }
        }
        unset($formData['Incident.PrimaryContact']);
        if(!$incident->PrimaryContact){
            return $this->getResponseObject(null, null, Config::getMessage(CONT_INFO_ORDER_CREATE_INCIDENT_MSG));
        }
        if($incident->PrimaryContact->Disabled) {
            // Disabled contacts can't create incidents
            return $this->getResponseObject(null, null, Config::getMessage(SORRY_THERES_ACCT_PLS_CONT_SUPPORT_MSG));
        }
        $incident->Organization = $incident->PrimaryContact->Organization;

        $formData = $this->autoFillSubject($formData);

        $errors = $warnings = $smartAssistantData = array();
        foreach ($formData as $name => $field) {
            if(!\RightNow\Utils\Text::beginsWith($name, 'Incident')){
                continue;
            }
            $fieldName = explode('.', $name);
            try {
                //Get the metadata about the field we're trying to set. In order to do that we have to
                //populate some of the sub-objects on the record. We don't want to touch the existing
                //record at all, so instead we'll just pass in a dummy instance.
                list(, $fieldMetaData) = ConnectUtil::getObjectField($fieldName, $this->getBlank()->result);
            }
            catch (\Exception $e) {
                $warnings []= $e->getMessage();
                continue;
            }
            if (\RightNow\Utils\Validation::validate($field, $name, $fieldMetaData, $errors)) {
                $field->value = ConnectUtil::checkAndStripMask($name, $field->value, $fieldMetaData);
                $field->value = ConnectUtil::castValue($field->value, $fieldMetaData);
                if($setFieldError = $this->setFieldValue($incident, $name, $field->value, $fieldMetaData->COM_type)) {
                    $errors[] = $setFieldError;
                }
            }
            if($smartAssist === true && $field->value !== null){
                //For menu-type custom fields, we have the key for the value they selected (instead of the value). The KFAPI expects us to
                //denote that by adding a .ID onto the end of the name in the key/value pair list.
                if(in_array($fieldMetaData->COM_type, array('NamedIDLabel', 'ServiceProduct', 'ServiceCategory'))){
                    $name .= ".ID";
                }
                $smartAssistantData[$name] = $field->value;
            }
        }
        if ($errors) {
            return $this->getResponseObject(null, null, $errors);
        }

        if($smartAssist === true){
		
		
           // Connect\ConnectAPI::setSource(SRC2_EU_SMART_ASST);
            list($smartAssistantIncidentContent, $additionalFields) = $this->convertFormDataToSmartAssistantSearch($smartAssistantData, $incident->PrimaryContact);
            $smartAssistantResults = $this->getSmartAssistantResults($smartAssistantIncidentContent, $additionalFields);
			
                unset($smartAssistantResults['rulesMatched']);
				
                return $this->getResponseObject($smartAssistantResults, 'is_array');
            //}
        }
		
		
		

     /*   try{
            $incident = parent::createObject($incident, SRC2_EU_AAQ);
        }
        catch(\Exception $e){
            $incident = $e->getMessage();
        }
        if(!is_object($incident)){
            return $this->getResponseObject(null, null, $incident);
        }

        if($smartAssist === 'false' || $smartAssist === false){
            ActionCapture::record('incident', 'notDeflected');
        }*/
        //Always register SA results in order to get proper clickstream entries
		
/*Commented to block click stream entry - anoop*/
		
 /*       try{
            $smartAssistantToken = $this->CI->input->post('saToken') ?: null;
            if(!$smartAssistantToken && is_array($smartAssistantResults) && $smartAssistantResults['token']){
                $smartAssistantToken = $smartAssistantResults['token'];
            }
            $resolution = new KnowledgeFoundation\SmartAssistantResolution();
            $resolution->ID = 3; //KF_API_SA_RESOLUTION_TYPE_ESCALATED
            KnowledgeFoundation\Knowledge::RegisterSmartAssistantResolution($this->getKnowledgeApiSessionToken(), $smartAssistantToken, $resolution, $incident);
        }
        catch(\Exception $e){}*/
		
/*Comment end*/

 
    }
	
	 /**
     * Processes SmartAssistant� results returned from the KFAPI.
     * @param KnowledgeFoundation\SmartAssistantContentSearch $incidentContent Object with predefined summary/question, permission, and prod/cat filtering fields already set
     * @param array $keyValueList Additional incident fields that have an affect on which SA results are returned (e.g. custom fields, severity, etc)
     * @return array Processed Smart Assistant results; empty if no results
     */
    protected function getSmartAssistantResults(KnowledgeFoundation\SmartAssistantContentSearch $incidentContent, array $keyValueList) {
	 /* echo "<pre>";
  print_r($incidentContent);
  print_r($keyValueList);*/
  
      /*  ActionCapture::record('incident', 'suggest');*/
        $results = array('suggestions' => array());
        $answerSummarySuggestions = array();
		
		$searchTerms = $incidentContent->DetailedDescription." ".$incidentContent->Summary;
        try{
		
			$contactSearch = new KnowledgeFoundation\ContentSearch();
		 	$searchResponse = $contactSearch->SearchContent( $this->getKnowledgeApiSessionToken(), $searchTerms );
			$smartAssistantSuggestions->Suggestions=$searchResponse->SummaryContents;
		
            //$smartAssistantSuggestions = KnowledgeFoundation\Knowledge::GetSmartAssistantSuggestions($this->getKnowledgeApiSessionToken(), $incidentContent, $keyValueList);
			
		
			
			
		
		//echo($this->getKnowledgeApiSessionToken());
	//	die('------------------------------------------');	
			
            if(!is_object($smartAssistantSuggestions)){
                return $results;
            }
			
			$results['canEscalate'] = true;
            $results['token'] = 1234;

            //If there are no results and the user can escalate the post, send back whether or not we ran rules
            //to determine if we have to show an empty result set (patent issues) or if we can immediately escalate the incident
         if(is_object($smartAssistantSuggestions->Suggestions)){
          /*  ActionCapture::record('incident', 'suggestFound');*/
            foreach($smartAssistantSuggestions->Suggestions as $suggestion){
                //Standard text
                if($suggestion instanceof KnowledgeFoundation\StandardContentContent){
                    //These responses return the value as an array of both the text and html types. We
                    //want the HTML type.
                    foreach($suggestion->ContentValues as $standardText){
                        if($standardText->ContentType->ID === STD_CONTENT_CONTENT_TYPE_HTML){
                            $results['suggestions'][] = array(
                                'type' => 'StandardContent',
                                'content' => $standardText->Value
                            );
                        }
                    }
                }
                //Full answer
                else if($suggestion instanceof KnowledgeFoundation\AnswerContent){
                    $results['suggestions'][] = array(
                        'type' => 'Answer',
                        'title' => Text::escapeHtml($suggestion->Summary),
                        'content' => $suggestion->Solution
                    );
                }
                //Partial answer content search result. In order to allow these to be
                //displayed correctly, we'll group them together in a sub array
                else if($suggestion instanceof KnowledgeFoundation\AnswerSummaryContent){
                    $answerSummarySuggestions[] = array(
                        'ID' => $suggestion->ID,
                        'title' => Text::escapeHtml($suggestion->Title),
                    );
                }
            }
			}
			
			
			else
			{
			 $results['rulesMatched'] = 1;
                return $results;
			}
        }
        catch(Connect\ConnectAPIErrorBase $e){
            if(!IS_HOSTED){
                var_export($e);
                exit;
            }
            return null;
        }
        //Merge in normal SA results with the other potential types so that they are grouped together
        //for display purposes
        if(count($answerSummarySuggestions)){
            $results['suggestions'][] = array(
                'type' => 'AnswerSummary',
                'list' => $answerSummarySuggestions
            );
        }
		/*Code to filter the knowlegbase with interface using custom field value*/
		
		
		$CI = get_instance();
        $tab = $CI->session->getSessionData('tabParam');
		$arr['beach']="beachbody";
		$arr['team']="tbb";
		$arr['shake']="shakeology";
		$arr['coach']="coo";
		$arr['beachbodylive']="p90x_certification";//"certification";//new page set certification
		$arrtab=$arr[$tab];	
		$cnt=0;
		
		 $lob_filtered_res = null;
		  
		for($i=0;$i<count($results['suggestions'][0]['list']);$i++) 
		 
		{
			 $ansobj=Connect\Answer::fetch($results[suggestions][0]['list'][$i]['ID']);     
					//filter the acess level  		 
				$accesslvl=  $ansobj->AccessLevels; 
				$item = null;
				$current_access_lvl=12;//acesslevel for US
				foreach($accesslvl as $items) {
   				 if($current_access_lvl == $items->ID) 
				 {
       				 $item = $items;
       					 break;
   		 		  } 
				  
				}
				 if($ansobj->CustomFields->c->$arrtab==1 && $cnt<5 && $item != null)
             {
			 
			 	
				$lob_filtered_res['suggestions'][0]['type']= $results['suggestions'][0]['type'];
				$lob_filtered_res['canEscalate']= true;
				$lob_filtered_res['token']= $results['token'];		
				$lob_filtered_res['suggestions'][0]['list'][$cnt]['ID']=$results['suggestions'][0]['list'][$i]['ID'];
				$lob_filtered_res['suggestions'][0]['list'][$cnt]['title']=$results['suggestions'][0]['list'][$i]['title'];
				$cnt++;
			 }
		}
		
	  //If there are no results and the user can escalate the post, send back whether or not we ran rules
            //to determine if we have to show an empty result set (patent issues) or if we can immediately escalate the incident
            if(is_null($lob_filtered_res)){
				$lob_filtered_res['suggestions'] = array();
                $lob_filtered_res['rulesMatched'] = $smartAssistantSuggestions->RulesMatched;
				$lob_filtered_res['canEscalate'] = true;
            	$lob_filtered_res['token'] = $smartAssistantSuggestions->Token;
                return $lob_filtered_res;
            }
			else
			{
			return $lob_filtered_res;
			}
    }
}
