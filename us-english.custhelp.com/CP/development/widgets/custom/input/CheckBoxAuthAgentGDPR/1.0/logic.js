RightNow.namespace('Custom.Widgets.input.CheckBoxAuthAgentGDPR');
Custom.Widgets.input.CheckBoxAuthAgentGDPR = RightNow.Widgets.extend({ 
    /**   
     * Widget constructor.
     */
    constructor: function() {
		this.input = this.Y.one("#terms_conditions_auth");
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
			document.getElementById("checkbox_comment").style.display="block";
			document.getElementById("authFields").style.display="block";

			
			
		} else {
			document.getElementById("checkbox_comment").style.display="none";
			document.getElementById("authFields").style.display="none";

		}
		var eventObj = new RightNow.Event.EventObject(this, {data:  {isChecked: checked}});
		RightNow.Event.fire("evt_authcheckbox", eventObj);
	}

});