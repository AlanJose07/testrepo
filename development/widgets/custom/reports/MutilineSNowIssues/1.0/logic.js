RightNow.namespace('Custom.Widgets.reports.MutilineSNowIssues');
Custom.Widgets.reports.MutilineSNowIssues = RightNow.Widgets.extend({ 
   /**
     * Widget constructor.
     */
    constructor: function() {
		if(this.data.attrs.myvalue!=null)
		{
			
			this.searchSnow();
			RightNow.Event.subscribe("evt_setValueKeyword", this.searchSnow, this);
			RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjax, this);
		}
		else
			this.getSnow();

    },
	
	searchSnow:function()
	 {
		 var keyword = this.data.attrs.key;
		 var xmlhttp = new XMLHttpRequest();
		 		  xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
    			
                document.getElementById("SNow_details").innerHTML = this.responseText;
           }
     
       };
	   xmlhttp.open("GET", "/cc/AjaxCustom/getsnowissues/"+key, true);
     	 xmlhttp.send();

		 
	 },

     getSnow:function()
	 {
		 var key="";
		 var xmlhttp = new XMLHttpRequest();
		 		  xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
    			
                document.getElementById("SNow_details").innerHTML = this.responseText;
           }
     
       };
	   xmlhttp.open("GET", "/cc/AjaxCustom/getsnowissues"+key, true);
     	 xmlhttp.send();

		 
	 },
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});