RightNow.namespace('Custom.Widgets.ResponsiveDesign.FocusChatOnResponse');
Custom.Widgets.ResponsiveDesign.FocusChatOnResponse = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data,instanceID) {
		//alert("in cinstructor");
		this.data = data;
   		this.instanceID = instanceID;
		document.title = "Test..!";
		RightNow.Event.subscribe("evt_chatPostResponse", this._focusTab, this);
		this.input = document.getElementById('rn_'+this.instanceID);
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	_focusTab: function() {
		window.focus();
		this.input.focus();
		//document.getElementsByTagName('title')[0].innerHTML = "testing";
		//alert("on focus tab fn");
		/*top.window.focus();
        this.input.focus();
		document.title = "Testing success..!";*/
	}
});