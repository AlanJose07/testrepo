RightNow.namespace('Custom.Widgets.input.customTextInpuSSN');
Custom.Widgets.input.customTextInpuSSN = RightNow.Widgets.TextInput.extend({ 
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
            this.parent();
			if(this.data.js.name == "Incident.CustomFields.c.last_four_ssn")
			{
				//console.log(this.data)
				RightNow.Event.subscribe("evt_getCountryFields", this.setLabel, this);
			}
			
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

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	setLabel: function(type, args)
	{
		//alert("Njan Vannu");
		
		//console.log(args);
		if (args[0].data.country_id == 1)
		{
			//alert("USA ssn "); 
		this.data.attrs.label_input = "Last 4 digits of social security number";
		document.getElementById("rn_customTextInpuSSN_14_Label").innerHTML = "Last 4 digits of social security number *";
		//alert(document.getElementById("rn_customTextInpuSSN_14_Label").innerHTML);
		
		}
		else if (args[0].data.country_id==2)
		{
			//alert("Caneda ssn ");
		this.data.attrs.label_input = "Last 4 digits of social insurance number";
		document.getElementById("rn_customTextInpuSSN_14_Label").innerHTML = "Last 4 digits of social insurance number *";
	
		}
		//console.log(this.data.attrs.label_input); 
		//return;
		

	},
});