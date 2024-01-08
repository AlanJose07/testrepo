RightNow.namespace('Custom.Widgets.ResponsiveDesign.sponsor_placement_validate');
Custom.Widgets.ResponsiveDesign.sponsor_placement_validate = RightNow.Widgets.TextInput.extend({     /**
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
			
		if(fieldName=='Incident.CustomFields.c.placement_sponsor_full_name' || fieldName=='Incident.CustomFields.c.ccc_transfer_coach_email' || fieldName=='Incident.CustomFields.c.placement_sponsor_coach_id'){
			RightNow.Event.subscribe("requestdetails",this._fields_required, this);
			RightNow.Event.subscribe("requestdetails_notrequired",this._fields_not_required, this);
		}
		if(fieldName=='Incident.CustomFields.c.placement_sponsor_full_name' || fieldName=='Incident.CustomFields.c.ccc_transfer_coach_email' || fieldName=='Incident.CustomFields.c.placement_sponsor_coach_id'){
			RightNow.Event.subscribe("requestdetails_placement",this._fields_required, this);
			RightNow.Event.subscribe("requestdetails_placement_notrequired",this._fields_not_required, this);
		}
		if(fieldName=='Incident.CustomFields.c.ccc_transfer_coach_id'){
				RightNow.Event.subscribe("non_advanced_placement",this._fields_not_required, this);
				RightNow.Event.subscribe("clearfieldvalue",this._clearfieldvalue, this);
				RightNow.Event.subscribe("multiple_cbcs_no",this._fields_not_required, this);
				RightNow.Event.subscribe("multiple_cbcs_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("change_sponsor_cbc_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("change_sponsor_cbc_no",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_ccc_transfer_coach_id",this._clearfieldvalue, this);
				RightNow.Event.subscribe("new_coach_placed_specifically_yes",this._coach_placement_id_required, this);
				RightNow.Event.subscribe("new_coach_placed_specifically_no",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_ccc_transfer_coach_id",this._clearfieldvalue, this);
				RightNow.Event.subscribe("not_required_fields",this._fields_not_required, this);
			}
		if(fieldName=='Incident.CustomFields.c.ccc_transfer_coachorder'){
				RightNow.Event.subscribe("change_sponsor_cbc_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_ccc_transfer_coachorder",this._clearfieldvalue, this);
				RightNow.Event.subscribe("ps_coach_preferred_customer_yes",this._ccc_transfer_coachorder_required, this);
				RightNow.Event.subscribe("ps_coach_preferred_customer_no",this._fields_not_required, this);
				RightNow.Event.subscribe("ps_coach_preferred_customer_clear",this._clearfieldvalue, this);
				this.input.on("keyup", this.ccc_transfer_coachorder, this);
				this.input.on("blur", this.ccc_transfer_coachorder, this);
		}
        },
		
		onValidate: function(type, args) {
			
			
        	var eventObject = this.createEventObject(),
            errors = [];
			customValidationFlag = 0;

        this.toggleErrorIndicator(false);
		
		if(this._fieldName=="Contact.CustomFields.c.consent_phone")
		{
			phone = this.input.get('value');
			if (phone != '') 
			{
				pattern = /^\d{10}$/; 
				if(!pattern.test(phone)) 
				{
					customValidationFlag = 1;
					errors.push("%s is Invalid");
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
		}
		
		else if(this._fieldName=="Incident.Subject")
		{
			//this.signaturecheck = document.getElementById("signature").value;
			var url_string = window.location.href;
			var url = new URL(url_string);
			var c = url.searchParams.get("change");
			//console.log(c);
			
			if(c == "sponsor"){
				var checkBox1 = document.getElementById("RESULT_CheckBox-21_0");
				var checkBox3 = document.getElementById("RESULT_CheckBox-21_2");
				if(checkBox1.checked == false || checkBox3.checked ==false)
				{
					customValidationFlag = 1;
					errors.push("Sélectionnez 2 options minimum");	
				}
			}else{
				var checkBox1 = document.getElementById("RESULT_CheckBox-21_0");
				var checkBox2 = document.getElementById("RESULT_CheckBox-21_1");
				var checkBox3 = document.getElementById("RESULT_CheckBox-21_2");
				if(checkBox1.checked == false || checkBox2.checked ==false || checkBox3.checked ==false)
				{
					customValidationFlag = 1;
					errors.push("Sélectionnez 3 options minimum");	
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
				
		}
		else{
			this.toggleErrorIndicator(false);
			
			if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true)) {
				this.lastErrorLocation = args[0].data.error_location;
				this._displayError(errors, this.lastErrorLocation);
				RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
				return false;
			}
			
			RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
			this._seenValues.push(this._massageValueForModificationCheck(eventObject.data.value));
			return eventObject;
		}
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
				if(message.includes('Signature'))
				{
				id = 'signature';
                errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
				}
				else if(message.includes('checkboxes'))
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
    },
	toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight) {
        var method = ((showOrHide) ? "addClass" : "removeClass");
        if (fieldToHighlight && labelToHighlight) {
            fieldToHighlight[method]("rn_ErrorField");
            labelToHighlight[method]("rn_ErrorLabel");
        }
        else {
            this.input[method]("rn_ErrorField");
            this.Y.one(this.baseSelector + "_LabelContainer")[method]("rn_ErrorLabel");
        }
    },

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
	_fields_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_coach_placement_id_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
			this.data.attrs.label_input = "Identifiant de Placement du Partner";
			//alert(this.data.attrs.label_input);//
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	   _ccc_transfer_coachorder_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
			//this.data.attrs.label_input = "Coach Placement ID";
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_different_label_fields_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			this.data.attrs.label_input = "Veuillez indiquer l’identifiant du centre d’activité que vous souhaitez utiliser pour parrainer votre partner/client privilégié";
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	
	_fields_not_required: function(type,args)
	{
		    this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= this.data.attrs.label_input;
	},
	_clearfieldvalue: function(type,args)
	{ //alert("in");
		if(this.data.js.name=='Incident.CustomFields.c.ccc_transfer_coach_id' || this.data.js.name=='Incident.CustomFields.c.ccc_transfer_coachorder'){
			this.input.set('value','');
		}
	},
	ccc_transfer_coachorder: function(type,args)
	{
		var value = document.getElementById("rn_" + this.instanceID + "_"+this.data.js.name).value;
		value = value.trim();
		if(value)
			ccc_transfer_coachorder_value = new RightNow.Event.EventObject(this, {data:value});
		else
			ccc_transfer_coachorder_value = "";
		if(ccc_transfer_coachorder_value){
			console.log("there is value");
			RightNow.Event.fire("value_ccc_transfer_coachorder",ccc_transfer_coachorder_value);
		}else{
			console.log("No Value");	
			RightNow.Event.fire("no_value_ccc_transfer_coachorder",ccc_transfer_coachorder_value);
			RightNow.Event.fire("not_required_fields","");
			
		}
		
	}
	/*ccc_transfer_coach_id: function(type,args)
	{
		    if(args[0].data== 1){
				document.getElementById("ccc_transfer_coach_id").style.display = "block";
					this.data.attrs.required=true;
					this.data.attrs.label_input="Please provide the CBC ID that you’d like your Coach sponsored by";
					var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
					label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			}else{
				document.getElementById("ccc_transfer_coach_id").style.display = "none";
				this.data.attrs.label_input="Coach Placement ID";
					this.data.attrs.required=false;
			}
	}*/
});

function _validate(){
	$('html, body').animate({ scrollTop: $('#permissions').offset().top }, 'slow');	
	}