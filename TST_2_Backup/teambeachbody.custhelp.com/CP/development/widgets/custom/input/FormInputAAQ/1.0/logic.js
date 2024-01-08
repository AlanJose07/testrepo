RightNow.namespace('Custom.Widgets.input.FormInputAAQ');
Custom.Widgets.input.FormInputAAQ = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		if(this.data.js.name === "Incident.CustomFields.c.member_type");
		{
		        this.input.on("change", this.membertypechanged, this);
                if(this.input.get('value'))
                    this.membertypechanged();
        }
		
    },
	
    /**
     * Event handler executed when member type dropdown is changed.
     */
    membertypechanged: function() {
        var value = this.input.get("value");
		//alert(value);
	},	

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});