RightNow.namespace('Custom.Widgets.ccc_form.TextInputCCC');
var that;
Custom.Widgets.ccc_form.TextInputCCC = RightNow.Widgets.TextInput.extend({ 
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
            that = this;
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			
			if(this.data.js.name == "Contact.Emails.PRIMARY.Address" && this.data.js.isloggedin == "loggedin")
			{
				this._contactemail();
			}
								
			//RightNow.Event.subscribe("evt_languagechanged", this._set_label, this)
			//RightNow.Event.subscribe("get_memeber_value", this.get_member_id, this);
			RightNow.Event.subscribe("hideoptions", this._resetAttrs, this);
			RightNow.Event.subscribe("changeshipbilling", this._set_required_attribute, this);
			if(RightNow.Event.subscribe("evt_languagechanged", this._set_required_attribute, this))
			{
	
				if(fieldName =="Incident.CustomFields.c.ccc_transfer_coach_name")
				{
					
					this._resetAttrs();
				}
				
			}
			
				
				
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			if(fieldName =="Incident.CustomFields.c.ccc_transfer_coach_name") //
				{	
					this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
					//RightNow.Event.subscribe("evt_memberType_Changed",this._resetAttrs, this);
					RightNow.Event.subscribe("evt_memberType_Changed", this._set_required_attribute, this);
					RightNow.Event.on("evt_contactEmailExistsResponse", this._onEmailCheckResponse, this);

				}
			if(fieldName  == "Incident.CustomFields.c.ccc_transfer_coach_email")
				{
						this._previousTimeout = 0;
						this._timeout = 0;
						this._previousRequest = null;
						this._emailLastValue = '';
						//RightNow.Event.subscribe("evt_memberType_Changed",this._resetAttrs, this);
						RightNow.Event.subscribe("evt_memberType_Changed", this._set_required_attribute, this);
						this._loadingElement = this._loadingElement || this.Y.one(this.baseSelector + "_LoadingIcon");
						this.input.on("keyup", this._onKeypressEmailCheck, this);
						this.input.on("blur", this._onKeypressEmailCheck, this);
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
			if(this._loadingElement)
				RightNow.UI.hide(this._loadingElement);
		}
	},
	
_onEmailCheckResponse: function(type, args) {
		var response = args[0];
		var eventArgs = args[1];
		var full_name = response.first_name + " " + response.last_name;
		full_name = full_name.toUpperCase();
		if(response) {
				if(this._fieldName === "Incident.CustomFields.c.ccc_transfer_coach_name") {
					//alert("first name = "+response.first_name);
					this.input.set('value',full_name);
					this.input.set('disabled','true');
				}
				this.data.attrs.hidden = false;
				this.data.attrs.editable = false;	
				
				this.data.attrs.required=false;
			
		}
		else {	
			this.data.js.value = '';
			this.input.set('value','');		
			this.data.attrs.editable = true;
			this.input.set('disabled','');
			
			this.data.attrs.required=true;
		} 
		
		// re-render the widget with above settings
		//this.renderView();
	},	
_set_required_attribute: function(type, args)
{
	var req_eng="est requis";
	if(membertypeid == 771){ // YES
		if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_coach_name"){
			this._makeRequired("Nom du partner BODi",true,req_eng);
		}
		if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_coach_email"){
			this._makeRequired("Adresse e-mail du partner BODi",true,req_eng);
		}
	}else{
		if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_coach_name")
			this._makeRequired("Nom du partner",false,req_eng);
		if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_coach_email")	
			this._makeRequired("Adresse e-mail du partner",false,req_eng);
	}
	
},
	
	
	

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

    /**
     * Renders the `label.ejs` JavaScript template.
     */
    renderLabel: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.label}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `labelValidate.ejs` JavaScript template.
     */
    renderLabelValidate: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.labelValidate}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },
	
	_makeRequired: function(label,required,labelrequired)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label+"<span class='rn_Required'> *</span>";
			/*this.data.attrs.required=required;*/
			//labelnew.innerHTML= label;
			this.data.attrs.label_input=label;
			this.data.attrs.required=required;
			this.data.attrs.label_required=labelrequired;
	},
	_makeFalse: function(label,required)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label;
			this.data.attrs.required=required;
	},

	
	_resetAttrs: function()
	{
		    
			if(this.data.js.isloggedin != "loggedin")
			{
				this.input.set('value','');
				this.data.attrs.required=false;
			}
			else
			{
				if(this.data.js.name != "Contact.Emails.PRIMARY.Address")
				{
					this.input.set('value','');
					this.data.attrs.required=false;	
				}
			}
			
	},
	_contactemail: function()
	{
		//console.log(this.data.js.name);
		var elem = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		elem.readOnly = true;
	},
	
	_labelChange: function(label)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML =label;
	}
	
});