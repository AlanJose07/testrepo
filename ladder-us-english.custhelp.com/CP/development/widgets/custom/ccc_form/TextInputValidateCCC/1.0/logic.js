RightNow.namespace('Custom.Widgets.ccc_form.TextInputValidateCCC');
Custom.Widgets.ccc_form.TextInputValidateCCC = RightNow.Widgets.TextInput.extend({ 
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
			
			
			
			 document.getElementById("rn_" + this.instanceID + "_" +    this.data.js.name).readOnly = true;
   			 document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).style.backgroundColor = "#BDBDBD" ;
           
            this.parent();
			
			if(this.data.js.name  == "Contact.Emails.PRIMARY.Address")
					{
						RightNow.Event.subscribe("evt_email_attribute", this.emailCheck, this);
						this.input.on("blur", this.emailCheckhere, this);
					}
			
			if(this.data.js.name  == "Incident.CustomFields.c.ccc_transfer_coach_email")
			
					{	RightNow.Event.subscribe("evt_memberType_Changed", this._confirm_email, this);
						RightNow.Event.subscribe("evt_memberType_Changed", this._resetAttrs, this);
						RightNow.Event.subscribe("evt_languagechanged", this._resetAttrs, this);
						RightNow.Event.subscribe("evt_coach_email_attribute_ccc", this.coachemailCheck, this);
						this.input.on("blur", this.coachemailCheckhere, this);
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
		
		
		
		   onValidate: function(type, args) {
			   
			   //alert("onvalidate");
			   if((this.data.js.name  == "Incident.CustomFields.c.ccc_transfer_coach_email")&&(document.getElementById('cust_coach_info').style.display=="block"))
				{
					//alert("in if");
					var flagval=parseInt(document.getElementById("email_validate").value);
					//alert("flag = "+flagval);
					
					window.flagval=flagval;
					var eventObject = this.createEventObject(),
					errors = [];
					this.toggleErrorIndicator(false);
					var valid = true;
					
					if (this.input.get('value')== "") 
					{
						//alert("empty");
						valid = 0;
					}
					else 
					{
						
						var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
						if (this.input.get('value').match(mailformat)) 
						{
							//alert("second valid 2");
							valid = 2;
						}
						else 
						{
							//alert("second valid 1");
							valid = 1;
						}
					}
					
					if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true) || flagval==1||(valid==0)||(valid==1)) 
					{		
						if(flagval==1)
						{  
							var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
							if(lang_id==752)
							{
								errors = [" L'adresse email que vous saisissez doit correspondre à votre adresse email enregistrée pour continuer."];
							}
							else if(lang_id==753)
							{
								errors = ['Correo electrónico debe coincidir para proceder.'];
							}
							else
							{
								errors = ['Email addresses must match to proceed.'];
							}
							
							this.lastErrorLocation = args[0].data.error_location;
							this._displayError(errors, this.lastErrorLocation);
							RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
						}
						else if(valid==0)
						{		
								var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
								if(lang_id==752 && countryid == 2)
									{
									errors = [" est requis"];
									}
								else if(lang_id==752 && countryid == 23)
									{
									errors = ["sont requis"];
									}	
								else if(lang_id==753)
									{
									errors = ['es requerido'];
									}
								else
									{
									errors = ['is required'];
									}				
							
							this.lastErrorLocation = args[0].data.error_location;
							this._displayError(errors, this.lastErrorLocation);
							RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
						}
						else if(valid==1)
						{	
								var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
								if(lang_id==752)
									{
									errors = [" est invalide"];
									}
								else if(lang_id==753)
									{
									errors = ['es inválido'];
									}
								else
									{
									errors = ['is invalid'];
									}
							
							this.lastErrorLocation = args[0].data.error_location;
							this._displayError(errors, this.lastErrorLocation);
							RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
						}
						else
						{			
							this.lastErrorLocation = args[0].data.error_location;
							this._displayError(errors, this.lastErrorLocation);
							RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
						}
						
						
						/* else if(valid==1)
						{
						errors = ['Email address is invalid'];
						this.lastErrorLocation = args[0].data.error_location;
						this._displayError(errors, this.lastErrorLocation);
						RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
						}*/
						return false;
					}
					
					RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
					return eventObject;
					
					
					
					
				}
				else
				{
					//alert("else");
					var flagval=0;/*parseInt(document.getElementById("email_validate").value);*/
					
					window.flagval=flagval;
					var eventObject = this.createEventObject(),
					errors = [];
					
					this.toggleErrorIndicator(false);
					
					if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true) || flagval==1) {
					if(flagval==1)
					{
					var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
				    if(lang_id==752)
		  		    {
					   errors = [" L'adresse email que vous saisissez doit correspondre à votre adresse email enregistrée pour continuer."];
				    }
				    else if(lang_id==753)
				    {
					   errors = ['Correo electrónico debe coincidir para proceder.'];
				    }
				    else
				    {
					   errors = ['Email addresses must match to proceed.'];
				    }
					this.lastErrorLocation = args[0].data.error_location;
					this._displayError(errors, this.lastErrorLocation);
					RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
					}
					else
					{
					this.lastErrorLocation = args[0].data.error_location;
					this._displayError(errors, this.lastErrorLocation);
					RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
					}
					return false;
					}
					
					RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
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
                else {
					if(window.flagval==0)
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
					else
					message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message) :  message;
					
                }
                errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
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
            this.Y.one(this.baseSelector + "_Label")[method]("rn_ErrorLabel");
        }
    }
			   
		
		
		
		
		
		
		
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

