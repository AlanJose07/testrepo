<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="taillist_template.php" clickstream="answer_list" login_required="true"/>
<!-- <rn:widget path="custom/AdditionalServices/sessionTracker" usertype="AMCC_Agent"/> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
#emptyResultBanner{
	padding-top: 5%;
	padding-left: 25%;
}
#emptyResultspan{
	font-size: 265%;
	font-family: Helvetica, sans-serif !important;
}
.filterColumnNames{
	justify-items: center;
	background-color: #545454;
	color: whitesmoke;
	font-size: 12px;
	display: grid;
	font-family: Helvetica, sans-serif !important;
	font-weight: bold;
	height: 22%;
	padding-top: 1%;
	max-height: 30px;
	min-height: 30px;
}

.filterContainer{
	display: flex;
	flex-direction: row;
	flex-wrap: wrap;
	width: 100%;
	gap: 3px;
	margin-top: 5px;

}
.filtersColumn{
	display: flex;
	flex-direction: column;
	min-width: 135px;
	border-style: solid;
	border-width: 1px;
}
#resultTable,#tbl-filter-wrapper{
	display:none;
}
#tbl-filter-wrapper{
	
}
/* Filter showig */


.selectedListaircraftTypeFilterBox, .selectedListTechnologyFilterBox,
.selectedListpartnerAirlineFilterBox,.selectedListoperatingAirlineFilterBox{
	display: inline-flex;
	align-items: center;
	padding: 0px 8px;
	background-color: #eaeaea;
	color: #333;
	margin-left: 3px;
	margin-right: 3px;
	border-radius: 20px;
	font-weight: bold;
}
#td-filterAction{
	display: flex;
	flex-direction: row;
	height: fit-content;
	padding: 3% 0;
}
#tbl-filter{
	cellpadding: 0;
    border-collapse: collapse;
    border: 1px solid black;
    cell-spacing: 0;
	width:75%;
	margin-left: auto;
 	margin-right: auto;

}
#table-filter tr{
	height: calc(fit-content + 10px);
}
#tbl-filter td{
	height: 27px;
	width: 100px;
    border: 1px solid black;
    text-align: center;
}
#tbl-filter th {
    text-align: center;
    width: 50px;
    border: 1px solid black;
    background: #545454;
    padding: 5px;
    color: #fff;
    font-size: 14px;
}

