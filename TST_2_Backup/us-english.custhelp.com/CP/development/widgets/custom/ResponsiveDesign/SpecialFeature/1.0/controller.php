<?php
namespace Custom\Widgets\ResponsiveDesign;

class SpecialFeature extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        /*return parent::getData();*/
		$results = $this->CI->model('custom/CustomObjectData')->fetchSpecialFeatureData();
		$this->data['resultData'] = $results;
        // echo '<pre>';
        // print_r($results);exit;
		/*echo "<pre>";
		print_r($results[0]);
		die("------------------------------------------------");*/

    }
}