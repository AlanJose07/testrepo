<?php
namespace Custom\Widgets\custom;
use RightNow\Connect\v1_3 as RNCPHP;
class contactus extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }
    function getData() {
        parent::getData();
		//$reportid=(int) $this->data['attrs']['report_id'];
		$idvalue=$this->data['attrs']['id_value'];
		//$filtername = $this->data['attrs']['filter_name'];
		$this->data['email'] = $this->data['attrs']['email'];
		//109977
		try
		{
			
			if($idvalue>0)
			{
			$answer = RNCPHP\Answer::fetch((int) $idvalue);
			//print_r($answer);exit;
			$this->data['Summary'] = $answer->Summary;
			$this->data['Answer'] = $answer->Solution;
			}
			
			
		}catch(RNCPHP\ConnectAPIError $e)
			{
				echo $e->getMessage();
			}
			catch(\Exception $e)
			{
				echo $e->getMessage();
			}
		
		
		
    }
}