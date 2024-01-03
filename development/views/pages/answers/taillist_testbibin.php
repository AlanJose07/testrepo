<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="taillist_template.php" clickstream="answer_list" login_required="true"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
body {
 overflow: hidden;
 max-height: 100vh;
}
.filterselect{
	width :20px;
}
.dropdown {
    margin: 27px;
    margin-left: 186px;
    margin-bottom: 4%;
}
label#main_selector_label {
    font-size: 15px !important;
    font-family: Helvetica, sans-serif !important;
    color: #05275c;
    font-weight: 600;
}
#tail_label_new{
	font-size: 15px !important;
    font-family: Helvetica, sans-serif !important;
    color: #05275c;
    font-weight: 600;
}
.dropdown select {
    margin-bottom: 0;
    width: 21%;
    /* height: 12%; */
    border-radius: 7px;
    height: 30px;
    border: 1px solid #b8e4f5;
    color: #042b64;
				outline:none;
}
#tail_result th{
    text-align: left;
    width: 50px;
    border: 1px solid black;
    text-align: center;
    background: #545454;
    padding: 5px;
    color: #fff;
    font-size: 14px;
}
.loader {
    position: absolute;
    margin-top: 5%;
    margin-left: 50%;
    margin-right: 50%;
    border: 10px solid #f3f3f3;
    border-radius: 50%;
    border-top: 10px solid #c2c2c2;
    width: 40px;
    height: 40px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
#tail_result {
    cellpadding: 0;
    border-collapse: collapse;
    border: 1px solid black;
    cell-spacing: 0;
	width:75%;
	margin-left: auto;
 	margin-right: auto;
}
#tail_result td{
	height: 27px;
	width: 100px;
    border: 1px solid black;
    text-align: center;
}
.maintainace {
    background: #ffffff;
    color: #545454;
    text-align: center;
    align-items: center;
    /* margin-left: auto !important; */
    /* margin-right: auto !important; */
    /* border-bottom: 1px solid; */
}
.maintainace:hover {
    background: #ffffff;
    color: #2fb5f0;
    text-align: center;
    align-items: center;
    /* margin-left: auto !important; */
    /* margin-right: auto !important; */
    /* border-bottom: 1px solid; */
}
div #load h2 {
    position: absolute;
    margin-left: 45%;
    /* margin-right: 50%; */
    font-size: 28px;
    color: #0e425a;
    font-weight: 500;
    margin-bottom: -4%;
}
div#emptyval p {
    font-size: 12px !important;
    margin-left: 60%;
    margin-top: -5%;
    background: #ffe300;
    color: #b60909;
    font-weight: 700;
    width: 127px;
    padding-left: 1%;
    border-radius: 5px;
}
button#search {
    /* background: #2c4a7b; */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3694bc), color-stop(100%,#2ebaf8));
    border: 1px solid white;
    width: 88px;
    border-radius: 7px;
    margin-left: 23px;
	outline:none;
	position: absolute;
    /* margin: -3px; */
}
button#search:hover {
background: #aad3df;
}
.hide{
	display:none;
}
.pagewrapper {
    max-width: 75%;
    margin: auto;
}
.pagewrapper .dropdown {
    margin-left: 0px;
    margin-right: 0px;
}
.pagewrapper .tablewrapper {
    width: 100%;
    overflow-y: scroll;
    border-collapse: collapse;
    max-height: 70vh;
}
.pagewrapper .tablewrapper table#tail_result {
    width: 100%;
    overflow: scroll;
    border-collapse: collapse;
}
.pagewrapper .tablewrapper table#tail_result thead tr {
    height: 40px;
}
.pagewrapper .tablewrapper table#tail_result thead tr {
    height: 40px;
    white-space: nowrap;
    position: sticky;
    top: 0;
}
.pagewrapper .tablewrapper::-webkit-scrollbar {
  width: 6px;
}
.pagewrapper .tablewrapper::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
}
.pagewrapper .tablewrapper::-webkit-scrollbar-thumb {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
}
.pagewrapper .dropdown select {
    width: 25%;
}

