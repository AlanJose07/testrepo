<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="filter.php" clickstream="answer_list" login_required="true"/>
<style>
.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}
select {
	height:40px;
	margin: 5px 15px 5px 0;
}
/* The alert message box */
.alert {
  padding: 20px;
  background-color: #f44336; /* Red */
  color: white;
  margin-bottom: 15px;
  margin-right: 16px;
  font-size: 16px;
  text-align: center;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
#myProgress {
  width: 99%;
  background-color: #ddd;
  margin-top:30px;
  display:none;
}

#myBar {
  width: 0%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
  font-size:16px;
  font-weight:bold;
}
.exte{
	text-align: center;
    font-size: 16px;
    margin-top: 18px;
    background: dodgerblue;
    height: 40px;
    line-height: 40px;
	color: #fff;
	display:none;
	width:99%
}
#details{
	margin-top:30px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
 // executes when complete page is fully loaded, including all frames, objects and images
 //alert("window is loaded");
		var zurl = "http://dataservices.fig.prods.gogoair.com/v1/flights?status=scheduled&order-by=scheduled-time&order-asc=true&detail=true&registration-number=N504AE";
		if(zurl)
		{		 
		$.ajax({
		url:zurl,
		type: "GET",
		dataType: 'text',
		success: function(data){
		
		}
		});
		}
		
});

var al_id;
var prog = 0;
var dataflag = 0;
var datacollect = new Array();

function getairlinedetailscheck() {
$('#stbtn').attr("disabled", true);
if(document.getElementById("val").value == 1)
{
	$('.alert').show();
	$('#stbtn').attr("disabled", false);
	return false;
}else {
	$('.alert').hide();
}	
prog = 0;
dataflag = 0;
var ele = document.getElementById("msgover"); 
ele.innerHTML = 'Connecting to server...';
document.getElementById('ststs').style.display = 'block';
var date_selected = $('#dt').datepicker('getDate', true);
var sl_date=document.getElementById("time").value;
sl_date=date_selected+" "+sl_date+":00";
var cmp=date_selected+" "+"23:59:00";
var cs=new Date(cmp);
//cs=cs.setHours(cs.getHours() +4);
cmpdate=new Date(cs).getTime()/1000; //end time + 4 hours adding
var input = document.getElementById("val");
var airline = input.options[input.selectedIndex].text;
var res = airline.split("-");
var partner=res[0];
var owner=res[1];	
var y=0;
var regnumber = new Array();
$.ajax({
	url:"https://custhelp.gogoinflight.com/cc/AjaxCustom/gettailsnew", 
	type: "POST",
	dataType:'text', 
	data: {'owner': owner,'partner':partner},
	success: function(data){
	
	var temp = data.split('#');
	$.each(temp, function(key, value) {
	if(temp[key]!=null)
	{
	   regnumber.push(temp[key]);
	}
	});
	//regnumber = ['N132EV'];

	if(regnumber.length > 0)
	{
		datacollect = new Array();
		deptdetail = new Array();
		pec = 100/regnumber.length;
		document.getElementById("myProgress").style.display='block';
		//document.getElementById("ststs").style.display='block';
		document.getElementById("msgover").innerHTML = 'Fetching data from server..';
		document.getElementById("details").innerHTML = '';
		processdata(regnumber,0);
	}
	
	}
});	
	
}


var states = ["scheduled", "active"];
function processdata(arraydata,loopcount=0)
{	
//console.log("processdata"+pec);
	if(loopcount < arraydata.length)
	{
		
		fetchdatafromapi(arraydata[loopcount],states,0);
		loopcount++;
		move(pec);
		setTimeout(function(){ processdata(arraydata,loopcount); },800);
		
	}else {
		  var elem = document.getElementById("msgover"); 
		  elem.innerHTML = 'Processing data is in progress...';
		  setTimeout(function(){ analyzedata(datacollect); },1000);
		
	}
	
}

var deptdetail = new Array();

