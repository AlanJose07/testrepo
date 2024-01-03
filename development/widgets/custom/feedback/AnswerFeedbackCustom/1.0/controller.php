<?php
namespace Custom\Widgets\feedback;

class AnswerFeedbackCustom extends \RightNow\Widgets\AnswerFeedback {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }

    /**
     * Overridable methods from AnswerFeedback:
     */
    // protected function getRateLabels()
}