RightNow.namespace('Custom.Widgets.input.TextInputCustom');
Custom.Widgets.input.TextInputCustom = RightNow.Widgets.TextInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
			//console.log(this.data);
			if(this.data.js.name == "Incident.CustomFields.c.coachcustomernumber" || this.data.js.name == "Incident.CustomFields.c.last_four_ssn")
			{
				
				RightNow.Event.subscribe("evt_getShowFields", this.setPageParams, this);
			}
			
			
			
			
            this.parent();
        }

        /**
         * Overridable methods from TextInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // _displayError: function(errors, errorLocation)
        // _toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)
        // _toggleFormSubmittingFlag: function(event)
        // _blurValidate: function(event, validateVerifyField)
        // _validateVerifyField: function(verifyField, errors)
        // _checkExistingAccount: function()
        // _massageValueForModificationCheck: function(value)
        // _onAccountExistsResponse: function(response, originalEventObject)
        // onProvinceChange: function(type, args)
        // _initializeMask: function()
        // _createMaskArray: function(mask)
        // _getSimpleMaskString: function()
        // _compareInputToMask: function(submitting)
        // _showMaskMessage: function(error)
        // _setMaskMessage: function(message)
        // _showMask: function()
        // _hideMaskMessage: function()
        // _onValidateFailure: function()
    },
	
	
setPageParams: function(type, args)
	{
		
		if(args[0].data.memb_id == 50)
			{
				this.data.attrs.required = true;				
			}
			else if(args[0].data.memb_id == 49)
			{
				this.data.attrs.required = false;		
			}
			
		

	},
	
	
	
	
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});