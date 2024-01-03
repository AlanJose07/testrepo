<?php
namespace Custom\Widgets\feedback;

class customFeedback extends \RightNow\Widgets\AnswerFeedback {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        parent::getData();
		$keyword = getUrlParm('kw');
		$this->data['js']['keyword'] = $keyword;

    }

    /**
     * Overridable methods from AnswerFeedback:
     */
    // protected function getRateLabels()
}