function fetchdatafromapi(regnumbersingle=null,states,lpcnt=0)
{
	
	if(regnumbersingle.trim())
	{
	if(lpcnt < states.length)
	{	
		
		for(lpcnt=0;lpcnt<states.length;lpcnt++)
		{
		var xurl = "http://dataservices.fig.prods.gogoair.com/v1/flights?status="+states[lpcnt]+"&order-by=scheduled-time&order-asc=true&detail=true&registration-number="+regnumbersingle;
		if(xurl)
		{		 
		$.ajax({
		url:xurl,
		type: "GET",
		dataType: 'text',
		success: function(data){
			if(data!="[]")
			{
				datacollect.push(data);
				var parsedDatasch = JSON.parse(data);
				var lengths = parsedDatasch.length;
				if(lengths>0)
				{ 
				for(var k=0;k<1;k++)
				{
					
					if(parsedDatasch[k]['flight'].flight_state == "SCHEDULED")
					{
					var setarray = new Array();
					setarray['tailno'] = parsedDatasch[k]['aircraft'].registration_number;
					setarray['flight_state'] = parsedDatasch[k]['flight'].flight_state;
					setarray['flight_out'] = parsedDatasch[k]['flight'].flight_number;
					if(parsedDatasch[k]['departure'].time.scheduled!=undefined)
					{
					var dep_datetimek=new Date(parsedDatasch[k]['departure'].time.scheduled);
					var dep_lock=parsedDatasch[k]['departure'].airport.time_zone_offset;
					dep_datetimek=dep_datetimek.setHours(dep_datetimek.getHours() +dep_lock);
					var dep_datmk=new Date(dep_datetimek).toISOString();
					var dep_datek=dep_datmk.split("T");
					var dep_timek=dep_datek[1].split(".");
					dep_timek=dep_timek[0];
					}
					setarray['dept_date'] = dep_datek[0];
					setarray['dept_time'] = dep_timek;
					setarray['deptdatetime'] = dep_datmk;
					deptdetail[regnumbersingle] = setarray;
					}
				}
				}
				
			
			//console.log(deptdetail['N505AE']['dept_date']);
			}
			lpcnt++;
			setTimeout(function(){ fetchdatafromapi(regnumbersingle,states,lpcnt); },200);
			
		}
		});
		}
		}
		//return true;
	}
}
}

