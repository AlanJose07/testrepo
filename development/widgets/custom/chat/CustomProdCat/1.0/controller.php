<?php
namespace Custom\Widgets\chat;
use RightNow\Utils\Url,
    RightNow\Utils\Text;
class CustomProdCat extends \RightNow\Widgets\ProductCategoryInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        return parent::getData();

    }
	protected function getDefaultChain() {
        $dataType = $this->data['js']['data_type'];
        $shortDataType = ($dataType === self::PRODUCT) ? 'prod' : 'cat';
        $defaultValue = null;

        $postKeys = array(
            "Incident_$dataType",
            "incidents_$shortDataType",
            $shortDataType[0],
        );
        $urlKeys = array(
            "Incident.$dataType",
            "incidents.$shortDataType",
            $shortDataType[0],
        );

        // Look for a value in the the post vars. Generally only used by basic pageset
        foreach ($postKeys as $key) {
            $postParam = $this->CI->input->post($key);
            if ($postParam !== false) {
                $defaultValue = $postParam;
            }
        }

        // Look for a value in the incident data
        $incidentID = Url::getParameter('i_id');
        if (($defaultValue === false || $defaultValue === null) &&
            $incidentID && $incident = $this->CI->model('Incident')->get($incidentID)->result) {
            $incidentValue = $incident->{$dataType}->ID;
            if ($incidentValue) {
                $defaultValue = $incidentValue;
            }
        }

        // Look for a value in the widget attributes
        if ($defaultValue === false || $defaultValue === null) {
            $defaultFromAttribute = $this->data['attrs']['default_value'];
            if ($defaultFromAttribute !== false) {
                $defaultValue = $defaultFromAttribute;
            }
        }

        // If the given value is only one ID long then it may be the last ID in a chain.
        // Attempt to get the full chain. If a full chain is given, trust that it is correct and get
        // the end user visible portion of it.
        if($defaultValue) {
            $defaultChain = explode(',', $defaultValue);
            $defaultChain = (count($defaultChain) === 1)
                ? $this->CI->model('Prodcat')->getFormattedChain($dataType, $defaultChain[0], true)->result
                : $this->CI->model('Prodcat')->getEnduserVisibleHierarchy($defaultChain)->result;
            if(count($defaultChain) > $this->data['attrs']['max_lvl']) {
                $defaultChain = array_splice($defaultChain, 0, $this->data['attrs']['max_lvl']);
            }
        }

        return $defaultChain ?: array();
    }

    /**
     * Overridable methods from ProductCategoryInput:
     */
    // protected function getDefaultChain()
    // protected function pruneEmptyPaths(array $hierMap, array $defaultChain = array())
    // protected function buildListOfPermissionedProdcatIds()
    // protected function getProdcatInfoFromPermissionedHierarchies(array $prodcatHierarchies)
    // protected function updateProdcatsForReadPermissions(array &$prodcats, array $readableProdcatIds, array $readableProdcatIdsWithChildren)
}