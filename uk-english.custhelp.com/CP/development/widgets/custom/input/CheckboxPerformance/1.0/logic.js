RightNow.namespace('Custom.Widgets.input.CheckboxPerformance');
Custom.Widgets.input.CheckboxPerformance = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		  this.Y.one("#check_performance").on("click",this.checkbox_performance,this);

    },
	checkbox_performance: function() {
		
		shake_boost_checked = document.getElementById("check_performance").checked;
		var eventObject = new RightNow.Event.EventObject(this, {data: {value: shake_boost_checked}});
        RightNow.Event.fire("evt_check_performance", eventObject);	
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});