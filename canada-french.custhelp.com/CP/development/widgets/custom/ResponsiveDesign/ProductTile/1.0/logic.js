RightNow.namespace('Custom.Widgets.ResponsiveDesign.ProductTile');
Custom.Widgets.ResponsiveDesign.ProductTile = RightNow.Widgets.extend({ 
    /**
     * Widget constructor...
     */
    constructor: function() {

	RightNow.Event.subscribe("onResponse",this.displayMessage,this);//fired from custom/responsive/UpdateCreditCardFormSubmit 
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	displayMessage: function(type,args) {
	
	
    	$("#responseMessage_cc").show();
		$("#responseMessage_cc").html("<p>" + args[0].data.msg + "</p>");
		$("#formdisplay").hide();
	
	   document.getElementById('closeButton').style.display = "block";
    }

});