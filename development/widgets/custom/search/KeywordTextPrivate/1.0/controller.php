<?php
namespace Custom\Widgets\search;
use RightNow\Connect\v1_2 as RNCPHP;

class KeywordTextPrivate extends \RightNow\Widgets\KeywordText {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		\RightNow\Utils\Url::setFiltersFromAttributesAndUrl($this->data['attrs'], $filters);
        $reportToken = \RightNow\Utils\Framework::createToken($this->data['attrs']['report_id']);
        $searchTerm = $this->CI->model('Report')->getSearchTerm($this->data['attrs']['report_id'], $reportToken, $filters)->result;
        $this->data['js'] = array(
            'initialValue' => $searchTerm ?: '',
            'rnSearchType' => 'keyword',
            'searchName' => 'keyword',
        );
	   $CI = get_instance();
	   $c_id = $this->CI->session->getProfile()->c_id->value;
	   $c1 = RNCPHP\Contact::fetch($c_id);
	   $count=(count($c1->ServiceSettings->SLAInstances));
	   $sla=$c1->ServiceSettings->SLAInstances[$count-1]->NameOfSLA->LookupName;
	   $this->data['js']['sla']=$sla;
	   
    }
}