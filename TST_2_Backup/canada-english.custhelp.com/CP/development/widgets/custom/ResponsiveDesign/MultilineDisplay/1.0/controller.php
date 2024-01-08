<?php
namespace Custom\Widgets\ResponsiveDesign;

class MultilineDisplay extends \RightNow\Widgets\Multiline {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        $format = array(
            'truncate_size' => $this->data['attrs']['truncate_size'],
            'max_wordbreak_trunc' => $this->data['attrs']['max_wordbreak_trunc'],
            'emphasisHighlight' => $this->data['attrs']['highlight'],
            'dateFormat' => $this->data['attrs']['date_format'],
            'urlParms' => \RightNow\Utils\Url::getParametersFromList($this->data['attrs']['add_params_to_url']),
        );
        $filters = array('recordKeywordSearch' => true);
        $reportToken = \RightNow\Utils\Framework::createToken($this->data['attrs']['report_id']);

        \RightNow\Utils\Url::setFiltersFromAttributesAndUrl($this->data['attrs'], $filters);
		$format = array(
             //'truncate_size' => $this->data['attrs']['truncate_size'],
             //'max_wordbreak_trunc' => $this->data['attrs']['max_wordbreak_trunc'],
            'emphasisHighlight' => $this->data['attrs']['highlight'],
            'dateFormat' => $this->data['attrs']['date_format'],
            'urlParms' => \RightNow\Utils\Url::getParametersFromList($this->data['attrs']['add_params_to_url']),
        );
        //$results = $this->CI->model('Report')->getDataHTML($this->data['attrs']['report_id'], $reportToken, $filters, $format)->result;custom/MultilineReport
		$results = $this->CI->model('Report')->getDataHTML($this->data['attrs']['report_id'],$reportToken, $filters,$format)->result;//$reportToken, $filters, $format)->result;
		
		/*echo "<pre>";
		var_dump($results['data']);
		foreach ($results['data'] as $result)
		{
			var_dump($result[1]);
		}*/
		$limit = count($results['data']);
		for ($x = 0; $x <= $limit-1; $x++) 
		{
			/*if($x == 9)
			{
				
			}*/
			$results['data'][$x][1] = $this->checkForClass($results['data'][$x][1]);
			$results['data'][$x][1] = $this->checkForClass($results['data'][$x][1]);//removing the div with class hide_this_section_from_answer_list for second time
			//$results['data'][$x][1] = $this->checkForClass($results['data'][$x][1]);
			$results['data'][$x][1] = substr(strip_tags($results['data'][$x][1]),0,$this->data['attrs']['truncate_size'])."...";
			/*$pos = strpos($results['data'][$x][1],'div id="hide_from_answer_list"');
			if($pos)
			{
				$start_pos = $pos - 1;
				$pos = strpos($results['data'][$x][1],'/div',$pos);
				$end_pos = $pos - 1;
				$diff = $end_pos - $start_pos;
				$first = substr($results['data'][$x][1],0,$start_pos);
				$second = substr($results['data'][$x][1],$end_pos);
				$complete_string = $first.$second;
				
				
				$results['data'][$x][1] = substr(strip_tags($first.$second),0,200)."...";
			}
			else
			{
				$results['data'][$x][1] = substr(strip_tags($results['data'][$x][1]),0,200)."...";
			}*/
		}
        if ($results['error'] !== null) {
            echo $this->reportError($results['error']);
        }  
        if($this->data['attrs']['hide_when_no_results'] && count($this->data['reportData']['data']) === 0) {
            $this->classList->add('rn_Hidden');
        }
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$exploded_url = explode("/",$url);
		
		$position = array_search("catid",$exploded_url);
		$cat_id = $exploded_url[$position+1];
		
		$position = array_search("TLP",$exploded_url);
		$tlp = $exploded_url[$position+1];
		
		if($cat_id == "")
		{
			$cat_id = 0;
		}
		if($tlp == "")
		{
			$tlp = 0;
		}
		$count_results = count($results['data']);
		
		for($i=0;$i<$count_results;$i++)
		{
			/*$str = strip_tags($results['data'][$i][2]);
			$c_pos = strpos($str,"catid");
			$tlp_pos = strpos($str,"TLP");
			die("------------------".$results['data'][$i][2]);   
			if($c_pos==-1 && $tlp_pos==-1)
			{*/
				$results['data'][$i][2] = strip_tags($results['data'][$i][2]);
				$results['data'][$i][2].="/catid/".$cat_id."/TLP/".$tlp;
				$results['data'][$i][2] = $results['data'][$i][2];
			/*}*/
		}
        $this->data['reportData'] = $results;
        $this->data['js'] = array(
            'filters' => $filters,
            'format' => $format,
            'r_tok' => $reportToken,
            'error' => $results['error']
        );
        $this->data['js']['filters']['page'] = $results['page'];
        //Fields to hide
        $this->data['js']['hide_columns'] = array_map('trim', explode(",", $this->data['attrs']['hide_columns']));
    }
	function checkForClass($res)
	{
		$pos = strpos($res,'div class="hide_this_section_from_answer_list"');
		/*echo $res;
		var_dump($pos); 
		die("------233232-----");*/
		if($pos)
		{
			$start_pos = $pos - 1;
			$pos = strpos($res,'/div',$pos);
			$end_pos = $pos - 1;
			$first = substr($res,0,$start_pos);
			$second = substr($res,$end_pos);			
			
			$res = $first.$second;//substr(strip_tags($first.$second),0,200)."...";
		}
		return $res;
	}

    /**
     * Overridable methods from Multiline:
     */
    // function showColumn($value, array $header)
    // function getHeader(array $header)
}