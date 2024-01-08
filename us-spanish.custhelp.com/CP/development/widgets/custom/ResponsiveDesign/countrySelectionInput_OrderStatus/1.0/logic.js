RightNow.namespace('Custom.Widgets.ResponsiveDesign.countrySelectionInput_OrderStatus');
Custom.Widgets.ResponsiveDesign.countrySelectionInput_OrderStatus = RightNow.Widgets.SelectionInput.extend({ 
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
			
			
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
	
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			
			if(FieldName === "Contact.Address.Country")
			{
				
				 this.input.on("change", this.countrySelectChanged, this);
			
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

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	
	countrySelectChanged: function()
	{
		var value = this.input.get("value");
		//var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
	}
});
