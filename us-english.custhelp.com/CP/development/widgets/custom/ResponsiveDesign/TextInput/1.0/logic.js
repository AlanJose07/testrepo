RightNow.namespace('Custom.Widgets.ResponsiveDesign.TextInput');
Custom.Widgets.ResponsiveDesign.TextInput = RightNow.Widgets.TextInput.extend({ 
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
			//this.clearOnLoad(); 
			document.getElementById("rn_" + this.instanceID + '_LabelContainer').style.display = "none";
			
  			document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).className+=" mat-input";
   			document.getElementById("rn_" + this.instanceID).className+=" mat-div";
			
			
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			this.globalfieldname=fieldName;
			this.placeholdertext = RightNow.Interface.getMessage('CUSTOM_MSG_CHAT_PLACEHOLDER_TEXT');
			
			
			var url=String(window.location);
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			this.top_parent= exploded_url[index+1].split('.'); 
			
			var url1=String(window.location);  
			var exploded_url1= url.split("/");
			var index1=exploded_url.indexOf("prechatsurvey");
			this.chatindex = index1;
			var fbindex=exploded_url.indexOf("facebooksurvey");
			this.smsindex=exploded_url.indexOf("smssurvey");
			var callmenowindex=exploded_url.indexOf("callmenow");

			if(index1!=-1)
				this._fields_required();
			if(fbindex!=-1)
				this._fields_required();
			if(callmenowindex!=-1)
				this._fields_required();	
			if(this.smsindex!=-1)
				this._fields_required();

			if(callmenowindex!=-1){
					if(this._fieldName == 'Incident.CustomFields.c.billing_zip_postal_code')
					{ 
						phone = this.input.get('value');
							if (phone != '') {
								pattern = /^\d{10}$/; 
								//pattern = /^(0)(5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/;
								if(!pattern.test(phone)) {
									customValidationFlag = 1;
									errors.push("%s is Invalid");
								}
							}
					}
				}
			
			if(this.smsindex!=-1)
			{
					if(fieldName=="Incident.CustomFields.c.bike_serial_number" && this.top_parent[0]=='3784')
					{
							document.getElementById("bike-serial").style.display = "block";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
					if(fieldName=="Incident.CustomFields.c.bike_serial_number" && this.top_parent[0]!='3784')
					{
							document.getElementById("bike-serial").style.display = "none";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
					if(fieldName=="Incident.CustomFields.c.orderno" && this.top_parent[0]=='3784')
					{
							document.getElementById("order-no").style.display = "block";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
					if(fieldName=="Incident.CustomFields.c.orderno" && this.top_parent[0]!='3784')
					{
							document.getElementById("order-no").style.display = "none";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
					if(fieldName=="Incident.CustomFields.c.tablet_serial" && this.top_parent[0]=='3784')
					{
							document.getElementById("tablet-id").style.display = "block";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
					if(fieldName=="Incident.CustomFields.c.tablet_serial" && this.top_parent[0]!='3784')
					{
							document.getElementById("tablet-id").style.display = "none";
							this._fields_not_required();
							var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
							label.innerHTML= this.data.attrs.label_input;
							
					}
			}	
			if(fieldName=="Contact.Phones.MOBILE.Number")
			{
				var value = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).value;
				if(value != "")
				{
					document.getElementById("rn_" + this.instanceID).className+=" is-completed";
				}
			}	
			
			if(fieldName=="Incident.CustomFields.c.billing_zip_postal_code")
			{
				RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
				RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				
				//RightNow.Event.subscribe("chat_fields_not_required_special_categories",this._fields_not_required, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				
				RightNow.Event.subscribe("email_fields_not_required_special_categories",this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				RightNow.Event.subscribe("membertype_changed", this.membertype_changed, this);
				RightNow.Event.subscribe("zip_bsf_based_membertype", this.membertype_changed, this);
				
			}
			if(fieldName=="Contact.Emails.PRIMARY.Address")
			{
				window.prevent_anonymous_email = this.instanceID;
				this._timeout = 0;
				this._previousTimeout = 0;
				this._previousRequest = null;
				this._emailLastValue = '';
				this._hiddenBlock = this._hiddenBlock || this.Y.one(this.baseSelector + "_HiddenBlock");
				this._loadingElement = this._loadingElement || this.Y.one(this.baseSelector + "_LoadingIcon");
				
				
				RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
				RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				this.input.on("keyup", this._onKeypressEmailCheck, this);
				this.input.on("blur", this._onKeypressEmailCheck, this);
				//this.input.on("change", this._checkEmailExists, this);   
				//this.input.on("click", this._checkEmailExists, this); 
			}
			if(fieldName=="Contact.Name.First")
			{
				//Commented by Vimal on 24/5/2018
				//RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				window.prevent_anonymous_first = this.instanceID;
				RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				
				//Commented by Vimal on 24/5/2018
				//RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				//RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
				//RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				
				RightNow.Event.on("evt_contactEmailExistsResponse", this._onEmailCheckResponse, this);
				
				//this.data.attrs.required=false;//Added as part of Production issue on 24/5/2018 By Vimal
			}
			if(fieldName=="Contact.Name.Last")
			{ 
				//Commented by Vimal on 24/5/2018
				//RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				window.prevent_anonymous_last = this.instanceID;
				RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				//Commented by Vimal on 24/5/2018
				//RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				//RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
				//RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				
				RightNow.Event.on("evt_contactEmailExistsResponse", this._onEmailCheckResponse, this);
				
				this.data.attrs.required=false;//Added as part of Production issue on 24/5/2018 By Vimal
				
			}
			if(fieldName=="Incident.Threads")
			{
				RightNow.Event.subscribe("make_remove_required_language_based_on_lifetimerank", this._diamondlinemessage, this);
				RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
				/* fired from Channel display widget email case */
				 RightNow.Event.subscribe("email_fields_desc_required", this._fields_required, this);
                RightNow.Event.subscribe("email_fields_desc_not_required", this._fields_not_required, this);
			   /* fired from Channel display widget email case */
			    RightNow.Event.subscribe("thread_based_membertype", this.membertype_changed, this);
				RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("email_fields_not_required_special_categories",this._fields_not_required, this);
				RightNow.Event.subscribe("email_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
			}
			if(fieldName=="Incident.CustomFields.c.coachcustomernumber")  
			{
				RightNow.Event.subscribe("chat_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				RightNow.Event.subscribe("email_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				//RightNow.Event.subscribe("coachid_membertype", this.membertype_changed, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("remove_required_special_categories",this._remove_field_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
			}
			if(fieldName=="Incident.CustomFields.c.last_four_ssn")
			{
				/* Below two codes are there. First one commented and the second one is added new. As per the change in requirement we need to add the ssn 
				   field in all the categories for the agent and facebook*/ 
				   
				//RightNow.Event.subscribe("chat_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				/**********************************explained above**********************************************************/
				
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				RightNow.Event.subscribe("email_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				RightNow.Event.subscribe("membertype_changed", this.membertype_changed, this);
				RightNow.Event.subscribe("zip_bsf_based_membertype", this.membertype_changed, this);
			}
			
			
			
        },
		
		onValidate: function(type, args) {
			
			
        	var eventObject = this.createEventObject(),
            errors = [];
			customValidationFlag = 0;

        this.toggleErrorIndicator(false);
		
		if(this._fieldName == 'Contact.Phones.MOBILE.Number')
		{ 
			phone = this.input.get('value');
				if (phone != '') {
					pattern = /^\d{10}$/; 
					//pattern = /^(0)(5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/;
					if(!pattern.test(phone)) {
						customValidationFlag = 1;
						errors.push("%s is Invalid");
					}
				}
		}
		var url=String(window.location);	
		var exploded_url= url.split("/");	
		var callmenowindexs=exploded_url.indexOf("callmenow");	
		//alert(callmenowindexs);	
			if(callmenowindexs!=-1 && this._fieldName == 'Incident.CustomFields.c.billing_zip_postal_code')	
			{ 	
				phone = this.input.get('value');	
					if (phone != '') {	
						pattern = /^\d{10}$/; 	
						//pattern = /^(0)(5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/;	
						if(!pattern.test(phone)) {	
							customValidationFlag = 1;	
							errors.push("%s is Invalid");	
						}	
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
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + ": " + message;
                }
                errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
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
	
	_diamondlinemessage: function(type,args)
	{ 
		if(this.chatindex!=-1)
		{
			intance = this;
			if(args[0].data=="492")
			{ //alert("492");
				var elem = document.getElementById("rn_" + this.instanceID + '_Incident.Threads');
				document.getElementById("rn_" + this.instanceID).className+=" is-active is-completed"; 
				elem.placeholder = intance.placeholdertext;
				
				$("#rn_" + this.instanceID +"_Incident\\.Threads").focus(function(){ 
				
					if($(this).attr("placeholder") == intance.placeholdertext)
					{ 
					$(this).attr("placeholder",'');
					
					}
				}).blur(function(){
			        
					$(this).parent().addClass("is-active is-completed");
					$(this).attr('placeholder',intance.placeholdertext);
			 });
			}
			else
			{ //alert("not 492");
				var elem = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
				elem.placeholder = "";
				$("#rn_" + this.instanceID +"_Incident\\.Threads").blur(function(){										   
					 $(this).attr('placeholder',"");
					  if($(this).val() === "" && !$(this).attr("placeholder"))
					  	$(this).parent().removeClass("is-active is-completed");	
			 });
			}
		}
	}
	,
	
	_fields_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_fields_not_required: function(type,args)
	{
		    this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= this.data.attrs.label_input;
	},
	_fields_not_required_membertype: function(type,args)
	{
		    this.data.attrs.required=false;
			var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input;
	},
	_remove_field_required: function(type,args)
	{
		   this.data.attrs.required=false;
		   var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
		   label.innerHTML= this.data.attrs.label_input;
	},
	_reset: function(type,args)
	{
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		errorWidget.classList.remove("rn_ErrorField");
		document.getElementById("rn_errorlocation_chat").innerHTML = "";
		document.getElementById("rn_errorlocation_chat").classList.remove("rn_MessageBox");	
	},
	_clearfieldvalue: function(type,args)
	{
		
		this.input.set('value','');
	},
	  _onKeypressEmailCheck: function () {  
 	 	// clear any previous timeouts so we only get the latest keyup event
		clearTimeout(this._previousTimeout);
		
		// set the time out
		var _this = this;
		this._timeout = setTimeout(function(){_this._checkEmailExists();}, 750 );
		
		// set previous timeout to current timeout for next time function gets executed
		this._previousTimeout = this._timeout;
		// abort ajax request if we get here since we'll be sending in another one
		if(this._previousRequest)
			this._previousRequest.abort();
	 },
	 _checkEmailExists: function() 
	 {
	    var emailValue = this.input.get('value').replace(/^\s+|\s+$/g, ''); 
		
		this.input.set('value',emailValue);//trim white space from  email field
		
		//console.log(emailValue);
		
		var atStart = emailValue.indexOf('@');
		if(emailValue != '' && emailValue != this._emailLastValue 
			// add this check to not shoot off bogus requests of the email is not valid
			&& atStart > 0 &&  emailValue.indexOf('.',atStart) > 0 ){	
			// show loading
			
			if(this._loadingElement)
					RightNow.UI.show(this._loadingElement);
			
			// send request
			this._emailRequest(emailValue);
			this._emailLastValue = emailValue;
			//alert(this._emailLastValue);
		}
		else
		{
			if(emailValue == '')
			{
				
				if(document.getElementById('email-details')) {
					document.getElementById("email-details").style.display="none"; 
					this._hiddenBlock.set('innerHTML', '');
					
				}
			}
		}
	 },
	 _emailRequest: function(email) {
			var eventObject = new RightNow.Event.EventObject(this, {data: {
			
			w_id: this.data.info.w_id,
			
			email: email,
			
			show_first_last_name: true
			
			}});
						
			RightNow.Ajax.makeRequest('/ci/AjaxCustom/checkForExistingContact', eventObject.data, {successHandler: this._successResponse, scope: this, data: eventObject, json: true});
										   
	},
	_successResponse: function(id, o) {

		var oe = { data: {
			show_first_last_name: this.data.attrs.show_first_last_name
		}};

		//var response = JSON.parse(o.responseText);
		var response = id;

		if (RightNow.Event.fire("evt_contactEmailExistsResponse", id, oe)) {
			//Anuj Feb 19, 2014 - CP3 Migration 
			//Hide the loading icon and status message
			if(this._loadingElement)
				RightNow.UI.hide(this._loadingElement);
			
			if(response !== undefined){ 
				
				if(response == false) {

					var message = '';
					
					var email_not_exist="Please fill in additional contact to submit an incident.";
					
						message = '<p style="font-size:x-small; margin:2px; margin-left:20px;"">' + email_not_exist + '</p>';

					// display message
					if(this._hiddenBlock)
						this._hiddenBlock.set('innerHTML', message);
				}
				else {
                    var email_exist="Welcome back! Please fill out the rest of this form to submit your message.";
					var message = '';
					
						message = '<p style="font-size:x-small; margin:2px; margin-left:20px;"">' + email_exist + '</p>';

					// display message
					if(this._hiddenBlock)
						this._hiddenBlock.set('innerHTML', message);
				}

				// set previous request to null
				this.previousRequest = null;
			}
		}
	},
	_onEmailCheckResponse: function(type, args) {
		/*if(document.getElementById('fn_ln')) {
			document.getElementById('fn_ln').style.display = "block";
		}*/
		//var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
		//labelnew.innerHTML=this.data.attrs.label_input;
		//this.data.attrs.required = false;
		var response = args[0];
		var eventArgs = args[1];
		if(response) {
			// if we need to show the first and last name as uneditable fields
			//alert("abc");
				
				//var fieldData;
				// get field value from response
				if(this._fieldName === "Contact.Name.First") {
					//alert("first name = "+response.first_name);
					this.input.set('value',response.first_name);
					document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 
					this.input.set('disabled','true');
					//fieldData = response.first_name;
				}
				else if(this._fieldName === "Contact.Name.Last") {
					//alert("first name = "+response.last_name);
					//fieldData = response.last_name;
					this.input.set('value',response.last_name);
					document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 
					this.input.set('disabled','true');
				}
				// set the value
				//this.data.js.value = fieldData;
				
				// show a non-editable version of widget
				this.data.attrs.hidden = false;
				this.data.attrs.editable = false;	
				
				this.data.attrs.required=false;
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML=this.data.attrs.label_input;
				
			document.getElementById("email-details").style.display="none"; 
			 
		}
		else {	// contact does not exists
			//alert("contact doesnt exist");
			// reset the input field
			this.data.js.value = '';
			//this.data.attrs.required = true;
			//var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			//labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			
			this.input.set('value','');			
			document.getElementById("rn_" + this.instanceID).classList.remove("is-completed");
			// show a editable input field
			//this.data.attrs.hidden = false;
			this.data.attrs.editable = true;
			this.input.set('disabled','');
			
			this.data.attrs.required=true;
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			
			// make it required
			//this._setRequired(true);
			document.getElementById("email-details").style.display="block"; 
		} 
		
		// re-render the widget with above settings
		//this.renderView();
	},
	
	membertype_changed: function(type, args) {
		
        
			var url=String(window.location);  
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex=exploded_url.indexOf("facebooksurvey");
			if(index!=-1)
				var channel_id = 1529;
			else
			{
				if(fbindex!=-1)
					var channel_id = 1532;
				else	
					var channel_id=document.querySelector('input[name="channel"]:checked').value;
			}	
			
		if(channel_id=="1529" || channel_id=="1532")//chat or facebook
		{
			
				if(args[0].data=="388")
				{
					if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
					{
						this._fields_required();
						
						if(document.getElementById("bsf"))
						{
						document.getElementById("bsf").style.display = "block";
						this.data.attrs.label_input = "Last 4 digits of Credit Card on file for BSF";
						var element = document.getElementById("rn_" + this.instanceID);
						element.classList.remove("long-input");
						var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
						labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
						}
						
					}
					
					if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
					{
						this._fields_not_required_membertype();
						
						if(document.getElementById("zipcode"))
						{
						document.getElementById("zipcode").style.display = "none";
						}
						
					}
				}
				else if(args[0].data=="1725")
				{
					if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
					{
						
						this._fields_required();
						
						if(document.getElementById("bsf"))
						{
						document.getElementById("bsf").style.display = "block";
						this.data.attrs.label_input = "Last 4-digits of Credit Card on file for Preferred Customer Membership";
						document.getElementById("rn_" + this.instanceID).className+=" long-input";
						
						var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
						labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
						}
						
					}
				
				if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
				{
					this._fields_not_required_membertype();
					
					if(document.getElementById("zipcode"))
					{
					document.getElementById("zipcode").style.display = "none";
					}
					
				}
			}
			else if(args[0].data=="389" || args[0].data=="398")
			{
				
				if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
				{
					this._fields_not_required_membertype();
					
					if(document.getElementById("bsf"))
					{
					document.getElementById("bsf").style.display = "none";
					}
					
				}
				
				if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
				{
					this._fields_required();
					
					if(document.getElementById("zipcode"))
					{
					document.getElementById("zipcode").style.display = "block";
					}
					
				}
			}
				else
				{
	  
						   this._fields_required();
						   
						   if(document.getElementById("bsf"))
							{
							document.getElementById("bsf").style.display = "block";
								  if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn"){
									this.data.attrs.label_input = "Last 4 digits of Credit Card on file for BSF";
									var element = document.getElementById("rn_" + this.instanceID);
									element.classList.remove("long-input");
									var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
									labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
								}
							}
							
							if(document.getElementById("zipcode"))
							{
							document.getElementById("zipcode").style.display = "block";
							}
				}
		}
		if(channel_id=="1530")//email
		{
				if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
				{
					this._fields_not_required();
					
						if(document.getElementById("zipcode"))
					{
					document.getElementById("zipcode").style.display = "none";
					}
				}
				if(this.globalfieldname=="Incident.Threads")
                {
                                this._fields_required();
                                this.data.attrs.label_input = "Description";
                                var element = document.getElementById("rn_" + this.instanceID);
                                element.classList.remove("long-input");
                                var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
                                labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
                }
				 if(args[0].data=="389")
                {
                        if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
                    {
                        this._fields_required();
                        if(document.getElementById("zipcode"))
                        {
                            document.getElementById("zipcode").style.display = "block";
                        }
                    }
					if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
					{
					
						 this._fields_not_required();
						
							if(document.getElementById("bsf"))
						{
						document.getElementById("bsf").style.display = "none";
						}
					}
                }
				else if(args[0].data=="388")
                {
                    if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
                    {
                        this._fields_not_required();
                        if(document.getElementById("zipcode"))
                        {
                            document.getElementById("zipcode").style.display = "none";
                        }
                    }
                    if(document.getElementById("bsf"))
                    {
                        
                        document.getElementById("bsf").style.display = "block";
                        if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
                        {      this._fields_required();
                                this.data.attrs.label_input = "Last 4 digits of Credit Card on file";
                                var element = document.getElementById("rn_" + this.instanceID);
                                element.classList.remove("long-input");
                                var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
                                labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
                        }
                    }
                        
                }
				else if(args[0].data=="1725")
                {
                    if(this.globalfieldname=="Incident.CustomFields.c.billing_zip_postal_code")
                    {
                        this._fields_not_required();
                        if(document.getElementById("zipcode"))
                        {
                            document.getElementById("zipcode").style.display = "none";
                        }
                    }
                    if(document.getElementById("bsf"))
                    {
                        
                        document.getElementById("bsf").style.display = "block";
                        if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
                        {      this._fields_required();
                                this.data.attrs.label_input = "Last 4 digits of Credit Card on file";
                                var element = document.getElementById("rn_" + this.instanceID);
                                element.classList.remove("long-input");
                                var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
                                labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
                        }
                    }
                }
			
		}
		if(channel_id=="1885")//Doc
        {
    
               if(document.getElementById("bsf"))
                    {
                        
                        document.getElementById("bsf").style.display = "block";
                        if(this.globalfieldname=="Incident.CustomFields.c.last_four_ssn")
                        {      this._fields_required();
                                this.data.attrs.label_input = "Last 4 digits of Credit Card on file";
                                var element = document.getElementById("rn_" + this.instanceID);
                                element.classList.remove("long-input");
                                var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
                                labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
                        }
                    }
				
		}
	}
	
	
	
});