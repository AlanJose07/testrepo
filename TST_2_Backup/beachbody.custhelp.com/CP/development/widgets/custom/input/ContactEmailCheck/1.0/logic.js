RightNow.namespace('Custom.Widgets.input.ContactEmailCheck');
Custom.Widgets.input.ContactEmailCheck = RightNow.Widgets.TextInput.extend({ 
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
			
			/* Anuj Feb 18, 2014 - CP3 Migration
			 * Additional fields */
			this._previousRequest = null;
			// setTimeOut global objects
			this._timeout = 0;
			this._previousTimeout = 0;
			// the time in ms for keypress timeout
			this._keyTimeOut = this.data.attrs.onkeyup_timeout;
			
			this._loadingElement = this._loadingElement || this.Y.one(this.baseSelector + "_LoadingIcon");
			this._hiddenBlock = this._hiddenBlock || this.Y.one(this.baseSelector + "_HiddenBlock");
			
			// should be required no matter what, if this widget is being used
			this.data.attrs.required = true;
			
			// on change event trigger, or on keypress
			if( this.data.attrs.event_trigger == 'onchange' ) { 		
				this.input.on("change", this._blurValidate, this);
			}
			else {
				this.input.on("keyup", this._onKeypressEmailCheck, this);
			}

			// need to run this on available since email could be pre-populated when logged in accidentally
			this.Y.on("available", this._blurValidate, this._inputSelector, this);
			
			/* // Don't know if this event is being fired, commenting out the code
			if(data.js.mode == RNT.VIS_ENDUSER_EDIT_RW){
				evt_ff_validate_update.subscribe(onValidate);
			}*/
        },

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
		
		/*******************************************
		 * Overridden methods - Anuj 19 Feb, 2014
		 *******************************************/
		/**
		 * Event handler for when email field is changed
		 * Check to see if the username/email already exists, fetch data if yes
		 */
		_checkExistingAccount: function() {
			var massagedNewValue = this._massageValueForModificationCheck(this._value);
			if (this._value === "" || massagedNewValue === this._seenValue || (this.data.js.previousValue && this._value === this.data.js.previousValue))
				return;
	
			this._seenValue = massagedNewValue;
	
			var eventObject = new RightNow.Event.EventObject(this, {data: {
				contactToken: this.data.js.contactToken,
				w_id: this.data.info.w_id,
				pwReset: 0,
				show_first_last_name: this.data.attrs.show_first_last_name,
			}});
	
			if (this.isCommonEmailType())
				eventObject.data.email = this._value;
			else if (this._fieldName === "Contact.Login")
				eventObject.data.login = this._value;

			if (RightNow.Event.fire("evt_accountExistsRequest", eventObject)) {				
				this._previousRequest = RightNow.Ajax.makeRequest(this.data.attrs.existing_contact_check_ajax, eventObject.data, {
				   successHandler: this._onAccountExistsResponse,
				   failureHandler: this._onExistsFailure,
				   scope: this,
				   data: eventObject,
				   json: true
				});

				// Anuj Feb 19, 2014 - CP3 Migration
				//Show the loading icon and status message
				if(this._loadingElement)
					RightNow.UI.show(this._loadingElement);
			}
		},
		
		/**
		 * Fire response event (subscribed by input/TextIO widget to display First and Last Name fields)
		 * and display proper messages based on the response
		 * @param Object|Boolean response Server response to request
		 * @param Object originalEventObject Event arguments
		 */
		_onAccountExistsResponse: function(response, originalEventObject) {
			if (RightNow.Event.fire("evt_contactEmailExistsResponse", response, originalEventObject)) {
				
				//Anuj Feb 19, 2014 - CP3 Migration 
				//Hide the loading icon and status message
				if(this._loadingElement)
					RightNow.UI.hide(this._loadingElement);
				
				if(response !== undefined){ 
					
					if(response == false) {

						var message = '';
						if(this.data.attrs.label_email_notexists.length > 0)
							message = '<p style="font-size:x-small; margin:2px; margin-left:20px;"">' + this.data.attrs.label_email_notexists + '</p>';

						// display message
						if(this._hiddenBlock)
							this._hiddenBlock.set('innerHTML', message);
					}
					else {

						var message = '';
						if(this.data.attrs.label_email_exists.length > 0)
							message = '<p style="font-size:x-small; margin:2px; margin-left:20px;"">' + this.data.attrs.label_email_exists + '</p>';

						// display message
						if(this._hiddenBlock)
							this._hiddenBlock.set('innerHTML', message);
					}

					// set previous request to null
					this.previousRequest = null;
				}
			}
		}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	/*******************************************
	 * Custom methods - Anuj 20 Feb, 2014
	 *******************************************/
	/**
	 * Event handler for when key is released
	 * Check to see if the username/email already exists, fetch data if yes
	 */
	_onKeypressEmailCheck: function() {

		// clear any previous timeouts so we only get the latest keyup event
		clearTimeout(this._previousTimeout);
		
		// set the time out
		var _this = this;
		var timeout = setTimeout(function(){_this._blurValidate();}, this._keyTimeOut );
		// set previous timeout to current timeout for next time function gets executed
		this._previousTimeout = this._timeout;
		// abort ajax request if we get here since we'll be sending in another one
		if(this._previousRequest)
			this._previousRequest.abort();
	},
	
	/**
	 * Event handler for when request is aborted/failed
	 * standard failure handler shows an error message for error and manual abort.. overriding it so that no error dislog is displayed on abort
	 */
	_onExistsFailure: function() {
		
		//Hide the loading icon and status message
		if(this._loadingElement)
			RightNow.UI.hide(this._loadingElement);
	}
});