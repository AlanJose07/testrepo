RightNow.namespace('Custom.Widgets.input.testsubmit');
Custom.Widgets.input.testsubmit = RightNow.Widgets.FormSubmit.extend({     /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
            RightNow.Event.subscribe("on_before_ajax_request", this._onAjaxRequest, this);

        }        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */        // _onButtonClick: function(evt)        // _fireSubmitRequest: function()        // _onFormValidated: function()        // _onFormValidationFail: function()        // _clearFlashData: function()        // _absoluteOffset: function(element)        // _displayErrorMessages: function(messageArea)        // _defaultFormSubmitResponse: function(type, args)        // _formSubmitResponse: function(type, args)        // _handleFormResponseSuccess: function(result)        // _handleFormResponseFailure: function(responseObject)        // _navigateToUrl: function(result)        // _confirmOnNavigate : function(result)        // fn: function()        // _resetFormForSubmission: function()        // _onFormUpdated: function()        // _onErrorResponse: function(response)        // _resetFormButton: function()        // _removeFormErrors: function()        // _displayErrorDialog: function(message)        // _toggleLoadingIndicators: function(turnOn)        // _toggleClickListener: function(enable)
    },
    _onAjaxRequest: function(type, theObject)
    {
        if(theObject[0].url == "/ci/ajaxRequest/sendForm")
        {
            myobj = theObject[0];
            theObject[0].url = "/ci/ajaxCustom/sendForm";
            console.log("check js");
        }
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    }
});