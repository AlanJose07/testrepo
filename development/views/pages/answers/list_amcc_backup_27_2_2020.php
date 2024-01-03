<?php $c_id = $this->session->getProfile()->c_id->value;
$c1 = RightNow\Connect\v1_2\Contact::fetch($c_id);
$count=(count($c1->ServiceSettings->SLAInstances));
$sla=$c1->ServiceSettings->SLAInstances[$count-1]->NameOfSLA->LookupName;
if($sla!=="AMCC") 
header("Location:/app/answers/list");
?>
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="amcc.php" clickstream="answer_list" login_required="true"/>
<rn:widget path="custom/input/Getlogin" />

<rn:widget path="knowledgebase/RssIcon"/>
<rn:container report_id="101195" per_page="20">
    <div id="page" align="left" style="font-size:18px;line-height: 1.6; margin-left:15px;"></div>
    <?php 
    if(getUrlParm('tail'))
    {
    $tail=getUrlParm('tail');
    $kw=getUrlParm('kw');
    $CI = get_instance();
    $tech=$CI->model('custom/language_model')->getTech($tail);
    $tec=$tech[0]; 
    if($tec=="2KU")
    $tec="2Ku";
	?>
    <style type="text/css">
        #info{
            display:block;
        }
    </style>
    <?php
    }
    else
    {
    ?>
    <style type="text/css">
        #info{
            display:none;
        }
    </style>
    <?php
    }?>
    <html>
    <style>
	#det{
	 overflow: auto;
	}
	</style>
    <body>
    <div id="info">
        <div class="w_100">
            <div class="w_60">
                <div class="column" id="det" style="width:100%; height:400px;">
                    </div>
                    <body onLoad="myFunction()">
