RightNow.namespace('Custom.Widgets.input.TextInput_Spanish_CCF_Other');
Custom.Widgets.input.TextInput_Spanish_CCF_Other = RightNow.Widgets.TextInput.extend({ 
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
			var fieldName = data.js.name;
			if(fieldName == "Incident.CustomFields.c.ccf_other_reason")
			{
			
				//RightNow.Event.subscribe("evt_getreasonforcancellation", this.ShowOtherReasonForCancellation, this);
			}
			else if(fieldName == "Incident.CustomFields.c.ccf_membership_and_enrollment")
			{
			
				RightNow.Event.subscribe("evt_otherserviceoption", this.ShowOtherContinuedService, this);
				RightNow.Event.subscribe("evt_none", this.hideOther, this);
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
	ShowOtherContinuedService: function(type, args)
	{
		
		var other_service = (args[0].data.other_service);
	
		if(other_service == true)
		{
			
			document.getElementById("other_service").style.display = "block";
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			document.getElementById("rn_" + this.instanceID + "_" + "Label").className ="rn_other";
			labelnew.innerHTML="Por favor Especificar y enumerar todo lo que corresponda "+"<span class='rn_Required'> *</span>  <font color='#696969' size='-1' class='example'>e.g. Pro Equipo, 3-día Refrescar</font> ";
			this.data.attrs.required=true;
		}
		else
		{
		document.getElementById("other_service").style.display = "none";	
		this.input.set('value','');
		this.data.attrs.required=false;
		}
		
	},
	/*ShowOtherReasonForCancellation: function(type, args)
	{
		var other_reason = (args[0].data.other_reason);
	
		if(other_reason == "Otros")
		{
			
			document.getElementById("other_reason").style.display = "block";
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML="Por favor especifique "+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else
		{
		document.getElementById("other_reason").style.display = "none";	
		this.input.set('value','');
		this.data.attrs.required=false;
		}
		
	},*/
	
	hideOther:function(type, args){
		none_val=args[0].data.none;
		if(none_val==true)
		{
			document.getElementById("other_service").style.display = "none";	
			this.input.set('value','');
			this.data.attrs.required=false;
		}
	},	

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});