</style>
<div class="pagewrapper">
<div class="dropdown">
<label id="main_selector_label">Partner / Owner</label>
<select id='main_selector' name="main_selector" class="dropdown__content">
							
							<option value="1">Partner</option>
							<option value="2">Owner</option>
</select>
<label id="tail_label_new" style="font-weight:600;font-size: 15px !important;color: #05275c">Select Partner Airline</label>
    <select id='taillist' name="taillist" class="dropdown__content">
							<option value="0">--</option>
							<option value="AAL">AAL</option>
							<option value="ACA">ACA</option>
							<option value="AFR">AFR </option>
							<option value="AMX">AMX</option>
							<option value="ASA">ASA</option>
							<option value="BA2K">BA2K</option>
							<option value="BAW">BAW</option>
							<option value="CPA">CPA</option>
							<option value="DAL">DAL</option>
							<option value="FDX">FDX</option>
							<option value="GLO">GLO</option>
							<option value="IBE">IBE</option>
							<option value="JAL">JAL</option>
							<option value="JTA">JTA</option>
							<option value="KLM">KLM</option>
							<option value="MNU">MNU</option>
							<option value="RXA">RXA</option>
							<option value="TAM">TAM</option>
							<option value="UAL">UAL</option>
							<option value="VIR">VIR</option>
</select>
<label id="ownerlabelnew" style="font-weight:600;font-size: 15px !important;color: #05275c;display:none;">Select Owner Airline</label>
    <select id='ownerlist' name="ownerlist" class="dropdown__content" style="display:none;">
							<option value="0">--</option>
							<option value="ASH">ASH</option>
							<option value="ASQ">ASQ</option>
							<option value="ENY">ENY </option>
							<option value="FLG">FLG</option>
							<option value="GJS">GJS</option>
							<option value="JIA">JIA</option>
							<option value="JZA">JZA</option>
							<option value="QXE">QXE</option>
							<option value="RPA">RPA</option>
							<option value="SKW">SKW</option>
							<option value="SLI">SLI</option>
							<option value="ROU">ROU</option>
</select>
<button id="search">Search</button>
</div>


<div id="emptyval">
	<p>Please select a value<p>
</div>
<div id='load' class="hide">
	<h2>	Tail list Loading ....</h2>
	<div class="loader">
	</div>
	</div>
<div class="tablewrapper">


<table id="tail_result">
<thead>
          <tr>
		   <th class="text-center">Partner Airline
				<select class="filterselect" name="partnerAirline" id="partnerAirlinefilter">
					<option value="volvo">AAL</option>
					<option value="saab">ACA</option>
					<option value="mercedes">AFR</option>
				</select> </th> 
            <th class="text-center">Operating Airline
				<select class="filterselect" name="OperatingAirline" id="OperatingAirlinefilter">
					<option value="volvo">JZA</option>
					<option value="saab">ROU</option>
				</select>
			</th>
            <th class="text-center">Technology
				<select class="filterselect" name="Technology" id="Technologyfilter">
					<option value="volvo">2KU</option>
					<option value="saab">ATG</option>
					<option value="mercedes">ATG 4</option>
				</select>
			</th>
			<th class="text-center">Aircraft Type
				<select class="filterselect" name="aircraftType" id="aircraftTypefilter">
					<option value="volvo">CRJ900</option>
					<option value="saab">321-200</option>
					<option value="mercedes">319-100</option>
				</select>
			</th>
			<th class="text-center">Tail number</th>
            <th class="text-center">Maintenance</th>
          </tr>
 </thead>
	<tbody>
	</tbody>
</table>
</div>
</div>
<script type="text/javascript">

$('#main_selector').change(function(){
	var currentselected = $(this).val();
	if(currentselected==1)
	{
		$('#tail_label_new').show();
		$('#ownerlabelnew').hide();
		$('#taillist').show();
		$("#ownerlist").val("0");
		$('#ownerlist').hide();
		
		//$('#ownerlist option[value=0]').attr('selected','selected');
	}
	if(currentselected==2)
	{
		$('#tail_label_new').hide();
		$('#ownerlabelnew').show();
		$("#taillist").val("0");
		$('#taillist').hide();
		$('#ownerlist').show();
		
		//$('#taillist option[value=0]').attr('selected','selected');
	}
});



