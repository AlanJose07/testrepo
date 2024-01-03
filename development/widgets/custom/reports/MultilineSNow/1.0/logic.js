RightNow.namespace('Custom.Widgets.reports.MultilineSNow');
Custom.Widgets.reports.MultilineSNow = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
this.getSnow();
    },

     getSnow:function()
	 {
		 
		 var xmlhttp = new XMLHttpRequest();
		 		  xmlhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
                document.getElementById("SNow_details").innerHTML = this.responseText;
           }
     
       };
	   xmlhttp.open("GET", "/cc/AjaxCustom/getsnowissues", true);
     	 xmlhttp.send();

		 
	 },
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});