<?php
namespace Custom\Widgets\ResponsiveDesign;

class ChatHoursPrechat extends \RightNow\Widgets\ChatHours {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
	
		parent::getData();

        $nowtimezone = $hoursData['time_zone'] = strftime('%Z');
		  
		$hourswithspace = array("0:00", "1:00", "2:00", "3:00", "4:00", "5:00", "6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00");
		$hourswithoutspace = array("0","1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24");
		
		for ($i = 0; $i < count($this->data['chatHours']['hours']); $i++)
						{
						//	echo $this->data['chatHours']['hours'][$i][0];
						//	echo $this->data['chatHours']['hours'][$i][0];
							//echo $this->data['chatHours']['hours'][$i][0];
							//echo $this->data['chatHours']['hours'][$i][1];
							//echo $this->data['chatHours']['hours'][$i][2];
							//echo $this->data['chatHours']['hours'][$i][3];
								
							if($this->data['chatHours']['hours'][$i][0]=='samedi - dimanche'){
								$this->data['chatHours']['hours'][$i][0]='Samedi et Dimanche';
									
							}else{
							
								if (strpos($this->data['chatHours']['hours'][$i][0], '-') !== false){
									$labels = explode("-",$this->data['chatHours']['hours'][$i][0]);
									$this->data['chatHours']['hours'][$i][0] = ucfirst(trim($labels[0]))." - ".ucfirst(trim($labels[1]));			
								}else{
									$this->data['chatHours']['hours'][$i][0] = ucfirst($this->data['chatHours']['hours'][$i][0]);
								}
							
							}
							
							
							if($this->data['chatHours']['hours'][$i][1]=='Fermé')
								{
									$this->data['chatHours']['hours'][$i][1]='fermé';
									
								}
							if($this->data['chatHours']['hours'][$i][1]=='24 heures'){
								$this->data['chatHours']['hours'][$i][1]='24h';
							}	
								
							if($this->data['chatHours']['hours'][$i][1]!='24h' && $this->data['chatHours']['hours'][$i][1]!='fermé'){
								$new = explode(",",$this->data['chatHours']['hours'][$i][1]);
								$string=NULL;
								foreach ($new as $value)
								{
								$new1 = explode("-",$value);
								if(date('G:i', strtotime($new1[1])) == "0:00")
								$new2=(date('G:i', strtotime($new1[0]))."h - 24h");
								else
								$new2=(date('G:i', strtotime($new1[0]))."h - ". date('G:i', strtotime($new1[1]))."h");
								$string.=$new2.", ";
								} //echo $string;
								$string=rtrim($string,', ');
								$string = str_replace($hourswithspace, $hourswithoutspace, $string);
								$this->data['chatHours']['hours'][$i][1] = $string;
							
							}	
												
						}
		  
		
		

    }
}