RightNow.namespace('Custom.Widgets.custom.customTextFormInput');
Custom.Widgets.custom.customTextFormInput = RightNow.Widgets.TextInput.extend({     /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function(data,instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var cont=0;
		    fieldName = data.js.name;
			document.getElementsByClassName("rn_ErrorMessage").style="display:none;";	 
			var field_id = "rn_" + this.instanceID +"_"+fieldName;
			this.fieldinfo = field_id;
			if(data.js.name=="Contact.Name.Last")
			{
				document.getElementById(field_id).placeholder=data.attrs.placeholder;	
			}
			if(data.js.name=="Contact.Name.First")
			{
				document.getElementById(field_id).placeholder=data.attrs.placeholder;	
			}
			if(data.js.name=="Contact.Emails.PRIMARY.Address")
			{
				
				document.getElementById(field_id).placeholder=data.attrs.placeholder;	
			}
			if(data.js.name=="Incident.Subject")
			{
				document.getElementById(field_id).placeholder=data.attrs.placeholder;	
			}
			
			document.getElementById(field_id).onkeyup = function(){
				if(this.value.length > 0 && cont==0)
				{
				cont++
				RightNow.Event.fire("changed_text_input", this);
				}else if(this.value.length == 0 && cont!=0)
				{
					cont=0;
				RightNow.Event.fire("removed_text_input", this);
				}
			};
        },
		_compareInputToMask: function(submitting) {
        if (!this.data.js.mask) return true;
        
        var error = [],
            value = this.input.get("value");
        if (value.length > 0) {
            for (var i = 0, tempRegExVal; i < value.length; i++) {
                if(i < this.data.js.mask.length) {
                    tempRegExVal = "";
                    switch(this.data.js.mask[i].charAt(0)) {
                        case 'F':
                            if(value.charAt(i) !== this.data.js.mask[i].charAt(1))
                                error.push([i,this.data.js.mask[i]]);
                            break;
                        case 'U':
                            switch(this.data.js.mask[i].charAt(1)) {
                                case '#':
                                    tempRegExVal = /^[0-9]+$/;
                                    break;
                                case 'A':
                                    tempRegExVal = /^[0-9A-Z]+$/;
                                    break;
                                case 'L':
                                    tempRegExVal = /^[A-Z]+$/;
                                    break;
                                case 'C':
                                    tempRegExVal = /^[^a-z]+$/;
                                    break;
                            }
                            break;
                        case 'L':
                            switch(this.data.js.mask[i].charAt(1)) {
                                case '#':
                                    tempRegExVal = /^[0-9]+$/;
                                    break;
                                case 'A':
                                    tempRegExVal = /^[0-9a-z]+$/;
                                    break;
                                case 'L':
                                    tempRegExVal = /^[a-z]+$/;
                                    break;
                                case 'C':
                                    tempRegExVal = /^[^A-Z]+$/;
                                    break;
                            }
                            break;
                        case 'M':
                            switch(this.data.js.mask[i].charAt(1)) {
                                case '#':
                                    tempRegExVal = /^[0-9]+$/;
                                    break;
                                case 'A':
                                    tempRegExVal = /^[0-9a-zA-Z]+$/;
                                    break;
                                case 'L':
                                    tempRegExVal = /^[a-zA-Z]+$/;
                                    break;
                                default:
                                    break;
                            }
                            break;
                        default:
                            break;
                    }
                    if((tempRegExVal !== "") && !(tempRegExVal.test(value.charAt(i))))
                        error.push([i,this.data.js.mask[i]]);
                }
                else
                {
                    error.push([i,"LEN"]);
                }
            }
            //input matched mask but length didn't match up
            if((!error.length) && (value.length < this.data.js.mask.length) && (!this.data.attrs.always_show_mask || submitting === true))
            {
                for(i = value.length; i < this.data.js.mask.length; i++)
                    error.push([i,"MISS"]);
            }
            if(error.length > 0)
            {
                //input didn't match mask
                this._showMaskMessage(error);
                if(submitting === true)
                    this._reportError(RightNow.Interface.getMessage("PCT_S_DIDNT_MATCH_EXPECTED_INPUT_LBL"));
                return false;
            }
            //no mask errors
            this._showMaskMessage(null);
            return true;
        }
        //haven't entered anything yet...
        if(!this.data.attrs.always_show_mask && submitting !== true)
            this._showMaskMessage(error);
        return true;
    },
		onValidate: function(type, args) 
		{	
		
		
			var eventObject = this.createEventObject(),
            errors=[];
       		this._toggleErrorIndicator(false);
        
       		if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(null, errors)) || !this._compareInputToMask(true)) 
			{	
			
			var eventObject = new RightNow.Event.EventObject(this, {data: {value: "fail"}});
	    	RightNow.Event.fire("evt_showmsg",eventObject);
			
           this._displayError(errors, args[0].data.error_location);
			
		
            RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
            return false;
			}
			else
			{
				if(this.data.attrs.name == "Contact.Name.First")
			{
				document.getElementById("firstname").innerHTML="";
				this.remove_border(this.fieldinfo);
			}
			if(this.data.attrs.name == "Contact.Name.Last")
			{
				document.getElementById("lastname").innerHTML="";
				this.remove_border(this.fieldinfo);
			}
			if(this.data.attrs.name=="Contact.Emails.PRIMARY.Address")
			{
				document.getElementById("email").innerHTML="";
				this.remove_border(this.fieldinfo);
			}
			if(this.data.attrs.name=="Incident.Subject")
			{
				document.getElementById("topic").innerHTML="";
				this.remove_border(this.fieldinfo);
			}
				var eventObject = new RightNow.Event.EventObject(this, {data: {value: "pass"}});
	   		    RightNow.Event.fire("evt_showmsg",eventObject);
			}
       
        
       RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
	   return eventObject;
		
    },
	_toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)
	{	
	
		
        var method = ((showOrHide) ? "addClass" : "removeClass");
        
		if (fieldToHighlight && labelToHighlight) 
		{
            fieldToHighlight[method]("rn_ErrorField");
            labelToHighlight[method]("rn_ErrorLabel");
        }
        else {
			
			
            this.input[method]("rn_ErrorField");
            this.label = this.label || this.Y.one(this.baseSelector + "_Label");
			this.label[method]("rn_ErrorLabel");
        }
    },