<script type="text/javascript">
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}
Date.prototype.substractDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() - days);
    return date;
}
function convert(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth()+1)).slice(-2),
        day  = ("0" + date.getDate()).slice(-2);
    return [ date.getFullYear(), mnth, day ].join("-");
}
function myFunction() {
var str =window.location.pathname;
var n = str.indexOf("tail");
var tail=window.location.pathname.substr(n);
var array=tail.split("/");
tail=array[1];
var xhr = new XMLHttpRequest();
var parsedData;
xhr.open("GET", "http://dataservices.fig.prods.gogoair.com/v1/flights?registration-number="+tail+"&order-by=scheduled-time&order-asc=false&detail=true");
xhr.onload = function () {
    parsedData=JSON.parse(xhr.responseText);
	var length = parsedData.length;
var myTable= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr><td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept Date</td>";
myTable+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept Time</td>";
myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Time</td>";
    myTable+= "<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept City</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl City</td>";
	myTable+="<td style='width: 100px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight Number</td>";
 	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Duration</td>"; 
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Gate</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Ground Time</td>";
	myTable+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight Status</td></tr>";
	  
	<!--myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Date</td>";-->
	
	
	
	
	
	

var tod=new Date();
  var chk1=tod.addDays(1);
  var chk2=tod.substractDays(10);
  var chk1 = new Date(chk1);
  var m1=chk1.getMonth()+1;
  var d1=chk1.getDate();
  var y1=chk1.getFullYear();
  var cDate=m1+"/"+d1+"/"+y1;
  var m2=chk2.getMonth()+1;
  var d2=chk2.getDate();
  var y2=chk2.getFullYear();
  var lDate=m2+"/"+d2+"/"+y2;
  var cDate = convert(cDate);
  var lDate = convert(lDate);
  var tod=convert(tod);
  var count=0;
  var last_com;
  var com=0;
  for(var i=0;i<length;i++){
	  
  var dep_datetime= null;
  var dep_datm=null;
  var dep_date=null;
  var dep_time=null;
  var arr_datetime=null;
  var arr_datm=null;
  var arr_date=null;
  var arr_time=null;   
  var dife = null;
  var key=parsedData[i]['flight'].key_time;
  
  key = new Date(key);

  var m=key.getMonth()+1;
  var d=key.getDate();
  var y=key.getFullYear();
  key=m+"/"+d+"/"+y;

  var key=convert(key);
   
  if(key >= lDate && key <= cDate)
  {
	  
	  count++;
	  
	  
		
	   
		if(parsedData[i]['flight'].flight_state=="AT_DEPARTURE_GATE" || parsedData[i]['flight'].flight_state=="OUT_OF_GATE" || parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="TOUCHDOWN" || parsedData[i]['flight'].flight_state=="AT_ARRIVAL_GATE")
		{
		last_com=1;
			if(parsedData[i]['departure'].time.scheduled!=undefined)
			{
				dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
				if(parsedData[i]['departure'].airport!=undefined)
				dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
				else
				dep_loc=0;
				dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
				dep_datm=new Date(dep_datetime).toISOString();
				dep_date=dep_datm.split("T");
				dep_time=dep_date[1].split(".");
				dep_time=dep_time[0];
				dep_date = dep_date[0];
			}
			else
			{
				dep_datm="-";
			}
			if(parsedData[i]['arrival'].time.scheduled!=undefined)
			{
				arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled);
				if(parsedData[i]['arrival'].airport!=undefined)
				arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
				else
				arr_loc=0;
				arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
				arr_datm=new Date(arr_datetime).toISOString();
				arr_date=arr_datm.split("T");
				arr_time=arr_date[1].split(".");
				arr_time=arr_time[0];
				//console.log("aaa"+arr_time);
				//alert(arr_time);
			
			}
			else
			{
				arr_datm="-";
			}

		//console.log("Arrival time"+arr_time+"-Departure time"+dep_time);
		
		myTable+="<td style='width: 100px; border: 1px solid black;background-color:lightgreen;text-align: center;'>" + dep_date + "</td>";
		myTable+="<td style='width: 100px; border: 1px solid black;background-color:lightgreen;text-align: center;'>" + dep_time + "</td>";
		//myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +arr_date[0] + "</td>";
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +arr_time + "</td>";
		if(parsedData[i]['departure'].airport!=undefined)
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['departure'].airport.iata + "</td>";
		else
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>-</td>";
		
		}
		
		
		else if(parsedData[i]['flight'].flight_state=="COMPLETED" && last_com!=1)
		{
		com=com+1;
			if(parsedData[i]['departure'].time.actual!=undefined)
				{
					dep_datetime=new Date(parsedData[i]['departure'].time.actual);
					
					if(parsedData[i]['departure'].airport!=undefined)
					dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
					else
					dep_loc=0;
				
					dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
					dep_datm=new Date(dep_datetime).toISOString();
					dep_date=dep_datm.split("T");
					dep_time=dep_date[1].split(".");
					dep_time=dep_time[0];
					dep_date = dep_date[0];
				}
			else
			dep_datm="-";
			if(parsedData[i]['arrival'].time.actual!=undefined)
			{
				arr_datetime=new Date(parsedData[i]['arrival'].time.actual);
				if(parsedData[i]['arrival'].airport!=undefined)
				arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
				else
				arr_loc=0;
			
				arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
				arr_datm=new Date(arr_datetime).toISOString();
				arr_date=arr_datm.split("T");
				arr_time=arr_date[1].split(".");
				arr_time=arr_time[0];
			}
			else
			arr_datm="-";
			if(com==1)
			{
		myTable+="<td style='width: 100px; border: 1px solid black;background-color:lightgreen;text-align: center;'>" +dep_date + "</td>";
		myTable+="<td style='width: 100px; border: 1px solid black;background-color:lightgreen;text-align: center;'>" +dep_time + "</td>";
		//myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +arr_date[0] + "</td>";
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +arr_time + "</td>";
		if(parsedData[i]['departure'].airport!=undefined)
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['departure'].airport.iata + "</td>";
		else
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>-</td>";
		}
		}
		else
		{
			if(parsedData[i]['departure'].time.scheduled!=undefined)
				{
					dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
					if(parsedData[i]['departure'].airport!=undefined)
					dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
					else
					dep_loc=0;
					dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
					dep_datm=new Date(dep_datetime).toISOString();
					dep_date=dep_datm.split("T");
					dep_time=dep_date[1].split(".");
					dep_time=dep_time[0];
					dep_date = dep_date[0];
				}
			else
				dep_datm="-";
			if(parsedData[i]['arrival'].time.scheduled!=undefined)
			{
				arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled);
				if(parsedData[i]['arrival'].airport!=undefined)
				arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
				else
				arr_loc=0;
				arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
				
				arr_datm=new Date(arr_datetime).toISOString();
				arr_date=arr_datm.split("T");
				arr_time=arr_date[1].split(".");
				arr_time=arr_time[0];
			}
			else
				dep_datm="-";
	
		myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;'>" +dep_date + "</td>";
		myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;'>" +dep_time + "</td>";
		//myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +arr_date[0] + "</td>";
		myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +arr_time + "</td>";
		if(parsedData[i]['departure'].airport!=undefined)
		myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;'>" +parsedData[i]['departure'].airport.iata + "</td>";
		else
		myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;'>-</td>";
	
		}
			if(arr_datm!=null && arr_datm!="-" && dep_datm!=null && dep_datm!="-")
			{
			  var dta1 = new Date(dep_datm);
			  var dta2 = new Date(arr_datm);
			  var diffe =(dta2.getTime() - dta1.getTime()) / 1000;
			  diffe= diffe/60;
			  var minute=Math.abs(Math.round(diffe));
			  var ho = Math.floor(minute / 60);
			  var mi = minute % 60;
			  ho = ho < 10 ? '0' + ho : ho;
			  mi = mi < 10 ? '0' + mi: mi;
			  dife= ho + ':' + mi;
			}
		if(parsedData[i]['flight'].flight_state=="AT_DEPARTURE_GATE" || parsedData[i]['flight'].flight_state=="OUT_OF_GATE" || parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="TOUCHDOWN" || parsedData[i]['flight'].flight_state=="AT_ARRIVAL_GATE")
		{
		
	 
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['arrival'].airport.iata+ "</td>";
			 myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen;text-align: center;'>" + parsedData[i]['flight'].flight_identifier + "</td>";
			 myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +dife + "</td>";
		if(parsedData[i]['arrival'].airport!=undefined)	
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen;text-align: center;'>" +parsedData[i]['arrival'].gate + "</td>";
		else
		myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen;text-align: center;'>-</td>";
			
			
			
			
	  } 
	  else
	  {
	  if(parsedData[i]['flight'].flight_state=="COMPLETED" && last_com!=1)
	  {
	  
	  if(parsedData[i]['arrival'].airport!=undefined)	
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['arrival'].airport.iata + "</td>";
	else
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>-</td>";
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen;text-align: center;'>" + parsedData[i]['flight'].flight_identifier + "</td>";
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +dife + "</td>";
			if(parsedData[i]['arrival'].airport!=undefined)	
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['arrival'].gate + "</td>";
			else
			myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>-</td>";
			
	  }
	  else
	  {
	  		if(parsedData[i]['arrival'].airport!=undefined)	
	  		myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +parsedData[i]['arrival'].airport.iata + "</td>";
			else
			myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>-</td>";
			myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;'>" + parsedData[i]['flight'].flight_identifier + "</td>";
			myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +dife + "</td>";
			myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +parsedData[i]['arrival'].gate + "</td>";
	  }
			
			
			
	  } 
	 if(parsedData[i]['flight'].flight_state=="COMPLETED" && last_com!=1)
		{
		
			if(count<=1)
			{
			
				myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'> </td>";
			
			}
			else
			{
			
				var dt1 = new Date(parsedData[i-1]['departure'].time.actual);
				var dt2= parsedData[i]['arrival'].time.actual;
				
			
				if(dt2!='undefined')
				{
			
				  var dt2= new Date(parsedData[i]['arrival'].time.actual);
				  var diff =(dt1.getTime() - dt2.getTime()) / 1000;
				  diff= diff/60;
				  var minutes=Math.abs(Math.round(diff));
				  var h = Math.floor(minutes / 60);
				  var m = minutes % 60;
				  h = h < 10 ? '0' + h : h;
				  m = m < 10 ? '0' + m : m;
				  var dif= h + ':' + m;
				  
				  myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" + dif + "</td>";
				  

			 	}
				
			}
			
		} 
		else if(parsedData[i]['flight'].flight_state=="AT_DEPARTURE_GATE" || parsedData[i]['flight'].flight_state=="OUT_OF_GATE" || parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="TOUCHDOWN" || parsedData[i]['flight'].flight_state=="AT_ARRIVAL_GATE")
		{
			if(count<=1)
				myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'> </td>";
			else
			{
				
				var dt1 = new Date(parsedData[i-1]['departure'].time.scheduled);
				var dt2= new Date(parsedData[i]['arrival'].time.scheduled);
			if(dt2!='undefined')
			{
		
			  var diff =(dt1.getTime() - dt2.getTime()) / 1000;
			  diff= diff/60;
			  var minutes=Math.abs(Math.round(diff));
			  var h = Math.floor(minutes / 60);
			  var m = minutes % 60;
			  h = h < 10 ? '0' + h : h;
			  m = m < 10 ? '0' + m : m;
			  var dif= h + ':' + m;
			  myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +dif + "</td>";
		  	}
		    else
			  myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>-</td>";
			}
		}
	else
	{
		if(count<=1)
			myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'> </td>";
		else
		{
		
			var dt1 = new Date(parsedData[i-1]['departure'].time.scheduled);
			var dt2= new Date(parsedData[i]['arrival'].time.scheduled);
			
		if(dt2!='undefined')
		{  
			  var diff =(dt1.getTime() - dt2.getTime()) / 1000;
			  diff= diff/60;
			  var minutes=Math.abs(Math.round(diff));
			  var h = Math.floor(minutes / 60);
			  var m = minutes % 60;
			  h = h < 10 ? '0' + h : h;
			  m = m < 10 ? '0' + m : m;
			  var dif= h + ':' + m;
			  myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +dif+ "</td>";
		 }
		 else
			  myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>"+typeof(dt2)+"</td>";
		}
	
	}
	if(parsedData[i]['flight'].flight_state=="AT_DEPARTURE_GATE" || parsedData[i]['flight'].flight_state=="OUT_OF_GATE" || parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="TOUCHDOWN" || parsedData[i]['flight'].flight_state=="AT_ARRIVAL_GATE")
	
	myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" + parsedData[i]['flight'].flight_state + "</td></tr>";
	else
	{
	if(parsedData[i]['flight'].flight_state=="COMPLETED" && last_com!=1)
	{
	last_com=1;
	myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" + parsedData[i]['flight'].flight_state + "</td></tr>";
	}
	else
	myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsedData[i]['flight'].flight_state + "</td></tr>";
	}
    }
    }
   myTable+="</table>";


