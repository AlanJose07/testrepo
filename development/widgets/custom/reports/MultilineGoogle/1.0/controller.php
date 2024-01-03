<?php
namespace Custom\Widgets\reports;

class MultilineGoogle extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

		$kw="";
		$kw=getUrlParm('kw');
		if($kw!="")
		{
		$this->data['attrs']['myvalue']=$kw;
		}

    }

    /**
     * Overridable methods from Multiline:
     */
    // function showColumn($value, array $header)
    // function getHeader(array $header)
}