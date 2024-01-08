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
    RightNow\Libraries\AbuseDetection,
	RightNow\Connect\v1_2\CO as RNCPHP_CO;
	
	use RightNow\Connect\v1_2 as RNCPHP;
	
class IncidentModel extends \RightNow\Models\Incident{
    function __construct()
    {
        parent::__construct();
    }
	
	public function get_lifetime_rank($coachID){
		$return = array();
		$coachDetails = RNCPHP\ROQL::queryObject("Select Coach_Route.coachRouteObj from Coach_Route.coachRouteObj where Coach_Route.coachRouteObj.coach_id = '".$coachID."'")->next();
		if (strlen($coachID) > 0) {
			$return["rank"] = "";
		}
		while($coach = $coachDetails->next()) {
			$return["rank"] = $coach->life_time_rank;
		}	
		return $return;
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
           // Connect\ConnectAPI::releaseSource(SRC2_EU_SMART_ASST);
            //Return a response to the SA dialog if either there are results to display or we tried to run rules, but couldn't find anything
            if(is_array($smartAssistantResults) && is_array($smartAssistantResults['suggestions']) && (count($smartAssistantResults['suggestions']) || $smartAssistantResults['rulesMatched'])){
                unset($smartAssistantResults['rulesMatched']);
                return $this->getResponseObject($smartAssistantResults, 'is_array');
            }
        }

        try{
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
        }
        //Always register SA results in order to get proper clickstream entries
        try{
            $smartAssistantToken = $this->CI->input->post('saToken') ?: null;
            if(!$smartAssistantToken && is_array($smartAssistantResults) && $smartAssistantResults['token']){
                $smartAssistantToken = $smartAssistantResults['token'];
            }
            $resolution = new KnowledgeFoundation\SmartAssistantResolution();
            $resolution->ID = 3; //KF_API_SA_RESOLUTION_TYPE_ESCALATED
            KnowledgeFoundation\Knowledge::RegisterSmartAssistantResolution($this->getKnowledgeApiSessionToken(), $smartAssistantToken, $resolution, $incident);
        }
        catch(\Exception $e){}