/* Filter show end */
.filterButton{
  align-items: center;
  appearance: none;
  /* background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%); */
  border: 0;
  border-radius: 6px;
  box-shadow: rgba(45, 35, 66, .4) 0 2px 4px,rgba(45, 35, 66, .3) 0 7px 13px -3px,rgba(58, 65, 111, .5) 0 -3px 0 inset;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  font-family: "JetBrains Mono",monospace;
  height: 30px;
  justify-content: center;
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 13px;
  padding-right: 13px;
  position: relative;
  text-align: left;
  text-decoration: none;
  transition: box-shadow .15s,transform .15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow,transform;
  font-size: 18px;
  width: 35%;
  margin-left: 8%;
  background-color:#2ebaf8;

}
#partnerAirlineFilter,#operatingAirlinefilter,#Technologyfilter,#aircraftTypefilter{
	display:none;
}
.filterBox{
	width:20px;
	height:20px;
}
.filterIcon{
	
	width: 10px;
	height: 10px;
	content:url(../standard/images/cat-icon.png);
	background:none;
}
#selectedFilterList{
	display:flex;
	flex-direction:row;
	gap:10px;
}
/*  */
.th-dropdown {
	display: flex;
	flex-direction: row;
	justify-content: space-between;
	align-items: center;
}
.dropdownFilter{
	display:none;
	position: relative;
	z-index: 888;
}
.btn-dropdown {
	padding: 1px;
	border: 1px solid #ccc;
	background-color: #fff;
	cursor: pointer;
}
.dropdown-list {
	position: absolute;
	top: 100%;
	left: 0;
	z-index: 999;
	padding: 0;
	margin: 0;
	list-style: none;
	border: 1px solid #ccc;
	background-color: black;
	overflow-y: auto;
	max-height: 150px;
	width:65%;
}
.dropdown-list li {
	padding: 5px;
}
.dropdown-list li label {
	display: block;
}
.dropdown-list li input[type="checkbox"] {
	margin-right: 5px;
}
.dropdown-list.hidden {
	display: none;
}
/*  */
body {
 overflow: hidden;
 max-height: 100vh;
}
.filterMainBox{
	display		:flex;
	flex-direction	:row;
	/* background-color: black; */
	gap:3px;
	width: 100%;
}
/* #filterBox{
	display		:none;
} */
.filterReset{
	margin-left :20px;
}
/* #filterApply{
	margin-left :600px;
} */
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
    background: #545454;
    padding: 5px;
    color: #fff;
    font-size: 14px;
}
.loader {
    position: absolute;
    /* margin-top: 5%;
    margin-left: 50%;
    margin-right: 50%; */
	top: calc(50% - 40px);
  	left: calc(50% - 40px);
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
	top: calc(40% - 40px);
  	left: calc(45% - 40px);
    /* margin-left: 45%; */
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
    max-height: 50vh;
	min-height:400px;
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

/* */
.partnerAirlineFilterlist{
	display:block !important;
}

.close-button_aircraftTypeFilterBox,
.close-button_TechnologyFilterBox,
.close-button_operatingAirlineFilterBox,
.close-button_partnerAirlineFilterBox{
	margin-left: 5px;
	border: none;
	background-color: transparent;
	color: #333;
	cursor: pointer;
	width: 0px;
	height: 69%;
	justify-content: center;
	display: grid;
	padding: 0px 7px 2px 4px;
	
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
<div id="tbl-filter-wrapper">

	<div class="filterMainBox" id="filterBox">
		<div class="filtersColumn">
			<div class="filterColumnNames">Partner Airline Filters</div>
			<div class="filterContainer" id="selected_partnerAirlineFilterBox"></div>
		</div>
		<div class="filtersColumn">
			<div class="filterColumnNames">Operator Airline Filters</div>
			<div class="filterContainer" id="selected_operatingAirlineFilterBox"></div>
		</div>
		<div class="filtersColumn">
			<div class="filterColumnNames">Technology Filters</div>
			<div class="filterContainer" id="selected_TechnologyFilterBox"></div>
		</div>
		<div class="filtersColumn">
			<div class="filterColumnNames">Aircraft Type Filters</div>
			<div class="filterContainer" id="selected_aircraftTypeFilterBox"></div>
		</div>
		<div id="td-filterAction">
			<div id="filterApply" class="filterButton">Apply</div>
			<div id="filterReset" class="filterButton">Reset</div> </td>	
		</div>
	</div>
	<!-- <table id="tbl-filter">
	<thead>
		<tr>
			<th>Partner Airline Filters</th>
			<th>Operator Airline Filters</th>
			<th>Technology Filters</th>
			<th>Aircraft Type Filters</th>
			<th>Action</th>
		</tr>

	</thead>
	<tbody>
		<tr>
			<td class="filterContainer" id="selected_partnerAirlineFilter"></td>
			<td class="filterContainer" id="selected_operatingAirlineFilterBox"></td>
			<td class="filterContainer" id="selected_TechnologyFilterBox"></td>
			<td class="filterContainer" id="selected_aircraftTypeFilterBox"></td>
			<td id="td-filterAction"><div id="filterApply" class="filterButton">Apply</div>
				<div id="filterReset" class="filterButton">Reset</div> </td>
		</tr>

	</tbody>

	</table> -->
</div>

<!-- <div class="filterMainBox" id="filterBox">
	<div id="selectedFilterList">
		<div id="partnerAirlineFilterWindow" class"filterBox">
			qqqqqq <br>fsfsd<br>
		</div>
		<div id="operatorAirlineFilterWindow" class"filterBox">
			wwwwwwwwwwwww<br>fsfsd<br>
		</div>
		<div id="technologyFilterWindow" class"filterBox">
			sssss<br>fsfsd<br>
		</div>
		<div id="aircraftTypeFilterWindow" class"filterBox">
			rrrrrrrrr<br>fsfsd<br>
		</div>

	</div>
	<div id="filterApply" class="filterButton">Apply</div>
	<div id="filterReset" class="filterButton">Reset</div>
</div> -->
<br><br><br>
<div id="resultTable" class="tablewrapper">
	<table id="tail_result">
		<thead>
          	<tr>
				<th class="text-center"> 
					<div class="th-dropdown">
						<span>Partner Airline</span>
						<div class="btn-dropdown" id="hide-partnerAirlinefilter"><span id="pAirlinefilterIcon" class="filterIcon"></span></div>
					</div>
					<div class="dropdownFilter" id="partnerAirlineFilter">
						<ul class="dropdown-list" id="partnerAirlineFilterBox">
						</ul>
					</div>
							<!-- <select class="filterselect" name="partnerAirline" id="partnerAirlinefilter" onchange="filterApply()">
								<option value="0">SELECT</option>
							</select>  -->
				</th> 
				<th class="text-center">
					<div class="th-dropdown">
						<span>Operating Airline</span>
						<div class="btn-dropdown" id="hide-operatingAirlinefilter"><span class="filterIcon"></span></div>
					</div>
					<div class="dropdownFilter" id="operatingAirlinefilter">
						<ul class="dropdown-list" id="operatingAirlineFilterBox">	
						</ul>
					</div>
					<!-- <select class="filterselect" name="OperatingAirline" id="OperatingAirlinefilter" onchange="filterApply()">
						<option value="0">SELECT</option>
						
					</select> -->
				</th>
				<th class="text-center">
					<div class="th-dropdown">
						<span>Technology</span>
						<div class="btn-dropdown" id="hide-Technologyfilter"><span class="filterIcon"></span></div>
					</div>
					<div class="dropdownFilter" id="Technologyfilter">
						<ul class="dropdown-list" id="TechnologyFilterBox">
						</ul>
					</div>
				</th>
				<th class="text-center">
					<div class="th-dropdown">
						<span>Aircraft Type</span>
						<div class="btn-dropdown" id="hide-aircraftTypefilter"><span class="filterIcon"></span></div>
					</div>
						<div class="dropdownFilter" id="aircraftTypefilter">
							<ul class="dropdown-list" id="aircraftTypeFilterBox">
							</ul>
						</div>
				</th>
				<th class="text-center">Tail number</th>
				<th class="text-center">Maintenance</th>
          	</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

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
				$("#resultTable").hide();
				$("#filterBox").hide();
				$("#tbl-filter-wrapper").hide();
			},
			complete: function () {
				setTimeout(function () {
					$("#load").hide();
					$("#resultTable").show();
					$("#tail_result").show();
					$("#filterBox").show();
					$("#tbl-filter-wrapper").show();
				}, 1000);
			},
			success : function(data) {
				taliListView(data);

				// console.table(airlineTypes);
				//console.table(partnerAirline);
				// console.table(ownerAirline);
				// console.table(accessTechnology);

				
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
function addSearchfilteroption(elementID,options)
{
	let fList = document.getElementsByClassName(elementID+"list");	
	let filterOption = document.getElementById(elementID);
	$("#"+elementID).html("");
	let optionLength = options.length;
	let li=document.createElement('li');
	li.setAttribute("id",elementID+"l_ALL");
	li.setAttribute("class",elementID+"list");
	li.style.display="block";
	li.innerHTML='<label class="filter"><input id="'+elementID+'_ALL"  class="'+elementID+'Option" type="checkbox" value="All" >ALL</label> ';
	filterOption.append(li);

	let setChecked1 = document.getElementById(elementID+'_ALL');
	setChecked1.checked	=	true;
// filter list of selected items
	let selectedFilter = document.getElementById("selected_"+elementID);
	selectedFilter.innerHTML="";
	let cSpan = document.createElement('span');
	cSpan.classList.add(`selectedList${elementID}`);
	cSpan.id = `s_${elementID}_ALL`;
	cSpan.innerHTML = 'ALL<div id="btn_'+elementID+'_ALL" class="close-button_'+elementID+'">&times;</div>';
	// cSpan.innerHTML = 'ALL';
	// cSpan.innerHTML="<span class='selectedList"+elementID+"' id="s_'+elementID+'_ALL'">ALL<span>";
	selectedFilter.append(cSpan);
	for(let optionIndex =0; optionIndex<optionLength;optionIndex++)
	{	
		// selected filter
		var cSpan1 = document.createElement('span');
		cSpan1.classList.add(`selectedList${elementID}`);
		cSpan1.id = `s_${elementID}_${optionIndex}`;
		cSpan1.innerHTML = options[optionIndex]+'<div id="btn_'+elementID+'_'+optionIndex+'" class="close-button_'+elementID+'">&times;</div>';
		//cSpan1.innerHTML = options[optionIndex];
		// cSpan1.innerHTML="<span class='selectedList"+elementID+"' id="+elementID+options[optionIndex]+">"+options[optionIndex]+"<span>";
		selectedFilter.append(cSpan1);

		// table filter
		let filterList = document.createElement('li');
		filterList.setAttribute("id",elementID+"_l"+(optionIndex));
		filterList.setAttribute("class",elementID+"list");
		filterList.style.display="block";
		filterList.innerHTML='<label class="filter"><input id='+elementID+'_'+(optionIndex)+'  class='+elementID+'Option type="checkbox" value="'+options[optionIndex]+'" >'+options[optionIndex]+'</label> ';
		filterOption.append(filterList);
		// console.log(elementID+'_'+(optionIndex+1));
		// let checkBoxId = elementID+'_'+(optionIndex+1);
		// let setChecked		=	document.getElementById(elementID+'_'+(optionIndex+1));
		let setChecked		=	document.getElementById(elementID+'_'+(optionIndex));
		// console.log(setChecked);
		console.log("-----------++-------------");
		setChecked.checked	=	true;
		
	}
	console.log("Filter Added::"+elementID);
	
}

function taliListView(data)
{
	var result =JSON.stringify(data);
	tail_found = 0;
	report_results = get_Url();
	airline_data = report_results['airline_data'];
	tmIP_data =report_results['tmoip_data'];
	let airlineTypes=[];
	let partnerAirline=[];
	let ownerAirline=[];
	let accessTechnology=[];
	for(i=0; i<data["result"].length; i++){
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
		
		if(airlineTypes.length!=0){
			if (!airlineTypes.includes(u_aircraft_type)){
				airlineTypes.push(u_aircraft_type);
			}
			
		}
		else{
			airlineTypes.push(u_aircraft_type);
		}

		if(partnerAirline.length!=0){
			if(!partnerAirline.includes(u_owner)){
				partnerAirline.push(u_owner);
			}
		}
		else{
			partnerAirline.push(u_owner);
		}

		if(ownerAirline.length!=0){
			if(!ownerAirline.includes(u_airline)){
				ownerAirline.push(u_airline);
			}
		}
		else{
			ownerAirline.push(u_airline);
		}

		if(accessTechnology.length!=0){
			if(!accessTechnology.includes(u_access_technology_code)){
				accessTechnology.push(u_access_technology_code)
			}
		}
		else{
			accessTechnology.push(u_access_technology_code);
		}
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
	console.table(partnerAirline);
	addSearchfilteroption("partnerAirlineFilterBox",partnerAirline);
	addSearchfilteroption("operatingAirlineFilterBox",ownerAirline);
	addSearchfilteroption("TechnologyFilterBox",accessTechnology);
	addSearchfilteroption("aircraftTypeFilterBox",airlineTypes);
}


$("#hide-partnerAirlinefilter").click(function() {
	$("#partnerAirlineFilter").toggle();
	$('#aircraftTypefilter').hide();
	$('#Technologyfilter').hide();
	$('#operatingAirlinefilter').hide();
});
$('#hide-operatingAirlinefilter').click(function(){
	$('#operatingAirlinefilter').toggle();
	$("#partnerAirlineFilter").hide();
	$('#aircraftTypefilter').hide();
	$('#Technologyfilter').hide();
});
$('#hide-Technologyfilter').click(function(){
	$('#Technologyfilter').toggle();
	$('#operatingAirlinefilter').hide();
	$("#partnerAirlineFilter").hide();
	$('#aircraftTypefilter').hide();
});
$('#hide-aircraftTypefilter').click(function(){
	$('#aircraftTypefilter').toggle();
	$('#Technologyfilter').hide();
	$('#operatingAirlinefilter').hide();
	$("#partnerAirlineFilter").hide();
});

document.querySelector('#filterApply').addEventListener('click',function(){

	hideAllFilter();
	const selectedOperatingAirline = document.getElementsByClassName('operatingAirlineFilterBoxOption');
	const selectedPartnerAirline = document.getElementsByClassName('partnerAirlineFilterBoxOption');
	const selectedTechnology = document.getElementsByClassName('TechnologyFilterBoxOption');
	const selectedAircraftType = document.getElementsByClassName('aircraftTypeFilterBoxOption');

	let partnerAirlineCheckBoxArray = Array.from(selectedPartnerAirline);
	let technologyCheckBoxArray = Array.from(selectedTechnology);
	let aircraftTypeCheckBoxArray = Array.from(selectedAircraftType);
	let opAirnlinecheckboxesArray = Array.from(selectedOperatingAirline); 



	let selectedOpAirlineCheckbox=[];
	let selectedPartnerAirlineCheckBox=[];
	let selectedTechnologyCheckBox=[];
	let selectedAircraftTypeCheckBox=[];


	var i=0;
	opAirnlinecheckboxesArray.forEach((checkbox) => {
	if (checkbox.checked) {
		selectedOpAirlineCheckbox[i] = checkbox.value;
		i++;
	}
	});
	var i=0;
	partnerAirlineCheckBoxArray.forEach((checkbox)=>{
		if(checkbox.checked){
			selectedPartnerAirlineCheckBox[i]=checkbox.value;
			i++;
		}
	});
	var i=0;
	technologyCheckBoxArray.forEach((checkbox)=>{
		if(checkbox.checked){
			selectedTechnologyCheckBox[i] = checkbox.value;
			i++;
		}
	});
	var i=0;
	aircraftTypeCheckBoxArray.forEach((checkbox)=>{
		if(checkbox.checked){
			selectedAircraftTypeCheckBox[i] = checkbox.value;
			i++;
		}	
	});
	console.table(selectedOpAirlineCheckbox);
	console.table(selectedPartnerAirlineCheckBox);
	console.table(selectedTechnologyCheckBox);
	console.table(selectedAircraftTypeCheckBox);
	

	const table = document.getElementById('tail_result');
	const rows = table.getElementsByTagName('tr');

	const values = [];

	for (let i = 0; i < rows.length; i++) {
		const cells = rows[i].getElementsByTagName('td');
		const rowValues = [];
		
		for (let j = 0; j < cells.length; j++) {
			rowValues.push(cells[j].textContent);
		}
		values.push(rowValues);
	}
	console.log(values);
	let totalRow = (values.length);
	let filteredList = 0;
	for(let row= 1;row<totalRow;row++){
		let flag = 0;
		
		let hideRow = document.getElementById(row-1);
		// if(row == 154){
		// 	console.log(hideRow);
		// 	debugger;
		// }
		
		if(selectedPartnerAirlineCheckBox.length!=0){
			if(selectedPartnerAirlineCheckBox.includes(values[row][0])){
				flag++;
			}
		}
		if(selectedAircraftTypeCheckBox.length!=0){
			if(selectedAircraftTypeCheckBox.includes(values[row][3])){
				flag++;
			}	
		}
		if(selectedTechnologyCheckBox.length!=0){
			if(selectedTechnologyCheckBox.includes(values[row][2])){
				flag++;
			}
		}
		if(selectedOpAirlineCheckbox.length!=0){
			if(selectedOpAirlineCheckbox.includes(values[row][1])){
				flag++;
			}
		}
		if(flag <4){
			hideRow.style.display = 'none';
			filteredList++;
		}
		else{
			if(document.getElementById('emptyResultBanner')){
				document.getElementById('emptyResultBanner').style.display='none';
			}
			hideRow.style.display = 'table';
			hideRow.style.display = '';
		}	
	}
	const element = document.getElementById('resultTable');
	if(filteredList === (rows.length-1)){
		
		if (element.offsetHeight <= 400) {
			element.style.overflowY = 'hidden';
		}
		let resultTable = document.getElementById('resultTable');
		let emptyResult = document.createElement('div');
		emptyResult.setAttribute("id","emptyResultBanner");
		emptyResult.style.display = "block";
		//emptyResult.setAttribute('style','font-size:30px');
		emptyResult.innerHTML="<span id='emptyResultspan'>There is no data with selected filter.";
		resultTable.append(emptyResult);
	}
	else{
		element.style.overflowY = 'scroll';
	}

});

// $(document).on("click", function(event){
//         var $trigger = $("#hide-aircraftTypefilter");
// 		var $trigger1 = $("#hide-partnerAirlinefilter");
// 		var $trigger2 = $("#hide-operatingAirlinefilter");
// 		var $trigger3 = $("#hide-Technologyfilter");

// 		console.log("Event:"+event.target);
// 		console.log(event.target.id);

//         if($trigger !== event.target && !$trigger.has(event.target).length){
//             $("#aircraftTypefilter").hide();
//         }
// 		if($trigger1 !== event.target && !$trigger1.has(event.target).length){
//             $("#partnerAirlineFilterBox").hide();
//         }
// 		if($trigger2 !== event.target && !$trigger2.has(event.target).length){
//             $("#operatingAirlinefilter").hide();
//         }
// 		if($trigger3 !== event.target && !$trigger3.has(event.target).length){
//             $("#Technologyfilter").hide();
//         }
// }); 


// var dropdownMenu = document.getElementById("dropdown-menu");
// var dropdownButton = document.getElementById("dropdown-button");
// document.addEventListener("click", function(event) {
//   if (event.target != dropdownButton && !dropdownMenu.contains(event.target)) {
//     dropdownMenu.style.display = "none";
//   }
// });



// // document.onclick = hideAllFilter();
document.querySelector('#filterReset').addEventListener('click',function(){
	hideAllFilter();
	let allCheckBoxList	=	document.querySelectorAll('.aircraftTypeFilterBoxOption,.TechnologyFilterBoxOption,.partnerAirlineFilterBoxOption,.operatingAirlineFilterBoxOption');
	allCheckBoxList.forEach((checkbox)=>{
		checkbox.checked=true;
	});

	let allFilterSpan = document.querySelectorAll('.selectedListaircraftTypeFilterBox,.selectedListTechnologyFilterBox,.selectedListoperatingAirlineFilterBox,.selectedListpartnerAirlineFilterBox');
	allFilterSpan.forEach((span)=>{
		span.style.display='span';
		span.style.display='';
	});

	const resultTable = document.getElementById('tail_result');
	const resultRows = resultTable.getElementsByTagName('tr');
	const resultRowsLength	=	(resultRows.length)-1;
	
	let index = 0;
	while (index < resultRowsLength){
		let hideRow = document.getElementById(index);
		hideRow.style.display = 'table';
		hideRow.style.display = '';
		index++;
	}
	const element = document.getElementById('resultTable');
	element.style.overflowY = 'scroll';
		
	// console.log("total length::"+resultRows.length);
	// let length = (resultRows.length)-1;
	// for(let x1 = 0 ; x1<length;x1++){
	// 	let hideRow1 = document.getElementById(x1);// 	let hideRow1 = document.getElementById(x1);
	// 	hideRow1.style.display = 'table';
	// 	hideRow1.style.display = '';
	// }	

});


function hideAllFilter()
{
	$('#aircraftTypefilter').hide();
	$('#Technologyfilter').hide();
	$('#operatingAirlinefilter').hide();
	$("#partnerAirlineFilter").hide();
	return;
}


// let partnerAirlineSelectedlist = document.querySelectorAll('.partnerAirlineFilterOption');
// partnerAirlineSelectedlist.forEach(checkbox => {
// 	console.log("clicked the checkbox");
//   checkbox.addEventListener('change', () => {
//     if (checkbox.checked) {
//       console.log(`Checkbox ${checkbox.id} is checked.`);
//       // Your statement or function call here.
//     } else {
//       console.log(`Checkbox ${checkbox.id} is unchecked.`);
//     }
//   });
// });



// const checkboxGroup = document.querySelectorAll('#partnerAirlineFilterBox,#operatingAirlinefilter,#Technologyfilter,#aircraftTypefilter');

// checkboxGroup.addEventListener('change', (event) => {
//   const clickedElement = event.target;
  
//   if (clickedElement.type === 'checkbox') {
//     if (clickedElement.checked) {
//       console.log(`Checkbox ${clickedElement.id} is checked.`);


//       // Your statement or function call here.
//     } else {
//       console.log(`Checkbox ${clickedElement.id} is unchecked.`);
//     }
//   }
// });

// span filer box


let allspanClass	=	document.querySelectorAll('#selected_partnerAirlineFilterBox,#selected_operatingAirlineFilterBox,#selected_TechnologyFilterBox,#selected_aircraftTypeFilterBox');
//let allspanClass	=	document.querySelectorAll('.close-button_aircraftTypeFilterBox,.close-button_TechnologyFilterBox,.close-button_operatingAirlineFilterBox,.close-button_partnerAirlineFilterBox');

console.log(allspanClass);

console.log("Remove From Span Tag");
allspanClass.forEach((button)=>{
	button.addEventListener('click', (event) => {
		if(event.target.tagName ==='DIV'){
			const clickedElement = event.target;
			console.log(clickedElement);
			let spanfilter = document.getElementById(`s_${clickedElement.id.replace("btn_", "")}`);
			spanfilter.style.display = 'none';
			console.log(spanfilter);
		}
		
	});
});


// drop down filter 
const checkboxGroups = document.querySelectorAll('#partnerAirlineFilter,#operatingAirlinefilter,#Technologyfilter,#aircraftTypefilter');
console.log("Check box Start");
console.log(checkboxGroups);
console.log("Finshed");
checkboxGroups.forEach((checkboxGroup) => {
	console.log(checkboxGroup);
	console.log("Clicked 123");
  	checkboxGroup.addEventListener('change', (event) => {
		console.log("Tag::=="+event.target.tagName);
		if(event.target.type ==='checkbox'){
			console.clear();
			console.log("CheckBox");
		}
		console.log(event.target.type);
		if(event.target.className === 'partnerAirlineFilterBoxlist'  ||
			event.target.className === 'operatingAirlineFilterBoxOption' ||
			event.target.className === 'TechnologyFilterBoxOption' ||
			event.target.className === 'aircraftTypeFilterBoxOption'){
			const clickedElement = event.target;
			let spanfilter = document.getElementById(`s_${clickedElement.id}`);
			console.log("Span"+spanfilter);
			if (clickedElement.type === 'checkbox') {
				let allFilter ='';
				console.log(clickedElement.id);
				if(clickedElement.id.includes('_ALL')){
					allFilter = clickedElement.id.replace("s_", "").replace("_ALL", "");
				}
				else{
					allFilter = clickedElement.id.split('_')[0];
				}
				let checkboxALL = document.querySelectorAll('.'+allFilter+'Option');
				let checkBoxValues = checkboxALL;
				let allSpanFilter = document.querySelectorAll('.selectedList'+allFilter);
				if (clickedElement.checked) {
					console.log(`Checkbox ${clickedElement.id} is checked.`);
					if(clickedElement.id.includes('_ALL')){
						for (var i = 0; i < checkboxALL.length; i++) {
							console.log(checkboxALL[i]);
							checkboxALL[i].checked = true;
							allSpanFilter[i].style.display = 'span';
							allSpanFilter[i].style.display = '';
						}
					}
					else{
						spanfilter.style.display = 'span';
						spanfilter.style.display = '';
						checkAllSelectedOrNot(checkBoxValues);
					}
				} 
				else {
					console.log(`Checkbox ${clickedElement.id} is unchecked.`);
					if(clickedElement.id.includes('_ALL')){
						//const checkboxALL = document.querySelectorAll('.partnerAirlineFilterOption');
						for (var i = 0; i < checkboxALL.length; i++) {
							console.log("o_"+checkboxALL[i]);
							checkboxALL[i].checked = false;
							allSpanFilter[i].style.display = 'none';
						}
					}
					else{
						spanfilter.style.display = 'none';
						let ALL =0;
						let allSelectFlag = 0 ;
						let checkBoxLength = checkboxALL.length;
						for (var i = 0; i < checkBoxLength ; i++) {
							if(i === 0 && checkboxALL[i].checked ===true ){
								ALL++;
								continue;
							}
							if(checkboxALL[i].checked ===false){
								allSelectFlag++;
							}
						}
						if(allSelectFlag >0 && ALL>0  ){
							checkboxALL[0].checked=false;
							let spanALLShow = document.getElementById('s_'+checkboxALL[0].id.split('_')[0]+'_ALL');
							spanALLShow.style.display = 'none';

						}

					}
				}
			}

		}
		
	});
});





function checkAllSelectedOrNot(checkboxALL)
{
	let allSelectFlag = 0 ;
	let ALL =0;
	let checkBoxLength = checkboxALL.length;
	console.log("CheckBoxLength::"+checkBoxLength);
	for (var i = 0; i < checkBoxLength ; i++) {
		if(i === 0 && checkboxALL[i].checked ===false ){
			ALL++;
			continue;
		}
		if(checkboxALL[i].checked ===true){
			allSelectFlag++;
		}
	}
	if(allSelectFlag === (checkBoxLength-1) && ALL>0  ){
		checkboxALL[0].checked=true;
		let spanALLShow = document.getElementById('s_'+checkboxALL[0].id.split('_')[0]+'_ALL');
		spanALLShow.style.display = 'span';
		spanALLShow.style.display = '';

	}

}


// for (var i = 0; i < partnerAirlineSelectedlist.length; i++) {
// 	console.log("Hi");
// 	partnerAirlineSelectedlist[i].addEventListener("change", function() {
// 		console.log("select box clicked");
// 	// const selectedPartnerAirline = document.getElementsByClassName('partnerAirlineFilterOption');
// 	// const partnerAirlineCheckBoxArray = Array.from(selectedPartnerAirline);
// 	// let selectedPartnerAirlineCheckBox=[];
// 	// var i=0;
// 	// partnerAirlineCheckBoxArray.forEach((checkbox)=>{
// 	// 	if(checkbox.checked){
// 	// 		selectedPartnerAirlineCheckBox[i]=checkbox.value;
// 	// 		i++;
// 	// 	}
// 	// });
// 	// console.table(selectedPartnerAirlineCheckBox);
//   });
// }

// const myClass = document.querySelector('.partnerAirlineFilterOption');
// if(myClass){
// 	console.log(myClass);
// 	console.log("changed___");
// 	myClass.addEventListener('change', (event) => {
//   	console.log('A component in the class was clicked.');
//   // Your statement or function call here.
// });
// }

</script>
