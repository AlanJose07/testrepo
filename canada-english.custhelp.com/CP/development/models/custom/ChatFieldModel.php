<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();
$CI->model('Field');
use RightNow\Utils\Connect,
    RightNow\Utils\Text,
    RightNow\Utils\Framework,
    RightNow\Api;
class ChatFieldModel extends \RightNow\Models\Field{
    function __construct()
    {
        parent::__construct();
    }

      /** 
     * Generic function to handle form submission. Processes form input and performs the following actions:
     *
     * * Contact creation: contact fields are present and the user's not logged in
     * * Contact update: contact fields are present and the user's logged in
     * * Incident creation: incident fields are present and $updateID is null
     * * Incident update: incident fields are present and $updateID is not null
     *
     * Expected format of each field in the $formData array:
     *
     *      - value: (string|int) Field's value
     *      - name: (string) "Object.Field" (e.g. Contact.Login)
     *      - required: (boolean) Whether a value is required
     *
     * @param array $formData All submitted form data
     * @param array $listOfUpdateIDs List of IDs for the records we're updating. Keys should be ID type (i_id) and values should be the ID
     * @param boolean $smartAssistant True/false denoting if smart assistant should be run
     * @return array Details of the form submit action including any errors that might have occured
     */
    public function sendForm($formData, $listOfUpdateIDs = array(), $smartAssistant = false) {

        if ($tokenError = $this->verifyFormToken()) return $tokenError;

        $actions = array();
        $processActions = function($type, $action, $response) {
            return array(
                $type               => $response->result ?: $response->errors,
                "{$type}{$action}"  => ($response->errors) ? false : true,
            );
        };
        $formData = $this->processFields($formData, $presentFields);

        if (!$formData || !array_intersect(array_keys($presentFields), array_keys(Connect::getSupportedObjects(), 'read,write'))) {
            Api::phpoutlog("The form did not contain any fields with names of the Connect objects for which we have read and write support. Fields present: " . var_export($presentFields, true));
            return $this->getResponseObject(null, null, \RightNow\Utils\Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
        }

        if ($presentFields['Contact']) {
            //Contact update
            if (Framework::isLoggedIn()) {
                $result = $this->CI->model('Contact')->update($this->CI->session->getProfileData('contactID'), $formData);
                $action = 'Updated';
            }
            //Incident create email only (and can optionally contain other contact fields)
            else if($formData['Contact.Emails.PRIMARY.Address'] && $formData['Contact.Emails.PRIMARY.Address']->value && $presentFields['Incident']){
                $existingContact = $this->CI->model('Contact')->lookupContactByEmail($formData['Contact.Emails.PRIMARY.Address']->value,
                                                                                     $formData['Contact.Name.First'] ? $formData['Contact.Name.First']->value : null,
                                                                                     $formData['Contact.Name.Last'] ? $formData['Contact.Name.Last']->value : null)->result;
                if($existingContact){
                    $formData['Incident.PrimaryContact'] = $existingContact;
                }
                else{
                    $result = $this->CI->model('Contact')->create($formData, true);
                    if($result->result && $result->result->ID){
                        $formData['Incident.PrimaryContact'] = $result->result;
                    }
                    $action = 'Created';
                }
            }
            //Contact create
            else{
                $result = $this->CI->model('Contact')->create($formData, true);
                $action = 'Created';
            }
            if($action){
                $actions += $processActions('contact', $action, $result);
            }
        }

        if ($presentFields['Incident']) {
            if ($incidentIDToUpdate = $listOfUpdateIDs['i_id']) {
                $result = $this->CI->model('Incident')->update($incidentIDToUpdate, $formData);
                $action = 'Updated';
				
				
            }
            else {
            	
                $result = $this->CI->model('custom/SmartAsstChatModel')->create($formData, $smartAssistant); 
				  
                $action = 'Created';
            }
            $actions += $processActions('incident', $action, $result);
        }
        return $this->getStatus($actions);
    }
	  /**
     * Builds an array containing the status of the transaction.
     * @param array $actions May contain the following values:
     *  - contact: object Created/updated contact object
     *  - contactUpdated: boolean exists if the transaction was a contact update
     *  - contactCreated: boolean exists if the transaction was a contact create
     *  - incident: object Created/update incident object
     *  - incidentUpdated: boolean exists if the transaction was a incident update
     *  - incidentCreated: boolean exists if the transaction was a incident create
     * @return array Status of the form submission; contains the following values:
     *  - transaction: (array) keyed by names of the objects involved with the transaction;
     *            values are arrays with a 'value' key; an optional 'key' key may be provided if
     *            it is intended that the key and value is to be added as a URL parameter on
     *            the success redirect page; e.g.
     *            [contact => [value: 1278], incident => [value: '123212-000002', key: 'refno']]
     *  - errors: (string) Error message for a failure (actually contained in ResponseObject)
     *  - redirectOverride: (String) Error page that the client should redirect to
     *  - sa: (array) Smart assistant results
     *  - newFormToken: (string) Exists if Smart assistant results are returned
     *                  and the transaction created and logged-in a new contact
     *  - sessionParam: (string) Generated session string
     */
    private function getStatus(array $actions) {
        $errors = array();
        $return = array(
            'sessionParam' => \RightNow\Utils\Url::sessionParameter(),
            'transaction' => array(),
        );

        if ($contact = $actions['contact']) {
            if (is_object($contact) && $contact->ID) {
                $return['transaction']['contact'] = array('value' => $contact->ID);

                if ($actions['contactCreated'] && !$this->cookiesEnabled()) {
                    $return['redirectOverride'] = '/app/error/error_id/7';
                }
            }
            else {
                unset($return['transaction']);
                $errors = $contact;
            }
        }

        if (!$errors && ($incident = $actions['incident'])) {
            if (is_object($incident) && $incident->ID) {
                $return['transaction']['incident'] = Framework::isLoggedIn()
                    ? array('key' => 'i_id', 'value' => $incident->ID)
                    : array('key' => 'refno', 'value' => $incident->ReferenceNumber);
            }
            else if (is_array($incident)) {
                if ($actions['incidentCreated']) {
                    // Smart Assistant results
					
                    $return['sa'] = $incident;  
                    if ($actions['contactCreated'] && is_object($contact) && $contact->ID) {
                        // Generate a new token if SA results were returned and a new contact was created. A new token is needed
                        // because it's generated based off the contact ID of the logged-in user. When the first token was generated
                        // there wasn't a logged-in user, but during the first submit when SA results are returned, the user does become
                        // logged in (if a new contact was created). Therefore, during the second submit, the original token is no longer valid.
                        $return['newFormToken'] = Framework::createTokenWithExpiration(0);
                    }
					  
                    unset($return['transaction']);
                }
                else {
                    unset($return['transaction']);
                    $errors += $incident;
                }
            }
        }
		

        return $this->getResponseObject($return, 'is_array', $errors);
    }
	  /**
     * Processes form fields. Takes an array of fields and returns an associative array keyed by each field's name.
     * @param array $fields Form fields
     * @param array $presentFields Pass by reference variable keyed by the name of the object that field(s) belong to;
     * so given:
     *
     *         [{name: 'Contact.Login', ...}, {name: 'Incident.Subject', ...}, {name: 'ArbitraryName', ...}]
     *
     * , this variable is be populated with:
     *
     *         ['Contact' => true, 'Incident' => true]
     *
     * @return array Associative array whose keys are each field's name and values are the fields
     * (each field's name property is unset)
     */
    private function processFields($fields, &$presentFields = array()) {
        $return = array();

        foreach ($fields as $field) {
            $fieldName = $field->name;

            if (!is_string($fieldName) || $fieldName === '') continue;

            unset($field->name);
            $return[$fieldName] = $field;

            if ($objectName = Text::getSubstringBefore($fieldName, '.')) {
                $presentFields[$objectName] = true;
            }
        }

        return $return;
    }

	
	 /**
     * Validates form token POST param to protect against XSRF.
     * @param string $tokenName Name of the token param; defaults to f_tok
     * @param int|string $tokenSeed Seed value used to generate the token
     * @return array|null Array if the token is invalid or null if the token is valid
     */
    private function verifyFormToken($tokenName = 'f_tok', $tokenSeed = 0) {
        if (!Framework::isValidSecurityToken($this->CI->input->post($tokenName), $tokenSeed)) {
            return $this->getResponseObject(array('redirectOverride' => '/app/error/error_id/5', 'sessionParam' => \RightNow\Utils\Url::sessionParameter()), 'is_array',
                "The form submission token either did not match or has expired"
            );
        }
    }
	  /**
     * Checks whether cookies are enabled.
     * @return boolean True whether cookies are enabled, false otherwise
     */
    private function cookiesEnabled() {
        return ($this->CI->session->canSetSessionCookies() && $this->CI->session->getSessionData('cookiesEnabled')) ||
            Framework::checkForTemporaryLoginCookie();
    }
}