function analyzedata(finaldata){
var date_selected = $('#dt').datepicker('getDate', true);
var sl_date=document.getElementById("time").value;
sl_date=date_selected+" "+sl_date+":00";
var cmp=date_selected+" "+"23:59:59";
var cs=new Date(cmp);
//cs=cs.setHours(cs.getHours() +5);
cmpdate=new Date(cs).getTime()/1000; //end time + 4 hours adding
var input = document.getElementById("val");
var airline = input.options[input.selectedIndex].text;
var res = airline.split("-");
var partner=res[0];
var owner=res[1];
var qu=0;
var rem=0;
var limit=0;
var loop=0;
var con=1;
var fin=0;
var ds=new Date(sl_date);
//ds=ds.setHours(ds.getHours() +5);
var date_selected=new Date(ds).getTime()/1000;
var myTable;
var tail;	

	myTable= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr><td style='width: 100px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>A/C</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Tail</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Station</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Date</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Time(local)</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # IN</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Gate</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Date</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Time</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # OUT</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Duration</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N OFF</td>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N ON</td></tr>";
	myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight State</td></tr>";
	
	//parsedData = JSON.stringify(parsedData);
	var lengthmain = finaldata.length;
	if(lengthmain > 0)
			{
			for (var x=0;x<lengthmain;x++)
			{
				var count = 0;
				parsedData = JSON.parse(finaldata[x]);	
			var length = parsedData.length;
			for(var i=0;i<parsedData.length;i++)
			{
			  count++;
			  
			  if(owner=="FLG")
			  {
				owner="EDV";
			  }
			  if(parsedData[i]['aircraft'].airline_icao.partner==partner && parsedData[i]['aircraft'].airline_icao.owner===owner)
			  {
				  //code changes for duration of flight
				 var dta1 = null;
				 var dta2 = null;
				 var dife = "-"; 				 
				 
				 /*
				 if(parsedData[i]['arrival'].time.scheduled!=undefined)
					{
						dta1 = parsedData[i]['arrival'].time.scheduled;
					}
				 if(parsedData[i]['departure'].time.scheduled!=undefined)
					{
						dta2 = parsedData[i]['departure'].time.scheduled;
					}
				if(dta1!=null && dta2!=null)
				{
					  var dt1 = new Date(dta1);
					  var dt2 = new Date(dta2);
					  var diffe =(dt2.getTime() - dt1.getTime()) / 1000;
					  diffe= diffe/60;
					  var minute=Math.abs(Math.round(diffe));
					  var ho = Math.floor(minute / 60);
					  var mi = minute % 60;
					  ho = ho < 10 ? '0' + ho : ho;
					  mi = mi < 10 ? '0' + mi: mi;
					  dife= ho + ':' + mi;
				}
				  */
				  
				  if(parsedData[i]['arrival'].time.scheduled!=undefined)
					{
						var flight_state = parsedData[i]['flight'].flight_state;
						var arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled); 
						var arr_loc=0;
						if(parsedData[i]['arrival'].airport!=undefined)
						{	
						arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
						arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
						
						}
						else {
						arr_datetime=arr_datetime.setHours(arr_datetime.getHours());
						}

						var arr_comp=new Date(parsedData[i]['arrival'].time.scheduled);
						arr_comp=arr_comp.setHours(arr_comp.getHours()+arr_loc);
						var now = new Date(arr_comp);
						arr_comp=new Date(now.getTime() + now.getTimezoneOffset() * 60000).getTime()/1000;
						
						
						var arr_datm=new Date(arr_datetime).toISOString();
						dta1 = arr_datm;
						atstmp=new Date(arr_datm).getTime()/1000;
						var arr_date=arr_datm.split("T");
						var arr_time=arr_date[1].split(".");
						arr_time=arr_time[0];
					}
					else {
						var arr_datm="-";
					}
									
					var dep_loc=0;
					if(parsedData[i]['departure'].time.scheduled!=undefined)
					{
						var dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
						if(parsedData[i]['departure'].airport!=undefined)
						{
							dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
							dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
						}
						else {
						dep_datetime=dep_datetime.setHours(dep_datetime.getHours());
						}

						//var dep_comp=new Date(parsedData[i]['departure'].time.scheduled);
						//dep_comp=dep_comp.setHours(dep_comp.getHours()+4+dep_loc);
						//dep_comp=new Date(dep_comp).getTime()/1000;

						var dep_datm=new Date(dep_datetime).toISOString();
						tstmp=new Date(dep_datetime).getTime()/1000;
						var dep_date=dep_datm.split("T");
						var dep_time=dep_date[1].split(".");
						dep_time=dep_time[0];

					}
					else
					{
						var dep_datm="-";
					}

					cmptime=arr_comp;
					//var theDate = new Date(cmptime * 1000);
					//dateString = theDate.toGMTString();
					//var theDatev = new Date(date_selected * 1000);
					//dateStringv = theDatev.toGMTString();
					//var theDateb = new Date(cmpdate * 1000);
					//dateStringb = theDateb.toGMTString();
					//console.log("flightno"+parsedData[i]['flight'].flight_number+"arrival time scheduled"+new Date(cmptime * 1000)+"start selected date"+new Date(date_selected * 1000)+"end selected date"+new Date(cmpdate * 1000));
					if(cmptime>=date_selected && cmptime<=cmpdate)
					{
						dataflag = 1;
						myTable+="<tr><td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].fleet_number+ "</td>"; 
						var tail=parsedData[i]['aircraft'].registration_number;
						myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].registration_number + "</td>";
						if(parsedData[i]['arrival'].airport!=undefined)
						{
						arvl_st=parsedData[i]['arrival'].airport.iata;
						var j=i;
						while(j<length)
						{
							if(parsedData[j]['departure'].airport!=undefined)
							{
							
								if(parsedData[j]['departure'].airport.iata==arvl_st && parsedData[j]['aircraft'].registration_number==tail)
								{
								   
									if(parsedData[j]['departure'].time.scheduled!=undefined)
									{
										flight_out=parsedData[j]['flight'].flight_number;
										var dep_datetime=new Date(parsedData[j]['departure'].time.scheduled);
										var dep_loc=parsedData[j]['departure'].airport.time_zone_offset;
										dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
										var dep_datm=new Date(dep_datetime).toISOString();
										var dep_date=dep_datm.split("T");
										var dep_time=dep_date[1].split(".");
										dep_time=dep_time[0];
										dta2 = dep_datm;
						
									}
									j=length;
									
								}
								else
								{
								flight_out="-";
								dep_date="-";
								dep_time="-";
								j++;
								}
							}
							
						}
						
						myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].airport.iata+ "</td>";        
						
						}
						else
						{
						myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>"+undefined+"</td>";
							var dep_datm="-";
						}
						//loop++;
						
						if(flight_state!="SCHEDULED")
						{
							//console.log(deptdetail[tail]['dept_date']);
							if(deptdetail[tail]!=undefined)
							{
							console.log(deptdetail[tail]['dept_date']);	
							dep_date = new Array();
							dep_date[0] = deptdetail[tail]['dept_date'];
							dep_time = deptdetail[tail]['dept_time'];
							flight_out = deptdetail[tail]['flight_out'];
							dta2 = deptdetail[tail]['deptdatetime'];
							} 
						}
						if(dta1!=null && dta2!=null)
						{
							//console.log("arrivaltime"+dta1+"-deptdate"+dta2);
						  var dt1 = new Date(dta1);
						  var dt2 = new Date(dta2);
						  var diffe =(dt2.getTime() - dt1.getTime()) / 1000;
						  diffe= diffe/60;
						  var minute=Math.abs(Math.round(diffe));
						  var ho = Math.floor(minute / 60);
						  var mi = minute % 60;
						  ho = ho < 10 ? '0' + ho : ho;
						  mi = mi < 10 ? '0' + mi: mi;
						  dife= ho + ':' + mi;
						}
					
					myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_date[0] + "</td>";
					myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_time + "</td>";
					myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;padding: 5px;'>" + parsedData[i]['flight'].flight_number + "</td>";
					myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].gate + "</td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_date[0] + "</td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_time + "</td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+flight_out + "</td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+dife + "</td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td></tr>";
					myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+flight_state+"</td></tr>";
					}
					
				}
			
				
			
			}
			}
				myTable+="</table>";
				document.getElementById('myProgress').style.display='none';
				document.getElementById('ststs').style.display='none';
				if(dataflag > 0)
				{
				document.getElementById('details').innerHTML=myTable;
				}else {
				document.getElementById('ststs').style.display='block';	
				document.getElementById('msgover').innerHTML='Sorry, No relevant data found to display!!';	
				}
			}
			$('#stbtn').attr("disabled", false);
}
// function getairlinedetails() {


