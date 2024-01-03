RightNow.namespace('Custom.Widgets.reports.MultilineStandardText');
Custom.Widgets.reports.MultilineStandardText = RightNow.ResultsDisplay.extend({ 
    /**
     * Widget constructor.
     */
	overrides:{
    constructor: function() {
		this.parent();
		
		var sla=this.data.js.sla;
			
			RightNow.Event.subscribe("evt_setValueKeyword", this._stdText, this);
			
				 
			

    },
	_stdText:function(type,args)
		{
			var keyword = args[0].data.keyword;
			
			 if(keyword != "")
			 {
				RightNow.Ajax.makeRequest('/cc/ajaxCustom/getstdText/', {stText:keyword}, {
				successHandler: function(response) 
				{
					
					if((response.responseText.length)>0)
					{
					var resp=response.responseText;
					 YUI().use('node', function(Y) { 
			 
			 Y.one('#rn_PageContentGoogle').addClass('highlight');
			 
			
			});
					document.getElementById("google_heading").innerHTML = "<h2>Standard Text</h2>";
					document.getElementById("google_details").innerHTML = resp;
					
					}
					
	
				}
				
			});
			 }
			 else
			 {
				
				
				 YUI().use('node', function(Y) { 
			 
			 Y.one('#rn_PageContentGoogle').removeClass('highlight');
			 
			
			});
				 	document.getElementById("google_heading").innerHTML="";
					document.getElementById("google_details").innerHTML = "";
			 }
			
		},
	},


    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});