<?php
namespace Custom\Widgets\ResponsiveDesign;

class Popular_answer_count extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();

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
		$cat=explode('.',substr($this->data['attrs']['static_filter'],2));
		//$this->data['js']['parent_cat_id']=substr($this->data['attrs']['static_filter'],2);
		$this->data['js']['parent_cat_id']=$cat[0];
		$this->data['js']['parent_cat_name']=$cat[1];
       
    }

   
}