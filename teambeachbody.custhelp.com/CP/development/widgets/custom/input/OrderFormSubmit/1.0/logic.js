RightNow.namespace('Custom.Widgets.input.OrderFormSubmit');
Custom.Widgets.input.OrderFormSubmit = RightNow.Widgets.FormSubmit.extend({ 
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
			
			RightNow.Event.subscribe("on_before_ajax_request", this._beforeAjaxRequest, this);
			
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
	
	_beforeAjaxRequest: function (type, args) {
        var requestOptions = args[0];
		if (/ci\/ajaxRequest\/sendForm/.test(requestOptions.url)) { 
            requestOptions.url = "/ci/AjaxCustom/sendOrderForm";
        }
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});