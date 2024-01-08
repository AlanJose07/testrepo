<?php
namespace Custom\Widgets\input;
use RightNow\Utils\Url,
    RightNow\Utils\Text;

class ProductCategoryInputCustom extends \RightNow\Widgets\ProductCategoryInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

        
        $dataType = $this->data['attrs']['data_type'] = (Text::stringContains(strtolower($this->data['attrs']['data_type']), 'prod'))
            ? self::PRODUCT
            : self::CATEGORY;

        if ($this->data['attrs']['data_type'] === self::CATEGORY) {
            $this->data['attrs']['label_all_values'] =
                ($this->data['attrs']['label_all_values'] === \RightNow\Utils\Config::getMessage(ALL_PRODUCTS_LBL))
                ? \RightNow\Utils\Config::getMessage(ALL_CATEGORIES_LBL)
                : $this->data['attrs']['label_all_values'];

            $this->data['attrs']['label_input'] =
                ($this->data['attrs']['label_input'] === \RightNow\Utils\Config::getMessage(PRODUCT_LBL))
                ? \RightNow\Utils\Config::getMessage(CATEGORY_LBL)
                : $this->data['attrs']['label_input'];

            $this->data['attrs']['label_nothing_selected'] =
                ($this->data['attrs']['label_nothing_selected'] === \RightNow\Utils\Config::getMessage(SELECT_A_PRODUCT_LBL))
                ? \RightNow\Utils\Config::getMessage(SELECT_A_CATEGORY_LBL)
                : $this->data['attrs']['label_nothing_selected'];
        }

        if ($this->data['attrs']['table'] === 'contacts') {
            echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(PCT_S_SUPP_VALUE_PCT_S_ATTRIB_MSG), 'contacts', 'table'));
            return false;
        }
        $this->data['js']['name'] = $this->data['attrs']['name'] = "Incident.{$this->data['attrs']['data_type']}";

        if (parent::getData() === false) return false;

        if (!in_array($this->dataType, array('ServiceProduct', 'ServiceCategory'))) {
            echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(DATA_TYPE_PCT_S_APPR_PROD_S_CAT_MSG), $this->fieldName));
            return false;
        }

        if($this->data['attrs']['required_lvl'] > $this->data['attrs']['max_lvl']) {
            echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(VAL_PCT_S_EXCEEDS_PCT_S_PCT_S_SET_MSG), "required_lvl", "max_lvl", "max_lvl", "required_lvl", $this->data['attrs']['required_lvl']));
            $this->data['attrs']['max_lvl'] = $this->data['attrs']['required_lvl'];
        }

        if($this->data['attrs']['hint'] && strlen(trim($this->data['attrs']['hint']))){
            $this->data['js']['hint'] = $this->data['attrs']['hint'];
        }

        $trimmedTreeViewCss = trim($this->data['attrs']['treeview_css']);
        if ($trimmedTreeViewCss !== '')
            $this->addStylesheet($trimmedTreeViewCss);

        $this->data['js']['linkingOn'] = $this->data['attrs']['linking_off'] ? 0 : $this->CI->model('Prodcat')->getLinkingMode();
        $this->data['js']['hm_type'] = ($dataType === self::PRODUCT) ? HM_PRODUCTS : HM_CATEGORIES;

        //Build up a tree of the default data set given a default chain. If there is not a default chain and linking
        //is off, just return the top level products or categories. If linking is on and this is the category
        //widget, return all of the linked categories.
        $maxLevel = $this->data['attrs']['max_lvl'];
        $defaultChain = $this->getDefaultChain();
        if($this->data['js']['linkingOn'] && $dataType === self::CATEGORY) {
            $defaultProductID = $this->CI->model('Prodcat')->getDefaultProductID() ?: null;
            $this->data['js']['link_map'] = $defaultHierMap = $this->CI->model('Prodcat')->getFormattedTree($dataType, $defaultChain, true, $defaultProductID, $maxLevel)->result;
            $this->data['js']['hierDataNone'] = $this->CI->model('Prodcat')->getFormattedTree($dataType, array(), true, null, $maxLevel)->result;
            array_unshift($this->data['js']['hierDataNone'][0], array('id' => 0, 'label' => $this->data['attrs']['label_all_values']));
            array_unshift($this->data['js']['link_map'][0], array('id' => 0, 'label' => $this->data['attrs']['label_all_values']));
        }
        else {
            if($dataType === self::PRODUCT) {
                $this->CI->model('Prodcat')->setDefaultProductID(end($defaultChain));
            }
            $defaultHierMap = $this->CI->model('Prodcat')->getFormattedTree($dataType, $defaultChain, false, null, $maxLevel)->result;
        }

        //Add in the all values label
        array_unshift($defaultHierMap[0], array('id' => 0, 'label' => $this->data['attrs']['label_all_values']));
        $this->data['js']['hierData'] = $defaultHierMap;
		$server_current_time = time();
		//echo $server_current_time; echo"<br>";
		$php_timestamp_date = date("m/d/Y h:i A", $server_current_time);
	    $this->data['js']['server_time'] = $php_timestamp_date;
    

    }

    /**
     * Overridable methods from ProductCategoryInput:
     */
    // protected function getDefaultChain()
}