<?php 
	$c_id = $this->session->getProfile()->c_id->value; 
	$c1 = RightNow\Connect\v1_2\Contact::fetch($c_id);
	$count=(count($c1->ServiceSettings->SLAInstances));
	$sla=$c1->ServiceSettings->SLAInstances[$count-1]->NameOfSLA->LookupName;
	if($sla!=="AMCC") 
		header("Location:/app/answers/list");
?>
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="amcc.php" clickstream="answer_list" login_required="true"/>
<rn:widget path="custom/AdditionalServices/sessionTracker" usertype="AMCC_Agent"/>
<rn:widget path="custom/input/Getlogin" />

<rn:widget path="knowledgebase/RssIcon"/>
<rn:container report_id="101195" per_page="20">
<div id="page" align="left" style="font-size:18px;line-height: 1.6; margin-left:15px;"></div>
<?php 
	$kw=getUrlParm('kw');
	// change done by alan for changing the url params based on the airline
	
	$aline= "CA";
	$airline =getUrlParm('aline');
	
	if($airline=="BA2K"){
		$aline = "BA";
	}
		
	// End of change made by Alan Jose
	if(getUrlParm('tail'))
	{
	/*$tail=getUrlParm('tail');
	//echo $tail;

	$CI = get_instance();
	$tech=$CI->model('custom/language_model')->getTech($tail);
	$tec=$tech[0]; 
	if($tec=="2KU")
	$tec="2Ku"; */
?>
<style type="text/css">
	#info{
		display:block;
	}
</style>
<?php
	}
	else{
?>
<style type="text/css">
	#info{
		display:none;
	}
	#partmovement table{
		font-family:calibri;
	}
</style>
<?php
	}
?>
 
 
<?php
/*
$out=array();
global $out;
$url = "https://www.flightradar24.com/v1/search/web/find?query=$tail";
load_curl();
$ch = curl_init();

$options = array( 
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_SSL_VERIFYHOST => false,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
	CURLOPT_URL => $url ,
	CURLOPT_SSL_VERIFYPEER=>0,
	CURLOPT_SSL_VERIFYHOST=> 0  );
curl_setopt_array($ch , $options);
$output = curl_exec($ch);

	$result = json_decode($output);
	$id=$result->results[0]->id;
	$lat=$result->results[0]->detail->lat;
	$lon=$result->results[0]->detail->lon;
	*/