var result = null;
var link1;
var link2;
var link3;
var aline;
var tmoip;
var tail;
var report_results;
var airline_data;
var tmIP_data;
$('#emptyval').hide();
$('#tail_result').hide();
$("#search").click(function(){
	$('#load').removeClass('hide');
	$('#tail_result tbody').empty();
	var mainselector = $('#main_selector').val();
	if(mainselector==1)
	{
		var taillist = $('select[name=taillist] option').filter(':selected').val();
	}else {
		var taillist = $('select[name=ownerlist] option').filter(':selected').val();	
	}
	if(taillist != 0){
		$('#tail_result').show();
		$.ajax({
			url : 'https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/taillist.php',
			type : 'GET',
			// async: false,
			data : {
				'tailID' : taillist,
				'mainselector':mainselector
			},
			dataType:'json',
			beforeSend: function () {
				$("#load").show();
				$("#tail_result").hide();
			},
			complete: function () {
				setTimeout(function () {
					$("#load").hide();
					$("#tail_result").show();
				}, 1000);
			},
			success : function(data) {
				var result =JSON.stringify(data);
				// console.log(result);
				tail_found = 0;
				report_results = get_Url();
				airline_data = report_results['airline_data'];
				tmIP_data =report_results['tmoip_data'];
				const uniqueDetails=[];
				const airlineTypes = [];
				
				for(i=0; i<data["result"].length; i++){
					let unique = 0;
					u_airline = data["result"][i]["u_operator"];
					u_aircraft_type = data["result"][i]["u_aircraft_type"];
					
					if(airlineTypes.length!=0){
						if (!airlineTypes.includes(u_aircraft_type))
						airlineTypes.push(u_aircraft_type);
					}
					else{
						airlineTypes.push(u_aircraft_type);
					}
					u_owner = data["result"][i]["u_airline"];
					u_access_technology_code = data["result"][i]["u_access_technology_code"];
					u_tail_number = data["result"][i]["name"] ? data["result"][i]["name"] : '--';
					if(i === 0){
						uniqueDetails.push({Partner_Airline:u_owner,Operating_Airline:u_airline,Technology:u_access_technology_code});
	
						
					}
					else{
						if(uniqueDetails.length>=1){
							
							for(let uniqueIndex=0;uniqueIndex<uniqueDetails.length;uniqueIndex ++){
								
								if(uniqueDetails[uniqueIndex].Partner_Airline === u_owner &&
									uniqueDetails[uniqueIndex].Operating_Airline === u_airline &&
									uniqueDetails[uniqueIndex].Technology === u_access_technology_code)
								{
									unique +=1;
								}
							}
							if(unique === 0){
								uniqueDetails.push({Partner_Airline:u_owner,Operating_Airline:u_airline,Technology:u_access_technology_code});

							}
						}
					}
				}
				for(let airline =0;airline<uniqueDetails.length;airline++){
					for(let airlineType=0;airlineType<airlineTypes.length;airlineType++){
						for(i=0; i<data["result"].length; i++){
							if(data["result"][i]["u_airline"] === uniqueDetails[airline].Partner_Airline &&
								data["result"][i]["u_operator"] === uniqueDetails[airline].Operating_Airline &&
								data["result"][i]["u_access_technology_code"] === uniqueDetails[airline].Technology &&
								data["result"][i]["u_aircraft_type"] === airlineTypes[airlineType])
							{
								// debugger;
								link1='#';
								link2='#';
								link3='#';
								aline = null;
								tmoip = null;
								tail = null;
								// console.log(data);
								// console.log(i);
								u_airline = data["result"][i]["u_operator"];
								u_aircraft_type = data["result"][i]["u_aircraft_type"];
								u_owner = data["result"][i]["u_airline"];
								u_access_technology_code = data["result"][i]["u_access_technology_code"];
								u_tail_number = data["result"][i]["name"] ? data["result"][i]["name"] : '--';


								u_airline1 = {name:"O Airline", value:data["result"][i]["u_operator"]} ;
								u_aircraft_type1 ={name:"TYpe", value:data["result"][i]["u_aircraft_type"]} ; 
								u_owner1 =  {name:"Owner", value:data["result"][i]["u_airline"]} ;
								u_access_technology_code1 = {name:"TECH", value:data["result"][i]["u_access_technology_code"]} ;
								u_tail_number1 = {name:"TAil NO", value:data["result"][i]["name"] ? data["result"][i]["name"] : '--'} ;
								// console.table([u_airline1,u_aircraft_type1,u_owner1,u_access_technology_code1,u_tail_number1]);
									// }
								if(u_tail_number != '0'){
									// aline = data1['aline'] ? data1['aline'] : null;
									// tmoip = data1['tmoip'] ? data1['tmoip'] : null;
									// tail = data1['tail'] ? data1['tail'] : null;
									aline = 	airline_data.find(o => o.Tail === u_tail_number) ? airline_data.find(o => o.Tail === u_tail_number).Airline : null ;
									tmoip = tmoip = tmIP_data.find(o => o.TailNumber === u_tail_number) ? tmIP_data.find(o => o.TailNumber === u_tail_number)['Static IP'] : null;
									tail = u_tail_number ? u_tail_number : null;

									if(aline != null){
										link1 = 'http://'+tail+'.'+aline+'.abs-ops.com:8084/maintenance/';
										link2 = 'http://'+tail+'-gate.'+aline+'.abs-ops.com:8084/maintenance/';
									}
									if(tmoip != null){
										link3 = 'http://'+tmoip+':8084/maintenance/';
									}


								}
								u_aircraft_maintenance_manual = data["result"][i]["u_aircraft_maintenance_manual"];

								fn = 'openLink("'+link1+'","'+link2+'","'+link3+'")';
								$('#tail_result tbody').append('<tr id='+i+'>');
								$('#'+i).append("<td id='OW_"+i+"'>"+u_owner+"</td>"+"<td id='OA_"+i+"'>"+u_airline+"</td>"+"<td id='TH_"+i+"'>"+u_access_technology_code+"</td>"+"<td id='AT_"+i+"'>"+u_aircraft_type+"</td>"+"<td id='TL_"+i+"'>"+u_tail_number+"</td>"+"	<td id='LK_"+i+"'>"+"<button class='maintainace' onClick="+fn+"><u>Click Here</u></button>&nbsp</td></tr>");	

								}
							
						}

					}
					
				}
				

			},
			error : function(request,error)
			{
				console.log("Request: "+JSON.stringify(request));
			}

		});
	}
	else{
		// console.log('Please select a value');
		// alert('Please select a value');
		$("#load").hide();
		$('#emptyval').show();
		$('#tail_result').hide();
	}
});
$('#taillist').change(function(){
	$('#emptyval').hide();
	// $('#tail_result').hide();
});
function get_Url(){
	// airline_data.find(o => o.Tail === 'CFDQQ').Airline;
	// var airline_data;
	// var tmIP_data
	var report_results_data;
	$.ajax({
		url : 'https://care.inflightinternet.com/cgi-bin/aircell.cfg/php/custom/fetch_all_url_contents.php',
		type : 'GET',
		async: false,
		dataType:'json',
		success : function(report_results) {
			// console.log(report_results);
			// airline_data = report_results['airline_data'];
			// tmIP_data =report_results['tmoip_data'];
			report_results_data = report_results;
		}
	});
	return report_results_data;
}
function customize_url(){
	aline = data1['aline'] ? data1['aline'] : null;
	tmoip = data1['tmoip'] ? data1['tmoip'] : null;
	tail = data1['tail'] ? data1['tail'] : null;
	if(aline != null){
	link1 = 'http://'+tail+'.'+aline+'.abs-ops.com:8084/maintenance/';
	link2 = 'http://'+tail+'-gate.'+aline+'.abs-ops.com:8084/maintenance/';
	}
	if(tmoip != null){
	link3 = 'http://'+tmoip+':8084/maintenance/';
	}
}
function openLink(link1,link2,link3){
	// alert(link1);
	if(link1 != '#'){
		window.open(link1);
	}
	if(link2 != '#'){
		window.open(link2);
	}
	if(link3 != '#'){
		window.open(link3);
	}
}
</script>
