<?php
namespace Custom\Widgets\reports;

class ResultInfoPrivate extends \RightNow\Widgets\ResultInfo {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        return parent::getData();

    }

    /**
     * Overridable methods from ResultInfo:
     */
    // protected function addCommunityResults($keyword)
    // protected function addCombinedResults(array &$data, $page, $numberOfAdditionalResults)
}