document.getElementById('det').innerHTML=myTable;


};
xhr.send();
}
</script>

                
                <div class="column">
                    <iframe src="https://flightaware.com/live/flight/<?php echo $tail?>" width="100%" height="800"></iframe>
                </div>
            </div>
            <div class="w_40">
                <div class="column"><iframe src="https://custhelp.gogoinflight.com/cgi-bin/aircell.cfg/php/custom/op.php?tail=<?php echo $tail?>" width="100%" height="400" ></iframe></div>
                <div class="column"><iframe src="https://custhelp.gogoinflight.com/cgi-bin/aircell.cfg/php/custom/snow-closed.php?tail=<?php echo $tail?>" width="100%" height="800" ></iframe></div>
            </div>
        </div>
        <div class="w_100">
            <div class="column"><iframe src="http://172.16.152.40/flightSummary/search.php?unit=CA&serviceType=<?php echo $tec?>&tailNo[]=<?php echo $tail?>" width="100%" height="1000" ></iframe></div>
        </div>

    </div>

    <style>

        .w_100 {
            width: 100%;
            float: left;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }

        .w_60 {
            width: 60%;
            float: left;
        }

        .w_40 {
            width: 40%;
            float: left;
        }
		tr:nth-child(odd) {
  background-color: #dddddd;
}
th, td {
  padding: 3px;
  }
    </style>


</rn:container>

</body>
</html>