// var qu=0;
// var rem=0;
// var limit=0;
// var loop=0;
// var con=1;
// var fin=0;
// var ds=new Date(sl_date);
// ds=ds.setHours(ds.getHours() +4);
// var date_selected=new Date(ds).getTime()/1000;
// var myTable;
// var tail;
// //whatever date is selected, +4 hours offset is added to both start time and end time

// $.ajax({
	// url:"https://custhelp.gogoinflight.com/cc/AjaxCustom/gettails", 
	// type: "POST",
	// dataType:'text', 
	// data: {'owner': owner,'partner':partner},
	// success: function(data){
	// var temp = new Array();
	// temp = data.split(",");
	
	
	// var xhr = [], l;
	// var len=temp.length;	
	
	// if(len<=200)			
	// {				
	 // for(l=1;l<len;l++)  
	 // {  //alert(temp[l]);
		// if(temp[l])
		// {
		// $.ajax({
		// url:"http://dataservices.fig.prods.gogoair.com/v1/flights?status=scheduled&order-by=scheduled-time&order-asc=true&detail=true&registration-number="+temp[l], 
		// type: "GET",
		// dataType: 'text',
		// success: function(data){
			// var parsedData=JSON.parse(data);
			// var length = parsedData.length;
			// var count=0;
			// var tstmp;
			// var cmptime;
			// var atstmp;
			// var arvl_st;
			// var flight_out;
			// if(l==1)
			// {
				// myTable= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr><td style='width: 100px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>A/C</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Tail</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Station</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Date</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Time(local)</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # IN</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Gate</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Date</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Time</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # OUT</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N OFF</td>";
				// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N ON</td></tr>";
			// }
			// if(length > 0)
			// {
			// for(var i=0;i<length;i++)
			// {
			  // count++;
			  // if(owner=="FLG")
			  // {
				// owner="EDV";
			  // }
			  // if(parsedData[i]['aircraft'].airline_icao.partner==partner && parsedData[i]['aircraft'].airline_icao.owner===owner)
			  // {
				  // if(parsedData[i]['arrival'].time.scheduled!=undefined)
					// {
						// var arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled); 
						// var arr_loc=0;
						// if(parsedData[i]['arrival'].airport!=undefined)
						// {	
						// arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
						// arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
						// }
						// else {
						// arr_datetime=arr_datetime.setHours(arr_datetime.getHours());
						// }

						// var arr_comp=new Date(parsedData[i]['arrival'].time.scheduled);
						// arr_comp=arr_comp.setHours(arr_comp.getHours() +4+arr_loc);
						// arr_comp=new Date(arr_comp).getTime()/1000;
						
						// var arr_datm=new Date(arr_datetime).toISOString();
						// atstmp=new Date(arr_datm).getTime()/1000;
						// var arr_date=arr_datm.split("T");
						// var arr_time=arr_date[1].split(".");
						// arr_time=arr_time[0];
					// }
					// else {
						// var arr_datm="-";
					// }
									
					// var dep_loc=0;
					// if(parsedData[i]['departure'].time.scheduled!=undefined)
					// {
						// var dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
						// if(parsedData[i]['departure'].airport!=undefined)
						// {
							// dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
							// dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
						// }
						// else {
						// dep_datetime=dep_datetime.setHours(dep_datetime.getHours());
						// }

						// var dep_comp=new Date(parsedData[i]['departure'].time.scheduled);
						// dep_comp=dep_comp.setHours(dep_comp.getHours()+4+dep_loc);
						// dep_comp=new Date(dep_comp).getTime()/1000;

						// var dep_datm=new Date(dep_datetime).toISOString();
						// tstmp=new Date(dep_datetime).getTime()/1000;
						// var dep_date=dep_datm.split("T");
						// var dep_time=dep_date[1].split(".");
						// dep_time=dep_time[0];

					// }
					// else
					// {
						// var dep_datm="-";
					// }

					// cmptime=arr_comp;
					// if(cmptime>=date_selected && cmptime<=cmpdate)
					// {
						// myTable+="<tr><td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].fleet_number+ "</td>"; 
						// var tail=parsedData[i]['aircraft'].registration_number;
						// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].registration_number + "</td>";
						// if(parsedData[i]['arrival'].airport!=undefined)
						// {
						// arvl_st=parsedData[i]['arrival'].airport.iata;
						// var j=i;
						// while(j<length)
						// {
							// if(parsedData[j]['departure'].airport!=undefined)
							// {
							
								// if(parsedData[j]['departure'].airport.iata==arvl_st && parsedData[j]['aircraft'].registration_number==tail)
								// {
								   
									// if(parsedData[j]['departure'].time.scheduled!=undefined)
									// {
										// flight_out=parsedData[j]['flight'].flight_number;
										// var dep_datetime=new Date(parsedData[j]['departure'].time.scheduled);
										// var dep_loc=parsedData[j]['departure'].airport.time_zone_offset;
										// dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
										// var dep_datm=new Date(dep_datetime).toISOString();
										// var dep_date=dep_datm.split("T");
										// var dep_time=dep_date[1].split(".");
										// dep_time=dep_time[0];
						
									// }
									// j=length;
									
								// }
								// else
								// {
								// flight_out="-";
								// dep_date="-";
								// dep_time="-";
								// j++;
								// }
							// }
							
						// }
						
						// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].airport.iata+ "</td>";        
						
						// }
						// else
						// {
						// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>"+undefined+"</td>";
							// var dep_datm="-";
						// }
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_date[0] + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_time + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;padding: 5px;'>" + parsedData[i]['flight'].flight_number + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].gate + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_date[0] + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_time + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+flight_out + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td></tr>";
					// }
	
				// }
			// if(l==(len-2))
			// {	alert('sdad');
				// myTable+="</table>";
				// document.getElementById('details').innerHTML=myTable;
			// }
			// }
			// }
			
		// }
		// });
		// }
	 // }
	// }