        if (Framework::isLoggedIn() && !$this->CI->session->getProfileData('disabled')) {
            $currentProfile = $this->CI->session->getProfile(true);
            //Reverify the user so that SLA instances get updated
            $sessionID = $this->CI->session->getSessionData('sessionID');
            $profile = Api::contact_login_verify($sessionID, $currentProfile->authToken);
            if ($sessionID === null) {
                // API indicated that the session expired
                $this->CI->session->generateNewSession();
            }
            if ($currentProfile->openLoginUsed)
                $profile->openLoginUsed = $currentProfile->openLoginUsed;
            $profile = $this->CI->session->createMapping($profile);
            if ($profile !== null)
                $this->CI->session->createProfileCookie($profile);
        }
        return $this->getResponseObject($incident, 'is_object', null, $warnings);
    }
	
	 /**
     * Processes SmartAssistant� results returned from the KFAPI.
     * @param KnowledgeFoundation\SmartAssistantContentSearch $incidentContent Object with predefined summary/question, permission, and prod/cat filtering fields already set
     * @param array $keyValueList Additional incident fields that have an affect on which SA results are returned (e.g. custom fields, severity, etc)
     * @return array Processed Smart Assistant results; empty if no results
     */
    protected function getSmartAssistantResults(KnowledgeFoundation\SmartAssistantContentSearch $incidentContent, array $keyValueList) {
	  
        ActionCapture::record('incident', 'suggest');
        $results = array('suggestions' => array());
        $answerSummarySuggestions = array();
        try{
            $smartAssistantSuggestions = KnowledgeFoundation\Knowledge::GetSmartAssistantSuggestions($this->getKnowledgeApiSessionToken(), $incidentContent, $keyValueList);
			
			
            if(!is_object($smartAssistantSuggestions)){
                return $results;
            }
            $results['canEscalate'] = $smartAssistantSuggestions->CanEscalate;
            $results['token'] = $smartAssistantSuggestions->Token;

            //If there are no results and the user can escalate the post, send back whether or not we ran rules
            //to determine if we have to show an empty result set (patent issues) or if we can immediately escalate the incident
            if(!is_object($smartAssistantSuggestions->Suggestions)){
                $results['rulesMatched'] = $smartAssistantSuggestions->RulesMatched;
                return $results;
            }
            ActionCapture::record('incident', 'suggestFound');
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
		// $results1['suggestions'][0]['type']= $results['suggestions'][0]['type'];
		// $results1['suggestions'][0]['content']= $results['suggestions'][0]['content'];
		//&& $ansobj->AccessLevels[0]->ID==1
		 
		 
		 $results1=null;
		 
		
		 
		
		 
		 
		for($i=0;$i<count($results['suggestions'][0]['list']);$i++) 
		{
			 $ansobj=Connect\Answer::fetch($results[suggestions][0]['list'][$i]['ID']);    
			 
			
				
				
				
				//filter the acess level  		 
				$abccAcess=  $ansobj->AccessLevels; 
				$item = null;
				$v=12;//acesslevel for canada
				foreach($abccAcess as $struct) {
   				 if ($v == $struct->ID) 
				 {
       				 $item = $struct;
       					 break;
   		 		  } 
				  //&& $item!=null 
				}/**/
				
				

			// if($ansobj->CustomFields->c->$arrtab==1 && $cnt<5 && $item != null)
			if( $cnt<5 && $item != null)//check and change after testing
             { 
			 
			 	
				$results1['suggestions'][0]['type']= $results['suggestions'][0]['type'];
				$results1['canEscalate']= $results['canEscalate'];
				$results1['token']= $results['token'];		
				$results1['suggestions'][0]['list'][$cnt]['ID']=$results['suggestions'][0]['list'][$i]['ID'];
				$results1['suggestions'][0]['list'][$cnt]['title']=$results['suggestions'][0]['list'][$i]['title'];
				$cnt++;
			 }
		}
		
		
			
	  //If there are no results and the user can escalate the post, send back whether or not we ran rules
            //to determine if we have to show an empty result set (patent issues) or if we can immediately escalate the incident
            if(is_null($results1)){
				$results1['suggestions'] = array();
                $results1['rulesMatched'] = $smartAssistantSuggestions->RulesMatched;
				$results1['canEscalate'] = true;
            	$results1['token'] = $smartAssistantSuggestions->Token;
                return $results1;
            }
			else
			{
			 return $results1;
			}
       
    }
	
	 //added  on 3-8-2017
	 
	 
	 function get_recommended_channel_copy($request_Id, $member_Id)
	{
	 
	
	$time_start = microtime(true);
		
		/*
		
		$channel = RNCPHP\ROQL::queryObject("select CO.channel_decision from CO.channel_decision where CO.channel_decision.member_type='$member_Id'
		and CO.channel_decision.request_type='$request_Id'")->next();
		*/
	
			
			//loook up
			/*$channel = RNCPHP\ROQL::query("select 
			CO.channel_decision.directly_rtm.LookupName as directly,
			CO.channel_decision.self_service_form.LookupName as self,
			CO.channel_decision.agent_chat.LookupName as chat,
			CO.channel_decision.email.LookupName as email,
			CO.channel_decision.phone_display_text as phone
			from CO.channel_decision where CO.channel_decision.member_type='$member_Id'
			and CO.channel_decision.request_type='$request_Id'")->next();
	*/
	
			//ID
			$channel = RNCPHP\ROQL::query("select 
			CO.channel_decision.directly_rtm as directly,
			CO.channel_decision.self_service_form as self,
			CO.channel_decision.agent_chat as chat,
			CO.channel_decision.email as email,
			CO.channel_decision.phone_display_text as phone
			from CO.channel_decision where CO.channel_decision.member_type='$member_Id'
			and CO.channel_decision.request_type='$request_Id'")->next();
	
	
		while($row = $channel->next())
		{ 
			
			/* 
			$channels=array($row->directly_rtm->LookupName,$row->self_service_form->LookupName,$row->agent_chat->LookupName,$row->email->LookupName,
			$row->phone->LookupName,$row->phone_display_text);
			*/
			
			$channels=array($row['directly'],$row['self'],$row['chat'],$row['email'],$row['phone']);//look up/id
			
			
		}
		// var_dump($channels); 
		// exit;
	  
	  $time_end = microtime(true);
	  echo "in seconds". $time_difference = $time_end - $time_start;
		exit;
	 // return $channels; 
	  
		 
	
	}
	  
	function get_recommended_channel($request_Id, $member_Id, $current_url)
	{
		$channel = RNCPHP\ROQL::queryObject("select CO.channel_decision from CO.channel_decision where CO.channel_decision.member_type='$member_Id'
		and CO.channel_decision.request_type='$request_Id'")->next();

		while($row = $channel->next())
		{ 
			
			if($row->answer!="")
			{
				$answer_result = $this->CI->model('custom/Answer')->getNewAnswers($row->answer);
			}
			else
			{
				$answer_result = "";
			}
			$channels=array($row->directly_rtm->LookupName, $row->self_service_form->LookupName, $row->agent_chat->LookupName, $row->email->LookupName,
			$row->phone->LookupName, $row->phone_display_text, $answer_result);	
			
		}
		if($channels[0]=="RECOMMEND")//ask
		{
			$channel_id = 1;
		}
		else if($channels[1]=="RECOMMEND")//self
		{
			 $channel_id = 11;
		}
		else if($channels[2]=="RECOMMEND")//chat
		{
			 $channel_id = 2; 
		}
		else if($channels[3]=="RECOMMEND")//email
		{
			$channel_id = 3;
		}
		else//call us
		{
		 	$channel_id = 4;
		}
		
		$rec_channel_id=$this->recommended_channel_click_tracking($request_Id, $member_Id,$channel_id,$current_url);
		array_push($channels,$rec_channel_id);
		return $channels; 
	}

	function recommended_channel_click_tracking($request_id, $member_id,$channel_id,$current_url)
	{
		$channel_tracking = new RNCPHP_CO\channel_tracking();
		$channel_tracking->member_type = $member_id;
		$channel_tracking->request = $request_id;			
		$path = explode("/", $current_url);
		$page = array_search('app', $path);
		$line_of_business = array_search('lob', $path);
		
		$lobs = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\line_of_business"); 
		foreach($lobs as $items) 
		{
			if($items->LookupName == $path[$line_of_business+1])
			{
				$channel_tracking->line_of_business = $items;
			}
		} 
		$pages = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\page_details");
		foreach($pages as $items) 
		{
			if($items->LookupName == $path[$page+1])
			{
				$channel_tracking->page_details = $items;
			}
		} 
		$recommended_channel = RNCPHP\ConnectAPI::getNamedValues("RightNow\\Connect\\v1_2\\CO\\rec_channels");
		if(($member_id == 388)&&($request_id == 190))//Coach and Coach Cancel Account
		{
			foreach($recommended_channel as $items) 
			{
				if($items->ID == 11)
				{
					$channel_tracking->recommended_channel = $items;
					/*if($channel_id == 4)
					{*/
						$channel_tracking->selected_channel = $items;
					//}
				}
			} 
		}
		else
		{
			foreach($recommended_channel as $items) 
			{
				if($items->ID == $channel_id)
				{
					$channel_tracking->recommended_channel = $items;
					/*if($channel_id == 4)
					{*/
						$channel_tracking->selected_channel = $items;
					//}
				}
			} 
		}
		$channel_tracking->save();
		//echo "channel  ".$channel_tracking->recommended_channel." channel id is ".$channel_tracking->ID;
		//die("-----");
		return $channel_tracking->ID;			
	}
	
}