?>     
    
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
                <div class="column" id="det" style="width:100%; height:550px;"></div>
                <body onLoad="myFunction()">
				<script src="https://unpkg.com/elm-pep"></script>
				<script src="https://cdn.polyfill.io/v3/polyfill.min.js?features=fetch,requestAnimationFrame,Element.prototype.classList,URL,TextDecoder,Number.isInteger"></script>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.9.0/css/ol.css" type="text/css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList"></script>
				<script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.9.0/build/ol.js"></script>
				<script src="https://api.mapbox.com/mapbox.js/plugins/arc.js/v0.1.0/arc.js"></script>
				<style>
					.map {
						margin-right: 1%;
						margin-left: 1%;
						height: 700px;
						/* width: 100%; */
						border: 5px inset #bdebff;
						/* border-radius: 33px; */
					}

					div#formdata {
						margin-top: 27px;
					}

					label#label_lat,
					label#label_long,
					label#label_lat2,
					label#label_long2 {
						font-family: Helvetica, Arial, sans-serif !important;
						color: #2c4a7b;
						font-size: 13px !important;
						font-weight: 700;
					}

					input#lat,
					input#long,
					input#lat2,
					input#long2 {
						border: 1px solid #aad3df;
						border-radius: 6px;
						height: 21px;
						width: 90px;
						text-align: center;
						outline: none;
					}

					button#search {
						position: absolute;
						background: #2c4a7b;
						border: 1px solid white;
						width: 113px;
						border-radius: 7px;
						margin-left: 55px;
						outline: none;
						/* margin: -3px; */
					}

					button#search:hover {
						background: #aad3df;
					}
                </style>

                                  
				<div id="formdataset">
					<div class="column">
						<!-- <iframe src="https://aircell--tst.custhelp.com/app/answers/flightInfo/tail/<?php echo $tail ?>" width="100%" height="600" ></iframe>-->
						<div style="font-size: 18px; margin: 10px;text-align: center;">Flight Altitude : <span id="alti">NA</span></div>
						<div id="map" class="map"></div>
					
					</div>	
				</div>
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
					function diff_hours(dt2, dt1) 
					{

						var diff =(dt2.getTime() - dt1.getTime()) / 1000;
						diff /= 60;
						
						var minute=Math.abs(Math.round(diff));
						var ho = Math.floor(minute / 60);
						var mi = minute % 60;
						ho = ho < 10 ? '0' + ho : ho;
						mi = mi < 10 ? '0' + mi: mi;
						return ho+":"+mi;
					
					}
					function myFunction() 
					{
						var str =window.location.pathname;
						var n = str.indexOf("tail");
						var tail=window.location.pathname.substr(n);
						var array=tail.split("/");
						tail=array[1];
						var xhr = new XMLHttpRequest();
						var parsedData;
						xhr.open("GET", "http://dataservices.fig.prods.ca.intelsat.com/v1/flights?registration-number="+tail+"&order-by=scheduled-time&order-asc=false&detail=true");
						xhr.onload = function () 
						{
							parsedData=JSON.parse(xhr.responseText);
							var length = parsedData.length;
							var myTable= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr><td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept Date</td>";
							myTable+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept Time</td>";
							myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Time</td>";
							myTable+= "<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Dept City</td>";
							myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl City</td>";
							myTable+="<td style='width: 100px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight Number</td>";
							//myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Duration</td>"; 
							myTable+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Duration</td>";
							myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Gate</td>";
							myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Ground Time</td>";
							myTable+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight Status</td></tr>";
							
							// <!--myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arvl Date</td>";-->

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
								//mkt
								var originalarrival = null;
								var originaldept = null;
								var utcdiff = null;
								
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
											originaldept =  parsedData[i]['departure'].time.scheduled;
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
											originalarrival =  parsedData[i]['arrival'].time.scheduled;
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
									else if(parsedData[i]['flight'].flight_state=="COMPLETED" && last_com!=1){
										com=com+1;
										if(parsedData[i]['departure'].time.actual!=undefined)
										{
											originaldept = parsedData[i]['departure'].time.actual;
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
											originalarrival = parsedData[i]['arrival'].time.actual;
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
											originaldept = parsedData[i]['departure'].time.scheduled;
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
											originalarrival = parsedData[i]['arrival'].time.scheduled;
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
							
									if(originalarrival!=null && originalarrival!="-" && originaldept!=null && originaldept!="-")
									{
										//dt1 = new Date("2020-02-23T08:20:00Z");
										//dt2 = new Date("2020-02-23T17:25:00Z");
										utcdiff = diff_hours(new Date(originaldept),  new Date(originalarrival));
									}
							
									if(parsedData[i]['flight'].flight_state=="AT_DEPARTURE_GATE" || parsedData[i]['flight'].flight_state=="OUT_OF_GATE" || parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="TOUCHDOWN" || parsedData[i]['flight'].flight_state=="AT_ARRIVAL_GATE")
									{
									
								
										myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +parsedData[i]['arrival'].airport.iata+ "</td>";
										myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen;text-align: center;'>" + parsedData[i]['flight'].flight_identifier + "</td>";
										// myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +dife + "</td>";
										myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +utcdiff+ "</td>";
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
											//myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +dife + "</td>";
											myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center;'>" +utcdiff+ "</td>";	
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
											myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsedData[i]['flight'].flight_identifier + "</td>";
											//myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +dife + "</td>";
											myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" +utcdiff+ "</td>";
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
										
										if(parsedData[i]['flight'].attributes!=undefined)
										{
											
											if(parsedData[i]['flight'].attributes.pre_completed_state!=undefined)
											{
												
												if(parsedData[i]['flight'].attributes.pre_completed_state=="CANCELLED" && last_com!=1)
												{
													last_com=1;
													myTable+="<td style='width: 100px;border: 1px solid black;background-color:lightgreen; text-align: center; color: red;'>" + parsedData[i]['flight'].attributes.pre_completed_state + "</td></tr>";
											
												}
												else if(parsedData[i]['flight'].attributes.pre_completed_state=="CANCELLED")
												{
													last_com=1;
													myTable+="<td style='width: 100px;border: 1px solid black; text-align: center; color: red;'>" + parsedData[i]['flight'].attributes.pre_completed_state + "</td></tr>";
												}
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
							}
							myTable+="</table>";


							document.getElementById('det').innerHTML=myTable;


						};
						xhr.send();
					}


					part_movementnew();
					function part_movementnew() 
					{

						var str =window.location.pathname;
						var n = str.indexOf("tail");
						var tail=window.location.pathname.substr(n);
						var array=tail.split("/");
						//tail=array[1];
						var keyword=array[1];

						console.log("Keyword:"+keyword);

						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() 
						{
							if (this.readyState == 4 && this.status == 200 && this.responseText!="") {
								var loading = document.getElementById("partmovement_loading");
								loading.style.display = "none";
								var heading = document.getElementById("partmovement_heading");
								heading.style.display = "block";
								var parsed_part = JSON.parse(this.responseText);
								//console.log(parsed_part);
								var prased_length=parsed_part.length;
								var myTable_part= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Inc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>PRT No</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N Off</td>";
								myTable_part+= "<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N Off Desc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N On</td>";
								myTable_part+="<td style='width: 50px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N On Desc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Date Removed</td>";
					//				myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Updated</td></tr>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>RMA#</td></tr>";
								
								for(var j=0;j<prased_length;j++)
								{
									var date_removed=parsed_part[j].u_date.value;
									var str = date_removed.replace(/\s/g, "T");
									var date_val=str+'Z';
									var date_updated=parsed_part[j].sys_updated_on.value;
									var str1 = date_updated.replace(/\s/g, "T");
									var date_val_updated=str1+'Z';

									myTable_part+="<tr>";
									myTable_part+='<td style="width: 100px;border: 1px solid black; text-align: center;"><a href="https://gogo.service-now.com/nav_to.do?uri=incident.do?sysparm_query=number='+parsed_part[j]['u_incident'].number+'" target="_blank">'+parsed_part[j]['u_incident'].number+'</a></td>';
									myTable_part+='<td style="width: 100px;border: 1px solid black; text-align: center;"><a href="https://gogo.service-now.com/nav_to.do?uri=u_parts_movements.do?sys_id='+parsed_part[j]['sys_id']+'" target="_blank">'+parsed_part[j]['u_number'].display_value+'</a></td>';
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsed_part[j]['u_part_off'].u_serial_no + "</td>";
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsed_part[j].u_part_off_description.display_value + "</td>";
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsed_part[j]['u_part_on'].u_serial_no + "</td>";
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsed_part[j].u_part_on_description.display_value + "</td>";
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + new Date(date_val).toLocaleString("en-US", {timeZone: "America/Chicago"}) + "</td>";
									myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + parsed_part[j].u_rma.display_value + "</td></tr>";						
								//	myTable_part+="<td style='width: 100px;border: 1px solid black; text-align: center;'>" + new Date(date_val_updated).toLocaleString("en-US", {timeZone: "America/Chicago"}) + "</td></tr>";
									
								}
								myTable_part+="</table>";
								document.getElementById('partmovement').innerHTML=myTable_part;
					
					
					
					
							}
							else {
								var loading = document.getElementById("partmovement_loading");
								loading.style.display = "none";
								var heading = document.getElementById("partmovement_heading");
								heading.style.display = "block";
								var myTable_part= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Inc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>PRT No</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N Off</td>";
								myTable_part+= "<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N Off Desc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N On</td>";
								myTable_part+="<td style='width: 50px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N On Desc</td>";
								myTable_part+="<td style='width: 50px;border: 1px solid black; text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Date Removed</td>";
					//				myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Updated</td></tr>";
								myTable_part+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>RMA</td></tr>";
								myTable_part+="<tr><td colspan='8' style='width: 100px;border: 1px solid black; text-align: center;'>No Data Found</td></tr>";
								myTable_part+="</table>";
								document.getElementById('partmovement').innerHTML=myTable_part;
							}
						};
						xhttp.open("POST", "https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/partsmovements.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("keyword="+keyword);
					}


				</script>

			</div>
			<div class="w_40">
				<div class="column"><iframe src="https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/op_updated.php?tail=<?php echo $tail?>" width="100%" height="400" ></iframe></div>
				<div class="column"><iframe src="https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/ato_escalation.php?tail=<?php echo $tail?>" width="100%" height="400" ></iframe></div>

				<div class="column">
					<h1 align="center" style="font-size:20px; font-family:calibri;" id="partmovement_loading">Parts Movements Loading......</h1>
					<h1 align="center" style="font-size:24px; font-weight: bold; font-family:calibri;  display:none" id="partmovement_heading">PARTS MOVEMENTS</h1>
					<div class="column" id="partmovement" style="overflow-x:auto;"></div>
						<?php
							/*
							<iframe src="https://www.flightradar24.com/simple_index.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&z=8&flight=<?php echo $id ?>&ems=1" width="100%" height="800"></iframe>
							*/
						?>
				</div>
				<div class="column"><iframe src="https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/snow-closed_updated.php?tail=<?php echo $tail?>" width="100%" height="500" ></iframe></div>
			</div>
		</div>
		<div class="w_100">
			<div class="column"><iframe src="http://172.16.152.40/flightSummary/search.php?unit=<?php echo $aline ?>&serviceType=<?php echo $tec?>&tailNo[]=<?php echo $tail?>" width="100%" height="1000" ></iframe></div>		
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
	<script type="text/javascript">

		var rasterLayer = new ol.layer.Tile({
			source: new ol.source.OSM()
		});

		const tileLayer = new ol.layer.Tile({
			source: new ol.source.OSM({
				layer: 'toner',
			}),
		});
		const map = new ol.Map({
			layers: [tileLayer, rasterLayer],
			target: 'map',
			view: new ol.View({
				center: [0,0],
				zoom: 3,
			}),
		});

		$(document).ready(function(){
			setTimeout(function () {
				flightinfo();
			}, 1000);
		});
		function flightinfo() 
		{
			
			var str =window.location.pathname;
			var n = str.indexOf("tail");
			var tail=window.location.pathname.substr(n);
			var array=tail.split("/");
			var keyword=array[1];	
			var tailnum = keyword;
			//alert(tailnum);
			var arrival;
			var current;
			var departure;
			var flight;
			var altitude;
			var xhr = new XMLHttpRequest();
			var report_results;
			xhr.open("GET", "http://dataservices.fig.prods.ca.intelsat.com/v1/flights?registration-number="+tailnum+"&status=current&detail=true");
			xhr.onload = function () 
			{
				report_results=JSON.parse(xhr.responseText);
				//console.log(report_results);
				//report_results=JSON.parse(responseText);    
				var length = report_results.length;
				departure = [report_results[0]['departure'].airport.location.latitude,report_results[0]['departure'].airport.location.longitude];
				arrival = [report_results[0]['arrival'].airport.location.latitude,report_results[0]['arrival'].airport.location.longitude];
				current = [report_results[0]['flight'].gps.latitude,report_results[0]['flight'].gps.longitude]; 	
				altitude = report_results[0]['flight'].gps.flight_level;
				if(altitude)
				{
					$('#alti').html(altitude*100);
				}
				
				$('#map').empty();
				var rasterLayer = new ol.layer.Tile({
					source: new ol.source.OSM()
				});
				const map = new ol.Map({
					layers: [tileLayer, rasterLayer],
					target: 'map',
					view: new ol.View({
						center: ol.proj.fromLonLat([current[1],current[0]]),
						zoom: 5,
					}),
				});	
				const style = new ol.style.Style({
					/*  stroke: new ol.style.Stroke({
							color: 'black',
							width: 2.5,
							lineDash: [4, 8]
						}), */
				});	
				var iconStyle = new ol.style.Style({
					image: new ol.style.Icon( /* @type {olx.style.IconOptions} */({
						anchor: [0.5, 50],
						anchorXUnits: 'fraction',
						anchorYUnits: 'pixels',
						src: 'https://care.inflightinternet.com/euf/assets/themes/standard/images/dept2.png'
					}))
				});	
				var iconStyle3 = new ol.style.Style({
					image: new ol.style.Icon( /* @type {olx.style.IconOptions} */({
						anchor: [0.5, 46],
						anchorXUnits: 'fraction',
						anchorYUnits: 'pixels',
						src: 'https://care.inflightinternet.com/euf/assets/themes/standard/images/arriv.png'
					}))
				});	

				const flightsSource = new ol.source.Vector(
				{
					wrapX: false,
					attributions: 'Flight data by ' +'<a href="https://openflights.org/data.html">OpenFlights</a>,',
					loader: function()
					{
						const url = 'https://care.inflightinternet.com/euf/assets/themes/standard/flight.json';
						fetch(url)
						.then(function(response) {
							return response.json();
						})
						.then(function(json) 
						{
							const flightsData = json.flights;
							// for (let i = 0; i < flightsData.length; i++) {
							const flight = [
								departure,
								arrival
							];
							// const flight = flightsData[i];
							const from = flight[0];
							const to = flight[1];
							// create an arc circle between the two locations
								const arcGenerator = new arc.GreatCircle(
								{
									x: from[1],
									y: from[0]
								}, 
								{
									x: to[1],
									y: to[0]
								});
							const arcLine = arcGenerator.Arc(100, {
								offset: 10
							});
							if (arcLine.geometries.length === 1) {
								const line = new ol.geom.LineString(arcLine.geometries[0].coords);
								line.transform('EPSG:4326', 'EPSG:3857');

								const feature = new ol.Feature({
									geometry: line,
									finished: false,
								});
								addLater(feature, 2 * 50);
							}
							tileLayer.on('postrender', animateFlights);
							
							var iconStyle2 = new ol.style.Style({
								image: new ol.style.Icon( /** @type {olx.style.IconOptions} */ ({
									anchor: [0.5, 46],
									anchorXUnits: 'fraction',
									anchorYUnits: 'pixels',
									src: 'https://care.inflightinternet.com/euf/assets/themes/standard/images/planeloc2.png'
								}))
							});
							

							var startMarker = new ol.Feature({
								geometry: new ol.geom.Point(ol.proj.transform([departure[1], departure[0]], 'EPSG:4326', 'EPSG:3857')),
								name: 'The icon',
								population: 4000,
								rainfall: 500
							});
							var endMarker = new ol.Feature({
								geometry: new ol.geom.Point(ol.proj.transform([arrival[1], arrival[0]], 'EPSG:4326', 'EPSG:3857')),
								name: 'The icon',
								population: 4000,
								rainfall: 500
							});
							var currentMarker = new ol.Feature({
								geometry: new ol.geom.Point(ol.proj.transform([current[1], current[0]], 'EPSG:4326', 'EPSG:3857')),
								name: 'The icon',
								population: 4000,
								rainfall: 500
							});
							startMarker.setStyle(iconStyle);
							endMarker.setStyle(iconStyle3);
							currentMarker.setStyle(iconStyle2);
							const vectorLayer = new ol.layer.Vector({
								source: new ol.source.Vector({
								features: [startMarker,currentMarker, endMarker],
								}),
								style: function (feature) {
								return styles[feature.get('type')];
								},
							});
							map.addLayer(vectorLayer);
						});
					},
				});	
				const flightsLayer = new ol.layer.Vector({
					source: flightsSource,
					style: function(feature) {
						if (feature.get('finished')) {
							return style;
						} else {
							return null;
						}
					},
				});	
				map.addLayer(flightsLayer);	
				function addLater(feature, timeout) 
				{
					window.setTimeout(function() 
					{
						feature.set('start', Date.now());
						flightsSource.addFeature(feature);
					}, timeout);
				}

				const pointsPerMs = 0.1;

				function animateFlights(event) 
				{
					const vectorContext = ol.render.getVectorContext(event);
					const frameState = event.frameState;
					vectorContext.setStyle(style);

					const features = flightsSource.getFeatures();
					for (let i = 0; i < features.length; i++) 
					{
						const feature = features[i];
						if (!feature.get('finished')) {
							const coords = feature.getGeometry().getCoordinates();
							const elapsedTime = frameState.time - feature.get('start');
							const elapsedPoints = elapsedTime * pointsPerMs;
							if (elapsedPoints >= coords.length) {
								feature.set('finished', true);
							}
							const maxIndex = Math.min(elapsedPoints, coords.length);
							const currentLine = new ol.geom.LineString(coords.slice(0, maxIndex));
							// directly draw the line with the vector context
							vectorContext.drawGeometry(currentLine);
						}
					}
					// tell OpenLayers to continue the animation
					map.render();
				}	

			};
			xhr.send();
		}
	</script>

</rn:container>

</body>
</html>