// else
// {
	// qu=len/200;
	// qu=Math.floor(qu);
	// rem=len%200;			
	// while(loop<=qu)	
	// {
		
		// if(loop==qu)
		// {
			// con=limit;
			
			// limit=limit+rem;
			
		 // fin=limit;
		
			
		// }
		// else
		// {
		
			// con=limit;
			// limit=limit+200;
			
		// }
			// loop++;						
			// for(l=con;l<=limit;l++)  
			// {  
				// (function(l){        
					// xhr[l] = new XMLHttpRequest(); 
					// xhr[l].open("GET", "http://dataservices.fig.prods.gogoair.com/v1/flights?status=scheduled&page-size=150&order-by=scheduled-time&order-asc=true&detail=true&registration-number="+temp[l]);
					// xhr[l].onreadystatechange  = function () {
					// if (xhr[l].readyState === 4 && xhr[l].status === 200){
					// var parsedData=JSON.parse(xhr[l].responseText);
					// var length = parsedData.length;
					// if(l==1){
					// myTable= "<table style='cellpadding:0;border-collapse: collapse;  border: 1px solid black; cellspacing:0;'><tr><td style='width: 100px;text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>A/C</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Tail</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Station</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Date</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Time(local)</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # IN</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Arrival Gate</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Date</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Departure Time</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>Flight # OUT</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N OFF</td>";
					// myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N ON</td></tr>";
					// }

				  // var count=0;
				  // var tstmp;
				  // var cmptime;
				  // var atstmp;
				  // var arvl_st;
				  // var flight_out;
  
					// for(var i=0;i<length;i++){
					// count++;
					// if(owner=="FLG")
					// owner="EDV";
					// if(parsedData[i]['aircraft'].airline_icao.partner==partner && parsedData[i]['aircraft'].airline_icao.owner===owner)
					// {
					  // if(parsedData[i]['arrival'].time.scheduled!=undefined)
						// {
						// var arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled); 
						// var arr_loc=0;
						// if(parsedData[i]['arrival'].airport!=undefined)
						// {	
						// arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
						// arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
						// }
						// else
						// arr_datetime=arr_datetime.setHours(arr_datetime.getHours());
				
				
						// var arr_comp=new Date(parsedData[i]['arrival'].time.scheduled);
						// arr_comp=arr_comp.setHours(arr_comp.getHours() +4+arr_loc);
						// arr_comp=new Date(arr_comp).getTime()/1000;
						
						// var arr_datm=new Date(arr_datetime).toISOString();
						// atstmp=new Date(arr_datm).getTime()/1000;
						// var arr_date=arr_datm.split("T");
						// var arr_time=arr_date[1].split(".");
						// arr_time=arr_time[0];
						// }
						// else
						// var arr_datm="-";
						// var dep_loc=0;
						// if(parsedData[i]['departure'].time.scheduled!=undefined)
						// {
						// var dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
						// if(parsedData[i]['departure'].airport!=undefined)
						// {
							// dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
							// dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
						// }
						// else
						// dep_datetime=dep_datetime.setHours(dep_datetime.getHours());
				
						// var dep_comp=new Date(parsedData[i]['departure'].time.scheduled);
						// dep_comp=dep_comp.setHours(dep_comp.getHours()+4+dep_loc);
						// dep_comp=new Date(dep_comp).getTime()/1000;
				
						// var dep_datm=new Date(dep_datetime).toISOString();
						// tstmp=new Date(dep_datetime).getTime()/1000;
						// var dep_date=dep_datm.split("T");
						// var dep_time=dep_date[1].split(".");
						// dep_time=dep_time[0];
			
						// }
						// else
						// {
							// var dep_datm="-";
						// }
			// //if(parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="COMPLETED")
	   	
						// cmptime=arr_comp;
	    
		// /*else
		// {
			// cmptime=dep_comp;
		// }*/
			
					// if(cmptime>=date_selected && cmptime<=cmpdate)
					// {
							// myTable+="<tr><td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].fleet_number+ "</td>"; 
							// var tail=parsedData[i]['aircraft'].registration_number;
							// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['aircraft'].registration_number + "</td>";
							// if(parsedData[i]['arrival'].airport!=undefined)
							// {
							// arvl_st=parsedData[i]['arrival'].airport.iata;
							// var j=i;
							// while(j<length)
							// {
								// if(parsedData[j]['departure'].airport!=undefined)
								// {
								
									// if(parsedData[j]['departure'].airport.iata==arvl_st && parsedData[j]['aircraft'].registration_number==tail)
									// {
										
										// if(parsedData[j]['departure'].time.scheduled!=undefined)
										// {
											// flight_out=parsedData[j]['flight'].flight_number;
											// var dep_datetime=new Date(parsedData[j]['departure'].time.scheduled);
											// var dep_loc=parsedData[j]['departure'].airport.time_zone_offset;
											// dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
											// var dep_datm=new Date(dep_datetime).toISOString();
											// var dep_date=dep_datm.split("T");
											// var dep_time=dep_date[1].split(".");
											// dep_time=dep_time[0];
							
										// }
										// j=length;
										
									// }
									// else
									// {
									// flight_out="-";
									// dep_date="-";
									// dep_time="-";
									// j++;
									// }
								// }
								
							// }
			
							// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].airport.iata+ "</td>";        
			
							// }
							// else
							// {
							// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>"+undefined+"</td>";
								// var dep_datm="-";
							// }
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_date[0] + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_time + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;padding: 5px;'>" + parsedData[i]['flight'].flight_number + "</td>";
					// myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].gate + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_date[0] + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_time + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+flight_out + "</td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td>";
					// myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td></tr>";
					// }
	
					// }
	
	
				// }
			// if(l==(fin-2))
			// {
			
			// myTable+="</table>";
			// document.getElementById('details').innerHTML=myTable;
			// }
 
			// }
	

	// };
