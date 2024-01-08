RightNow.namespace('Custom.Widgets.input.SelectionInputCountry_CCF');
Custom.Widgets.input.SelectionInputCountry_CCF = RightNow.Widgets.SelectionInput.extend({ 
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
			this.instanceID=instanceID;
	        this.fieldName = this.data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.fieldName);
			//RightNow.Event.subscribe("country_error", this.country_error, this);
			
        }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // swapLabel: function(container, requiredness, label, template)
        // constraintChange: function(evt, constraint)
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
        // onStatusChanged: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {	
    }
	
	
});