RightNow.namespace('Custom.Widgets.input.FormSubmit_custom');
Custom.Widgets.input.FormSubmit_custom = RightNow.Widgets.FormSubmit.extend({ 
    /**
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
        // _formSubmitResponse: function(type, args)
        // _displayErrorDialog: function(message)
        // _onFormTokenUpdate: function(type, args)
        // _enableFormExpirationWatch: function()
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
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