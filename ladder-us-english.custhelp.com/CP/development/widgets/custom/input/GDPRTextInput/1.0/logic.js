RightNow.namespace('Custom.Widgets.input.GDPRTextInput');
Custom.Widgets.input.GDPRTextInput = RightNow.Widgets.TextInput.extend({ 
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
			this.instanceID = instanceID;
			this.data = data;
			this.fieldName = data.js.name;
			RightNow.Event.subscribe("evt_country_changed", this.changelabel, this);
			
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
						message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
					}
					errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
						"\").focus(); return false;'>" + message + "</a></b></div> ";
					//console.log("error string");
					//console.log(errorString);
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

    },
	changelabel: function(type, args) {
		//console.log(args[0].data.countryid);
		var req_eng="is required";
		var req_fra = "sont requis";
		if(args[0].data.countryid == 23)
		{
			if(this.fieldName == "Contact.Name.First")
				this._makeRequired("Prénom",true,req_fra);
			if(this.fieldName == "Contact.Name.Last")
				this._makeRequired("Nom",true,req_fra);	
			if(this.fieldName == "Contact.Phones.MOBILE.Number")
				this._makeRequired("Numéro de téléphone",true,req_fra);
			if(this.fieldName == "Contact.Emails.PRIMARY.Address")
				this._makeRequired("Adresse e-mail",true,req_fra);	
		}
		else
		{
			if(this.fieldName == "Contact.Name.First")
				this._makeRequired("First Name",true,req_eng);
			if(this.fieldName == "Contact.Name.Last")
				this._makeRequired("Last Name",true,req_eng);
			if(this.fieldName == "Contact.Phones.MOBILE.Number")
				this._makeRequired("Phone Number",true,req_eng);
			if(this.fieldName == "Contact.Emails.PRIMARY.Address")
				this._makeRequired("Email Address",true,req_eng);	
		}
	},
	
	_makeRequired: function(label,required,labelrequired)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label+"<span class='rn_Required'> *</span>";
			this.data.attrs.label_input=label;
			this.data.attrs.required=required;
			this.data.attrs.label_required=labelrequired;
	}
});