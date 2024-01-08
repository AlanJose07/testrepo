<?php
namespace Custom\Widgets\ResponsiveDesign;

class CustomFileAttachmentUpload extends \RightNow\Widgets\FileAttachmentUpload {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }

    /**
     * Overridable methods from FileAttachmentUpload:
     */
    // function generateFormConstraints()
}