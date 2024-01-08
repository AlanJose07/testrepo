RightNow.namespace('Custom.Widgets.input.TextInput_custom');
Custom.Widgets.input.TextInput_custom = RightNow.Widgets.TextInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.attrs.name);
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = this.data.js.name;
			if(FieldName === "Incident.CustomFields.c.pc_city" || FieldName === "Incident.CustomFields.c.pc_postal_code")
			{
				 RightNow.Event.subscribe("evt_intlChecked", this._onIntlChecked, this);
				
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
	
	
	_onIntlChecked: function(type, args){
        
        var Label = document.getElementById("rn_" + this.instanceID + "_Label");
        
        if (args[0].data.checked){
            this.data.attrs.required = false;
            Label.innerHTML = Label.innerHTML.replace('<span class="rn_Required"> *</span>','');
        }else{
            this.data.attrs.required = true;
            Label.innerHTML = Label.innerHTML.concat('<span class="rn_Required"> *</span>');
        }
    },
	
	

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});