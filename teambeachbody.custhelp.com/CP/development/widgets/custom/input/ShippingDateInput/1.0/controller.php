<?php
namespace Custom\Widgets\input;
use RightNow\Utils\Config,
    RightNow\Utils\Text;

class ShippingDateInput extends \RightNow\Widgets\DateInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

          if(parent::getData() === false)
            return false;
        if(!in_array($this->dataType, array('Date', 'DateTime'))) {
            echo $this->reportError(sprintf(Config::getMessage(PCT_S_DATE_DATE_SLASH_TIME_FIELD_MSG), $this->fieldName));
            return false;
        }

        $this->data['displayType'] = $this->dataType;
        $minYear = $this->data['minYear'] =  $this->data['js']['minYear'] = $this->data['attrs']['min_year'];
        $this->data['maxYear'] = $this->data['attrs']['max_year'];
        if (!$this->data['readOnly']) {
            $this->data['constraints']['minValue'] = strtotime($minYear . '-' . Text::getSubstringAfter(MIN_DATE, '-'));
            $this->data['constraints']['maxValue'] = strtotime($this->data['attrs']['max_year'] . '-' . Text::getSubstringAfter(MAX_DATE, '-'));
        }
        $this->data['dayLabel'] = Config::getMessage(DAY_LBL);
        $this->data['monthLabel'] = Config::getMessage(MONTH_LBL);
        $this->data['yearLabel'] = Config::getMessage(YEAR_LBL);
        $this->data['hourLabel'] = Config::getMessage(HOUR_LBL);
        $this->data['minuteLabel'] = Config::getMessage(MINUTE_LBL);
		
     

        
		$AddTwoWeek = time()+ (2 * 24 * 60 * 60);;
        $this->data['value']= $AddTwoWeek;
		

        $dateOrder = Config::getConfig(DTF_INPUT_DATE_ORDER);
        //mm/dd/yyyy
        if ($dateOrder == 0) {
            $this->data['monthOrder'] = 0;
            $this->data['dayOrder'] = 1;
            $this->data['yearOrder'] = 2;
            if ($this->dataType === 'DateTime')
                $this->data['js']['min_val'] = "1/2/$minYear 09:00";
            else
                $this->data['js']['min_val'] = "1/2/$minYear";
        }
        //yyyy/mm/dd
        else if ($dateOrder == 1) {
            $this->data['monthOrder'] = 1;
            $this->data['dayOrder'] = 2;
            $this->data['yearOrder'] = 0;
            if ($this->dataType === 'DateTime')
                $this->data['js']['min_val'] = sprintf("{$minYear}%s/1%s/2%s 09:00", $this->data['yearLabel'], $this->data['monthLabel'], $this->data['dayLabel']);
            else
                $this->data['js']['min_val'] = sprintf("{$minYear}%s/1%s/2%s", $this->data['yearLabel'], $this->data['monthLabel'], $this->data['dayLabel']);
        }
        //dd/mm/yyyy
        else {
            $this->data['monthOrder'] = 1;
            $this->data['dayOrder'] = 0;
            $this->data['yearOrder'] = 2;
            if ($this->dataType === 'DateTime')
                $this->data['js']['min_val'] = "2/1/$minYear 09:00";
            else
                $this->data['js']['min_val'] = "2/1/$minYear";
        }
        if($this->data['value'])
		 {
		 
           $this->data['value'] = explode(' ', date('m j Y G i', intval($this->data['value'])));
		   $this->data['js']['min_date'] = $this->data['value'];
		   
		 
            $this->data['defaultValue'] = true;
        }

    }

    /**
     * Overridable methods from DateInput:
     */
    // public function outputSelected($index, $itemIndex)
}