RightNow.namespace('Custom.Widgets.reports.MultilineGoogle');
Custom.Widgets.reports.MultilineGoogle = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
	 
	 if(this.data.attrs.myvalue!=null)
		{
			
			this._googleSearch1();
		}
		RightNow.Event.subscribe("evt_setValueKeyword", this._googleSearch, this);
		RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjax, this);
		
    },
	
	_googleSearch1: function() {
	
		var keyword = this.data.attrs.myvalue;
			var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    
                document.getElementById("CO_details").innerHTML = xmlhttp.responseText;
           }
     
       }
    
       
	 
	 
      var re=xmlhttp.open("GET", "/cc/AjaxCustom/SearchCO/"+ keyword , true);
	  
     xmlhttp.send();
	 
		
			
	},
	
	_googleSearch: function(type,args) {
		
	    
		var keyword = args[0].data.keyword;
	
		
					var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    if(xmlhttp.responseText!="" && keyword!="")
	{
    	var Obj = new RightNow.Event.EventObject(this, {data: {results:"no"}});
		RightNow.Event.fire("evt_srchRes", Obj);
	}
                document.getElementById("CO_details").innerHTML = xmlhttp.responseText;
           }
     
       }
    
      
	 if(keyword != "")
	 {
	  
		 
     xmlhttp.open("GET", "/cc/AjaxCustom/SearchCO/" + keyword, true);
	 
     xmlhttp.send();
	 }
	
		
			
	},

    /**
     * Sample widget method.
     */
    _onBeforeAjax: function(type,args) {
		
		
		if(args[0].url == "/ci/ajaxRequest/getReportData") {
			args[0].url = "/cc/ajaxCustom/Agent_getReportData";
		}
	}
});