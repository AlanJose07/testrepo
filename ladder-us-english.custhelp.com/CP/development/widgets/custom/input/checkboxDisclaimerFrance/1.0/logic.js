RightNow.namespace('Custom.Widgets.input.checkboxDisclaimerFrance');
Custom.Widgets.input.checkboxDisclaimerFrance = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		this.input = this.Y.one("#terms_conditions1_France");
		this.input.on("change", this.checkSelected, this);
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	checkSelected: function() {
		var selectedbox = false;
		if(this.input.get('checked')) 
		{ 
			selectedbox = true;
		}
		var eventObj = new RightNow.Event.EventObject(this, {data:  {isSelected: selectedbox}});
		RightNow.Event.fire("evt_selectbox", eventObj);
	}
});