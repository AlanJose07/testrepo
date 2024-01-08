RightNow.namespace('Custom.Widgets.input.CheckBoxGDPRFrance');
Custom.Widgets.input.CheckBoxGDPRFrance = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		this.input = this.Y.one("#terms_conditions_France");
		this.input.on("change", this.checked, this);
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	checked: function() {
		var checked = false;
		if(this.input.get('checked')) 
		{ 
			checked = true;
		}
		var eventObj = new RightNow.Event.EventObject(this, {data:  {isChecked: checked}});
		RightNow.Event.fire("evt_checkbox", eventObj);
	}
});