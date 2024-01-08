<?php
namespace Custom\Widgets\ResponsiveDesign;

class CustomLogoutLink extends \RightNow\Widgets\LogoutLink {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }

    /**
     * Overridable methods from LogoutLink:
     */
    // function doLogout($parameters)
}