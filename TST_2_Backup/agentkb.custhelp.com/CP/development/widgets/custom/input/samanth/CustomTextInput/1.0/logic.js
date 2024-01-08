RightNow.namespace('Custom.Widgets.input.samanth.CustomTextInput');
Custom.Widgets.input.samanth.CustomTextInput = RightNow.Widgets.TextInput.extend({ 
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
            this.input = this.Y.one(this.baseSelector);
            if (this.data.attrs.name == "Incident.CustomFields.c.associated_articles") {
				$(this.baseSelector).css("display","none");
            	RightNow.Event.on("selectedType",this.displayField,this);
            }
        },
        displayField: function(type,args) {
        	if (args[0].data.selectedText == 1318 || args[0].data.selectedText == 1319) {
           		$(this.baseSelector).css("display","block");
           	} else {
           		$(this.baseSelector).css("display","none");
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

    }
});