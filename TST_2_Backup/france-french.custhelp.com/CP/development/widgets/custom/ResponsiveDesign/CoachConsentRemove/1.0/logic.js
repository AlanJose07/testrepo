RightNow.namespace('Custom.Widgets.ResponsiveDesign.CoachConsentRemove');
Custom.Widgets.ResponsiveDesign.CoachConsentRemove = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			var element = document.getElementById("rn_" + this.instanceID + "_Button")
			console.log(element);
			element.classList.add("btn");
			element.classList.add("btn-primary");
        }

        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onButtonClick: function(evt)
        // _fireSubmitRequest: function()
        // _onFormValidated: function()
        // _onFormValidationFail: function()
        // _clearFlashData: function()
        // _absoluteOffset: function(element)
        // _displayErrorMessages: function(messageArea)
        // _defaultFormSubmitResponse: function(type, args)
        // _formSubmitResponse: function(type, args)
        // _handleFormResponseSuccess: function(result)
        // _handleFormResponseFailure: function(responseObject)
        // _navigateToUrl: function(result)
        // _confirmOnNavigate : function(result)
        // fn: function()
        // _resetFormForSubmission: function()
        // _onFormUpdated: function()
        // _onErrorResponse: function(response)
        // _resetFormButton: function()
        // _removeFormErrors: function()
        // _displayErrorDialog: function(message)
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});