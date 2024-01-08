RightNow.namespace('Custom.Widgets.ccc_form.customer_coach_checkbox');
Custom.Widgets.ccc_form.customer_coach_checkbox = RightNow.Widgets.TextInput.extend({ 
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
			this.data = data;
   			this.instanceID = instanceID;
			var fieldName = data.js.name;
        },
		
		onValidate: function(type, args) {
			
			
        	var eventObject = this.createEventObject(),
            errors = [];
			customValidationFlag = 0;

        this.toggleErrorIndicator(false);
			if(membertypeid == 771){
				var checkBox1 = document.getElementById("RESULT_CheckBox-21_0"); //english
				if(checkBox1.checked == false){
					customValidationFlag = 1;	
					errors.push("Permission is required");
				}
			}
        if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true) || customValidationFlag) {
            this.lastErrorLocation = args[0].data.error_location;
            this._displayError(errors, this.lastErrorLocation);
            RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
            return false;
        }
		

        RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
        this._seenValues.push(this._massageValueForModificationCheck(eventObject.data.value));
        return eventObject;
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
                else if (this.data.attrs.name === 'SocialQuestion.Body' || this.data.attrs.name === 'SocialQuestionComment.Body') {
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : message;
                }
                else {
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : message;
                }
				if(message.includes('Permission') || message.includes('permiso') || message.includes('autorisation') || message.includes('autorisation'))
				{
				errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='_validate()'>" + message + "</a></b></div> ";
				//$('html, body').animate({ scrollTop: $('#permissions').offset().top }, 'slow');
				}
				else
				{
				 errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +"\").focus(); return false;'>" + message + "</a></b></div> ";
				}
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
        // setLabel: function(newLabel)
        // reload: function(content, readOnly)
        // _subscribeToFormValidation: function()
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



function _validate(){
	$('html, body').animate({ scrollTop: $('#permissions').offset().top }, 'slow');	
	}