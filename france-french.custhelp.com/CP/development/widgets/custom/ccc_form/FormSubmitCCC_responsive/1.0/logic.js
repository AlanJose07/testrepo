RightNow.namespace('Custom.Widgets.ccc_form.FormSubmitCCC_responsive');
Custom.Widgets.ccc_form.FormSubmitCCC_responsive = RightNow.Widgets.FormSubmit.extend({ 
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
			
        },
			/**
     * Handles when user clicks the submit button.
     * @param {Object=} evt Click event or null if called programmatically
     */
    _onButtonClick: function(evt) {
		//alert(1);
        if (evt && evt.halt) {
            evt.halt();
        }
        if (this._requestInProgress) return false;

        this._toggleClickListener(false);
        //Reset form errors
		
		
        this._errorMessageDiv.addClass("rn_Hidden").set("innerHTML", "");

		
		
        //since the form is submitted by script, deliberately tell IE to do auto completion of the form data
       
	   if (this.Y.UA.ie && window.external && "AutoCompleteSaveForm" in window.external) {
            window.external.AutoCompleteSaveForm(document.getElementById(this._parentForm));
        }
		
	
        this._fireSubmitRequest();
		
		if(document.getElementById("rn_ErrorLocation_ccc").innerHTML=='<h2 role="alert">Error</h2>')
		//if(document.getElementById("rn_ErrorLocation_ccc").innerHTML=="")
		{
			//alert("nui");
			this._errorMessageDiv.addClass("rn_Hidden");	
		}
			
		//alert(3);
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
        // _onFormUpdated: function()
        // _onErrorResponse: function()
        // _displayErrorDialog: function(message)
        // _onFormTokenUpdate: function(type, args)
        // _enableFormExpirationWatch: function()
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
		/*_onFormValidated: function() {
    
   this._errorMessageDiv.addClass("rn_Hidden");
  RightNow.Event.fire("evt_submitFormRequestForChat");
        this._toggleLoadingIndicators();
        this.fire("send", this.getValidatedFields());
    
    
    }*/
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
		
    /**
     * Renders the `view.ejs` JavaScript template.
     */
    renderView: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },
	
	_beforeAjaxRequest: function (type, args) {
		
        var requestOptions = args[0];
		
		if (/ci\/ajaxRequest\/sendForm/.test(requestOptions.url)) { 
				requestOptions.url = "/cc/AjaxOrder/sendorderform_customer_coach";
        }
		
    }
	
});