_confirm_email: function(type, args)
	{
		var req_eng="is required";
		var req_fre="est requis";
		var req_spa="es requerido";	
		var req_france="sont requis";
		var mem_id = args[0].data;
	
		if(mem_id==770)//Member Type = Customer English
			{	
				this._makeRequired("Confirm Email Address",true,req_eng);
			
			}
		else if(mem_id == 761 && countryid == 2)//Member Type = Customer French
			{	
				this._makeRequired("Confirmez votre adresse email",true,req_fre);
			}
		else if(mem_id == 761 && countryid == 23)//Member Type = Customer France
			{	
				this._makeRequired("Confirmez l’adresse e-mail",true,req_france);
			}	
		else if(mem_id == 763)//Member Type = Customer Spanish
			{
				this._makeRequired("Confirmar el correo",true,req_spa);
				
			}
		else
			{
				this._resetAttrs();
				
			}	
	
	},
	_makeRequired: function(label,required,labelrequired)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label+"<span class='rn_Required'> *</span>";
			/*this.data.attrs.required=required;*/
			this.data.attrs.label_input=label;
			this.data.attrs.required=required;
			this.data.attrs.label_required=labelrequired;
	},
	
	_resetAttrs: function()
	{
			this.input.set('value','');
			this.data.attrs.required=false;
	},
