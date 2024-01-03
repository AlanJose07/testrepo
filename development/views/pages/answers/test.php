<head> 
</head>

<script type="text/javascript">
var al_id;

function getairlinedetails() {

var date_selected = document.getElementById("dt").value+":00Z";
var cmpdate=date_selected.split("T");
var cmp=cmpdate[0]+"T"+"23:59:00Z";
var cs=new Date(cmp);
cs=cs.setHours(cs.getHours() +4);
cmpdate=new Date(cs).getTime()/1000;
var input = document.getElementById("val");
var airline = input.options[input.selectedIndex].text;
var res = airline.split("-");
var partner=res[0];
var owner=res[1];

var ds=new Date(date_selected);

ds=ds.setHours(ds.getHours() +4);
var date_selected=new Date(ds).getTime()/1000;
var myTable;
var len=34;	
var qu;
var rem;	
			if(len >5)
			{
				qu=len/5;
				rem=len%5;
				alert(len);
				len=5;
			}
var tail;
            $.ajax({
                url:"https://custhelp.gogoinflight.com/cc/AjaxCustom/test", 
                type: "POST",
                dataType:'text', 
                data: {'owner': owner,'partner':partner},
                success: function(data){
                   console.log(data);
					var temp = new Array();

temp = data.split(",");
					 var xhr = [], l;
					
			
			
					
 for(l=1;l<len;l++)  
 {  
 (function(l){        
xhr[l] = new XMLHttpRequest(); 

xhr[l].open("GET", "http://dataservices.fig.prods.gogoair.com/v1/flights?status=scheduled&page-size=150&order-by=scheduled-time&order-asc=true&detail=true&registration-number="+temp[l]);

xhr[l].onreadystatechange  = function () {
if (xhr[l].readyState === 4 && xhr[l].status === 200){
console.log(xhr[l].responseText);
   var parsedData=JSON.parse(xhr[l].responseText);
	
	var length = parsedData.length;
	if(l==1)
	{
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
	
myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N OFF</td>";
myTable+="<td style='width: 50px;border: 1px solid black;  text-align: center;background: #545454;padding: 5px;color:#fff;font-size:14px;'>S/N ON</td></tr>";
}

  var count=0;
  var tstmp;
  var cmptime;
  var atstmp;
  var arvl_st;
  var flight_out;
  
  for(var i=0;i<length;i++){
   count++;
   if(owner=="FLG")
owner="EDV";
    if(parsedData[i]['aircraft'].airline_icao.partner==partner && parsedData[i]['aircraft'].airline_icao.owner===owner)
	{
		  if(parsedData[i]['arrival'].time.scheduled!=undefined)
			{
				var arr_datetime=new Date(parsedData[i]['arrival'].time.scheduled); 
				var arr_loc=0;
				if(parsedData[i]['arrival'].airport!=undefined)
				{	
				arr_loc=parsedData[i]['arrival'].airport.time_zone_offset;
				arr_datetime=arr_datetime.setHours(arr_datetime.getHours() +arr_loc);
				}
				else
				arr_datetime=arr_datetime.setHours(arr_datetime.getHours());
				
				
				var arr_comp=new Date(parsedData[i]['arrival'].time.scheduled);
				arr_comp=arr_comp.setHours(arr_comp.getHours() +4+arr_loc);
				arr_comp=new Date(arr_comp).getTime()/1000;
			
				
				
				var arr_datm=new Date(arr_datetime).toISOString();
				
				atstmp=new Date(arr_datm).getTime()/1000;
				var arr_date=arr_datm.split("T");
				var arr_time=arr_date[1].split(".");
				arr_time=arr_time[0];
			}
			else
			var arr_datm="-";
			var dep_loc=0;
			if(parsedData[i]['departure'].time.scheduled!=undefined)
			{
			var dep_datetime=new Date(parsedData[i]['departure'].time.scheduled);
			if(parsedData[i]['departure'].airport!=undefined)
			{
				dep_loc=parsedData[i]['departure'].airport.time_zone_offset;
				dep_datetime=dep_datetime.setHours(dep_datetime.getHours() +dep_loc);
			}
			else
			dep_datetime=dep_datetime.setHours(dep_datetime.getHours());
				
				
				var dep_comp=new Date(parsedData[i]['departure'].time.scheduled);
				dep_comp=dep_comp.setHours(dep_comp.getHours()+4+dep_loc);
				dep_comp=new Date(dep_comp).getTime()/1000;
				
				

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
			//if(parsedData[i]['flight'].flight_state=="IN_AIR" || parsedData[i]['flight'].flight_state=="COMPLETED")
	   	
			cmptime=arr_comp;
	    
		/*else
		{
			cmptime=dep_comp;
		}*/
			
			if(cmptime>=date_selected && cmptime<=cmpdate)
			{
			

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
			myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_date[0] + "</td>";
		myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +arr_time + "</td>";
			
	
		
		myTable+="<td style='width: 100px;border: 1px solid black;text-align: center;padding: 5px;'>" + parsedData[i]['flight'].flight_number + "</td>";
	  myTable+="<td style='width: 100px;border: 1px solid black; text-align: center;padding: 5px;'>" +parsedData[i]['arrival'].gate + "</td>";
	  myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_date[0] + "</td>";
	  myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>" + dep_time + "</td>";
	  myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'>"+flight_out + "</td>";
		myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td>";
		myTable+="<td style='width: 100px; border: 1px solid black;text-align: center;padding: 5px;'></td></tr>";

 
	
	}
	
	}
	
	
    }
	if(l==(len-2))
	{
	
	myTable+="</table>";
	document.getElementById('details').innerHTML=myTable;
	}
 
}
	

};

xhr[l].send();
})(l);
 
}
}

}); 

}
</script>

                    
<!--<body onLoad="getdetails()">-->



<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="filter.php" clickstream="answer_list" login_required="true"/>
<rn:widget path="custom/input/Getlogin" />
  
<br>
<br>
<div class="header_logo">


	<div id="slct" style="float: left;margin-left: 400px;"><select id="val"><option selected="selected">Airlines</option>
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
<input type="datetime-local" id="dt" name="dt"/>


<button onClick="getairlinedetails()">Search</button>
</div>



 </div>

 <div id="details">
</div>


               
</rn:container>

</body>

</html>
