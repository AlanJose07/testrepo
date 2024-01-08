<?php
namespace Custom\Widgets\reports;
use RightNow\Connect\v1_2 as RNCPHP;
class CustomMultiline extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        //return parent::getData();
		
        $format = array(
            'truncate_size' => $this->data['attrs']['truncate_size'],
            'max_wordbreak_trunc' => $this->data['attrs']['max_wordbreak_trunc'],
            'emphasisHighlight' => $this->data['attrs']['highlight'],
            'dateFormat' => $this->data['attrs']['date_format'],
            'urlParms' => \RightNow\Utils\Url::getParametersFromList($this->data['attrs']['add_params_to_url']),
        );
        $filters = array('recordKeywordSearch' => true);
        $reportToken = \RightNow\Utils\Framework::createToken($this->data['attrs']['report_id']);

        \RightNow\Utils\Url::setFiltersFromAttributesAndUrl($this->data['attrs'], $filters);

        $results = $this->CI->model('Report')->getDataHTML($this->data['attrs']['report_id'], $reportToken, $filters, $format)->result;

        if ($results['error'] !== null) {
            echo $this->reportError($results['error']);
        }
		/*Below code will hide the answer id which appends to the user guide answer*/
		/*by jithin*/
		 $msg = RNCPHP\MessageBase::fetch(1000041);
		 $ans_hide_id=explode(",",$msg->Value);
		for($i=0;$i<count($results['data']);$i++)
		{
				 $userguide_id=strip_tags(trim(trim(trim($results['data'][$i][1],"(ID:"),")")));
		         if(in_array($userguide_id, $ans_hide_id))    
				 unset($results['data'][$i]);		 	 	   	
		}
		/*by jithin*/        
		unset($this->data['js_templates']['view']);
		
        $this->data['reportData'] = $results;
		$this->data['js']['data']=$results;
		print_r($this->data['tabledata']['data']);
		
		
        if($this->data['attrs']['hide_when_no_results'] && count($this->data['reportData']['data']) === 0) {
            $this->classList->add('rn_Hidden');
        }
        $this->data['js'] = array(
            'filters' => $filters,
            'format' => $format,
            'r_tok' => $reportToken,
            'error' => $results['error']
        );
        $this->data['js']['filters']['page'] = $results['page'];
    

    }
}