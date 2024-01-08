RightNow.namespace('Custom.Widgets.input.SelectRequestType');
Custom.Widgets.input.SelectRequestType = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
			this._FieldName = FieldName;
			
			this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
			
		if(FieldName === "Incident.CustomFields.c.request_type_corp_support")
			{
				this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
				this.input.on("change", this.RequestType, this);
			}
        }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },

	RequestType: function()
	{

	//alert("hello");

	this.Value = this._inputField.options[this._inputField.selectedIndex].text;
	//alert(this.Value);
	var value = this.Value;
	
	var eventObject = new RightNow.Event.EventObject(this, {data:  value});
	RightNow.Event.fire("request_type_corporate", eventObject);
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});