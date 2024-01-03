<?php
namespace Custom\Widgets\chat;
use RightNow\Connect\v1_3 as RNCPHP;
class ChatSurveyLink extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

		parent::getData();
		if(!getUrlParm('sid')){
			header('Location:/app/home');
		}
		$sid = getUrlParm('sid');
		$chatid = null;
		$ar= RNCPHP\AnalyticsReport::fetch(111779);//Survey Chat Session
		$filter= new RNCPHP\AnalyticsReportSearchFilter;
		$filter->Name = 'Session ID';
		$filter->Values = array($sid);
		$filters = new RNCPHP\AnalyticsReportSearchFilterArray;
		$filters[] = $filter;
		$arr= $ar->run(0,$filters); 
		$rowCount=$arr->count(); 
		if($rowCount == 0){
			header('Location:/app/home');
		} 	
		for ( $rowCounter = $rowCount; $rowCounter--; ){
			$row = $arr->next();
			$chatid=$row['Chat ID'];
			break;
			//return $referncenumber;
		}
		$this->CI->load->model('standard/Survey');
        $url =  $this->CI->Survey->buildSurveyURL(10,null,null,$chatid,null);//care survey
		$this->data['url'] = $url;
		$this->data['js']['url'] = $url;
    }
}