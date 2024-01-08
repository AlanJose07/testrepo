RightNow.namespace('Custom.Widgets.input.Checkbox3DayRefresh');
Custom.Widgets.input.Checkbox3DayRefresh = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		  this.Y.one("#check_refresh").on("click",this.check_3day_refresh,this);

    },
	check_3day_refresh: function() {
		
		shake_boost_checked = document.getElementById("check_refresh").checked;
		var eventObject = new RightNow.Event.EventObject(this, {data: {value: shake_boost_checked}});
        RightNow.Event.fire("evt_check_refresh", eventObject);	
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});