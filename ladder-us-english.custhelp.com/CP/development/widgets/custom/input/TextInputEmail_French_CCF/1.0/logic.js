RightNow.namespace('Custom.Widgets.input.TextInputEmail_French_CCF');
Custom.Widgets.input.TextInputEmail_French_CCF = RightNow.Widgets.TextInput.extend({ 
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
        },
		
		
		
		_displayError: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;

        if(commonErrorDiv) {
            for(var i = 0, errorString = "", message, id = this.input.get("id"); i < errors.length; i++) {
                message = errors[i];
                if (typeof message === "object" && message !== null && message.id && message.message) {
                    id = verifyField = message.id;
                    message = message.message;
                }
                else {
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
                }
				
				var pos= -1;
				pos= message.indexOf("is invalid");//Error message to be displayed when Input is invalid (For Email address)
				if(pos>-1)
				{
					message= this.data.attrs.label_input +" "+ this.data.attrs.label_invalid;	
				}
				pos=-1;
				pos= message.indexOf("is an invalid phone number");//Error message to be displayed when Input is invalid (For phone number)
				if(pos>-1)
				{
					message= this.data.attrs.label_input +" "+ this.data.attrs.label_invalid;	
				}
				
				
                errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
            }
            commonErrorDiv.append(errorString);
        }

        if (!verifyField || errors.length > 1) {
            this.toggleErrorIndicator(true);
        }
    }

        /**
         * Overridable methods from TextInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // swapLabel: function(container, requiredness, label, template)
        // constraintChange: function(evt, constraint)
        // getVerificationValue: function()
        // onValidate: function(type, args)
        // _displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)
        // _toggleFormSubmittingFlag: function(event)
        // _blurValidate: function(event, validateVerifyField)
        // _validateVerifyField: function(errors)
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

    }
});