// xhr[l].send();
// })(l);
// }
// }
// }
// }
// }); 
// }
// function getotherstatedata(state){
	
	
	
	
// }

</script>

<rn:widget path="custom/input/Getlogin" />
<br>
<br>
<div class="alert" style="display:none;">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  Please select an Airlines to proceed !!
</div>
<div class="form-inline">
	<div id="slct" style="float: left;margin-left: 400px;"><select id="val"><option value="1" disabled selected>Please select your Airlines</option>
	<option value="">AAL-AAL</option>
    <option value="">AAL-ASH</option>
    <option value="">AAL-AWE</option>
    <option value="">AAL-JIA</option>
    <option value="">AAL-RPA</option>
    <option value="">ASA-ASA</option> 
    <option value="">DAL-CPZ</option>
    <option value="">DAL-DAL</option>
    <option value="">DAL-FLG</option>
    <option value="">DAL-GJS</option>
    <option value="">DAL-RPA</option>
    <option value="">DAL-SKW</option> 
    <option value="">GLO-GLO</option>
    <option value="">UAL-ASH</option>  
    <option value="">UAL-GJS</option>
    <option value="">UAL-RPA</option> 
    </select>
    </div>
<div id="srch"  style="float: left;">
<input type="text" id="dt" name="dt" readonly=true/>





  <input type="text" id="time" placeholder="Time" class='timepicker' readonly=true>


<button id="stbtn" onClick="getairlinedetailscheck()">Search</button>
</div>



 </div>
<div id="myProgress">
  <div id="myBar">0%</div>
 
</div>
 <div id='ststs' class="exte">Status : <span id="msgover">Fetching data from server..</span></div>
 <div id="details">
</div>
<script>
$('#dt').datepicker({
	autoHide:true
});
$('#dt').datepicker('setDate', new Date());
$('.timepicker').timepicker({
    timeFormat: 'HH:mm',
    interval: 10,
    minTime: '00',
    maxTime: '23:59',
    defaultTime: '',
    startTime: '00:00',
    dynamic: true,
    dropdown: true,
    scrollbar: true
});
function move(width) {
//console.log(width);
prog = prog+width;
var showdata = parseInt(prog+width);
if(showdata<=100)
{
  var elem = document.getElementById("myBar"); 
      elem.style.width = showdata + '%'; 
      elem.innerHTML = showdata * 1  + '%';
}

}
</script>

               
</rn:container>

</body>
</html>