RightNow.namespace('Custom.Widgets.input.SelectionInputShippingNewAddress');
Custom.Widgets.input.SelectionInputShippingNewAddress = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			var FieldName = this.data.js.name;
			
			this._inputFieldYes = document.getElementById("rn_"+this.instanceID+"_"+FieldName+"_1");
			this._inputFieldNO = document.getElementById("rn_"+this.instanceID+"_"+FieldName+"_0");
			
			RightNow.Event.subscribe("evt_shippingVisibilityChange", this.shippingVisibilityChange, this);
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
	
	shippingVisibilityChange: function(type ,arg)
	{
		
		if(arg==1)
		{
			this._inputFieldYes.checked= true;
		}
		else
		{
			this._inputFieldNO.checked= true ;
		}
		
	}
	
});