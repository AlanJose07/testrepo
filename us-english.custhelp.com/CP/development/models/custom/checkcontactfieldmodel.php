<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();

$CI->model('Field');
use RightNow\Utils\Connect,

    RightNow\Utils\Text,
    RightNow\Utils\Framework,
    RightNow\Api;
class checkcontactfieldmodel extends \RightNow\Models\Field{
    function __construct()
	
    {
         parent::__construct();
    }

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
            return $this->getResponseObject(null, null, Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG));
        }

        if ($presentFields['Contact']) {
            //Contact update
            if (Framework::isLoggedIn()) {
                $result = $this->CI->model('Contact')->update($this->CI->session->getProfileData('contactID'), $formData);
                $action = 'Updated';
            }
            //Incident create email only (and can optionally contain other contact fields)
            else if($formData['Contact.Emails.PRIMARY.Address'] && $formData['Contact.Emails.PRIMARY.Address']->value && $presentFields['Incident']){
                $existingContact = $this->CI->model('Contact')->lookupContactByEmail(
                    $formData['Contact.Emails.PRIMARY.Address']->value,
                    $formData['Contact.Name.First'] ? $formData['Contact.Name.First']->value : null,
                    $formData['Contact.Name.Last'] ? $formData['Contact.Name.Last']->value : null
                )->result;
				
                if($existingContact){
				    echo gettype($existingContact)."<br>";
				    print_r($existingContact)."<br>";
					echo $existingContact;
					exit;
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
           print_r($formData);exit;      
        if ($presentFields['Incident']) {
            if ($incidentIDToUpdate = $listOfUpdateIDs['i_id']) {
                $result = $this->CI->model('Incident')->update($incidentIDToUpdate, $formData);
                $action = 'Updated';
            }
            else {
			
                $result = $this->CI->model('Incident')->create($formData, $smartAssistant);
                $action = 'Created';
            }
            $actions += $processActions('incident', $action, $result);
        }

        if ($presentFields['Asset']) {
            $productID = $listOfUpdateIDs['product_id'];
            if ($assetIDToUpdate = $listOfUpdateIDs['asset_id']) {
                $serialNumber = $listOfUpdateIDs['serial_no'];
                if($serialNumber !== null) {
                    $serialNumber = urldecode($serialNumber);
                }
                $result = $this->CI->model('Asset')->update($assetIDToUpdate, $formData, $serialNumber);
                $action = 'Updated';
            }
            else {
                $result = $this->CI->model('Asset')->create($productID, $formData);
                $action = 'Created';
            }
            $actions += $processActions('asset', $action, $result);
        }

        return $this->getStatus($actions);
    }
	
	
	 private function processFields(array $fields, &$presentFields = array()) {
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
	
	private function getStatus(array $actions) {
        $errors = array();
        $result = array(
            'sessionParam' => \RightNow\Utils\Url::sessionParameter(),
            'transaction' => array(),
        );

        if ($contact = $actions['contact']) {
            if (is_object($contact) && $contact->ID) {
                $result['transaction']['contact'] = array('value' => $contact->ID);

                if ($actions['contactCreated'] && $contact->Login !== null && !$this->cookiesEnabled()) {
                    $result['redirectOverride'] = '/app/error/error_id/7';
                }
            }
            else {
                unset($result['transaction']);
                $errors = $contact;
            }
        }

        if (!$errors && ($incident = $actions['incident'])) {
            if (is_object($incident) && $incident->ID) {
                $result['transaction']['incident'] = Framework::isLoggedIn()
                    ? array('key' => 'i_id', 'value' => $incident->ID)
                    : array('key' => 'refno', 'value' => $incident->ReferenceNumber);
            }
            else if (is_array($incident)) {
                unset($result['transaction']);
                if ($actions['incidentCreated']) {
                    // Smart Assistant results
                    $result['sa'] = $incident;
                    if ($actions['contactCreated'] && is_object($contact) && $contact->ID) {
                        // Generate a new token if SA results were returned and a new contact was created. A new token is needed
                        // because it's generated based off the contact ID of the logged-in user. When the first token was generated
                        // there wasn't a logged-in user, but during the first submit when SA results are returned, the user does become
                        // logged in (if a new contact was created). Therefore, during the second submit, the original token is no longer valid.
                        $result['newFormToken'] = Framework::createTokenWithExpiration(0);
                    }
                }
                else {
                    $errors += $incident;
                }
            }
        }

        if (!$errors && ($asset = $actions['asset'])) {
            if (is_object($asset) && $asset->ID) {
                $result['transaction']['asset'] = array('value' => $asset->ID);
            }
            else {
                unset($result['transaction']);
                $errors += $asset;
            }
        }

        return $this->getResponseObject($result, 'is_array', $errors);
    }
	
	 private function verifyFormToken($tokenName = 'f_tok', $tokenSeed = 0) {
        if (!Framework::isValidSecurityToken($this->CI->input->post($tokenName), $tokenSeed)) {
            return $this->getResponseObject(array('redirectOverride' => '/app/error/error_id/5', 'sessionParam' => \RightNow\Utils\Url::sessionParameter()), 'is_array',
                Config::getMessage(FORM_SUBMISSION_TOKEN_MATCH_EXP_MSG)
            );
        }
    }
	
	private function cookiesEnabled() {
        return ($this->CI->session->canSetSessionCookies() && $this->CI->session->getSessionData('cookiesEnabled')) ||
            Framework::checkForTemporaryLoginCookie();
    }
}
