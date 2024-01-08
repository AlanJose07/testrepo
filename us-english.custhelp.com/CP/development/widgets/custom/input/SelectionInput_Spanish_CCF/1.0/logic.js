RightNow.namespace('Custom.Widgets.input.SelectionInput_Spanish_CCF');
Custom.Widgets.input.SelectionInput_Spanish_CCF = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
 			if(fieldName == "Incident.CustomFields.c.ccf_other_continued_services")
			{
				
				this.input.on("click", this.other_service_option, this);//Listens for click event for the field 
				
			}
			if(fieldName == "Incident.CustomFields.c.ccf_tbb_club_membership")
			{
				
				this.input.on("click", this.tbb_club_membership, this);//Listens for click event for the field 
				
			}
			if(fieldName == "Incident.CustomFields.c.ccf_shakeology")
			{
				
				this.input.on("click", this.shakeology, this);//Listens for click event for the field 
				
			}
			if(fieldName == "Incident.CustomFields.c.ccf_cancel_all_enrollments")
			{
				
				this.input.on("click", this.cancel_enrollment, this);//Listens for click event for the field 
				
			}
			
			if(fieldName == "Incident.CustomFields.c.ccf_pro_team")
			{
				
				this.input.on("click", this.pro_team, this);//Listens for click event for the field 
				
			}
			
			
			
			if((fieldName == "Incident.CustomFields.c.ccf_shakeology")||(fieldName == "Incident.CustomFields.c.ccf_tbb_club_membership")||(fieldName == "Incident.CustomFields.c.ccf_other_continued_services") || (fieldName == "Incident.CustomFields.c.ccf_pro_team") )
			{
				
				RightNow.Event.subscribe("evt_none", this.none, this);
			}
				
			if(fieldName == "Incident.CustomFields.c.ccf_shakeology_boost_spanish")
			{
				
				RightNow.Event.subscribe("evt_shake_boost", this.shake_boost_show_hide, this);//Displays Shakeology Boost dropdown
				RightNow.Event.subscribe("evt_none", this.none_shake_boost, this);//Check whether None option is selected
				
			}
			if(fieldName == "Incident.CustomFields.c.ccf_performance_spanish")
			{
				
				RightNow.Event.subscribe("evt_check_performance", this.checkbox2_performance, this);//Displays Performance dropdown
				RightNow.Event.subscribe("evt_none", this.none_performance, this);//Check whether None option is selected
				
			}
			if(fieldName == "Incident.CustomFields.c.ccf_3_day_refresh_spanish")
			{
				
				RightNow.Event.subscribe("evt_check_refresh", this.check_3dayrfresh, this); //Displays 3 day refresh dropdown
				RightNow.Event.subscribe("evt_none", this.none_3_day_refresh, this); //Check whether None option is selected
				
			}
				
		
        },
		 /**
		 * Event handler executed when form is being submitted.
		 * @param {String} type Event name
		 * @param {Array} args Event arguments
		 */
		 
		onValidate: function(type, args) {
			
		var checkbox_validation = document.getElementById("check_validate").value;
        var eo = this.createEventObject(),
            errors = [];

        this.toggleErrorIndicator(false);
		if(checkbox_validation == 0 && this._fieldName == "Incident.CustomFields.c.ccf_shakeology")
		{
			
		this.toggleErrorIndicatorCheckbox(false);	
		}

		if(!this.validate(errors)) {
			this.lastErrorLocation = args[0].data.error_location;
			if(checkbox_validation == 0 && this._fieldName == "Incident.CustomFields.c.ccf_shakeology")
			{
				this.displayErrorCheckbox(errors, this.lastErrorLocation);	
			}
			this.displayError(errors, this.lastErrorLocation);
			RightNow.Event.fire("evt_formFieldValidationFailure", eo);
			return false;
		}
		
		if(checkbox_validation == 0 && this._fieldName == "Incident.CustomFields.c.ccf_shakeology")
		{
			
		 this.lastErrorLocation = args[0].data.error_location;
		 errors.length = 1;
		 this.displayErrorCheckbox(errors, this.lastErrorLocation);
		
         RightNow.Event.fire("evt_formFieldValidateFailure", eo);
         return false;
			
		}
		else
		{

        RightNow.Event.fire("evt_formFieldValidationPass", eo);
        return eo;
		}
		
    }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // swapLabel: function(container, requiredness, label, template)
        // constraintChange: function(evt, constraint)
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
        // onStatusChanged: function()
    },
	
	/*
	*Checks if "Other" option is selected.
	*If "Other" is selected then value in check_validate is incremented else decremented
	*Fires an Event
	*/
	
	other_service_option: function() {
		
		var other_service = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked;
		if(other_service == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;
			
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		}
		
		var eventObject = new RightNow.Event.EventObject(this, {data: {other_service: other_service}});
        RightNow.Event.fire("evt_otherserviceoption", eventObject);
		

    },
	
	/*
	*Checks if "Team BeachBody Club Membership" option is selected.
	*If Yes then value in check_validate is incremented else decremented
	*Fires an Event
	*/
	
	tbb_club_membership: function() {
		
		var tbb_membership = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked;
		if(tbb_membership == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;
			
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		}
		
    },
	
	/*
	*Checks if "Pro team" option is selected.
	*If Yes then value in check_validate is incremented else decremented
	*Fires an Event
	*/
	
	pro_team: function() {
		
		var proteam = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked;
		if(proteam == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;
			
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		}
		
    },
	
	/*
	*Checks if "Shakeology" option is selected.
	*If Yes then value in check_validate is incremented else decremented
	*Fires an Event
	*/
	
	shakeology: function() {
		
		var shake = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked;
		if(shake == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;
			
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		}
		
    },
	
	/*
	*Checks if "Cancel all my current enrollments" option is selected.
	*If Yes then value in check_validate is incremented else decremented
	*Fires an Event
	*/
	
	cancel_enrollment: function() {
		
		var enrollment = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked;
		if(enrollment == true)
		{
		document.getElementById("check_validate").value = 1;
		var eventObject = new RightNow.Event.EventObject(this, {data: {none: true}});
        RightNow.Event.fire("evt_none", eventObject);	
		}
		else
		{
		document.getElementById("check_validate").value = 0;
		var eventObject = new RightNow.Event.EventObject(this, {data: {none: false}});
        RightNow.Event.fire("evt_none", eventObject);	
		
		}
		
    },
	
	/*
	*Method for displaying Error if none of the Continued service is selected
	*/
	
	
	displayErrorCheckbox: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;

        if(commonErrorDiv) {
            for(var i = 0, errorString = "", message, id = "terms_of_cancellation"; i < errors.length; i++) {
                message = errors[i];
				
				var message = "Por favor, seleccione al menos un servicio que desea continuar";
             
                errorString += "<div data-field=\"" + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
            }
            commonErrorDiv.append(errorString);
        }

        if (!verifyField || errors.length > 1) {
            this.toggleErrorIndicatorCheckbox(true);
        }
    },
	
	 /**
     * Adds / removes the error indicators on the
     * field and label.
     * @param {Boolean} showOrHide T to add, F to remove
     */
	 
	 
	toggleErrorIndicatorCheckbox: function(showOrHide, fieldToHighlight, labelToHighlight) {
		
        var method = ((showOrHide) ? "addClass" : "removeClass");
		
        if (fieldToHighlight && labelToHighlight) {
			
            fieldToHighlight[method]("rn_ErrorField");
            labelToHighlight[method]("rn_ErrorLabel");
        }
        else {
		
			YUI().use('node', function(Y) {
									
										 Y.one('#memberships')[method]("rn_ErrorField");
										});
			
			YUI().use('node', function(Y) {
									
		Y.one('#memberships')[method]("rn_ErrorLabel");
									});
        }
    },
	
	/*
	*Disable the other options in Other membership and enrollments section in coach cancellation form when None is selected
	*/
	
	none: function(type, args){
		none_val=args[0].data.none;
		if(none_val==true)
		{
			document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled=true;
			document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).checked=false;
			document.getElementById("other_service").style.display = "none";
			
			
		}
		else
		{
			document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled=false;
			
		}
	},
	
	
	
	shake_boost_show_hide: function(type, args){
		var shake_boost = args[0].data.value;
		
		
		
		if(shake_boost == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;
		
		if(document.getElementById("shake_boost_select")){
			
			document.getElementById("shake_boost_select").style.display = "block";
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			document.getElementById("rn_" + this.instanceID + "_" + "Label").className ="cus-col-md-6 serviceCheck";
			//labelnew.innerHTML="Shakeology Boost "+"<span class='rn_Required'> *</span>";
			labelnew.innerHTML ="";
			
			this.data.attrs.required=true;
			}
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		
		document.getElementById("shake_boost_select").style.display = "none";	
		this.input.set('value','');
		this.data.attrs.required=false;
		}
		
		
		
		
		
	},
	/*
	* Function to display Performance dropdown when Performance checkbox is selected
	*/
	checkbox2_performance: function(type, args){
		var performance = args[0].data.value;
		
		if(performance == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;	
		if(document.getElementById("performance_select")){
			
			document.getElementById("performance_select").style.display = "block";
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			document.getElementById("rn_" + this.instanceID + "_" + "Label").className ="cus-col-md-6 serviceCheck";
			//labelnew.innerHTML="Shakeology Boost "+"<span class='rn_Required'> *</span>";
			labelnew.innerHTML ="";
			
			this.data.attrs.required=true;
			}
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		document.getElementById("performance_select").style.display = "none";	
		this.input.set('value','');
		this.data.attrs.required=false;
		}
		
		
		
		
		
	},
	/*
	* Function to display 3 Day Refresh dropdown when 3 Day Refresh checkbox is selected
	*/
	check_3dayrfresh: function(type, args){
		var day_refresh = args[0].data.value;
		
		if(day_refresh == true)
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx + 1;	
		if(document.getElementById("select_3day")){
			
			document.getElementById("select_3day").style.display = "block";
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			document.getElementById("rn_" + this.instanceID + "_" + "Label").className ="cus-col-md-6 serviceCheck";
			//labelnew.innerHTML="Shakeology Boost "+"<span class='rn_Required'> *</span>";
			labelnew.innerHTML ="";
			
			this.data.attrs.required=true;
			}
		}
		else
		{
		var chkbx = 	parseInt(document.getElementById("check_validate").value);
		document.getElementById("check_validate").value = chkbx - 1;
		document.getElementById("select_3day").style.display = "none";	
		this.input.set('value','');
		this.data.attrs.required=false;
		}
		
		
		
		
		
	},
	/*
	* Function to disable Shakeology Boost check box when "none" is selected
	*/
	none_shake_boost: function(type, args){
	none_val=args[0].data.none;
		if(none_val==true)
		{
			document.getElementById("shake_boost").disabled=true;
			document.getElementById("shake_boost").checked=false;
			document.getElementById("other_service").style.display = "none";
			this.input.set('value','');
			this.data.attrs.required=false;
			document.getElementById("shake_boost_select").style.display = "none";
			
		}
		else
		{
			document.getElementById("shake_boost").disabled=false;
			
		}	
		
		
	},
	/*
	* Function to disable Performance check box when "none" is selected
	*/
	none_performance: function(type, args){
	none_val=args[0].data.none;
		if(none_val==true)
		{
			document.getElementById("check_performance").disabled=true;
			document.getElementById("check_performance").checked=false;
			document.getElementById("other_service").style.display = "none";
			this.input.set('value','');
			this.data.attrs.required=false;
			document.getElementById("performance_select").style.display = "none";
			
			
		}
		else
		{
			document.getElementById("check_performance").disabled=false;
			
		}		
		
	},
	/*
	* Function to disable 3 Day refresh check box when "none" is selected
	*/
	none_3_day_refresh: function(type, args){
	none_val=args[0].data.none;
		if(none_val==true)
		{
			document.getElementById("check_refresh").disabled=true;
			document.getElementById("check_refresh").checked=false;
			document.getElementById("other_service").style.display = "none";
			this.input.set('value','');
			this.data.attrs.required=false;
			document.getElementById("select_3day").style.display = "none";
			
			
		}
		else
		{
			document.getElementById("check_refresh").disabled=false;
			
		}		
	},
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});