/*	_resetAttrs2: function(type, args)
	{
		alert(args[0].data);
		this.input.removeClass('rn_ErrorField');
		var labelnew = this.Y.one("#rn_" + this.instanceID + "_" + "Label").removeClass("rn_ErrorLabel");
			this.input.set('value','');
			this.data.attrs.required=false;
	},*/

	emailCheckhere: function(type, args) {
		
		window.email_check = this.input.get('value');
		  var emailID = this.input.get('value');
		  if( window.validate_variable==emailID){
			  
			
			document.getElementById("email_alert").innerHTML = "";
				var chkbx = 	parseInt(document.getElementById("email_validate").value);
				document.getElementById("email_validate").value = 0;
			
			  
		  }else{
			  
			  
			   
			  document.getElementById("email_alert").innerHTML = "Email addresses must match to proceed.";
			  var chkbx = 	parseInt(document.getElementById("email_validate").value);
			  document.getElementById("email_validate").value = 1;
			 
		  }
		  
		

    },
	coachemailCheckhere: function(type, args) {
		
		window.email_check = this.input.get('value');
		  var emailID = this.input.get('value');
		  if( window.validate_variable==emailID){
			
			document.getElementById("email_alert").innerHTML = "";
				var chkbx = 	parseInt(document.getElementById("email_validate").value);
				document.getElementById("email_validate").value = 0;
			
			  
		  }else{
			  
			  
			   // alert("innn");
			   var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
			 if(lang_id==752)
				  {
					   var errors = ["L'adresse email que vous saisissez doit correspondre à votre adresse email enregistrée pour continuer."];
				  }
				  else if(lang_id==753)
				   {
					   var errors = ['Correo electrónico debe coincidir para proceder.'];
				   }
				   else
				   {
					   var errors = ['Email addresses must match to proceed.'];
				   }  
			  document.getElementById("email_alert").innerHTML = errors;
			  var chkbx = 	parseInt(document.getElementById("email_validate").value);
			  document.getElementById("email_validate").value = 1;
			 
		  }
		  
		

    },
	
	
	
	
	emailCheck: function(type, args) {
		  
		  myVar=args[0].data;
		  if (typeof myVar == 'undefined')
		  {
			 window.validate_variable='';
		  }else
		  {
			window.validate_variable= myVar;
		  }
		 
		   
		  if(window.validate_variable!=""){
			  document.getElementById("rn_" + this.instanceID + "_" +    this.data.js.name).readOnly = false;
   			 document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).style.backgroundColor = "#FFFFFF" ;
			  
		  }
		  
		  else{
		
			  
			 document.getElementById("rn_" + this.instanceID + "_" +    this.data.js.name).readOnly = true;
   			 document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).style.backgroundColor = "#BDBDBD" ;
			 this.input.set('value','');
			  
		  }
		  
		  if(window.email_check!=""){
			  
			  
			
			 if( window.validate_variable==window.email_check){
			  
			
			document.getElementById("email_alert").innerHTML = "";
			document.getElementById("email_validate").value = 0;
			  
		  }else{
			  
			  document.getElementById("email_validate").value = 1;
			 
			  
		  }
			  
		  }
		 
		

    },
	coachemailCheck: function(type, args) {
		  
		  myVar=args[0].data;
		  if (typeof myVar == 'undefined')
		  {
			 window.validate_variable='';
		  }else
		  {
			window.validate_variable= myVar;
		  }
		 
		   
		  if(window.validate_variable!=""){
			  document.getElementById("rn_" + this.instanceID + "_" +    this.data.js.name).readOnly = false;
   			 document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).style.backgroundColor = "#FFFFFF" ;
			  
		  }
		  
		  else{
		
			  
			 document.getElementById("rn_" + this.instanceID + "_" +    this.data.js.name).readOnly = true;
   			 document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).style.backgroundColor = "#BDBDBD" ;
			 this.input.set('value','');
			  
		  }
		  
		  if(window.email_check!=""){
			  
			  
			
			 if( window.validate_variable==window.email_check){
			  
			
			document.getElementById("email_alert").innerHTML = "";
			document.getElementById("email_validate").value = 0;
			  
		  }else{
			  
			  document.getElementById("email_validate").value = 1;
			 
			  
		  }
			  
		  }
		 
		

    }, 
	onValidateEmail: function(type, args) {
			    //alert("invalid email");
			  	var flagval=parseInt(document.getElementById("email_validate").value);
			 	//alert("entered fn email");	
			   	window.flagval=flagval;
        		var eventObject = this.createEventObject(),
            	errors = [];
        		this.toggleErrorIndicator(false);
				var valid = true;
				
				if (this.input.get('value')== "") 
				{
					//alert("2");
					//document.getElementById("error3").innerHTML = "Please enter email ";
					valid = 0;
			
				}
				else {
					
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				if (this.input.get('value').match(mailformat)) {
					//alert("1");
					//document.getElementById("error3").innerHTML = "";
					valid = 2;
				}else {
					//alert("3");
					//document.getElementById("error3").innerHTML = "Please enter a valid email";
					valid = 1;
			}
				}
		
		  		 if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true) || flagval==1||(valid==0)||(valid==1)) 
		{		
			     if(flagval==1)
			   {  
			   	   var lang_id=document.getElementsByName("Incident.CustomFields.c.ccc_language")[0].value;
				  if(lang_id==752 && countryid == 2)
				  {
					   errors = [" L'adresse email que vous saisissez doit correspondre à votre adresse email enregistrée pour continuer."];
				  }
				  else if(lang_id==752 && countryid == 23)
				  {
					   errors = [" L'adresse email que vous saisissez doit correspondre à votre adresse email enregistrée pour continuer."];
				  }
				  else if(lang_id==753)
				   {
					   errors = ['Correo electrónico debe coincidir para proceder.'];
				   }
				   else
				   {
					   errors = ['Email addresses must match to proceed.'];
				   }
				   
				   this.lastErrorLocation = args[0].data.error_location;
				   this._displayError(errors, this.lastErrorLocation);
				   RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
			   }
			   else
			   {
					this.lastErrorLocation = args[0].data.error_location;
					this._displayError(errors, this.lastErrorLocation);
					RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
			   }
			 
            	return false;
        }

        RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
        return eventObject;

 
    }
	
});