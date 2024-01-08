<?php
namespace Custom\Widgets\reports;

class CustomMultiline2 extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

   function getData() {
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
        $this->data['reportData'] = $results;
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
		foreach($this->data['reportData']['data'] as &$record){
             $url = $this->get_string_between($record[0],"href='", "'>");
             $string_param = strip_tags($this->get_string_between($record[0],"'>","</a>"));
             $string_param = urlencode($string_param);
             $string_param = str_replace("+","-",$string_param);
             $string_param = strtolower($string_param);
             $new_url = $url."/~/".$string_param;
			 			 
             $record[0] = str_replace($url, $new_url, $record[0]);
        }
    }
	function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }
}