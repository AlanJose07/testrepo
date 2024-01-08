RightNow.namespace('Custom.Widgets.Chat_Hidden_Fields.ChatTextInput');
Custom.Widgets.Chat_Hidden_Fields.ChatTextInput = RightNow.Widgets.TextInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			RightNow.Event.subscribe("evt_submitFormRequestForChat", this._getfieldvalues, this);
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
	 _getfieldvalues: function()                                                                                  
	 {
		 
		 if(this.data.js.name =="Incident.CustomFields.c.coachcustomernumber")
		{
			var coachid = document.getElementsByName("Incident.CustomFields.c.coachcustomernumber")[0].value;
			
			this.input.set('value',coachid);
			
		}
		
		 if(this.data.js.name =="Incident.CustomFields.c.last_four_ssn")
		{
			if(document.getElementsByName("Incident.CustomFields.c.last_four_ssn")[1])
			{
			var bsf = document.getElementsByName("Incident.CustomFields.c.last_four_ssn")[1].value;
			this.input.set('value',bsf);
			}
			
		}
		
		 if(this.data.js.name =="Incident.CustomFields.c.billing_zip_postal_code")
		{
			if(document.getElementsByName("Incident.CustomFields.c.billing_zip_postal_code")[1])
			{
			var zip = document.getElementsByName("Incident.CustomFields.c.billing_zip_postal_code")[1].value;
			this.input.set('value',zip);
			}
			
		}
		
		 if(this.data.js.name =="Contact.Emails.PRIMARY.Address")
		{
			//var email = document.getElementsByName("Contact.Emails.PRIMARY.Address")[0].value;
			var email = document.getElementById("rn_" + prevent_anonymous_email + '_'+this.data.js.name).value; //prevent anonymous chat
			this.input.set('value',email);																		//when SSO enabled
			
		}
		
		 if(this.data.js.name =="Contact.Name.First")
		{
			//var first = document.getElementsByName("Contact.Name.First")[0].value;
			var first = document.getElementById("rn_" + prevent_anonymous_first + '_'+this.data.js.name).value;
			this.input.set('value',first);
			
		}
		
		 if(this.data.js.name =="Contact.Name.Last")
		{
			//var last = document.getElementsByName("Contact.Name.Last")[0].value;
			var last = document.getElementById("rn_" + prevent_anonymous_last + '_'+this.data.js.name).value;
			this.input.set('value',last);
			
		}
		
		 if(this.data.js.name =="Incident.Threads")
		{
			var question = document.getElementsByName("Incident.Threads")[1].value;
			this.input.set('value',question);
		}		
				
		 if(this.data.js.name =="Incident.CustomFields.c.guid")		
		{		
			if(document.getElementsByName("Incident.CustomFields.c.guid")[1])	
			{
		    var guid = document.getElementsByName("Incident.CustomFields.c.guid")[1].value;		
		    this.input.set('value',guid);
			}
			
		}
		
	 }
});