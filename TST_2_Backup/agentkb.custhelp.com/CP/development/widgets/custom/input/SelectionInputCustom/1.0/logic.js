RightNow.namespace('Custom.Widgets.input.SelectionInputCustom');
Custom.Widgets.input.SelectionInputCustom = RightNow.Widgets.SelectionInput.extend({ 
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
			
			this.data=data;
			/*this.input=document.getElementById("rn_" + this.instanceID + "_" + data.js.name);*/
			RightNow.Event.subscribe("evt_PCchosen", this._getResponse, this);
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
    _getResponse: function(data, obj) {
		
		if(obj[0].data.prod !="Reason Code<br>Illness")
		{
			
		this.input.set('checked', false);
		}

    }
});