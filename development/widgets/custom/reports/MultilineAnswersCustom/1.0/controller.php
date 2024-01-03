<?php
namespace Custom\Widgets\reports;
use RightNow\Connect\v1_2 as RNCPHP;
class MultilineAnswersCustom extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
	    
		$CI = get_instance();
        $clang= $CI->session->getSessionData('clang');
		
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
		
		 if($clang=="ko_KR" && (getUrlParm('pt')!=1))
		{
		
		$c=getUrlParm('c');
		$msg = RNCPHP\MessageBase::fetch(1000003);
		$links=$msg->Value;
		$links=explode(",",$links);
		
		foreach($links as $key=>$value)
		{
		$lnk=explode("-",$value);
	   
		list($a,$b)=explode("-",$value,2);
		
		
			if(strcmp($b,$c)==0)
			{
			$ca=$a;
			
			}
		}
		
		$filters['c']->filters->data[0]=$ca;
		}
		
		
		
		

        //$results = $this->CI->model('Report')->getDataHTML($this->data['attrs']['report_id'], $reportToken, $filters, $format)->result;
		//Loading the custom model to bring the answers retaining the html links
		//print_r($filters);
		$results = $this->CI->model('custom/custom_report_model')->getDataHTML($this->data['attrs']['report_id'], $reportToken, $filters, $format)->result;
		
	
        if ($results['error'] !== null) {
            echo $this->reportError($results['error']);
        }
		
        $this->data['reportData'] = $results;
        if($this->data['attrs']['hide_when_no_results'] && count($this->data['reportData']['data']) === 0) {
            $this->classList->add('rn_Hidden');
        }
        $this->data['js'] = array(
            'filters' => $filters,
            'format' => $format,
            'r_tok' => $reportToken
        );
        $this->data['js']['filters']['page'] = $results['page'];
		// For getting the count of data
		$this->data['js']['cntresult'] = count($results['data']);
		
			$CI = get_instance();
			$all_param= $CI->session->getSessionData('urlParameters');
			$all_parameters= array();
			foreach($all_param as $array) {
 			foreach($array as $k=>$v) {
    		$all_parameters[$k][] = $v;
 	   		}
	   		}
			
			if(array_key_exists('tailNumber', $all_parameters))
			{
				if(is_array($all_parameters['tailNumber']))
				{
					$tailNumber = end($all_parameters['tailNumber']);
				}
				else
				{
					$tailNumber = $all_parameters['tailNumber'];
				}
			}
			$res_aline=$CI->model('custom/language_model')->getaline($tailNumber);
			$prod=$res_aline[0];
		
		if($prod=="")
		{
		$prod="ground";
		}
		else
		{
		$prod=$prod;
		}
		$this->data['js']['prod']=$prod;
		$this->data['prod']=$prod;
    }
}