_validateVerifyField: function(verifyField, errors) {
        verifyField = verifyField || this.Y.one(this._inputSelector + '_Validate');
        errors = errors || [];
        
        var valid = true,
            verifyLabel = this.Y.one(this._inputSelector + '_LabelValidate');
            
        if(verifyField && this.data.attrs.require_validation) {
            var verifyValue = this.Y.Lang.trim(verifyField.get("value")),
                label = RightNow.Text.sprintf(this.data.attrs.label_validation, this.data.attrs.label_error || this.data.attrs.label_input);
                
            if (this.data.attrs.required && verifyValue === "") {
                errors.push({message: RightNow.Text.sprintf(this.data.attrs.label_required, label), id: verifyField.get("id")});
                valid = false;
            }
            else if (verifyValue !== this.Y.Lang.trim(this.input.get('value'))) {
                errors.push({message: RightNow.Text.sprintf(this.data.attrs.label_validation_incorrect, label, this.data.attrs.label_input), id: verifyField.get("id")});
                valid = false;
            }
        }
        if (verifyField) {
            this._toggleErrorIndicator(!valid, verifyField, verifyLabel);
        }
        return valid;
    },
		_displayError: function(errors, errorLocation) {
		
		console.log(errors);
		
		//document.getElementById("rn_ErrorLocation").innerHTML="";
		
		commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;
			
			if(this.data.attrs.name == "Contact.Name.First")
			{
				this.update_border(this.fieldinfo);
				document.getElementById("firstname").innerHTML=errors;
			}
			if(this.data.attrs.name == "Contact.Name.Last")
			{
				this.update_border(this.fieldinfo);
				document.getElementById("lastname").innerHTML=errors;
			}
			if(this.data.attrs.name=="Contact.Emails.PRIMARY.Address")
			{
				//console.log(errors[0]);
				errors[0] = errors[0].replace("%s is invalid", "Please enter a valid email.");
				this.update_border(this.fieldinfo);
				document.getElementById("email").innerHTML=errors;
			}
			if(this.data.attrs.name=="Incident.Subject")
			{
				this.update_border(this.fieldinfo);
				document.getElementById("topic").innerHTML=errors;
			}
			
			
			
			
			
			/*for(var i = 0, message, id = this.input.get("id"); i < errors.length; i++) {
                message = errors[i];
                if (typeof message === "object" && message !== null && message.id && message.message) {
                    id = verifyField = message.id;
                    message = message.message;
                }
                else {
                    message = "All fields required";
                }
            }
			commonErrorDiv.append(message);*/
       /* if(commonErrorDiv) {
			
            for(var i = 0, message, id = this.input.get("id"); i < errors.length; i++) {
                message = errors[i];
                if (typeof message === "object" && message !== null && message.id && message.message) {
                    id = verifyField = message.id;
                    message = message.message;
                }
                else {
                    message = "All fields required";
                }
            }
            commonErrorDiv.append(message);
        } */
			 return true;	
    }




        /**
         * Overridable methods from TextInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */        // swapLabel: function(container, requiredness, label, template)        // setLabel: function(newLabel)        // reload: function(content, readOnly)        // _subscribeToFormValidation: function()        // constraintChange: function(evt, constraint)        // getVerificationValue: function()        // onValidate: function(type, args)        // _displayError: function(errors, errorLocation)        // toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)        // _toggleFormSubmittingFlag: function(event)        // _blurValidate: function(event, validateVerifyField)        // _validateVerifyField: function(errors)        // _checkExistingAccount: function()        // _massageValueForModificationCheck: function(value)        // _onAccountExistsResponse: function(response, originalEventObject)        // onProvinceChange: function(type, args)        // _initializeMask: function()        // _createMaskArray: function(mask)        // _getSimpleMaskString: function()        // _compareInputToMask: function(submitting)        // _showMaskMessage: function(error)        // _setMaskMessage: function(message)        // _showMask: function()        // _hideMaskMessage: function()        // _onValidateFailure: function()
    },
    /**
     * Sample widget method.
     */
    update_border: function(fieldid) {
		document.getElementById(fieldid).style.borderColor = "#B30F3B";
    },
	remove_border: function(fieldid) {
		document.getElementById(fieldid).style.borderColor = "#D2D2D2";
    }
});