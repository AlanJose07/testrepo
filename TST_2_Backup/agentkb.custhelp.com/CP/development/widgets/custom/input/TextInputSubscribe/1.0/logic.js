RightNow.namespace('Custom.Widgets.input.TextInputSubscribe');
Custom.Widgets.input.TextInputSubscribe = RightNow.Widgets.TextInput.extend({ 
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
			
			var fieldName = data.js.name;
				if(fieldName == "Incident.CustomFields.c.coachcustomernumber")
{
	
			RightNow.Event.subscribe("evt_coach_id", this.showCoachNumber, this);
}
if(fieldName == "Incident.Subject")
{
	
			RightNow.Event.subscribe("reason_changed", this.setStatus, this);
				RightNow.Event.subscribe("request_type_corporate", this.setSubject, this);
}

        }

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
    },
		showCoachNumber: function(type, args) {
				var value=args[0].data;
				//alert(value);
				if(value == 0)
{
	//alert("NO");
	document.getElementById("coach_id").style.display = "block";
		var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
	//var labelnew = document.getElementById("coach_id");
	//alert(labelnew);
	labelnew.innerHTML= "Customer #";
}
if(value == 1)
{
	//alert("YES");
	document.getElementById("coach_id").style.display = "block";
	var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
	//var labelnew = document.getElementById("coach_id");
	labelnew.innerHTML= "Coach ID";
}
			
			
			
		},
		
		
		setStatus: function(type, args) {
		
			
				this.input.set("value","Tier 2 Escalation -" + args[0].data);
		
			
		},
		
		setSubject: function(type, args) {
			this.input.set("value","Tier 2 Escalation");
				
		
		},
		
		
		
		

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});