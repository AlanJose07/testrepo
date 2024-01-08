RightNow.namespace('Custom.Widgets.input.CheckboxShakeBoost');
Custom.Widgets.input.CheckboxShakeBoost = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		  this.Y.one("#shake_boost").on("click",this.check_shake_boost,this);

    },
	check_shake_boost: function() {
		
		shake_boost_checked = document.getElementById("shake_boost").checked;
		var eventObject = new RightNow.Event.EventObject(this, {data: {value: shake_boost_checked}});
        RightNow.Event.fire("evt_shake_boost", eventObject);	
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});