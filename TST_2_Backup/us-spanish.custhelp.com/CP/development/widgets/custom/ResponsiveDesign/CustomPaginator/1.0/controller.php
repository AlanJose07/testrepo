<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Config;

class CustomPaginator extends \RightNow\Widgets\Paginator {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();
		
    }
}